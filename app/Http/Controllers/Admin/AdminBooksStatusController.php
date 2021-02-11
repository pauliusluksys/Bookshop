<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IsConfirmed;
class AdminBooksStatusController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'book_is_confirmed_type' => 'required',
         ]);
    	$isConfirmed = IsConfirmed::find($id);
        $isConfirmed->is_confirmed_type_id = $request->book_is_confirmed_type;
        
        $isConfirmed->save();
return redirect()->route('admin.books.show',['book'=>$isConfirmed->book->id])->with('success','Book has been updated successfully');
    }
}
