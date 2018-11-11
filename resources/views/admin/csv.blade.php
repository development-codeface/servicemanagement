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
                                <form action="{{url('/post-csv')}}" method="post" id="ajaxForm" enctype="multipart/form-data">
                                    <div class="box-body">
                                            <div class="form-group Image">
                                                <label for="exampleInputFile">Image</label>

                                                <input type="file" name="upload-file" class="form-control">
                                            </div>

                                    </div>

                                    <div class="box-footer">
                                        <input type="hidden" name="page_token" value="{{ md5(uniqid(rand(), true)) }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="button" class="btn btn-default"><a href="{{ URL::route('Uploads') }}">Cancel</a></button>
                                        <button type="submit" class="btn btn-info pull-right">Submit</button>
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

    {{--<script>
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
                        var html = '<tr ><td><a href="#" class="fancybox-button" data-rel="fancybox-button"><img src="{{ asset('assets/admin/images/iconimg.gif')}}"" height="42" width="42"><input type="hidden" name="fileURLs" value="'+file.name+'"  /></td><td><a href="javascript:;" class="btn default btn-sm removeImage"  id=""><i class="fa fa-times"></i> Remove </a> </td> </tr>';
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
               /* rules: {
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
                },*/
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
                        url: "{{ URL::route('postCsv') }}",
                        data:formData,
                        success: function(data){
                            setInterval(function(){
                                $("#messageModalBody").html("Your form has been successfully submited, you are now being redirected ...");
                                $('#messageModal').modal('show');
                               // window.location.href="{{URL::route('Uploads')}}";
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
    </script>--}}

@endsection
