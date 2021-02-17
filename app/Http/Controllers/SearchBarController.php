<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class SearchBarController extends Controller
{
    public function index(Request $request)
    {

    	
        $search = $request->input('search');
        $books = Book::where( function($query) use ($search) {
            $query->where('title','LIKE','%'.$search.'%');
            $query->orWhereHas('author' ,function($query) use ($search) {
                $query->where('name', 'LIKE','%'.$search.'%');
            });
            })->paginate(25);
        return view('home.index')->with('books', $books);
    
    
        
        
        
        
       
    }
    
}
