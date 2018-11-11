@extends('layouts.admin1')

@section('header')
 
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/wickedpicker.min.css')}}">

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
   
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Reports</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Reports</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
        
        
        
<div class="row">

         
        
      
       
        <div class="col-lg-2 no_pl">

<div class="">
<select name="example1_length"  aria-controls="example1" class="form-control input-sm filter_parts">
<option value="0">Select Filter</option>
               
			   
               <option value="1">Asp Admin</option>
               <option value="2">Date Range</option>
               
            </select>  

</div>
 


 </div>
 <div class="col-lg-4 no_pl">
 <div class=" date hidden">
    <div class="input-group mb-3 ">
  <input type="text" class="form-control" placeholder="Select Date Range" id="daterange" name="daterange" value="" >
  <div class="input-group-append">
    <button class="getbtn btn btn-info" type="button" id="getbtn">Filter</button>
    
  </div>
     </div>   
     </div>    
     
     
<div class="m-t-0" >



<div class="techn hidden" >
<div class="input-group mb-3 ">

<select class="form-control aspadm" id="asp_location" name="asp_location">
                                            <option value="">Select WareHouse</option>
                                                @foreach($warehouse as $stat)
                                                    <option value="{{$stat->code}}">{{$stat->name}} - {{$stat->code}}</option>
                                                @endforeach
                                            </select>   <div class="input-group-append">
    <button class="getbtn btn btn-info" type="button" id="getasp">Filter</button>
    

  </div>
</div> 
 </div> 



  
</div>
</div>
 <div class="col-lg-2 no_pl">
 <button id="export11" data-export="export"  class="btn btn-primary pull-right"><i class="fa fa-download" aria-hidden="true"></i> Export</button>
 </div>





<!-- createjob -->

		
	


            <div class="card m-t-3 wid_100">

                <div class="card-body">


                    
                    
<div class="no_f hidden" id="err">
   
<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No Results  Found 
    </div>



                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped" style="">
                            <thead>
                            <tr>
                            <th>Model</th> 
                            <th>Part No</th>      
                                <th>Description</th>
                                <th>Order Qty</th>
                                <th>Supplied</th>
                                <th>Job No</th>
                                <th>Delivery Date</th>
                                <th> Invoice</th>        
                                <th> ETA</th>       
                                <th> Qty still pending </th>
                                <th> Asp Company Name</th>
                                <th> Order No</th>
                                <th> Request Date</th>
                                <th> Status </th>
                               
                          
                               
                            </tr>
                            </thead>
                            <tbody>
                               @if(!empty($mul_parts))
                                
                            @foreach($mul_parts as $job)
                            <tr>
                           
                                <td>{{$job->part_no}}</td>
                                <td>{{$job->part_no}}</td>
                                <td>{{$job->parts_description}}</td>
                                <td>{{$job->quantity}}</td>
                                <td>{{$job->quantity}}</td>
                                <td>{{$job->repaire_order_no}}</td>
                                <td>{{date('d-m-Y', strtotime($job->delivery_date))}}</td>
                                <td></td>
                                <td></td>
                                <td>0</td>
                                <td>{{$job->name}}</td>
                                <td>{{$job->order_id}}</td>
								   <td>{{date('d-m-Y', strtotime($job->mul_date))}}</td>

                                <td>@if($job->isapprove==1)
                               <a> <span class="label label-success"> <span class=""></span>Approved</a>
                               @elseif($job->isapprove==2)
                               <a> <span class="label label-danger"> <span class=""></span>Rejected</a>
                               @else
                               <a> <span class="label label-info"> <span class=""></span>Pending</a>
                            @endif
							</td>
                              
                              
                                
                               



                                
                            </tr>
                               @endforeach
                             @endif
                            </tfoot>
                        </table>
                    </div>
                  
                </div>
                 
                
                </div>
              
        </div>
       
        <!-- /.content -->
    </div>
    
    <!-- /.content-wrapper -->




    
  
@endsection

@section('footer')
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
    <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
    <script src="{{ asset('assets/admin/plugins/table-expo/filesaver.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/table-expo/xls.core.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/table-expo/tableexport.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.tabletoCSV.js')}}"></script>
<script src="{{ asset('assets/admin/js/wickedpicker.min.js')}}"></script>


</script>
<script>


$("#daterange").daterangepicker({
	 locale: {
            format: 'DD/MM/YYYY'
        }
});
       
       
        
$(document).ready(function(){
    
   
    $(".close").click(function(){
    location.reload(true);

});
       $("#export11").click(function(){

$("#example2").tableToCSV();

});

$('.filter_parts').on('change', function() {

  var att =this.value;
  if(att==1){
      $( ".date" ).hide();
      $( ".techn" ).show();
  
  }
  if(att==2){
      $(".date").show();
      $( ".techn" ).hide();
    
     
  }
  
});

      $('#getasp').on('click', function() {

var asp = $('#asp_location').val();
var token = "{{ csrf_token() }}";
var type = 'filter_parts_teh';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: { type:type,asp:asp,_token:token},
             success: function(data){
                 if(data.status==1){
                     $("#example2").removeClass('hidden');
                       $("#example2").html(data.html);
                         $(".no_f").addClass('hidden');

                 }else{
                    $(".no_f").removeClass('hidden');
                   
                         $("#example2").addClass('hidden');
                     }

             }
         });
});  
$('#getbtn').on('click', function() {

var dateRange = $('#daterange').val();
var token = "{{ csrf_token() }}";
var type = 'filter_parts';
           $.ajax({
               type: 'post',
               url: '{{ URL::route("postData") }}',
               data: { type:type,dateRange:dateRange,_token:token},
               success: function(data){
                   if(data.status==1){

                       $("#example2").html(data.html);

                   }else{
                    $(".no_f").removeClass('hidden');

                         $("#example2").addClass('hidden');
                     }

               }
           });
});
   });
   </script>
    <!-- <script>
        $("table").tableExport({formats: ["xlsx","xls", "csv", "txt"],    });
    </script> -->
    
@endsection
