@extends('layouts.admin1')

@section('header')
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Manage ASP Admin</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Manage ASP Admin</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
        <!-- <a href="{{ URL::route('NewAspAdmin') }}"><span class="btn btn-sm btn-success"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Create Asp Admin -->
</span></a>
<button type="button" class="btn btn-success m-r-1" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus-circle"></i> Create Asp Admin</button>

<!-- Create Asp Admin -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Asp Admin</h4>
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
                            <label>Email</label>
                                <input type="email" name="email" @if(isset($admin)) value="{{ $admin->email }}" @endif  class="form-control " required >
                            </div>
    </div>

    <div class="col-md-6">
    <div class="form-group has-feedback">
                            <label>Password</label>
                                <input type="password" name="password" @if(isset($admin)) value="{{ $admin->password }}" @endif  class="form-control "required  >
                            </div>
</div>
<div class="col-md-6"><div class="form-group has-feedback">
                            <label>Warehouse ID</label>
                                <input type="text" name="warehouse" @if(isset($admin)) value="{{ $admin->warehouse }}" @endif  class="form-control " required >
                            </div></div>

     
    <div class="col-md-6">
    <div class="form-group has-feedback">
                            <label>Company Name</label>
                                <input type="text" name="name" @if(isset($admin)) value="{{ $admin->name }}" @endif  class="form-control "required >
                            </div>
          </div>                  
                            
          <div class="col-md-6">
          <div class="form-group has-feedback">
                            <label>Asp Admin Code</label>
                                <input type="text" name="code" @if(isset($admin)) value="{{ $admin->code }}" @endif  class="form-control "  required>
                            </div> 
          

          </div>
          
          <div class="col-md-6">

<div class="form-group has-feedback">
                            <label>Address</label>
                                <input type="text" name="address" @if(isset($admin)) value="{{ $admin->address }}" @endif  class="form-control " required >
                            </div>
 </div>
 <div class="col-md-6">
 <div class="form-group has-feedback">
                            <label>Contact Number</label>
                                <input type="text" name="phone1" @if(isset($admin)) value="{{ $admin->tel_number1 }}" @endif   class="form-control "required >
                            </div>
</div>
<div class="col-md-6">
<div class="form-group has-feedback">
                            <label>Fax</label>
                                <input type="text" name="phone2" @if(isset($admin)) value="{{ $admin->tel_number2 }}" @endif  class="form-control " required >
                            </div>
</div> 

                            
          </div>                   
                            
                            
                    
                            <div>
                            <span id="error"></span>
                              <div class="mod_fot m-t-2">
        <input type="hidden" name="type" value="newAspAdmin">
                                    @if(isset($admin))
                                        <input type="hidden" name="id" value="{{$admin->id}}">
                                    @endif
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-lg btn-success">  Confirm</button>
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>


                     <th>Action</th>
                                <th>Email</th>
                                <th> WareHouse Name</th>
                                <th> WareHouse Id</th>
                                <th> Code</th>
                               
                              
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $adm)
                            <tr style="text-align:center;">

                               <td>
                                <a class="btnsedit " data-tooltip="View" href="{{URL::route('ViewAspAdmin',$adm->id)}}" title="View"><i class="fa fa-eye pad"></i></a>

                                    <a class="btnsedit " data-tooltip="Edit" data-id="{{$adm->id}}" href="{{URL::route('NewAspAdmin',$adm->id)}}" title="Edit"><i class=" edi pad fa fa-edit"></i></a>
                                    <a class="btnsecal  deleteButton" data-tooltip="Delete" data-id="{{$adm->id}}" data-code="{{$adm->code}}"  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
                               
                     
                               
                               </td>
                                <td>{{$adm->email}}</td>
                                <td>{{$adm->name}}</td>
                                <td>{{$adm->warehouse_id}}</td>
                                <td>{{$adm->code}}</td>
                             

                                

                            </tr>
                            @endforeach

                            </tfoot>
                        </table>
                    </div>
                </div></div>
        </div>
        {{$admins->links()}}
        <!-- /.content -->
        
        <!-- /.content -->
        
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
                        <input id="code" type="hidden" name="code" value="" />

                        <input type="hidden" name="type"   value="delete_asp_admin" />
                         
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">

                <div class="modal-header">
              <h5 class="modal-title">Delete ASP Admin</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    
                    <div class="modal-body">
                        <p>Are you sure Delete ASP Admin?</p>
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
            
$(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
            $("#ajaxForm").validate({
                rules: {
                    email: {
                        required: true,
                        remote: {
                            url: '{{ URL::route("postData") }}',
                            type: "post",
                            data: {_token:'{{ csrf_token() }}',type:'emailexists',@if(!empty($user))id:'{{$user->_id}}'@endif},

                        }
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
                                $("#modal-body").html("Claim Submitted");
                    $('#myModal').modal('show');
                          window.location.href="{{URL::route('AspAdmin')}}";
                            }, 1500);

                        }
                    });
                    return false;
                }
            });




            $('.deleteButton').click(function(){

                var user_id = $(this).attr('data-id');
                var code = $(this).attr('data-code');
                $('#delete_id').val(user_id);
                $('#code').val(code);
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
