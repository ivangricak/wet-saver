@extends('layouts.layout')
@section('content')
    <div class="m-3">
        <h1 class="text-center">Profile</h1>
        <div class="mb-3 row">
            <label for="staticLogin" class="col-sm-2 col-form-label">Login</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticLogin" value="{{ auth()->user()->login }}">
            </div>
        </div>
        <div class="mb-3 row">
            <form action="{{ route('profile.update', auth()->user()->id ?? 0) }}" method="post">
                @csrf
                @method('PATCH')
                <label for="nick" class="col-sm-2 col-form-label">Nick</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nick" name="nick" value="@auth {{ auth()->user()->nick}} @endauth">
                </div>
                <button type="submit" class="btn btn-primary mt-3">UpDate</button>
            </form>
        </div>
    </div>
@endsection