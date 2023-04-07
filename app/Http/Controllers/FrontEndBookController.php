<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function editrecord(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'isbn' => 'required',
            'authors' => 'required',
            'country' => 'required',
            'number_of_pages' => 'required',
            'publisher' => 'required',
            'release_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('index')->with('error',$validator->errors()->first());
        }
        $data = $request->except('_token','_method');
        $update = Book::whereId($id)->update($data);
        if($update)
        {
            return redirect()->route('index')->with('message','Book record updated Successfully');
        }
    }
}
