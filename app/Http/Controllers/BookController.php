<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        //$authorBooks = Author::find(1)->book()->get();
        $books=Book::with('authors')->confirmed()->simplePaginate();
        
        return view('home.index',compact('books'));
    }

   
    public function show($id)
    {
        
     
        $book=Book::with('ratings','authors','genres')->find($id);
        $avgRating=$book->ratings->avg('rating');
        //dd($avgRating);
        //dd($book->getFirstMediaUrl('books_images'));
        
        return view('home.singleBook',compact('book'));
        
    }

    
}
