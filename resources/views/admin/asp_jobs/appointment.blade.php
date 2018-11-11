@extends('layouts.admin2')

@section('header')

<style>
	.select-pane {
    display:none;
}
	</style>
@endsection

@section('content')
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1>Appointment</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><i class="fa fa-angle-right"></i> Appointment</li>
      </ol>
    </div>
    
  <div class="content">
    
      <div class="row">
   
        <div class="col-lg-12">
          <div class="card ">
            <div class="card-header bg-blue">
            <div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                @if(isset($apps))<h5 class="text-white m-b-0">Appointment Date &nbsp;&nbsp;<span class="label label-warning">{{date('F d, Y', strtotime($apps->appointment_time))}} </span></h5>
                                    @endif
                                </div>
                                <div class="ml-auto mgtap">
                                <span class="label">Status : </span>
                                    <!-- <span class="label label-success">W11 - Completed</span> -->
                                    <span class="label label-warning">{{$apps->status_code}}-{{$apps->status_description}}</span>
                                    <!-- <span class="label label-success">W11 - Completed</span> -->
                                    
                                </div>
                            </div>
                        </div>

               
            </div>
            </div>
            <div class="card-body">
              
              <form id="ajaxForm">
            <div class="row">
        
            <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control" id="placeholderInput" name="job_id" value="{{$job->job_id}}"  type="text" readonly>
            </fieldset>
          </div>
          <!-- <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Job Satus</label>
                                            <select class="form-control" name="job_status">

                                                @if(isset($apps))<option value="{{$apps->status_id}}">{{$apps->status_description }}</option>@endif
                                                @foreach($status as $menu)
                                                    <option value="{{ $menu->status_id }}">{{$menu->status_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div> -->
          </div>
		  <hr>
		
		   <div class="row">
         
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>First Name</label>
              
              <input class="form-control" id="placeholderInput" value="{{$job->firstname}}"  type="text" readonly>
            </fieldset>
          </div>
		   <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	Last Name</label>
              <input class="form-control"  value="{{$job->lastname}}"  id="placeholderInput"  type="text" readonly>
            </fieldset>
          </div>
		   <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	Address</label>
              <input class="form-control"  value="{{$job->cu_address}}"  id="placeholderInput"  type="text" readonly>
            </fieldset>
          </div>
		   <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	Pin Code</label>
              <input class="form-control"  value="{{$job->pincode}}"  id="placeholderInput" type="text" readonly>
            </fieldset>
          </div>
		  <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	Phone No</label>
              <input class="form-control"  value="{{$job->phone_no}}"  id="placeholderInput"  type="text" readonly>
            </fieldset>
          </div>
		   <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	Bussiness Number</label>
              <input class="form-control"  value="{{$job->bussiness_number}}"  id="placeholderInput"  type="text" readonly>
            </fieldset>
          </div>
         
        </div>
		 <hr>
		
			<div class="row">
			  <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Faulty Code</label>
             <select class="form-control" readonly>

              <option>{{$job->faulty_description}}</option>
              
            </select>
            </fieldset>
          </div>
         
        
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Symptom Code</label>
                 <select class="form-control" readonly>
                 <option>{{$job->symptom_description}}</option>

            </select>
            </fieldset>
          </div>
         
                   <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Resolution Code</label>
                 <select class="form-control" readonly>
                 <option>{{$job->resolution_description}}</option>

            </select>
            </fieldset>
          </div>
		   
		  	
        </div>
        <hr>
		
        <div class="row m-t-2ow">

 <div class="col-lg-2">         
     <button  style="margin-top: 31px;" type="button" id="chngest" class="btn btn-info m-r-1"> Change Date</button>

</div>
          
        <div class="col-lg-4 select-pane">
        <fieldset class="form-group">
              <label>	Appointment Date</label>
              @if(isset($apps))
              <input class="form-control" value="{{date('F d, Y', strtotime($apps->appointment_time))}}"  name="datepicker" id="datepicker"  type="text">
              @else
              <input class="form-control" name="datepicker" id="datepicker"  type="text">
              @endif
            </fieldset>
            </div>
            
           

          
          </div>
		<div class="col-md-12 cenbut">
    <input type="hidden" name="type" value="newAppointment">
    <input type="hidden" name="job_id" value="{{$job->job_id}}">

                @if(isset($apps))
                    <input type="hidden" name="app_id" value="{{$apps->appointment_id}}">
                    <input type="hidden" name="job_id" value="{{$job->job_id}}">

                @endif
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Make Appointment </button>
              
                 
                </div>
              </form>
           
            </div>
          </div>
        </div>
      </div>
	  
    </div>
    <!-- /.content --> 
  </div>
  <div class="animatedParent">

<div class="modal fade modaltop animated growIn slow go " id="myModal" role="dialog">
 <div class="modal-dialog">

   <!-- Modal content-->
   <div class="modal-content modaltop">
     <div class="modal-header">
     <h4 class="modal-title"> Appointment Changed</h4> 

       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <div class="modal-body lodgif">
     <img src="{{asset('assets/admin/img/check-circle.gif')}}">
     
   
     </div>
    
   </div>
 </div>
</div>
</div>
@endsection

@section('footer')

<script>

                
    $(document).ready(function(){

 jQuery('#datepicker').datetimepicker();
 $( "#chngest" ).click(function() {
  $(".select-pane").show();
});
$("#ajaxForm").validate({
    rules: {
        email: {
            required: true,
        },password: {
            required: true,
        },files: {
            required: true,
        }
    },
    messages: {
        name: {
            required: "Please enter  name ",
        }
    },
    errorPlacement: function(error, element) {
        console.log(element.attr('name'));
        $( error ).insertAfter( element);
    },
    submitHandler: function(form) {

        // do other things for a valid form
        var formData = $("#ajaxForm").serialize();
        $("#modal-body lodgif").html("Your formhas been successfully submitting...");
        $('#myModal').modal('show');
        $.ajax({
            type: 'post',
            url: "{{ URL::route('postData') }}",
            data:formData,
            success: function(data){
                setInterval(function(){
                    $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                    $('#myModal').modal('show');
                  window.location.href="{{URL::route('AspJobs')}}";
                }, 1500);

            }
        });
        return false;
    }
});
});
</script>

@endsection