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
            <h1>Rma Edit</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Rma Edit</li>
            </ol>
        </div>

        <div class="content">

            <div class="row">

                <div class="col-lg-12">
                <a href="{{ URL::route('RmaAspList') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>
                    <div class="card ">
                    <div class="card-header bg-blue">

<div class="right-page-header">
                            <div class="d-flex">
                                <div class="align-self-center">
                                    <h5 class="text-white m-b-0">Job Id# :{{$job->job_id}}</h5>
                                    <div class="direct-chat-info clearfix"><span class="direct-chat-timestamp pull-left tcol">{{date('d-m-Y', strtotime($job->job_date))}}</span> </div>
                                </div>
                                <div class="st_div">
                                    <span class="label">Status : </span>
                                    <!-- <span class="label label-success">W11 - Completed</span> -->
                                    <span class="label label-warning" style="float: right;">{{$job->status_code}}-{{$job->status_description}}</span>
                                </div>
                            </div>
                        </div>



                             
                        </div>
                        <div class="card-body">

                            <form id="ajaxForm">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Job Location</label>

                                            <input class="form-control" id="placeholderInput" name="job_location" value="{{$job->job_location}}" type="text" readonly>
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
                                            <label>Purchase Date</label>
                                            <input class="form-control" id="purchase_date" name="purchase_date"  value="{{date('d-m-Y', strtotime($job->purchase_date))}}" type="text" readonly>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                        <label>Product</label>
                                        <select class="form-control" name="product">
                                        <option value="{{ $job->product_no }}">{{$job->product_description}}</option>

                                                @foreach($products as $menu)
                                                    <option value="{{ $menu->product_no }}">{{$menu->product_description }}</option>
                                                @endforeach
                                        </select>
                                        </fieldset>
                                        </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Serial Number</label>
                                            <input class="form-control" id="placeholderInput" name="seriel_no" value="{{$job->seriel_no}}"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Warranty Card Number</label>
                                            <input class="form-control" id="placeholderInput" name="warranty_card" value="{{$job->warranty_card}}"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Panel seriel No</label>
                                            <input class="form-control" id="placeholderInput" name="panel_serial_no" value="{{$job->panel_serial_no}}"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Panel Model</label>
                                            <input class="form-control" id="placeholderInput" name="panel_model" value="{{$job->panel_model}}"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Main Dealer Account Number</label>
                                            <input class="form-control" id="placeholderInput" name="dealer_accnt_num" value="{{$job->delear_Account_numner}}"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Complaints</label>
                                            <textarea class="form-control" id="placeholderInput" name="complaint" value=""  type="text">{{$job->complaints}}</textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Remarks</label>
                                            <textarea <input class="form-control" id="placeholderInput" name="reason" value=""  type="text">{{$job->reason_for_return}}</textarea>
                                        </fieldset>
                                    </div>
                                   

                                </div>
                                <hr>
                                <h4 class="sympd">Symptom/Defect</h4>


        <div class="row">
<div class="col-lg-12">
<div class="lft">
           <fieldset class="form-group">
                 <label>Vertical Line &nbsp;</label>
   
                 <input type="checkbox" id="vert_line" name="vert_line"
               value="1"  @if($job->vertical_line == 1) checked=checked @endif />   
               </fieldset>
               </div>
<div class="lft">
           <fieldset class="form-group">
                 <label>Vertical Block&nbsp;</label>
   
                 <input type="checkbox" id="vert_block" name="vert_block"
               value="1"  @if($job->vertical_block == 1) checked=checked @endif />   
               </fieldset>
               </div>
 <div class="lft">
           <fieldset class="form-group">
                 <label>Horizontal Line&nbsp;</label>
   
                 <input type="checkbox" id="hori_line" name="hori_line"
               value="1"  @if($job->hori_line == 1) checked=checked @endif />   
               </fieldset>
               </div>
 <div class="lft">
           <fieldset class="form-group">
                 <label>Horizontal Block&nbsp;</label>
   
                 <input type="checkbox" id="hori_block" name="hori_block"
               value="1"   @if($job->horil_block == 1) checked=checked @endif/>   
               </fieldset>
               </div>
           
               <div class="lft">
           <fieldset class="form-group">
                 <label>No Display&nbsp;</label>
   
                 <input type="checkbox" id="no_disp" name="no_disp"
               value="1"  @if($job->no_display == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Abnormal Colour&nbsp;</label>
   
                 <input type="checkbox" id="abnorm_colour" name="abnorm_colour"
               value="1"  @if($job->abnormal_color == 1) checked=checked @endif />   
               </fieldset>
               </div>



<div class="lft">
           <fieldset class="form-group">
                 <label>Uniformity Defect&nbsp;</label>
   
                 <input type="checkbox" id="unif_defect" name="unif_defect"
               value="1"  @if($job->uniformity_defect == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Dot screen&nbsp;</label>
   
                 <input type="checkbox" id="dot_screen" name="dot_screen"
               value="1"  @if($job->dot_screen == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>White Screen&nbsp;</label>
   
                 <input type="checkbox" id="whit_screen" name="whit_screen"
               value="1"  @if($job->white_screen == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Flicker&nbsp;</label>
   
                 <input type="checkbox" id="flicker" name="flicker"
               value="1"  @if($job->flicker == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Black Light Defect&nbsp;</label>
   
                 <input type="checkbox" id="blck_defct" name="blck_defct"
               value="1"  @if($job->back_light == 1) checked=checked @endif />   
               </fieldset>
               </div>
               <div class="lft">
           <fieldset class="form-group">
                 <label>Abnormal Picture&nbsp;</label>
   
                 <input type="checkbox" id="abnorm_pic" name="abnorm_pic"
               value="1"   @if($job->abnormal_pic == 1) checked=checked @endif/>   
               </fieldset>
               </div>
              
    




</div></div>


<hr>
           <div class="row">
               <div class="col-lg-2">
           <fieldset class="form-group">
                 <label>Others</label>
   
                 <textarea type="text" id="other" name="other"
                /> {{$job->other}}</textarea  
               </fieldset>
               </div>
</div>

                       
                       <hr>
        <div class="row">
        @if($job->amount!=NULL)
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Amount</label>
                                            <input class="form-control"  value="{{$job->amount}}" name="amount"  type="text" >
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Credit Note</label>
                                            <input class="form-control"  value="{{$job->credit_note}}" name="amount"  type="text" >
                                        </fieldset>
                                    </div>
                                    @else
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Exchange Number</label>
                                            <input class="form-control"  value="{{$job->ex_number}}" name="ex_number"  type="text" >
                                        </fieldset>
                                    </div>
                                    @endif
        </div>
                               

                               

                                <div class="col-md-12">
                                    <input type="hidden" name="type" value="editrmaasp">
                                    <input type="hidden" name="job_id" value="{{$job->job_id}}">
                                    <input type="hidden" name="gma_id" value="{{$job->gma_id}}">
                                    <input type="hidden" name="prdct_repl_id" value="{{$job->product_replacement_id}}">
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
        jQuery('#datepicker').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
        jQuery('#datepicker1').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});

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
                    $( "#mod" ).removeClass( "hidden" )
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            setInterval(function(){
                                $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                                $('#myModal').modal('show');
                       window.location.href="{{URL::route('RmaAspList')}}";
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
