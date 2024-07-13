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
                <div class="relative z-0 w-full mb-5 border rounded group">
                    <div id="map"></div>
                </div>
                <div class="flex">
                    @if(Auth::check())
                        <p class="text-lg">Nama : {{ Auth::user()->name }}</p>
                    @endif
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