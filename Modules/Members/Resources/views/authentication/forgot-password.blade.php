<!DOCTYPE html>
<html>
<head>
    {{--<meta charset="utf-8">--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot_password | Members Frontend</title>
    <!--global css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link href="{{ asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!--end of global css-->
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/forgot.css') }}">
    <!--end of page level css-->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="box animation flipInX font_size">
            <h2>Online Chat Portal</h2>
            <h3 class="text-primary">Forgot Password</h3>
            <p>Enter your email to reset your password</p>
            <div id="notific">

            </div>
            <form action="{{ route('members.forgot-password-confirm') }}" class="omb_loginForm" autocomplete="off" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="sr-only"></label>
                    <input type="email" class="form-control email" name="email" placeholder="Email"
                           value="{!! old('email') !!}">
                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary btn-block" type="submit" value="Send Reset Code">
                </div>
            </form>

            Back to login page?<a href="{{ route('members.login') }}"> Click here</a>
        </div>
    </div>
</div>
<!--global js starts-->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend/forgotpwd_custom.js') }}"></script>
<!--global js end-->
</body>
</html>
