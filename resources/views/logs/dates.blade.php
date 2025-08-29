@extends('layouts.app')

@section('title', 'Daily Reports - ' . $year . '-' . $month)

@section('content')
<div class="container">
    <h2 class="mb-4">Daily Reports for {{ date("F", mktime(0, 0, 0, $month, 1)) }} {{ $year }}</h2>
    
    <div class="row">
        @foreach($dates as $date)
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">📅 {{ $date->date }}</h5>
                        <p class="card-text">
                            <strong>📊 Object Detected:</strong> {{ $date->object_count }} <br>
                            <strong>💡 Lamp Turned On:</strong> {{ $date->lamp_count }}
                        </p>
                        <a href="{{ route('logs.esps', [$year, $month, $date->date]) }}" class="btn btn-primary">
                            🔍 View ESP Data
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
