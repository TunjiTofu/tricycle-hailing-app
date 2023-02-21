@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Places</h4>
                            <p class="card-title-desc">Places in the database
                            </p>

                            <div class="my-4 ">
                                <a href="{{ route('place.create') }}" class="btn btn-info waves-effect waves-light">Add a New
                                    Location</a>
                            </div>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Coordinates</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @php($i = 1)
                                    @foreach ($places as $place)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $place->name }}</td>
                                            <td>
                                                Latitude: {{ $place->coordinates->getLat() }} <br>
                                                Longitude: {{ $place->coordinates->getLng() }}
                                            </td>
                                            <td>{{ $place->status }}</td>
                                            <td><b>Created:</b>
                                                {{ Carbon\Carbon::parse($place->created_at)->toDayDateTimeString() }} <br>
                                                <b>Last Updated:</b>
                                                {{ Carbon\Carbon::parse($place->updated_at)->diffForHumans() }}
                                            </td>
                                            <td>
                                                <form method="post" action="{{ route('place.destroy', $place->id) }}">
                                                    @method('delete')
                                                    @csrf

                                                    <a href="{{ route('place.show', $place->id) }}"
                                                        class="btn btn-primary sm" title="View Record"><i
                                                            class="fas fa-eye"></i> </a>

                                                    <a href="{{ route('place.edit', $place->id) }}"
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

                    <!-- sample modal content -->
                    {{-- <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Add New Keke</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form class="form-horizontal mt-3" method="POST" action="{{ route('keke.store') }}">
                                        @csrf

                                        <div class="form-group mb-3 row">
                                            <div class="col-12">
                                                <select class="form-control select2" id="rider_id" required name="rider_id"
                                                    value="{{ old('rider_id') }}">
                                                    <option selected value="">Select Rider</option>
                                                    @foreach ($riders as $rider)
                                                        <option value="{{ $rider->id }}">{{ $rider->surname }},
                                                            {{ $rider->other_name }} ({{ $rider->username }})</option>
                                                    @endforeach
                                                </select>
                                                @error('rider_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group mb-3 row">
                                            <div class="col-6">
                                                <input class="form-control" id="plate_no" name="plate_no" type="text"
                                                    value="{{ old('plate_no') }}" required="" placeholder="Plate Number"
                                                    pattern="Keke-\d\d\d\d">
                                                <span class="text-danger">Sample Date: Keke-1111</span><br>
                                                @error('plate_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-6">
                                                <input class="form-control" id="color" name="color" type="color"
                                                    value="{{ old('color') }}" required="" placeholder="Color">
                                                @error('color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect"
                                        data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-info waves-effect waves-light" type="submit">Add Keke</button>
                                </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -- --}}
                </div>


            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>
    </div>
@endsection
