<?php

namespace App\Http\Livewire\Dashboard\Attributes;

use Livewire\Component;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Store extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $ar_name, $en_name;

    protected $rules = [
        'ar_name' => 'required|min:2|max:100',
        'en_name' => 'required|min:2|max:100',
      
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->authorize('create attributes');

        $validatedData = $this->validate();

         //dd( $validatedData);
        Attribute::create($validatedData);

        $this->reset();

        session()->flash('alert', __('Saved Successfully.'));

        return redirect()->route('admin.attributes.index');
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
   
    public function render()
    {
        return view('livewire.dashboard.attributes.store');
    }
}
