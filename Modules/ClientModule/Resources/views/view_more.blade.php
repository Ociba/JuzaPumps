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
                <!-- row -->
                <div class="row">
                    <!-- Column -->
                    @foreach($view_more_info as $more_info)
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="user-bg"> <img width="100%" height="330" alt="user" src="{{ asset('client_photos/'.$more_info->profile_photo_path)}}"> </div>
                           
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 border-end"> <strong>First Name</strong>
                                        <br>
                                        <p class="text-muted">{{$more_info->first_name}}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 border-end"> <strong>Other Names</strong>
                                        <br>
                                        <p class="text-muted">{{$more_info->other_names}}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 border-end"> <strong>Town</strong>
                                        <br>
                                        <p class="text-muted">{{$more_info->town}}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>Region</strong>
                                        <br>
                                        <p class="text-muted">{{$more_info->region}}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 border-end"> <strong>Date of Birth</strong>
                                        <br>
                                        <p class="text-muted">{{$more_info->date_of_birth}}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 border-end"> <strong>Number Plate</strong>
                                        <br>
                                        <p class="text-muted">{{$more_info->number_plate}}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 border-end"> <strong>ID Number</strong>
                                        <br>
                                        <p class="text-muted">{{$more_info->id_number}}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>Stage</strong>
                                        <br>
                                        <p class="text-muted">{{$more_info->stage_name}}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 border-end"> <strong>Stage Leader</strong>
                                        <br>
                                        <p class="text-muted">{{$more_info->stage_leader}}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 border-end"> <strong>Stage Leader Contact</strong>
                                        <br>
                                        <p class="text-muted">{{$more_info->stage_leader_contact}}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 border-end"> <strong>Status</strong>
                                        <br>
                                        <p class="text-muted">
                                        @if($more_info->status == 'pending')
                                        <p><span class="label label-warning">{{$more_info->status}}</span></p>
                                        @elseif($more_info->status == 'overdue')
                                        <p><span class="label label-danger">{{$more_info->status}}</span></p>
                                        @else
                                        <p><span class="label label-success">{{$more_info->status}}</span></p>
                                        @endif
                                        </p>
                                    </div>
                                    <div class="col-md-3 col-xs-6"> <strong>Registered On</strong>
                                        <br>
                                        <p class="text-muted">{{date('d F Y', strtotime($more_info->created_at))}} <br>{{date('g:i:sa', strtotime($more_info->created_at))}}</p>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    @endforeach
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