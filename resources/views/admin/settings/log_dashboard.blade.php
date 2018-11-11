@extends('layouts.admin4')

@section('header')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Logistic Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Logistic Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
        
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3">
                    <div class="tile-progress tile-pink">
                        <div class="tile-header">
                            <h5>Spare Parts Orders</h5>
                            <h3>{{$jobs}}</h3>
                        </div>
                        <div class="tile-progressbar"> <span data-fill="65.5%" style="width: 65.5%;"></span> </div>
                        <div class="tile-footer">
                        <a href="{{URL::route('LogPartsOrder')}}">View More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="tile-progress tile-aqua">
                        <div class="tile-header">
                            <h5>Rma Requests</h5>
                            <h3>{{$rma}}</h3>
                        </div>
                        <div class="tile-progressbar"> <span data-fill="65.5%" style="width: 65.5%;"></span> </div>
                        <div class="tile-footer">
                        <a href="{{URL::route('LogRmaOrder')}}">View More</a>  
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="tile-progress tile-cyan">
                        <div class="tile-header">
                            <h5>Grn Requests</h5>
                            <h3>{{$gma}}</h3>
                        </div>
                        <div class="tile-progressbar"> <span data-fill="65.5%" style="width: 65.5%;"></span> </div>
                        <div class="tile-footer">
                        <a href="{{URL::route('LogGrnOrder')}}">View More</a>
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