@extends('layout.user')

@section('title', 'User Login')

@section('content')
    <h2>User Login</h2>

    @if (session('error'))
        <div class="message error">{{ session('error') }}</div>
    @endif
    @if (session('success'))
        <div class="message success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('user.login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
@endsection
