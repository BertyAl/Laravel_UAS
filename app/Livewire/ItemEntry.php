<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Log;

class ItemEntry extends Component
{
    public $item_id;
    public $quantity;
    public $message;

    protected $rules = [
        'item_id' => 'required|exists:items,id',
        'quantity' => 'required|integer|min:1',
    ];

    public function addItemEntry()
    {
        $this->validate();

        $item = Item::find($this->item_id);
        $item->stock += $this->quantity;
        $item->save();
        Log::create(['action' => 'Barang Masuk: ' . $item->name . ' (Jumlah: ' . $this->quantity . ')']);
        $this->dispatch('logUpdated');
        $this->message = 'Barang Berhasil Masuk';

        $this->reset(['item_id', 'quantity']);
    }

    public function render()
    {
        return view('livewire.item-entry', [
            'items' => Item::all(),
        ]);
    }
}
