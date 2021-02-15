<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\IsConfirmed;
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
        return view('user.books.create');
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
        'book_genre' =>'required|max:191',
        'book_price' => 'regex:/^(\d+(.\d{1,2})?)?$/',
        ]);

         $author_ids=[];
         $i=0;
         foreach(explode(',',$request->book_author) as $book_author){
                $author = Author::firstOrCreate(['name' => $book_author]);
                Arr::set($author_ids, $i++, $author->id);
         }
         

         $l=0;
         $genre_ids=[];
         foreach(explode(',',$request->book_genre) as $book_genre){
                $genre = Genre::firstOrCreate(['name' => $book_genre]);
                Arr::set($genre_ids, $l++, $genre->id);
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

        $isConfirmed = new IsConfirmed;
        $isConfirmed->is_confirmed_type_id=1;
        $isConfirmed->book_id=$book->id;
        $isConfirmed->save();
        

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

        return view('user.books.singleBookEdit',compact('book'));
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
            'book_genre' =>'required|max:100',
            'book_price'=>'nullable|regex:/^(\d+(.\d{1,2})?)?$/',
         ]);
        $author_ids=[];
         $i=0;
        foreach(explode(',',$request->book_author) as $book_author){
                $author = Author::firstOrCreate(['name' => $book_author]);
                Arr::set($author_ids, $i++, $author->id);
         }
         $l=0;
         $genre_ids=[];
         foreach(explode(',',$request->book_genre) as $book_genre){
                $genre = Genre::firstOrCreate(['name' => $book_genre]);
                Arr::set($genre_ids, $l++, $genre->id);
         }

        $book = Book::find($id);
    
        $book->title = $request->book_title;
        $book->description = $request->book_description;
        $book->user_id = Auth::user()->id;
        $book->price = $request->book_price;
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
