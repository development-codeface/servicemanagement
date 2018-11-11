@extends('layouts.admin3')

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
                <a href="{{ URL::route('GmaAspList') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
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
                                            <label>Repair Order No</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->repaire_order_no}}" type="text" readonly>

                                        </fieldset>
                                    </div>
                                </div>
                                <hr>

                                 <div class="row">
                                <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Symptom Code</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->symptom_description}}" type="text" readonly>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Resolution Code</label>
                                            <input class="form-control" id="placeholderInput" value=" {{$job->resolution_description}}"  type="text" readonly>
                                        </fieldset>
                                    </div>
                                   
                                   
                                    
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Faulty Code</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->faulty_description}}"  type="text" readonly>
                                        </fieldset>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">


                
                <div class="col-lg-4">
                   <fieldset class="form-group">
                   <label>Model</label>
                   <select class="form-control" name="product">
                   @if(isset($job))
                   <option value="{{ $job->product_no }}">{{$job->product_description }}</option>
                   @endif

                           @foreach($products as $menu)
                               <option value="{{ $menu->product_no }}">{{$menu->product_description }}</option>
                           @endforeach
                   </select>
                   </fieldset>
                </div>
                                   
                                   
                                    
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Reason For Return</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->reason_for_retrun}}" name="reason"  type="text" >
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Serial Number</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->seriel_no}}" name="seriel_no" type="text" >
                                        </fieldset>
                                    </div>

                                </div>
                                <hr>









<div class="row">


 
 <div class="col-lg-6">

<fieldset class="form-group">
    <label>	Technical problem-Attach proof of purchase & Tech forum</label>
    <input type="checkbox" class="chcgrn" id="scales1" name="tech_proof" value="1"
   @if($job->tech_prob == 1) checked=checked @endif  />     </fieldset>





<fieldset class="form-group">
    <label>Dented /Damaged Transit</label>
    <input type="checkbox" class="chcgrn" id="scales1" name="dented" value="1"
    @if($job->dented == 1) checked=checked @endif   />     </fieldset>


<fieldset class="form-group">
    <label>	Photography Of Tss Do,or shipping label</label>
    <input type="checkbox" class="chcgrn" id="scales1" name="photo" value="1"
    @if($job->photogr == 1) checked=checked @endif  />     </fieldset>


<fieldset class="form-group">
    <label>Complete Return Of Acc/WTY card/Manual</label>
    <input type="checkbox" class="chcgrn" id="scales1" name="ret_acc" value="1"
    @if($job->return_acc == 1) checked=checked @endif   />     </fieldset>
    </div>
<div class="col-lg-4">
                                    <fieldset class="form-group">
                                        <label>	Spare Part Number</label>
                                        <input class="form-control"  value="{{$job->spare_part_no}}" name="spare_part_no"  type="text" >
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
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Purchase Date</label>
                                            <input class="form-control"  value="{{date('d-m-Y', strtotime($job->purchase_date))}}" id="purchase_date"  name="purchase_date"  type="text" >
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Goods Receive Date</label>
                                            <input class="form-control"  value="{{date('d-m-Y', strtotime($job->goods_date))}}" id="goods_date"  name="goods_date"  type="text" >
                                        </fieldset>
                                    </div>
                                    </div>
                                <hr>

                               

                               

                                <div class="col-md-12">
                                    <input type="hidden" name="type" value="editgrnasp">
                                    <input type="hidden" name="job_id" value="{{$job->job_id}}">
                                    <input type="hidden" name="grn_id" value="{{$job->grn_id}}">
                                    <input type="hidden" name="prdct_repl_id" value="{{$job->product_replacement_id}}">
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
       jQuery('#datepicker').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
        jQuery('#datepicker1').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
jQuery('#purchase_date').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
   jQuery('#goods_date').datetimepicker({
                format: 'd-m-Y',
                minDate:new Date()
});
   jQuery('#purchase_date1').datetimepicker({
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
                       window.location.href="{{URL::route('GmaTechList')}}";
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
