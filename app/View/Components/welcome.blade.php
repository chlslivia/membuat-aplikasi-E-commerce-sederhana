@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-pink-50">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-pink-600 mb-6">Selamat datang di Shoppinks ♡</h1>
        <p class="text-gray-600 mb-8">Silakan login untuk mulai belanja makeup favoritmu!</p>

        <div class="flex gap-4 justify-center">
            <a href="{{ route('login') }}" class="btn-pink">Login</a>
            <a href="{{ route('register') }}" class="btn-pink">Register</a>
        </div>
    </div>
</div>
@endsection