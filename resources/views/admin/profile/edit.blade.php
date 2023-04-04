@extends('admin.dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    {{-- <div class="page-content"> --}}
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Profile</h4><br>

                            <form action="{{ route('admin.profile-save') }}" method="POST" 
                                enctype="multipart/form-data">
                                @csrf

                                <input required name="id" type="hidden" value="{{ $editData->id }}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" id="email" required name="email" type="email"
                                            value="{{ $editData->email }}" placeholder="Email">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <label for="example-text-input" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-4">
                                        <input class="form-control" id="username" name="username" type="text"
                                            value="{{ $editData->username }}" required="" placeholder="Username">
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Surname</label>
                                    <div class="col-4">
                                        <input class="form-control" id="surname" name="surname" type="text"
                                            value="{{ $editData->surname }}" required="" placeholder="Surname">
                                        @error('surname')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <label for="example-text-input" class="col-sm-2 col-form-label">Other Names</label>
                                    <div class="col-4">
                                        <input class="form-control" id="oname" name="oname" type="text"
                                            value="{{ $editData->other_name }}" required="" placeholder="Other Names">
                                        @error('oname')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Sex</label>
                                    <div class="col-4">
                                        <input class="form-check-input" type="radio" name="sex" id="m"
                                            value="m" {{ $editData->sex == 'm' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="m">
                                            Male
                                        </label>
                                        &nbsp;&nbsp;&nbsp;
                                        <input class="form-check-input" type="radio" name="sex" id="f"
                                            value="f" {{ $editData->sex == 'f' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="f">
                                            Female
                                        </label><br>
                                        @error('sex')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <label for="example-text-input" class="col-sm-2 col-form-label">Date of Birth</label>
                                    <div class="col-4">
                                        <input class="form-control" name="dob" type="date" id="date"
                                            value="{{ $editData->dob }}" required>
                                        @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Profile
                                        Picture</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="file" id="photo" name="photo"
                                            value="{{ old('photo') }}">
                                        @error('photo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <label for="example-text-input" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-4">
                                        <input class="form-control" id="phone" name="phone" type="tel"
                                            value="{{ $editData->phone }}" required="" placeholder="Phone Number">
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id='showImage' class="rounded avatar-lg"
                                            src="{{ asset($editData->picture) }}" alt="Profile Picture"
                                            data-holder-rendered="true">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="form-group text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info w-100 waves-effect waves-light"
                                            type="submit">Update</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


        </div>
    {{-- </div> --}}

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
