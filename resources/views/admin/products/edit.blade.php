@extends('layouts.admin1')

@section('header')

@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>  Product Edit</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i>    Product Edit</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">
              
                <div class="col-lg-12">
                <a href="{{ URL::route('Products') }}"><span class="btn btn-sm btn-info m-b-2"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>
                    <div class="login-box-body">
                        
                        <form id="ajaxForm">
                            <!-- <div class="form-group has-feedback">
                                <input type="text" name="username"@if(isset($admin)) value="{{ $admin->username }}" @endif  class="form-control " placeholder="UserName">
                            </div> -->
                           

<div class="row">

    <div class="col-lg-6">
    <div class="form-group has-feedback">
                            <label>Product No</label>
                                <input type="text"  name="prod_no" @if(isset($parts)) value="{{ $parts->product_no }}" @endif  class="form-control " readonly >
                            </div>

    </div>
    <div class="col-lg-6">

 <div class="form-group has-feedback">
                            <label>Sbu Code
</label>
                                <input type="text" name="sbu_code" @if(isset($parts)) value="{{ $parts->sub_code }}" @endif  class="form-control " >
                            </div>

 </div>
 <div class="col-lg-6">
 <div class="form-group has-feedback">
                            <label>Bu Code
</label>
                                <input type="text" name="bu_code" @if(isset($parts)) value="{{ $parts->bu_code }}" @endif  class="form-control" >
                            </div>

</div>

<div class="col-lg-6">
<div class="form-group has-feedback">
                            <label>Description
</label>
                                <input type="text" name="prod_descr" @if(isset($parts)) value="{{ $parts->product_description}}" @endif  class="form-control "  >
                            </div>
    </div>

<div class="col-lg-6">
<div class="form-group has-feedback">
                            <label>Service Item Group

</label>
                                <input type="text" name="prod_item" @if(isset($parts)) value="{{ $parts->service_item_group }}" @endif  class="form-control "  >
                            </div>
  </div>

<div class="col-lg-6">
<div class="form-group has-feedback">
<label>Product Type

</label>
                                <input type="text" name="prod_typ" @if(isset($parts)) value="{{ $parts->product_type }}" @endif  class="form-control "  >
                            </div>

  </div>







    </div>

                            
                           
          
                            <div>
                            <div class="mod_fot m-t-2">
        <input type="hidden" name="type" value="editProduct">
                                 
                                        <input type="hidden" name="product_no" value="{{$parts->product_no}}">
                                  
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-lg btn-success">  Confirm</button>
        </div>
                             
                            </div>
                        </form>


                    </div>
                    <!-- /.login-box-body -->
                </div> <div class="col-lg-3"></div>
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /.content -->
    </div>
    <div class="loading style-2 hidden" id="mod">
    <div class="loading-wheel "></div></div>
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
                    email: {
                        required: true,
                       
                    },password: {
                        required: true,
                    },username: {
                        required: true,
                    },warehouse_id: {
                        required: true,
                    },role: {
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
                       window.location.href="{{URL::route('Products')}}";
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
