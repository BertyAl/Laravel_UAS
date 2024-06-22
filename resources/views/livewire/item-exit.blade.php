<div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200 relative">
        @if($message)
        <div class="bg-green-500 text-white p-4 rounded absolute top-0 left-0 right-0 z-10">
            <div class="flex items-center">
                <p>{{ $message }}</p>
                <button type="button" wire:click="$set('message', null)" class="ml-4">
                    <svg class="fill-current w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 20">
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            Barang Keluar
        </h1>
    </div>

    <div class="bg-gray-200 bg-opacity-25 p-6 lg:p-8">

        @if(session()->has('error'))
        <div class="bg-red-500 text-white p-4 rounded">
            {{ session('error') }}
        </div>
        @endif

        <form wire:submit.prevent="addItemExit">
            <div class="mb-4">
                <label for="item_id" class="block text-gray-700">Item</label>
                <select wire:model="item_id" id="item_id" class="mt-1 block w-full">
                    <option value="">Select Item</option>
                    @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('item_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-gray-700">Quantity</label>
                <input type="number" wire:model="quantity" id="quantity" class="mt-1 block w-full" />
                @error('quantity') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <x-button type="submit" class="bg-blue-500 hover:bg-blue-700">
                Add Item Exit
            </x-button>
        </form>
    </div>
</div>
