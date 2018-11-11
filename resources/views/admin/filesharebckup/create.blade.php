@extends('layouts.admin1')

@section('header')

@endsection

@section('content')
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1>File Transfer</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><i class="fa fa-angle-right"></i> File Transfer</li>
      </ol>
    </div>
    
  <div class="content">
    
      <div class="row">
   
        <div class="col-lg-12">
          <div class="card ">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">File Transfer</h5>
            </div>
            <div class="card-body">
              
            <form action="{{url('/post-file-share')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
              
   
   
   
           <div class="row" id="amntdiv">
   
   
              
   
               <div class="col-lg-6 col-md-6">
           <fieldset class="form-group">
           <label for="exampleInputFile">File</label>
                                                   <div class="col-sm-10">
                                                   <input id="Image"  type="file" name="files"/>
     
                                               </div>
   
               </fieldset>
               </div>
   
   
               <div class="col-lg-6">
          <label>Select ASP Admin</label>
          <div>
<select class="custom-select" id="basic" name="asp_admin[]">
    @foreach($users as $user)
  <option class="chk" value="{{$user->id}}">{{$user->email}}</option>
  @endforeach

</select>
</div>
   
             </div>
   
   
   
           <div class="col-md-12 cenbut">
       <input type="hidden" name="type" value="newrma">
   
   
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <input type="submit" value="Submit" name="submit" class="btn btn-success waves-effect waves-light m-r-10">
   
   
                   </div>
                 </form>
           
            </div>
          </div>
        </div>
      </div>
	  
    </div>
    <!-- /.content --> 
  </div>
  <div class="animatedParent">

<div class="modal fade modaltop animated growIn slow go " id="myModal" role="dialog">
 <div class="modal-dialog">

   <!-- Modal content-->
   <div class="modal-content modaltop">
     <div class="modal-header">
     <h4 class="modal-title"> Parts Request To Tss Admin submitted Successfully ....</h4>

       <button type="button" class="close" data-dismiss="modal">&times;</button>
     </div>
     <div class="modal-body lodgif">
     <img src="{{asset('assets/admin/img/check-circle.gif')}}">
     <h1 > Are you sure to continue?</h1>
   
     </div>
    
   </div>
 </div>
</div>
</div>
@endsection

@section('footer')


<script>
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

//     $("#chkbx").click(function(){
    //         var chkArray = [];
	
	// /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
	// $(".chk:checked").each(function() {
	// 	chkArray.push($(this).val());
    // });
    // var selected;
	// selected = chkArray.join(',') ;
	

  </script>
 






@endsection