@extends('rider.dashboard')
@section('rider')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <br><br>
                        <center>
                            <img class="img-fluid rounded me-2 " width="200" data-holder-rendered="true"
                                src="{{ asset($profileData->picture) }}" alt="Profile Picture Missing">
                        </center>
                        <div class="card-body">
                            <p class="card-title"> <strong> Username: </strong> {{ $profileData->username }}</p>
                            <hr>
                            <p class="card-title"> <strong> Email: </strong> {{ $profileData->email }}</p>
                            <hr>
                            <p class="card-title"> <strong> Full Name: </strong> {{ ucwords($profileData->surname) }},
                                {{ $profileData->other_name }}</p>
                            <hr>
                            <p class="card-title"> <strong> Sex: </strong> {{ $profileData->sex }}</p>
                            <hr>
                            <p class="card-title"> <strong> Date of Birth: </strong> {{ $profileData->dob }}</p>
                            <hr>
                            <p class="card-title"> <strong> Phone Number: </strong> {{ $profileData->phone }}</p>
                            <hr>
                            <a href="{{ route('rider.profile-edit') }}" class="btn btn-primary waves-effect waves-light">
                                Edit Profile <i class="ri-arrow-right-line align-middle ms-2"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
