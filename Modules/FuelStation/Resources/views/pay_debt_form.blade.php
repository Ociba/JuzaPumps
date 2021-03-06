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
                    @include('layouts.messages')
                    <div class="col-lg-12">
                        <div class="row mt-5">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-indigo text-white  text-center" style="background-color:#000066;">
                                    @php
                                        $amount = \DB::table('fuel_stations')->where('client_id',request()->route()->client_id)->where('status','pending')->value('debt');
                                        if(\DB::table('clients')->where('id',request()->client_id)->where('is_chairman',1)->exists()){
                                            $to_pay = $amount;
                                        }else{
                                            $to_pay = $amount + 0.1*$amount;
                                        }
                                    @endphp
                                <h4>Debt Ugshs: {{ $to_pay}}</h4>
                                </div>
                                <div class="card-body">
                                <form action="/fuelstation/pay-debt/{{request()->route()->client_id}}" method="get">
                                    <p class="card-tex">
                                         <input type="hidden" name="fuel_station_id" value="{{auth()->user()->id}}">
                                         <input type="hidden" name="client_id" value="{{request()->route()->client_id}}">
                                        <label>Amount</label>
                                        <input type="text" class="form-control" name="amount_paid" placeholder="Amount" value="{{$to_pay}}" readonly>
                                    </p>
                                    <button type="submit" class="btn text-white" style="background-color:#000066;">Pay Debt Now</button>
                                </form>
                                </div>
                            </div>
                             </div>
                            <div class="col-lg-4"></div>
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