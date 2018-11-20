@extends('layouts.admin1')

@section('header')
<!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" /> -->


@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
 
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1> R1 Completed Jobs</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i>R1 Completed Jobs</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">
                
            
<div class="col-lg-2 no_pl">

<div class="">
<select name="example1_length"  aria-controls="example1" class="form-control input-sm filter">
<option value="0">Select Filter</option>
               <option value="1">Asp Admin</option>
               <option value="2">Technician</option>
               <option value="3">Date Range</option>
              
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

<div class="ware hidden" >

<div class="input-group mb-3 ">





    

<select class="form-control aspadm" id="asp_location" name="asp_location">
                                            <option value="">Select WareHouse</option>
                                                @foreach($warehouse as $stat)
                                                    <option value="{{$stat->code}}">{{$stat->name}} - {{$stat->code}}</option>
                                                @endforeach
                                            </select>  <div class="input-group-append">
    <button class="getbtn btn btn-info" type="button" id="getasp">Filter</button>
    

  </div>
  </div> 
  
  
  </div> 

<div class="techn hidden" >
<div class="input-group mb-3 ">

<select class="form-control aspadm" id="technician" name="technician">
                                            <option value="">Select Technician</option>
                                            @foreach($techs as $tech)        
                                   <option value="{{$tech->id}}">{{$tech->email}}</option>
                                   @endforeach
                                            </select>  <div class="input-group-append">
    <button class="getbtn btn btn-info" type="button" id="gettech">Filter</button>
    

  </div>
</div> 
 </div> 


 <div class="stat hidden">


 
<div class="input-group mb-3 ">

<select class="form-control aspadm" id="status" name="status">
                                            <option value="">Select Status</option>
                                            @foreach($status as $tech)        
                                   <option data-name="{{$tech->status_code}}" value="{{$tech->status_id}}">{{$tech->status_code}}-{{$tech->status_description}}</option>
                                   @endforeach
                                            </select>  
                                            <div class="input-group-append">
    <button class="getbtn btn btn-info" type="button" id="getstat">Filter</button>
    

  </div>
</div>  




</div> 
<div class="input-group-append cser hidden">
    <button class="getbtn btn btn-info" type="button" id="getcsv">Filter</button>
    

  </div>
  <div class="input-group-append sw hidden">
    <button class="getbtn btn btn-info" type="button" id="getsw">Filter</button>
    

  </div>
</div>
</div>
 <div class="col-lg-2 no_pl">
 <button id="export11" data-export="export"  class="btn btn-primary pull-right"><i class="fa fa-download" aria-hidden="true"></i> Export</button>
 </div>


    
  
            <div class="card m-t-2 wid_100">
                <div class="card-body">


                       

<div class="no_f hidden" id="err">
   
   <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No Results  Found 
       </div>

                    <div class="table-responsive">

                        <table id="example2" class="table table-bordered table-striped">
                       
                            <thead>
                            <tr>
                           
                            <th>Job date</th>
                            <!-- <th>Job Id</th> -->
                                <th>Status</th>
                                <th>ASP Technician</th>
                                <th>ASP Location</th>

                           <th>Job Location</th>
                                <th>Repair Order No</th>
                               
                                <th> Bill To Name</th>
                               
                                <th> Contact Number</th>
                                <th> Complaints/Remarks</th>
                                <th> Symptom Code</th>
                                <th> Resolution Code</th>
                                <th>Change Code Proof</th>
                               
                                
                               
                                <th> Turn Around Time</th>
                                <th> Appointment Date</th>
                                <th> Order Date</th>
                               
                                <th> Item No(Model No)</th>
                                <th> Seriel No</th>
                                <th> Service Item Group</th>
                                <th> Purchase Date</th>
                                <th> Item No(Part No)</th>
                                <th> Description</th>
                                <th> Location</th>
                                <th> Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                            <tr>
                           <td>{{date('d-m-Y', strtotime($job->job_date))}}</td>
                           <!-- <td>{{$job->job_id}}</td> -->
                                <td><span class="label label-success">{{$job->status_code}}-{{$job->status_description}}</span></td>
                                <td>{{$job->email}}</td>
                                <td>{{$job->asp_location}}</td>
                               
                                <td>{{$job->job_location}}</td>
                               <td>{{$job->repaire_order_no}}</td>
                              
                               
                                <td>{{str_limit($job->cu_address,25)}}</td>
                                
                                <td>{{$job->phone_no}}</td>
                                <td>{{$job->job_remark}}</td>
                                <td>{{$job->symptom_description}}</td>
                                <td>{{$job->resolution_description}}</td>
                                <td>{{$job->change_code}}</td>

                            @if($job->turn_fround_time)
                                    <td>{{$job->turn_fround_time}} days</td>
                                @else
                                    <td></td>
								@endif
                               
                            @if($job->appointment_time)
                                <td>{{date('d-m-Y', strtotime($job->appointment_time))}}</td>
                            @else
                                <td></td>
                            @endif
                            @if($job->order_date)    
                                <td>{{date('d-m-Y', strtotime($job->order_date))}}</td>
                            @else 
                                <td></td>
                            @endif 
                                <td>{{$job->product}}</td>
                                <td>{{$job->seriel_number}}</td>
                                <td>{{$job->servicetype}}</td>
                                @if($job->purchase_date)<td>{{date('d-m-Y', strtotime($job->purchase_date))}}</td>
                @else<td></td>@endif
                             <?php $var = App\Models\PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('jobs.job_id','=',$job->job_id)
                ->get();?>
                                <td>@foreach($var as $va){{$va->part_no}}|@endforeach</td>
                   <td>{{$job->description}}</td>
                                <td>{{$job->warehouse_id}}</td>
                                <td></td>
                            </tr>
                             @endforeach
