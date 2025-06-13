<?php

namespace domain\Services\AdminArea;

use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerService
{
    protected $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    public function all()
    {
        return $this->customer->all();
    }


}
