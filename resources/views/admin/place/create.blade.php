@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create a New Location</h4><br>

                            <form class="form-horizontal mt-3" method="POST" action="{{ route('place.store') }}">
                                @csrf

                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <input class="form-control" id="name" name="name" type="text"
                                            value="{{ old('name') }}" required placeholder="Name of Location">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-6">
                                        <input class="form-control" id="lng" name="longitude" type="text"
                                            value="{{ old('longitude') }}" required placeholder="Location Longitude">
                                        @error('longitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <input class="form-control" id="lat" name="latitude" type="text"
                                            value="{{ old('latitude') }}" required placeholder="Location Latitude">
                                        @error('latitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <span class="text-danger">Move the red marker on the map to get the precise longitude and
                                    latitude. You can also zoom in and out of the map for a better view</span><br>
                                <div id="map" style="width: auto; height: 500px; border:1px solid red"></div>

                                <div class="form-group text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Create
                                            Location</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap&v=weekly"
        defer></script>

    <script>
        let map;
        let marker;

        // Initialize and add the map
        function initMap() {

            // The current location
            const currentLocation = {
                lat: 6.8921079535158425,
                lng: 3.7238427073652787
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
