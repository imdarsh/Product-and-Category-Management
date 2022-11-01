@extends('layout')

@section('content')
<div class="container my-5">
    <form method="POST" action="/childcategory/store" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select id="category" name="cat_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($category as $cat)
                        <option  value="{{ $cat->id }}" name="cat_id">{{ $cat->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Sub Category</label>
                <select name="subcat_id"  class="form-control" id="subcat" required></select>
            </div>
            <div class="mb-3">
                <label class="form-label">Child Category</label>
                <input type="text"  name="childcategory" class="form-control" required>
            </div>
            <button class="btn btn-primary">Create Sub Category</button>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    jQuery(document).ready(function() {
        $('#subcat').html('<option value="">Select Subcategory</option>');
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
</script>
@endsection