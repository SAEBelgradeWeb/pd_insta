@extends('layouts.app')

@section('content')

    <posts></posts>
    <div class="container">
        @auth
            <div class="row justify-content-center">
                <div class="col-md-6 mb-2">
                    <div class="card container">

                        <form action="/posts" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="post_image">Image</label>
                                <input type="file" name="post_image" id="post_image" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="content">Post content</label>
                                <textarea class="form-control" name="content" id="content"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Post</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        @endauth
        @foreach($posts as $post)
            <div class="row justify-content-center" id="post_{{$post->id}}">
                <div class="col-md-6 mb-2">
                    <div class="card">
                        <div class="card-header"><strong>{{$post->user->name}}</strong></div>

                        <div class="card-body" style="background-image: url({{  (substr($post->image, 0, 4) === "http") ? $post->image : asset('storage/' . $post->image) }})">
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
                            @auth
                                <form action="/comments" method="post">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <textarea name="body" id="body" class="form-control" placeholder="My comment..."></textarea>
                                    <button class="btn btn-primary">Send</button>
                                </form>
                            @endauth
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
