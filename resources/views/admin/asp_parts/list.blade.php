@extends('layouts.admin2')

@section('header')
 

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
   
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>All Requests</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> All Requests</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="card m-t-3">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped"style="">
                            <thead>
                            <tr>
                           
                            <th>Action</th>
                               
                                <th>Approved/Rejected</th>
                                <th>Job Id</th>
                                <th>Order Date</th>
                                <th>Order Id</th>
                                <th>ASP Name</th>
                               
                              
                               
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parts as $job)
                            <tr class="strlength" style="text-align:center;" >
                            <td>
                                    <a class="btnview " href="{{URL::route('ViewAspPartsOrder',$job->part_order_id)}}" title="view"><i class="fa fa-eye pad"></i></a>
                                    <!-- <a class="btnsedit " href="{{URL::route('AspEditPartsOrder',$job->part_order_id)}}" title="Edit"><i class=" edi pad fa fa-edit"></i></a> -->
                                    <!-- <a class="btnact" href="job-Approval.html" title="block"><i class=" edi pad fa fa-ban"></i></a> -->
                                    <!-- <a class="btnsecal" href="job-del.html" title="del"><i class="fa fa-trash pad"></i></a> -->
                                </td>
                                @if($job->isapprove == 1)
                                <td>Approved</td>
                                @elseif($job->isapprove == 2)
                                <td>Rejected</td>
                                @else
                                <td>Pending</td>
                                @endif
                                <td>{{$job->job_id}}</td>
                               
                                @if($job->order_date)<td>{{date('d-m-Y', strtotime($job->order_date))}}</td>@else<td></td>@endif
                                <td>{{$job->part_order_id}}</td>
                               
                                <td>{{$job->name}}</td>
                              
                            </tr>
                            @endforeach
                            </tfoot>
                        </table>
                    </div>
                </div></div>
        </div>
        {{$parts->links()}}
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
    <script>
        $("table").tableExport({formats: ["xlsx","xls", "csv", "txt"],    });
    </script>
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