</tbody>
</div>    
                        </table>

                    </div>
                   
                </div>
                
                </div>


                  </div>
        </div>
        {{$jobs->links()}}
        <!-- /.content -->
     
    <!-- /.content-wrapper -->
   
@endsection

@section('footer')
<script src="{{ asset('assets/admin/plugins/table-expo/filesaver.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/table-expo/xls.core.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/table-expo/tableexport.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.tabletoCSV.js')}}"></script>
    
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
 <!-- <script>
        $("table").tableExport({formats: ["xlsx","xls", "csv", "txt"],    });
    </script>  -->
    <script>
        $(document).ready(function(){
            $("#export11").click(function(){
                if($( "#example2" ).hasClass("hidden")){
                    alert("No Job Available for export !!");
                }else {
                    $("#example2").tableToCSV();
                }   
            });
            $("#daterange").daterangepicker();
                $('#getbtn').on('click', function() {
                    var dateRange = $('#daterange').val();
                    var token = "{{ csrf_token() }}";
                    var type = 'filter_list';
                    $.ajax({
                        type: 'post',
                        url: '{{ URL::route("postData") }}',
                        data: { type:type,dateRange:dateRange,_token:token},
                        success: function(data){
                            if(data.status==1){
                                $(".no_f").addClass('hidden');
                                $("#example2").removeClass('hidden');
                                $("#example2").html(data.html);
                            }
                            else{
                                $(".no_f").removeClass('hidden');
                                $("#example2").addClass('hidden');
                            }
                        }
                    });
            });


 $('#getasp').on('click', function() {

var asp = $('#asp_location').val();
var token = "{{ csrf_token() }}";
var type = 'filter_asp';
           $.ajax({
               type: 'post',
               url: '{{ URL::route("postData") }}',
               data: { type:type,asp:asp,_token:token},
               success: function(data){
                   if(data.status==1){
 $(".no_f").addClass('hidden');

                       $("#example2").html(data.html);

                   }
                   else{
                    $(".no_f").removeClass('hidden');
                         $("#example2").addClass('hidden');
                     }
               }
           });
});

$('#gettech').on('click', function() {

var technician = $('#technician').val();
var token = "{{ csrf_token() }}";
var type = 'filter_tech';
           $.ajax({
               type: 'post',
               url: '{{ URL::route("postData") }}',
               data: { type:type,technician:technician,_token:token},
               success: function(data){
                   if(data.status==1){
 $(".no_f").addClass('hidden');
                       $("#example2").html(data.html);

                   }else{
                    $(".no_f").removeClass('hidden');
                         $("#example2").addClass('hidden');
                     }

               }
           });
});



$('#getstat').on('click', function() {

var status = $('#status').val();
alert(status);
var token = "{{ csrf_token() }}";
var type = 'filter_stat';
           $.ajax({
               type: 'post',
               url: '{{ URL::route("postData") }}',
               data: { type:type,status:status,_token:token},
               success: function(data){
                   if(data.status==1){
 $(".no_f").addClass('hidden');
                       $("#example2").html(data.html);

                   }else{
                    $(".no_f").removeClass('hidden');
                         $("#example2").addClass('hidden');
                     }

               }
           });
});
$('.filter').on('change', function() {
    var att =this.value;
    if(att==3){
      $( ".date" ).show();
      $( ".ware" ).hide();
      $( ".techn" ).hide();
      $( ".stat" ).hide();
  }
  if(att==1){
      $( ".ware" ).show();
      $( ".date" ).hide();
    
      $( ".techn" ).hide();
      $( ".stat" ).hide();
  }
  if(att==2){
      $( ".techn" ).show();
      $( ".stat" ).hide();
      $( ".ware" ).hide();
      $( ".date" ).hide();
    
  }
  if(att==4){
      $( ".stat" ).show();
      $( ".techn" ).hide();
      $( ".ware" ).hide();
      $( ".date" ).hide();
    
  }
  if(att==5){
    $( ".cser" ).show();
    $( ".stat" ).hide();
      $( ".techn" ).hide();
      $( ".ware" ).hide();
      $( ".date" ).hide();
  }
  if(att==6){
    $( ".sw" ).show();
    $( ".cser" ).hide();
    $( ".stat" ).hide();
      $( ".techn" ).hide();
      $( ".ware" ).hide();
      $( ".date" ).hide();
  }
});
            $('.deleteButton').click(function(){

                var user_id = $(this).attr('data-id');
                $('#delete_id').val(user_id);
            });
            $("#deleteModalForm").validate({
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },

                submitHandler: function(form) {

                    // do other things for a valid form
                    var formData = $("#deleteModalForm").serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('PostRemove') }}",
                        data:formData,
                        success: function(data){
                            if(data.status == 1){

                                $('.modal-body').html(' Successfully Deleted');
                                $('#modalFooter').addClass('hidden');
                                setTimeout(function(){
                                    location.reload();
                                },1000);

                            }
                        }
                    });
                    return false;
                }

            });

        });
    </script>
@endsection
