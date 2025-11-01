@extends('layouts.layout')
@section('content')
    <div class="m-3">
        <h1 class="text-center">Profile</h1>
        <div class="mb-3 row">
            <label for="staticLogin" class="col-sm-2 col-form-label">Login</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticLogin" value="{{ $user->login }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nick" class="col-sm-2 col-form-label">Nick</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="nick" name="nick" value="{{ $user->nick}}">
            </div>
        </div>
    </div>
@endsection