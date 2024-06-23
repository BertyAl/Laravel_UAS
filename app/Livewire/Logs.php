<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Log;

class Logs extends Component
{
    protected $listeners = ['logUpdated' => 'render'];

    public function render()
    {
        //set jumlah log nya maximal 100
        $logs = Log::latest()->take(100)->get();
        return view('livewire.logs', compact('logs'));
    }
}
