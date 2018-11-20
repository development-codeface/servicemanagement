@extends('layouts.admin1')

@section('header')
 

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
   
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Parts  Without Job</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Parts  Without Job</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="card m-t-3">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped"style="">
                            <thead>
                            <tr style="text-align:center;">
                           
                            <th>Action</th>
                            
                               
                                <th>Order Date</th>
                                <th>Asp Code</th>
                               
                                <th>Approved/Rejected</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parts as $job)
                            <tr class="strlength" style="text-align:center;">
                            <td>
                           
                            <a class="btnsedit " href="{{URL::route('ViewPartsOrder',$job->part_order_id)}}" title="view"><i class="fa fa-eye pad"></i></a>
                            @if($job->isapprove==0)
                            <a class="btnview js-mytooltip"  href="{{URL::route('EditPartsOrderWojob',$job->part_order_id)}}"> <span class="label label-info"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Approve/Reject</span></a>
                               @elseif($job->isapprove==1)
                               <a> <span class="label label-success"> <span class=""></span>Approved</a>
                               @else
                               <a> <span class="label label-danger"> <span class=""></span>Rejected</a>
                            @endif
                                    <!-- <a class="btnsedit " href="{{URL::route('EditPartsOrder',$job->part_order_id)}}" title="Edit"><i class=" edi pad fa fa-edit"></i></a> -->
                                    <!-- <a class="btnact" href="job-Approval.html" title="block"><i class=" edi pad fa fa-ban"></i></a> -->
                                    <!-- <a class="btnsecal" href="job-del.html" title="del"><i class="fa fa-trash pad"></i></a> -->
                                </td>
                                
                               
                                @if($job->order_date)<td>{{date('d-m-Y', strtotime($job->order_date))}}</td>@else <td></td>@endif
                                <td>{{$job->name}}</td>
                              
                                @if($job->isapprove == 1)
                                <td>Approved</td>
                                @elseif($job->isapprove == 2)
                                <td>Rejected</td>
                                @else
                                <td>Pending</td>
                                @endif
                              


                               

                            </tr>
                            @endforeach
                            </tfoot>
                        </table>
                    </div>
                </div>
                </div>
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
