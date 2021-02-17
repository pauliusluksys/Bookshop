<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Confirmation;
class AdminBooksStatusController extends Controller
{
	public function update(Request $request, $id)
	{
		$request->validate([
			'book_confirmation_type' => 'required',
		]);
		$confirmation = Confirmation::find($id);
		$confirmation->type = $request->book_confirmation_type;
		
		$confirmation->save();
		return redirect()->route('admin.books.show',['book'=>$confirmation->book->id])->with('success','Book has been updated successfully');
	}
}
