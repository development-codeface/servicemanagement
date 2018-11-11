@extends('layouts.admin1')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Sapre Part View</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i>Sapre Part View</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content row">


             
            <a href="{{ URL::route('Parts') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
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
                                <strong> Part No</strong>
                                <p class="text-muted"> {{$admin->part_no}}  </p>

                            </div>
                            <div class="col-lg-4">
                                <strong>Description</strong>
                                <p class="text-muted"> {{$admin->parts_description}} </p>

                            </div>
                            <div class="col-lg-4">
                                <strong> Last KIT Bom Used</strong>
                                <p class="text-muted"> {{$admin->last_kit_bom_used}} </p>

                            </div>
                        </div>
                        <hr>
                        <div class="row ">
                            <div class="col-lg-4">
                                <strong>
                                Dealer Price
</strong>
                                <p class="text-muted"> {{$admin->dealer_price}} </p>

                            </div>
                           
                            <div class="col-lg-4">
                                <strong> Customer Price
</strong>
                                <p class="text-muted"> {{$admin->customer_price}} </p>

                            </div>
                            <div class="col-lg-4">
                                <strong> TASS Price
</strong>
                                <p class="text-muted"> {{$admin->TASS_price}} </p>

                            </div>
                            <hr>
                            
                           

                    </div>
                    <hr>
                    <div class="row ">
                   
                    <div class="col-lg-4">
                                <strong>
                                Available Qty
</strong>
                                <p class="text-muted"> {{$admin->avl_qty}} </p>

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