<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pendataan') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <div class="bg-white shadow-xl sm:rounded-lg">
                        <livewire:item-entry />
                    </div>
                    <div class="bg-white shadow-xl sm:rounded-lg">
                        <livewire:item-exit />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
