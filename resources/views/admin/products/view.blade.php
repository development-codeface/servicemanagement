@extends('layouts.admin1')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Product View</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i>Product View</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content row">


             
            <a href="{{ URL::route('Products') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>

                 

                <!-- Profile Image -->
                <div class="box box-primary">

                    <div class="card-header bg-blue pullmg">
                        <div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h5 class="text-white m-b-0"> </h5>
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
                                <strong> Product No</strong>
                                <p class="text-muted"> {{$admin->product_no}}  </p>

                            </div>
                            <div class="col-lg-4">
                                <strong>Sbu Code</strong>
                                <p class="text-muted"> {{$admin->sub_code}} </p>

                            </div>
                            <div class="col-lg-4">
                                <strong>Bu Code</strong>
                                <p class="text-muted"> {{$admin->bu_code}} </p>

                            </div>
                        </div>
                        <hr>
                        <div class="row ">
                            <div class="col-lg-4">
                                <strong>
                                Description
</strong>
                                <p class="text-muted"> {{$admin->product_description}} </p>

                            </div>
                           
                            <div class="col-lg-4">
                                <strong> Service Item Group
</strong>
                                <p class="text-muted"> {{$admin->service_item_group}} </p>

                            </div>
                            <div class="col-lg-4">
                                <strong> Product Type

</strong>
                                <p class="text-muted"> {{$admin->product_type}} </p>

                            </div>
                            <hr>
                            
                           

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