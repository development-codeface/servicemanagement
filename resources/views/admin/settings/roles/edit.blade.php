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
                    <li class="active"><a href="{{ URL::route('Roles') }}">List</a></li>
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
                            <h3 class="box-title">Roles</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="ajaxForm">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Role Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="role_name" @if(isset($role)) value="{{ $role->role_name }}" @endif placeholder="Roles Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" name="role_description" placeholder="Description"> @if(isset($role)){{ $role->role_description }}@endif</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Permission Routes</label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <input type="checkbox" id="ckbCheckAll" />
                                            <label for="ckbCheckAll">Select All</label>
                                            @foreach ($permissions as $permission)
                                                <?php
                                                    if(isset($role)){
                                                        $RoleBasedPermission =DB::table('role_has_permissions')->where('roles_role_id' , $role->role_id)->where('permissions_permission_id' , $permission->permission_id)->first();
                                                    }
                                                ?>
                                                @if(!empty($permission->permission_route_id))
                                                    <div class="checkbox">

                                                            <input type="checkbox" name="permissions_permission_id[]" @if(isset($RoleBasedPermission)) checked @endif value="{{ $permission->permission_id }}" class="checkBoxes">
                                                        <label>{{ $permission->permission_name }}</label>

                                                    </div>
                                                @else
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="permissions_permission_id[]" @if(isset($RoleBasedPermission)) checked @endif value="{{ $permission->permission_id }}" class="checkBoxes">
                                                        {{ $permission->permission_name }}
                                                    </div>

                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <input type="hidden" name="type" value="addRoles">
                                    <input type="hidden" name="role_slug" value="{{md5(uniqid(rand(), true)) }}">
                                    <input type="hidden" name="role_id" id="role_id" @if(!empty($role)) value="{{$role->role_id}}" @endif>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a href="{{ URL::route('Roles') }}"><button type="button" class="btn btn-default">Cancel</button></a>
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

            $("#ckbCheckAll").on("change", function () {
                if ($(this).prop("checked")) {
                    $(".checkBoxes").prop("checked", true);
                }else {
                    $(".checkBoxes").prop("checked", false);

                }
            });

            if($('#role_id').val()!=''){
                var role_id = $('#role_id').val();
            }
            $("#ajaxForm").validate({
                rules: {
                    role_name: {
                        required:true,
                        remote: {
                            url: '{{ URL::route("Validation") }}',
                            type: "post",
                            data: {type:'userRole',role_id:role_id,_token:'{{ csrf_token() }}'},
                        },
                    },'permissions_permission_id[]': {
                        required:true,
                    }
                },

                errorPlacement: function (error, element) {

                    console.log(element.attr('name'));
                    $(error).insertAfter(element);
                },
                submitHandler: function (form) {

                    // do other things for a valid form
                    var formData = $("#ajaxForm").serialize();
                    $("#messageModalBody").html("Your formhas been successfully submitting...");
                    $('#messageModal').modal('show');
                    $.ajax({
                        type: 'post',
                        url: '{{ URL::route("AdminPostManage") }}',
                        data: formData,
                        success: function(data){
                            $("#messageModalBody").html("Your form has been successfully submited, you are now being redirected ...");
                            $('#messageModal').modal('show');
                            setInterval(function () {
                                window.location.href = '{{ URL::route("Roles") }}';
                            }, 1500);
                        }
                    });
                    return false;
                }
            });

        });
    </script>

@endsection
