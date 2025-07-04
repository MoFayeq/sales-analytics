<div class="p-6 max-w-3xl mx-auto bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Create New Order</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="space-y-4">
        <div>
            <label class="block mb-1 font-medium text-gray-700">Product ID</label>
            <input type="number" wire:model="product_id" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-200">
            @error('product_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Quantity</label>
            <input type="number" wire:model="quantity" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-200">
            @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Price</label>
            <input type="number" wire:model="price" step="0.01" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-200">
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Date</label>
            <input type="date" wire:model="date" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring focus:ring-blue-200">
            @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded transition">
                Save Order
            </button>
        </div>
    </form>

    <h2 class="text-2xl font-bold mt-10 mb-4 text-gray-800">Orders List</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded shadow">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-3 text-left border-b">ID</th>
                    <th class="p-3 text-left border-b">Product ID</th>
                    <th class="p-3 text-left border-b">Qty</th>
                    <th class="p-3 text-left border-b">Price</th>
                    <th class="p-3 text-left border-b">Date</th>
                    <th class="p-3 text-left border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 border-b">{{ $order->id }}</td>
                        <td class="p-3 border-b">{{ $order->product_id }}</td>
                        <td class="p-3 border-b">{{ $order->quantity }}</td>
                        <td class="p-3 border-b">{{ $order->price }}</td>
                        <td class="p-3 border-b">{{ \Carbon\Carbon::parse($order->date)->format('Y-m-d') }}</td>
                        <td class="p-3 border-b">
                            <button wire:click="delete({{ $order->id }})"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">No orders available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
