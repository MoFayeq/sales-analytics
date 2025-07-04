<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderComponent extends Component
{
    public $orders;
    public $product_id, $quantity, $price, $date;

    public function mount()
    {
        $this->orders = Order::latest()->get();
    }

    public function store()
    {
        $this->validate([
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer',
            'price'      => 'required|numeric',
            'date'       => 'nullable|date',
        ]);

        Order::create([
            'product_id' => $this->product_id,
            'quantity'   => $this->quantity,
            'price'      => $this->price,
            'date'       => $this->date ?? now(),
        ]);

        $this->reset(['product_id', 'quantity', 'price', 'date']);
        $this->orders = Order::latest()->get();
    }

    public function render()
    {
        return view('livewire.order-component', [
            'orders' => Order::latest()->get(),
                ]);
    }
}
