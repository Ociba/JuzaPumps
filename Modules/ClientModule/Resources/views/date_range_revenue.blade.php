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
                                <form action="/clientmodule/search-by-data-range" method="get">
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
                                                <th>Amount</th>
                                                <th>Created at</th> 
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($daily_revenue as $i =>$riders)
                                            <tr>
                                            @php
                                                if( $daily_revenue->currentPage() == 1){
                                                    $i = $i+1;
                                                }else{
                                                    $i = ($i+1) + 10*($daily_revenue->currentPage()-1);
                                                }
                                            @endphp
                                            <th scope="row">{{$i}}</th> 
                                                <td>{{$riders->other_names}}</td> 
                                                <td>{{$riders->first_name}}</td> 
                                                <td>{{$riders->telephone}}</td> 
                                                <td>{{$riders->number_plate}}</td> 
                                                <td>{{ number_format($riders->charge)}} /=</td> 
                                                <td>{{ $riders->created_at}} </td> 
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
                                        {{$daily_revenue->links()}}
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