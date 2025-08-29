@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-4">📅 Logs for {{ $year }}</h2>
    
    @if($months->isEmpty())
        <div class="alert alert-warning text-center mt-4">No data available for this year.</div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            @foreach ($months as $month)
                <div class="col">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ \Carbon\Carbon::create()->month($month->month)->format('F') }}</h5>
                            <p class="card-text">
                                📌 Total Objects: <strong>{{ $month->object_count }}</strong><br>
                                💡 Lamp Activations: <strong>{{ $month->lamp_count }}</strong>
                            </p>
                            <a href="{{ route('logs.dates', ['year' => $year, 'month' => $month->month]) }}" class="btn btn-primary">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
