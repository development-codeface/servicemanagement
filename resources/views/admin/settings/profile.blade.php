@extends('layouts.admin')

@section('header')

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Profile
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <!-- /.col -->
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{  asset('assets/admin/images/download.png') }}" alt="User profile picture">


                            <p class="text-muted text-center">Super Admin</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Username</b> <a class="pull-right">{{ Auth::user()->name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="pull-right">{{ Auth::user()->email }}</a>
                                </li>

                            </ul>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">Profile</a></li>
                            <li class=""><a href="#password" data-toggle="tab" aria-expanded="false">Password</a></li>

                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="profile">
                                <form class="form-horizontal" id="profileForm">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">User Name</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="username" class="form-control" value="{{ Auth::user()->name }}"  placeholder="User Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="hidden" name="user_id" value="{{ $userProfile->id }}">
                                            <input type="hidden" name="type" value="AdminUpdateProfile">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane " id="password">
                                <form class="form-horizontal" id="passwordForm">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">New Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" id="mainpassword" name="password" class="form-control"  placeholder="New Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Confirm Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" name="c_password" placeholder="Confirm Password">

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="hidden" name="type" value="AdminUpdatePassword">
                                            <input  type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="modal modal-success fade" id="messageModal">
        <div class="modal-dialog" >
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Loading successfully....</h4>
                </div>
                <div class="modal-body text-center"  >
                    <p id="messageModalBody" ></p>
                    <img src="{{  asset('assets/admin/images/loading.gif') }}"/>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('footer')

    <script>

        $(document).ready(function() {

            $("#profileForm").validate({
                rules: {
                    username: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },

                },
                errorPlacement: function(error, element) {

                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },
                submitHandler: function(form) {


                    // do other things for a valid form
                    var formData = $("#profileForm").serialize();
                    $("#messageModalBody").html("Profile updation submitting...please wait while redirecting!");
                    $('#messageModal').modal('show');
                    $.ajax({
                        type: 'post',
                        url: '{{ URL::route("AdminPostManage") }}',
                        data: formData,
                        success: function(data){
                            $("#messageModalBody").html("Your Profile has been successfully updated, you are now being redirected ...");
                            $('#messageModal').modal('show');
                            setInterval(function () {
                                window.location.href = '{{ URL::route("AdminLogout") }}';
                            }, 1500);

                        }
                    });
                    return false;
                }
            });
            $("#passwordForm").validate({
                rules: {
                    password: {
                        required: true,
                    },
                    c_password: {
                        required: true,
                        equalTo: "#mainpassword",

                    },
                },

                errorPlacement: function(error, element) {

                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },
                submitHandler: function(form) {

                    // do other things for a valid form
                    var formData = $("#passwordForm").serialize();
                    $("#messageModalBody").html("Password updation submitting...please wait while redirecting!");
                    $('#messageModal').modal('show');

                    $.ajax({
                        type: 'post',
                        url: '{{ URL::route("AdminPostManage") }}',
                        data: formData,
                        success: function(data){
                            $("#messageModalBody").html("Your Password has been successfully updated, you are now being redirected ...");
                            $('#messageModal').modal('show');
                            setInterval(function () {
                                window.location.href = '{{ URL::route("AdminLogout") }}';
                            }, 1500);

                        }
                    });

                    return false;
                }
            });

        });


    </script>
@endsection
