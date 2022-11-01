@extends('layout')

@section('content')
<div class="container my-5">
    <form method="POST" action="/category/store" enctype="multipart/form-data">
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
                <input type="text" class="form-control" name="category" required>
            </div>
            <button class="btn btn-primary">Create Category</button>
    </form>
</div>
@endsection