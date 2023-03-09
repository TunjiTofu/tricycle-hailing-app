@extends('passenger.dashboard')
@section('passenger')
    {{-- @vite(['resources/js/app.js']) --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script defer
        src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en&key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU"
        type="text/javascript"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap&v=weekly"
        defer> --}}

    <div class="page-content">
        <div class="container-fluid">

            {{-- <form action="#" method="POST">
                @csrf --}}

            <input class="form-control" id="keke-id" name="keke_id" type="text" value="{{ $keke_id }}" required>
            <input class="form-control" id="rider-id" name="rider_id" type="text" value="{{ $rider->rider_id }}"
                required>
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

            <div class="form-group mb-3 row">
                <div class="col-6">
                    <form id="distance_form">

                        <div class="form-group"><label>Username </label>
                            <input class="form-control" id="username" placeholder="Enter Username"/>
                            <input  name="username" required="" type="hidden"/></div>

                        <div class="form-group"><label>Origin: </label>
                            <input class="form-control" id="from_places" placeholder="Enter Location" />
                            <input id="origin" name="origin" required="" type="text" />
                            <a class="form-control" onclick="getCurrentPosition()">Set Current Location</a>
                        </div>

                        <div class="form-group"><label>Destination: </label>
                            <input class="form-control" id="to_places" placeholder="Enter Location" />
                            <input id="destination" name="destination" required="" type="text" />
                        </div>

                        <div class="form-group">
                            <label>Travel Mode</label>
                            <select class="form-control" id="travel_mode" name="travel_mode">
                                <option value="DRIVING">Driving</option>
                                <option value="WALKING">Foot</option>
                                <option value="BICYCLING">Cycle</option>
                                <option value="TRANSIT">Transit</option>
                            </select>
                        </div>

                        <input class="btn btn-primary" type="submit" value="Calculate" />

                    </form>
                </div>
                <div class="col-6">
                    <div style="margin-left: 123px;" id="result" class="hide">
                        <ul class="list-group">
                            <li id="in_mile" class="list-group-item d-flex justify-content-between align-items-center">
                            </li> <br>
                            <br>
                            <br>
                            <li id="in_kilo" class="list-group-item d-flex justify-content-between align-items-center">
                            </li> <br>
                            <br>
                            <br>

                            <li id="duration_text"
                                class="list-group-item d-flex justify-content-between align-items-center"></li> <br>
                            <br>

                        </ul>
                    </div>
                </div>
            </div>

            <label for="example-text-input" class="col-sm-2 col-form-label">Destination</label><br>
            <span class="text-danger">Move the red marker on the map to key in your destination. You can also zoom in and
                out of the map for a better view</span><br>
            <div id="map" style="width: auto; height: 500px; border:1px solid red"></div>
            {{-- <div class="col-sm-4">
                <div id="map" style="height: 400px; width: 500px" ></div>
               </div> --}}


            <div class="form-group text-center row mt-3 pt-1">
                <div class="col-12">
                    <button data-id="{{ $profileData->id }}" class="btn btn-info w-100 waves-effect waves-light book"
                        type="submit">Book Ride</button>
                </div>
            </div>

            {{-- Ajax Loader Spinner --}}
            <div class="bground" style="display: none">
                <div class="spinner">
                </div>
            </div>


            <!-- sample modal content -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Current Location of </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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


    <script>
        $(function () {
            var origin, destination, map;
    
            // add input listeners
            google.maps.event.addDomListener(window, 'load', function (listener) {
                setDestination();
                initMap();
            });
    
            // init or load map
            function initMap() {
    
                var myLatLng = {
                    lat: 6.894483189294346,
                    lng: 3.723123875349268
                };
                map = new google.maps.Map(document.getElementById('map'), {zoom: 16, center: myLatLng,});

                //The marker, positioned at Current Location
                marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    draggable: true,
                });
            }
    
            function setDestination() {
                var from_places = new google.maps.places.Autocomplete(document.getElementById('from_places'));
                var to_places = new google.maps.places.Autocomplete(document.getElementById('to_places'));
    
                google.maps.event.addListener(from_places, 'place_changed', function () {
                    var from_place = from_places.getPlace();
                    var from_address = from_place.formatted_address;
                    $('#origin').val(from_address);
                });
    
                google.maps.event.addListener(to_places, 'place_changed', function () {
                    var to_place = to_places.getPlace();
                    var to_address = to_place.formatted_address; 
                    $('#destination').val(to_address);
                });
    
    
            }
    
            function displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay) {
                directionsService.route({
                    origin: origin,
                    destination: destination,
                    travelMode: travel_mode,
                    avoidTolls: true
                }, function (response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setMap(map);
                        directionsDisplay.setDirections(response);
                    } else {
                        directionsDisplay.setMap(null);
                        directionsDisplay.setDirections(null);
                        alert('Could not display directions due to: ' + status);
                    }
                });
            }
    
            // calculate distance , after finish send result to callback function
            function calculateDistance(travel_mode, origin, destination) {
    
                var DistanceMatrixService = new google.maps.DistanceMatrixService();
                DistanceMatrixService.getDistanceMatrix(
                    {
                        origins: [origin],
                        destinations: [destination],
                        travelMode: google.maps.TravelMode[travel_mode],
                        unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
                        // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                        avoidHighways: false,
                        avoidTolls: false
                    }, save_results);
            }
    
            // save distance results
            function save_results(response, status) {
    
                if (status != google.maps.DistanceMatrixStatus.OK) {
                    $('#result').html(err);
                } else {
                    var origin = response.originAddresses[0];
                    var destination = response.destinationAddresses[0];
                    if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                        $('#result').html("Sorry , not available to use this travel mode between " + origin + " and " + destination);
                    } else {
                        var distance = response.rows[0].elements[0].distance;
                        var duration = response.rows[0].elements[0].duration;
                        var distance_in_kilo = distance.value / 1000; // the kilo meter
                        var distance_in_mile = distance.value / 1609.34; // the mile
                        var duration_text = duration.text;
                        appendResults(distance_in_kilo, distance_in_mile, duration_text);
                        sendAjaxRequest(origin, destination, distance_in_kilo, distance_in_mile, duration_text);
                    }
                }
            }
    
            // append html results
            function appendResults(distance_in_kilo, distance_in_mile, duration_text) {
                $("#result").removeClass("hide");
                $('#in_mile').html("Distance in Mile : <span class='badge badge-pill badge-secondary'>" + distance_in_mile.toFixed(2) + "</span>");
                $('#in_kilo').html("Distance in Kilo : <span class='badge badge-pill badge-secondary'>" + distance_in_kilo.toFixed(2) + "</span>");
                $('#duration_text').html("In Text: <span class='badge badge-pill badge-success'>" + duration_text + "</span>");
            }
    
            // send ajax request to save results in the database
            function sendAjaxRequest(origin, destination, distance_in_kilo, distance_in_mile, duration_text) {
                var username =   $('#username').val();
                var travel_mode =  $('#travel_mode').find(':selected').text();
                $.ajax({
                    url: 'common.php',
                    type: 'POST',
                    data: {
                        username,
                        travel_mode,
                        origin,
                        destination,
                        distance_in_kilo,
                        distance_in_mile,
                        duration_text
                    },
                    success: function (response) {
                        console.info(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
    
            // on submit  display route ,append results and send calculateDistance to ajax request
            $('#distance_form').submit(function (e) {
                e.preventDefault();
                var origin = $('#origin').val();
                var destination = $('#destination').val();
                var travel_mode = $('#travel_mode').val();
                var directionsDisplay = new google.maps.DirectionsRenderer({'draggable': false});
                var directionsService = new google.maps.DirectionsService();
               displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay);
                calculateDistance(travel_mode, origin, destination);
            });
    
        });
    
        // get current Position
        function getCurrentPosition() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(setCurrentPosition);
            } else {
                alert("Geolocation is not supported by this browser.")
            }
        }
    
        // get formatted address based on current position and set it to input
        function setCurrentPosition(pos) {
            var geocoder = new google.maps.Geocoder();
            var latlng = {lat: parseFloat(pos.coords.latitude), lng: parseFloat(pos.coords.longitude)};
            geocoder.geocode({ 'location' :latlng  }, function (responses) {
                console.log(responses);
                if (responses && responses.length > 0) {
                    $("#origin").val(responses[1].formatted_address);
                    $("#from_places").val(responses[1].formatted_address);
                    //    console.log(responses[1].formatted_address);
                } else {
                    alert("Cannot determine address at this location.")
                }
            });
        }
    
    
    </script>


    {{-- <script
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
                        var rider_id = +document.getElementById("rider-id").value;
                        var passengers = +document.getElementById("passengers").value;
                        var destination_lat = +document.getElementById("destination-lat").value;
                        var destination_lng = +document.getElementById("destination-lng").value;


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
    </script> --}}
@endsection
