<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\EyeIssueService;
use Illuminate\Support\Facades\Facade;

class EyeIssueFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
      return EyeIssueService::class;
    }
}
