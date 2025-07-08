<div class="space-y-4">
    <div>
        <label class="block text-sm">Product ID</label>
        <input type="number" wire:model="product_id" class="w-full border rounded px-2 py-1">
        @error('product_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm">Quantity</label>
        <input type="number" wire:model="quantity" class="w-full border rounded px-2 py-1">
        @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm">Price</label>
        <input type="number" wire:model="price" step="0.01" class="w-full border rounded px-2 py-1">
        @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-sm">Date</label>
        <input type="date" wire:model="date" class="w-full border rounded px-2 py-1">
        @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
</div>
