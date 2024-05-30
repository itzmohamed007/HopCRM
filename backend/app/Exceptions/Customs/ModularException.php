<?php

namespace App\Exceptions\Customs;

use Exception;

class ModularException extends Exception
{
    public $message;
    public $code;

    public function __construct($message, $code)
    {
        $this->message = $message;
        $this->code = $code;

        parent::__construct($message, $code);
    }
}
