@extends('layouts.admin4')

@section('header')
 

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
   
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>GRN Requests</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> GRN Requests</li>
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
                                <th>Job Id</th>
                                <th>Product</th>                                   
                                <th>Reason For Return</th>
                                <th>Symptom Image</th>
                                <th>Credit Note</th>
                              
                                  <th>Collects From</th>
                                  <th>Send To </th>
                                <th>Faulty Set Collection Order</th>
                                <th>Delivery Order</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;?>
                            @foreach($gma as $job)
                            <tr class="strlength" >
                            <td>
                            @if($job->status != 102)
                                    <!-- <button class="deliver" data-id="{{$job->job_id}}"><span class="label label-info"> Deliver</span></butt> -->
                                    <button  type="button" data-id="{{$job->job_id}}"  class="btn btn-success deliver">Deliver</button>
                                    @else
                                    <button  type="button" data-id="{{$job->job_id}}"  class="btn btn-info">Delivered</button>

                         @endif
                                    <!-- <a class="btnact" href="job-Approval.html" title="block"><i class=" edi pad fa fa-ban"></i></a> -->
                                    <!-- <a class="btnsecal" href="job-del.html" title="del"><i class="fa fa-trash pad"></i></a> -->
                                </td>
                                <td>{{$job->job_id}}</td>
                                <td>{{$job->product_id}}</td>
                                <td>{{$job->reason_for_retrun}}</td>
                                @if($job->issue_image)<td style="width:12%;">
                                    
                                    <!-- thumbnail image wrapped in a link -->
    <a href="#img{{$i}}">
      <img src="{{ url('data/products/'.$job->issue_image) }}" class="thumbnail">
    </a>
    
    <!-- lightbox container hidden with CSS -->
    <a href="#_" class="lightbox" id="img{{$i}}1">
      <img src="{{ url('data/products/'.$job->issue_image) }}">
    </a>
                                     
                                            </td> @else
                                            <td>No Image</td>
                                            @endif
                                <td>{{$job->credit_note}}</td>
                               
                                <td>{{$job->cu_address}}</td>
                                <td>{{$job->name}}</td>
                                @if($job->is_approve == 1)
                                <td> <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateFaultyReport',$job->job_id)}}" ><i class="fa fa-file-pdf-o"></i></a></td> 
                                @else<td>Pending</td>
                                @endif
                                @if($job->status == 61)
                                <td> <a class="btnsedit js-mytooltip"  data-tooltip="Generate Pdf" href="{{URL::route('GenerateDeliveryReport',$job->job_id)}}" ><i class="fa fa-file-pdf-o"></i></a></td>
                                @else
                                <td>Pending</td>
                                @endif
                            </tr>
                            <?php $i++;?>
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
            $('.deliver').click(function(){
               
               var job_id = $(this).attr('data-id');
               var type = 'Changedelivery_grn';
       
          var type = 'Changedelivery_grn';

                               $.ajax({

                                   type:'post',

                                   url:"{{ URL::route('postData') }}",

                                   data:{status:status,job_id:job_id,_token: '{{ csrf_token() }}',type:type},

                                   success:function(data){

                                       if(data.status==1){

                                            $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                                                $('#myModal').modal('show');
                                                location.reload();
                                       }

                                   }

                               });
})
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
