<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

use function PHPUnit\Framework\isEmpty;

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

    public function testbooks(Request $request)
    {
        print_r($request->all()) ;
    }
}
