@extends('layouts.admin3')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Job View</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Job View</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content row">


            <div class="col-lg-12">
                
              

                <!-- Profile Image -->
                <div class="box box-primary">

                    <div class="card-header bg-blue pullmg">
                        <div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h5 class="text-white m-b-0">Job Id# : {{$job->job_id}}</h5>
                                    <div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-left tcol">23 Jan 2018 | <span>2:05 pm</span></span> </div>
                                </div>
                                <div class="ml-auto mgtap">
                                    <span class="label">Status : </span>
                                
                                    <span class="label label-warning">{{$job->status_code}}</span>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="edc">
                        <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2> Job Location</h2>
                                <p> {{$job->job_location}} </p>

                            </div>
                            <div class="col-lg-4">
                            <h2> Repaire Order No</h2>
                                <p > {{$job->repaire_order_no}}  </p>

                            </div>
                            <div class="col-lg-4">
                                <h2> First Name</h2>
                                <p > {{$job->firstname}} </p>

                            </div>
                        </div>
                        <hr>


                        <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2>
                                    Last Name</h2>
                                <p > {{$job->lastname}} </p>

                            </div>
                            <div class="col-lg-4">
                                <h2> Address</h2>
                                <p > {{$job->address}} </p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                    Pin Code</h2>
                                <p > {{$job->pincode}} </p>

                            </div>
                        </div> <hr>
                        <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2>
                                    Phone No</h2>
                                <p >{{$job->phone_no}}</p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                    Bussiness Number</h2>
                                <p > {{$job->business_number}} </p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                    Faulty Code</h2>
                                <p > {{$job->faulty_code}} </p>

                            </div>
                        </div>
                        <hr>
                        
                           
                            <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2>
                                    Symptom Code</h2>
                                <p >{{$job->symptom_code}} </p>

                            </div>
                             
                            <div class="col-lg-4">
                                <h2>
                                    Resolution Code</h2>
                                <p > {{$job->resolution_code}}</p>

                            </div>
                            
                            <div class="col-lg-4">
                                <h2>
                                    Service Type</h2>
                                <p > {{$job->servicetype}}</p>

                            </div>
                            </div>
                            <hr>
                            

                            <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2>
                                    Appointment Date</h2>
                                <p > {{$job->appointment_time}}</p>

                            </div>
                            
                            <div class="col-lg-4">
                                <h2>
                                Appointment Status</h2>
                                @if($job->appointment_status != 'false')<p > Created</p>
                                @else
                                <p>Cancelled</p>
                                @endif

                            </div>
                            
                            
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