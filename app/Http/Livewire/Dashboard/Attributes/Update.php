<?php

namespace App\Http\Livewire\Dashboard\Attributes;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Attribute;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Update extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $attribute;

    protected $rules = [
        'attribute.ar_name' => 'required|min:2|max:100',
        'attribute.en_name' =>'required|min:2|max:100',
    ];

    public function submit()
    {
        $this->authorize('edit attributes');

       $validatedData = $this->validate();

        $this->attribute->save();

        session()->flash('alert', __('Update Successfully.'));

        return redirect()->route('admin.attributes.index');
    }

    public function mount(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }
    public function render()
    {
        return view('livewire.dashboard.attributes.update');
    }
}
