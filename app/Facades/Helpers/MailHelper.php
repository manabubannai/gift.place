<?php
namespace App\Facades\Helpers;

use Illuminate\Support\Facades\Facade;

class MailHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Helpers\MailHelper::class;
    }
}
