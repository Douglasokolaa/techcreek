<?php

namespace App\Http\Livewire;

use App\Domains\Custom\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    // protected $paginationTheme = 'bootstrap';
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $payments = Payment::search($this->search)->paginate(10);
        return view('livewire.search',compact('payments'));
    }
}
