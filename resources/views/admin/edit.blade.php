@extends('layout')

@section('content')
<h1 class="text-center my-5">Update Product</h1>
    <div class="container">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif
        <form method="POST" action="/products/update/{{$product->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Product Name</label><span style="color:red">*</span>
                <input value="{{ $product->product_name }}" type="text" class="form-control" name="product_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Category</label><span style="color:red">*</span>
                <select class="form-control" name="product_category" id="category">
                    @foreach($category as $cat)
                    <option value="{{ $cat->id }}"  {{ ( $cat->id == $product->product_category) ? 'selected' : '' }}>{{ $cat->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Product SubCategory</label><span style="color:red">*</span>
                <select class="form-control" name="product_subcategory" id="subcat">
                <option value="{{ $product->product_subcategory }}"> {{ $product->subcategory->subcategory }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Child Category</label><span style="color:red">*</span>
                <select class="form-control" name="product_childcategory" id="childcat">
                <option value="{{ $product->product_childcategory }}"> {{ $product->childcategory->childcategory }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Description</label><span style="color:red">*</span>
                <textarea type="text" class="form-control" name="product_description" required>{{ $product->product_description }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Colors</label><span style="color:red">*</span>
                <input value="{{ $product->product_colors }}" type="text" class="form-control" name="product_colors" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Minimum Retail Price</label><span style="color:red">*</span>
                <input value="{{ $product->product_price }}" type="text" class="form-control" name="product_price" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Discounted Price</label><span style="color:red">*</span>
                <input value="{{ $product->discounted_price }}" type="text" class="form-control" name="discounted_price" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Main Image</label>
                <input type="file" class="form-control" name="image"><span style="color:red">*</span>
                <img class="my-5" width="80" value="{{ $product->image }}" name="image" height="80" src="{{ asset('storage/'.$product->image) }}">
            </div>
            <button class="btn btn-primary mb-5">Update Product</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    jQuery(document).ready(function() {
        // $('#subcat').html('<option value="{{ $product->product_subcategory }}"> $product->subcategory->subcategory</option>');
        // $('#childcat').html('<option value="">Select Subcategory</option>');
        jQuery('#category').change(function() {
            let cat_id = jQuery(this).val();
            // alert(cat_id);
            $.ajax({
               url: '{{ url('/getsubcat') }}',
               type: 'POST',
               data: {
                cat_id: cat_id,
                _token: '{{csrf_token()}}'
               },
               dataType:'json',
               success: function(data) {
                // alert(result);
                $('#subcat').html('<option value="">Select Subcategory</option>');
                $.each(data, function(key, value) {
                    $('#subcat').append('<option value="'+value.id+'">'+value.subcategory+'</option>');
                });
               }

            })
        })
    })

    jQuery(document).ready(function() {
        jQuery('#subcat').change(function() {
            let cat_id = jQuery('#category').val();
            let subcat_id = jQuery(this).val();
            $.ajax({
               url: '{{ url('/getchildcat') }}',
               type: 'POST',
               data: {
                cat_id: cat_id,
                subcat_id: subcat_id,
                _token: '{{csrf_token()}}'
               },
               dataType:'json',
               success: function(data) {
                $('#childcat').html('<option value="">Select Childcategory</option>');
                $.each(data, function(key, value) {
                    $('#childcat').append('<option value="'+value.id+'">'+value.childcategory+'</option>');
                });
               }

            })
        })
    })
</script>
@endsection