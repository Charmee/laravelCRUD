
@extends('layout.app')
@section('content')
<div class="container mt-5">
  <h2>Basic Table</h2>
  <p><a class="btn btn-primary" href="{{ route('products.create') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Add Products</a></p>            
  <table class="table">
    <thead>
      <tr>
        <th>name</th>
        <th>quantity</th>
        <th>rate</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    @forelse($products as $product)
      <tr>
      <td>{{ $product->name }}</td>
       <td>{{ $product->quantity }}</td>
       <td>{{ $product->rate }}</td>
       <td> 
       <form action="{{ route('products.destroy',$product->id) }}" method="Post">
        <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>    
       
      </tr>
      @empty
      <tr>
          <td colspan="3">There are no issues</td>
      </tr>
        @endforelse
    </tbody>
  </table>
  <div class="d-flex justify-content-center" >
      
  {!! $products->links() !!}
</div>
<p><input type="text" name="net_amount" placeholder="Net Amount" value="{{ $netamount }}" readonly> </p>

</div>
@endsection

