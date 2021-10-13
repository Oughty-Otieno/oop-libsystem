@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Borrowing Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('spaces.create') }}">Book a Space</a>
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
   <th>Date</th>
   <th>Entry Token</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $space)
  <tr>
    <td>{{ $space->date }}</td>
    <td>{{ $space->token }}</td>
    <td>
       <a class="btn btn-info" href="#">Check Details</a>
    </td>
  </tr>
 @endforeach
</table>


{!! $data->render() !!}

@endsection
