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
                                                {{ $order->pick_up->getLng() }} <button class="btn btn-info btn-sm">View on
                                                    Map</button>
                                                <p></p>
                                                Destination: {{ $order->destination->getLat() }},
                                                {{ $order->destination->getLng() }} <button
                                                    class="btn btn-secondary btn-sm">View on Map</button><br>
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($order->created_at)->diffForHumans() }}
                                            </td>
                                            <td>
                                                <button class="mark btn btn-primary btn-sm" data-id="{{ $order->id }}"
                                                    type="submit"><i class="ri-arrow-right-line align-middle ms-2"></i>
                                                    Mark as
                                                    Read</button>
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

    <script>
        $(function() {
            $('.mark').click(function() {
                console.log('Mark Read Clicked');
                var orderId = $(this).data('id');
                console.log(orderId);

                $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: '{{ route('rider.order.mark') }}',
                            data: {
                                'order_id': orderId,
                            },
                            // success: function(data) {
                            //     if (data.success) {
                            //         console.log(data.success);
                            //         toastr.options.closeButton = true;
                            //         toastr.options.closeMethod = 'fadeOut';
                            //         toastr.options.closeDuration = 3000;
                            //         toastr.info(data.success);
                            //     }

                            //     if (data.error) {
                            //         console.log(data.error);
                            //         toastr.options.closeButton = true;
                            //         toastr.options.closeMethod = 'fadeOut';
                            //         toastr.options.closeDuration = 3000;
                            //         toastr.error(data.error);
                            //     }
                            // },
                            // error: function(status) {
                            //     console.log('Error Booking Trip');
                            //     toastr.options.closeButton = true;
                            //     toastr.options.closeMethod = 'fadeOut';
                            //     toastr.options.closeDuration = 100;
                            //     toastr.error('Error Starting Trip');
                            // },
                            // complete: function() {
                            //     $('.bground').hide();
                            //     // setTimeout(() => {
                            //     //         window.location =
                            //     //             '{{ route('passenger.dashboard') }}'
                            //     //     }, 5000);
                            // }
                        });

            })
        })
    </script>
@endsection
