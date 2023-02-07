@extends('admin.dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Change Password</h4> <br>

                            <form action="{{ route('admin.password-update') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3 row">
                                    <div class="col-6">
                                        <input class="form-control" type="password" id="password" name="old_password"
                                            required="" placeholder="Old Password">
                                        @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-6">
                                        <input class="form-control" type="password" id="password" name="new_password"
                                            required="" placeholder="Password">
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <div class="col-6">
                                        <input class="form-control" type="password" id="conf-password"
                                            name="confirm_password" required="" placeholder="Confirm Password">
                                        @error('confirm_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group text-center row mt-3 pt-1">
                                    <div class="col-6">
                                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Update
                                            Password</button>
                                        {{-- <input type="submit" name="submit" value="Update Profile"
                                            class="btn btn-info w-100 waves-effect waves-light"> --}}
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


        </div>
    </div>
@endsection
