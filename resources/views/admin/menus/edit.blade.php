@extends('layouts.admin')

@section('header')
@endsection

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h5>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><a href="{{ URL::route('Menus') }}">List</a></li>
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
                                    <h3 class="box-title">Menu</h3>
                                </div>
                                <form class="form-horizontal" id="ajaxForm">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Menu</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="menu_name" @if(!empty($menu)) value="{{ $menu->menu_name }}" @endif placeholder="Menu">
                                            </div>
                                        </div>

                                        <div class="box-footer">
                                            <input type="hidden" name="type" value="newMenu">
{{--
                                            <input type="hidden" name="menu_token" value="{{ md5(uniqid(rand(), true)) }}">
--}}
                                            @if(!empty($menu))
                                                <input type="hidden" name="menu_id" value="{{$menu->menu_id}}">
                                            @endif
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="button" class="btn btn-default"><a href="{{ URL::route('Menus') }}">Cancel</a></button>
                                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('footer')

    <script>
        $(document).ready(function() {

            $("#ajaxForm").validate({
                rules: {
                    menu_name: {
                        required:true,
                        remote: {
                            url: '{{ URL::route("Validation") }}',
                            type: "post",
                            data: {_token:'{{ csrf_token() }}',type:'menu', @if(!empty($menu))menu_id:'{{$menu->menu_id}}'@endif},
                        }
                    },
                },
                errorPlacement: function (error, element) {
                    console.log(element.attr('name'));
                    $(error).insertAfter(element);
                },
                submitHandler: function (form) {
                    var formData = $("#ajaxForm").serialize();
                    $("#messageModalBody").html("Your formhas been successfully submitting...");
                    $('#messageModal').modal('show');
                    $.ajax({
                        type: 'post',
                        url: '{{ URL::route("postData") }}',
                        data: formData,
                        success: function(data){
                            $("#messageModalBody").html("Your form has been successfully submited, you are now being redirected ...");
                            $('#messageModal').modal('show');
                            setInterval(function () {
                                window.location.href = '{{ URL::route("Menus") }}';
                            }, 1500);
                        }
                    });
                    return false;
                }
            });
        });
    </script>

@endsection
