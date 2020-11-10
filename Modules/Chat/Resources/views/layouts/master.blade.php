<!DOCTYPE html>
<html lang="en" xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ocp Chat Room</title>
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">

    <link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet" type="text/css" />

    <style>
        ul li {
            list-style: none;
        }
        .inner-imgs{
            float: left;
            width:100%;

            list-style: none;
        }

        .inner-imgs li{
            float: left;
            list-style: none;
            border-bottom: 1px solid #eee;;
            height:50px;
            margin-top: -23px;
        }

        .inner-imgs li img{
            padding-left: 3px;
        }
    </style>
    @yield('header_styles')
</head>
<body>
        @yield('content')

    <script src="{{ asset('js/chat.js') }}"></script>
@yield('footer_scripts')

    </body>
</html>
