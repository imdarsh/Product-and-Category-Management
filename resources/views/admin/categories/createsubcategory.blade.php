@extends('layout')

@section('content')
<div class="container my-5">
    <form method="POST" action="/subcategory/store" enctype="multipart/form-data">
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
                <select name="category_id" class="form-control">
                    @foreach($category as $cat)
                        <option value="{{ $cat->id }}" name="cat_id">{{ $cat->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Sub Category</label>
                <input type="text" class="form-control" name="subcategory" required>
            </div>
            <button class="btn btn-primary">Create Sub Category</button>
    </form>
</div>
@endsection