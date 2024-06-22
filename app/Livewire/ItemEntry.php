<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;

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
        $this->message = 'Barang Berhasil Masuk';
//        session()->flash('message', 'Barang telah berhasil ditambahkan');
        $this->reset(['item_id', 'quantity']);
    }

    public function render()
    {
        return view('livewire.item-entry', [
            'items' => Item::all(),
        ]);
    }
}
