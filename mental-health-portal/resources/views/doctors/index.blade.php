<!DOCTYPE html>
<html>
<head>
    <title>Doctor List</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    
    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

    <h1 class="text-center text-primary mb-4">All Registered Doctors</h1>

    <!-- Search Form -->
    <form action="{{ route('doctors.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search doctor by name...">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

  <table class="table table-bordered table-hover bg-white">
    <thead class="table-primary">
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Appointments</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($doctors as $doctor)
            <tr>
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->phone }}</td>
                <td>{{ $doctor->email }}</td>
                <td>
                    <a href="{{ route('doctor.appointments', $doctor->id) }}" class="btn btn-sm btn-info">
                        View Appointments
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


    <a href="{{ route('doctors.create') }}" class="btn btn-success mt-3">➕ Add New Doctor</a>

</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
