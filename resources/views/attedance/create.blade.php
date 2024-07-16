@extends('layout.app')

@section('style')
    <style>
        #map { height: 180px; 
        }
    </style>
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="bg-zinc-50 p-8 w-6/12 rounded">  
                <div class="relative z-0 w-full mb-5 group">
                    <input type="hidden" id="location" name="location">
                </div>
                <a href="{{ route('dashboard') }}">
                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class=" ml-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                        </svg>
                    </button>
                </a>
                <div class="relative z-0 w-full mb-5 mt-4 border rounded group">
                    <div id="map"></div>
                </div>
                <div class="flex flex-col">
                    @if(Auth::check())
                        <p class="text-xl font-medium text-gray-900 dark:text-white mt-4">Nama : {{ Auth::user()->name }}</p>
                    @endif
                    @foreach($workingHours as $hours)
                        <p class="text-xl font-medium text-gray-900 dark:text-white mt-4"> Hari       : {{ $hours->days }}</p>
                        <p class="text-xl font-medium text-gray-900 dark:text-white mt-4"> Jam Masuk  : {{ $hours->workingHour->entry_time }}</p>
                        <p class="text-xl font-medium text-gray-900 dark:text-white mt-4"> Jam Pulang  : {{ $hours->workingHour->home_time }}</p>
                    @endforeach
                </div>
                @if($check > 0)
                    <div class="flex justify-center">
                        <button id="takeAttedance" class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Absen Pulang</button>
                    </div>
                @else
                <div class="flex justify-center">
                    <button id="takeAttedance" class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Absen Masuk</button>
                </div>
                @endif
        </div>
    </div>
@endsection

@section('extra-js')
    <script>
        var locationInput = document.getElementById('location');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            alert('Geolocation is not supported by your browser.');
        }

        function successCallback(position) {
            locationInput.value = position.coords.latitude + ", " + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 16);
            var officeLocation = "{{ $officeLocation->location }}";
            var office = officeLocation.split(",");
            var latOffice = office[0];
            var langOffice = office[1];
            var radius = "{{ $officeLocation->radius }}";
            
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            var circle = L.circle([latOffice, langOffice], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }

        function errorCallback(error) {
            alert('Error getting location: ' + error.message);
        }

        $('#takeAttedance').click(function (e) {
            var location = $('#location').val();
            $.ajax({
                type: 'POST',
                url: '/attedance/store',
                data: {
                    _token: "{{ csrf_token() }}",
                    location : location
                },
                cache: false,
                success: function(response) {
                    var status = response.split("|");
                    if(status[0] == "success") {
                        Swal.fire({
                            title: 'Success!',
                            text: status[1],
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                        setTimeout("location.href='/dashboard'",3000);
                    } else {
                            Swal.fire({
                                title: 'Error!',
                                text: status[1],
                                icon: 'error',
                                confirmButtonText: 'Whoops'
                            })
                        
                    }
                }
            });
        });
    </script>
@endsection