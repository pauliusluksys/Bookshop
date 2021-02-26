<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Ratings extends Component
{
    public $book;
    public $message;
    public function render()
    {

        return view('livewire.ratings');
    }
}
