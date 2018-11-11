@extends('layouts.admin1')

@section('header')
 
 <link rel="stylesheet" href="{{ asset('assets/admin/css/select2.min.css')}}">
@endsection

@section('content')


<style>
.select2-container--default.select2-container--open.select2-container--below .select2-selection--single, .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
    height: auto!important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #ff5050 !important;
    border-color: #ff5050 !important;
       text-transform: lowercase;
    font-size: 14px!important;
}
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border: solid black 1px;
    outline: 0;
    height: auto;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff;
  
}
.btn-group>.btn:first-child {
    margin-left: 0;
    display: none;
}
</style>
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
 <div class="form-group">
                  
                      <select  id="basic" class="form-control multiple-select" multiple="multiple" name="asp_admin[]">
                          @foreach($users11 as $user)
      <option class="chk" value="{{$user->id}}">{{$user->name}}</option>
      @endforeach
                      </select>
                    </div>
                
  
	 <!--select  id="basic" multiple="multiple" name="asp_admin[]" >
        @foreach($users11 as $user)
      <option class="chk" value="{{$user->id}}">{{$user->name}}</option>
      @endforeach
    
    </select-->
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
        $(document).ready(function() {
            $('.single-select').select2();
      
            $('.multiple-select').select2();

        //multiselect start

            $('#my_multi_select1').multiSelect();
            $('#my_multi_select2').multiSelect({
                selectableOptgroup: true
            });

            $('#my_multi_select3').multiSelect({
                selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                afterInit: function (ms) {
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function (e) {
                            if (e.which === 40) {
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function (e) {
                            if (e.which == 40) {
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
                },
                afterSelect: function () {
                    this.qs1.cache();
                    this.qs2.cache();
                },
                afterDeselect: function () {
                    this.qs1.cache();
                    this.qs2.cache();
                }
            });

         $('.custom-header').multiSelect({
              selectableHeader: "<div class='custom-header'>Selectable items</div>",
              selectionHeader: "<div class='custom-header'>Selection items</div>",
              selectableFooter: "<div class='custom-header'>Selectable footer</div>",
              selectionFooter: "<div class='custom-header'>Selection footer</div>"
            });



          });

    </script>

 <script type="text/javascript" src="{{ asset('assets/admin/js/select2.min.js')}}"></script>

  <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#basic').multiselect({
                                                    includeSelectAllOption: true,
                                                    selectAllNumber: false
                                                });
                                            });
                                        </script>
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
               includeSelectAllOption: true,
			     selectAllNumber: false
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
