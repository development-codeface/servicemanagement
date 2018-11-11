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
                    <li class="active"><a href="{{ URL::route('Permissions') }}">List</a></li>
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
                            <h3 class="box-title">Permission</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="ajaxForm">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Select List Route</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="permissions_permission_id">
                                            <option value="">Select List Route</option>
                                            @foreach($routes as $routes)
                                                @if(isset($permission))
                                                    <option value="{{ $permission->permission_id }}" @if($permission->permission_id == $routes->permission_id) selected @endif>{{ $permission->permission_name}}</option>
                                                @else
                                                    <option value="{{ $routes->permission_id }}">{{ $routes->permission_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Route Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="permission_name" @if(!empty($permission)) value="{{ $permission->permission_name }}" readonly @endif placeholder="Permission Name" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" name="permission_description" placeholder="Description"> @if(isset($permission)){{ $permission->permission_description }}@endif</textarea>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <input type="hidden" name="type" value="addPermissions">
                                    <input type="hidden" name="permission_slug" value="{{md5(uniqid(rand(), true)) }}">
                                    <input type="hidden" name="permission_id" id="permission_id" @if(!empty($permission)) value="{{$permission->permission_id}}" @endif>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a href="{{ URL::route('Permissions') }}"><button type="button" class="btn btn-default">Cancel</button></a>
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
            if($('#permission_id').val()!=''){
                var permission_id = $('#permission_id').val();
            }

            $("#ajaxForm").validate({
                rules: {
                    permission_name: {
                        required:true,
                        remote: {
                            url: '{{ URL::route("Validation") }}',
                            type: "post",
                            data: {type:'permission',permission_id:permission_id,_token:'{{ csrf_token() }}'},
                        }
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
                                window.location.href = '{{ URL::route("Permissions") }}';
                            }, 1500);
                        }
                    });
                    return false;
                }
            });

        });
    </script>

@endsection
