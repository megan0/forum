@extends('layouts.app')

@section('content')



@foreach($discussions as $discussion)
        <div class="card mb-4">
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
                </div>
        </div>
@endforeach
<!-- @if(!$discussions->isEmpty()) -->
{{$discussions->appends(['channel'=>request()->query('channel')])->links()}}
<!-- @endif -->
@endsection
