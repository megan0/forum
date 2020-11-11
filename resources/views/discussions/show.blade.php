@extends('layouts.app')

@section('content')

        <div class="card">
                @include('partials.discussion-header')

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center">
                        <strong >{{ $discussion->title }}</strong>
                    </div>

                    <hr>

                    {!!$discussion->content!!}

                    @if($discussion->bestReply)
                        <div class="card bg-success">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <img src="{{ Gravatar::src($discussion->bestReply->user->email)}}" width='40px' height='40px' style='border-radius:50%' alt="">
                                        <strong>{{$discussion->bestReply->user->name}}</strong>
                                    </div>
                                    <div>
                                        <strong>Best Reply</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {!!$discussion->bestReply->content!!}
                            </div>
                        </div>    
                    @endif

                </div>
        </div>

        @foreach($discussion->replies()->orderBy('created_at','desc')->simplePaginate(3) as $reply)
            <div class="card my-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <img src="{{ Gravatar::src($reply->user->email)}}" width='40px' height='40px' style='border-radius:50%' alt="">
                            <span>{{$reply->user->name}}</span>
                        </div>
                        <div>
                            @auth
                                @if(auth()->user()->id==$discussion->user_id)
                                    <form action="{{route('best.reply', ['discussion'=>$discussion->slug,'reply'=>$reply->id])}}" method='POST'>
                                        @csrf
                                        <button type='submit'>Mark as best reply</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p>
                        {!!$reply->content!!}

                    </p>
                </div>
            </div>
        @endforeach
        {{$discussion->replies()->simplePaginate(3)->links()}}


        <div class="card my-5">
            <div class="card-header">
                Add a reply
            </div>
            <div class="card-body">

                @auth
                    <form action="{{route('reply.store', $discussion->slug)}}" method='POST'>
                        @csrf
                        <input type="hidden" name='content' id='content' >
                        <trix-editor input='content'></trix-editor>
                        <button type='submit' class="btn btn-success btn-sm my-2">Add a reply</button>
                    </form>
                @else
                    <a href="{{route('login')}}" class="btn btn-info">Sign in to add a reply</a>
                @endauth

            </div>
        </div>

{{$discussion->links}}
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css">
@endsection

@section('js')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js'></script>
@endsection
