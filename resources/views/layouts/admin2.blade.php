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

    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables/css/dataTables.bootstrap.min.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/admin/img/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/admin/img/favicon.ico')}}" type="image/x-icon">
    @yield('header')
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ URL::route('AspDashboard') }}" class="logo blue-bg">
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
                    <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="{{ asset('assets/admin/img/img1.jpg')}}" class="user-image" alt="User Image"> <span class="hidden-xs">Asp Admin</span> <p class="emailuser">{{Auth::user()->email}}</p> </a>
                        <ul class="dropdown-menu">
<!--                             
                            <li><a href="{{ URL::route('AdminProfile') }}"><i class="icon-profile-male"></i> My Profile</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="icon-gears"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li> -->
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
            <li @if(Request::segment(1)== 'asp_dashboard')  class="active" @endif> <a href="{{ URL::route('AspDashboard') }}"> <i class="fa fa-home"></i><span>Dashboard</span> <span class="pull-right-container">  </span>  </a></li>

                <!-- <li @if(Request::segment(1)== 'technicians'|| Request::segment(1)== 'new-technician')  class="active"  @endif><a href="{{ URL::route('Technicians') }}"><i class="fa fa-user"></i> Asp Technicians</a></li> -->

              


                <li @if(Request::segment(1)== 'asp_jobs' || Request::segment(1)== 'asp_edit-job'  || Request::segment(1) =='asp_appointments' || Request::segment(1)== 'view-asp_job' || Request::segment(1)== 'asp_parts_order'||Request::segment(1)=='rma_asp_lists'||Request::segment(1)=='gma_asp_lists' ||Request::segment(1)=='asp_claims'||Request::segment(1)=='asp_partsedit'||Request::segment(1)=='asp_claim_edit'||Request::segment(1)=='view-asp_parts_order'||Request::segment(1)=='asp-edit-rma'||Request::segment(1)=='asp-edit-gma'||Request::segment(1)=='view-asp_parts_order'|| Request::segment(1)== 'asp_invoices' || Request::segment(1)== 'pending_asp') class="active" @endif class="treeview"> <a href="#"> <i class="fa fa-black-tie" aria-hidden="true"></i> <span>Jobs</span> <span class="pull-right-container">  </span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                    <li @if(Request::segment(1)== 'asp_jobs'|| Request::segment(1)== 'view-asp_job')  class="active" @endif ><a href="{{ URL::route('AspJobs') }}"> <i class="fa fa-wrench"></i> &nbsp;All Jobs</a></li>
                      <!--<li @if(Request::segment(1)==  'asp_appointments')  class="active" @endif ><a href="{{ URL::route('AspAppointments') }}"><i class="fa fa-share-square-o"></i>&nbsp; Appointments</a></li>

                    <li @if(Request::segment(1)== 'asp_parts_order'|| Request::segment(1)=='asp_partsedit'||Request::segment(1)=='approved-req'||Request::segment(1)=='view-asp_parts_order')  class="active" @endif ><a href="{{ URL::route('AspPartsOrder') }}"> <i class="fa fa-wrench"></i> &nbsp;Spare Parts Order</a></li>
                    <li @if(Request::segment(1)== 'gma_asp_lists')  class="active" @endif ><a href="{{ URL::route('GmaAspList') }}"><i class="fa fa-paper-plane"></i>&nbsp; GRN Requests</a></li>

                    <li @if(Request::segment(1)== 'rma_asp_lists')  class="active" @endif ><a href="{{ URL::route('RmaAspList') }}"><i class="fa fa-paper-plane-o"></i>&nbsp; RMA Requests</a></li>

                <li @if(Request::segment(1)==  'asp_claims')  class="active" @endif ><a href="{{ URL::route('AspClaims') }}"><i class="fa fa-share-square-o"></i>&nbsp; Claim Requests</a></li>
                <li @if(Request::segment(1)== 'asp_invoices')  class="active" @endif> <a href="{{ URL::route('AspInvoices') }}"> <i class="fa fa-file-pdf-o"></i> &nbsp;<span>Invoice</span> <span class="pull-right-container">  </span> </a>-->

                    </ul>
                </li>  




                 <!-- <li @if(Request::segment(1)== 'asp_jobs' || Request::segment(1)== 'asp_edit-job' || Request::segment(1)== 'view-asp_job'|| Request::segment(1)== 'asp_parts_order'||Request::segment(1)=='rma_asp_lists'||Request::segment(1)=='gma_asp_lists' ||Request::segment(1)=='asp_claims') class="active" @endif> <a href="{{ URL::route('AspJobs') }}"> <i class="fa fa-black-tie"></i> <span> All Jobs </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                    <li @if(Request::segment(1)== 'asp_parts_order' || Request::segment(1)== 'asp_partsedit')  class="active" @endif ><a href="{{ URL::route('AspPartsOrder') }}"> <i class="fa fa-wrench"></i> &nbsp;Spare Parts Order</a></li>
                       
                    <li @if(Request::segment(1)== 'rma_asp_lists')  class="active" @endif ><a href="{{ URL::route('RmaAspList') }}"> <i class="fa fa-paper-plane-o"></i>&nbsp;  RMA Requests</a></li>

                <li @if(Request::segment(1)== 'gma_asp_lists')  class="active" @endif ><a href="{{ URL::route('GmaAspList') }}"> <i class="fa fa-paper-plane"></i> &nbsp; GRN Requests</a></li>
                <li @if(Request::segment(1)== 'asp_claims')  class="active" @endif ><a href="{{ URL::route('AspClaims') }}"> <i class="fa fa-share-square-o"></i>&nbsp;  Claim Requests</a></li> 

                    </ul>
                </li>  -->
                <!-- <li @if(Request::segment(1)== 'asp-invoices') class="active" @endif class="treeview"> <a href="#"> <i class="fa fa-clipboard"></i> <span> Report</span> <span class="pull-right-container">  </span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                    <li class="treeview"> <a href="#"> <i class="fa fa-flag"></i> <span> &nbsp;Jobs Report</span> <span class="pull-right-container">  </span> </a>
                    <li @if(Request::segment(1)== 'asp_invoices')  class="active" @endif> <a href="{{ URL::route('AspInvoices') }}"> <i class="fa fa-file-pdf-o"></i> &nbsp;<span>Invoice</span> <span class="pull-right-container">  </span> </a>

                    </ul>
                </li> -->

             
                    <li @if(Request::segment(1)== 'completed_jobs_asp')  class="active" @endif> <a href="{{ URL::route('AspJobsCompleted') }}"> <i class="fa fa-file-pdf-o"></i> &nbsp;<span>R1 Completed Jobs</span> <span class="pull-right-container">  </span> </a>

                   


                <li @if(Request::segment(1)== 'technicians'||Request::segment(1)=='new-technician') class="active" @endif class="treeview"> <a href="#"> <i class="fa fa-cogs" aria-hidden="true"></i> <span>Setup</span> <span class="pull-right-container">  </span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                    <li @if(Request::segment(1)== 'technicians' || Request::segment(1)== 'new-technician' || Request::segment(1)== 'view-asp_admin')  class="active"  @endif><a href="{{ URL::route('Technicians') }}"> <i class="fa fa-user"></i>  ASP Technician Setup</a></li>

                    </ul>
                </li>
                 <!-- <li @if(Request::segment(1)== 'asp_jobs'|| Request::segment(1)== 'asp_edit-job'|| Request::segment(1)== 'view-asp_job')  class="active"  @endif><a href="{{ URL::route('AspJobs') }}"><i class="fa fa-angle-right"></i> All Jobs </a></li> -->

                <!-- <li @if(Request::segment(1)== 'asp_jobs'||Request::segment(1)== 'assigned_jobs_tech' || Request::segment(1)== 'progress_jobs_asp' || Request::segment(1)== 'completed_jobs_asp' || Request::segment(1)== 'view-asp_job' || Request::segment(1)== 'asp_edit-job' ) class="active"  @endif class="treeview"> <a href="#"> <i class="fa fa-black-tie"></i> <span>Jobs </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        
                        <li @if(Request::segment(1)== 'asp_jobs')  class="active"  @endif><a href="{{ URL::route('AspJobs') }}"><i class="fa fa-angle-right"></i> All Jobs </a></li>
                       
                    </ul>
                </li> -->
                 <!-- <li @if(Request::segment(1)== 'assigned_jobs_tech')  class="active"  @endif><a href="{{ URL::route('AssignedJobsTech') }}"><i class="fa fa-angle-right"></i> Assigned Jobs </a></li>
                        <li @if(Request::segment(1)== 'progress_jobs_asp')  class="active"  @endif><a href="{{ URL::route('AspJobsProgress') }}"><i class="fa fa-angle-right"></i> On Going Jobs </a></li>
                        <li @if(Request::segment(1)== 'completed_jobs_asp')  class="active"  @endif><a href="{{ URL::route('AspJobsCompleted') }}"><i class="fa fa-angle-right"></i> Completed Jobs </a></li>
                        <li @if(Request::segment(1)== 'asp_all_jobs')  class="active"  @endif><a href="{{ URL::route('AspAllJobs') }}"><i class="fa fa-angle-right"></i> All Jobs </a></li> -->

                <!-- <li @if(Request::segment(1)== 'unassigned_jobs_tech' || Request::segment(1)== 'assigned_jobs_tech') class="active" @endif class="treeview"> <a href="#"> <i class="fa fa-black-tie"></i> <span>Assign Jobs </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        
                        <li @if(Request::segment(1)== 'unassigned_jobs_tech')  class="active"  @endif><a href="{{ URL::route('UnAssignedJobsTech') }}"><i class="fa fa-angle-right"></i> Unassigned Jobs </a></li>
                        <li @if(Request::segment(1)== 'assigned_jobs_tech')  class="active"  @endif><a href="{{ URL::route('AssignedJobsTech') }}"><i class="fa fa-angle-right"></i> Assigned Jobs </a></li>
                    </ul>
                </li> -->


                <!-- <li @if(Request::segment(1)== 'asp_parts_order' || Request::segment(1)== 'asp_partsedit')  class="active" @endif ><a href="{{ URL::route('AspPartsOrder') }}"><i class="fa fa-angle-right"></i>  Parts Order Request</a></li> -->
              

              
                <!-- <li @if(Request::segment(1)== 'asp_part_wo_job' || Request::segment(1)=='asp_create_part_wo_job')  class="active" @endif ><a href="{{ URL::route('AspPartWithOutJob') }}"><i class="fa fa-wrench"></i>   Parts With Out Job</a></li> -->
                <li @if(Request::segment(1)== 'asp_files' )  class="active" @endif> <a href="{{ URL::route('AspFiles') }}"> <i class="fa fa-file-text-o"></i><span>File Received</span> <span class="pull-right-container">  </span>  </a></li>
                <li @if(Request::segment(1)== 'asp_part_wo_job' || Request::segment(1)=='asp_create_part_wo_job'||Request::segment(1)=='asp_view-part_wo_job')  class="active" @endif> <a href="{{ URL::route('AspPartWithOutJob') }}"> <i class="fa fa-file-archive-o"></i><span> Parts With Out Job</span> <span class="pull-right-container">  </span>  </a></li>

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
<script src="{{ asset('assets/admin/js/popper.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}"> </script>
<script src="{{ asset('assets/admin/js/bootstrap-multiselect.min.js') }}"> </script>
<script src="{{ asset('assets/admin/plugins/dropify/dropify.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/adminkit.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.datetimepicker.full.js')}}"></script>

 

@yield('footer')

</body>
</html>
