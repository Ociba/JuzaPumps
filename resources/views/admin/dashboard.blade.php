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
<link rel="stylesheet" type="text/css"
        href="{{ asset('admin/dist/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/dist/css/responsive.dataTables.min.css')}}">
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
                    @include('layouts.cards')

                    <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="card-subtitle">A Pie-Chart Showing People involved In Juza Pumps</h4>
                                                <canvas id="chart-pie" height="250" class="chartjs-demo"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>
                            <div class=" col-lg-6 col-md-6">
                                <div class="card mb-4">
                                    <div class="card-body">
                                       <h4 class="card-subtitle">A Pie-Chart showing Revenue Summary In Juza Pumps</h4>
                                       <canvas id="chart-pie2" height="250" class="chartjs-demo"></canvas>
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
    <script src="{{ asset('admin/dist/js/chartjs/chartjs.js')}}" type="text/JavaScript"></script>
    <!-- This is data table -->
    <!-- end - This is for export functionality only -->
    <script>
        $(function() {
        // Wrap charts
        $('.chartjs-demo').each(function() {
            $(this).wrap($('<div style="height:' + this.getAttribute('height') + 'px"></div>'));
        });

        var pieChart = new Chart(document.getElementById('chart-pie').getContext("2d"), {
            type: 'pie',
            data: {
            labels: [ 'Users', 'Leaders', 'Clients' ],
            datasets: [{
                data: [{{auth()->user()->countUsers()}}, {{auth()->user()->countLeaders()}},{{auth()->user()->countClients()}} ],
                backgroundColor: [ '#FF4961', '#ff4a00', '#f4ab55' ],
                hoverBackgroundColor: [ '#FF4961', '#ff4a00', '#f4ab55' ]
            }]
            },

            // Demo
            options: {
            responsive: false,
            maintainAspectRatio: false
            }
        });
        var pieChart = new Chart(document.getElementById('chart-pie2').getContext("2d"), {
            type: 'pie',
            data: {
            labels: [ 'Total Initial Floats', 'Revenue', 'Debts' ],
            datasets: [{
                data: [{{auth()->user()->totalInitialFloats()}}, {{auth()->user()->totalRevenue()}}, {{auth()->user()->totalDebts()}} ],
                backgroundColor: [ '#6600cc', '#00cc66', '#ff9900' ],
                hoverBackgroundColor: [ '#6600cc', '#00cc66', '#ff9900' ]
            }]
            },

            // Demo
            options: {
            responsive: false,
            maintainAspectRatio: false
            }
        });
        var graphChart = new Chart(document.getElementById('chart-graph').getContext("2d"), {
            type: 'line',
            data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label:           'My First dataset',
                data:            [43, 91, 89, 16, 21, 79, 28],
                borderWidth:     1,
                backgroundColor: 'rgba(113, 106, 202, 0.3)',
                borderColor:     '#ff4a00',
                borderDash:      [5, 5],
                fill: false
            }, {
                label:           'My Second dataset',
                data:            [24, 63, 29, 75, 28, 54, 38],
                borderWidth:     1,
                backgroundColor: 'rgba(40, 208, 148, 0.3)',
                borderColor:     '#62d493',
            }],
            },

            // Demo
            options: {
            responsive: false,
            maintainAspectRatio: false
            }
        });

        var barsChart = new Chart(document.getElementById('chart-bars').getContext("2d"), {
            type: 'bar',
            data: {
            labels: ['Italy', 'UK', 'USA', 'Germany', 'France', 'Japan'],
            datasets: [{
                label: '2010 customers #',
                data: [53, 99, 14, 10, 43, 27],
                borderWidth: 1,
                backgroundColor: 'rgba(255, 73, 97, 0.3)',
                borderColor: '#FF4961'
            }, {
                label: '2014 customers #',
                data: [55, 74, 20, 90, 67, 97],
                borderWidth: 1,
                backgroundColor: 'rgba(255, 145, 73, 0.3)',
                borderColor: '#f4ab55'
            }]
            },

            // Demo
            options: {
            responsive: false,
            maintainAspectRatio: false
            }
        });

        var radarChart = new Chart(document.getElementById('chart-radar').getContext("2d"), {
            type: 'radar',
            data: {
            labels: ['Eating', 'Drinking', 'Sleeping', 'Designing', 'Coding', 'Cycling', 'Running'],
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgba(40, 208, 148, 0.3)',
                borderColor: '#62d493',
                pointBackgroundColor: '#62d493',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#62d493',
                data: [39, 99, 77, 38, 52, 24, 89],
                borderWidth: 1
            }, {
                label: 'My Second dataset',
                backgroundColor: 'rgba(255, 73, 97, 0.3)',
                borderColor: '#FF4961',
                pointBackgroundColor: '#FF4961',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#FF4961',
                data: [6, 33, 14, 70, 58, 90, 26],
                borderWidth: 1
            }]
            },

            // Demo
            options: {
            responsive: false,
            maintainAspectRatio: false
            }
        });

        var polarAreaChart = new Chart(document.getElementById('chart-polar-area').getContext("2d"), {
            type: 'polarArea',
            data: {
            datasets: [{
                data: [ 12, 10, 14, 6, 15 ],
                backgroundColor: [ '#FF4961', '#62d493', '#f4ab55', '#E7E9ED', '#55a3f4' ],
                label: 'My dataset'
            }],
            labels: [ 'Red', 'Green', 'Yellow', 'Grey', 'Blue' ]
            },

            // Demo
            options: {
            responsive: false,
            maintainAspectRatio: false
            }
        });
        var doughnutChart = new Chart(document.getElementById('chart-doughnut').getContext("2d"), {
            type: 'doughnut',
            data: {
            labels: [ 'Red', 'Blue', 'Yellow' ],
            datasets: [{
                data: [ 137, 296, 213 ],
                backgroundColor: [ '#FF4961', '#ff4a00', '#f4ab55' ],
                hoverBackgroundColor: [ '#FF4961', '#ff4a00', '#f4ab55' ]
            }]
            },

            // Demo
            options: {
            responsive: false,
            maintainAspectRatio: false
            }
        });

        // Resizing charts

        function resizeCharts() {
            graphChart.resize();
            barsChart.resize();
            radarChart.resize();
            polarAreaChart.resize();
            pieChart.resize();
            doughnutChart.resize();
        }

        // Initial resize
        resizeCharts();

        // For performance reasons resize charts on delayed resize event
        window.layoutHelpers.on('resize.charts-demo', resizeCharts);
        });
    </script>
    <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Enter Domestic Worker Information</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form class="mt-4">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="tb-email"
                                placeholder="name@example.com">
                            <label for="tb-email">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea type="text" class="form-control" rows="5" id="tb-email"
                                placeholder="Enter the Reason"></textarea>
                            <label for="tb-email">Enter Reason</label>
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</body>
</html>