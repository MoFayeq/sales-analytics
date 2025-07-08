<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderComponent extends Component
{
    public $orders;
    public $search = '';

    public $orderId;
    public $product_id;
    public $quantity;
    public $price;
    public $date;

    public $showCreateModal = false;
    public $showEditModal = false;

    public function render()
    {
        $this->orders = Order::where('product_id', 'like', "%{$this->search}%")
            ->orderByDesc('id')
            ->get();

        return view('livewire.order-component');
    }

    public function resetForm()
    {
        $this->orderId = null;
        $this->product_id = null;
        $this->quantity = null;
        $this->price = null;
        $this->date = null;
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->showCreateModal = false;
        $this->showEditModal  = false;

    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function store()
    {
        $this->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        Order::create([
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'date' => $this->date,
        ]);

        session()->flash('message', 'Order created successfully.');

        $this->resetForm();
        $this->showCreateModal = false;
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        $this->orderId = $order->id;
        $this->product_id = $order->product_id;
        $this->quantity = $order->quantity;
        $this->price = $order->price;
        $this->date = $order->date;

        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $order = Order::findOrFail($this->orderId);
        $order->update([
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'date' => $this->date,
        ]);

        session()->flash('message', 'Order updated successfully.');

        $this->resetForm();
        $this->showEditModal = false;
    }

    public function delete($id)
    {
        Order::findOrFail($id)->delete();
        session()->flash('message', 'Order deleted successfully.');
    }
}
