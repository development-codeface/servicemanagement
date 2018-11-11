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
            <h1>Job Edit</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Job Edit</li>
            </ol>
        </div>

        <div class="content">

            <div class="row">

                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-header bg-blue">
                            <h5 class="text-white m-b-0">Job Edit</h5>
                        </div>
                        <div class="card-body">

                            <form id="ajaxForm">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Job Location</label>

                                            <input class="form-control" id="placeholderInput" name="job_location" value="{{$job->job_location}}" type="text" readonly >
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Repaire Order No</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->repaire_order_no}}" type="text" readonly>

                                        </fieldset>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->firstname}}" type="text" readonly>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Last Name</label>
                                            <input class="form-control" id="placeholderInput" value=" {{$job->lastname}}"  type="text" readonly>
                                        </fieldset>
                                    </div> 
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Address</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->address}}, Kerala 683580"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Pin Code</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->pincode}}" type="text" readonly>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Phone No</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->phone_no}}"  type="text" readonly>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Bussiness Number</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->bussiness_number}}"  type="text" readonly>
                                        </fieldset>
                                    </div>

                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>

                                            <select class="form-control" name="faulty" >
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
                                                @if(isset($admin))
                                                    <option value="{{ $admin->symptom_id }}">{{ $admin->symptom_description }}</option>
                                                @endif
                                                    @foreach($symptoms as $menu)
                                                        <option value="{{ $menu->symptom_id}}">{{$menu->symptom_description }}</option>
                                                    @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution">
                                            @if(isset($admin))
                                                    <option value="{{ $admin->resolution_id }}">{{ $admin->resolution_description }}</option>
                                                @endif
                                                @foreach($resolutions as $menu)
                                                    <option value="{{ $menu->resolution_id }}">{{$menu->resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
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
                                            <label>	Description</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->parts_description}}"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Quantity</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->parts_qty}}"  type="text">
                                        </fieldset>
                                    </div>
                                    
                                </div>

                                <div class="col-md-12">
                                    <input type="hidden" name="type" value="edit-parts">
                                    <input type="hidden" name="job_id" value="{{$job->job_id}}">
                                    <input type="hidden" name="part_order_id" value="{{$job->part_order_id }}">                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
    <div class="animatedParent">

<div class="modal fade modaltop animated growIn slow go " id="myModal" role="dialog">
 <div class="modal-dialog">

   <!-- Modal content-->
   <div class="modal-content modaltop">
     <div class="modal-header">
     <h4 class="modal-title"> Part order request updated</h4> 

       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <div class="modal-body lodgif">
     <img src="{{asset('assets/admin/img/check-circle.gif')}}">
     <h1 > Are you sure to continue?</h1>
   
     </div>
    
   </div>
 </div>
</div>
</div>
@endsection

@section('footer')

    <script>
        jQuery('#datepicker').datetimepicker();
        jQuery('#datepicker1').datetimepicker();

        $(document).ready(function(){
            $( ".reject" ).change(function() {
             var rej= this.value;
             if(rej == 0){
                $(".select-pane").show();
             }
});
            /*$('#menu_id').change(function() {
                var optionSelected = $(this).val();
                alert(optionSelected);
                if (optionSelected == 3) {
                    $( ".servicetype" ).removeClass('hidden')
                }
            });*/




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
                   
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            setInterval(function(){
                                $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                                $('#myModal').modal('show');
                       window.location.href="{{URL::route('AspPartsOrder')}}";
                            }, 1500);

                        }
                    });
                    return false;
                }
            });
        });
        function removeImage(id){

            var type = 'removeBanner';
            var id = id;


            $.ajax({

                type:'post',
                url:"{{ URL::route('PostRemove') }}",
                data:{id:id,_token: '{{ csrf_token() }}',type:type},
                success:function(data){
                    if(data.status==1){

                        $("#ImagePrevs").addClass('hidden');

                    }

                }

            });

        }
    </script>

@endsection
