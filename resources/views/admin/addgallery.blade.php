@extends('layout')

@section('content')
    <div class="container my-5">
        <div class="h4 text-center">Add Gallery Image</div>
        <form method="POST" action="/products/storegalleryimage/{{ $product_id }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Gallery Images</label>
                <input type="file" name="images[]" class="form-control" multiple required>
            </div>
            <button class="btn btn-primary">Add Gallery Image</button>
        </form>
    </div>
@endsection