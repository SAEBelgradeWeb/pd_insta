@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row justify-content-center">
        <div class="col-md-6 mb-2">
            <div class="card">
                <div class="card-header">{{$post->user->name}}</div>

                <div class="card-body" style="background-image: url({{$post->image}})">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>

                <div class="card-footer">
                    @foreach($post->comments as $comment)
                        <div><em><small>{{$comment->created_at->diffForHumans()}}</small></em></div>
                        <div class="mb-2">
                            <strong>{{ $comment->user->name }}</strong> {{$comment->body}}
                        </div>
                    @endforeach

                    <div class="text-primary">
                        @foreach($post->tags as $tag)
                            #{{$tag->title}}&nbsp;
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
