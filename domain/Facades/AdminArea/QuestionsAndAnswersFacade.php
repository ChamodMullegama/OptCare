<?php

namespace domain\Facades\AdminArea;

use domain\Services\AdminArea\QuestionsAndAnswersService;
use Illuminate\Support\Facades\Facade;

class QuestionsAndAnswersFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return QuestionsAndAnswersService::class;
    }
}
