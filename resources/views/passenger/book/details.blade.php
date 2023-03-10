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


    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap&v=weekly"
        defer></script> --}}


    <script defer
        src="https://maps.googleapis.com/maps/api/js?libraries=places&language=en&key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap"
        type="text/javascript"></script>


    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap&v=weekly"
        defer> --}}


    <script>
        // $(function() {
        //     var origin, destination, map;
        //     // add input listeners
        //     // google.maps.event.addDomListener(window, 'load', function(listener) {
        //     window.addEventListener('load',(evt) => {
        //         setDestination();
        //         initMap();
        //     });

        //     // init or load map
        //     function initMap() {
        //         var myLatLng = {
        //             lat: 6.894483189294346,
        //             lng: 3.723123875349268
        //         };
        //         map = new google.maps.Map(document.getElementById('map'), {
        //             zoom: 16,
        //             center: myLatLng,
        //         });

        //         //The marker, positioned at Current Location
        //         marker = new google.maps.Marker({
        //             position: myLatLng,
        //             map: map,
        //             draggable: true,
        //         });

        //         google.maps.event.addListener(marker, 'position_changed',
        //             function() {
        //                 let lat = marker.position.lat()
        //                 let lng = marker.position.lng()
        //                 // let name = marker.title()
        //                 // console.log('Name -- ' + name);
        //                 document.getElementById("destination-lat").setAttribute('value', lat)
        //                 document.getElementById("destination-lng").setAttribute('value', lng)
        //                 // document.getElementById("name").setAttribute('value', name)
        //             })
        //     }



        //     function setDestination() {
        //         // var from_places = new google.maps.places.Autocomplete(document.getElementById('from_places'));
        //         // var from_places = new google.maps.places.Autocomplete(document.getElementById('from_places'));
        //         // var to_places = new google.maps.places.Autocomplete(document.getElementById('to_places'));

        //         // google.maps.event.addListener(from_places, 'place_changed', function() {
        //         //     var from_place = from_places.getPlace();
        //         //     var from_address = from_place.formatted_address;
        //         //     $('#origin').val(from_address);
        //         // });

        //         // google.maps.event.addListener(to_places, 'place_changed', function() {
        //         //     var to_place = to_places.getPlace();
        //         //     var to_address = to_place.formatted_address;
        //         //     $('#destination').val(to_address);
        //         // });

        //         console.log('Heeeeeeeeeeeeeeeeelllllllllllllllllloooooooooooooooo');
        //         const geocoder = new google.maps.Geocoder();
        //         var latlng = {
        //             lat: 6.8921079535158425,
        //             lng: 3.7238427073652787
        //         };
        //         geocoder.geocode({
        //             'location': latlng
        //         }).then((response) => {
        //             if (response.results[0]) {
        //                 console.log(response);
        //             }
        //         })
        //         // }, function(responses) {
        //         //     console.log(responses);
        //         //     if (responses && responses.length > 0) {
        //         //         $("#origin").val(responses[1].formatted_address);
        //         //         $("#from_places").val(responses[1].formatted_address);
        //         //         //    console.log(responses[1].formatted_address);
        //         //     } else {
        //         //         alert("Cannot determine address at this location.")
        //         //     }
        //         // }

        //         // );


        //     }
        // })


        let map;
        let marker;

        // Initialize and add the map
        function initMap() {

            // The current location
            const currentLocation = {
                lat: 6.894483189294346,
                lng: 3.723123875349268
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
                // calculate distance , after finish send result to callback function
                // function calculateDistance(travel_mode, origin, destination) {


                // }


                console.log('Next Clicked');
                $('.bground').show();

                var user_id = $(this).data('id');
                var distance, duration, distance_in_kilo, distance_in_mile, duration_text, amount_payable;
                navigator.geolocation.getCurrentPosition(
                    function(position) {

                        var keke_id = document.getElementById("keke-id").value;
                        var rider_id = +document.getElementById("rider-id").value;
                        var passengers = +document.getElementById("passengers").value;
                        var destination_lat = +document.getElementById("destination-lat").value;
                        var destination_lng = +document.getElementById("destination-lng").value;


                        var current_lat = position.coords.latitude;
                        var current_lng = position.coords.longitude;
                        // var current_lat =  6.8890481;
                        // var current_lng = 3.7222735;
                        var travel_mode = 'DRIVING';

                        origin = {
                            lat: current_lat,
                            lng: current_lng
                        };

                        destination = {
                            lat: destination_lat,
                            lng: destination_lng
                        };

                        var DistanceMatrixService = new google.maps.DistanceMatrixService();
                        DistanceMatrixService.getDistanceMatrix({
                            origins: [origin],
                            destinations: [destination],
                            travelMode: google.maps.TravelMode[travel_mode],
                            unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
                            // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                            avoidHighways: false,
                            avoidTolls: false
                        }, function(response, status) {
                            if (status != google.maps.DistanceMatrixStatus.OK) {
                                $('#result').html(err);
                            } else {
                                var origin = response.originAddresses[0];
                                var destination = response.destinationAddresses[0];
                                if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                                    $('#result').html(
                                        "Sorry , not available to use this travel mode between " +
                                        origin + " and " + destination);
                                } else {
                                    distance = response.rows[0].elements[0].distance;
                                    duration = response.rows[0].elements[0].duration;
                                    distance_in_kilo = distance.value / 1000; // the kilo meter
                                    distance_in_mile = distance.value / 1609.34; // the mile
                                    duration_text = duration.text;
                                    amount_payable = Math.round((+distance_in_kilo * 100)/10)*10;

                                    // document.getElementById("kilo").setAttribute('value',
                                    //     distance_in_kilo + ' Km')
                                    // document.getElementById("duration").setAttribute('value',
                                    //     duration_text)


                                    console.log(user_id);
                                    console.log(rider_id);
                                    console.log(passengers);
                                    console.log(destination_lat);
                                    console.log(destination_lng);

                                    console.log('current-Lat - ' + current_lat);
                                    console.log('current-Lng - ' + current_lng);

                                    console.log(distance);
                                    console.log(duration);
                                    console.log('Kilo ' + distance_in_kilo);
                                    console.log('Mile ' + distance_in_mile);
                                    console.log(duration_text);
                                    console.log(amount_payable);
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
                                            'distance_in_kilo': distance_in_kilo,
                                            'duration_text': duration_text,
                                            'amount_payable': amount_payable,
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
                                            // setTimeout(() => {
                                            //     window.location =
                                            //         '{{ route('passenger.dashboard') }}'
                                            // }, 5000);
                                        }
                                    });

                                }
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
