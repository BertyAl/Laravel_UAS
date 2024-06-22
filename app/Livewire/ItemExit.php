<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;

class ItemExit extends Component
{
    public $item_id;
    public $quantity;
    public $message;

    protected $rules = [
        'item_id' => 'required|exists:items,id',
        'quantity' => 'required|integer|min:1',
    ];

    public function addItemExit()
    {
        $this->validate();

        $item = Item::find($this->item_id);

        if ($item->stock < $this->quantity) {
            session()->flash('error', 'Not enough stock available.');
            return;
        }

        $item->stock -= $this->quantity;
        $item->save();

        $this->message = 'Barang Berhasil Keluar.';
        $this->reset(['item_id', 'quantity']);
    }

    public function render()
    {
        return view('livewire.item-exit', [
            'items' => Item::all(),
        ]);
    }
}
