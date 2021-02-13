<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\IsConfirmed;
use App\Models\Author;
use App\Models\AuthorBook;
use Illuminate\Support\Arr;
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
        ]);

         $author_ids=[];
         $i=0;
         foreach(explode(',',$request->book_author) as $book_author){
                $author = Author::firstOrCreate(['name' => $book_author]);
                Arr::set($author_ids, $i++, $author->id);
         }
        
        
        $book = new Book;

        $book->title = $request->book_title;
        $book->description = $request->book_description;
        $book->price = 100;
        $book->user_id = Auth::user()->id;
        $book->addMediaFromRequest('book_image')->toMediaCollection('books_images');

        $book->save();

        $book->author()->attach($author_ids);
         

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
        $request->validate([
            'book_title' => 'required|max:191',
            'book_author' => 'required|max:191',
            'book_description' =>'required',
         ]);
        $book = Book::find($id);
    
        $book->title = $request->book_title;
        $book->description = $request->book_description;
        $book->author_id = 1;
        $book->user_id = Auth::user()->id;
        $book->save();
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
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('user.books.index')->with('success','Book has been deleted successfully');
    }
}
