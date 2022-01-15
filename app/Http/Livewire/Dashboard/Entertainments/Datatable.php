<?php

namespace App\Http\Livewire\Dashboard\Entertainments;

use Livewire\Component;
use App\Models\RealEstate;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Jobs\NotifyUnActiveRealEstate;
use App\Models\Entertainment;

class Datatable extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $count = 20;
    public $sortBy = 'created_at';
    public $sortDirection = 'DESC';

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
        $this->authorize('delete entertainments');

        $this->emit('openDeleteModal'); // Open model to using to jquery

        $this->data_id = $id;
    }

    public function destroy()
    {
        $row = Entertainment::findOrFail($this->data_id);
        $row->delete();

        $this->emit('closeDeleteModal'); // Close model to using to jquery
        session()->flash('alert', __('Saved Deleted.'));
    }

    public function render()
    {
        return view('livewire.dashboard.entertainments.datatable', [

            'entertainments' => Entertainment::search('ar_title', $this->search)
                ->orSearch('en_title', $this->search)
                ->orSearch('price', $this->search)
                ->orSearch('space', $this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->count),
        ]);
    }
}
