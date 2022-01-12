<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Example-App - Login</title>
    <link href="{{URL::asset('public/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/dist/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
   
    <div class="container">
        <noscript>
            <div class="alert alert-danger text-center">
                Your browser does not support JavaScript! This will disrupt some function and site may not work prperly.
            </div>
        </noscript>
        <div class="col-md-4 col-md-offset-4 text-center" style="margin-top: 90px;">
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @elseif(Session::has('warning'))
            <div class="alert alert-warning">
                {{ Session::get('warning') }}
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$heading}}</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="{{route('loginAction')}}" method="post">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <label>Email* @error('email')<span style="color:red;">{{$message}}</span>@enderror <span id="err_email"></span></label>
                                    <input class="form-control" placeholder="E-mail" id="email" name="email" type="text" autofocus value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label>Password* @error('password')<span style="color:red;">{{$message}} </span>@enderror <span id="err_password"></span></label>
                                    <input class="form-control" placeholder="Password" id="password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block" onclick="return checkvalidation()">Login</button><br>
                                <div class="text-center">If you are new, <a href="{{route('registration')}}">Click here</a> to registered with us!<div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{URL::asset('public/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/metisMenu/metisMenu.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/dist/js/sb-admin-2.js')}}"></script>
    <script type="text/javascript">
        function checkvalidation(){
            var email = $('#email').val();
            var password = $('#password').val();
            var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

            if(email.trim()==""){
                $('#err_email').html('Required').css('color','red').show('1500');
                setTimeout(function(){
                    $('#err_email').hide('1500');
                },3000);
                $('#email').focus();
                return false;
            }else if(!pattern.test(email)){
                $('#err_email').html('Please enter valid email.').css('color','red').show('1500');
                setTimeout(function(){
                    $('#err_email').hide('1500');
                },3000);
                $('#email').focus();
                return false;
            }
            if(password.trim()==""){
                $('#err_password').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_password').hide();
                },3000);
                    $('#password').focus();
                return false;
            }
        }
    </script>
</body>
</html>       