<?php

namespace App\Exceptions;

use Exception;

class EmailAttachmentCustomException extends Exception
{
    public function render($request)
    {       
        return response()->error($this->getMessage());       
    }
}
