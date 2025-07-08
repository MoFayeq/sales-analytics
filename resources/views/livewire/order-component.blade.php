<div class="p-6 max-w-3xl mx-auto bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        {{ $orderId ? 'Edit Order' : 'Create New Order' }}
    </h2>

    @if (session()->has('message'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 5000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="fixed top-4 right-4 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg z-50"
        >
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="{{ $orderId ? 'update' : 'store' }}" class="space-y-4">
        <div>
            <label for="product_id" class="block text-sm font-medium text-gray-700">Product ID</label>
            <input type="number" wire:model="product_id" id="product_id"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('product_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" wire:model="quantity" id="quantity"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" step="0.01" wire:model="price" id="price"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" wire:model="date" id="date"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex space-x-2">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                {{ $orderId ? 'Update Order' : 'Create Order' }}
            </button>

            @if ($orderId)
                <button type="button" wire:click="$set('orderId', null)"
                        class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <hr class="my-6">

    <h3 class="text-xl font-semibold mb-4">All Orders</h3>
    <table class="min-w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Product ID</th>
                <th class="px-4 py-2">Quantity</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $order->product_id }}</td>
                    <td class="px-4 py-2">{{ $order->quantity }}</td>
                    <td class="px-4 py-2">{{ $order->price }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($order->date)->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <button wire:click="edit({{ $order->id }})"
                                class="text-blue-600 hover:underline">Edit</button>
                        <button wire:click="delete({{ $order->id }})"
                                class="text-red-600 hover:underline"
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
