@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Products</h2>
        </div>
        @if(Auth::user()->role_id == 2)
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
        </div>
        @endif
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
        <th>Details</th>
        @if(Auth::user()->role_id == 2)
        <th width="280px">Action</th>
        @endif
    </tr>
  @foreach ($products as $product)
  <tr>
      <td>{{ $product->name }}</td>
      <td>{{ $product->detail }}</td>
      @if(Auth::user()->role_id == 2)
      <td>
            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
      </td>
      @endif
  </tr>
  @endforeach
</table>


{!! $products->links() !!}

@endsection
