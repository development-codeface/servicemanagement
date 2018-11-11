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
                                            <label>Job Id</label>

                                            <input class="form-control" id="placeholderInput" name="job_id" value="{{$job->job_id}}" type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Repaire Order No</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->repaire_order_no}}" type="text">

                                        </fieldset>
                                    </div>
                                </div>
                                <hr>


                                <div class="row">
                                    
                                <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	claim Amount</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->claim_amount}}" name="amount"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Mileage</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->mileage}}" name="mileage"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>	Mileage</label>
                                            <input class="form-control" id="placeholderInput" value="{{$job->labour}}" name="labour"  type="text">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Approve/Reject</label>
                                            <select class="form-control reject" name="approve">
                                            <option value="">Approve/Reject</option>
                                                    <option value="1">Approve</option>
                                                    <option value="2">Reject</option>
                                            </select>                                       
                                             </fieldset>
                                    </div>
                                   

                                </div>

                                <div class="col-md-12">
                                    <input type="hidden" name="type" value="editclaim">
                                    <input type="hidden" name="job_id" value="{{$job->job_id}}">
                                    <input type="hidden" name="claim_id" value="{{$job->claim_id}}">
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
                    $( "#mod" ).removeClass( "hidden" )
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            setInterval(function(){
                                $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                                $('#myModal').modal('show');
                       window.location.href="{{URL::route('PartsOrder')}}";
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
