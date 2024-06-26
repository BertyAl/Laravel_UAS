<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;

    public $active;
    public $q;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $item = [
        'name' => '',
        'stock' => '',
        'price' => '',
        'status' => false,
    ];

    protected $queryString = ['active' => ['except' => false], 'q' => ['except' => ''], 'sortBy' => ['except' => 'id'], 'sortAsc' => ['except' => true]];

    public $confirmingItemDeletion = false;
    public $confirmingItemAdd = false;

    protected $rules = [
        'item.name' => 'required|string|min:4',
        'item.stock' => 'required|numeric|between:1,9999',
        'item.price' => 'required|numeric',
        'item.status' => 'boolean'
    ];

    public function render()
    {
        $query = Item::where('user_id', auth()->user()->id)
            // searching method
            ->when($this->q, function($query) {
                return $query->where(function($query) {
                    $query->where('name', 'ilike', '%' . $this->q . '%')
                        ->orWhere('stock', 'ilike', '%' . $this->q . '%')
                        ->orWhere('price', 'ilike', '%' . $this->q . '%');
                });
            })

            // active status method
            ->when($this->active, function($query) {
                return $query->where('status', true);
            })
            // orderby method
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            //pagination method
            ->paginate(10);


        return view('livewire.items', [
            'items' => $query,
        ]);
    }
    public function toggleActive()
    {
        $this->active = !$this->active;

        // Reset pagination when toggling active state
        $this->resetPage();
    }
    public function updatingQ()
    {
        $this->resetPage();
    }

    public function refreshSearch()
    {
        $this->resetPage();
    }

    public function sortedBy($field)
    {
        if ($field === $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
       $this->sortBy = $field;
    }

    public function confirmItemDeletion($id)
    {
        $this->confirmingItemDeletion = $id;
    }

    public function deleteItem(Item $item)
    {
        $item->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Barang berhasil dihapus');
    }

    public function confirmItemAdd()
    {
        $this->reset(['item']);
        $this->item = [
            'name' => '',
            'stock' => '',
            'price' => '',
            'status' => false,
        ];
        $this->confirmingItemAdd = true;
    }

    public function confirmItemEdit(Item $item)
    {
        $this->resetErrorBag();
        $this->item = $item->toArray();
        $this->confirmingItemAdd = true;
    }

    public function saveItem()
    {
        $this->validate();

        if (isset($this->item['id'])) {
            $existingItem = Item::find($this->item['id']);
            $existingItem->update($this->item);
            session()->flash('message', 'Item Saved Successfully');
        } else {
            auth()->user()->items()->create([
                'name' => $this->item['name'],
                'stock' => $this->item['stock'],
                'price' => $this->item['price'],
                'status' => $this->item['status'] ?? 0
            ]);
            session()->flash('message', 'Barang berhasil ditambahkan');
        }

        $this->confirmingItemAdd = false;
        $this->reset(['item']);
    }
}
