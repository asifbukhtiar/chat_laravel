@extends('chat::layouts.master')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-4" style="font-family: 'Agency FB'; font-weight: bold; font-size: 16pt;background-color: #25d366; border: 1px solid #EBF1F5;">
                @if($user->pic)
                    <img src="{{ $user->pic }}" alt="img"
                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                @elseif($user->gender === "male")
                    <img src="{{ asset('assets/images/authors/avatar3.png') }}" alt="..."
                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                @elseif($user->gender === "female")
                    <img src="{{ asset('assets/images/authors/avatar5.png') }}" alt="..."
                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                @else
                    <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="..."
                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                @endif
                {{ $user->username }}



            </div>



            <div class="col-4" style="font-family: 'Agency FB'; font-weight: bold;border: 1px solid #EBF1F5;">
                <h3 style="text-align: center; padding: 10px;">
                    {{ $user->username }}'s Friend's List
                </h3>
                @if(!$user->friends()->count())
                    <p style="text-align: center;">{{ $user->username }} has no friends</p>
                @else
                    <ul>
                    @foreach($user->friends() as $friends)
                            <li>
                                @if($user->pic)
                                    <img src="{{ $friends->pic }}" alt="img"
                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                @elseif($friends->gender === "male")
                                    <img src="{{ asset('assets/images/authors/avatar3.png') }}" alt="..."
                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                @elseif($friends->gender === "female")
                                    <img src="{{ asset('assets/images/authors/avatar5.png') }}" alt="..."
                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                @else
                                    <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="..."
                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                @endif
                                {{ $friends->first_name }}</li>
                        @endforeach
                    </ul>
                @endif


                @if(!$requests->count())
                    You have no friend requests
                    @else
                    <h4>Friend Requests</h4>
                    <ul>
                        @foreach($requests as $req)
                            <li>
                                @if($req->pic)
                                    <img src="{{ $req->pic }}" alt="img"
                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                @elseif($req->gender === "male")
                                    <img src="{{ asset('assets/images/authors/avatar3.png') }}" alt="..."
                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                @elseif($req->gender === "female")
                                    <img src="{{ asset('assets/images/authors/avatar5.png') }}" alt="..."
                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                @else
                                    <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="..."
                                         class="img-fluid" width="50" height="50" style="border-radius: 50%;"/>
                                @endif
                                {{ $req->first_name }}</li>
                            <a href="{{ route('chat.request', $req->id) }}" class="btn btn-primary">Accept Friend Request</a>
                        @endforeach
                    </ul>
                @endif

            </div>

        </div>

    </div>

@endsection