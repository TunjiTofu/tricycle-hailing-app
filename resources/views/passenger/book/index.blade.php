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
                               Latitude: {{ $keke->current_location->getLat()}} 
                                Longitude: {{ $keke->current_location->getLng()}} <br>
                                Loc: {{ $keke->distance }} meters.

                            </td>
                            <td>
                                <button type="submit" class="btn btn-xs btn-success waves-effect waves-light show_confirm"
                                    data-toggle="tooltip">Book Ride <i class="ri-arrow-right-line align-middle ms-2"></i> </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
