<h2>Available Doctors</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Book</th>
    </tr>
    @foreach($doctors as $doctor)
    <tr>
        <td>{{ $doctor->name }}</td>
        <td>{{ $doctor->phone }}</td>
        <td>{{ $doctor->email }}</td>
        <td><a href="#">Book Appointment</a></td> {{-- we'll link this soon --}}
    </tr>
    @endforeach
</table>
