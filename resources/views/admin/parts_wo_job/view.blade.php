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
                                    <h5 class="text-white m-b-0">Parts Order</h5>
                                    <div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-left tcol">
                                    {{$job->order_date}}</span> </div>
                                </div>
                                <div class="ml-auto mgtap">
                                    <span class="label">Status : </span>
                                    <!-- <span class="label label-success">W11 - Completed</span> -->
                                    @if($job->is_approve == 1)
                                    <span class="label label-warning">Approved</span>
                                @elseif($job->is_approve == 2)
                                <span class="label label-warning">Rejected</span>
                                @else
                                <span class="label label-warning">Pending</span>
                                @endif
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="edc">
                        <div class="row tx_hd">
                       
                            
                            <div class="col-lg-4">
                                <h2>
                                    WareHouse</h2>
                                <p> {{$job->location}}</p>

                            </div>
                        </div>

<hr>
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
                                <p > {{$job->parts_qty}}</p>

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