@extends('layout')

@section('content')
    <div class="container">
        <a href="/" class="btn btn-primary mt-5">Back</a>
        <div class="h3 text-center my-5">Product Details</div>
        <div class="text-center my-5">
            <img src="{{ asset('storage/'.$product->image) }}" width="300" />
        </div><hr />
        <p><b>Product Name:</b> {{ $product->product_name }}</p><hr />
        <p><b>Product Category:</b> {{ $product->product_category }}</p><hr />
        <p><b>Product SubCategory:</b> {{ $product->product_subcategory }}</p><hr />
        <p><b>Product ChildCategory:</b> {{ $product->product_childcategory }}</p><hr />
        <p><b>Product Description:</b> {{ $product->product_description }}</p><hr />
        <p><b>Product Color:</b> {{ $product->product_colors }}</p><hr />
        <p><b>Product MRP:</b> {{ $product->product_price }}</p><hr />
        <p><b>Product Discounted Price:</b> {{ $product->discounted_price }}</p><hr />
        <h4 class="mt-5">Gallery Images</h4>
<<<<<<< HEAD
=======
        <a class="btn btn-primary" href="/products/addgalleryimage/{{ $product->id }}">Add Gallery Image</a>
>>>>>>> 2dda92a (Product and Category Management)
        <div class="row">
                @if($images)
                @foreach($images as $img)
                <div class="col border m-2 p-2 text-center shadow">
                    <img src="{{ asset('storage/'.$img->image) }}" width="300" height="300" />
                    <p><a class="btn btn-primary my-2 btn-sm" href="/products/editgallery/{{ $img->id }}">Edit Image</a> 
                    <a class="btn btn-primary my-2 btn-sm" href="/products/deletegallery/{{ $img->id }}">Delete Image</a></p>
                    
                </div>
                @endforeach
                @else
                <p class="text-center my-5">No Gallery Images</p>
                @endif
            </div>
    </div>
@endsection