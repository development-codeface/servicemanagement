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
                    <li><a href="{{ URL::route('Roles') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Roles</li>
                </ol>
            </h5>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><a href="{{ URL::route('CreateRole') }}"  class="btn btn-info">Create New </a></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="sorting" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Role Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i =1 ?>
                            @foreach($roles as $role)

                                <tr id="tr_{{ $role->role_id }}">
                                    <td>{{ $i}}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td>{{ $role->role_description }}</td>

                                    <td>
                                        <span class="tools">
                                            <a  class="btn btn-default btn-xs " href="{{ URL::route("CreateRole", $role->role_slug ) }}"><i class="fa fa-pencil"></i></a>
                                            <a  class="btn btn-default btn-xs deleteButton" href="#" id="{{ $role->role_id   }}"><i class="fa fa-trash-o"></i></a>
                                        </span>
                                    </td>

                                </tr>
                                <?php $i ++; ?>
                            @endforeach
                                </tbody>
                                <tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

@section('footer')
    <script>

        $(document).ready(function() {

            // Delete Form

            $('body').on('click', '.deleteButton', function() {
                $("#delete_id").val($(this).attr('id'));
                $("#type").val('deleteRole');
                $('#deleteModal').modal('show');


                $("#deleteForm").validate({

                    submitHandler: function (form) {
                        // do other things for a valid form
                        var formData = $("#deleteForm").serialize();
                        //RemoveUsers
                        var id =$("#delete_id").val();
                        var row = "#tr_"+id;
                        $.ajax({
                            type: 'post',
                            url: '{{ URL::route("AdminPostManage") }}',
                            data: formData,
                            success: function(data){
                                $('#deleteModal').modal('hide');
                                $(row).animate({'backgroundColor':'#fb6c6c'},300);
                                $(row).fadeOut("slow");
                            }
                        });
                        return false;
                    }
                });
            });


        });



    </script>
@endsection
