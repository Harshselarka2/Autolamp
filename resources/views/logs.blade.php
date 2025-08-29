@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Auto Lamp Logs</h2>

    <!-- Years List -->
    <div class="list-group">
        @foreach($years as $year)
            <a href="{{ route('logs.months', $year) }}" class="list-group-item list-group-item-action ajax-link">
                {{ $year }}
            </a>
        @endforeach
    </div>

    <!-- Content will load dynamically here -->
    <div id="content" class="mt-4"></div>
</div>

<!-- AJAX Script for Dynamic Loading -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".ajax-link").forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                let url = this.href;
                
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById("content").innerHTML = html;
                    })
                    .catch(error => console.error('Error loading content:', error));
            });
        });
    });
</script>
@endsection
