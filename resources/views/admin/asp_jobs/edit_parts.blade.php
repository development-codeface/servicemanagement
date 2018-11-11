@extends('layouts.admin2')

@section('header')

@endsection

@section('content')
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1>Parts Order Request</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><i class="fa fa-angle-right"></i> Parts Order Request</li>
      </ol>
    </div>
    
  <div class="content">
    
      <div class="row">
   
        <div class="col-lg-12">
        <a href="{{ URL::route('AspJobs') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>
          <div class="card ">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">Parts Order Request</h5>
            </div>
            <div class="card-body">
              
              <form id="ajaxForm">
            <div class="row">
        
            <div class="col-lg-4">
            <fieldset class="form-group">
            
            <label>Job Id</label>
              <input class="form-control" id="placeholderInput" name="job_id" value="{{$job->job_id}}"  type="text" readonly>
             
            
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
              <input class="form-control"  value="{{$job->cu_address}}"  id="placeholderInput"  type="text" readonly>
            </fieldset>
          </div>
		   <!-- <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	Pin Code</label>
              <input class="form-control"  value="{{$job->pincode}}"  id="placeholderInput" type="text" readonly>
            </fieldset>
          </div> -->
		  <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	Phone No/Bussiness Number</label>
              <input class="form-control"  value="{{$job->phone_no}}"  id="placeholderInput"  type="text" readonly>
            </fieldset>
          </div>
		   <!-- <div class="col-lg-4">
            <fieldset class="form-group">
              <label>	</label>
              <input class="form-control"  value="{{$job->bussiness_number}}"  id="placeholderInput"  type="text" readonly>
            </fieldset>
          </div> -->
         
        </div>
		 <hr>
		
			<div class="row">
			  <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Faulty Code</label>
             
             <select class="form-control" name="faulty">
             @if(isset($job))
                  <option value="{{ $job->faulty_id }}">{{ $job->faulty_description }}</option>
              @endif
                  @foreach($faultys as $menu)
                      <option value="{{ $menu->faulty_id }}">{{$menu->faulty_description }}</option>
                  @endforeach              
            </select>
            </fieldset>
          </div>
         
        
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Symptom Code</label>
                 <select class="form-control" name="symptom">
                 @if(isset($job))
              <option value="{{ $job->symptom_id }}">{{ $job->symptom_description }}</option>
          @endif
              @foreach($symptoms as $menu)
                  <option value="{{ $menu->symptom_id }}">{{$menu->symptom_description }}</option>
              @endforeach
            </select>
            </fieldset>
          </div>
         
                   <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Resolution Code</label>
                 <select class="form-control" name="resolution">
           @if(isset($job))
                        <option value="{{ $job->resolution_id }}">{{ $job->resolution_description }}</option>
                    @endif
                        @foreach($resolutions as $menu)
                            <option value="{{ $menu->resolution_id }}">{{$menu->resolution_description }}</option>
                        @endforeach
            </select>
            </fieldset>
          </div>
        </div>
        <hr>
       
      
        <div class="row">
       
                                      <?php $i=1;?>
                                   @foreach($mul_parts as $mul) 
                                   
                                        <div class="col-lg-4">

                                        <fieldset class="form-group">
                                            <label>Part &nbsp;<?php echo $i;?></label>
                                            <select class="form-control" name="parts[]">
                                            
                                                    <option value="{{$job->part_id}}">{{ $mul->part_no }}</option>
                                            
                                                @foreach($parts as $part)
                                                <option value="{{$part->part_id}}">{{$part->part_no}}</option>
                                                @endforeach
                                              
                                            </select>            
                                            </fieldset>
                                            </div>
                                           
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Description</label>
                                            <input class="form-control" id="placeholderInput" value="{{$mul->parts_description}}"  type="text" readonly>
                                        </fieldset>
                                    </div>
                                  
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Quantity</label>
                                            <input class="form-control" name="qty[]" value="{{$mul->quantity}}"  type="text" >
                                            <input type="hidden" name="ml_id[]" value="{{$mul->mul_part_id}}">
                                            <input type="hidden" name="part_n[]" value="{{$mul->parts}}">

                                        </fieldset>
                                    </div>
                                    <?php $i++;?>
                                    @endforeach
		<div class="col-md-12 cenbut">
             <input type="hidden" name="type" value="edit-parts">
             <input type="hidden" name="job_id" value="{{$job->job_id }}">
             <input type="hidden" name="part_order_id" value="{{$job->part_order_id }}"
             <input type="hidden" name="tech_id" value="{{$job->technician }}">
             <input type="hidden" name="location" value="{{$job->asp_location }}">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Save </button>
              
                 
                </div>
              </form>
           
            </div>
          </div>
        </div>
      </div>
	  
    </div>
    <!-- /.content --> 
  </div>
  <div class="loading style-2 hidden" id="mod">
    <div class="loading-wheel "></div></div>
@endsection

@section('footer')

<script>
               
    $(document).ready(function(){

 jQuery('#datepicker').datetimepicker({
                format: 'd-m-Y',
 
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
        $( "#mod" ).removeClass( "hidden" )
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