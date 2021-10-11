@extends('layouts.main')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Books Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('books.create') }}"> Create Books</a>
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
   <th>No</th>
   <th>Title</th>
   <th>Author</th>
   <th>Code</th>
   <th>Category</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $book)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $book->title }}</td>
    <td>{{ $book->author }}</td>
    <td>UniqueCode</td>
    <td>{{ $book->category->name}}</td>
    <td>
       <a class="btn btn-info" href="{{ route('books.show',$book) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('books.edit',$book) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['books.destroy', $book->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}


<p class="text-center text-primary"><small>Tutorial by GateForLearner.com</small></p>
@endsection
