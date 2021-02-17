<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\Confirmation;
use App\Models\Author;
use App\Models\Genre;
use App\Models\BookGenre;
use App\Models\AuthorBook;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
class UserBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::where('user_id', Auth::user()->id)->get();
        
        
        return view('user.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres= Genre::get();

        return view('user.books.create',compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
        'book_title' => 'required|max:191',
        'book_author' => 'required|max:191',
        'book_description' =>'required',
        'book_author' =>'required|max:191',
        'genres' =>'required',
        'book_price' => 'regex:/^(\d+(.\d{1,2})?)?$/',
        ]);

         $author_ids=[];
         $i=0;
         foreach(explode(',',$request->book_author) as $book_author){
                $author = Author::firstOrCreate(['name' => $book_author]);
                Arr::set($author_ids, $i++, $author->id);
         }
         

         $genre_ids=[];
         $l=0;
         foreach($request->genres as $genre){
         
         Arr::set($genre_ids, $l++,Genre::where('name', $genre)->pluck('id')->first());
         }
        
        $book = new Book;

        $book->title = $request->book_title;
        $book->description = $request->book_description;
        $book->price = $request->book_price;
        $book->user_id = Auth::user()->id;
        $book->addMediaFromRequest('book_image')->toMediaCollection('books_images');

        $book->save();
        
        $book->author()->attach($author_ids);
        $book->genre()->attach($genre_ids);

        $confirmation = new Confirmation;
        $confirmation->type='waiting';
        $confirmation->book_id=$book->id;
        $confirmation->save();
        

        return redirect()->route('user.books.index')->with('success','Book has been created successfully');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       if (! Gate::allows('update,delete-book', $id)) {
            abort(403);
        }
        $book=Book::find($id);
        //dd($book->getFirstMediaUrl('books_images'));
        
        return view('user.books.singleBook',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('update,delete-book', $id)) {
            abort(403);
        }
        $book=Book::find($id);
        $genres=Genre::all();
        return view('user.books.singleBookEdit')->with(compact('book'))->with(compact('genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('update,delete-book', $id)) {
            abort(403);
        }
        $request->validate([
            'book_title' => 'required|max:191',
            'book_author' => 'required|max:191',
            'book_description' =>'required',
            'genres' =>'required',
            'book_price'=>'nullable|regex:/^(\d+(.\d{1,2})?)?$/',
         ]);
        $author_ids=[];
         $i=0;
         foreach(explode(',',$request->book_author) as $book_author){
                $author = Author::firstOrCreate(['name' => $book_author]);
                Arr::set($author_ids, $i++, $author->id);
         }
         

         $genre_ids=[];
         $l=0;
         foreach($request->genres as $genre){
         
         Arr::set($genre_ids, $l++,Genre::where('name', $genre)->pluck('id')->first());
         }

        $book = Book::find($id);
    
        $book->title = $request->book_title;
        $book->description = $request->book_description;
        $book->user_id = Auth::user()->id;
        $book->price = $request->book_price*100;
        $book->save();
        $book->author()->sync($author_ids);
        $book->genre()->sync($genre_ids);
return redirect()->route('user.books.show',['book'=>$book->id])->with('success','Book has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (! Gate::allows('update,delete-book', $id)) {
            abort(403);
        }
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('user.books.index')->with('success','Book has been deleted successfully');
    }
}
