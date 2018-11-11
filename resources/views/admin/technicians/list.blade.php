@extends('layouts.admin2')

@section('header')
@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Manage Asp Technician</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i> Manage Asp Technician</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
        <button type="button" class="btn btn-success m-r-1" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus-circle"></i> Create Asp Technician</button>

        <!-- <a href="{{ URL::route('NewTechnician') }}"><span class="btn btn-sm btn-success"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> Create New Technician
</span></a> -->

<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog  ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Asp Technician</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="ajaxForm">
        <div class="row">
<div class="col-md-12">
                           <div class="form-group has-feedback">
                           <label>Name</label>
                                <input type="text" name="username"  class="form-control "  >
                            </div> 
                            </div>
                            </div>
                           
<div class="row">
<div class="col-md-12">
<div class="form-group has-feedback">
                            <label>Email</label>
                                <input type="email" name="email"   class="form-control "  >
                            </div>
    </div>

    <div class="col-md-12">
    <div class="form-group has-feedback">
                            <label>Password</label>
                                <input type="password" name="password"  class="form-control "  >
                            </div>
</div>


     
    

                            
          </div>                   
                         
                            <div>
                            <span id="error"></span>
                              <div class="mod_fot m-t-2">
                              <input type="hidden" name="type" value="newTechnician">
                             
                              <input type="hidden" name="code" value="{{$asp->warehouse_code}}">
                             
                                   
                                  
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

                                 <th>Name</th>
                                <th>Email</th>
                              
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($techs))
                            @foreach($techs as $admin)
                            <tr style="text-align:center;">
                            <td>{{$admin->username}}</td>
                                <td>{{$admin->email}}</td>
                                

                                <td>
                                
                                <a class="btnsedit js-mytooltip" data-tooltip="Edit" href="{{URL::route('NewTechnician',$admin->id)}}" title="Edit"><i class=" edi pad fa fa-edit"></i></a>
                                    <a class="btnsecal deleteButton" data-tooltip="Delete" data-id="{{$admin->id}}"  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>

                                </td>

                            </tr>
                                @endforeach
                                @endif


                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div></div>
        </div>
        {{$techs->links()}}
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- <div class="animatedParent">

<div class="modal fade modaltop animated growIn slow go " id="myModal" role="dialog">
 <div class="modal-dialog">

  
   <div class="modal-content modaltop">
     <div class="modal-header">
     <h4 class="modal-title"> Asp technician Created</h4>

       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <div class="modal-body lodgif">
     <img src="{{asset('assets/admin/img/check-circle.gif')}}">
    
   
     </div>
    
   </div>
 </div>
</div>
</div> -->
<div class="loading style-2 hidden" id="mod">
    <div class="loading-wheel "></div></div>

<div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form id="deleteModalForm">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="delete_id" type="hidden" name="delete_id" value="" />
                        <input type="hidden" name="type"   value="delete_technician" />
                         
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">

                <div class="modal-header">
              <h5 class="modal-title">Delete ASP Technician</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    
                    <div class="modal-body">
                        <p>Are you sure to  Delete Technician?</p>
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
@endsection

@section('footer')
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
                    },code: {
                        required: true,
                    },warehouse_id: {
                        required: true,
                      
                    },name: {
                        required: true,
                    },address: {
                        required: true,
                    },phone1: {
                        required: true,
                    },phone2: {
                        required: true,
                    },
                messages: {
                    name: {
                        required: "Please enter  name ",
                    }
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
                                $("#modal-body").html("Your form has been successfully submited, you are now being redirected ...");
                                $('#myModal').modal('show');
                          window.location.href="{{URL::route('Technicians')}}";
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
