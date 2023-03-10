@extends('passenger.dashboard')
@section('passenger')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>All Orders</h3>
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Rider</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @php($i = 1)
                                    @foreach ($allOrders as $order)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                {{ $order->user->surname }}, {{ $order->user->other_name }} <br>
                                                ({{ $order->user->username }})
                                            </td>
                                            <td>
                                                Pick Up Point: {{ $order->pick_up->getLat() }}, {{ $order->pick_up->getLng() }}
                                                <br>
                                                Destination: {{ $order->destination->getLat() }}, {{ $order->destination->getLng() }}
                                                <br>
                                                Distance in Km: {{ $order->distance }}
                                                <br>
                                                Duration: {{ $order->duration }}
                                                <br>
                                                Amount Payable: ₦{{ $order->amount }}
                                                <br>
                                                
                                                <button class="btn btn-info btn-sm show-map" data-bs-toggle="modal"
                                                    data-bs-target="#myModalPickUp" data-id="{{ $i }}"
                                                    data-picklat="{{ $order->pick_up->getLat() }}"
                                                    data-picklng="{{ $order->pick_up->getLng() }}"
                                                    data-destinationlat="{{ $order->destination->getLat() }}"
                                                    data-destinationlng="{{ $order->destination->getLng() }}">View Route on
                                                    Map
                                                </button>
                                                {{--
                                                <div class="my-4 ">
                                                    <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal"
                                                        data-bs-target="#myModal">Add New Keke</button>
                                                </div> --}}

                                                <p></p>
                                               
                                                {{-- {{ $order->destination->getLng() }} <button
                                                    class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#myModalDestination">View on
                                                    Map</button><br> --}}

                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->


            <!-- sample modal content -->
            <div id="myModalPickUp" class="modal fade" tabindex="-1" aria-labelledby="#exampleModalFullscreenLabel"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Current Location of </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Distance in
                                    Kilometers</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="kilo">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Duration in Minutes</label>
                                <div class="col-sm-4">
                                    <input class="form-control" id="duration">
                                </div>
                            </div>

                            <div id="map" style="width: auto; height: 800px; border:1px solid red"></div>
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

    <script defer
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap">
    </script>

    <script>
        $(function() {
            $('.show-map').click(function() {
                window.addEventListener('click', (listener) => {
                    initMap();
                }, {
                    once: true
                });

                var id = $(this).data('id');
                console.log('ID - ' + id);


                var latitudePickup = $(this).data('picklat');
                var longitudePickup = $(this).data('picklng');

                var latitudeDestination = $(this).data('destinationlat');
                var longitudeDestination = $(this).data('destinationlng');

                var origin, destination, map;
                var travel_mode = 'DRIVING';

                let centerLatitude = 6.8921079535158425;
                let centerLongitude = 3.7238427073652787;


                origin = {
                    lat: latitudePickup,
                    lng: longitudePickup
                };

                destination = {
                    lat: latitudeDestination,
                    lng: longitudeDestination
                };


                console.log(latitudePickup);
                console.log(longitudePickup);
                console.log(latitudeDestination);
                console.log(longitudeDestination);
                console.log('origin');
                console.log(origin);
                console.log('destination');
                console.log(destination);


                function initMap() {
                    // map options
                    var options = {
                        zoom: 17,
                        center: {
                            lat: centerLatitude,
                            lng: centerLongitude
                        }
                    }
                    map = new google.maps.Map(document.getElementById('map'), options);


                    // // Add a marker clusterer to manage the markers.

                    // //Add marker
                    // var markers = [

                    //     //Dublin
                    //     {
                    //         coords: {
                    //             lat: +latitudePickup,
                    //             lng: +longitudePickup
                    //         },
                    //         iconImage: 'assets/img/places/stparkdublin.png',
                    //         content: '<h1>Pick up Point'
                    //     },
                    //     {
                    //         coords: {
                    //             lat: +latitudeDestination,
                    //             lng: +longitudeDestination
                    //         },
                    //         iconImage: 'assets/img/places/botanic garden.png',
                    //         content: '<h1>Destination</h1>'
                    //     },
                    // ];

                    // // Loop through markers
                    // var gmarkers = [];
                    // for (var i = 0; i < markers.length; i++) {
                    //     gmarkers.push(addMarker(markers[i]));

                    // }

                    // //Add MArker function
                    // function addMarker(props) {
                    //     var marker = new google.maps.Marker({
                    //         position: props.coords,
                    //         map: map,

                    //     });

                    //     /* if(props.iconImage){
                    //       marker.setIcon(props.iconImage);
                    //     } */

                    //     //Check content
                    //     if (props.content) {
                    //         var infoWindow = new google.maps.InfoWindow({
                    //             content: props.content
                    //         });
                    //         marker.addListener('click', function() {
                    //             infoWindow.open(map, marker);
                    //         });
                    //     }
                    //     return marker;
                    // }
                    // var markerCluster = new MarkerClusterer(map, gmarkers, {
                    //     imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
                    // });


                    var directionsDisplay = new google.maps.DirectionsRenderer({
                        'draggable': false
                    });
                    var directionsService = new google.maps.DirectionsService();


                    displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay);
                    calculateDistance(travel_mode, origin, destination);

                }
                // google.maps.event.addDomListener(window, 'load', initMap)

                function displayRoute(travel_mode, origin, destination, directionsService,
                    directionsDisplay) {
                    directionsService.route({
                        origin: new google.maps.LatLng(origin.lat, origin.lng),
                        destination: new google.maps.LatLng(destination.lat, destination.lng),
                        travelMode: travel_mode,
                        avoidTolls: true
                    }, function(response, status) {
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
                                var distance = response.rows[0].elements[0].distance;
                                var duration = response.rows[0].elements[0].duration;
                                var distance_in_kilo = distance.value / 1000; // the kilo meter
                                var distance_in_mile = distance.value / 1609.34; // the mile
                                var duration_text = duration.text;
                                console.log(distance);
                                console.log(duration);
                                console.log('Kilo ' + distance_in_kilo);
                                console.log('Mile ' + distance_in_mile);
                                console.log(duration_text);
                                document.getElementById("kilo").setAttribute('value',
                                    distance_in_kilo+' Km')
                                document.getElementById("duration").setAttribute('value',
                                    duration_text)
                            }
                        }
                    });
                }


            })
        })
        // function setPickUpPosition(latitudePickup, longitudePickup) {
        //     var ddd;
        //     var geocoder = new google.maps.Geocoder();
        //     var latlng = {
        //         lat: parseFloat(latitudePickup),
        //         lng: parseFloat(longitudePickup)
        //     };
        //     geocoder.geocode({
        //         'location': latlng
        //     }, function(responses) {
        //         console.log(responses);
        //         if (responses && responses.length > 0) {
        //             ddd = responses[1].formatted_address;
        //             $("#origin").val(responses[1].place_id);
        //             // $("#from_places").val(responses[1].formatted_address);
        //             console.log(responses[1].formatted_address);
        //             console.log('Pickup Place Id - ' + responses[1].place_id);
        //         } else {
        //             alert("Cannot determine address at this location.")
        //         }
        //     });
        //     console.log('ddddd - ' + ddd);
        //     return ddd;

        // }

        // function setDestinationPosition(latitudePickup, longitudePickup) {
        //     var geocoder = new google.maps.Geocoder();
        //     var latlng = {
        //         lat: parseFloat(latitudePickup),
        //         lng: parseFloat(longitudePickup)
        //     };
        //     geocoder.geocode({
        //         'location': latlng
        //     }, function(responses) {
        //         console.log(responses);
        //         if (responses && responses.length > 0) {
        //             $("#destination").val(responses[1].place_id);
        //             // $("#from_places").val(responses[1].formatted_address);
        //             console.log(responses[1].formatted_address);
        //             console.log('Destination Place Id - ' + responses[1].place_id);
        //         } else {
        //             alert("Cannot determine address at this location.")
        //         }
        //     });
        // }
    </script>

    <script>
        $(function() {
            $('.mark').click(function() {
                console.log('Mark Read Clicked');
                // var orderId = $(this).data('id');
                var dept = document.getElementById("dept").value;
                // console.log(orderId);
                console.log(dept);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('help.mee') }}',
                    data: {
                        'keke_id': dept,
                    },
                    success: function(data) {
                        console.log(data.success);
                        // if (data.success) {
                        //     console.log(data.success);
                        //     toastr.options.closeButton = true;
                        //     toastr.options.closeMethod = 'fadeOut';
                        //     toastr.options.closeDuration = 3000;
                        //     toastr.info(data.success);
                        // }

                        // if (data.error) {
                        //     console.log(data.error);
                        //     toastr.options.closeButton = true;
                        //     toastr.options.closeMethod = 'fadeOut';
                        //     toastr.options.closeDuration = 3000;
                        //     toastr.error(data.error);
                        // }
                    },
                    error: function(status) {
                        console.log('Error Booking Trip');
                        // toastr.options.closeButton = true;
                        // toastr.options.closeMethod = 'fadeOut';
                        // toastr.options.closeDuration = 100;
                        // toastr.error('Error Starting Trip');
                    },
                })
            });
        });
    </script>
@endsection
