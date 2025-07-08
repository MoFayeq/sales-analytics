<div class="p-6 max-w-6xl mx-auto bg-white rounded-xl shadow-md">

    @if (session()->has('message'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 5000)"
            x-show="show"
            class="fixed top-4 right-4 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg z-50"
        >
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <input type="text" wire:model.debounce.300ms="search"
            class="border px-4 py-2 rounded-md w-1/3" placeholder="Search orders...">

        <button wire:click="openCreateModal"
            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
            + Create Order
        </button>
    </div>

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

    {{-- Create Modal --}}
    @if($showCreateModal)
        @include('livewire.modals.create-order-modal')
    @endif

    {{-- Edit Modal --}}
    @if($showEditModal)
        @include('livewire.modals.edit-order-modal')
    @endif
</div>
