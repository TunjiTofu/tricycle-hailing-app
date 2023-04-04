@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Kekes</h4>
                            <p class="card-title-desc">All Kekes in the database
                            </p>

                            <div class="my-4 ">
                                <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal"
                                    data-bs-target="#myModal">Add New Keke</button>
                            </div>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Keke ID</th>
                                        <th>Plate Number</th>
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
                                            <td>{{ $keke->plate_no }}</td>
                                            <td>
                                                <div
                                                    style="width: auto; height:auto; background-color:{{ $keke->color }}; color:{{ $keke->color }}">
                                                    {{ $keke->color }}
                                                </div>
                                            </td>
                                            <td>{{ ucfirst($keke->user->username) }}</td>
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

                    <!-- sample modal content -->
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    </div><!-- /.modal -->
                </div>


            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>
    </div>
@endsection
