<?php

namespace domain\Facades;

use domain\Services\EyeIssueService;
use Illuminate\Support\Facades\Facade;

class EyeIssueFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
      return EyeIssueService::class;
    }
}
