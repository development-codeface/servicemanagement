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
            <h1>Claim Edit</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Claim Edit</li>
            </ol>
        </div>

        <div class="content">

            <div class="row">

                <div class="col-lg-12">
                <a href="{{ URL::route('AdminClaims') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>
                    <div class="card ">
                        <div class="card-header bg-blue">
                            <h5 class="text-white m-b-0">Claim Edit</h5>
                        </div>
                        <div class="card-body">

                            <form id="ajaxForm">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Job Id</label>

                                            <input class="form-control" id="placeholderInput" name="job_id" value="{{$job->job_id}}" type="text" readonly>
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
              <label>Mileage</label>
              <input class="form-control" value="{{$job->mileage}}"  name="mileage" id="mileage"  type="text">

              <!-- <select class="form-control mileage" name="mileage" id="mileage">
            
            
            @if(isset($job))
            <option value="{{$job->mil_id}}">{{$job->min_mil}}-{{$job->max_mil}}</option>
            @endif
                      @foreach($milaeges as $mil)
                  <option value="{{$mil->mil_id}}">{{$mil->min_mil}}- {{$mil->max_mil}}</option>
                  @endforeach
                </select>              -->
                 
            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Claim Amount</label>
              @if(isset($job))
              <input class="form-control" value="{{$job->claim_amount}}"  name="amount" id="amount"  type="text">
              @else
              <input class="form-control"  name="amount" id="claim_amount"  type="text">
             @endif
            </fieldset>
            </div>
            <div class="col-lg-4">
        <fieldset class="form-group">
              <label>Labour</label>
              @if(isset($job))
              <input class="form-control" value="{{$job->labour}}"  name="labour" id="labour"  type="text">
              @else
              <input class="form-control"  name="labour" id="labour"  type="text">
             @endif
            </fieldset>
            </div>
          
            <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label>Approve/Reject</label>
                                            <select class="form-control reject" name="approve">
                                            @if($job->isapprove==1)
                                            <option value="{{$job->isapprove}}">Approved</option>
                                             @elseif($job->isapprove==2)
                                             <option value="{{$job->isapprove}}">Rejected</option>
                                             @else
                                            <option value="">Approve/Reject</option>
                                            
                                                    <option value="1">Approve</option>
                                                    <option value="2">Reject</option>
                                                    @endif
                                            </select>                                       
                                             </fieldset>
                                             
                                    </div>         
                                    <div class="col-lg-4">
                                      
                                        <fieldset class="form-group rej hidden">
                                            <label>Remarks</label>
                                            <textarea class="form-control disable" name="remark" ></textarea>                                      
                                             </fieldset>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <input type="hidden" name="type" value="editclaim">
                                    <input type="hidden" name="job_id" value="{{$job->job_id}}">
                                    <input type="hidden" name="claim_id" value="{{$job->claim_id}}">
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
        jQuery('#datepicker').datetimepicker();
        jQuery('#datepicker1').datetimepicker();

        $(document).ready(function(){
            $( ".reject" ).change(function() {
             var rej= this.value;
             if(rej == 0){
                $(".select-pane").show();
             }
             if(rej == 2){
               
               $( ".rej" ).show();
               $( ".appr" ).hide();
            }
            if(rej == 1){
               
              
               $( ".rej" ).hide();
            }
});
$('.mileage').on('change', function() {
        var status =this.value;
        var token = "{{ csrf_token() }}";
     var type = 'claim_amount';
         $.ajax({
             type: 'post',
             url: '{{ URL::route("postData") }}',
             data: { type:type,status:status,_token:token},
             success: function(data){
                 if(data.status==1){
                 console.log(data);
                     $("#claim_amount").val(data.data.mil.mil_amount);
                    
                 }

             }
         });
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
                       window.location.href="{{URL::route('Jobs')}}";
                            }, 3000);

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
