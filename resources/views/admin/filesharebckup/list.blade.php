@extends('layouts.admin1')

@section('header')
 

@endsection

@section('content')



    <!-- Content Wrapper. Contains page content -->
   
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>File Sharing</h1>
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li><i class="fa fa-angle-right"></i>File Sharing</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
        <button type="button" class="btn btn-success m-r-1" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus-circle"></i> New File Share</button>

            <div class="card m-t-3">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped" style="">
                            <thead>
                            <tr>
                           
                            <th>Action</th>
                                <th>File</th>
                                <th>File Name</th>

                                <th>Shared To</th>                                   
                                
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $job)
                           
                             <tr style="text-align:center;">
                                <td> <a class="btnsecal  deleteButton" data-tooltip="Delete" data-id="{{$job->file_id}}"  data-toggle="modal"  data-target="#deleteModal" title="Delete Details"><i class="fa fa-trash pad"></i></a>
                                 
                                <a class="btnsedit " data-tooltip="Edit"  href="{{URL::route('EditFileShare',$job->file_id)}}" title="Edit"><i class=" edi pad fa fa-edit"></i></a>
                                 </td>
                               
                                <td> @if($job->file_ext == 'pdf')<a href="{{ url('data/files/'.$job->file_url) }}" alt=""/><img style="width:80px" src="{{ asset('assets/admin/img/2222.png')}}"/></a>
                                @else
                                <a href="{{ url('data/files/'.$job->file_url) }}" alt=""/><img style="width:80px" src="{{ url('data/files/'.$job->file_url) }}"/>
                                @endif

                                </td>  
                                <td>{{$job->file_title}}</td>
                                <td>{{$job->name}}</td>

                            </tr>
                            @endforeach
                            </tfoot>
                        </table>
                    </div>
                </div>
				</div>
        </div>
        {{$users->links()}}
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog  ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">New File Share</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{url('/post-file-share')}}" method="post" id="rmaform" name="form1" enctype="multipart/form-data">
               
              
   
   
   
               <div class="row" id="amntdiv">
       
       
                  
       
                   <div class="col-lg-6 col-md-6">
               <fieldset class="form-group">
               <label for="exampleInputFile">Image</label>
                                                       <div class="col-sm-10">
                                                       <input id="Image"  type="file" name="files"/>
         
                                                   </div>
       
                   </fieldset>
                   </div>
       
       
                   <div class="col-lg-6">
              <label>Select ASP</label>
              <div>


    <select class="custom-select" id="basic" multiple="multiple" name="asp_admin[]" >
        @foreach($users11 as $user)
      <option class="chk" value="{{$user->id}}">{{$user->name}}</option>
      @endforeach
    
    </select>
    </div>
       
                 </div>
       
               <div class="col-md-12 cenbut">
           <input type="hidden" name="type" value="newrma">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       <input type="submit" value="Submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10 sel_val">
       
                       </div>
                     </form>
					 <span style="color:red;">Only jpg,png,pdf,docs files</span>
               
        </div>
        
      </div>
    </div>
  </div>

  </div>




<div class="clearfix"></div>
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteModalForm">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden"name="_token" value="{{ csrf_token() }}"/>
                        <input id="delete_id" type="hidden" name="delete_id" value=""/>
                        <input type="hidden" name="type"   value="delete_file"/>
                        
                    </div>
                </div>
                <!-- Modal content-->
                <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Delete File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                    
                    <div class="modal-body">
                        <p>Are you sure Delete File</p>
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

        <div class="clearfix"></div>
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
//         function validate() 
// {
    
// if( document.form1.asp_admin.value == "" )
//    {
//      alert( "Please select qualification!" );
//      return false;
//    }
// }
    </script>
    
    <!-- <script>
        $("table").tableExport({formats: ["xlsx","xls", "csv", "txt"],    });
    </script> -->
    <script>
        $(document).ready(function(){
         
            $(function(){
    $('#rmaform').submit(function(){
         var options = $('#basic > option:selected');
         if(options.length == 0){
             alert('Please select ASP');
             return false;
         }
    });
});         


            $('#basic').multiselect({
               includeSelectAllOption: true
           });
           $('#btnSelected').click(function () {

               var selected = $("#basic option:selected");
               var message = "";
               selected.each(function () {
                   message += $(this).text() + " " + $(this).val() + "\n";
               });
  
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
            
            $("#rmaform").validate({
                rules:{
                         files: "required"
                     },
                messages: {
                    files: {
                        required: "Please choose file ",
                    }
                },
                errorPlacement: function(error, element) {
                    console.log(element.attr('name'));
                    $( error ).insertAfter( element);
                },

                
            });
            
        });
    </script>
@endsection
