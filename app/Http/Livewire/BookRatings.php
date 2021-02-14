<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Rating;

class BookRatings extends Component
{
    public $rating;
    public $comment;
    public $currentId;
    public $book;
    public $hideForm;

    protected $rules = [
        'rating' => ['required', 'in:1,2,3,4,5'],
        'comment' => 'required',

    ];

    public function render()
    {
        $comments = Rating::where('book_id', $this->book->id)->where('status', 1)->with('user')->get();
        return view('livewire.book-ratings', compact('comments'));
    }

    public function mount()
    {
        if(auth()->user()){
            $rating = Rating::where('user_id', auth()->user()->id)->where('book_id', $this->book->id)->first();
            if (!empty($rating)) {
                $this->rating  = $rating->rating;
                $this->comment = $rating->comment;
                $this->currentId = $rating->id;
            }
        }
        return view('livewire.book-ratings');
    }

    public function delete($id)
    {
        $rating = Rating::where('id', $id)->first();
        if ($rating && ($rating->user_id == auth()->user()->id)) {
            $rating->delete();
        }
        if ($this->currentId) {
            $this->currentId = '';
            $this->rating  = '';
            $this->comment = '';
        }
    }

    public function rate()
    {
        $rating = Rating::where('user_id', auth()->user()->id)->where('book_id', $this->book->id)->first();
        $this->validate();
        if (!empty($rating)) {
            $rating->user_id = auth()->user()->id;
            $rating->book_id = $this->book->id;
            $rating->rating = $this->rating;
            $rating->comment = $this->comment;
            $rating->status = 1;
            try {
                $rating->update();
            } catch (\Throwable $th) {
                throw $th;
            }
            session()->flash('message', 'Success!');
        } else {
            $rating = new Rating;
            $rating->user_id = auth()->user()->id;
            $rating->book_id = $this->book->id;
            $rating->rating = $this->rating;
            $rating->comment = $this->comment;
            $rating->status = 1;
            try {
                $rating->save();
            } catch (\Throwable $th) {
                throw $th;
            }
            $this->hideForm = true;
        }
    }
}