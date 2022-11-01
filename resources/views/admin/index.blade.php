@extends('layout')

@section('content')
    <h1 class="text-center my-5">Products</h1>
    <div class="container mb-5">
        <a href="/products/create" class="btn btn-primary mb-5">Add Product</a>
        <a href="/category" class="btn btn-primary mb-5">Category</a>
        @if(count($products) > 0)
        <div class="table-responsive">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">Product Image</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Category</th>
            <th scope="col">Product SubCategory</th>
            <th scope="col">Product ChildCategory</th>
            <th scope="col">Product Description</th>
            <th scope="col">Product Colors</th>
            <th scope="col">Product MRP</th>
            <th scope="col">Product Discounted Price</th>
            <th scope="col">View</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach($products as $product)
            <tr>
                <td><img width="50" height="50" src="{{ asset('storage/'.$product->image) }}" /></td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->category->category }}</td>
                <td>{{ $product->subcategory->subcategory }}</td>
                <td>{{ $product->childcategory->childcategory }}</td>
                <td>{{ substr($product->product_description,0,15) }}...</td>
                <td>{{ $product->product_colors }}</td>
                <td>{{ $product->product_price }}</td>
                <td>{{ $product->discounted_price }}</td>
                <td><a href="/products/details/{{$product->id}}" class="btn btn-primary">View</a></td>
                <td><a href="/products/edit/{{$product->id}}" class="btn btn-primary">Edit</a></td>
                <td><a href="/products/delete/{{$product->id}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
        </table>
        </div>
        @else
            <div class="h3 text-center">No Product Found</div>
        @endif
    </div>
@endsection