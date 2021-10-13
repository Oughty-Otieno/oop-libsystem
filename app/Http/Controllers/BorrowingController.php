<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Fine;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $data = Borrowing::orderBy('id','DESC')->paginate(5);
      return view('borrowing.index',compact('data'))
          ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $users = User::role('Member')->get();
      $books = Book::get();
      return view('borrowing.create',compact('users', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $period = 14;
      $today = Carbon::today()->toDateString();
      $this->validate($request, [
          'user_id' => 'required',
          'book_id' =>'required',
      ]);

      Borrowing::create([
        'user_id' => $request->user_id,
        'book_id' =>$request->book_id,
        'borrow_date' => $today,
        'due_date' => Carbon::parse($today)->addDays($period)->toDateString(),
        'status' =>True,
      ]);
      return redirect()->route('borrows.index')
                      ->with('success','Category created successfully');
    }

    public function clearBorrow($id){

      $borrow = Borrowing::where('id', $id)->update([
        'return_date' => Carbon::today(),
        'status' => FALSE,
      ]);

      Fine::create([
      'borrow_id' => (int)$id,
      'fine' => $this->getFine($id),
      ]);

      return redirect()->route('borrows.index')
                      ->with('success','Borrow cleared successfully');
    }

    public function getFine($id){
      $borrow = Borrowing::where('id', $id)->get();
      $rate = $borrow[0]->book->fine_amount;
      $date_due = Carbon::parse($borrow[0]->due_date);
      $today = Carbon::today();
      $overdays = 0;

      if($today > $date_due){
      $overdays = $today->diffInDays($date_due);
      } else {
      $overdays = 0;
      }

      $fine = ($rate*$overdays);
      return $fine;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function show(Borrowing $borrowing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrowing $borrowing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrowing $borrowing)
    {
        //
    }
}
