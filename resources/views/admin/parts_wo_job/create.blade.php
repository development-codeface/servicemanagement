@extends('layouts.admin3')

@section('header')

@endsection

@section('content')
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1>Parts Order </h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><i class="fa fa-angle-right"></i> Parts Order</li>
      </ol>
    </div>
    
  <div class="content">
    
      <div class="row">
   
        <div class="col-lg-12">
          <div class="card ">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">Parts Order </h5>
            </div>
            <div class="card-body">
              
              <form id="ajaxForm">

		

		
        <div class="row">
          
           
          
        <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Parts</label>
              <select class="form-control" name="parts">
              @if(isset($job))
                        <option value="{{ $job->part_id }}">{{ $job->part_no }}</option>
                   
                    @else
                    <option value="">Select Parts</option> 
                  @endif
                
                   @foreach($parts as $part)
                <option value="{{$part->part_id}}">{{$part->part_no}}</option>
                @endforeach
               
              </select>            
              </fieldset>
            </div>
            
           <div class="col-lg-4">
              <fieldset class="form-group">
                <label> Parts Quantity</label>
               
                <input class="form-control" @if(isset($job)) value="{{$job->parts_qty}}" @endif name="qnty"  id="placeholderInput"  type="text">
                
                

              </fieldset>
            </div>
           
          
          </div>
          <span id="Rows"></span>
              <div class="col-lg-4">
            <button type="button" class="btn btn-info pull-right answer_next">Add More</button>
            </div>
		<div class="col-md-12 cenbut">
             <input type="hidden" name="type" value="newPartsWoJob">
             <input type="hidden" name="tech_id" value="{{$job->technician }}">
             <input type="hidden" name="location" value="{{$job->asp_location }}">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Make Order </button>
              
                 
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
      var max_fields      = 3; //maximum input boxes allowed
            var Rows         = $("#Rows"); //Fields wrapper
            var answer_next      = $(".answer_next"); //Add button ID

            $(answer_next).click(function(e){ e.preventDefault()

$(Rows).append('<div class="row">'+' <div class="col-lg-4">'+
                        '<fieldset class="form-group">'+
                        ' <label>Parts</label>'+
                        ' <select class="form-control" name="parts[]">'+
                        '<option value="">Select Parts</option> '+

  @foreach($parts as $part)
                        ' <option value="{{$part->part_id}}">{{$part->part_no}}</option>'
                +                @endforeach
                
                        ' </select>'+
                        ' </fieldset>'+
                        ' </div>'+
                        '<div class="col-lg-4">'+
                        '<fieldset class="form-group">'+
                        ' <label> Parts Quantity</label>'+
                        ' <input class="form-control" name="qnty[]"   id="placeholderInput"  type="text">'+
                        ' </fieldset>'+
                        '</div>'+
                        '</div>'
                        
                    
                );


   });

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
        $( "#mod" ).removeClass( "hidden" )
        $.ajax({
            type: 'post',
            url: "{{ URL::route('postData') }}",
            data:formData,
            success: function(data){
                setInterval(function(){
                    $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                    $('#myModal').modal('show');
                   window.location.href="{{URL::route('PartWithOutJob')}}";
                }, 1500);

            }
        });
        return false;
    }
});
});
</script>

@endsection