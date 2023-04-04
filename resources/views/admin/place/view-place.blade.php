@extends('admin.dashboard')
@section('admin')
    {{-- <div class="page-content"> --}}
    <div class="container-fluid">


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">All Places</h4>
                        <p class="card-title-desc">Places in the database
                        </p>

                        <div class="my-4 ">
                            {{-- {{ dd($item) }} --}}
                            <a href="" class="btn btn-primary">Edit Place</a>
                            <p><strong>Name: </strong> {{ $place->name }}</p>
                            <p><strong>Status: </strong> {{ $place->status }}</p>
                            <p><strong>Current Location on Map: </strong> </p>
                            <div id="map" style="width: auto; height: 600px; border:1px solid red"></div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>
    {{-- </div> --}}

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap&v=weekly"
        defer></script>

    <script>
        let map;
        let marker;
        let latitude = '{{ $place->coordinates->getLat() }}'
        let longitude = '{{ $place->coordinates->getLng() }}'

        // Initialize and add the map
        function initMap() {

            // The current location
            const currentLocation = {
                lat: +latitude,
                lng: +longitude
            };

            // The map, centered at Current Location
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 17,
                center: currentLocation,
                scrollwheel: false,
            });

            // The marker, positioned at Current Location
            marker = new google.maps.Marker({
                position: currentLocation,
                map: map,
                draggable: false,
                title: 'Uluru (Ayers Rock)'
            });
        }
    </script>
@endsection
