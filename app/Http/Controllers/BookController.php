<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use Image, File;

class BookController extends Controller
{
  
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
        $books = Books::orderBy('id','desc')->paginate(5);
        
        return view('books.index')->compact('books');
        
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('books.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'genre' => 'required',
            'isbn' => 'required',
            'published' => 'required',
            'publisher' => 'required',
        ]);
       
        $image_name = uniqid() . '.' . $data['image']->getClientOriginalExtension();
        $image_path = 'uploads/' . $image_name;
        Image::make($data['image'])->resize(320, 240)->save(public_path($image_path));
        $data['image'] = $image_path;
   
        Books::create($data);

        return redirect()->route('books.index')->with('success','book has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\book  $book
    * @return \Illuminate\Http\Response
    */
    public function show(Book $book)
    {
        return view('books.show',compact('book'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\book  $book
    * @return \Illuminate\Http\Response
    */
    public function edit(Book $book)
    {
        return view('books.edit',compact('book'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\book  $book
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',

        ]);
        if ($request->has('image')) {
            unlink(public_path($blog->image));
            $image_name = uniqid() . '.' . $data['image']->getClientOriginalExtension();
            $image_path = 'uploads/' . $image_name;
            Image::make($data['image'])->resize(320, 240)->save(public_path($image_path));
            $data['image'] = $image_path;
        } else {
            $data['image'] = $blog->image;
        }

        $book->update($data);


       // $book->fill($request->post())->save();

        return redirect()->route('books.index')->with('success','book Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\book  $book
    * @return \Illuminate\Http\Response
    */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success','book has been deleted successfully');
    }
}

