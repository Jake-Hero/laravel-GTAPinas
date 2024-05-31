<?php

namespace App\Exceptions;

use Exception;

class LinkExpiredException extends Exception
{
    public function __construct($message = "The link has expired.", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}