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
                                <form action="/clientmodule/save-rider/{{request()->route()->client_id}}" method="post" enctype="multipart/form-data">
                                 @csrf
                                    <div class="form-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                                    <label class="form-label" for="exampleInputEmail1">First Name</label>
                                                    <input type="text" id="exampleInputEmail1" name="first_name" class="form-control" placeholder="" required>
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Other Names</label>
                                                    <input type="text" id="other_names"  name="other_names" class="form-control form-control-danger" placeholder="" required>
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Town</label>
                                                    <select class="form-control form-select" name="town_id" id="town_id" required>
                                                    @foreach($get_towns as $towns)
                                                    <option value="{{$towns->id}}">{{$towns->town}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Region</label>
                                                    <select class="form-control form-select" name="region_id" id="region_id" required>
                                                    @foreach($get_region as $region)
                                                        <option value="{{$region->id}}">{{$region->region}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Date of Birth</label>
                                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="dd/mm/yyyy" required>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Clients Telephone</label>
                                                    <input type="text" id="telephone" name="telephone" class="form-control" placeholder="" required>
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Number Plate</label>
                                                    <input type="text" id="number_plate" name="number_plate" class="form-control" placeholder="" required>
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">ID Number</label>
                                                    <input type="text" id="id_number"  name="id_number" class="form-control form-control-danger" placeholder="" required>
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Stage Name</label>
                                                    <input type="text" id="stage_name" name="stage_name" class="form-control" placeholder="" required>
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Stage Leader</label>
                                                    <input type="text" id="stage_leader"  name="stage_leader" class="form-control form-control-danger" placeholder="" required>
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Stage Leader Contact</label>
                                                    <input type="text" id="stage_leader_contact" name="stage_leader_contact" class="form-control" placeholder="" required>
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Amount (Debt)</label>
                                                    <input type="text" id="debt"  name="debt" class="form-control form-control-danger" placeholder="" required>
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                               <div class="form-group">
                                                    <label class="form-label">Leader</label>
                                                    <div class="custom-control custom-radio">
                                                        <input type="checkbox" id="leader" name="leader" id="leader" value="leader" class="form-check-input">
                                                        <label class="form-check-label" for="leader">Tick if a person is chairman</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Clients Photo</label>
                                                    <input type="file" id="profile_photo_path"  name="profile_photo_path" class="form-control form-control-danger" placeholder="" required>
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
    <script src="{{ asset('admin/dist/js/pages/jasny-bootstrap.js')}}"></script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
</body>
</html>