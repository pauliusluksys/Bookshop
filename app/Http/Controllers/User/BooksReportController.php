<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookReport;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BookReportNotification;
class BooksReportController extends Controller
{
	public function index($id)
	{

		return view('user.books.bookReport',compact('id'));
	}

	public function send($id)
	{
		
		$book=Book::find($id);
		$adminUsers=User::where('role','admin')->get();
		if($adminUsers!=NULL){
			Notification::send($adminUsers,new BookReportNotification($book));
			
			return redirect()->route('home.index')->with('success','Report has been sent');

		}
		else{
			return redirect()->route('home.index')->with('error','Something went wrong!');

		}
		
	}
}
