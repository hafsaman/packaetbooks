<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use Illuminate\Support\Facades\Http;

class DataController extends Controller
{
    //
     
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function index()
   {
    $response = Http::get('https://fakerapi.it/api/v1/books?_quantity=100');
   
   //$data = $response->getBody()->getContents();
   $data = $response->json();
       //$bookdatas = $data->data;
      //// dd($data['data']);
      // $bookdatas= array_column($data , 'data');
     foreach($data['data'] as $bookdata) {
       // dd($bookdata['id']);
        Books::Create([
            'id' => $bookdata['id'],
            'title' => $bookdata['title'],
            'author' => $bookdata['author'],
            'genre' => $bookdata['genre'],
            'description' => $bookdata['description'],
            'isbn' => $bookdata['isbn'],
            'image' => $bookdata['image'],
            'published' => $bookdata['published'],
            'publisher' => $bookdata['publisher'],
        ]);	 
    } 
    return view('home');
   }
}
