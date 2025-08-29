@extends('layouts.app')

@section('title', "ESP Data for $year-$month-$date")

@section('content')
<div class="container">
    <h2 class="mb-4">ESP Data for {{ $year }}-{{ $month }}-{{ $date }}</h2>
    <div class="row">
        @foreach($esps as $esp)
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">ESP ID: {{ $esp->esp_device_id }}</h5>
                        <p class="card-text">
                            <strong>Object Detected:</strong> {{ $esp->total_detections }} <br>
                            <strong>Lamp Turned On:</strong> {{ $esp->total_lamp_on }}
                        </p>
                        <a href="{{ route('logs.details', [$year, $month, $date, $esp->esp_device_id]) }}" class="btn btn-primary">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
