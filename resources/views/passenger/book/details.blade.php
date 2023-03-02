@extends('passenger.dashboard')
@section('passenger')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <form action="{{ route('admin.profile-save') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Number of Passengers</label>
                    <div class="col-sm-10">
                        <select name="no_of_passengers" class="form-select" aria-label="Default select example">
                            <option selected="">--Number of Passengers--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        @error('no_of_passengers')
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
                <label for="example-text-input" class="col-sm-2 col-form-label">Destination</label><br>
                <span class="text-danger">Move the red marker on the map to key in your destination. You can also zoom in and out of the map for a better view</span><br>
                <div id="map" style="width: auto; height: 500px; border:1px solid red"></div>



                <div class="form-group text-center row mt-3 pt-1">
                    <div class="col-12">
                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Update</button>
                    </div>
                </div>

            </form>

            {{-- <div id="progrss-wizard" class="twitter-bs-wizard">
                <ul class="twitter-bs-wizard-nav nav-justified">
                    <li class="nav-item">
                        <a href="#progress-seller-details" class="nav-link" data-toggle="tab">
                            <span class="step-number">01</span>
                            <span class="step-title">Trip Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#progress-company-document" class="nav-link" data-toggle="tab">
                            <span class="step-number">02</span>
                            <span class="step-title">Company Document</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#progress-bank-detail" class="nav-link" data-toggle="tab">
                            <span class="step-number">03</span>
                            <span class="step-title">Bank Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#progress-confirm-detail" class="nav-link" data-toggle="tab">
                            <span class="step-number">04</span>
                            <span class="step-title">Confirm Detail</span>
                        </a>
                    </li>
                </ul>

                <div id="bar" class="progress mt-4">
                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                </div>
                <div class="tab-content twitter-bs-wizard-tab-content">
                    <div class="tab-pane" id="progress-seller-details">
                       



                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="progress-basicpill-firstname-input">Number of
                                            Passengers</label>
                                        <select name="passengers" id="passengers" class="form-select"
                                            aria-label="Default select example">
                                            <option selected="">--Number of Passengers--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                        @error('no_of_passengers')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <input class="form-control" id="destination-lat" name="latitude" type="text"
                                            value="{{ old('latitude') }}" required placeholder="Location Latitude">
                                        @error('latitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <input class="form-control" id="destination-lng" name="longitude" type="text"
                                            value="{{ old('longitude') }}" required placeholder="Location Longitude">
                                        @error('longitude')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="example-text-input"
                                            class="col-sm-2 col-form-label">Destination</label><br>
                                        <span class="text-danger">Move the red marker on the map to key in your destination.
                                            You can also zoom in and out of the map for a better view</span><br>
                                        <div id="map" style="width: auto; height: 300px; border:1px solid red"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="progress-company-document">
                        <div>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="progress-basicpill-pancard-input">PAN
                                                Card</label>
                                            <input type="text" class="form-control"
                                                id="progress-basicpill-pancard-input">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="progress-basicpill-vatno-input">VAT/TIN
                                                No.</label>
                                            <input type="text" class="form-control" id="progress-basicpill-vatno-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="progress-basicpill-cstno-input">CST No.</label>
                                            <input type="text" class="form-control" id="progress-basicpill-cstno-input">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="progress-basicpill-servicetax-input">Service
                                                Tax No.</label>
                                            <input type="text" class="form-control"
                                                id="progress-basicpill-servicetax-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="progress-basicpill-companyuin-input">Company
                                                UIN</label>
                                            <input type="text" class="form-control"
                                                id="progress-basicpill-companyuin-input">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="progress-basicpill-declaration-input">Declaration</label>
                                            <input type="text" class="form-control"
                                                id="progress-basicpill-declaration-input">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="progress-bank-detail">
                        <div>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="progress-basicpill-namecard-input">Name on
                                                Card</label>
                                            <input type="text" class="form-control"
                                                id="progress-basicpill-namecard-input">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label>Credit Card Type</label>
                                            <select class="form-select">
                                                <option selected>Select Card Type</option>
                                                <option value="AE">American Express</option>
                                                <option value="VI">Visa</option>
                                                <option value="MC">MasterCard</option>
                                                <option value="DI">Discover</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="progress-basicpill-cardno-input">Credit Card
                                                Number</label>
                                            <input type="text" class="form-control"
                                                id="progress-basicpill-cardno-input">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                for="progress-basicpill-card-verification-input">Card Verification
                                                Number</label>
                                            <input type="text" class="form-control"
                                                id="progress-basicpill-card-verification-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="progress-basicpill-expiration-input">Expiration
                                                Date</label>
                                            <input type="text" class="form-control"
                                                id="progress-basicpill-expiration-input">
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="progress-confirm-detail">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <div class="mb-4">
                                        <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                    </div>
                                    <div>
                                        <h5>Confirm Detail</h5>
                                        <p class="text-muted">If several languages coalesce, the grammar of the resulting
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="pager wizard twitter-bs-wizard-pager-link">
                    <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                    <li class="next" data-id="{{ $profileData->id }}"><a href="javascript: void(0);">Next</a></li>
                    <button type="button"
                        class="next  btn btn-primary waves-effect waves-light align-right">Next</button>
                </ul>
            </div> --}}

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
            console.log(currentLocation);

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
            $('.next').click(function() {
                console.log('Next Clicked');
                var user_id = $(this).data('id');
                var passengers = document.getElementById("passengers").value;
                var destination_lat = document.getElementById("destination-lat").value;
                var destination_lng = document.getElementById("destination-lng").value;
                navigator.geolocation.getCurrentPosition(
                    function(position) {

                        var current_lat = position.coords.latitude;
                        var current_lng = position.coords.longitude;

                        console.log(user_id);
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
                                'user_id': user_id,
                                'pickup_lat': current_lat,
                                'pickup_lng': current_lng,
                                'destination_lat': destination_lat,
                                'destination_lng': destination_lng,
                            },
                            success: function(data) {
                                if (data.error) {
                                    console.log(data.error);
                                }
                                if (data.success) {
                                    console.log(data.success);
                                }
                                // console.log(data.success);
                                // // $('#startText').text('Stop Trip');
                                // $('#tripText').text('On a Trip');
                                // // $('button#startText').css('background-color', 'red');;
                                // $('#stopText').css('display', 'block');
                                // $('#startText').css('display', 'none');
                                // toastr.options.closeButton = true;
                                // toastr.options.closeMethod = 'fadeOut';
                                // toastr.options.closeDuration = 100;
                                // toastr.info(data.success);
                            },
                            error: function(status) {
                                console.log('Error Booking Trip');
                                // toastr.options.closeButton = true;
                                // toastr.options.closeMethod = 'fadeOut';
                                // toastr.options.closeDuration = 100;
                                // toastr.error('Error Starting Trip');
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
