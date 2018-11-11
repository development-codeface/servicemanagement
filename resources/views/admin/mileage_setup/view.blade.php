@extends('layouts.admin1')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Mileage View</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Mileage View</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content row">


             
            <a href="{{ URL::route('Mileages') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>

                 

                <!-- Profile Image -->
                <div class="box box-primary">

                    <div class="card-header bg-blue pullmg">
                        <div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h5 class="text-white m-b-0"> {{$admin->user_name}}</h5>
                                    <div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-left tcol"></span></span> </div>
                                </div>
                                <div class="ml-auto mgtap">
                                    <span class="label"> </span>
                                    
                                   
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="edc">
                        <div class="row ">
                            
                            <div class="col-lg-4">
                                <strong> Minimum Mileage</strong>
                                <p class="text-muted"> {{$admin->min_mil}}  </p>

                            </div>
                            <div class="col-lg-4">
                                <strong>Maximum Mileage</strong>
                                <p class="text-muted"> {{$admin->max_mil}} </p>

                            </div>
                            <div class="col-lg-4">
                                <strong> Amount</strong>
                                <p class="text-muted"> {{$admin->mil_amount}} </p>

                            </div>
                        </div>

                       
            </div>

        </div>
        <!-- /.content -->
    </div>
@endsection
@section('footer')

@endsection