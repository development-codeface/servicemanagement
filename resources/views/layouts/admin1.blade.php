<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Toshiba</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-multiselect.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/timepicker.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/et-line-font/et-line-font.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/simple-lineicon/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/jquery.datetimepicker.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/plugins/dropify/dropify.min.css')}}"/>
     <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/daterangepicker.css')}}"/>

    @yield('header')
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ URL::route('TssDashboard') }}" class="logo blue-bg">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini thosmall"><img src="{{ asset('assets/admin/img/logo-sm.png')}}" alt=""></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg tholog"><img src="{{ asset('assets/admin/img/logo-lg.png')}}" alt=""></span> </a>
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
                    <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                        <img src="{{ asset('assets/admin/img/img1.jpg')}}" class="user-image" alt="User Image"> 
                        <span class="hidden-xs">{{Auth::user()->username}}</span> <p class="emailuser">{{Auth::user()->email}}</p> </a>
                        <ul class="dropdown-menu">
                            
                            <!-- <li><a href="{{ URL::route('AdminProfile') }}"><i class="icon-profile-male"></i> My Profile</a></li> -->

                            <li role="separator" class="divider"></li>
                            <!-- <li><a href="#"><i class="icon-gears"></i> Account Setting</a></li> -->
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

            <ul  class="sidebar-menu" data-widget="tree">
            <li @if(Request::segment(1)== 'tss_dashboard')  class="active" @endif> <a href="{{ URL::route('TssDashboard') }}"> <i class="fa fa-home"></i><span>Dashboard</span> <span class="pull-right-container">  </span>  </a></li>

                </li>
                
            


               <li @if(Request::segment(1)== 'new-job' || Request::segment(1)== 'new-csv' || Request::segment(1)== 'jobs' || Request::segment(1)== 'gma_requests' || Request::segment(1)== 'rma_requests' || Request::segment(1)== 'admin_claims'|| Request::segment(1)== 'new-parts_order'||Request::segment(1)=='view-job'||Request::segment(1)=='edit-job'||Request::segment(1)=='edit-rma'||Request::segment(1)=='edit-gma'||Request::segment(1)=='edit-parts_order'||Request::segment(1)=='admin_edit_claim'|| Request::segment(1)=='view-parts_order' || Request::segment(1)=='tss_appointments'|| Request::segment(1)=='tss_appointments'||Request::segment(1)=='admin-appointment'||Request::segment(1)=='admin-waiting_parts'|| Request::segment(1)=='admin-new_claim'||Request::segment(1)=='invoices' ||Request::segment(1)=='pending_part') class="active" @endif class="treeview"> <a href="#"> <i class="fa fa-black-tie" aria-hidden="true"></i> <span>Jobs</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                    <li @if(Request::segment(1)== 'new-job' || Request::segment(1)== 'new-csv' || Request::segment(1)== 'jobs')  class="active" @endif ><a href="{{ URL::route('Jobs') }}"> <i class="fa fa-wrench"></i> &nbsp; All Jobs</a></li>
                    <li @if(Request::segment(1)== 'tss_appointments')  class="active" @endif ><a href="{{ URL::route('TssAppointments') }}"><i class="fa fa-share-square-o"></i>&nbsp;  Appointments</a></li>


                    <li @if(Request::segment(1)== 'new-parts_order'|| Request::segment(1)=='view-parts_order'||Request::segment(1)=='approved-req')  class="active" @endif ><a href="{{ URL::route('NewPartsOrder') }}"> <i class="fa fa-wrench"></i> &nbsp; Spare Parts Order</a></li>
                    <li @if(Request::segment(1)== 'gma_requests')  class="active" @endif ><a href="{{ URL::route('GmaRequests') }}"><i class="fa fa-paper-plane"></i> &nbsp; GRN Requests</a></li>
                    <li @if(Request::segment(1)== 'rma_requests')  class="active" @endif ><a href="{{ URL::route('RmaRequests') }}"><i class="fa fa-paper-plane-o"></i>&nbsp;   RMA Requests</a></li>

                
                <li @if(Request::segment(1)== 'admin_claims')  class="active" @endif ><a href="{{ URL::route('AdminClaims') }}"><i class="fa fa-share-square-o"></i>&nbsp;   Claim Requests</a></li>
                <li @if(Request::segment(1)== 'invoices')  class="active" @endif> <a href="{{ URL::route('Invoices') }}"> <i class="fa fa-file-pdf-o"></i> &nbsp;<span>Invoices</span> <span class="pull-right-container">  </span> </a>

                    </ul>
                </li>  


                    <li @if(Request::segment(1)== 'completed_jobs')  class="active" @endif> <a href="{{ URL::route('CompletedJobs') }}"> <i class="fa fa-file-pdf-o"></i> &nbsp;<span>R1 Completed Jobs</span> <span class="pull-right-container">  </span> </a>




               <li @if(Request::segment(1)== 'asp_admin'|| Request::segment(1)=='view-asp_admin'|| Request::segment(1)=='new-asp_admin'||Request::segment(1)== 'asp_tech'||Request::segment(1)=='new-technician_tss'||Request::segment(1)=='parts_list'||Request::segment(1)=='edit-spare-part'||Request::segment(1)=='view-spare-part'||Request::segment(1)=='mileag_list'||Request::segment(1)=='edit-mileag'||Request::segment(1)=='view-mileag'||Request::segment(1)=='faulty_list'||Request::segment(1)=='edit-faulty_list'||Request::segment(1)=='view-faulty_list'||Request::segment(1)=='symptoms'||Request::segment(1)=='view-symptom'||Request::segment(1)=='edit-symptom'||Request::segment(1)=='resolutions'||Request::segment(1)=='view-resolution'||Request::segment(1)=='edit-resolution'||Request::segment(1)=='product_list'||Request::segment(1)=='view-product'||Request::segment(1)=='edit-product') class="active" @endif class="treeview"> <a href="#"> <i class="fa fa-cogs" aria-hidden="true"></i> <span>Setup</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                    <li @if(Request::segment(1)== 'asp_admin' || Request::segment(1)=='new-asp_admin' || Request::segment(1)== 'view-asp_admin')  class="active"  @endif><a href="{{ URL::route('AspAdmin') }}"> <i class="fa fa-user"></i> ASP Admin Setup</a></li>
                    <li @if(Request::segment(1)== 'asp_tech' ||Request::segment(1)=='new-new-technician_tss' )  class="active"  @endif><a href="{{ URL::route('AspTech') }}"> <i class="fa fa-user"></i> ASP Technician Setup</a></li>
                    <li @if(Request::segment(1)== 'parts_list'||Request::segment(1)=='edit-spare-part'||Request::segment(1)=='view-spare-part')  class="active"  @endif><a href="{{ URL::route('Parts') }}"> <i class="fa fa-user"></i> Spare Parts Setup</a></li>
                    <li @if(Request::segment(1)=='mileag_list')  class="active"  @endif><a href="{{ URL::route('Mileages') }}"> <i class="fa fa-user"></i> Mileage Setup</a></li>
                    <li @if(Request::segment(1)=='faulty_list'||Request::segment(1)=='edit-faulty_list'||Request::segment(1)=='view-faulty_list')  class="active"  @endif><a href="{{ URL::route('Faultylist') }}"> <i class="fa fa-user"></i> Faulty Code Setup</a></li>
                    <li @if(Request::segment(1)=='symptoms'||Request::segment(1)=='edit-faulty_list'||Request::segment(1)=='view-symptom'||Request::segment(1)=='edit-symptom')  class="active"  @endif><a href="{{ URL::route('Symptom') }}"> <i class="fa fa-user"></i> Symptom Code Setup</a></li>
                    <li @if(Request::segment(1)=='resolutions'||Request::segment(1)=='edit-resolution'||Request::segment(1)=='view-resolution'||Request::segment(1)=='edit-resolution')  class="active"  @endif><a href="{{ URL::route('Resolutions') }}"> <i class="fa fa-user"></i> Resolution Code Setup</a></li>
                    <li @if(Request::segment(1)=='product_list'||Request::segment(1)=='edit-product'||Request::segment(1)=='view-product'||Request::segment(1)=='edit-product')  class="active"  @endif><a href="{{ URL::route('Products') }}"> <i class="fa fa-user"></i> Model Setup</a></li>

                    </ul>
                </li>
                <li @if(Request::segment(1)== 'create_file_share'||Request::segment(1)=='file_share'||Request::segment(1)=='edit_file_share' )  class="active" @endif> <a href="{{ URL::route('FileShare') }}"> <i class="fa fa-file-text-o"></i><span>File Sharing</span> <span class="pull-right-container">  </span>  </a></li>


               <li @if(Request::segment(1)== 'parts_wo_job_tss'||Request::segment(1)=='approved-req'||Request::segment(1)=='edit-parts_order_wo_job' )  class="active" @endif> <a href="{{ URL::route('TssPartsWoJob') }}"> <i class="fa fa-file-archive-o"></i><span>Parts Without Job</span> <span class="pull-right-container">  </span>  </a></li>

                </li>
             <li @if(Request::segment(1)== 'reports')  class="active" @endif> <a href="{{ URL::route('Reports') }}"> <i class="fa fa-file-archive-o"></i><span>Report</span> <span class="pull-right-container">  </span>  </a></li>

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

   


    <footer class="main-footer">

        Copyright © 2018 Toshiba. All rights reserved.</footer>
</div>
<script src="{{ asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-multiselect.min.js') }}"> </script>
    <script src="{{ asset('assets/admin/js/bootstrap-timepicker.js') }}"> </script>

<script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}"> </script>
 
<script src="{{ asset('assets/admin/plugins/dropify/dropify.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/adminkit.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.datetimepicker.full.js')}}"></script>

<script src="{{ asset('assets/admin/js/moment.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/daterangepicker.js')}}"></script>

@yield('footer')

</body>
</html>
