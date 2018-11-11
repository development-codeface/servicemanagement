<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Toshiba</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/et-line-font/et-line-font.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/animations.css')}}">
<style>
  
/* Add a dark gray background color to the modal header and center text */
   
.modal-header, h4, .close {
 
   display: block;
}

.lodgif img{width: 112px;
   margin: 0 auto;
   display: block;}
.lodgif h1{text-align: center;
   font-size: 16px;}

</style>


</head>
<body class="hold-transition login-page" style="margin: 0; height: 100%; overflow: hidden">
<div class="login-box">
    <div class="login-box-body loginlog">
        <img src="{{ asset('assets/admin/img/Toshiba-Logo.png')}}" alt="">
        <h3 class="login-box-msg">Sign In</h3>
        <form id="loginForm">
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control sty1" placeholder="Username">
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control sty1" placeholder="Password">
            </div>
            <div>
            <span id="error"></span>
            <div class="checkbox icheck">
                        <a data-toggle="modal" href="#forgotModal"> Forgot password</a><br>
                    </div>
                <!-- /.col -->
                <div class="col-xs-4 m-t-4">
                    <input type="hidden" name="type" value="login">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    
        <!-- /.social-auth-links -->

        <!--div class="m-t-2">Don't have an account? <a href="pages-register.html" class="text-center">Create</a></div-->
    </div>
    <!-- /.login-box-body -->
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="forgotModal" class="modal fade">
    <div class="modal-dialog" >
        <form id="forgotForm">
           <div class="modal-content">
            <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Enter your e-mail </h4>
            </div> -->
            <div class="modal-body text-center">
                <p>Enter your e-mail address below to reset your password.</p>
                <input type="text" name="forgot_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
                <div class="registration" id="forgot_error"></div>
                <div class="registration" id="forgot_success"></div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" class="form-control" name="type" value="forgotPassword">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade modaltop " id="myModal" role="dialog">
 <div class=" modal-dialog-centered">

   <!-- Modal content-->
   
     <div class="modal-body lodgif">
     <img src="{{asset('assets/admin/img/loader.gif')}}">
      
   
     </div>
      
   </div>
 </div>
</div>
 

<script src="{{ asset('assets/admin/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}" type="text/javascript"> </script>
<script src="{{ asset('assets/admin/js/niche.html')}}"></script>
<script src="{{ asset('assets/admin/js/css3-animate-it.js')}}"></script>
<script>

    $(document).ready(function() {

        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                },

            },

            errorPlacement: function(error, element) {

                console.log(element.attr('name'));
                $( error ).insertAfter( element);
            },
            submitHandler: function(form) {

                // do other things for a valid form
                var formData = $("#loginForm").serialize();
                $("#modal-body lodgif").html("Login successfully submitting...please wait while redirecting!");
                $('#myModal').modal('show');
                $.ajax({
                    type: 'post',
                    url: '{{ URL::route("AdminAuthManage") }}',
                    data: formData,
                    success: function(data){
                        if(data.status == 1){
                          
                            $('#myModal').modal('show');
                            setInterval(function () {
                                window.location.href = '{{ URL::route('TssDashboard') }}';
                            }, 1500);
                        }
                        else if(data.status == 2){
                            
                            $('#myModal').modal('show');
                            setInterval(function () {
                               window.location.href = '{{ URL::route('AspDashboard') }}';
                            }, 1500);
                        }
                        else if(data.status == 3){
                           
                            $('#myModal').modal('show');
                            setInterval(function () {
                                window.location.href = '{{ URL::route('UserDashboard') }}';
                            }, 1500);
                        }
                        else if(data.status == 4){
                            
                            $('#myModal').modal('show');
                            setInterval(function () {
                                window.location.href = '{{ URL::route('LogDashboard') }}';
                            }, 1500);
                        }
                        else if(data.status == 0) {
                            $('#error').html('<p style="color: red"><strong>Invalid!</strong> password or email...</p>');
                            $("#myModal").removeClass("in");
                           $(".modal-backdrop").remove();
                           $("#myModal").hide();
                        }
                    }
                });


                return false;
            }
        });

        $("#forgotForm").validate({
            rules: {
                forgot_email: {
                    required: true,
                }

            },

            errorPlacement: function(error, element) {

                console.log(element.attr('name'));
                $( error ).insertAfter( element);
            },
            submitHandler: function(form) {
                // do other things for a valid form
                var formData = $("#forgotForm").serialize();
                $('#forgotModal').modal('hide');
                $("#loginModalBody").html("Mail successfully submitting...");
                $('#loginModal').modal('show');
                $.ajax({
                    type: 'post',
                    url: '{{ URL::route("AdminAuthManage") }}',
                    data: formData,
                    success: function(data){
                        if(data.status == 1) {
                            $("#loginModalBody").html("Mail successfully submitted, Please Check your mail...");
                            $('#loginModal').modal('show');
                            setInterval(function () {
                                location.reload();
                            }, 1500);

                        }else if(data.status == 2){
                            $('#loginModal').modal('hide');
                            $('#forgotModal').modal('show');
                            $('#forgot_error').html(data.html);
                        }
                    }
                });
                return false;
            }
        });
    });

</script>

</body>

</html>