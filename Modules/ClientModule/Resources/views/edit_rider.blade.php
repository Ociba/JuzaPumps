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
                            <div class="row">
                                @foreach($edit_rider_info as $edit_info)
                                <form action="/clientmodule/update-client-info/{{request()->route()->client_id}}" method="get">
                                 @csrf
                                    <div class="form-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <input type="hidden" name="id" value="{{request()->route()->client_id}}">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" id="first_name" name="first_name" value="{{$edit_info->first_name}}" class="form-control" placeholder="">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Other Names</label>
                                                    <input type="text" id="other_names"  name="other_names" value="{{$edit_info->other_names}}" class="form-control form-control-danger" placeholder="">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Date of Birth</label>
                                                    <input type="text" class="form-control" id="date_of_birth"  value="{{$edit_info->date_of_birth}}" name="date_of_birth" placeholder="dd/mm/yyyy">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Clients Telephone</label>
                                                    <input type="text" id="telephone" name="telephone" value="{{$edit_info->telephone}}" class="form-control" placeholder="">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Number Plate</label>
                                                    <input type="text" id="number_plate" name="number_plate" value="{{$edit_info->number_plate}}" class="form-control" placeholder="">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">ID Number</label>
                                                    <input type="text" id="id_number"  name="id_number" value="{{$edit_info->id_number}}" class="form-control form-control-danger" placeholder="">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Stage Name</label>
                                                    <input type="text" id="stage_name" name="stage_name" value="{{$edit_info->stage_name}}" class="form-control" placeholder="">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Stage Leader</label>
                                                    <input type="text" id="stage_leader"  name="stage_leader" value="{{$edit_info->stage_leader}}" class="form-control form-control-danger" placeholder="">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Stage Leader Contact</label>
                                                    <input type="text" id="stage_leader_contact" value="{{$edit_info->stage_leader_contact}}" name="stage_leader_contact" class="form-control" placeholder="">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Pin</label>
                                                    <input type="text" id="pin"  name="pin" value="{{$edit_info->pin}}" class="form-control form-control-danger" placeholder="">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                    </div>
                                    <div class="form-actions text-center">
                                        <button type="submit" class="btn btn-success text-white"> Save</button>
                                        <a href="/clientmodule/" type="button" class="btn btn-primary">Back</a>
                                    </div>
                                </form>
                                @endforeach
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