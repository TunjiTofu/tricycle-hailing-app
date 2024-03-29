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

                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>
    </div>
@endsection
