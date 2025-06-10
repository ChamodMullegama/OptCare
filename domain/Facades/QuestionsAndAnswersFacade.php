<?php

namespace domain\Facades;

use domain\Services\QuestionsAndAnswersService;
use Illuminate\Support\Facades\Facade;

class QuestionsAndAnswersFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return QuestionsAndAnswersService::class;
    }
}
