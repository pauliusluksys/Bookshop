<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(){
        //return Book::all();
            return BookResource::collection(Book::paginate());


    }
    public function show(Book $book){
        return new BookResource($book);

    }
}
