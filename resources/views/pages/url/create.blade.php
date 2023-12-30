@extends('layouts.master')

@section('content')
<div class="container" style="margin-top: 20px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('URL Shortener') }}</div>

                <div class="card-body">
                    <form method="POST" id="shortenForm">
                        @csrf

                        <div class="form-group">
                            <label for="original_url">{{ __('Original URL') }}</label>
                            <input type="text" class="form-control" id="original_url" name="original_url" required>
                        </div>

                        <button type="button" class="btn btn-primary" id="shortenUrlBtn">
                            {{ __('Shorten URL') }}
                        </button>
                    </form>

                    <div class="mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Original URL</th>
                                    <th>Shortened URL</th>
                                    <th>Clicks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="urlList">
                                @foreach($urls as $info)
                                <tr>
                                    <td>{{ $info->original_url }}</td>
                                    <td> {{ url($info->short_url) }}</td>
                                    <td>{{ $info->clicks }}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="copyToClipboard('{{url($info->short_url) }}')">Copy Link</button>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- Display the shortened URLs here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var baseUrl = '{{ url("/") }}';
    console.log("baseUrl", baseUrl)

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('shortenUrlBtn').addEventListener('click', shortenUrl);
    });

    function shortenUrl() {
        var originalUrlInput = document.getElementById('original_url');
        var originalUrl = originalUrlInput.value;
        var data = {
            original_url: originalUrl,
            _token: '{{ csrf_token() }}'
        };


        // Make an AJAX request to shorten the URL
        $.ajax({
            url: "{{ route('shorten-urls.store') }}",
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                console.log("response", response)
                var urlList = document.getElementById('urlList');
                var clicks = response.clicks
                var fullUrl = baseUrl + "/" + response.short_url;
                var newRow = '<tr>' +
                    '<td>' + originalUrl + '</td>' +
                    '<td>' + fullUrl + '</td>' +
                    '<td>' + clicks + '</td>' +
                    '<td><button class="btn btn-primary" onclick="copyToClipboard(\'' + fullUrl + '\')">Copy Link</button></td>' +
                    '</tr>';
                urlList.innerHTML += newRow;

                originalUrlInput.value = '';
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function copyToClipboard(text) {
        var tempInput = document.createElement('input');
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('Link copied to clipboard: ' + text);
    }
</script>
@endsection