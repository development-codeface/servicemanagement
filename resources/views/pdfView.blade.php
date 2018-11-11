@extends('layouts.admin3')

@section('header')
 

@endsection

@section('content')
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1>Invoice</h1>
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><i class="fa fa-angle-right"></i> Invoice</li>
      </ol>
    </div>
    
    <!-- Main content -->
    <div class="content">
      <div class="m-b-3">
        
      </div>
      <div class="card"> 
      <div class="card-body">
        <!-- Main content -->
        <div class="invoice"> 
          <!-- title row -->
          <div class="row">
            <div class="col-lg-12 m-b-3">
              <h3 class="text-black"> INVOICE <span class="pull-right">#5669626</span> </h3>
            </div>
            <!-- /.col --> 
          </div>
          <!-- info row -->
          <div class="row invoice-info m-b-3">
            <div class="col-sm-4 invoice-col"> From
              <address>
              <strong>Toshiba sales and Services SDN BHD</strong><br>
              Groundfloor & Level 5,<br>
             Bangunan PalmGrove ,12,JLN<br>
             Glenmarie,Sec UI ,40150 Shah Alam<br>
              Phone: 03-55658000<br>
              Fax: 03-55692209<br>
              GST No: <br>
             A/C No:3000/S01
              </address>
            </div>
            <!-- /.col -->
           
            <!-- /.col -->
            <div class="col-sm-4 invoice-col"> Tax Invoice
              <address>
              <strong></strong><br>
             Date:<br>
              Printed On:<br>
              Printed By::Admin<br>
              
              </address>
            </div>
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
          
          <!-- Table row -->
          <div class="row ">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    
                    <th>Product</th>
                   
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  
                   
                 
                </tbody>
              </table>
            </div>
            <!-- /.col --> 
          </div>
          <!-- /.row -->
          
          <div class="row m-t-3"> 
            <!-- accepted payments column -->
            <!-- <div class="col-lg-6">
              <p class="lead">Payment Methods:</p>
              <img src="dist/img/mastercard.png" alt="Visa"> <img src="dist/img/mastercard.png" alt="Mastercard"> <img src="dist/img/american-express.png" alt="American Express"> <img src="dist/img/paypal2.png" alt="Paypal">
              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;"> Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra. </p>
            </div>
           
            <div class="col-lg-6">
              <p class="lead">Amount Due 2/22/2014</p>
              <div class="table-responsive">
                <table class="table">
                  <tbody><tr>
                    <th style="width:50%">Subtotal:</th>
                    <td>$250.30</td>
                  </tr>
                  <tr>
                    <th>Tax (9.3%)</th>
                    <td>$10.34</td>
                  </tr>
                  <tr>
                    <th>Shipping:</th>
                    <td>$5.80</td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td>$265.24</td>
                  </tr>
                </tbody></table>
              </div>
            </div>
            -->
          </div>
        
          
          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-lg-12">
              
              <button type="button" class="btn btn-primary pull-right download" style="margin-right: 5px;"> <i class="fa fa-download"></i> Generate PDF </button>
            </div>
          </div>
        </div>
        <!-- /.content --> 
      </div></div>
    </div>
    <!-- /.content --> 
  </div>
@endsection

@section('footer')
<script>
  
    </script>
@endsection
