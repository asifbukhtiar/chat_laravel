@extends('superadmin::layouts.default')

{{-- Page title --}}
@section('title')
    View User Details
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/pages/buttons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet"/>
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>User Profile</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">Users</a>
            </li>
            <li class="active">User Profile</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content user_profile">
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav  nav-tabs first_svg">
                    <li class="nav-item">
                        <a href="#tab1" data-toggle="tab" class="nav-link active">
                            <i class="livicon" data-name="user" data-size="16" data-c="#777"  data-hc="#000" data-loop="true"></i>
                            User Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab2" data-toggle="tab" class="nav-link">
                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Change Password</a>
                    </li>

                    <li class="nav-item">
                        <a href="#tab3" data-toggle="tab" class=" nav-link" >
                            <i class="livicon" data-name="gift" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                            Advanced User Profile</a>
                    </li>

                </ul>
                <div  class="tab-content mar-top" id="clothing-nav-content">
                    <div id="tab1" class="tab-pane fade show active">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-heading">
                                        <h3 class="card-title">
                                            User Profile
                                        </h3>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="img-file">
                                                    @if($user->pic)
                                                        <img src="{{ $user->pic }}" alt="img"
                                                             class="img-fluid"/>
                                                    @elseif($user->gender === "male")
                                                        <img src="{{ asset('assets/images/authors/avatar3.png') }}" alt="..."
                                                             class="img-fluid"/>
                                                    @elseif($user->gender === "female")
                                                        <img src="{{ asset('assets/images/authors/avatar5.png') }}" alt="..."
                                                             class="img-fluid"/>
                                                    @else
                                                        <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="..."
                                                             class="img-fluid"/>
                                                    @endif
                                                </div>

                                                <div class="row" style="margin-top: 20px;">
                                                    <div class="col-sm-12 tags">
                                                    @if($user->apply_count > 0 && $user->verification_status == 0)
                                                        <a href="#" id="rejected" class="danger">Reject</a>
                                                        <a href="#" id="accepted" class="success">Accept</a>
                                                    @endif
                                                    </div>
                                                </div>

                                            </div>



                                            <div class="col-md-8">
                                                <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                    <table class="table table-bordered table-striped" id="users">

                                                        <tr>
                                                            <td>First Name</td>
                                                            <td>
                                                                <p class="user_name_max">{{ $user->first_name }}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Last Name</td>
                                                            <td>
                                                                <p class="user_name_max">{{ $user->last_name }}</p>
                                                            </td>

                                                        </tr>

                                                        <tr>
                                                            <td>Username</td>
                                                            <td>
                                                                {{ $user->username }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Email</td>
                                                            <td>
                                                                {{ $user->email }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Gender
                                                            </td>
                                                            <td>
                                                                {{ $user->gender }}
                                                            </td>
                                                        </tr>
                                                        @foreach($user->user_profile as $profile)
                                                        <tr>
                                                            <td>Age</td>

                                                            @if($profile->dob=='0000-00-00')
                                                                <td>
                                                                    DOB Field Empty
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <?php
                                                                        $db = $profile->dob;
                                                                        $dt = Carbon\Carbon::parse($db);
                                                                    $age = Carbon\Carbon::createFromDate($dt->year, $dt->month, $dt->day)->diff(Carbon\Carbon::now())->format('%y years, %m months and %d days');
                                                                    ?>
                                                                    {{ $age }}
                                                                </td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <td>Country</td>
                                                            <td>
                                                                {{ $profile->country }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>State</td>
                                                            <td>
                                                                {{ $profile->state }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>City</td>
                                                            <td>
                                                                {{ $profile->city }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                {{ $profile->address }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Postal Code</td>
                                                            <td>
                                                                {{ $profile->postal }}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td>Status</td>
                                                            <td>

                                                                @if($user->deleted_at)
                                                                    Deleted
                                                                @elseif($activation = Activation::completed($user))
                                                                    Activated
                                                                @else
                                                                    Pending
                                                                @endif
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Profile Verification Status</td>
                                                            <td>

                                                                @if($user->verification_status == 0)
                                                                    Unverified
                                                                @else
                                                                    Verified
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Created</td>
                                                            <td>
                                                                {!! $user->created_at !!}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top ml-auto">
                                <form  class="form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="row">
                                                {{ csrf_field() }}
                                                <label for="inputpassword" class="col-md-3 control-label">
                                                    Password
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                            <span class="input-group-append">
                                                                <span class="input-group-text"><i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i></span>
                                                            </span>
                                                        <input type="password" id="password" placeholder="Password" name="password"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="inputnumber" class="col-md-3 control-label">
                                                    Confirm Password
                                                    <span class='require'>*</span>
                                                </label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                            <span class="input-group-append">
                                                                <span class="input-group-text"><i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i></span>
                                                            </span>
                                                        <input type="password" id="password-confirm" placeholder="Confirm Password" name="confirm_password"
                                                               class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9 ml-auto">
                                            <button type="submit" class="btn btn-primary" id="change-password">Submit
                                            </button>
                                            &nbsp;
                                            <input type="reset" class="btn btn-default" value="Reset"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--advanced profile tab-->
                    <div id="tab3" class="tab-pane fade show">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-heading">
                                        <h3 class="card-title">
                                            Advanced User Profile
                                        </h3>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="img-file">
                                                    @if($user->pic)
                                                        <img src="{{ $user->pic }}" alt="img"
                                                             class="img-fluid"/>
                                                    @elseif($user->gender === "male")
                                                        <img src="{{ asset('assets/images/authors/avatar3.png') }}" alt="..."
                                                             class="img-fluid"/>
                                                    @elseif($user->gender === "female")
                                                        <img src="{{ asset('assets/images/authors/avatar5.png') }}" alt="..."
                                                             class="img-fluid"/>
                                                    @else
                                                        <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="..."
                                                             class="img-fluid"/>
                                                    @endif
                                                </div>

                                                <div class="row" style="margin-top: 20px;">
                                                    <div class="col-sm-12 tags">
                                                        @if($user->apply_count > 0 && $user->verification_status == 0)
                                                            <a href="#" id="rejected" class="danger">Reject</a>
                                                            <a href="#" id="accepted" class="success">Accept</a>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-8">
                                                <div class="table-responsive-lg table-responsive-sm table-responsive-md table-responsive">
                                                    <table class="table table-bordered table-striped" id="users">

                                                        <tr>
                                                            <td>Bio</td>
                                                            <td>
                                                                <p class="">{{ $profile->bio }}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                <p class="">{{ $profile->address}}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Hobbis</td>
                                                            <td>
                                                                {{ $profile->hobbies }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                Intrests
                                                            </td>
                                                            <td>
                                                                {{ $profile->interests }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Languages</td>
                                                            <td>
                                                                {{ $profile->languages }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Religion</td>
                                                            <td>
                                                                {{ $profile->religion }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Favourite Quotations</td>
                                                            <td>
                                                                {{ $profile->quotations }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Favourite Movies</td>
                                                            <td>
                                                                {{ $profile->movies }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Favourite Music</td>
                                                            <td>
                                                                {{ $profile->music }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Favourite Books</td>
                                                            <td>

                                                                {{ $profile->books }}

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Favourite TV Shows</td>
                                                            <td>
                                                                {{ $profile->shows  }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end advanced profile tab-->


                </div>
            </div>
        </div>
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- Bootstrap WYSIHTML5 -->
    <script  src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#change-password').click(function (e) {
                e.preventDefault();
                var check = false;
                if ($('#password').val() ===""){
                    alert('Please Enter password');
                }
                else if  ($('#password').val() !== $('#password-confirm').val()) {
                    alert("confirm password should match with password");
                }
                else if  ($('#password').val() === $('#password-confirm').val()) {
                    check = true;
                }

                if(check == true){
                    var sendData =  '_token=' + $("input[name='_token']").val() +'&password=' + $('#password').val() +'&id=' + {{ $user->id }};
                    var path = "update_password";
                    $.ajax({
                        url: path,
                        type: "post",
                        data: sendData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                        },
                        success: function (data) {
                            $('#password, #password-confirm').val('');
                            alert('password reset successful');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert('error in password reset');
                        }
                    });
                }
            });
        });

        $(document).ready(function(){
            $("#rejected").click(function(){
                alert('You have rejected this user profile');
            });
        });

        $(document).ready(function(){
            $("#accepted").click(function(){
                var data = '_token=' + $("input[name='_token']").val() + '&id='+ {{ $user->id }}
                var url = 'acceptProfile';
                $.ajax({
                    url: 'url',
                    type: 'post',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    success: function (data) {
                        alert('you have accepted this user profile');

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert('error in profile acceptance');
                    }
                });
            });
        });

        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            e.target // newly activated tab
            e.relatedTarget // previous active tab
            $("#clothing-nav-content .tab-pane").removeClass("show active");
        });

    </script>

@stop
