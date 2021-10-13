@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Borrowing Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('borrows.create') }}"> Create a Borrowing</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>Name</th>
   <th>Book Title</th>
   <th>Date Borrowed</th>
   <th>Due Date</th>
   <th>Fine</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $borrow)
  <tr>
    <td>{{ $borrow->user->name }}</td>
    <td>{{ $borrow->book->title }}</td>
    <td>{{ $borrow->borrow_date}}</td>
    <td>{{ $borrow->due_date}}</td>
    <td>50</td>
    <td>
       <a class="btn btn-info" href="{{ route('borrow.clear',$borrow->id) }}">Clear</a>
    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}

@endsection
