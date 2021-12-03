<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
@include('layouts.css')
</head>

<body class="skin-blue fixed-layout">

    <!-- Preloader - style you can find in spinners.css -->

    @include('layouts.preloader')

    <!-- Main wrapper - style you can find in pages.scss -->

    <div id="main-wrapper">
        <!-- Topbar header - style you can find in pages.scss -->
        @include('layouts.navbar')
        <!-- End Topbar header -->

        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        @include('layouts.sidebar')
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Bread crumb and right sidebar toggle -->
                @include('layouts.breadcrumb')
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- .content -->
                <div class="row">
                    <div class="col-lg-12">
                    @include('layouts.messages')
                    <div class="card">
                            <div class="card-body">
                            <form action="/adminmodule/search-date-range-transaction" method="get">
                                        <div class="row">
                                        <div class=" col-lg-5">
                                            <div class="example mb-2">
                                                <div class="input-group">
                                                <label>From</label>
                                                    <input type="date" class="form-control mydatepicker" name="from_date" placeholder="mm/dd/yyyy">
                                                </div>
                                            </div>
                                       </div>
                                       <div class=" col-lg-5">
                                            <div class="example mb-2">
                                                <div class="input-group">
                                                    <label>To</label>
                                                    <input type="date" class="form-control mydatepicker" name="to_date" placeholder="mm/dd/yyyy">
                                                </div>
                                            </div>
                                       </div>
                                       <div class=" col-lg-2">
                                            <div class="example">
                                                        <div class="input-group-append">
                                                    <button class="btn btn-info btn-sm form-control text-white" type="submit">Search</button>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                    </form>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr style="text-transform: uppercase;font-weight:bold;font-family: Times New Roman, Times, serif;">
                                                <th>#</th>
                                                <th>Client</th> 
                                                <th>Number Plate</th>
                                                <th>Stage</th>
                                                <th>Stage Leader</th>
                                                <th>Stage Leader Contact</th>
                                                <th>Debts (sh)</th>  
                                                <th>Amount Paid (shs)</th> 
                                                <th>Paid On</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($get_transaction as $i =>$fuel_station)
                                            <tr>
                                            @php
                                                if( $get_transaction->currentPage() == 1){
                                                    $i = $i+1;
                                                }else{
                                                    $i = ($i+1) + 10*($get_transaction->currentPage()-1);
                                                }
                                            @endphp
                                            <th scope="row">{{$i}}</th> 
                                                <td>{{$fuel_station->other_names}} {{$fuel_station->first_name}}</td> 
                                                <td>{{$fuel_station->number_plate}}</td> 
                                                <td>{{$fuel_station->stage_name}}</td>
                                                <td>{{$fuel_station->stage_leader}}</td>
                                                <td>{{$fuel_station->stage_leader_contact}}</td> 
                                                <td>{{ number_format($fuel_station->debt)}}</td> 
                                                <td>{{number_format($fuel_station->amount_paid)}}</td> 
                                                <td>{{$fuel_station->created_at}}</td> 
                                                <td>{{$fuel_station->status}}</td> 
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="text-end ml-2">
                                        {{$get_transaction->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content -->
            
                <!-- Comment - table -->
            
                <!-- End Comment - chats -->
            
            
                <!-- End Page Content -->
            
            
                <!-- Right sidebar -->
            
                <!-- .right-sidebar -->
                @include('layouts.right-sidebar')
            
                <!-- End Right sidebar -->
            
            </div>
        
            <!-- End Container fluid  -->
        
        </div>
    
        <!-- End Page wrapper  -->
    
    
        <!-- footer -->
    
    @include('layouts.footer')
        <!-- End footer -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    @include('layouts.javascript')
</body>
</html>