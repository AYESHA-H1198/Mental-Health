@extends('layout.user')

@section('title', 'Medical Record')

@section('content')
<div style="max-width: 700px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 12px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
    <h2 style="color: #5a4fcf;">📝 Medical Record for Appointment #{{ $appointment->Anum }}</h2>

    <p><strong>Date:</strong> {{ $appointment->day }}</p>
    <p><strong>Time:</strong> {{ $appointment->time }}</p>

    <hr>

    <p><strong>Issue:</strong> {{ $record->issue }}</p>
    <p><strong>Medicine:</strong> {{ $record->medicine }}</p>
    <p><strong>Notes:</strong> {{ $record->notes }}</p>
</div>
@endsection
