@extends('passenger.dashboard')
@section('passenger')
{{-- @vite(['resources/js/app.js']) --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            {{-- <form action="#" method="POST">
                @csrf --}}

            <input class="form-control" id="keke-id" name="keke_id" type="text" value="{{ $keke_id }}" required>
            <input class="form-control" id="rider-id" name="rider_id" type="text" value="{{ $rider->rider_id }}" required>
            @error('keke_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="row mb-3">
                <label for="example-text-input" class="col-sm-2 col-form-label">Space Available in Keke: </label>
                <div class="col-sm-4">
                    <label for="example-text-input" class="col-sm-2 col-form-label">{{ $spaceAvailable }}</label>
                </div>

                <label for="example-text-input" class="col-sm-2 col-form-label">Number of Passengers</label>
                <div class="col-4">
                    <select name="no_of_passengers" id="passengers" class="form-select" aria-label="Default select example">
                        @if ($spaceAvailable == 3)
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        @endif
                        @if ($spaceAvailable == 2)
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                        @endif
                        @if ($spaceAvailable == 1)
                            <option value="1" selected>1</option>
                        @endif
                    </select>
                    @error('no_of_passengers')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="form-group mb-3 row">
                <div class="col-6">
                    <input class="form-control" id="destination-lng" name="longitude" type="text"
                        value="{{ old('longitude') }}" required placeholder="Location Longitude">
                    @error('longitude')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-6">
                    <input class="form-control" id="destination-lat" name="latitude" type="text"
                        value="{{ old('latitude') }}" required placeholder="Location Latitude">
                    @error('latitude')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <label for="example-text-input" class="col-sm-2 col-form-label">Destination</label><br>
            <span class="text-danger">Move the red marker on the map to key in your destination. You can also zoom in and
                out of the map for a better view</span><br>
            <div id="map" style="width: auto; height: 500px; border:1px solid red"></div>



            <div class="form-group text-center row mt-3 pt-1">
                <div class="col-12">
                    <button data-id="{{ $profileData->id }}" class="btn btn-info w-100 waves-effect waves-light book"
                        type="submit">Book Ride</button>
                </div>
            </div>

            {{-- Ajax Loader Spinner --}}
            <div class="bground" style="display: none">
                <div class="spinner" >
                </div>
            </div>

         
            <!-- sample modal content -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Current Location of </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="map" style="width: auto; height: 500px; border:1px solid red"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap&v=weekly"
        defer></script>

    <script>
        let map;
        let marker;
        let latitude = 1.232;
        let longitude = 4.324;

        // Initialize and add the map
        function initMap() {

            // The current location
            const currentLocation = {
                lat: +latitude,
                lng: +longitude
            };
            // console.log(currentLocation);

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
                    document.getElementById("destination-lat").setAttribute('value', lat)
                    document.getElementById("destination-lng").setAttribute('value', lng)
                    // document.getElementById("name").setAttribute('value', name)
                })
        }
    </script>

    <script>
        $(function() {

            $('.book').click(function() {
                console.log('Next Clicked');
                $('.bground').show();

                var user_id = $(this).data('id');
                navigator.geolocation.getCurrentPosition(
                    function(position) {

                        var keke_id = document.getElementById("keke-id").value;
                        var rider_id = document.getElementById("rider-id").value;
                        var passengers = document.getElementById("passengers").value;
                        var destination_lat = document.getElementById("destination-lat").value;
                        var destination_lng = document.getElementById("destination-lng").value;


                        var current_lat = position.coords.latitude;
                        var current_lng = position.coords.longitude;

                        console.log(user_id);
                        console.log(rider_id);
                        console.log(passengers);
                        console.log(destination_lat);
                        console.log(destination_lng);

                        console.log('current-Lat - ' + current_lat);
                        console.log('current-Lng - ' + current_lng);

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: '{{ route('book.trip.session') }}',
                            data: {
                                'keke_id': keke_id,
                                'rider_id': rider_id,
                                'user_id': user_id,
                                'pickup_lat': current_lat,
                                'pickup_lng': current_lng,
                                'destination_lat': destination_lat,
                                'destination_lng': destination_lng,
                                'passengers': passengers,
                            },
                            success: function(data) {
                                if (data.success) {
                                    console.log(data.success);
                                    toastr.options.closeButton = true;
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 3000;
                                    toastr.info(data.success);
                                }

                                if (data.error) {
                                    console.log(data.error);
                                    toastr.options.closeButton = true;
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 3000;
                                    toastr.error(data.error);
                                }
                            },
                            error: function(status) {
                                console.log('Error Booking Trip');
                                toastr.options.closeButton = true;
                                toastr.options.closeMethod = 'fadeOut';
                                toastr.options.closeDuration = 100;
                                toastr.error('Error Starting Trip');
                            },
                            complete: function() {
                                $('.bground').hide();
                                setTimeout(() => {
                                        window.location =
                                            '{{ route('passenger.dashboard') }}'
                                    }, 5000);
                            }
                        });

                    },
                    function errorCallback(error) {
                        $('#startText').text('Start Trip');
                        console.log(error)
                    }
                );

            })
        })
    </script>
@endsection
