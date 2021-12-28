<?php

namespace App\Http\Livewire\Dashboard\Owners;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\AppUserExport;
use App\Models\Owner;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Datatable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $block_date;
    public $data_id;
    public $user_id;
    public $status = 'all';
    public $type = 'all';
    public $city_id  = 'all';
    public $count = 20;
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

    protected $rules = [
        'block_date' => 'required|after:today',
    ];
    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }
        return $this->sortBy = $field;
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirm($id)
    {
        $this->emit('openDeleteModal'); // Open model to using to jquery

        $this->data_id = $id;
    }  
    
    public function destroy()
    {
        $row = Owner::findOrFail($this->data_id);
        $row->delete();
        
        $this->emit('closeDeleteModal'); // Close model to using to jquery
    }
    
   public function freeze($user_id)
    {
       $row = Owner::find($user_id);
       $row->update([
            'suspend' => !$row->suspend,    
        ]);
      
        session()->flash('alert', __('Account Freeze Successfully.'));
    }
    
    public function export()
    {
      //  $this->authorize('export users');

        return Excel::download(new AppUserExport, 'app-users.xlsx');
    }

    public function render()
    {
        return view('livewire.dashboard.owners.datatable', [
            'owners' => Owner::
                when('status', function ($q) {
                    if ($this->status != 'all') {
                        $q->where('status', $this->status);
                    }
                })                
                ->where(function ($q) {
                    $q->search('name', $this->search);
                    $q->orSearch('mobile', $this->search);
                    $q->orSearch('email', $this->search);
                })
               // ->select(['id', 'name','city.en_name' ,'avatar', 'email', 'mobile', 'type','status','suspend', 'created_at'])
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->count),
        ]);
    }
}
