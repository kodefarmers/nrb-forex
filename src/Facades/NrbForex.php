<?php

namespace KodeFarmers\NrbForex\Facades;

use Illuminate\Support\Facades\Facade;

class NrbForex extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'NrbForex';
    }
}
