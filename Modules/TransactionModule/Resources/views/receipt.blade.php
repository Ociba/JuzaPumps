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
                    <div class="col-md-12">
                    @foreach($all_client_payments_details as $i=>$payment)
                        <div class="card card-body printableArea">
                            <h3 class="text-center font-weight-900"><b>JUZA PUMPS LTD</b></h3>
                            <h4 class="text-center"><b>RUMEE TOWER,GROUND FLOOR-PLOT NO. 19,LUMUMBA AVENUE, P.O BOX 11674 -KAMPALA</b></h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <span  class="me-3 img-fluid w-75 pull-right"><p class="">NAME: <u>{{$payment->first_name}} {{$payment->other_names}}</u>
                                                <br/> ID NUMBER. <U>{{$payment->id_number}}</U>
                                                <br/> NUMBER PLATE: <u>{{$payment->number_plate}}</u>
                                                <br/> STAGE LEADER: <u>{{$payment->stage_leader}}</u>
                                                <br/> STAGE LEADER CONTACT: <u>{{$payment->stage_leader_contact}}</u></p>
                                            </span>
                                            <div class="media-body">
                                                <h6 class="mt-0"><p class="m-l-5">
                                                TEL: <u>{{$payment->telephone}}</u>
                                                <br/> STAGE :    <u>{{$payment->stage_name}}</u>
                                                <br/> DOB:  <u>{{$payment->date_of_birth}}</u>
                                                <br/> DEBT: <u>{{ number_format($payment->debt)}} /=</u></p>
                                        </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-12 mr-0 ml-3">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Date</th>
                                                    <th>Amount To Be Paid</th>
                                                    <th>Amount Paid</th>
                                                    <th class="">Amount Paid Today</th>
                                                    <th>Balance</th>
                                                    <th class="">Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                <tr>
                                                    <td class="text-center">{{$i + 1}}</td>
                                                    <td> {{$payment->other_names}} {{$payment->first_name}}</td>
                                                    <td class="">{{ number_format($payment->debt)}}/= </td>
                                                    <td>{{ number_format($total_of_client_payments)}} /=</td>
                                                    <td class="">{{ number_format($payment->amount_paid)}}/= </td>
                                                    <td class="">{{ number_format($payment->debt-$total_of_client_payments)}}/= </td>
                                                    <td class=""> {{$payment->created_at}} </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media">
                                            <span  class="me-3 img-fluid w-75">Issuing Officer: {{auth()->user()->name}}</span>
                                            <div class="media-body">
                                                <h5 class="mt-0">stap & signature.............</h5>
                                            </div>
                                        </div>
                                        <p>NOTE:</p>
                                        <p>This is a confidential report/Certificate that should only be handled by the client or persons authorized by the Client named above.</p>
                                        <p>All tests carried out have passed the Quality Control measures using standardized procedures.</p>
                                        <p>The client and / or representative acknowledge this report/ certificate is given as per their consent to get the tests done and accept <p>
                                        <p>the results that will be presented, there is no external influence on any party involved to change or manupulate the results.</p>
                                        <p>Bayan Kampala Diagnostic Center LTD certifies that this report is authentic, true and with no alternations s per the date of test indicated.</p>
                                        <p>The results issued hereby are valid for 30 days from date of issue.</p>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="text-center">
                                        <button id="print" class="btn btn-defaul btn-outline" type="button"> <span><i class="ti-printer"></i> </span> </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
        <script src="{{ asset('admin/dist/js/pages/jquery.PrintArea.js')}}" type="text/JavaScript"></script>
        <script>
        $(document).ready(function() {
            $("#print").click(function() {
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close
                };
                $("div.printableArea").printArea(options);
            });
        });
        </script>
    </body>
</html>
