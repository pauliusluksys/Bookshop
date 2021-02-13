<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserHomeController extends Controller
{
    public function index()
    {
    	//$role = Role::create(['name' => 'user']);
    	//$permission = Permission::create(['name' => 'edit books']);
    	$role = Role::findById(1);
    	$permission = Permission::findById(1);
    	$role->givePermissionTo($permission);

    	$var='aa';
    	$book;
        if ($var) {
            $book=Book::where('title', 'Like', '%' . $var . '%')->get();
        }
    	$authorBooks = Author::find(1)->book()->get();
                 
    	
    	return view('user.home.index',[
            'books' => Book::simplePaginate(15)
        ]);


    }
}
