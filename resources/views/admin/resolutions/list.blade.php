@extends('layouts.admin1')

@section('header')
 

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
   
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Resolution Code Setup</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i>Resolution Code Setup</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
        <button type="button" class="btn btn-success m-r-1" data-toggle="modal" data-target="#largeModal1"><i class="fa fa-plus-circle"></i> Create New</button>
       
        <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-4">
     <div class="date m-t-2">
    <div class="input-group mb-3 ">
  <input type="text" class="form-control" id="sear_in" name="sear" value="" >
  <div class="input-group-append">
    <button class="getbtn btn btn-info" type="button" id="getbtn">Filter</button>
    
  </div>
     </div> 
     </div> 
     </div>
     <div class="clearfix"></div> 
        <div class="modal fade" id="largeModal1" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog  ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Create Resolution Code</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="milegae">
        <div class="row">
<div class="col-md-12">
                           <div class="form-group has-feedback">
                           <label>Code</label>
                                <input type="text" name="res_code" class="form-control "  >
                            </div> 
                            </div>
                            </div>
                           
<div class="row">
<div class="col-md-12">
<div class="form-group has-feedback">
                            <label>Description</label>
                                <input type="text" name="res_desc"   class="form-control "  >
                            </div>
    </div>



                            
          </div>                   
                         
                            <div>
                            <span id="error"></span>
                              <div class="mod_fot m-t-2">
                              <input type="hidden" name="type" value="newResolution">
                                 
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-lg btn-success">  Confirm</button>
        </div>  
                            </div>
                        </form>
        </div>
        
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
                                <th>Code</th>
                                <th>Description</th>
                              
                             
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parts as $job)
                            <tr class="strlength" style="text-align:center;" >
                            <td>
                            <a class="btnsedit " href="{{URL::route('ViewResolution',$job->resolution_id)}}" title="View"><i class="fa fa-eye pad"></i></a>


<a class="btnsedit " href="{{URL::route('EditResolution',$job->resolution_id)}}" title="Edit"><i class=" edi pad fa fa-edit"></i></a>
<a class="btnsecal  deleteButton" data-tooltip="Delete" data-id="{{$job->resolution_id}}"  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
                                </td>
                                <td>{{$job->resolution_code}}</td>
                                <td>{{$job->resolution_description}}</td>
                               
                               

                            </tr>
                            @endforeach
                            </tfoot>
                        </table>
                    </div>
                </div></div>
        </div>
        {{$parts->links()}}
        <!-- /.content -->
    
    <!-- /.content-wrapper -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form id="deleteModalForm">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}" />
                        <input id="delete_id" type="hidden" name="delete_id" value="" />
                        <input type="hidden" name="type"   value="delete_resolution" />
                         
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">

                <div class="modal-header">
              <h5 class="modal-title">Delete Resolution Code</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
                    
                    <div class="modal-body">
                        <p>Are you sure Delete Resolution Code?</p>
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
            $("#milegae").validate({
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

                    // do other things for a valid form
                    var formData = $("#milegae").serialize();
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
                          window.location.href="{{URL::route('Resolutions')}}";
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
            $('#getbtn').on('click', function() {

var res = $('#sear_in').val();

var token = "{{ csrf_token() }}";
var type = 'get_resolution';
           $.ajax({
               type: 'post',
               url: '{{ URL::route("postData") }}',
               data: { type:type,res:res,_token:token},
               success: function(data){
                   if(data.status==1){

                       $("#example1").html(data.html);

                   }else{
                    $(".no_f").removeClass('hidden');

                         $("#example1").addClass('hidden');
                     }

               }
           });
});
        });
    </script>
@endsection
