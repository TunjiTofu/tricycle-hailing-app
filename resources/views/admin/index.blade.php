@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-3">
                    <div class="card border border-info">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary  text-center"><i class="fas fa-coins"></i>Payment for Today</h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center;" class="text-primary">&#8358; {{ $dailyAmount }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border border-primary">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary text-center"><i class="fas fa-money-bill-alt"></i>Total Payment
                                Realised</h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center;" class="text-primary">&#8358; {{ $totalAmount }}</h1>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-3">
                    <div class="card border border-danger">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary text-center"><i class="fas fa-users"></i>Total Number of Users</h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center;" class="text-primary">{{ $user }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border border-dark">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary text-center"><i class="fas fa-map-marker-alt"></i>Total Number of Locations
                            </h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center;" class="text-primary">{{ $place }}</h1>
                        </div>
                    </div>
                </div> --}}
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card border border-info">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary text-center"><i class="fas fa-users-cog"></i>Total Number of Admins
                            </h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center;" class="text-primary">{{ $admin }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border border-primary">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary text-center"><i class="fas fa-user-tag"></i>Total Number of Riders
                            </h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center;" class="text-primary">{{ $rider }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border border-danger">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary text-center"><i class="fas fa-users"></i>Total Number of Users</h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center;" class="text-primary">{{ $user }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border border-dark">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary text-center"><i class="fas fa-map-marker-alt"></i>Total Number of
                                Locations
                            </h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center;" class="text-primary">{{ $place }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card bg-dark text-white-50">
                        <div class="card-header bg-transparent border-danger">
                            <h5 class="text-center" style="color:#ffffff;"><i class="fas fa-car-alt"></i>Total Number of
                                Kekes</h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center;color:#ffffff;">{{ $kekes }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card bg-danger text-white-50">
                        <div class="card-header bg-transparent border-danger">
                            <h5 class="text-center" style="color:#ffffff;"><i class="fas fa-car-alt"></i>Kekes in Transit
                            </h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center; color:#ffffff;">{{ $kekeTransit }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card bg-primary text-white-50">
                        <div class="card-header bg-transparent border-danger">
                            <h5 class="text-center" style="color:#ffffff;"><i class="fas fa-money-bill-alt"></i>Total Orders
                            </h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center; color:#ffffff;">{{ $ordersTotal }}</h1>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card bg-info text-white-50">
                        <div class="card-header bg-transparent ">
                            <h5 class="text-center" style="color:#ffffff"><i class=" fas fa-coins"></i>Pending Orders</h5>
                        </div>
                        <div class="card-body">
                            <h1 style="text-align: center;color:#ffffff;">{{ $ordersPending }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
