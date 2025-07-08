<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderComponent extends Component
{
    public $orders;
    public $orderId;
    public $product_id, $quantity, $price, $date;

    public function mount()
    {
        $this->orders = Order::latest()->get();
    }

    protected function rules()
    {
        return [
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer',
            'price'      => 'required|numeric',
            'date'       => 'nullable|date',
        ];
    }

    public function store()
    {
        $this->validate();

        Order::create([
            'product_id' => $this->product_id,
            'quantity'   => $this->quantity,
            'price'      => $this->price,
            'date'       => $this->date ?? now(),
        ]);

        $this->resetForm();
        session()->flash('message', 'Order created successfully.');
        $this->refreshOrders();
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);

        $this->orderId = $order->id;
        $this->product_id = $order->product_id;
        $this->quantity = $order->quantity;
        $this->price = $order->price;
        $this->date = $order->date;
    }

    public function update()
    {
        $this->validate();

        $order = Order::findOrFail($this->orderId);

        $order->update([
            'product_id' => $this->product_id,
            'quantity'   => $this->quantity,
            'price'      => $this->price,
            'date'       => $this->date ?? now(),
        ]);

        session()->flash('message', 'Order updated successfully.');
        $this->resetForm();
        $this->refreshOrders();
    }

    public function delete($id)
    {
        Order::findOrFail($id)->delete();

        session()->flash('message', 'Order deleted successfully.');
        $this->refreshOrders();
    }

    public function resetForm()
    {
        $this->reset(['orderId', 'product_id', 'quantity', 'price', 'date']);
    }

    public function refreshOrders()
    {
        $this->orders = Order::latest()->get();
    }

    public function render()
    {
        return view('livewire.order-component');
    }
}
