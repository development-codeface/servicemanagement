@extends('layouts.admin1')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>WareHouse Details</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i>WareHouse Details</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content row">


             
            <a href="{{ URL::route('AspAdmin') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
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
                                <div class="st_div">
                                    <span class="label">Status : </span>
                                    
                                    <span class="label label-success">Active</span>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="edc">
                        <div class="row ">
                            
                            <div class="col-lg-4">
                                <strong> Email</strong>
                                <p class="text-muted"> {{$admin->email}}  </p>

                            </div>
                            <div class="col-lg-4">
                                <strong> WareHouse Id</strong>
                                <p class="text-muted"> {{$admin->warehouse_id}} </p>

                            </div>
                            <div class="col-lg-4">
                                <strong> WareHouse Name</strong>
                                <p class="text-muted"> {{$admin->name}} </p>

                            </div>
                        </div>
                        <hr>
                        <div class="row ">
                            <div class="col-lg-4">
                                <strong>
                                    Code</strong>
                                <p class="text-muted"> {{$admin->code}} </p>

                            </div>
                           
                            <div class="col-lg-4">
                                <strong> Telephone Number1</strong>
                                <p class="text-muted"> {{$admin->tel_number1}} </p>

                            </div>
                            <div class="col-lg-4">
                                <strong> Fax</strong>
                                <p class="text-muted"> {{$admin->tel_number1}} </p>

                            </div>
                            <hr>
                            
                           

                    </div>
                    <hr>
                    <div class="row ">
                   
                    <div class="col-lg-4">
                                <strong>
                                    Address</strong>
                                <p class="text-muted"> {{$admin->address}} </p>

                            </div>
                            </div>
                    <!-- /.box -->
                </div>
            </div>

        </div>
        <!-- /.content -->
    </div>
@endsection
@section('footer')

@endsection