@extends('layouts.admin1')

@section('header')
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Manage User</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Manage User</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="card m-t-3">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>

                                <th>Action</th>

                                <th>Name</th>
                                <th>Code</th>
                                <th> Address</th>
                                <th> Telphone No1</th>
                                <th> Telphone No2</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $adm)
                            <tr>
                            <td>
                                <a class="btnsedit " data-tooltip="View" href="{{URL::route('ViewWarehouse',$adm->warehouse_id)}}" title="View"><i class="fa fa-eye pad"></i></a>

                                    <a class="btnsedit " data-tooltip="Edit" href="{{URL::route('NewWarehouse',$adm->warehouse_id)}}" title="Edit"><i class=" edi pad fa fa-edit"></i></a>
                                    <a class="btnsecal  deleteButton" data-tooltip="Delete"  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
                                </td>
                                <td>{{$adm->name}}</td>
                                <td>{{$adm->code}}</td>
                                <td>{{$adm->address}}</td>
                                <td>{{$adm->tel_number1}}</td>
                                <td>{{$adm->tel_number2}}</td>

                               

                            </tr>
                            @endforeach

                            </tfoot>
                        </table>
                    </div>
                </div></div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form id="deleteModalForm">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="delete_id" type="hidden" name="delete_id" value="" />
                        <input type="hidden" name="type"   value="delete_asp_admin" />
                        <button class="btn btn-primary" type="submit">Yes</button>
                        <button class="btn btn-default" type="button">Close</button>
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Delete</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure?.</p>
                    </div>
                    <div class="modal-footer" id="modalFooter">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-default" >Yes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('assets/admin/plugins/table-expo/filesaver.min.js')}}"></script>
    <script src="{{ asset('assets/admin/plugins/table-expo/xls.core.min.js')}}"></script>
    <script src="{{ asset('assets/admin/plugins/table-expo/tableexport.js')}}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
    <script>$("table").tableExport({formats: ["xlsx","xls", "csv", "txt"],    });</script>
<script>
        $(document).ready(function(){

            $('.deleteButton').click(function(){

                var user_id = $(this).attr('data-id');
                $('#delete_id').val(user_id);
            });
            $("#deleteModalForm").validate({
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },

                submitHandler: function(form) {

                    // do other things for a valid form
                    var formData = $("#deleteModalForm").serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('PostRemove') }}",
                        data:formData,
                        success: function(data){
                            if(data.status == 1){

                                $('.modal-body').html(' Successfully Deleted');
                                $('#modalFooter').addClass('hidden');
                                setTimeout(function(){
                                    location.reload();
                                },1000);

                            }
                        }
                    });
                    return false;
                }

            });

        });
    </script>
@endsection
