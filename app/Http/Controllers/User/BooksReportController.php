<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookReport;
use Illuminate\Support\Facades\Auth;
class BooksReportController extends Controller
{
	public function index($id)
	{

		return view('user.books.bookReport',compact('id'));
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'report_book_message' => 'required',
			'report_book_id' => 'required',
		]);


		$report = new BookReport;

		$report->book_id = $request->report_book_id;
		$report->user_id = Auth::id();
		$report->message = $request->report_book_message;

		$report->save();
		return redirect()->route('user.books.index')->with('success','Report has been sent');
	}
}
