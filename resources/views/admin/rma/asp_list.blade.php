@extends('layouts.admin2')

@section('header')
 

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
   
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>RMA Requests</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> RMA Requests</li>
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
                                <th>Repair Order No</th>
                                <th>Delivery Date</th>
                                <th>Product</th>                                   
                              
                                <th>Symptom Image</th>
                                <th>Credit Note</th>
                                <th>Amount</th>
                                <th>Exchange Number</th>
                                <!-- <th>Approved/Rejected</th> -->
                                <th>Report</th>
                                <th>Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;?>
                            @foreach($gma as $job)
                            <tr class="strlength" style="text-align:center;" >
                            <td>@if($job->is_approve==0)
                            <a> <span class="label label-success"> <span class=""></span>Pending</a>
                               @elseif($job->is_approve==1)
                               <a> <span class="label label-success"> <span class=""></span>Approved</a>
                               @else
                               <a> <span class="label label-danger"> <span class=""></span>Rejected</a>
                            @endif</td>
                                <td>{{$job->repaire_order_no}}</td>
                                @if($job->delivery_date)<td>{{date('d-m-Y', strtotime($job->delivery_date))}}</td>
                                @else<td></td>
                                @endif <td>{{$job->model}}</td> 

                                @if($job->issue_image)<td style="width:12%;">
                                    
                                <!-- thumbnail image wrapped in a link -->
<a href="#img{{$i}}">
  <img src="{{ url('data/products/'.$job->issue_image) }}" class="thumbnail">
</a>

<!-- lightbox container hidden with CSS -->
<a href="#_" class="lightbox" id="img{{$i}}">
  <img src="{{ url('data/products/'.$job->issue_image) }}">
</a>
@else
                                        <td>No Image</td>
                                        @endif
                                        </td>
                                       
                                        <td>{{$job->credit_note}}</td>
                               
                               <td>{{$job->amount}}</td>
                               <td>{{$job->ex_number}}</td>
                               
                                <!-- @if($job->is_approve == 1)
                                <td>Approved</td>
                                @elseif($job->is_approve == 2)
                                <td>Rejected</td>
                                @else
                                <td>Pending</td>
                                @endif -->
                                @if($job->is_approve == 1)<td> <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateRmaReport',$job->job_id)}}" ><i class="fa fa-file-pdf-o"></i></a></td> 
                                @else<td>Pending</td>
                                @endif
                                <td>{{str_limit($job->reason_for_return,25)}}</td>

                            </tr>
                            <?php $i++;?>
                            @endforeach
                            </tfoot>
                        </table>
                    </div>
                </div></div>
        </div>
        {{$gma->links()}}
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
