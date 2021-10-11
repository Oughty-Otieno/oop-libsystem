<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data = Book::orderBy('id','DESC')->paginate(5);
      return view('books.index',compact('data'))
          ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::get();
      return view('books.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
          'title' => 'required',
          'author' =>'required',
          'category_id' =>'required',
      ]);

      Book::create([
        'title' => $request->title,
        'author' =>$request->author,
        'category_id' =>$request->category_id,
        'code' =>'123qaws',
      ]);

      return redirect()->route('books.index')
                      ->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
      $categories = Category::get();
      return view('books.edit',compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
      $this->validate($request, [
          'title' => 'required',
          'author' =>'required',
          'category_id' =>'required',
      ]);

        Book::updateOrCreate([
        'title' => $request->title,
        'author' =>$request->author,
        'category_id' =>$request->category_id,
        'code' =>'123qaws',
      ]);

      return redirect()->route('books.index')
                      ->with('success','Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
      DB::table("books")->where('id',$book)->delete();
      return redirect()->route('books.index')
                      ->with('success','Book deleted successfully');
    }
}
