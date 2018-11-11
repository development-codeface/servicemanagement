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
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tooltip/tooltip.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables/css/dataTables.bootstrap.min.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/admin/img/favicon.ico')}}" type="image/x-icon">
    @yield('header')
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index.html" class="logo blue-bg">
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
                    <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{ asset('assets/admin/img/img1.jpg')}}" class="user-image" alt="User Image"> <span class="hidden-xs">Alexander Pierce</span> <p class="emailuser">florence@gmail.com</p> </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <div class="pull-left user-img"><img src="{{ asset('assets/admin/img/img1.jpg')}}" class="img-responsive img-circle" alt="User"></div>
                                <p class="text-left">Florence Douglas <small>florence@gmail.com</small> </p>
                            </li>
                            <li><a href="{{ URL::route('AdminProfile') }}"><i class="icon-profile-male"></i> My Profile</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="icon-gears"></i> Account Setting</a></li>
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

                <li class="active treeview"> <a href="index.html"> <i class="icon-home"></i> <span>Dashboard</span>  </a>
                </li>

                <li class="treeview"> <a href="#"> <i class="fa fa-user"></i> <span>User </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        <li @if(Request::segment(1)== 'new-technician')  class="active"  @endif><a href="{{ URL::route('NewTechnician') }}"><i class="fa fa-angle-right"></i> Create User</a></li>
                        <li @if(Request::segment(1)== 'technicians')  class="active"  @endif><a href="{{ URL::route('Technicians') }}"><i class="fa fa-angle-right"></i> Manage User</a></li>
                    </ul>
                </li>
                <li class="treeview"> <a href="#"> <i class="fa fa-black-tie"></i> <span>Jobs </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        
                        <li @if(Request::segment(1)== 'asp_jobs')  class="active"  @endif><a href="{{ URL::route('AspJobs') }}"><i class="fa fa-angle-right"></i> New Jobs </a></li>
                        <li @if(Request::segment(1)== 'create-assign_tech_job')  class="active"  @endif><a href="{{ URL::route('NewAssignTechnician') }}"><i class="fa fa-angle-right"></i> Assign Job </a></li>
                    </ul>
                </li>

               

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
    <div class="animatedParent">

<div class="modal fade modaltop animated growIn slow go " id="myModal" role="dialog">
 <div class="modal-dialog">

   <!-- Modal content-->
   <div class="modal-content modaltop">
     <div class="modal-header">
     <h4 class="modal-title"> Successfully Created ....</h4>

       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <div class="modal-body lodgif">
     <img src="{{asset('assets/admin/img/check-circle.gif')}}">
   
     </div>
     <div class="modal-footer">
       
     
     </div>
   </div>
 </div>
</div>
</div>

    <footer class="main-footer">

        Copyright © 2018 Toshiba. All rights reserved.</footer>
</div>
<script src="{{ asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{ asset('assets/admin/js/adminkit.js')}}"></script>

<script src="{{ asset('assets/admin/plugins/raphael/raphael-min.js')}}"></script>
 
<script src="{{ asset('assets/admin/plugins/functions/dashboard1.js')}}"></script>

<script src="{{ asset('assets/admin/plugins/peity/jquery.peity.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/functions/jquery.peity.init.js')}}"></script>
<script src="{{ asset('assets/admin/js/adminkit.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/tooltip/tooltip.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/tooltip/script.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/popper/popper.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/dialog.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/table-expo/filesaver.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/table-expo/xls.core.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/table-expo/tableexport.js')}}"></script>

@yield('footer')

</body>
</html>
