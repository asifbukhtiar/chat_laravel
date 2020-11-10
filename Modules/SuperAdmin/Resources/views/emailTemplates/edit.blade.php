@extends('superadmin::layouts.default')

{{-- Web site Title --}}
@section('title')
    Email Templates
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
            Email Templates
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('superadmin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    @lang('general.dashboard')
                </a>
            </li>
            <li>templates</li>
            <li class="active">
                templates
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
                            Create Email Template
                        </h4>
                    </div>
                    <div class="card-body">

                        @if(session('error') || session('success'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                                {{ session('success') }}
                            </div>
                        @endif
                       {!! Form::model($temps, ['url' => URL::to('superadmin/emailTemps', $temps->id), 'method' => 'put', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                            <!-- CSRF Token -->

                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="row">
                                    <label for="title" class="col-sm-2 control-label">Template Title</label>
                                    <div class="col-sm-10">
                                        <input id="title" name="title" type="text" class="form-control"
                                               value="{!! old('title', $temps->title) !!}"/>
                                    </div>
                                    <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->
                            first('body', 'has-error') }}">
                                <label for="body" class="col-sm-2 control-label">Email Body</label>
                                <div class='box-body pad'>
                                    <textarea class="summernote" name="body">{{ $temps->body }}</textarea>
                                </div>
                                <div class="col-sm-4">
                                    {!! $errors->first('body', '<span class="help-block">:message</span> ') !!}
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <label for="logo" class="col-sm-2 control-label">Company Logo</label>
                                    <div class="col-sm-10">
                                        <input name="pic" type="file" class="form-control"
                                               value="{!! old('file', $temps->logo) !!}"/>
                                    </div>
                                    <span class="help-block">{{ $errors->first('logo', ':message') }}</span>
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