@extends('layouts.layout')
@section('content')
    <form action="{{route('item.create')}}" method="post" class="p-2">
        @csrf
        <div class="mb-3">
            <label for="nameinput" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="name">
        </div>
        <label for="category_selector" class="form-label">Tags</label>
        <select name="tags[]" class="form-select" multiple aria-label="multiple select example">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        <label for="category_selector" class="form-label">Groups</label>
        <select class="form-select" id="category_selector" name="group_selector">
            <!-- <option value="" selected>-- Select group --</option> -->
            @foreach($defgroups as $defgroup)
                <option value="{{$defgroup->id}}" data-type="def"> {{$defgroup->name}} </option>
            @endforeach
            @foreach($groups as $group)
                <option value="{{$group->id}}" data-type="normal"> {{$group->name}} </option>
            @endforeach
        </select>
        <input type="hidden" name="default_group_id" id="def_group_id" value="">
        <input type="hidden" name="group_id" id="group_id" value="">
        <div class="mb-3">
            <label for="linkinput" class="form-label">link</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="link" placeholder="link">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <textarea class="form-control" id="description" rows="3" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-success m-2">Success</button>
    </form>
@endsection()