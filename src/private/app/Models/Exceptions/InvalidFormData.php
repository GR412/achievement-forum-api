<?php


namespace App\Models\Exceptions;


use Throwable;

class InvalidFormData extends \LogicException
{
    public function __construct(string $message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
