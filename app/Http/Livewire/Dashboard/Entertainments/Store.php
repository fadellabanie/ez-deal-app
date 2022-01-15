<?php

namespace App\Http\Livewire\Dashboard\Entertainments;

use App\Models\Entertainment;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\RealEstate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Store extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    
    public $ar_title, $lat, $lng, $address, $image, $type, $en_title, $mobile;
    public $from,$to;

    protected $rules = [
        'ar_title' => 'required',
        'en_title' => 'required',
        'type' => 'required',
        'mobile' => 'required',
        'from' => 'required',
        'to' => 'required',
        'lat' =>  ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        'lng' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        'address' => 'required',
        'image' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->authorize('create real estates');

        $validatedData = $this->validate();
        // dd($validatedData);
        $validatedData['image'] = ($this->image) ? uploadToPublic('entertainments', $validatedData['image']) : "";

        Entertainment::create($validatedData);

        $this->reset();

        session()->flash('alert', __('Saved Successfully.'));

        return redirect()->route('admin.entertainments.index');
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.dashboard.entertainments.store');
    }
}
