<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Toshiba</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/et-line-font/et-line-font.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/animations.css')}}">


    <!-- iCheck -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/googleapis.css')  }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Update your new password here</p>

        <form  id="resetPasswordForm">
            <?php
            $tocken =Request::segment(2);
            if(isset($tocken)){ ?>
            <div class="form-group has-feedback">
                <input type="password" id="mainpassword" name="password" class="form-control" placeholder="New Password">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="c_password" class="form-control" placeholder="Confirm Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span id="error"></span>

            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <input type="hidden" name="type" value="AdminResetPassword">
                    <input id="userId" type="hidden" class="form-control" name="userId" value="<?php echo $resetId->user_id ?>">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
                </div>
                <!-- /.col -->

            </div>
                <?php }else{ ?>

                <label for="emmail_register">Invalid Token</label>
                <?php } ?>

        </form>

        <!-- /.social-auth-links -->


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<div class="modal fade modaltop  " id="myModal" role="dialog">
 <div class=" modal-dialog-centered">

   <!-- Modal content-->
   
     <div class="modal-body lodgif">
     <img src="{{asset('assets/admin/img/loader.gif')}}">
      
   
     </div>
      
   </div>
 </div>
</div>


<!-- jQuery 3 -->
<script src="{{ asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/niche.html')}}"></script>
<script src="{{ asset('assets/admin/js/css3-animate-it.js')}}"></script>

<script>

    $(document).ready(function() {
        $("#resetPasswordForm").validate({
            rules: {
                password: {
                    required: true,
                },
                c_password: {
                    required: true,
                    equalTo: "#mainpassword",

                },

            },

            errorPlacement: function(error, element) {

                console.log(element.attr('name'));
                $( error ).insertAfter( element);
            },
            submitHandler: function(form) {

                // do other things for a valid form
                var formData = $("#resetPasswordForm").serialize();
                $("#resetModalBody").html("Password Reset successfully changing.. please wait while redirecting!");
                $('#resetModal').modal('show');
                $.ajax({
                    type: 'post',
                    url: '{{ URL::route("AdminAuthManage") }}',
                    data: formData,
                    success: function(data){
                        $('#myModal').modal('show');

                        setTimeout(function(){
                            window.location.href = '{{ URL::route("login") }}';
                        }, 2000);


                    }

                });


                return false;
            }
        });
    });

</script>

</body>
</html>
