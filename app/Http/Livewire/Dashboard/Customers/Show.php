<?php

namespace App\Http\Livewire\Dashboard\Customers;

use App\Models\Customer;
use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $customer;


    public function mount(Customer $customer)
    {
        $this->customer = $customer;
    }
    public function render()
    {
        return view('livewire.dashboard.customers.show');
    }
}
