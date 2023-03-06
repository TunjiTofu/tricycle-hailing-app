@extends('passenger.dashboard')
@section('passenger')
    {{-- @vite(['resources/js/app.js']) --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    @if ($checkUser)
                                        <a href="{{ route('passenger.end') }}" class="btn btn-danger btn-lg"
                                            style="width: 100%; height: 100%;">End Trip</a>
                                    @else
                                        <a href="{{ route('passenger.book') }}" class="btn btn-primary btn-lg"
                                            style="width: 100%; height: 100%;">Book a Ride</a>
                                    @endif

                                </div>
                                <div class="avatar-md">
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                {{-- <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Current Status</p>
                                    <h4 class="mb-2" id="statusText">{{ ucfirst($profileData->status) }}</h4>
                                </div>
                                <div class="avatar-md">
                                    <span>
                                        <input data-id="{{ $profileData->id }}" type="checkbox" id="switch1"
                                            class="toggle-class" switch="none"
                                            {{ $profileData->status == 'active' ? 'checked' : '' }} />
                                        <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                    </span>
                                </div> --}}
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <?php
                                    // if(($tripHistory != null)&& ($tripHistory->status == 1)){
                                    ?>
                                    {{-- <button type="button" id="stopText" data-id="{{ $profileData->id }}"
                                        data-keke="{{ $kekeData->plate_no }}"
                                        class="stop-trip btn btn-success btn-lg waves-effect waves-light"
                                        style="width: 100%; height: 100%; background-color: red"><i
                                            class="ri-check-line align-middle me-2"></i>Stop Trip</button>

                                    <button type="button" id="startText" data-id="{{ $profileData->id }}"
                                        data-keke="{{ $kekeData->plate_no }}"
                                        class="start-trip btn btn-success btn-lg waves-effect waves-light"
                                        style="width: 100%; height: 100%; display: none"><i
                                            class="ri-check-line align-middle me-2"></i>Start Trip</button> --}}
                                    <?php
                                    //  }else {
                                    ?>
                                    {{-- <button type="button" id="startText" data-id="{{ $profileData->id }}"
                                        data-keke="{{ $kekeData->plate_no }}"
                                        class="start-trip btn btn-success btn-lg waves-effect waves-light"
                                        style="width: 100%; height: 100%;"><i
                                            class="ri-check-line align-middle me-2"></i>Start Trip</button>

                                    <button type="button" id="stopText" data-id="{{ $profileData->id }}"
                                        data-keke="{{ $kekeData->plate_no }}"
                                        class="stop-trip btn btn-success btn-lg waves-effect waves-light"
                                        style="width: 100%; height: 100%; background-color: red; display: none"><i
                                            class="ri-check-line align-middle me-2"></i>Stop Trip</button> --}}
                                    <?php
                                    
                                    //  }
                                    ?>

                                </div>
                                <div class="avatar-md">
                                    <span>
                                        <label id="tripText"></label>
                                        {{-- <input data-id="{{ $profileData->id }}" type="checkbox" id="switch1"
                                            class="toggle-class" switch="none"
                                            {{ $profileData->status == 'active' ? 'checked' : '' }} />
                                        <label for="switch1" data-on-label="On" data-off-label="Off"></label> --}}
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>

            {{-- <div class="row">
                <div class="col-xl-12">
                    <div id="map" style="width: auto; height: 500px; border:1px solid red"></div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Sales</p>
                                    <h4 class="mb-2">1452</h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i
                                                class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from
                                        previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-shopping-cart-2-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">New Orders</p>
                                    <h4 class="mb-2">938</h4>
                                    <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i
                                                class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from
                                        previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">New Users</p>
                                    <h4 class="mb-2">8246</h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i
                                                class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from
                                        previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-user-3-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Unique Visitors</p>
                                    <h4 class="mb-2">29670</h4>
                                    <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i
                                                class="ri-arrow-right-up-line me-1 align-middle"></i>11.7%</span>from
                                        previous period</p>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-btc font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Order History</h3>
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Date</th>
                                        <th>Keke Details</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @php($i = 1)
                                    @foreach ($oderHistory as $history)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($history->created_at)->toDayDateTimeString() }} <br>
                                                <strong>({{ Carbon\Carbon::parse($history->created_at)->diffForHumans() }})</strong>
                                            </td>
                                            <td>
                                                Keke ID: {{ $history->keke_id }} <br>
                                                Rider: {{ $history->user->username }}
                                                {{-- Rating: {{ $history->rating->rating }} --}}
                                            </td>
                                            <td>
                                                
                                                @if (isset($history->rating->rating))
                                                    <input type="hidden" class="rating"
                                                        data-filled="mdi mdi-star text-primary"
                                                        data-empty="mdi mdi-star-outline text-primary" data-fractions="2"
                                                        value="{{ $history->rating->rating }}" data-readonly />
                                                @else
                                                <input type="text" id="rider-id" value="{{ $history->rider_id }}">
                                                <input type="text" id="book-id" value="{{ $history->id }}">
                                                    <div class="rating-star">
                                                        <input type="hidden" id="rider-rating" class="rating"
                                                            data-id="{{ $history->rider_id }}"
                                                            data-filled="mdi mdi-star text-primary"
                                                            data-empty="mdi mdi-star-outline text-primary"
                                                            data-fractions="2" />
                                                    </div>
                                                @endif


                                                {{-- <button class="btn btn-info waves-effect waves-light" data-bs-toggle="modal"
                                                data-bs-target="#myModal"> Rate Rider</button> --}}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->
 
            {{-- Ajax Loader Spinner --}}
            <div class="bground" style="display: none">
                <div class="spinner">
                </div>
            </div>

        </div>

    </div>

    <script>
        $(function() {
                $('.rating-star').click(function() {
                    console.log('Rating Clicked');
                    $('.bground').show();
                    var rating = document.getElementById("rider-rating").value;
                    var rider_id = document.getElementById("rider-id").value;
                    var book_id = document.getElementById("book-id").value;
                    // var rider_id = $(this).data('id');
                    console.log('Rating ' + rating);
                    console.log('Rider ' + rider_id);
                    console.log('Booking ' + book_id);


                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '{{ route('passenger.trip.rate') }}',
                        data: {
                            'rider_id': rider_id,
                            'rating': rating,
                            'book_id': book_id,
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
                            toastr.options.closeButton = true;
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.options.closeDuration = 100;
                            toastr.error('Error Rating Trip');
                        },
                        complete: function() {
                            $('.bground').hide();
                            setTimeout(() => {
                                        window.location =
                                            '{{ route('passenger.dashboard') }}'
                                    }, 3000);
                        }

                    });
                })
            })


            <
            script >
            $(function() {
                $('.start-trip').click(function() {
                    console.log('Started');
                    var lat;
                    var lng;
                    var user_id = $(this).data('id');
                    var keke_id = $(this).data('keke');
                    $('#startText').text('Starting Trip...');

                    navigator.geolocation.getCurrentPosition(
                        function(position) {

                            // initMap(position.coords.latitude, position.coords.longitude)

                            lat = position.coords.latitude;
                            lng = position.coords.longitude;

                            console.log('Lat - ' + lat);
                            console.log('Lng - ' + lng);
                            console.log('User Id - ' + user_id);
                            console.log('Keke Id - ' + keke_id);

                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: '{{ route('rider.start.trip') }}',
                                data: {
                                    'latitude': lat,
                                    'longitude': lng,
                                    'rider_id': user_id,
                                    'keke_id': keke_id,
                                },
                                success: function(data) {
                                    // $('#startText').text('Stop Trip');
                                    $('#tripText').text('On a Trip');
                                    // $('button#startText').css('background-color', 'red');;
                                    $('#stopText').css('display', 'block');
                                    $('#startText').css('display', 'none');
                                    toastr.options.closeButton = true;
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 100;
                                    toastr.info(data.success);
                                },
                                error: function(status) {
                                    toastr.options.closeButton = true;
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 100;
                                    toastr.error('Error Starting Trip');
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

        $(function() {
            $('.stop-trip').click(function() {
                console.log('Stopping');
                var lat;
                var lng;
                var user_id = $(this).data('id');
                var keke_id = $(this).data('keke');
                $('#stopText').text('Stoping Trip...');

                navigator.geolocation.getCurrentPosition(
                    function(position) {

                        // initMap(position.coords.latitude, position.coords.longitude)

                        lat = position.coords.latitude;
                        lng = position.coords.longitude;

                        console.log('Lat - ' + lat);
                        console.log('Lng - ' + lng);
                        console.log('User Id - ' + user_id);
                        console.log('Keke Id - ' + keke_id);

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: '{{ route('rider.stop.trip') }}',
                            data: {
                                'latitude': lat,
                                'longitude': lng,
                                'rider_id': user_id,
                                'keke_id': keke_id,
                            },
                            success: function(data) {
                                $('#stopText').css('display', 'none');
                                $('#startText').css('display', 'block');
                                // $('#tripText').text('Trip Ended');
                                // $('button#startText').css('background-color', 'red');;

                                window.location = '{{ route('rider.dashboard') }}'
                                toastr.options.closeButton = true;
                                toastr.options.closeMethod = 'fadeOut';
                                toastr.options.closeDuration = 100;
                                toastr.info(data.success);
                            },
                            error: function(status) {
                                toastr.options.closeButton = true;
                                toastr.options.closeMethod = 'fadeOut';
                                toastr.options.closeDuration = 100;
                                toastr.error('Error Starting Trip');
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


        function notifyRider(msg) {
            console.log('Book Ride Msg - '+ msg);
        }
        // function updateTripDB(msg) {
        //     console.log('Message - ' + msg);

        //     navigator.geolocation.getCurrentPosition(
        //         function(position) {

        //             latt = position.coords.latitude;
        //             lngg = position.coords.longitude;

        //             console.log('Browser Detected');
        //             console.log('Lat - ' + latt);
        //             console.log('Lng - ' + lngg);

        //             $.ajax({
        //                 type: "GET",
        //                 dataType: "json",
        //                 url: '{{ route('rider.update.trip') }}',
        //                 data: {
        //                     'latitude': latt,
        //                     'longitude': lngg,
        //                 },
        //                 success: function(data) {
        //                     console.log(data.success);
        //                 },
        //                 error: function(data) {
        //                     console.log(data.success);
        //                 }
        //             });


        //         }
        //     );


        // }
    </script>
    {{-- <script>
        $(function() {
            $('.toggle-class').click(function() {
                var status = $(this).prop('checked') == true ? 'active' : 'inactive';
                var user_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('rider.change.status') }}',
                    data: {
                        'status': status,
                        'user_id': user_id
                    },
                    success: function(data) {
                        $('#statusText').text(status);
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.info(data.success);
                    }
                });
            })
        })
    </script> --}}

    {{-- <script>
        window.onload = function() {
            Echo.channel('tricycleApp')
                .listen('BookRide', (e) => {
                    console.log(e);
                    notifyRider(e.msg.text)
                });
        }
    </script> --}}
@endsection
