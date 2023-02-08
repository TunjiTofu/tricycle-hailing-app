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

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Keke ID</th>
                                    <th>Plate Number</th>
                                    <th>Color</th>
                                    <th>Rider</th>
                                    <th>Rider</th>
                                    <th>Rider</th>
                                </tr>
                                </thead>


                                <tbody>
                                    @php($i = 1)
                                    @foreach ($kekes as $keke)
                                        
                                <tr>
                                    <td>{{ $keke->plate_no }}</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


        </div>
    </div>

    
@endsection
