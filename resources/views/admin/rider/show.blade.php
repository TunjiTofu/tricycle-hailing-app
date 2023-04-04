@extends('admin.dashboard')
@section('admin')
    {{-- <div class="page-content"> --}}
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <br><br>
                        <center>
                            <img class="img-fluid rounded me-2 " width="200" data-holder-rendered="true"
                                src="{{ asset($rider->picture) }}" alt="Card image cap">
                        </center>
                        <div class="card-body">
                            <p class="card-title"> <strong> Username: </strong> {{ $rider->username }}</p>
                            <hr>
                            <p class="card-title"> <strong> Email: </strong> {{ $rider->email }}</p>
                            <hr>
                            <p class="card-title"> <strong> Full Name: </strong> {{ ucwords($rider->surname) }},
                                {{ $rider->other_name }}</p>
                            <hr>
                            <p class="card-title"> <strong> Sex: </strong>
                                @if ($rider->sex == 'm')
                                    {{ 'Male' }}
                                @else
                                    {{ 'Female' }}
                                @endif
                            </p>
                            <hr>
                            <p class="card-title"> <strong> Status: </strong> {{ $rider->status }}</p>
                            <hr>
                            <p class="card-title"> <strong> Date of Birth: </strong> {{ $rider->dob }}</p>
                            <hr>
                            <p class="card-title"> <strong> Phone Number: </strong> {{ $rider->phone }}</p>
                            <hr>
                            <p class="card-title"> <strong> Date Created: </strong>
                                {{ Carbon\Carbon::parse($rider->created_at)->toDayDateTimeString() }}</p>
                            <hr>
                            <p class="card-title"> <strong> Last Updated: </strong>
                                {{ Carbon\Carbon::parse($rider->updated_at)->diffForHumans() }}</p>
                            <hr>
                            <a href="{{ route('adminrider.index') }}" class="btn btn-danger btn-lg"><i
                                    class="fas fa-arrow-left"></i> All Riders</a>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
@endsection
