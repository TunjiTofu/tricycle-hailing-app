@extends('admin.dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Riders</h4>
                            <p class="card-title-desc">All Riders in the database
                            </p>

                            <div class="my-4 ">
                                <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal"
                                    data-bs-target="#myModal">Add New Rider</button>
                            </div>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @php($i = 1)
                                    @foreach ($riders as $rider)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                {{ ucfirst($rider->surname) }}, {{ ucfirst($rider->other_name) }} <br>
                                                <b>Username: </b> {{ ucfirst($rider->username) }} <br>
                                                <b>Email: </b> {{ $rider->email }}
                                            </td>

                                            <td>
                                                @if ($rider->sex == 'm')
                                                    {{ 'Male' }}
                                                @else
                                                    {{ 'Female' }}
                                                @endif
                                            </td>
                                            <td>{{ $rider->status }}</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($rider->created_at)->toDayDateTimeString() }} <br>
                                            </td>
                                            <td>


                                                <form method="post" action="{{ route('adminrider.destroy', $rider->id) }}">
                                                    @method('delete')
                                                    @csrf

                                                    <a href="{{ route('adminrider.show', $rider->id) }}"
                                                        class="btn btn-primary sm" title="Edit Record"><i
                                                            class="fas fa-eye"></i> </a>

                                                    <a href="{{ route('adminrider.edit', $rider->id) }}"
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
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel">Add New Keke</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="p-3">
                                        <form class="form-horizontal mt-3" method="POST" action="{{ route('adminrider.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group mb-3 row">
                                                <div class="col-12">
                                                    <input class="form-control" id="email" required name="email"
                                                        type="email" value="{{ old('email') }}" placeholder="Email">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group mb-3 row">
                                                <div class="col-6">
                                                    <input class="form-control" id="username" name="username"
                                                        type="text" value="{{ old('username') }}" required=""
                                                        placeholder="Username">
                                                    @error('username')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-6">
                                                    <input class="form-control" id="phone" name="phone" type="tel"
                                                        value="{{ old('phone') }}" required=""
                                                        placeholder="Phone Number">
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group mb-3 row">
                                                <div class="col-12">
                                                    <input class="form-control" id="surname" name="surname" type="text"
                                                        value="{{ old('surname') }}" required="" placeholder="Surname">
                                                    @error('surname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group mb-3 row">
                                                <div class="col-12">
                                                    <input class="form-control" id="oname" name="oname" type="text"
                                                        value="{{ old('oname') }}" required=""
                                                        placeholder="Other Names">
                                                    @error('oname')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group mb-3 row">
                                                <div class="col-6">
                                                    <h class="font-size-13" style="font-weight: bold">Sex</h> <br>
                                                    <input class="form-check-input" type="radio" name="sex"
                                                        id="m" value="m">
                                                    <label class="form-check-label" for="m">
                                                        Male
                                                    </label>
                                                    <input class="form-check-input" type="radio" name="sex"
                                                        id="f" value="f">
                                                    <label class="form-check-label" for="f">
                                                        Female
                                                    </label><br>
                                                    @error('sex')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-6">
                                                    <input class="form-control" name="dob" type="date"
                                                        id="date" value="{{ old('dob') }}" required>
                                                    @error('dob')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-4 col-form-label">Profile
                                                    Picture</label>
                                                <div class="col-sm-8">
                                                    <input class="form-control" type="file" id="photo"
                                                        name="photo" value="{{ old('photo') }}">
                                                    @error('photo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end row -->

                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                                <div class="col-sm-10">
                                                    <img id='showImage' class="rounded avatar-lg"
                                                        src="{{ url('upload/no_image.jpg') }}" alt="Profile Picture"
                                                        data-holder-rendered="true">
                                                </div>
                                            </div>
                                            <!-- end row -->

                                            <div class="form-group mb-3 row">
                                                <div class="col-6">
                                                    <input class="form-control" type="password" id="password"
                                                        name="password" required="" placeholder="Password">
                                                    @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <input class="form-control" type="password" id="conf-password"
                                                        name="password_confirmation" required=""
                                                        placeholder="Confirm Password">
                                                    @error('password_confirmation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group mb-3 row">
                                                <div class="col-12">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1">
                                                        <label class="form-label ms-1 fw-normal" for="customCheck1">I
                                                            accept <a href="#" class="text-muted">Terms and
                                                                Conditions</a></label>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect"
                                        data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-info waves-effect waves-light" type="submit">Add Rider</button>
                                </div>
                                </form>
                                <!-- end form -->
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>


            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#photo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
