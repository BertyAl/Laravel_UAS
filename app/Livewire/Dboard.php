<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;

class Dboard extends Component
{
    public $totalItems;
    public $totalStock;
    public $averagePrice;
    public $activeItems;

    public function mount()
    {
        $this->totalItems = Item::count();
        $this->totalStock = Item::sum('stock');
        // Calculate the total value of all items' stock
        $totalStockValue = Item::all()->sum(function($item) {
            return $item->stock * $item->price;
        });

        // Calculate the average price based on the total stock value
        $this->averagePrice =  $totalStockValue;
        $this->activeItems = Item::where('status', true)->count();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
