<div class="p-4 max-w-xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Create New Order</h2>

    @if (session()->has('message'))
        <div class="mb-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="space-y-4">
        <div>
            <label>Product ID</label>
            <input type="number" wire:model="product_id" class="border p-2 w-full">
            @error('product_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Quantity</label>
            <input type="number" wire:model="quantity" class="border p-2 w-full">
            @error('quantity') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Price</label>
            <input type="number" wire:model="price" step="0.01" class="border p-2 w-full">
            @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Date</label>
            <input type="date" wire:model="date" class="border p-2 w-full">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Order</button>
    </form>

    <h2 class="text-xl font-bold mt-8 mb-4">Orders List</h2>

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">Product ID</th>
                <th class="border p-2">Qty</th>
                <th class="border p-2">Price</th>
                <th class="border p-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="border p-2">{{ $order->id }}</td>
                    <td class="border p-2">{{ $order->product_id }}</td>
                    <td class="border p-2">{{ $order->quantity }}</td>
                    <td class="border p-2">{{ $order->price }}</td>
                    <td class="border p-2">{{ $order->date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
