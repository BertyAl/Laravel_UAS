<!-- resources/views/livewire/item-dashboard.blade.php -->
<div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <h1 class="mt-8 text-2xl font-medium text-gray-900">
            Dashboard Barang
        </h1>


    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
        <div class="p-4 bg-white shadow rounded-lg">
            <div class="text-2xl font-semibold text-gray-800">
                Jumlah Barang
            </div>
            <div class="mt-2 text-xl text-gray-600">
                {{ $totalItems }}
            </div>
        </div>
        <div class="p-4 bg-white shadow rounded-lg">
            <div class="text-2xl font-semibold text-gray-800">
                Total Stock Barang
            </div>
            <div class="mt-2 text-xl text-gray-600">
                {{ $totalStock }}
            </div>
        </div>
        <div class="p-4 bg-white shadow rounded-lg">
            <div class="text-2xl font-semibold text-gray-800">
                Total Harga
            </div>
            <div class="mt-2 text-xl text-gray-600">
                Rp. {{ number_format($averagePrice, 3) }}
            </div>
        </div>
        <div class="p-4 bg-white shadow rounded-lg">
            <div class="text-2xl font-semibold text-gray-800">
                Barang Aktif
            </div>
            <div class="mt-2 text-xl text-gray-600">
                {{ $activeItems }}
            </div>
        </div>
    </div>
</div>
