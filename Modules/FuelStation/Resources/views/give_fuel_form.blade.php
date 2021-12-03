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
                                <h4>Float Ugshs:{{ number_format(auth()->user()->actualFloat())}}</h4>
                                </div>
                                <div class="card-body">
                                <form action="/fuelstation/fuel-client-now/{{request()->route()->client_id}}" method="get">
                                    <p class="card-tex">
                                        <input type="hidden" name="fuel_station_id" value="{{auth()->user()->id}}">
                                        <input type="hidden" name="client_id" value="{{request()->route()->client_id}}">
                                        <label>Amount</label>
                                        <input type="text" class="form-control" name="debt" placeholder="Amount" required>
                                    </p>
                                    <p>
                                    <label>Clients Pin</label>
                                        <input type="text" class="form-control" name="pin" placeholder="e.g 12345" required>
                                    </p>
                                    <div class="text-center">
                                        <button type="submit" class="btn text-white" style="background-color:#000066;">Fuel Now</button>
                                    {{--<button class="btn btn-sm btn-danger deleteDW" dw-id="" data-toggle="modal" data-target="#deleteDomesticWorker">Delete</button>--}}
                                    </div>
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
<div class="modal fade" id="deleteDomesticWorker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <form action="/registramodule/remove-from-trash" method="get">
      <div class="modal-header d-flex justify-content-center bg-danger text-white">
        <h4 class="heading text-white">Enter Clients Pin Number to Confirm ?</h4>
      </div>
    <input type="hidden" name="delete_dw" id="delete_dw">
      <!--Body-->
      <div class="modal-body text-center">
       <input type="text" name="pin" class="form-control" placeholder="e.g 12345">
    </div>
    <!--Footer-->
    <div class="text-center mb-3">
        <button type="submit" class="btn btn-primary">Confirm</button>
        <button type="button" class="btn btn-danger waves-effect text-start text-white" data-bs-dismiss="modal">Close</button>
    </div>
     </form>
    </div>
    <!--/.Content-->
  </div>
</div>
    <script>
        $(document).on('click','.deleteDW',function(){
            var userID=$(this).attr('dw-id');
            $('#id').val(userID); 
            $('#deleteDomesticWorker').modal('show'); 
        });

        $('button[data-toggle = "modal"]').click(function(){
            var dw_delete = $(this).parents('tr').children('td').eq(1).text();
            document.getElementById('delete_dw').setAttribute("Value", dw_delete);
            });
    </script>
</body>
</html>