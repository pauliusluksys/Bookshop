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
class HomeController extends Controller
{
     public function index()
    {
        
            

    		$var='aa';
    		$book;
        		if ($var) {
           			$book=Book::where('title', 'Like', '%' . $var . '%')->get();
       			 }
    		$authorBooks = Author::find(1)->book()->get();
                 
    	
    		return view('home.index',[
            'books' => Book::simplePaginate(15)
        ]);
        

    }
    
}
