<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Models\Confirmation;
use App\Models\Author;
use App\Models\Genre;

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
        $books=Book::with('authors','confirmation','genres')->where('user_id', Auth::user()->id)->Paginate();


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
        'genres' =>'required',
        'book_price' => 'regex:/^\d+([.,]\d{1,2})?$/',
        'book_image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

         $price=str_replace(',', '.', $request->book_price);

         $book = Book::create([
            'title' => $request->book_title,
            'description' => $request->book_description,
            'user_id' => Auth::id(),
            'price' =>$price,

        ]);


         foreach(explode(',',$request->book_author) as $book_author){
                $author = Author::firstOrCreate(['name' => $book_author]);
                //Arr::set($author_ids, $i++, $author->id);
                $book->authors()->attach($author->id);

         }



         foreach($request->genres as $genre){

         $genreId=Genre::where('name', $genre)->pluck('id')->first();
         $book->genres()->attach($genreId);
         }


        $book->addMediaFromRequest('book_image')->toMediaCollection('books_images');




        $confirmation = Confirmation::create([

        'type'=>'waiting',
        'book_id'=>$book->id,

        ]);

        $books=Book::all();
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
            'book_title' => 'required|min:5|max:191',
            'book_author' => 'required|min:5|max:191',
            'book_description' =>'required|min:10',
            'genres' =>'required',
            'book_price'=>'required|regex:/^\d+([.,]\d{1,2})?$/',
         ]);


        $book = Book::find($id);
            $book->title = $request->book_title;
            $book->description = $request->book_description;
            $book->price = $request->book_price;
            $book->save();
        ;


         foreach(explode(',',$request->book_author) as $book_author){
                $author = Author::firstOrCreate(['name' => $book_author]);
                $authorId=$author->id;
                $book->authors()->sync($authorId);
         }



         foreach($request->genres as $genre){
         $genreId=Genre::where('name',$genre)->first();
         $book->genres()->sync($genreId->id);
         }





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
