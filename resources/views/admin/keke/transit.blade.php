@extends('admin.dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- <div class="page-content"> --}}
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">All Kekes on Transit</h4>
                        <p class="card-title-desc">All Kekes in Transit
                        </p>

                        {{-- <div class="my-4 ">
                                <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal"
                                    data-bs-target="#myModal">Add New Keke</button>
                            </div> --}}
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Keke ID</th>
                                    <th>Started</th>
                                    <th>Current Location</th>
                                    <th>Trip Ended</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                            </thead>


                            <tbody>
                                @php($i = 1)
                                @foreach ($kekes as $keke)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            {{ $keke->keke_id }} <br>
                                            Rider: <strong>{{ ucfirst($keke->user->username) }}</strong>
                                        </td>
                                        <td>
                                            {{ Carbon\Carbon::parse($keke->start_trip_time)->toDayDateTimeString() }}
                                            <br>
                                            <b>({{ Carbon\Carbon::parse($keke->start_trip_time)->diffForHumans() }})</b>
                                            <br>
                                            {{-- Location {{ $keke->start_location->getlat()}}, {{ $keke->start_location->getlng()}} --}}
                                        </td>
                                        <td>
                                            <?php
                                                    if(isset($keke->update_trip_time)){
                                                ?>
                                            {{ Carbon\Carbon::parse($keke->update_trip_time)->toDayDateTimeString() }}
                                            <br>
                                            <b>({{ Carbon\Carbon::parse($keke->update_trip_time)->diffForHumans() }})</b>
                                            <?php
                                                    }
                                                ?>

                                            <br>

                                            <?php
                                                if (isset($keke->current_location)) {
                                                    // echo $keke->current_location->getlat() . ', ' . $keke->current_location->getlng();
                                                    ?>
                                            <br>
                                            <button type="button" class="show-map btn btn-info waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#myModal"
                                                data-id="{{ $keke->keke_id }}"
                                                data-lat="{{ $keke->current_location->getLat() }}"
                                                data-lng="{{ $keke->current_location->getLng() }}">
                                                View Current Location on Map
                                            </button>
                                            <?php

                                                } 
                                                else {
                                                    echo 'Location Not Updated';
                                                }
                                                ?>

                                        </td>
                                        <td>

                                            <?php
                                                    if(isset($keke->end_trip_time)){
                                                ?>
                                            {{ Carbon\Carbon::parse($keke->end_trip_time)->toDayDateTimeString() }}
                                            <br>
                                            <b>({{ Carbon\Carbon::parse($keke->end_trip_time)->diffForHumans() }})</b>
                                            <?php
                                                    }
                                                    ?>


                                            <br>

                                            <?php
                                            if (isset($keke->end_location)) {
                                                echo $keke->end_location->getlat() . ', ' . $keke->end_location->getlng();
                                            } else {
                                                echo 'This Keke Is Currently In Transit';
                                            }
                                            ?>
                                        </td>
                                        {{-- <td>

                                                <form method="post" action="{{ route('keke.destroy', $keke->id) }}">
                                                    @method('delete')
                                                    @csrf

                                                    <a href="{{ route('keke.edit', $keke->id) }}"
                                                        class="btn btn-secondary sm" title="Edit Record"><i
                                                            class="fas fa-edit"></i> </a>

                                                    <button type="submit"
                                                        class="btn btn-xs btn-danger waves-effect waves-light show_confirm"
                                                        data-toggle="tooltip"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td> --}}
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- sample modal content -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Keke's Location</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="map" style="width: auto; height: 800px; border:1px solid red"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        {{-- </div> --}}
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

                let centerLatitude = $(this).data('lat');
                let centerLongitude = $(this).data('lng');


                console.log(centerLatitude);
                console.log(centerLongitude);

                function initMap() {
                    // map options
                    var center = {
                        lat: centerLatitude,
                        lng: centerLongitude
                    }

                    // The map, centered at Current Location
                    map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 17,
                        center: center,
                        scrollwheel: false,
                    });

                    // The marker, positioned at Current Location
                    marker = new google.maps.Marker({
                        position: center,
                        map: map,
                        draggable: false,
                    });

                }
            })
        })
    </script>
@endsection
