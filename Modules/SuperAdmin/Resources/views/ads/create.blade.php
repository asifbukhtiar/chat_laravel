@extends('superadmin::layouts.default')

{{-- Web site Title --}}
@section('title')
    Create Ads
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/summernote/css/summernote.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" />
@stop

{{-- Content --}}
@section('content')
    <section class="content-header">
        <h1>
            Ads Management
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('superadmin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    @lang('general.dashboard')
                </a>
            </li>
            <li>ads</li>
            <li class="active">
                ads
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card panel-primary ">
                    <div class="card-heading">
                        <h4 class="card-title"> <i class="livicon" data-name="users-add" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            create ads
                        </h4>
                    </div>
                    <div class="card-body">
                        {!! $errors->first('name', '<span class="help-block">Another chatroom with same name exists, please choose another name</span> ') !!}
                        @if(session('error') || session('success'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="post" action="{{ route('ads.store') }}">
                            <!-- CSRF Token -->

                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->
                            first('ad', 'has-error') }}">
                                <label for="ad" class="col-sm-2 control-label">Ad Code</label>
                                <div class='box-body pad'>
                                    <textarea class="summernote" name="ad"></textarea>
                                </div>
                                <div class="col-sm-4">
                                    {!! $errors->first('ad', '<span class="help-block">:message</span> ') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label for="visibility" class="col-sm-2 control-label">Visibility</label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control">
                                            <option value="">Select Form Status</option>
                                            <option value="1">Visible</option>
                                            <option value="0">Hide</option>
                                        </select>
                                    </div>
                                    <span class="help-block">{{ $errors->first('visibility', ':message') }}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <a class="btn btn-danger" href="#">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/summernote/js/summernote.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}" ></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
            });
        });
    </script>
@stop