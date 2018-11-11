@extends('layouts.admin1')

@section('header')

@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Create WareHouse</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Create WareHouse</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="login-box-body">
                        <h3 class="login-box-msg">Create WareHouse</h3>
                        <form id="ajaxForm">
                            <!-- <div class="form-group has-feedback">
                                <input type="text" name="username"@if(isset($admin)) value="{{ $admin->username }}" @endif  class="form-control sty1" placeholder="UserName">
                            </div> -->
                           
                            <div class="form-group has-feedback">
                                <input type="text" name="warehouse" @if(isset($admin)) value="{{ $admin->warehouse }}" @endif  class="form-control sty1" placeholder="Warehouse Id">
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" name="name" @if(isset($admin)) value="{{ $admin->name }}" @endif  class="form-control sty1" placeholder="Name">
                            </div>
                            
                            <div class="form-group has-feedback">
                                <input type="text" name="code" @if(isset($admin)) value="{{ $admin->code }}" @endif  class="form-control sty1" placeholder="Code">
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" name="address" @if(isset($admin)) value="{{ $admin->address }}" @endif  class="form-control sty1" placeholder="Address">
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" name="phone1" @if(isset($admin)) value="{{ $admin->tel_number1 }}" @endif  class="form-control sty1" placeholder="Tel Phone1">
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" name="phone2" @if(isset($admin)) value="{{ $admin->tel_number2 }}" @endif  class="form-control sty1" placeholder="Tel Phone2">
                            </div>
                            <div>

                                <!-- /.col -->
                                <div class="col-xs-4 m-t-4">
                                    <input type="hidden" name="type" value="newWarehouse">
                                    @if(isset($admin))
                                        <input type="hidden" name="id" value="{{$admin->warehouse_id}}">
                                    @endif
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Create </button>
                                </div>
                                <!-- /.col -->
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
