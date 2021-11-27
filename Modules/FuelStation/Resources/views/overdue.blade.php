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
                                <div class="card-title">
                                <div class="row">
                                <div class="col-lg-4">
                                   A table showing {{request()->route()->getName()}}
                                </div>
                                <div class="col-lg-4 mb-2">
                                </div>
                                <div class=" col-lg-4">
                                    <form action="/reportmodule/search-overdue-debts" method="get">
                                        <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="number_plate" placeholder="Search Number Plate" aria-label="" aria-describedby="basic-addon1">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info btn-lg text-white" type="submit">Search</button>
                                                </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr style="text-transform: uppercase;font-weight:bold;font-family: Times New Roman, Times, serif;">
                                                <th>#</th>
                                                <th>First Name</th> 
                                                <th>Other Names</th> 
                                                <th>Telephone</th> 
                                                <th>Number Plate</th> 
                                                <th>Stage</th> 
                                                <th>Debt</th> 
                                                <th>OverDue Charge</th> 
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($get_all_client_with_overdue_payments as $i =>$riders)
                                            <tr>
                                            @php
                                                if( $get_all_client_with_overdue_payments->currentPage() == 1){
                                                    $i = $i+1;
                                                }else{
                                                    $i = ($i+1) + 10*($get_all_client_with_overdue_payments->currentPage()-1);
                                                }
                                            @endphp
                                            <th scope="row">{{$i}}</th> 
                                                <td>{{$riders->other_names}}</td> 
                                                <td>{{$riders->first_name}}</td> 
                                                <td>{{$riders->telephone}}</td> 
                                                <td>{{$riders->number_plate}}</td> 
                                                <td>{{$riders->stage_name}}</td> 
                                                <td>{{$riders->debt}}</td><td></td>
                                                {{--<td>{{\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($riders->days))}}</td>--}}
                                                <td>
                                                    <a href="/clientmodule/view-more/{{$riders->id}}" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="View More Information">View</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="text-end ml-2">
                                        {{$get_all_client_with_overdue_payments->links()}}
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