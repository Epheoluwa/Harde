<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class FrontEndBookController extends Controller
{
    public function index()
    {
        $data = Book::get();
        return view('welcome', compact('data'));
    }

    public function deleterecord($id)
    {
        $delete = Book::where('id', $id)->delete();
        if($delete)
        {
            return redirect()->route('index')->with('message','Book record deleted Successfully');
        }else{
            return redirect()->route('index')->with('error','Something went wrong, Please try again');
        }
    }
}
