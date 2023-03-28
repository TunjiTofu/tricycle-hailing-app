<!doctype html>
<html lang="en">

<head> 

    <meta charset="utf-8" />
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>

<body class="auth-body-bg">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">

                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="index.html" class="auth-logo">
                                <img src="{{ asset('logo/eleblack.png') }}" height="50" class="logo-dark mx-auto"
                                    alt="">
                            </a>
                        </div>
                    </div>

                    <h4 class="text-muted text-center font-size-18"><b>User Registeration Form</b></h4>

                    <div class="p-3">
                        <form class="form-horizontal mt-3" method="POST" action="{{ route('register') }}"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="email" required name="email" type="email"
                                        value="{{ old('email') }}" placeholder="Email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group mb-3 row">
                                <div class="col-6">
                                    <input class="form-control" id="username" name="username" type="text"
                                        value="{{ old('username') }}" required="" placeholder="Username">
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <input class="form-control" id="phone" name="phone" type="tel"
                                        value="{{ old('phone') }}" required="" placeholder="Phone Number">
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
                                        value="{{ old('oname') }}" required="" placeholder="Other Names">
                                    @error('oname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group mb-3 row">
                                <div class="col-6">
                                    <h class="font-size-13" style="font-weight: bold">Sex</h> <br>
                                    <input class="form-check-input" type="radio" name="sex" id="m"
                                        value="m">
                                    <label class="form-check-label" for="m">
                                        Male
                                    </label>
                                    <input class="form-check-input" type="radio" name="sex" id="f"
                                        value="f">
                                    <label class="form-check-label" for="f">
                                        Female
                                    </label><br>
                                    @error('sex')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <input class="form-control" name="dob" type="date" id="date"
                                        value="{{ old('dob') }}" required>
                                    @error('dob')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-4 col-form-label">Profile
                                    Picture</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="file" id="photo" name="photo"
                                        value="{{ old('photo') }}">
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
                                    <input class="form-control" type="password" id="password" name="password"
                                        required="" placeholder="Password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <input class="form-control" type="password" id="conf-password"
                                        name="password_confirmation" required="" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="form-label ms-1 fw-normal" for="customCheck1">I accept <a
                                                href="#" class="text-muted">Terms and Conditions</a></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light"
                                        type="submit">Register</button>
                                </div>
                            </div>

                            <div class="form-group mt-2 mb-0 row">
                                <div class="col-12 mt-3 text-center">
                                    <a href="{{ route('login') }}" class="text-muted">Already have account?</a>
                                </div>
                            </div>
                        </form>
                        <!-- end form -->
                    </div>
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>
    <!-- end -->

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

    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

</body>

</html>
