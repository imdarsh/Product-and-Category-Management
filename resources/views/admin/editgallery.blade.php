@extends('layout')

@section('content')
    <div class="container my-5">
        <div class="mb-3 my-5">
            <h4 class="text-center">Update Gallery Image</h4>
            <form action="/products/updategallery/{{ $image->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input class="form-control my-3" type="file" name="image" required />
                <a href="{{ url()->previous() }}" class="btn btn-primary">Cancel</a>
                <button class="btn btn-primary">Update Image</button>
            </form>
        </div>
    </div>
@endsection