@extends('superadmin::layouts.default')

{{-- Page title --}}
@section('title')
    Templates List
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
        <h1>Email Templates</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#"> templates</a></li>
            <li class="active">templates list</li>
        </ol>
    </section>
    <div class="row my-3" >
        <div class="col-12 mx-auto">
            <div id="notific">
                @if (session('success'))
                    <div class="alert alert-info">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="col-12">
                <div class="card panel-primary ">
                    <div class="card-heading">
                        <h4 class="card-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Email Templates List
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-lg table-responsive-sm table-responsive-md">
                            <table class="table table-bordered width100" id="table">
                                <thead>
                                <tr class="filters">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Body</th>
                                    <th>Logo</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $temps)
                                    <tr>
                                        <td>{{ $temps->id }}</td>
                                        <td>{{ $temps->title }}</td>
                                        <td>{{ $temps->body }}</td>
                                        <td><img src="{{ $temps->logo }}" width="100" height="100"></td>
                                        <td>
                                            <a href="{{ route('emailTemps.edit', $temps->id) }}"><i class="livicon" data-name="edit" data-c="#6CC66C" data-hc="#6CC66C" data-size="18"></i></a>
                                            <a href="{{ route('emailTemps.confirm-delete', $temps->id) }}"><i class="livicon" data-name="trash" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18"></i></a>
                                        </td>
                                    </tr>
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
