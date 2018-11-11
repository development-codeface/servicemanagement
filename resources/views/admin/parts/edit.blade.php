@extends('layouts.admin1')

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
            <h1>Parts Order Edit</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Parts Order Edit</li>
            </ol>
        </div>

        <div class="content">

            <div class="row">

                <div class="col-lg-12">
                <a href="{{ URL::route('Jobs') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>
                    <div class="card ">
                        <div class="card-header bg-blue">
                            <h5 class="text-white m-b-0">Parts Order Edit</h5>
                        </div>
                        <div class="card-body">

                            <form id="ajaxForm">
                            @if($job->job_id)
                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Job Location</label>

                                            <input class="form-control" id="placeholderInput" name="job_location" value="{{$job->job_location}}" type="text" readonly>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Repair Order No</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->repaire_order_no}}" type="text" readonly>

                                        </fieldset>
                                    </div>
                                </div>
                                <hr>
                                @endif
                                @if($job->job_id)
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
                                            <label>	Bill To Name </label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->cu_address}}"  type="text" readonly>
                                        </fieldset>
                                    </div>
                                    <!-- <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Pin Code</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->pincode}}" type="text" readonly>
                                        </fieldset>
                                    </div> -->
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Phone No/Bussiness Number</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->phone_no}}"  type="text" readonly>
                                        </fieldset>
                                    </div>
                                   
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Order Date</label>
                                            <input class="form-control" id="datepicker" value="{{$job->order_date}}"  name="order_date"  type="text" readonly>
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
                                            <select class="form-control" name="symptom" >
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
                                            <select class="form-control" name="resolution" >
                                            @if(isset($admin))
                                                    <option value="{{ $admin->resolution_id }}">{{ $admin->resolution_description }}</option>
                                                @endif
                                                @foreach($resolutions as $menu)
                                                    <option value="{{ $menu->resolution_id }}">{{$menu->resolution_description }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    </div>
                                    <hr>
                                    @endif
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
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-lg-4" >
                                        <fieldset class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control disable" name="remark">{{$job->remark}}</textarea>                                      
                                             </fieldset>
                                    </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Approve/Reject</label><br>
                                            <input type="radio" name="reject" value="1" > Approve &nbsp; 
                                             <input type="radio" name="reject" value="2"> Reject<br>                                   
                                             </fieldset>
                                    </div>
                                    <div class="col-lg-4 appr hidden">
                                        <fieldset class="form-group">
                                            <label>	Delivery Date</label>
                                            @if($job->delivery_date)
                                            <input class="form-control" id="datepicker1" value="{{date('d-m-Y', strtotime($job->delivery_date))}}" name="del_date"  type="text" required>
                                            @else
                                            <input class="form-control" id="datepicker1" value="" name="del_date"  type="text"required >
                                          @endif
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4 rej hidden" >
                                        <fieldset class="form-group">
                                            <label>Rejected Remarks</label>
                                            <textarea class="form-control disable" name="note" ></textarea>                                      
                                             </fieldset>
                                    </div>

                                </div>
                                </div>

                                <div class="col-md-12">
                                    <input type="hidden" name="type" value="editpartsOrder">
                                    <input type="hidden" name="job_id" value="{{$job->job_id}}">
                                    <input type="hidden" name="part_id" value="{{$job->part_order_id}}">
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
    <div class="loading style-2 hidden" id="mod">
    <div class="loading-wheel "></div></div>
@endsection

@section('footer')

    <script>
     jQuery('#datepicker1').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
 
});

        $(document).ready(function(){


           $('input:radio').change(function() {      
        var rej = $("input[name='reject']:checked").val();   
        if(rej == 2){
                
            $( ".rej" ).removeClass('hidden')
            $( ".appr" ).addClass('hidden')
            }
            if(rej == 1){
            
            $( ".appr" ).removeClass('hidden')
            $( ".rej" ).addClass('hidden')

            }

    });

//             $( ".reject" ).change(function() {
            
//              var rej= this.value;
//              if(rej == 2){
                
//                 $( ".rej" ).removeClass('hidden')
//              }
//              if(rej == 1){
                
//                 $( ".appr" ).removeClass('hidden')
//              }
// });

// $('.reject').on('change', function() {
//     var crd =this.value;
//     if(crd==1)
//     {
//         $(".appr").show();
//         $(".rej").hide();
//     }else{
//         $(".rej").show();
//         $(".appr").hide();
//     }

// }) 
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
                    $( "#mod" ).removeClass( "hidden" )
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
