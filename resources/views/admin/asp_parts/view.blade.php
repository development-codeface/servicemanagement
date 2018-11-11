@extends('layouts.admin2')

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
                
                   
            <a href="{{ URL::route('AspPartsOrder') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>

                <!-- Profile Image -->
                <div class="box box-primary">

                    <div class="card-header bg-blue pullmg">
                        <div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h5 class="text-white m-b-0">Order Id# : {{$job->part_order_id}}</h5>
                                    <div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-left tcol">{{date('d-m-Y', strtotime($job->job_date))}}</span> </div>
                                </div>
                                <div class="ml-auto mgtap">
                                    <span class="label">Status : </span>
                                    <!-- <span class="label label-success">W11 - Completed</span> -->
                                    @if($job->isapprove == 1)
                                    <span class="label label-warning">Approved</span>
                                @elseif($job->isapprove == 2)
                                <span class="label label-warning">Rejected</span>
                                @else
                                <span class="label label-warning">Pending</span>
                                @endif                                </div>
                            </div>
                        </div>


                    </div>
                    @if($job->job_id)
                    <div class="edc">
                        <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2> Job Location</h2>
                                <p> {{$job->job_location}} </p>

                            </div>
                            <div class="col-lg-4">
                            <h2> Repair Order No</h2>
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
                                <h2> Bill To Name</h2>
                                <p > {{$job->cu_address}} </p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                    Phone NoBussiness Number</h2>
                                <p >{{$job->phone_no}}</p>

                            </div>
                            <!-- <div class="col-lg-4">
                                <h2>
                                    Pin Code</h2>
                                <p > {{$job->pincode}} </p>

                            </div> -->
                        </div> <hr>
                        <div class="row tx_hd">
                            
                            <!-- <div class="col-lg-4">
                                <h2>
                                    </h2>
                                <p > {{$job->business_number}} </p>

                            </div> -->
                            <div class="col-lg-4">
                                <h2>
                                    Faulty Code</h2>
                                <p > {{$job->faulty_description}} </p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                    Symptom Code</h2>
                                <p >{{$job->symptom_description}} </p>

                            </div>
                             
                            <div class="col-lg-4">
                                <h2>
                                    Resolution Code</h2>
                                <p > {{$job->resolution_description}}</p>

                            </div>
                        </div>
                        <hr>
                        
                           
                           
                        <?php $i=1;?>
                          @foreach($mul_parts as $parts)
                            <div class="row tx_hd">
                    
                            <div class="col-lg-4">
                                <h2>
                                    Part&nbsp;<?php echo $i;?> </h2>
                                <p > {{$parts->part_no}}</p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                             Quantity</h2>
                                <p > {{$parts->quantity}}</p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                             Description</h2>
                                <p > {{$parts->parts_description}}</p>

                            </div>
                        </div>
                       


<?php $i++;?>
@endforeach
<hr>
                     <div class="row tx_hd">
                     <div class="col-lg-4">
                                <h2>
                                    Remarks</h2>
                                <p> {{$job->note}}</p>

                            </div>
                     <div class="col-lg-4">
                                <h2>
                                    Asp Admin</h2>
                                <p> {{$job->asp_location}}</p>

                            </div>
                            
                            <div class="col-lg-4">
                                <h2>
                                   Asp  Technician</h2>
                                <p > {{$job->technician}}</p>

                            </div>
                        </div>


                    @else
                    <div class="row tx_hd">
                            <div class="col-lg-4">
                                <h2>
                                    Parts Order Date </h2>
                                <p > {{$job->order_date}}</p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                                    Part No </h2>
                                <p > {{$job->part_no}}</p>

                            </div>
                            <div class="col-lg-4">
                                <h2>
                            Parts quantity</h2>
                                <p > {{$job->quantity}}</p>

                            </div>
                            
                           
                        </div>
                        @endif
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