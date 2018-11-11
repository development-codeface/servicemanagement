@extends('layouts.admin1')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>User View</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> User View</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content row">


            <div class="col-lg-12">
            <a href="{{ URL::route('Warehouse') }}"><span class="btn btn-sm btn-info"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>

                </div>

                <!-- Profile Image -->
                <div class="box box-primary">

                    <div class="card-header bg-blue pullmg">
                        <div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h5 class="text-white m-b-0">User Role : {{$admin->user_name}}</h5>
                                    <div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-left tcol"></span></span> </div>
                                </div>
                                <div class="ml-auto mgtap">
                                    <span class="label">Status : </span>
                                    
                                    <span class="label label-warning">Approved</span>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="edc">
                        <div class="row ">
                            <div class="col-lg-4">
                                <strong> Name</strong>
                                <p class="text-muted"> {{$admin->name}} </p>

                            </div>
                            <div class="col-lg-4">
                                <strong> Code</strong>
                                <p class="text-muted"> {{$admin->code}}  </p>

                            </div>
                            <div class="col-lg-4">
                                <strong> Address</strong>
                                <p class="text-muted"> {{$admin->address}} </p>

                            </div>
                        </div>
                        <hr>
                        <div class="row ">
                            <div class="col-lg-4">
                                <strong>
                                    Telephone No1</strong>
                                <p class="text-muted"> {{$admin->tel_number1}} </p>

                            </div>
                            <div class="col-lg-4">
                                <strong>  Telephone No1</strong>
                                <p class="text-muted"> {{$admin->tel_number2}} </p>

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