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

                </div>
        </div>

        <div class="card my-5">
            <div class="card-header">
                Add a reply
            </div>
            <div class="card-body">

                @auth
                    <form action="{{route('replies.store',$discussion->slug)}}" method='POST'>
                        @csrf
                        <input type="hidden" name='reply' id='reply' >
                        <trix-editor input='reply'></trix-editor>
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
