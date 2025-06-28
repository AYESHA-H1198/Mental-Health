@extends('layout.user')

@section('title', 'User Registration')

@section('content')
    <h2>User Registration</h2>

    @if ($errors->any())
        <div class="message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('user.register') }}">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="email" name="email" placeholder="Email (used as username)" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
@endsection
