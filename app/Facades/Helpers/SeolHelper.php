<?php
namespace App\Facades\Helpers;

use Illuminate\Support\Facades\Facade;

class SeoHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Helpers\SeoHelper::class;
    }
}
