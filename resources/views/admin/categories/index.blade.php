@extends('layout')

@section('content')
<div class="container my-5">
    <a href="/" class="btn btn-primary my-2">Go Back</a>
    <a href="/category/create" class="btn btn-primary my-2">Create Category</a>
    <a href="/subcategory/create" class="btn btn-primary my-2">Create Sub-Category</a>
    <a href="/childcategory/create" class="btn btn-primary my-2">Create ChildCategory</a>
        <h4>Category</h4>
    @foreach($category as $cat)
       <p> {{ $cat->category }}</p>
    @endforeach
    <hr />
    <h4>Sub Category</h4>
    @foreach($subcategory as $cat)
       <p>{{ $cat->category->category }} => {{ $cat->subcategory }}</p>
    @endforeach
    <hr />
    <h4>Child Category</h4>
    @foreach($childcategory as $cat)
       <p>{{ $cat->category->category }} => {{ $cat->subcategory->subcategory }} => {{ $cat->childcategory }}</p>
    @endforeach

</div>
@endsection