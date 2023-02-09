<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BookSearchController extends Controller
{
    public function index()
        {
             return view('books');
        }
     
    public function searchBook(Request $request)
        {
    
         $search = $request->ussearcherid;
    
         $books = Books::sortable()
         ->where('books.title', 'like', '%'.$search.'%')
         ->paginate(5);
    
         // Fetch all records
         $response['data'] = $books;
    
         return response()->json($response);
       }
}
