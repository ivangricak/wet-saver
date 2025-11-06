@extends('layouts.layout')
@section('content')
<div class="d-flex justify-content-center vh-100 bg-light">
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
            <input type="text" readonly class="form-control-plaintext" id="staticLogin" value="{{ $user->login }}">
        </div>
    </div> -->
    @auth
        <div id="follow-block" data-user-id="{{ $user->id }}">
            @if(auth()->id() !== $user->id)
                <button id="follow-btn" class="{{ $isFollowing ? 'following' : 'follow' }}-btn">
                    {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                </button>
            @endif
        </div>
    @endauth
</div>


<!-- <div class="d-flex justify-content-center vh-100 bg-light">
    <div class="col-10 col-sm-6 col-md-4">
        <div class="profile-stats">
            <div>
            <h5>14</h5>
            <p>groups</p>
            </div>
            <div>
            <h5>1,029</h5>
            <p>Followers</p>
            </div>
            <div>
            <h5>228</h5>
            <p>following</p>
            </div>
        </div>
        <button class="follow-btn">follow</button>
    </div>
</div> -->



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const followBtn = document.getElementById('follow-btn');
        if (!followBtn) return;
        const userId = document.getElementById('follow-block').dataset.userId;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        followBtn.addEventListener('click', async function () {
            if (this.textContent.trim() === 'Follow') {
                // POST follow
                const res = await fetch(`/follow/${userId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                });
                if (res.ok) {
                    this.textContent = 'Unfollow';
                    this.classList.remove('follow-btn');
                    this.classList.add('following-btn');
                } else {
                    console.error('Follow failed');
                }
            } else {
                // DELETE unfollow
                const res = await fetch(`/follow/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                });
                if (res.ok) {
                    this.textContent = 'Follow';
                    this.classList.remove('following-btn');
                    this.classList.add('follow-btn');
                } else {
                    console.error('Unfollow failed');
                }
            }
        });
    });
</script>
@endsection