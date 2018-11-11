@extends('layouts.admin1')

@section('header')
 

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
   
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Spare Parts Setup</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Spare Parts Setup </li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
        <button type="button" class="btn btn-success m-r-1" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus-circle"></i> Create New</button>
       
        
        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Spare Part</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="ajaxForm">
                            <!-- <div class="form-group has-feedback">
                                <input type="text" name="username"@if(isset($admin)) value="{{ $admin->username }}" @endif  class="form-control " placeholder="UserName">
                            </div> -->
                           
<div class="row">
<div class="col-md-6">
<div class="form-group has-feedback">
                            <label>Part No</label>
                                <input type="text" name="part_no"   class="form-control" required>
                            </div>
    </div>

    <div class="col-md-6">
    <div class="form-group has-feedback">
                            <label>Description</label>
                                <input type="text" name="descr"   class="form-control" required >
                            </div>
</div>
<div class="col-md-6"><div class="form-group has-feedback">
                            <label>Last KIT Bom Used</label>
                                <input type="text" name="kit_bom"   class="form-control " required >
                            </div></div>

     
    <div class="col-md-6">
    <div class="form-group has-feedback">
                            <label>Dealer Price</label>
                                <input type="text" name="delaer_price"   class="form-control " required>
                            </div>
          </div>                  
                            
          <div class="col-md-6">
          <div class="form-group has-feedback">
                            <label>Customer Price</label>
                                <input type="text" name="cus_price"  class="form-control "  required>
                            </div> 
          

          </div>
          
          <div class="col-md-6">

<div class="form-group has-feedback">
                            <label>TASS Price</label>
                                <input type="text" name="tass_price" class="form-control " required >
                            </div>
 </div>
 <div class="col-md-6">
 <div class="form-group has-feedback">
                            <label>Available Qty</label>
                                <input type="text" name="avl_qty" class="form-control " required>
                            </div>
</div>


                            
          </div>                   
                            
                            
                    
                            <div>
                            <span id="error"></span>
                              <div class="mod_fot m-t-2">
        <input type="hidden" name="type" value="newPartsCreate">
                                   
                                       
                                  
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-lg btn-success btn_sub">  Confirm</button>
        </div>  
                            </div>
                        </form>
        </div>
        
      </div>
    </div>
  </div>
            <div class="card m-t-3">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped"style="">
                            <thead>
                            <tr>
                           
                            <th>Action</th>
                                <th>Part No</th>
                                <th>Description</th>
                                <th>Last KIT Bom Used</th>
                                <th>Dealer Price</th>
                                <th>Customer Price</th>
                                <th>TASS Price</th>
                                <th>Available Qty</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parts as $job)
                            <tr class="strlength" >
                            <td>
                             <a class="btnsedit " href="{{URL::route('ViewPart',$job->part_id)}}" title="View"><i class="fa fa-eye pad"></i></a>


                                    <a class="btnsedit " href="{{URL::route('EditPart',$job->part_id)}}" title="Edit"><i class=" edi pad fa fa-edit"></i></a>
                                    <a class="btnsecal  deleteButton" data-tooltip="Delete" data-id="{{$job->part_id}}"  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>

                                    <!-- <a class="btnact" href="job-Approval.html" title="block"><i class=" edi pad fa fa-ban"></i></a> -->
                                    <!-- <a class="btnsecal" href="job-del.html" title="del"><i class="fa fa-trash pad"></i></a> -->
                                </td>
                                <td>{{$job->part_no}}</td>
                                <td>{{$job->parts_description}}</td>
                                <td>{{$job->last_kit_bom_used}}</td>
                                <td>{{$job->dealer_price}}</td>
                                <td>{{$job->customer_price}}</td>
                                <td>{{$job->TASS_price}}</td>
                                <td>{{$job->avl_qty}}</td>
                               

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
                        <input type="hidden" name="type"   value="delete_part" />
                         
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">

                <div class="modal-header">
              <h5 class="modal-title">Delete Spare Part</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    
                    <div class="modal-body">
                        <p>Are you sure Delete Spare Part?</p>
                    </div>
                    <div class="m-b-2" id="modalFooter">
                        
                       <p class="text-center">
                        <button type="button" class="btn btn-danger m-r-1" data-dismiss="modal">No</button>

                        <button type="submit" class="btn btn-success" >Yes</button>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="loading style-2 hidden" id="mod">
    <div class="loading-wheel "></div></div>
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
          
            $("#ajaxForm").validate({
                rules: {
                    email: {
                        required: true,
                       
                        }
                    
                },
                password: {
                        required: true,
                    },
                    code: {
                        required: true,
                        digits:true,
                       
                    },warehouse: {
                        required: true,
                      
                        },
                        email: {
                        required: true,                     
                    },name: {
                        required: true,
                    },address: {
                        required: true,
                    },phone1: {
                        required: true,
                        digits:true,
                    },phone2: {
                        required: true,
                        digits:true,
                    },
                messages: {
                    name: {
                        required: "Please enter  name ",
                    },
                    phone1: {
                        required: "Enter Only Digits ",
                    },
                },
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },
              
                submitHandler: function(form) {
                    $('.btn_sub').click(function(){
                $(':input[type="submit"]').prop('disabled', true);
});
                    // do other things for a valid form
                    var formData = $("#ajaxForm").serialize();
                    $("#modal-body lodgif").html("Your formhas been successfully submitting...");
                     $( "#mod" ).removeClass( "hidden" );
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            setInterval(function(){
                                $("#modal-body lodgif").html("Your form has been successfully submited, you are now being redirected ...");
                                $('#myModal').modal('show');
                          window.location.href="{{URL::route('Parts')}}";
                            }, 1500);

                        }
                    });
                    return false;
                }
            });
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
