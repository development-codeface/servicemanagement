@extends('layouts.admin3')

@section('header')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Technician Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Technician Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
        
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3">
                    <div class="tile-progress tile-pink">
                        <div class="tile-header">
                            <h5>All Jobs</h5>
                            <h3>{{$jobs}}</h3>
                        </div>
                        <div class="tile-progressbar"> <span data-fill="65.5%" style="width: 65.5%;"></span> </div>
                        <div class="tile-footer">
                        <a href="{{URL::route('TechJobs')}}">View More</a>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="tile-progress tile-red">
                        <div class="tile-header">
                            <h5>Pending </h5>
                            <h3>{{$pendjobs}}</h3>
                        </div>
                        <div class="tile-progressbar"> <span data-fill="70%" style="width: 70%;"></span> </div>
                        <div class="tile-footer">
                        <a href="{{URL::route('TechJobs')}}">View More</a>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-lg-3">
                    <div class="tile-progress tile-cyan">
                        <div class="tile-header">
                            <h5>Completed Jobs</h5>
                            <h3>{{$comjobs}}</h3>
                        </div>
                        <div class="tile-progressbar"> <span data-fill="50%" style="width: 50%;"></span> </div>
                        <div class="tile-footer">
                        <a href="{{URL::route('TechJobs')}}">View More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /.content -->
    </div>
@endsection

@section('footer')

@endsection