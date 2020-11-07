<?php

namespace App\Http\Livewire;

use App\Domains\Custom\Models\Payment;
use Livewire\Component;

class Search extends Component
{
    public $search;

    public function render()
    {
        $payments = !is_null($this->search) ? Payment::search($this->search)->with('product')->take(10)->get() : [];
        return view('livewire.search',compact('payments'));
    }
}
