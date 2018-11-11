@extends('layouts.admin1')

@section('header')

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Create New Job</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Create New Job</li>
            </ol>
        </div>

        <div class="content">

            <div class="row">

                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-header bg-blue">
                            <h5 class="text-white m-b-0">Create New Job</h5>
                        </div>
                        <div class="card-body">

                            <form id="ajaxForm">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Job Location</label>

                                      <select class="form-control" name="job_location">
                                            <option value="">Select Job Location</option>
                                               
                                                    <option value="Outdoor">Outdoor</option>
                                                    <option value="Indoor">Indoor</option>
                                            </select>                                        
                                            </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Repair Order Number</label>

                                            <input class="form-control" name="rep_order_no" id="placeholderInput"  type="text">
                                        </fieldset>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" name="first_name" id="placeholderInput"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Last Name</label>
                                            <input class="form-control" name="last_name" id="placeholderInput"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Address</label>
                                            <textarea class="form-control" id="placeholderInput" name="address"></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Post Code</label>
                                            <input class="form-control" name="pin_code" id="placeholderInput" type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Phone No</label>
                                            <input class="form-control" name="phone" id="placeholderInput"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Bussiness Number</label>
                                            <input class="form-control" name="bus_num" id="placeholderInput"  type="text">
                                        </fieldset>
                                    </div>

                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Faulty Code</label>
                                            <select class="form-control" name="faulty">
                                            <option value="">Select Faulty Code</option>
                                                @foreach($faultys as $faulty)
                                                    <option value="{{ $faulty->faulty_id }}">{{ $faulty-> faulty_description }}</option>
                                               @endforeach
                                            </select>
                                        </fieldset>
                                    </div>


                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <select class="form-control" name="symptom">
                                            <option value="">Select Symptom Code</option>
                                                @foreach($symptoms as $symptom)
                                                    <option value="{{ $symptom->symptom_id }}">{{ $symptom-> symptom_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Resolution Code</label>
                                            <select class="form-control" name="resolution">
                                            <option value="">Select Resolution Code</option>
                                                @foreach($resolutions as $resolution)
                                                    <option value="{{ $resolution->resolution_id }}">{{ $resolution-> resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                

                                </div>
                                <hr>
                                <div class="row">
                                <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label> Status</label>
                                            <select class="form-control" name="asp_location">
                                            <option value="">Assign To</option>
                                                @foreach($warehouse as $stat)
                                                    <option value="{{ $stat->code }}">{{$stat->name}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-12 cenbut">
                                    <input type="hidden" name="type" value="newJob">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Create </button>


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
     <h4 class="modal-title"> Job Created Successfully ....</h4>

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
        $(document).ready(function(){

            /*$('#menu_id').change(function() {
                var optionSelected = $(this).val();
                alert(optionSelected);
                if (optionSelected == 3) {
                    $( ".servicetype" ).removeClass('hidden')
                }
            });*/




            $("#ajaxForm").validate({
                rules: {
                    job_location: {
                        required: true,
                    },rep_order_no: {
                        required: true,
                    },first_name: {
                        required: true,
                    },last_name: {
                        required: true,
                    },address: {
                        required: true,
                    },pincode: {
                        required: true,
                        digits:true,
                    },phone: {
                        required: true,
                        digits:true,
                    },bus_num: {
                        required: true,
                        digits:true,
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
                            }, 1000);

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