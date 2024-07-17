<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
     <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>NGAPPSEN</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @yield('style')
</head>
<body>
        @include('layout.include.navbar')
        
        @role('Admin')
            @include('layout.include.sidebar')
        @endrole
        <div class="mt-10">
            @yield('content')
        </div>
</body>
</html>

@yield('extra-js')