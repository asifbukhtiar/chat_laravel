@extends('superadmin::layouts.default')

{{-- Page title --}}
@section('title')
    Auto Chat
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap4.css') }}" />
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop


{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>Auto Chat Post</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#"> autochat</a></li>
            <li class="active">autochat list</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content paddingleft_right15">

        <div class="row">
            <div class="col-12">
                <div class="card panel-primary ">
                    <div class="card-heading">
                        <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Auto Chat Post
                        </h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-danger">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive-lg table-responsive-sm table-responsive-md">
                            <table class="table table-bordered width100" id="table">
                                <thead>
                                <tr class="filters">
                                    <th>ChatRoom</th>
                                    <th>Ad Code</th>
                                    <th>Occurence</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $ad)
                                    @if(!empty($ad->autochat[0]))
                                <tr>

                                    <td>{{ $ad->name }}</td>

                                    <td>
                                        {{ $ad->autochat[0]->html_code }}</td>
                                    <td>{{ $ad->autochat[0]->occurence }}</td>
                                    <td>
                                        <a href="{{ route('autochat.edit', $ad->autochat[0]->id) }}"><i class="livicon" data-name="edit" data-c="#6CC66C" data-hc="#6CC66C" data-size="18"></i></a>
                                        <a href="{{ route('autochat.confirm-delete', $ad->autochat[0]->id) }}"><i class="livicon" data-name="trash" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18"></i></a>
                                    </td>

                                </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row-->
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap4.js') }}" ></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@stop
