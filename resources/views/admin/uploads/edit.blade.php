@extends('layouts.admin')

@section('header')

@endsection

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h5>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><a href="{{ URL::route('Uploads') }}">List</a></li>
                </ol>
            </h5>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="tab-pane active" >
                                <div class="box-header with-border">
                                    <h3 class="box-title">Page</h3>
                                </div>
                                <form class="form-horizontal" id="ajaxForm">
                                    <div class="box-body">

                                        @if(!empty($banner))
                                        <div class="form-group ">
                                            <label  class="control-label col-lg-2">Image</label>
                                            <div class="col-lg-10">
                                                <table class="table table-bordered table-hover" style="width: 50%">
                                                    <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="8%">
                                                            Attachment
                                                        </th>

                                                        <th width="10%"> Remove

                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="ImagePrevs">


                                                    <tr >
                                                        <td>
                                                            <a href="" class="fancybox-button" data-rel="fancybox-button">

                                                                    <img style="margin: 0 10px 10px 0 !important; width:40px;" src="{{ asset('assets/admin/images/iconimg.gif')}}" />

                                                            </a>
                                                        </td>

                                                        <td> <span style="cursor: pointer;" onclick="removeImage({{$banner->upload_id}})">Remove</span>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div id="progress" class="progress " style="display: none;">
                                            <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <div class="form-group Image">
                                            <label for="exampleInputFile">Image</label>

                                            <input id="Image"  type="file" name="files[]" multiple/>


                                        </div>

                                        <div id="progress" class="progress " style="display: none;">
                                            <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <span id="imageUpError">
                         <label class="control-label col-sm-12 " id="imageError" style=" color: #a94442; text-align: center;"></label>
                    </span>

                                        @else

                                            <div class="form-group Image">
                                                <label for="exampleInputFile">Image</label>

                                                <input id="Image"  type="file" name="files[]"/>


                                            </div>
                                            <table class="table table-bordered table-hover" style="width:50%;margin-left: 217px;">
                                                <thead>
                                                <tr role="row" class="heading">

                                                </tr>
                                                </thead>
                                                <tbody id="ImagePrevs">

                                                </tbody>
                                            </table>

                                            <div id="progress" class="progress " style="display: none;">
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div>
                                            <span id="imageUpError">
                         <label class="control-label col-sm-12 " id="imageError" style=" color: #a94442; text-align: center;"></label>
                    </span>
                                    </div>
                                @endif

                                    <div class="box-footer">
                                        <input type="hidden" name="type" value="newUpload">
                                        <input type="hidden" name="page_token" value="{{ md5(uniqid(rand(), true)) }}">
                                        @if(isset($banner))
                                            <input type="hidden" name="upload_id" value="{{$banner->upload_id}}">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="button" class="btn btn-default"><a href="{{ URL::route('Uploads') }}">Cancel</a></button>
                                        <button type="submit" class="btn btn-info pull-right">Submit</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
    </div>

@endsection

@section('footer')

    <script>
        $(document).ready(function(){
            $('#menu_id').change(function() {
                var optionSelected = $(this).val();
                alert(optionSelected);
                if (optionSelected == 3) {
                    $( ".servicetype" ).removeClass('hidden')
                }
            });


            var token = '{{ csrf_token() }}';

            var url = '{{ URL::route("PostImageUpload") }}';


            $('#Image').fileupload({
                url: url,
                dataType: 'json',
                formData : {_token:token},
                add: function (e, data) {
                    var fileType = data.files[0].name.split('.').pop(), allowdtypes = '.xlsb,.xlsm,.xltx,png,jpg,doc,pdf,.xlsx';

                    if (allowdtypes.indexOf(fileType) < 0) {
                        alert('Sorry,JPG PNG GIF are allowed.');
                        return false;
                    }

                    if( data.files[0]['size'] > 100000000) { //10MB
                        alert('Filesize is too big');
                        return false;
                    }
                    data.submit();
                },progressall: function (e, data) {
                    $("#progress").show();
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css('width',progress + '%');
                },
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        var url = "";

                        if(file.type == "image/jpeg" || file.type == "image/jpg" || file.type == "image/png" || file.type == "image/gif" ){
                            var urlRoute = "{{ asset('data/temp/') }}/";
                            url = "<img src='"+urlRoute+file.name+"' style='max-width: 50px;'/>";


                        }
                        var html = '<tr ><td><a href="#" class="fancybox-button" data-rel="fancybox-button"><img src="{{ asset('assets/admin/images/iconimg.gif')}}"" height="42" width="42"><input type="hidden" name="fileURLs[]" value="'+file.name+'"  /></td><td><a href="javascript:;" class="btn default btn-sm removeImage"  id=""><i class="fa fa-times"></i> Remove </a> </td> </tr>';
                        $('#ImagePrevs').append(html);
                    });

                    $("#progress").hide();
                    var $ImagePrevs = $('#ImagePrevs');

                },


            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
            $('body').on('click', '.removeImage', function () {

                $(this).parent().parent().remove();

            });

            $("#ajaxForm").validate({
                rules: {
                    menu_id: {
                        required: true,
                    },content: {
                        required: true,
                    },files: {
                        required: true,
                    }
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
                    $("#messageModalBody").html("Your formhas been successfully submitting...");
                    $('#messageModal').modal('show');
                    $.ajax({
                        type: 'post',
                        url: "{{ URL::route('postData') }}",
                        data:formData,
                        success: function(data){
                            setInterval(function(){
                                $("#messageModalBody").html("Your form has been successfully submited, you are now being redirected ...");
                                $('#messageModal').modal('show');
                                 window.location.href="{{URL::route('Uploads')}}";
                            }, 1500);

                        }
                    });
                    return false;
                }
            });
        });
        function removeImage(id){

            var type = 'removeUploads';
            var id = id;


            $.ajax({

                type:'post',

                url:"{{ URL::route('PostRemove') }}",

                data:{id:id,_token: '{{ csrf_token() }}',type:type},

                success:function(data){

                    if(data.status==1){

                        $("#ImagePrevs").addClass('hidden');

                    }

                }

            });

        }
    </script>

@endsection
