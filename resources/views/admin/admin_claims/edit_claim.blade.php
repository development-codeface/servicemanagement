@extends('layouts.admin2')

@section('header')

@endsection

@section('content')
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1>Claims</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><i class="fa fa-angle-right"></i> Claims</li>
      </ol>
    </div>
    
  <div class="content">
    
      <div class="row">
   
        <div class="col-lg-12">
        <a href="{{ URL::route('Jobs') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>
          <div class="card ">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">Claims</h5>
            </div>
            <div class="card-body">
              
              <form id="ajaxForm">
            <div class="row">
        
            <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Job Id </label>
              <input class="form-control" value="{{$jo_id}}" name="job_id" type="text"  readonly>

             </fieldset>
          </div>
          <div class="col-lg-4">
            <fieldset class="form-group">
              <label>Repair Order No </label>
              <input class="form-control" value="{{$apps->repaire_order_no}}"   name="repaire_order_no" type="text"  readonly>

             </fieldset>
          </div>
          </div>
		  <hr>
		
		   
	
		
			
		
        <div class="row">
          
        
            
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Mileage</label>
              <select class="form-control" name="mileage" id="mileage">
             
              @if($apps->mileage == 1)<option value="1">0-5</option>
              @elseif($apps->mileage == 2)<option value="2">5-10</option>
              @else <option value="3">10-15</option>
             @endif
                 <option value="1">0-5</option>
                    <option value="2">5-10</option>
                    <option value="3">10-15</option> 
                  </select>              
                 
            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Claim Amount</label>
              @if(isset($apps))
              <input class="form-control" value="{{$apps->claim_amount}}"  name="amount" id="amount"  type="text">
              @else
              <input class="form-control"  name="amount" id="amount"  type="text">
             @endif
            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Labour</label>
              @if(isset($apps))
              <input class="form-control" value="{{$apps->labour}}"  name="labour" id="labour"  type="text">
              @else
              <input class="form-control"  name="labour" id="labour"  type="text">
             @endif
            </fieldset>
            </div>
          
          </div>
		<div class="col-md-12 cenbut">
    <input type="hidden" name="type" value="newClaim">
                @if(isset($apps))
                    <input type="hidden" name="claim_id" value="{{$apps->claim_id}}">
                @endif
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <p class="text-center">
                                    <button type="submit" class="btn btn-lg btn-success waves-effect waves-light m-r-10">Save </button>
</p>              
                 
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
 $('#mileage').on('change', function() {
    var mil =this.value;
    if(mil == 1){
        $( "#amount" ).val( "200" );
    }
    if(mil == 2){
        $( "#amount" ).val( "400" );
    }
    if(mil == 3){
        $( "#amount" ).val( "600" );
    }
    
})
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
                  window.location.href="{{URL::route('Jobs')}}";
                }, 1500);

            }
        });
        return false;
    }
});
});
</script>

@endsection