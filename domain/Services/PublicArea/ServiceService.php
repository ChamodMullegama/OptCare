<?php

namespace domain\Services\PublicArea;

use domain\Facades\AdminArea\ServiceFacade as AdminServiceServiceFacade;

class ServiceService
{
    public function getLatestsService($limit = 3)
    {
        return AdminServiceServiceFacade::allForPublic()->take($limit);
    }
}
