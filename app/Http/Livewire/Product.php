<?php

namespace App\Http\Livewire;

use App\Domains\Custom\Models\Product as ModelsProduct;
use Livewire\Component;
use Request;

class Product extends Component
{
    public $product;
    public $name;
    public $price_daily;
    public $price_monthly;
    public $price_yearly;

    protected $rules = [
        'name'      => 'required',
        'price_daily'   => 'sometimes',
        'price_monthly' => 'required|numeric',
        'price_yearly'  => 'required|gte:price_monthly|numeric',
    ];

    public function mount(ModelsProduct $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->price_daily = $product->price_daily;
        $this->price_monthly = $product->price_monthly;
        $this->price_yearly = $product->price_yearly;
    }

    public function save(Request $request)
    {
        $validatedData = $this->validate();
        $this->product->update($validatedData);
        session()->flash('flash_success', 'Product successfully updated.');
    }

    public function render()
    {
        return view('livewire.product');
    }
}
