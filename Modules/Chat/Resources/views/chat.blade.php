@extends('chat::layouts.master')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <style>
        .vue-popover{
            left:100px !important;
        }
    </style>

    <div class="container-fluid" style="background: #1da851;"  id="app">

        <div class="row" >
            <div class="col-md-9" style="background: #25d366;">
                <div class="col-md-4">
                    <img src="{{ asset('assets/images/chatlogo.png') }}">
                </div>
                <div class="col-md-4" style="width: 729px;">


                </div>
            </div>

            <div class="col-md-3">
                <owner></owner>
            </div>
        </div>

        <div class="row">


            <div class="col-md-9"  v-chat-scroll style="height: 400px; overflow-y: scroll; font-family: 'Agency FB'; font-weight: bold; background-color: #dcfde8;border-radius: 1px solid #EBF1F5;">

                <messages></messages>

            </div>

            <div class="col-md-3" style="font-family: 'Agency FB'; font-weight: bold; font-size: 16pt;background-color: #25d366; border: 1px solid #EBF1F5;">
                <users></users>

            </div>

        </div>

</div>

@stop

@section('footer_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!-- Homepage Leaderboard --><ins class="adsbygoogle"style="display:inline-block;width:728px;height:90px"data-ad-client="ca-pub-1234567890123456"data-ad-slot="1234567890"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
<script>

    $(function () {
        $('.example-popover').popover('toggle');
    })

    $(document).ready(function () {
        $(".addFriend").click(function () {
            var id = $(this).data("value");
            var sendData = "_token=" + "{{ csrf_token() }}" + "&" + "id=" + id;
            var url = 'chat/addFriends';
            $.ajax({
                url: url,
                type: 'post',
                data: sendData,
                success: function(data)
                {
                    alert(data);
                }
            });
        });
    });


    $(document).ready(function () {
        $(".unfriend").click(function () {
            var id = $(this).data("value");
            var sendData = "_token=" + "{{ csrf_token() }}" + "&" + "id=" + id;
            var url = 'chat/destroy';
            $.ajax({
                url: url,
                type: 'post',
                data: sendData,
                success: function(data)
                {
                    alert(data);
                }
            });
        });
    });


</script>

    @stop