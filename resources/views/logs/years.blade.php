@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Select Year</h2>
    <ul class="list-group">
        @foreach($years as $year)
            <li class="list-group-item">
                <a href="{{ route('logs.months', ['year' => $year->year]) }}" class="text-decoration-none">
                    {{ $year->year }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
