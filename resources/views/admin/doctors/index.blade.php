<!DOCTYPE html>
<html>
<head>
    <title>Doctor List</title>

    <!-- Google Fonts & Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to right, #f9f9f9, #e3f2fd);
        }

        .search-bar {
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .card-doctor {
            border: none;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: transform 0.2s ease-in-out;
        }

        .card-doctor:hover {
            transform: translateY(-5px);
        }

        .card-body {
            padding: 1.5rem;
        }

        .doctor-actions a,
        .doctor-actions button {
            margin-right: 8px;
            border-radius: 10px;
        }

        .title-bar {
            text-align: center;
            margin-bottom: 30px;
        }

        .title-bar h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0d6efd;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 30px;
        }

        .alert {
            max-width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <!-- Back to Dashboard Button -->
    <div class="back-btn">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            ⬅ Back to Dashboard
        </a>
    </div>

    <!-- Title -->
    <div class="title-bar">
        <h1>🩺 All Registered Doctors</h1>
    </div>

    <!-- Search Form -->
    <form action="{{ route('doctors.search') }}" method="GET" class="search-bar">
        <div class="input-group shadow-sm">
            <input type="text" name="query" class="form-control" placeholder="🔍 Search doctor by name...">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Doctors Grid -->
    <div class="row mt-4">
        @forelse ($doctors as $doctor)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-doctor h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold">{{ $doctor->name }}</h5>
                        <p class="mb-1"><strong>📞 Phone:</strong> {{ $doctor->phone }}</p>
                        <p class="mb-3"><strong>✉️ Email:</strong> {{ $doctor->email }}</p>

                        <div class="doctor-actions">
                            <a href="{{ route('doctor.appointments', $doctor->DID) }}" class="btn btn-sm btn-info text-white">
                                📅 View Appointments
                            </a>

                            <form action="{{ route('doctors.destroy', $doctor->DID) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No doctors registered yet.</p>
        @endforelse
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
