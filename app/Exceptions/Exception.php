<?php

namespace App\Exceptions;

use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Support\MessageBag;

class Exception extends \Exception implements MessageProvider
{
    public function getMessageBag()
    {
        return new MessageBag([$this->getMessage()]);
    }
}