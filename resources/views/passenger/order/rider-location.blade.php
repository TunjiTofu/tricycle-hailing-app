@extends('passenger.dashboard')
@section('passenger')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Rider's Location</h3>
                            @if (isset($riderCurrentLocation->current_location))
                                <input type="hidden" id="latitude"
                                    value="{{ $riderCurrentLocation->current_location->getLat() }}"> <br>
                                <input type="hidden" id="longitude"
                                    value=" {{ $riderCurrentLocation->current_location->getLng() }}"> <br>

                                <br>
                                Time <br>
                                {{ Carbon\Carbon::parse($riderCurrentLocation->update_trip_time)->diffForHumans() }}
                            @else
                                <input type="hidden" id="latitude"
                                    value="{{ $riderCurrentLocation->start_location->getLat() }}"> <br>
                                <input type="hidden" id="longitude"
                                    value=" {{ $riderCurrentLocation->start_location->getLng() }}"> <br>

                                <br>
                                Time <br>
                                {{ Carbon\Carbon::parse($riderCurrentLocation->start_trip_time)->diffForHumans() }}
                            @endif


                            <div id="map" style="width: auto; height: 800px; border:1px solid red"></div>

                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->



        </div>
    </div>

    <script defer
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap">
    </script>
    <script>
        let map;
        let marker;

        // Initialize and add the map
        function initMap() {
            var latitude = document.getElementById("latitude").value;
            var longitude = document.getElementById("longitude").value;

            // The current location
            const currentLocation = {
                lat: +latitude,
                lng: +longitude
            };

            // The map, centered at Current Location
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 17,
                center: currentLocation,
                scrollwheel: true,
            });

            // The marker, positioned at Current Location
            marker = new google.maps.Marker({
                position: currentLocation,
                map: map,
                draggable: true,
            });

            google.maps.event.addListener(marker, 'position_changed',
                function() {
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    // let name = marker.title()
                    // console.log('Name -- ' + name);
                    document.getElementById("lat").setAttribute('value', lat)
                    document.getElementById("lng").setAttribute('value', lng)
                    // document.getElementById("name").setAttribute('value', name)
                })
        }
    </script>
@endsection
