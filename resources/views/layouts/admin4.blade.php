<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Toshiba</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css')}}">
   
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/et-line-font/et-line-font.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/simple-lineicon/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/jquery.datetimepicker.css')}}"/>
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/admin/img/favicon.ico')}}" type="image/x-icon">
  
    @yield('header')
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ URL::route('LogDashboard') }}" class="logo blue-bg">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini thosmall"><img src="{{ asset('assets/admin/img/Toshiba-Logo.png')}}" alt=""></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg tholog"><img src="{{ asset('assets/admin/img/Toshiba-Logo.png')}}" alt=""></span> </a>
        <!-- <span class="logo-lg"><img src="dist/img/Toshiba-Logo.png" alt=""></span> </a>  -->
        <!-- Header Navbar -->
        <nav class="navbar blue-bg navbar-static-top">
            <!-- Sidebar toggle button-->
            <ul class="nav navbar-nav pull-left">
                <li><a class="sidebar-toggle" data-toggle="push-menu" href="#"></a> </li>
            </ul>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account  -->
                    <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{ asset('assets/admin/img/img1.jpg')}}" class="user-image" alt="User Image"> <span class="hidden-xs">Logistic</span> <p class="emailuser">{{Auth::user()->email}}</p> </a>
                        <ul class="dropdown-menu">
                            
                            <!-- <li><a href="{{ URL::route('AdminProfile') }}"><i class="icon-profile-male"></i> My Profile</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="icon-gears"></i> Account Setting</a></li> -->
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ URL::route('AdminLogout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar -->
        <div class="sidebar">

            <ul class="sidebar-menu" data-widget="tree">

            <li @if(Request::segment(1)== 'log_dashboard')  class="active" @endif> <a href="{{ URL::route('LogDashboard') }}"> <i class="fa fa-home"></i><span>Dashboard</span> <span class="pull-right-container">  </span>  </a></li>
                </li>

               
             
                       
                        <li @if(Request::segment(1)== 'log_parts_order'||Request::segment(1)=='view-spare-part-log')  class="active"  @endif><a href="{{ URL::route('LogPartsOrder') }}"><i class="fa fa-angle-right"></i> Spare Parts Order </a></li>

                   
                <li @if(Request::segment(1)== 'log_rma_order')  class="active"  @endif><a href="{{ URL::route('LogRmaOrder') }}"><i class="fa fa-angle-right"></i> RMA Requests </a></li>
                <li @if(Request::segment(1)== 'log_grn_order')  class="active"  @endif><a href="{{ URL::route('LogGrnOrder') }}"><i class="fa fa-angle-right"></i> GRN Requests </a></li>

               

            </ul>
        </div>
        <!-- /.sidebar -->
    </aside>
    <section id="content">
        @yield('content')
    </section>
    {{--Delete Modal--}}

    <div class="modal modal-danger fade in" id="deleteModal" >
        <div class="modal-dialog">
            <form id="deleteForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Delete Data</h4>
                    </div>
                    <div class="modal-body">
                        <p>Do you want delete this data ?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="type" id="type">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline">Delete</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{--Loading Modal--}}
    <div class="modal modal-success fade" id="messageModal">
        <div class="modal-dialog" >
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Loading Successfully....</h4>
                </div>
                <div class="modal-body text-center"  >
                    <p id="messageModalBody" ></p>
                    <img src="{{  asset('assets/admin/img/loading.gif') }}"/>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>messageModalBody
        <!-- /.modal-dialog -->
    </div>
  

    <footer class="main-footer">

        Copyright © 2018 Toshiba. All rights reserved.</footer>
</div>
<script src="{{ asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}"> </script>
<script src="{{ asset('assets/admin/js/adminkit.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.datetimepicker.full.js')}}"></script>


@yield('footer')

</body>
</html>
