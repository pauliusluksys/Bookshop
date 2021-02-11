<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
class AdminBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::get();
        return view('admin.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.books.create');
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
        ]);


        $book = new Book;

        $book->title = $request->book_title;
        $book->description = $request->book_description;
        $book->confirmed = 0;
        $book->author_id = 1;
        $book->user_id = Auth::user()->id;
        $book->save();

        return redirect()->route('admin.books.index')->with('success','Book has been created successfully');
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
        
        return view('admin.books.singleBook',compact('book'));
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

        return view('admin.books.singleBookEdit',compact('book'));
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
return redirect()->route('admin.books.show',['book'=>$book->id])->with('success','Book has been updated successfully');
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
        return redirect()->route('admin.books.index')->with('success','Book has been deleted successfully');
    }
}
