<?php

namespace App\Http\Livewire;

use App\Models\Rating;
use Livewire\Component;
class Ratings extends Component
{
    public $book;
    public $message;
    public $rateWindowOpen=false;
    public Rating $userRating;
    public $rating;
    public function render()
    {

        return view('livewire.ratings');
    }
    public function mount()
    {


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
