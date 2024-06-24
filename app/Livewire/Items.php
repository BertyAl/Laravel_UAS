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
    // query string untuk melakukan pencarian pada search bar
    protected $queryString = ['active', 'q', 'sortBy', 'sortAsc'];

    public $confirmingItemDeletion = false;
    public $confirmingItemAdd = false;

    protected $rules = [
        'item.name' => 'required|string|min:4',
        'item.stock' => 'required|numeric|between:1,9999',
        'item.price' => 'required|numeric',
        'item.status' => 'boolean'
    ];

//  return to blade view
    public function render()
    {
        $items = Item::where('user_id', auth()->user()->id)
            ->when($this->q, function($query) {
                return $query->where(function($query) {
                    // penggunaan ilike untuk mencari data yang mirip dengan mengabaikan huruf besar/kecil
                    $query->where('name', 'ilike', '%' . $this->q . '%')
                        ->orWhere('stock','ilike', '%' . $this->q . '%')
                        ->orWhere('price', 'ilike', '%' . $this->q . '%');
                });
            })
            ->when($this->active, function($query) {
                return $query->active();
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC');

        $items = $items->paginate(10);

        return view('livewire.items', [
            'items' => $items,
        ]);
    }

    // reset page ketika filter di pencet
    public function updatingActive()
    {
        $this->resetPage();
    }
    public function updatingQ()
    {
        $this->resetPage();
    }
    public function refreshSearch()
    {
        $this->resetPage(); // Reset pagination when search query changes
    }

    //fungsi untuk fitur sorting
    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortBy = $field;
    }

    //konfirmasi delete
    public function confirmItemDeletion($id)
    {
        $this->confirmingItemDeletion = $id;
    }

    // fungsi delete item
    public function deleteItem(Item $item)
    {
        $item->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Barang berhasil dihapus');
    }

    // fungsi confirmasi item ditambahkan
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

    // fungsi konfirmasi item di edit
    public function confirmItemEdit(Item $item)
    {
        $this->resetErrorBag();
        $this->item = $item->toArray();
        $this->confirmingItemAdd = true;
    }

    //fungsi menyimpan item
    public function saveItem()
    {
        $this->validate();

        // Debugging: Check item data
        logger()->info('Saving Item:', $this->item);

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
