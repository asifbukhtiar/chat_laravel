@extends('superadmin::layouts.default')

{{-- Web site Title --}}
@section('title')
    @lang('groups/title.edit')
    @parent
@stop

{{-- Content --}}
@section('content')
    <section class="content-header">
        <h1>
            @lang('groups/title.edit')
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('superadmin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    @lang('general.dashboard')
                </a>
            </li>
            <li>@lang('groups/title.groups')</li>
            <li class="active">@lang('groups/title.edit')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card panel-primary ">
                    <div class="card-heading">
                        <h4 class="card-title"> <i class="livicon" data-name="wrench" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            @lang('groups/title.edit')
                        </h4>
                    </div>
                    <div class="card-body">
                    @if($roles)
                        {!! Form::model($roles, ['url' => URL::to('superadmin/roles/'. $roles->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}

                        <!-- CSRF Token -->
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->
                                first('name', 'has-error') }}">
                                <div class="row">
                                    <label for="title" class="col-sm-2 control-label">
                                        @lang('groups/form.name')
                                    </label>
                                    <div class="col-sm-5">
                                        <input type="text" id="name" name="name" class="form-control"
                                               placeholder=@lang('groups/form.name') value="{!! old('name', $roles->
                                    name) !!}">
                                    </div>
                                    <div class="col-sm-4">
                                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="slug" class="col-sm-2 control-label">@lang('groups/form.slug')</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" value="{!! $roles->slug !!}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="offset-sm-2 col-sm-4">
                                        <a class="btn btn-danger" href="#">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        @else
                            <h1>@lang('groups/message.error.no_role_exists')</h1>
                            <a class="btn btn-danger" href="#">
                                Back
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- row-->
    </section>

@stop
