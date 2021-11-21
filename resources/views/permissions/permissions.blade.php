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
                            <div class="card-subtitle mb-3 text-info">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    @foreach($get_users as $user)
                                    <div class="col-lg-4">
                                        Assign  {{$user->name}} Permissions.
                                    </div> 
                                    @endforeach
                                    <div class="col-lg-4">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                <form action="/assign-permissions/{{request()->route()->user_id}}" method="get">
                                 @csrf
                                 <div class="table-responsive">
                                  <input type="hidden" name="user_id" value="{{request()->route()->user_id}}">
                                    <table class="tablesaw no-wrap table-bordered table-hover table" data-tablesaw>
                                        <thead>
                                            <!-- start row -->
                                            <tr style="text-transform: uppercase;font-weight:bold;font-family: Times New Roman, Times, serif;">
                                                <th scope="col" class="border">#</th>
                                                <th scope="col" class="border"><input type="checkbox" id="select_all"/></th>
                                                <th scope="col" class="border">Select All The Permissions or one By One</th>
                                            </tr>
                                        <tbody id="checkall-target">
                                            <!-- start row -->
                                            @foreach($get_permission as $i=>$permission)
                                            <tr>
                                             @php
                                                if( $get_permission->currentPage() == 1){
                                                    $i = $i+1;
                                                }else{
                                                    $i = ($i+1) + 10*($get_permission->currentPage()-1);
                                                }
                                            @endphp
                                               <td class="title">{{$i}}</td>
                                                <td><label><input type="checkbox" class="checkbox checkbox-primary" name="user_permisions[]" value="{{$permission->id}}" /> </td>
                                                            </span></label></td>
                                                <td class="title">{{$permission->permission}}</td>
                                            </tr> <!-- end row -->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                   <div class="form-actions text-center">
                                         <a href="/user-and-permissions/{{request()->route()->user_id}}"  class="btn btn-sm btn-danger" style="color:white;">Back</a>
                                        <button type="submit" class="btn btn-success btn-sm text-white"> Save</button>
                                    </div>
                                </form>
                               </div>
                               <div class="row">
                                    <div class="col-12 text-center mt-3">
                                    {{$get_permission->links()}}
                                    </div>
                                    </div>
                               <div class="col-lg-3"></div>
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
        <script type="text/javascript">
            $(document).ready(function(){
                $('#select_all').on('click',function(){
                    if(this.checked){
                        $('.checkbox').each(function(){
                            this.checked = true;
                        });
                    }else{
                        $('.checkbox').each(function(){
                            this.checked = false;
                        });
                    }
                });
                $('.checkbox').on('click',function(){
                    if($('.checkbox:checked').length == $('.checkbox').length){
                        $('#select_all').prop('checked',true);
                    }else{
                        $('#select_all').prop('checked',false);
                    }
                });
            });
        </script>
</body>
</html>