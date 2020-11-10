@extends('superadmin::layouts.default')
        {{-- Page title --}}
@section('title')
    Create User
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}"  rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Add New User</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/superadmin/dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#"> Users</a></li>
            <li class="active">Add New User</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 my-3">
                <div class="card panel-primary">
                    <div class="card-heading">
                        <h3 class="card-title">
                            <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff" data-loop="true"></i>
                            Add New User
                        </h3>
                        <span class="float-right clickable">
                                    <i class="fa fa-chevron-up"></i>
                                </span>
                    </div>
                    <div class="card-body">
                        <!--main content-->
                        <form id="commentForm" action="{{ route('create.users') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="rootwizard">
                                <ul>
                                    <li class="nav-item"><a href="#tab1" data-toggle="tab" class="nav-link">User Profile</a></li>
                                    <li class="nav-item"><a href="#tab2" data-toggle="tab" class="nav-link ml-2">User Role</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane " id="tab1">
                                        <h2 class="hidden">&nbsp;</h2>
                                        <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                                            <div class="row">
                                                <label for="first_name" class="col-sm-2 control-label">First Name *</label>
                                                <div class="col-sm-10">
                                                    <input id="first_name" name="first_name" type="text"
                                                           placeholder="First Name" class="form-control required"
                                                           value="{!! old('first_name') !!}"/>

                                                    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                                            <div class="row">                                            <label for="last_name" class="col-sm-2 control-label">Last Name *</label>
                                                <div class="col-sm-10">
                                                    <input id="last_name" name="last_name" type="text" placeholder="Last Name"
                                                           class="form-control required" value="{!! old('last_name') !!}"/>

                                                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('username', 'has-error') }}">
                                            <div class="row">
                                                <label for="username" class="col-sm-2 control-label">Username *</label>
                                                <div class="col-sm-10">
                                                    <input id="username" name="username" type="text" placeholder="Username"
                                                           class="form-control required" value="{!! old('username') !!}"/>

                                                    {!! $errors->first('username', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group {{ $errors->first('email', 'has-error') }}">
                                            <div class="row">
                                                <label for="email" class="col-sm-2 control-label">Email *</label>
                                                <div class="col-sm-10">
                                                    <input id="email" name="email" placeholder="E-mail" type="text"
                                                           class="form-control required email" value="{!! old('email') !!}"/>
                                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('password', 'has-error') }}">
                                            <div class="row">
                                                <label for="password" class="col-sm-2 control-label">Password *</label>
                                                <div class="col-sm-10">
                                                    <input id="password" name="password" type="password" placeholder="Password"
                                                           class="form-control required" value="{!! old('password') !!}"/>
                                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                                            <div class="row">
                                                <label for="password_confirm" class="col-sm-2 control-label">Confirm Password *</label>
                                                <div class="col-sm-10">
                                                    <input id="password_confirm" name="password_confirm" type="password"
                                                           placeholder="Confirm Password " class="form-control required"/>
                                                    {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                                            <div class="row">
                                                <label for="email" class="col-sm-2 control-label">Gender *</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" title="Select Gender..." name="gender">
                                                        <option value="">Select</option>
                                                        <option value="male"
                                                                @if(old('gender') === 'male') selected="selected" @endif >Male
                                                        </option>
                                                        <option value="female"
                                                                @if(old('gender') === 'female') selected="selected" @endif >
                                                            Female
                                                        </option>
                                                        <option value="other"
                                                                @if(old('gender') === 'other') selected="selected" @endif >Other
                                                        </option>

                                                    </select>
                                                </div>
                                                <span class="help-block">{{ $errors->first('gender', ':message') }}</span>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="tab-pane" id="tab2" disabled="disabled">
                                        <p class="text-danger"><strong>Be careful with group selection, if you give admin access.. they can access admin section</strong></p>

                                        <div class="form-group required">
                                            <div class="row">
                                                <label for="group" class="col-sm-2 control-label">Group *</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control required" title="Select group..." name="group"
                                                            id="group">
                                                        <option value="">Select</option>
                                                        @foreach($groups as $group)
                                                            <option value="{{ $group->id }}"
                                                                    @if($group->id == old('group')) selected="selected" @endif >{{ $group->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    {!! $errors->first('group', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <span class="help-block">{{ $errors->first('group', ':message') }}</span>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label for="activate" class="col-sm-2 control-label"> Activate User *</label>
                                                <div class="col-sm-10">
                                                    <input id="activate" name="activate" type="checkbox"
                                                           class="pos-rel p-l-30 custom-checkbox"
                                                           value="1" @if(old('activate')) checked="checked" @endif >
                                                    <span>To activate user account automatically, click the check box</span></div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="ml-auto col-sm-10">
                                                <div class="g-recaptcha" data-sitekey="#"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="pager wizard">
                                        <li class="previous"><a href="#">Previous</a></li>
                                        <li class="next"><a href="#">Next</a></li>
                                        <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--row end-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"  type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/adduser.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#username").change(function(){
                var username = $("#username").val();
                var sendData =  '_token=' + $("input[name='_token']").val() +'&username=' + username;
                var path = "checkUsername";
                $.ajax({
                    url: path,
                    type: "post",
                    data: sendData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                    },
                    success: function (data) {
                        if(data == ""){
                            alert('username available');
                        }else{
                            alert('username exists chose another');
                        }

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert('error in checking');
                    }
                });
            });
        });

    </script>
@stop
