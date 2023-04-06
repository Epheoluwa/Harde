<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    private $data;
    public function fetchbooks(Request $request)
    {
        $string = $request->name;

        try {
            $response = Http::get("https://www.anapioficeandfire.com/api/books/?name=" . $string);
            
            $jsonData = $response->json();
            if(count($jsonData) > 0)
            {
                $this->data = [];
            }
            foreach($jsonData as $js)
            {
                $this->data['name'] = $js['name'];
                $this->data['isbn'] = $js['isbn'];
                $this->data['authors'] = $js['authors'];
                $this->data['number_of_pages'] = $js['numberOfPages'];
                $this->data['publisher'] = $js['publisher'];
                $this->data['country'] = $js['country'];
                $this->data['release_date'] = date('Y-m-d', strtotime($js['released']));
            }
            
           return new JsonResponse(
             [
                "status_code" => 200,
                "status" => "success",
                'data' =>(!empty($this->data)) ? [$this->data] : [] , 
             ]
             );
        } catch (\Exception $e) {
            return new JsonResponse(
                [
                    'Message' => 'An error occured, Failed to connect to the provided endpoint. PLEASE REFRESH THE URL',
                    'response' => $e->getMessage()
                ]
                );
        }
    }

    public function fetchLocalbooks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'isbn' => 'required|unique:books',
            'authors.*' => 'nullable',
            'country' => 'required',
            'number_of_pages' => 'required',
            'publisher' => 'required',
            'release_date' => 'required',
        ]);

        if ($validator->fails()) {
            return new JsonResponse(
                [
                    'status_code' => 400,
                    'Message' => $validator->errors()->first()
                ]
            );
        }
        $data = $request->all();
        $save = Book::create($data);
        if($save)
        {
            $savedRecord = Book::Where('id',$save->id)->select('name', 'isbn', 'authors',  'number_of_pages', 'publisher', 'country', 'release_date')->first();
            return new JsonResponse(
                [
                    'status_code' => 201,
                    'status' => "success",
                    "data" => [
                        "book" => $savedRecord,
                    ]
                ]
            );
        }
    }
}
