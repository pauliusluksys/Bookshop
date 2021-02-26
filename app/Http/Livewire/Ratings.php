<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Ratings extends Component
{
    public $book;
    public $message;
    public $rateWindowOpen=false;
    public function render()
    {

        return view('livewire.ratings');
    }
    public function showRateWindow(){
    if($this->rateWindowOpen===false) {
        $this->rateWindowOpen=true;
    }
    else{
        $this->rateWindowOpen=false;
    }

    }
}
