@extends('layouts.admin3')

@section('header')

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
              <h5 class="text-white m-b-0">Appointment</h5>
            </div>
            <div class="card-body">
              
              <form id="ajaxForm">
            <div class="row">
        
            <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control" id="placeholderInput" name="job_id" value="{{$job->job_id}}"  type="text">
            </fieldset>
          </div>
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
              <input class="form-control"  value="{{$job->address}}"  id="placeholderInput"  type="text" readonly>
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

              <option>{{$job->faulty}}</option>
              
            </select>
            </fieldset>
          </div>
         
        
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Symptom Code</label>
                 <select class="form-control" readonly>
                 <option>{{$job->symptom}}</option>

            </select>
            </fieldset>
          </div>
         
                   <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Resolution Code</label>
                 <select class="form-control" readonly>
                 <option>{{$job->resolution}}</option>

            </select>
            </fieldset>
          </div>
		   
		  	
        </div>
        <hr>
		
        <div class="row">
          
           
          
        <div class="col-lg-4 hidden">
        <fieldset class="form-group">
              <label>	Appointment Date</label>
              <input class="form-control"  name="datepicker" id="datepicker"  type="text">
            </fieldset>
            </div>
                  
         
          
          </div>
		<div class="col-md-12 cenbut">
             <input type="hidden" name="type" value="editAppointment">
             <input type="hidden" name="appointment_id" value="{{$job->appointment_id}}">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Book Now </button>
              
                 
                </div>
              </form>
           
            </div>
          </div>
        </div>
      </div>
	  
    </div>
    <!-- /.content --> 
  </div>
@endsection

@section('footer')

<script>

                
    $(document).ready(function(){

 jQuery('#datepicker').datetimepicker();

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
                   //window.location.href="{{URL::route('Jobs')}}";
                }, 1500);

            }
        });
        return false;
    }
});
});
</script>

@endsection