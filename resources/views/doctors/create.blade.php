<!DOCTYPE html>
<html>
<head><title>Add Doctor</title></head>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<body>
    <h1>Add New Doctor</h1>

    @if($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('doctors.store') }}" method="POST">
        @csrf
        Name: <input type="text" name="name"><br><br>
        Phone: <input type="text" name="phone"><br><br>
        Email: <input type="email" name="email"><br><br>
        <button type="submit">Add Doctor</button>
    </form>

    <a href="{{ route('doctors.index') }}">Back to List</a>
</body>
</html>
