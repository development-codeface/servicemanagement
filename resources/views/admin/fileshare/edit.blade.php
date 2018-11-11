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
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
      <h1>Edit File Transfer</h1>
      <ol class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li><i class="fa fa-angle-right"></i>Edit File Transfer</li>
      </ol>
    </div>
    
  <div class="content">
    
      <div class="row">
   
        <div class="col-lg-12">
        <a href="{{ URL::route('FileShare') }}"><span class="btn btn-sm btn-info m-b-1"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
</span></a>
          <div class="card ">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">Update File Transfer</h5>
            </div>
            <div class="card-body">
              
            <form action="{{url('/update_file_share')}}" method="post" id="rmaform" enctype="multipart/form-data">
               
              
   
            <a href="{{ url('data/files/'.$file->file_url) }}" alt=""/><img style="width:50px" src="{{ asset('assets/admin/img/2222.png')}}"/></a>

   
           <div class="row" id="amntdiv">
   
   
              
               <div class="col-lg-6 col-md-6">
           <fieldset class="form-group">
           <label for="exampleInputFile">Change File</label>
                                                   <div class="col-sm-10">
                                                   <input id="Image"  type="file" name="files"/>
     
                                               </div>
   
               </fieldset>
               </div>
   
   
               <div class="col-lg-6">
          <label>Select ASP</label>
          <div>
		  <select class="custom-select form-control multiple-select" id="basic" multiple="multiple" name="asp_admin">
    @foreach($users as $user)
  <option class="chk" value="{{$user->id}}">{{$user->name}}</option>
  @endforeach

</select>
<!--select class="custom-select" id="basic" multiple="multiple" name="asp_admin">
    @foreach($users as $user)
  <option class="chk" value="{{$user->id}}">{{$user->name}}</option>
  @endforeach

</select-->
</div>
   
             </div>
   
   
   
           <div class="col-md-12 cenbut">
       <input type="hidden" name="type" value="newrma">
       <input type="hidden" name="file_id" value="{{Request::segment(2)}}">

   
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
     $('#basic').multiselect({
               includeSelectAllOption: true
           });
           $('#btnSelected').click(function () {
            
           
            alert(user_id);
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