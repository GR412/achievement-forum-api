<?php


namespace App\DataMappers;

use App\Models\Email;
use App\Models\Password;
use App\Models\User;
use PDO;

class UserMapper
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Fetch a user by id.
     *
     * Note: PDOStatement::fetch returns FALSE if no record is found.
     *
     * @param int $id User id.
     * @return User|null User.
     */
    public function fetchUserById(int $id) {
        $sql = 'SELECT * FROM users WHERE id = :id LIMIT 1';

        $statement = $this->connection->prepare($sql);
        $statement->execute([':id' => $id,]);

        $record = $statement->fetch(PDO::FETCH_ASSOC);

        return ($record === false) ? null : $this->convertRecordToUser($record);
    }

    /**
     * Fetch all users.
     *
     * @return User[] User list.
     */
    public function fetchAllUsers() {
        $sql = 'SELECT * FROM users';

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $recordset = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $this->convertRecordsetToUserList($recordset);
    }

    /**
     * Check if the given user exists.
     *
     * Note: PDOStatement::fetch returns FALSE if no record is found.
     *
     * @param User $user User.
     * @return bool True if the user exists, false otherwise.
     */
    public function userExists(User $user) {
        $sql = 'SELECT COUNT(*) as cnt FROM users WHERE username = :username';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':username' => $user->getUsername(),
        ]);

        $record = $statement->fetch(PDO::FETCH_ASSOC);

        return ($record['cnt'] > 0) ? true : false;
    }

    /**
     * Save a user.
     *
     * @param User $user User.
     * @return User User.
     */
    public function saveUser(User $user) {
        $id = $user->getId();

        if (!isset($id))
            return $this->insertUser($user);

        return $this->updateUser($user);
    }

    /*public function test(string $email, string $username, string $password)
    {
        $sql = 'INSERT INTO users (
                    email,
                    username,
                    password
                ) VALUES (
                    :email,
                    :username,
                    :password
                )';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':email' => $email,
            ':username' => $username,
            ':password' => $password
        ]);

    }*/

    /**
     * Insert a user.
     *
     * @param User $user User.
     * @return User User.
     */
    private function insertUser(User $user) {
        $sql = 'INSERT INTO users (
                    email,
                    username,
                    password
                ) VALUES (
                    :email,
                    :username,
                    :password
                )';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':email' => $user->getEmail(),
            ':username' => $user->getUsername(),
            ':password' => $user->getPassword(),
        ]);

        $user->setId($this->connection->lastInsertId());

        return $user;
    }

    /**
     * Update a user.
     *
     * @param User $user User.
     * @return User User.
     */
    private function updateUser(User $user) {
        $sql = 'UPDATE users 
                SET 
                    username = :username,
                    email = :email,
                    password = :password 
                WHERE id = :id';

        $statement = $this->connection->prepare($sql);
        $statement->execute([
            ':id' => $user->getId(),
            ':username' => $user->getUsername(),
            ':email' => (string) $user->getEmail(),
            ':password' => (string) $user->getPassword(),
        ]);

        return $user;
    }

    /**
     * Convert a record to a user.
     *
     * @param array $record Record data.
     * @return User User.
     */
    private function convertRecordToUser(array $record) {
        $user = $this->createUser(
            $record['id'],
            $record['username'],
            $record['email'],
            $record['password']
        );

        return $user;
    }

    /**
     * Convert a recordset to a list of users.
     *
     * @param array $recordset Recordset data.
     * @return User[] User list.
     */
    private function convertRecordsetToUserList(array $recordset) {
        $users = [];

        foreach ($recordset as $record) {
            $users[] = $this->convertRecordToUser($record);
        }

        return $users;
    }

    /**
     * Create user.
     *
     * @param int $id User id.
     * @param string $username Username.
     * @param string $email Email.
     * @param string $password Password.
     * @return User User.
     */
    private function createUser(int $id, string $username, string $email, string $password) {
        $user = new User();

        $user
            ->setId($id)
            ->setUsername($username)
            ->setEmail(new Email($email))
            ->setPassword(new Password($password))
        ;

        return $user;
    }


}
