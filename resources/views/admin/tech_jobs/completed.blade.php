@extends('layouts.admin3')

@section('header')
 

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
 
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Completed Jobs </h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Completed Jobs</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="card m-t-3">
                <div class="card-body">

                    <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                       
                       <thead>
                       <tr>
                      
                       <th>Job date</th>
                      
                           <th>Status</th>
                           <th>Asp Technician</th>
                           <th>Asp Location</th>

                           <th>Job Location</th>
                          <th>Repair Order No</th>
                               
                                <th> Bill To Name</th>
                               
                                <th> Contact Number</th>
                                <th> Complaints/Remarks</th>
                                <th> Symptom Code</th>
                                <th> Resolution Code</th>
                                <th>Change Code Proof</th>
                               
                                
                               
                                <th> Turn Around Time</th>
                                <th> Appointment Date</th>
                                <th> Order Date</th>
                               
                                <th> Item No(Model No)</th>
                                <th> Seriel No</th>
                                <th> Service Item Group</th>
                                <th> Purchase Date</th>
                                <th> Item No(Part No)</th>
                                <th> Description</th>
                                <th> Location</th>
                                <th> Quantity</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($jobs as $job)
                       <tr>
                      <td>{{date('d-m-Y', strtotime($job->job_date))}}</td>
                      
                           <td><span class="label label-success">{{$job->status_code}}-{{$job->status_description}}</span></td>
                           <td>{{$job->email}}</td>
                           <td>{{$job->asp_location}}</td>
                          
                           <td>{{$job->job_location}}</td>
                           <td>{{$job->repaire_order_no}}</td>
                              
                               
                                <td>{{str_limit($job->cu_address,25)}}</td>
                                
                                <td>{{$job->phone_no}}</td>
                                <td>{{$job->remark}}</td>
                                <td>{{$job->symptom_description}}</td>
                                <td>{{$job->resolution_description}}</td>
                                <td>{{$job->change_code}}</td>
                               @if($job->created_at)
								   <?php $d1 = App\Models\Job::where('job_id',$job->job_id)->first();
							        $dat1 = $d1->created_at;
									    $vv = date('d-m-Y', strtotime($dat1));
										
									$d2 = App\Models\Claim::where('job_id',$job->job_id)->first();
									$dat2 = $d2->created_at;
									  $nn =  date('d-m-Y', strtotime($dat2));
									 $formatted_dt1=Carbon::parse($vv);

                                 $formatted_dt2=Carbon::parse($nn);

                          $date_diff=$formatted_dt1->diffInDays($formatted_dt2);
									
									//echo round($diff / (60 * 60 * 24));

									
							   ?>@endif
                                @if($job->created_at)<td>{{$date_diff}} days<td>
								@else
									<td></td>@endif
                               
								  @if($job->appointment_time)
                                <td>{{date('d-m-Y', strtotime($job->appointment_time))}}</td>
							@else<td></td>
							@endif
                                <td>{{date('d-m-Y', strtotime($job->order_date))}}</td>
                               
                                <td>{{$job->product}}</td>
                                <td>{{$job->seriel_number}}</td>
                                <td>{{$job->servicetype}}</td>
                               
								<td></td>
                             <?php $var = App\Models\PartsOrder::leftjoin('jobs','jobs.parts_order','=','parts_order.part_order_id')
                ->leftjoin('muliple_parts','muliple_parts.order_id','=','parts_order.part_order_id')
                ->leftjoin('parts_list','parts_list.part_id','=','muliple_parts.parts')
                ->where('jobs.job_id','=',$job->job_id)
                ->get();?>
                                <td>@foreach($var as $va){{$va->part_no}},@endforeach</td>
								   <td>{{$job->description}}</td>
                                <td></td>
                                <td></td>
                       </tr>
                        @endforeach
</tbody>
</div>    
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
