<?php

namespace App\Http\Livewire\Dashboard\Home;

use App\Models\User;
use Livewire\Component;
use App\Models\RealEstate;

class SuperAdmin extends Component
{

    public $unReviewOrders;
    public $totalActiveRealEstates;
    public $totalNotActiveRealEstates;
    public $totalOrders;
    public $realEstates;

    public function mount()
    {
        $this->unReviewOrders = 1;
        $this->totalOrders = 1;
        $this->totalActiveRealEstates = RealEstate::active()->count();
        $this->totalNotActiveRealEstates = RealEstate::notActive()->count();
        $this->realEstates = RealEstate::select(['id','en_name','address', 'lat','lng'])->get()
        ->toArray();
    }
    public function render()
    {
        return view('livewire.dashboard.home.super-admin',[
            'latestRealEstates' => RealEstate::with('realestateType')->latest()->take(10)->get(),
            'users' => User::latest()->take(10)->get(),

        ]);
    }
}
