@extends('admin.dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>All Orders</h3>
                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Passenger</th>
                                                <th>Rider</th>
                                                <th>Location</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($i = 1)
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>
                                                        {{ $order->customer->surname }}, {{ $order->customer->other_name }}
                                                        <br>
                                                        ({{ $order->customer->username }})
                                                    </td>
                                                    <td>
                                                        {{ $order->user->surname }}, {{ $order->user->other_name }}
                                                        <br>
                                                        ({{ $order->user->username }})
                                                    </td>
                                                    <td>
                                                        Pick Up Point: {{ $order->pick_up->getLat() }},
                                                        {{ $order->pick_up->getLng() }}
                                                        <br>
                                                        Destination: {{ $order->destination->getLat() }},
                                                        {{ $order->destination->getLng() }}
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
                                                            data-destinationlng="{{ $order->destination->getLng() }}">View
                                                            Route on
                                                            Map
                                                        </button>
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

                </div>
            </div>

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
                    var directionsDisplay = new google.maps.DirectionsRenderer({
                        'draggable': false
                    });
                    var directionsService = new google.maps.DirectionsService();
                    displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay);
                }

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

            })
        })
    </script>
@endsection
