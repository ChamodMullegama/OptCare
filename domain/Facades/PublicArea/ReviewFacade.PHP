<?php
namespace domain\Facades\PublicArea;

use domain\Services\PublicArea\ReviewService;
use Illuminate\Support\Facades\Facade;

class ReviewFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ReviewService::class;
    }
}
