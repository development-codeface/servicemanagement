@extends('layouts.admin2')

@section('header')
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
  
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1> Assigned jobs</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Assigned jobs</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="card m-t-3">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped"style="        width: 1682px;">
                            <thead>
                            <tr>

                                <th>Status</th>
                              
                                <th>Job Location</th>
                                <th>Repaire Order No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th> Address</th>
                                <th> Pin Code</th>
                                <th> Phone No</th>
                                <th> Bussiness Number</th>
                                <th> Faulty Code</th>
                                <th> Symptom Code</th>
                                <th> Resolution Code</th>
                                <th>servicetype</th>
                                <th> technician</th>
                                <th> parts_order</th>
                                <th> item</th>

                                <th>item_purchase_date</th>
                                <th>item_serial_number</th>
                                <th>job_date</th>
                                <th>creater</th>
                                <th>product_replacement</th>
                                <th>asp_location</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                            <tr>
                                <td><span class="label label-warning">{{$job->status_code}}-{{$job->status_description}}</span></td>
                               
                                <td>{{$job->job_location}}</td>
                                <td>{{$job->repaire_order_no}}</td>
                                <td>{{$job->firstname}}</td>
                                <td>{{$job->lastname}}</td>
                                <td>{{$job->address}}</td>
                                <td>{{$job->pincode}}</td>
                                <td>{{$job->phone_no}}</td>
                                <td>{{$job->bussiness_number}}</td>
                                <td>{{$job->faulty_description}}</td>
                                <td>{{$job->symptom_description}}</td>
                                <td>{{$job->resolution_description}}</td>
                                <td>{{$job->servicetype}}</td>
                                <td>{{$job->technician}}</td>
                                <td>{{$job->parts_order}}</td>
                                <td>{{$job->item_purchase_date}}</td>
                                <td>{{$job->item_serial_number}}</td>
                                <td>{{$job->job_date}}</td>
                                <td>{{$job->creater}}</td>
                                <td>{{$job->asp_location}}</td>
                                <td>{{$job->product_replacement}}</td>
                                <td>{{$job->product_replacement}}</td>




                                

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
