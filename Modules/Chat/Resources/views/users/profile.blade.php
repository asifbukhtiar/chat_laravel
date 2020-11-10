@extends('chat::layouts.master')

@section('content')
            <!--section ends-->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    User Profile
                                                </h3>
                                            </div>



                                            <div class="panel-body">
                                                <div class="col-md-4">
                                                    <div class="text-center">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail img-file">
                                                                @if($profile->pic)
                                                                    <img src="{{ $profile->pic }}" alt="img"
                                                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                                                @elseif($profile->gender === "male")
                                                                    <img src="{{ asset('assets/images/authors/avatar3.png') }}" alt="..."
                                                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                                                @elseif($profile->gender === "female")
                                                                    <img src="{{ asset('assets/images/authors/avatar5.png') }}" alt="..."
                                                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                                                @else
                                                                    <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="..."
                                                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                                                @endif
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">

                                                            <table class="table table-bordered table-striped" id="users">
                                                                <tr>
                                                                    <td>First Name</td>
                                                                    <td>
                                                                        {{ $profile->first_name }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Last Name</td>
                                                                    <td>
                                                                        {{ $profile->last_name }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Username</td>
                                                                    <td>
                                                                        {{ $profile->username }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Address</td>
                                                                    <td>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Status</td>
                                                                    <td>
                                                                        <a href="#" id="status" data-type="select" data-pk="1" data-value="1" data-title="Status"></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Created At</td>
                                                                    <td>
                                                                        1 month ago
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>City</td>
                                                                    <td>
                                                                        <a href="#" data-pk="1" class="editable" data-title="Edit City">Nakia</a>
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

                </div>
            </section>
            <!-- content -->

    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>

    @endsection
