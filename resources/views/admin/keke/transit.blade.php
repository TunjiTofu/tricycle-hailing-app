@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
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
                                        <th>Color</th>
                                        <th>Rider</th>
                                        <th>Date</th>
                                        <th>Actions</th>
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
                                                {{ Carbon\Carbon::parse($keke->start_trip_time)->toDayDateTimeString() }} <br>
                                                <b>Last Updated:</b>
                                                {{ Carbon\Carbon::parse($keke->start_trip_time)->diffForHumans() }}
                                                <br>
                                                Location {{ $keke->start_location->getlat()}}, {{ $keke->start_location->getlng()}}
                                            </td>
                                            <td></td>
                                            <td><b>Created:</b>
                                                {{ Carbon\Carbon::parse($keke->created_at)->toDayDateTimeString() }} <br>
                                                <b>Last Updated:</b>
                                                {{ Carbon\Carbon::parse($keke->updated_at)->diffForHumans() }}
                                            </td>
                                            <td>

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
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
