<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
    protected $message = "View not found !";
}