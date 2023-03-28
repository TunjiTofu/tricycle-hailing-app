@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Update Rider: {{ $rider->username }}</h4>
                            <form class="form-horizontal mt-3" method="POST"
                                action="{{ route('adminrider.update', $rider->id) }}">
                                {{ method_field('PATCH') }} {{-- @method('PATCH') --}}
                                @csrf

                                {{-- <div class="form-group mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Rider</label>
                                    <div class="col-4">
                                        <select class="form-control select2" id="rider_id" required name="rider_id">
                                            <option value="">Select Rider</option>
                                            @foreach ($riders as $rider)
                                                <option value="{{ $rider->id }}"
                                                    {{ $rider->id == $keke->rider_id ? 'selected="selected"' : '' }}>
                                                    {{ $rider->surname }},
                                                    {{ $rider->other_name }}
                                                    ({{ $rider->username }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('rider_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-4">
                                        <input class="form-control" id="username" name="username" type="text"
                                            value="{{ $rider->username }}" required="" placeholder="Username">
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Keke's Color</label>
                                    <div class="col-4">
                                        <input class="form-control" id="color" name="color" type="color"
                                            value="{{ $keke->color }}" required="" placeholder="Color">
                                        @error('color')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group text-center row mt-3 pt-1">
                                    <div class="col-6">
                                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Update
                                            Rider</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
