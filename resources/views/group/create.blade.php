@extends('layouts.layout')
@section('content')
    <form action="{{route('groups.create')}}" method="post" class="p-2">
        @csrf
        <div class="mb-3">
            <label for="nameinput" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="name">
        </div>
        <label for="category_selector" class="form-label">State:</label>
        <select class="form-select mb-2" aria-label="Default select example" name="state">
                <option value="1">Public</option>
                <option value="0">Private</option>
        </select>
        <label for="category_selector" class="form-label">Categories</label>
        <select class="form-select" aria-label="Default select example" name="category_id">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-success m-2">Success</button>
    </form>
@endsection()