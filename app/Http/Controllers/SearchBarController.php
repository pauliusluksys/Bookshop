<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class SearchBarController extends Controller
{
    public function index(Request $request)
    {

    	
        $search = $request->input('search');
        $books = Book::confirmed()->where( function($query) use ($search) {
            $query->where('title','LIKE','%'.$search.'%');
            $query->orWhereHas('authors' ,function($query) use ($search) {
                $query->where('name', 'LIKE','%'.$search.'%');
            });

            })->simplepaginate();


        return view('home.index')->with('books', $books);
    
    
        
        
        
        
       
    }
    
}
