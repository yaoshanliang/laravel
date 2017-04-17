<?php

namespace App\Exceptions;

use Exception;

class ApiRequestException extends Exception
{
    protected $message;

    protected $data;

    public function __construct($message = 'ApiRequestException', $data = [])
    {
        parent::__construct($message);

        $this->message = $message;
        $this->data = $data;
    }
}
