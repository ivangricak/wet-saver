@extends('layouts.layout')
@section('content')
    <div class="section">
        <div class="main-block" onclick="location.href='{{ route('home.index') }}'" oncontextmenu="return false;">
            <img src="/frame1.png" alt="">
        </div>
        <div class="blog small-block" onclick="location.href='{{ route('home.blog') }}'" oncontextmenu="return false;">
            <img src="/frame2.png" alt="">
        </div>
        <div class="about small-block" onclick="location.href='{{ route('home.about') }}'">
            <p class="block-title">DISCOVER <br> OUR HISTORY</p>
            <p class="text-btn-block">About us</p>
        </div>
        <div class="contact small-block" onclick="location.href='{{ route('home.contact') }}'">
            <p class="block-title">HAVE SOME <br> QUESTIONS?</p>
            <p class="text-btn-block">Contact us</p>
        </div>
    </div>
@endsection