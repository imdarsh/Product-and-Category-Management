@extends('layout')

@section('content')
    <h1 class="text-center my-5">Create Product</h1>

    <div class="container">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif
    <form method="POST" action="/products" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Product Name</label><span style="color:red">*</span>
                <input type="text" value="{{ old('product_name') }}" class="form-control" name="product_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Category</label><span style="color:red">*</span>
                <select name="product_category" id="category" class="form-control">
                    <option value="">Select Product Category</option>
                    @foreach($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                    @endforeach
                </select>
                <!-- <input type="text" value="{{ old('product_category') }}" class="form-control" name="product_category" required> -->
            </div>
            <div class="mb-3">
                <label class="form-label">Product SubCategory</label><span style="color:red">*</span>
                <select id="subcat" name="product_subcategory" class="form-control">
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Product ChildCategory</label><span style="color:red">*</span>
                <select id="childcat" name="product_childcategory" class="form-control">
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Description</label><span style="color:red">*</span>
                <textarea rows="5" type="text" value="{{ old('product_description') }}" class="form-control" name="product_description" required>{{ old('product_description') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Colors</label><span style="color:red">*</span>
                <input type="text" value="{{ old('product_colors') }}" class="form-control" name="product_colors" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Minimum Retail Price</label><span style="color:red">*</span>
                <input type="text" value="{{ old('product_price') }}" class="form-control" name="product_price" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Discounted Price</label><span style="color:red">*</span>
                <input type="text" value="{{ old('discounted_price') }}" class="form-control" name="discounted_price" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Main Image</label><span style="color:red">*</span>
                <input type="file" class="form-control" value="{{ old('image') }}" name="image" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Gallery Images</label>
                    <input type="file" name="images[]" class="form-control" multiple>
            </div>
            <button class="btn btn-primary mb-5">Add Product</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    jQuery(document).ready(function() {
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