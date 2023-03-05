@extends('passenger.dashboard')
@section('passenger')
    <div class="page-content">
        <div class="container-fluid">

            <h4>List of Available Triycles</h4>

            <table id="datatable" class="table table-striped table-bordered dt-responsive"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Keke Details</th>
                        <th>Current Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                <tbody>
                    @php($i = 1)
                    @foreach ($tripHistory as $keke)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                <b>Rider Name: </b> {{ $keke->user->username }} <br>
                                <b>Plate Number: </b> {{ $keke->keke_id }}
                            </td>
                            <td>
                                {{-- Latitude: {{ $keke->current_location->getLat() }}
                                Longitude: {{ $keke->current_location->getLng() }} <br> --}}
                                <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal"
                                    data-bs-target="#myModal">View Location on Map</button> <br>
                                <strong>This Keke is <span
                                    style="color: green; font-weight: bolder">{{ round($keke->distance, 2) }}</span> Meters Away! </strong> 
                            </td>
                            <td>
                                <form action="{{ route('passenger.book.select') }}" method="POST">
                                    @csrf
                                    <input class="form-control" id="" name="keke_id" type="text"
                                    value="{{ $keke->keke_id }}" required>
                                   
                                <button type="submit" class="btn btn-xs btn-success waves-effect waves-light"
                                    data-toggle="tooltip">Book Ride <i class="ri-arrow-right-line align-middle ms-2"></i>
                                </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <!-- sample modal content -->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Current Location of {{ $keke->keke_id }}</h5>
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
        let latitude = '{{ $keke->current_location->getLat() }}'
        let longitude = '{{ $keke->current_location->getLng() }}'

        // Initialize and add the map
        function initMap() {

            // The current location
            const currentLocation = {
                lat: +latitude,
                lng: +longitude
            };
            console.log(currentLocation);

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
            });

            //     google.maps.event.addListener(marker, 'position_changed',
            //         function() {
            //             let lat = marker.position.lat()
            //             let lng = marker.position.lng()
            //             // let name = marker.title()
            //             // console.log('Name -- ' + name);
            //             document.getElementById("lat").setAttribute('value', lat)
            //             document.getElementById("lng").setAttribute('value', lng)
            //             // document.getElementById("name").setAttribute('value', name)
            //         })
        }
    </script>
@endsection
