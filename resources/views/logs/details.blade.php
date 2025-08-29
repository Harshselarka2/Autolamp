@extends('layouts.app')

@section('title', "ESP Logs for $year-$month-$date")

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">ESP Logs for {{ $year }}-{{ $month }}-{{ $date }} (ESP ID: {{ $esp_id }})</h2>

    <div class="table-responsive">
        <table class="table table-hover table-bordered shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">Timestamp</th>
                    <th class="text-center">Object Detected</th>
                    <th class="text-center">Lamp Turned On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td class="text-center">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        <td class="text-center">
                            <span class="badge {{ $log->object_detected ? 'bg-success' : 'bg-danger' }}">
                                {{ $log->object_detected ? 'Yes' : 'No' }} ({{ $log->object_detected }})
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $log->lamp_turned_on ? 'bg-warning text-dark' : 'bg-secondary' }}">
                                {{ $log->lamp_turned_on ? 'Yes' : 'No' }} ({{ $log->lamp_turned_on }})
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
