@extends('layouts.layout')
@section('content')
    <div class="m-3">
        <div class="d-flex justify-content-center vh-100 bg-white">
           <div class="col-10 col-sm-6 col-md-4">
               <h1 class="profile-name">{{ $user->nick }}</h1>
               <div class="profile-stats">
                   <div>
                       <h5>{{$GroupsCount}}</h5>
                       <p>groups</p>
                   </div>
                   <div>
                       <h5>{{$FollowersCount}}</h5>
                       <p>Followers</p>
                   </div>
                   <div>
                       <h5>{{$FollowingCount}}</h5>
                       <p>following</p>
                   </div>
               </div>
                <!-- <div class="mb-3 row">
                    <label for="staticLogin" class="col-sm-2 col-form-label">Login</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticLogin" value="{{ auth()->user()->login }}">
                    </div>
                </div> -->
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
       </div> 
    </div>
@endsection