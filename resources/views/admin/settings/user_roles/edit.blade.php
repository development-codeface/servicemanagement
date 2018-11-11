@extends('layouts.admin')

@section('header')

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h5>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><a href="{{ URL::route('UserRoles') }}">List</a></li>
                </ol>
            </h5>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">UserRoles</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="ajaxForm">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">User Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="username" @if(isset($user)) value="{{ $user->username }}" @endif Placeholder="User Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" @if(isset($user)) value="{{ $user->email }}" @endif Placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" id="mainpassword"  Placeholder="New Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="c_password"  Placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Select Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="roles_role_id">
                                            <option value="">Select Role</option>
                                            @foreach($roles as $role)
                                                @if(isset($user))
                                                    <option value="{{ $role->role_id }}" @if($role->role_id  == $user->roles_role_id) selected @endif>{{ $role->role_name}}</option>
                                                @else
                                                    <option value="{{ $role->role_id }}">{{ $role->role_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <span id="error"></span>


                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <input type="hidden" name="type" value="addUserRoles">
                                    <input type="hidden" name="id" id="user_id" @if(!empty($user)) value="{{$user->id}}" @endif>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a href="{{ URL::route('UserRoles') }}"><button type="button" class="btn btn-default">Cancel</button></a>
                                    <button type="submit" class="btn btn-info pull-right">Submit</button>

                                </div>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </section>        <!-- /.content -->
    </div>


    <!-- /.content-wrapper -->
@endsection

@section('footer')


    <script>
        $(document).ready(function() {
           if($('#user_id').val()!=''){
               var user = $('#user_id').val();
           }
            $("#ajaxForm").validate({
                rules: {
                    username: {
                        required:true,
                    },email: {
                        remote: {
                            url: '{{ URL::route("Validation") }}',
                            type: "post",
                            data: {type:'email',id:user,_token:'{{ csrf_token() }}'},
                        }
                    },password: {
                        required:true,
                    },c_password: {
                        equalTo: "#mainpassword",
                        required: true,
                    },roles_role_id: {
                        required: true,
                    },
                },

                errorPlacement: function (error, element) {

                    console.log(element.attr('name'));
                    $(error).insertAfter(element);
                },
                submitHandler: function (form) {

                    // do other things for a valid form
                    var formData = $("#ajaxForm").serialize();
                    $("#messageModalBody").html("Credentials sending your email account  ...");
                    $('#messageModal').modal('show');
                    $.ajax({
                        type: 'post',
                        url: '{{ URL::route("AdminPostManage") }}',
                        data: formData,
                        success: function(data){
                            if(data.status == 1){
                                $("#messageModalBody").html("Mail send successfully, you are now being redirected ...");
                                $('#messageModal').modal('show');
                                setInterval(function () {
                                    window.location.href = '{{ URL::route("UserRoles") }}';
                                }, 1500);
                            }else{
                                $('#messageModal').modal('hide');
                                $('#error').html('<p style="color: red">Uploading error..Please try again</p>');
                            }
                        }
                    });
                    return false;
                }
            });

        });
    </script>

@endsection
