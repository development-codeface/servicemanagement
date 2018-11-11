@extends('layouts.admin1')

@section('header')

@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>  ASP Admin Edit</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i>   ASP Admin Edit</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">
              
                <div class="col-lg-12">
                <a href="{{ URL::route('AspAdmin') }}"><span class="btn btn-sm btn-info m-b-2"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>
                    <div class="login-box-body">
                        
                        <form id="ajaxForm">
                            <!-- <div class="form-group has-feedback">
                                <input type="text" name="username"@if(isset($admin)) value="{{ $admin->username }}" @endif  class="form-control " placeholder="UserName">
                            </div> -->
                           

<div class="row">

    <div class="col-lg-6">
    <div class="form-group has-feedback">
                            <label>Email</label>
                                <input type="email"  name="email" @if(isset($admin)) value="{{ $admin->email }}" @endif  class="form-control "  >
                            </div>

    </div>
    <div class="col-lg-6">

 <div class="form-group has-feedback">
                            <label>Password</label>
                                <input type="password" name="password" @if(isset($admin)) value="{{ $admin->password }}" @endif  class="form-control " >
                            </div>

 </div>
 <div class="col-lg-6">
 <div class="form-group has-feedback">
                            <label>WareHouse Id</label>
                                <input type="text" name="warehouse_id" @if(isset($admin)) value="{{ $admin->warehouse_id }}" @endif  class="form-control" readonly>
                            </div>

</div>

<div class="col-lg-6">
<div class="form-group has-feedback">
                            <label>Name</label>
                                <input type="text" name="name" @if(isset($admin)) value="{{ $admin->name}}" @endif  class="form-control "  >
                            </div>
    </div>

<div class="col-lg-6">
<div class="form-group has-feedback">
                            <label>Code</label>
                                <input type="text" name="code" @if(isset($admin)) value="{{ $admin->code }}" @endif  class="form-control "  >
                            </div>
  </div>

<div class="col-lg-6">
<div class="form-group has-feedback">
                            <label>Address</label>
                                <textarea type="text" name="address"  class="form-control ">{{ $admin->address }}</textarea>
                            </div>

  </div>

<div class="col-lg-6">
<div class="form-group has-feedback">
                            <label>Telephone No1</label>
                                <input type="text" name="phone1" @if(isset($admin)) value="{{ $admin->tel_number1 }}" @endif  class="form-control " >
                            </div>

    </div>

<div class="col-lg-6">
<div class="form-group has-feedback">
                            <label>Fax</label>
                                <input type="text" name="phone2" @if(isset($admin)) value="{{ $admin->tel_number2 }}" @endif  class="form-control "  >
                            </div>


    </div>



    </div>

                            
                           
          
                            <div>
                            <div class="mod_fot m-t-2">
        <input type="hidden" name="type" value="newAspAdmin">
                                    @if(isset($admin))
                                        <input type="hidden" name="id" value="{{$admin->id}}">
                                    @endif
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
                       window.location.href="{{URL::route('AspAdmin')}}";
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
