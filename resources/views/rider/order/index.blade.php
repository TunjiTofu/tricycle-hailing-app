@extends('rider.dashboard')
@section('rider')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Orders</h3>
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Passenger</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Action</th>
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
                                                Pick Up Point: {{ $order->pick_up->getLat() }},
                                                {{ $order->pick_up->getLng() }}
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#myModalPickUp">View on
                                                    Map
                                                </button>
                                                {{-- 
                                                <div class="my-4 ">
                                                    <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal"
                                                        data-bs-target="#myModal">Add New Keke</button>
                                                </div> --}}

                                                <p></p>
                                                Destination: {{ $order->destination->getLat() }},
                                                {{ $order->destination->getLng() }} <button class="btn btn-secondary btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#myModalDestination">View on
                                                    Map</button><br>
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                                            </td>
                                            <td>
                                                {{-- <input type="text" value="3" id="dept"> --}}
                                                <a href="{{ route('rider.read', ['id' => $order->id]) }}"
                                                    class="btn btn-info btn-sm">Mark as Read</a>
                                                {{-- <button class="btn btn-info w-100 waves-effect waves-light mark"
                                                    type="submit">Book Ride</button> --}}
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
            <div id="myModalPickUp" class="modal fade" tabindex="-1" aria-labelledby="#exampleModalFullscreenLabel" style="display: none;" aria-hidden="true">
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

    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap&v=weekly"
        defer></script> --}}

    {{-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU&callback=initMap&v=weekly"
      defer
    ></script> --}}

    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyC5tG6oR6w2vKxmR7F9PN93MmstFUkpReU">
    </script>
    <script src="https://cdn.rawgit.com/googlemaps/js-marker-clusterer/gh-pages/src/markerclusterer.js"></script>

    <script>
        var latitudePickup = '{{ $order->pick_up->getLat() }}';
        var longitudePickup = '{{ $order->pick_up->getLng() }}';

        var latitudeDestination = '{{ $order->destination->getLat() }}';
        var longitudeDestination = '{{ $order->destination->getLng() }}';

        console.log(latitudePickup);
        console.log(longitudePickup);
        console.log(latitudeDestination);
        console.log(longitudeDestination);

        let centerLatitude = 6.8921079535158425;
        let centerLongitude = 3.7238427073652787;

        function initMap() {
            // map options
            var options = {
                zoom: 17,
                center: {
                    lat: centerLatitude,
                    lng: centerLongitude
                }
            }
            var map = new google.maps.Map(document.getElementById('map'), options);
            // Add a marker clusterer to manage the markers.

            //Add marker
            var markers = [

                //Dublin
                {
                    coords: {
                        lat: +latitudePickup,
                        lng: +longitudePickup
                    },
                    iconImage: 'assets/img/places/stparkdublin.png',
                    content: '<h1>Pick up Point'
                },
                {
                    coords: {
                        lat: +latitudeDestination,
                        lng: +longitudeDestination
                    },
                    iconImage: 'assets/img/places/botanic garden.png',
                    content: '<h1>Destination</h1>'
                },
            ];

            // Loop through markers
            var gmarkers = [];
            for (var i = 0; i < markers.length; i++) {
                gmarkers.push(addMarker(markers[i]));

            }

            //Add MArker function
            function addMarker(props) {
                var marker = new google.maps.Marker({
                    position: props.coords,
                    map: map,

                });

                /* if(props.iconImage){
                  marker.setIcon(props.iconImage);
                } */

                //Check content
                if (props.content) {
                    var infoWindow = new google.maps.InfoWindow({
                        content: props.content
                    });
                    marker.addListener('click', function() {
                        infoWindow.open(map, marker);
                    });
                }
                return marker;
            }
            var markerCluster = new MarkerClusterer(map, gmarkers, {
                imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
            });
        }
        google.maps.event.addDomListener(window, 'load', initMap)
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
