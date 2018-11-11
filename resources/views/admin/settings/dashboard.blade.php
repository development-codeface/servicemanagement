@extends('layouts.admin1')

@section('header')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1> Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i>  Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
         

            <div class="row">
                <div class="col-lg-3">
                    <div class="tile-progress tile-pink">
                        <div class="tile-header">
                            <h5>New Jobs</h5>
                            <h3>1250</h3>
                        </div>
                        <div class="tile-progressbar"> <span data-fill="65.5%" style="width: 65.5%;"></span> </div>
                        <div class="tile-footer">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="tile-progress tile-red">
                        <div class="tile-header">
                            <h5>Pending Requests</h5>
                            <h3>850</h3>
                        </div>
                        <div class="tile-progressbar"> <span data-fill="70%" style="width: 70%;"></span> </div>
                        <div class="tile-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="tile-progress tile-cyan">
                        <div class="tile-header">
                            <h5>Completed Jobs</h5>
                            <h3>2250</h3>
                        </div>
                        <div class="tile-progressbar"> <span data-fill="50%" style="width: 50%;"></span> </div>
                        <div class="tile-footer">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="tile-progress tile-aqua">
                        <div class="tile-header">
                            <h5>Invoices</h5>
                            <h3>530</h3>
                        </div>
                        <div class="tile-progressbar"> <span data-fill="75.5%" style="width: 75.5%;"></span> </div>
                        <div class="tile-footer">
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