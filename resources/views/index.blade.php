@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
    </div>
</div>

<div align="center">
    <form action="{{ route('users.index') }}" method="GET" style="margin-top: 20px;">
        <select name="gender" id="input" class="col-md-1">
            <option >Select Gender</option>
            <option value="1">Man</option>
            <option value="0">Woman</option>
        </select>
        <input type="text" name="zip" placeholder="Zip Code"/>
        <input type="submit" class="btn btn-info btn-sm" value="Filter">
    </form>
</div>



@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>Name</th>
   <th>Email</th>
   <th width="500px">Action</th>
 </tr>
 @foreach($users as $user)
  <tr>
    <td>{{ $user->first_name }}</td>
    <td>{{ $user->email }}</td>
    <td>
       <a class="btn btn-info" href="/getUserProduct/{{ $user->id }}">Products</a>
       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>

<div class="mr-5">
Displaying <strong>{{$users->count()}}</strong> of <strong>{{ $users->total() }}</strong>&nbsp;Customers
</div>

{!! $users->render() !!}
@endsection
