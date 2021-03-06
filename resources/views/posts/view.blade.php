@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
                @if(session('response'))
                    <div class="alert alert-success">{{session('response')}}</div>
                @endif
            <div class="panel panel-default">
                <div class="panel-heading">Post View</div>

                <div class="panel-body">
                <div class="col-md-4">
                <ul class="list-group">
                    @if(count($categories) > 0)
                        @foreach($categories->all() as $category)
                            <li class="list-group-item"><a href='{{url ("category/{$category->id}") }}'>{{$category->category}}</a></li>
                        @endforeach
                    @else
                        <p>No Category Found!</p>
                    @endif
                    
                </ul>
                    
                </div>
                    <div class="col-md-8">
                        @if(count($posts) > 0)
                            @foreach($posts->all() as $post)
                                <center><h4><b>{{$post->post_title}}</b></h4></center>
                                <center><img src="{{ $post->post_image }}" alt="" width="400" height="300"></center>
                                <p></p>
                                <center><p>{{ ($post->post_body) }}</p></center>

                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-secondary ">
                                        <span class="fas fa-thumbs-up"><input type="radio" name="options" id="option1" autocomplete="off"> Like
                                    </label></span>
                                    <label class="btn btn-outline-secondary">
                                        <span class="fas fa-thumbs-down">
                                        <input type="radio" class="fas fa-thumbs-down" name="options" id="option2" autocomplete="off"> Dislike
                                    </label></span>
                                    <label class="btn btn-outline-secondary">
                                        <span class="fas fa-heart">
                                        <input type="radio" class="fas fa-thumbs-down" name="options" id="option2" autocomplete="off"> Love
                                    </label></span>
                                    <label class="btn btn-outline-secondary">
                                        <span class="fas fa-smile">
                                        <input type="radio" class="fas fa-thumbs-down" name="options" id="option2" autocomplete="off"> Happy
                                    </label></span>
                                    <label class="btn btn-outline-secondaryy">
                                        <span class="fas fa-frown">
                                        <input type="radio" class="fas fa-thumbs-down" name="options" id="option2" autocomplete="off"> Sad
                                    </label></span>
                                </div>

                            <!--    <ul class="nav nav-pills">
                                    <li role="presentation">
                                        <a href='{{ url("/like/{$post->id}") }}'>
                                            <span class="fas fa-thumbs-up"> LIKE ()</span>
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href='{{ url("/happy/{$post->id}") }}'>
                                            <span class="fas fa-thumbs-down"> DISLIKE ()</span>
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href='{{ url("/love/{$post->id}") }}'>
                                            <span class="fas fa-heart"> LOVE ()</span>
                                        </a>
                                    </li> 

                                    <li role="presentation">
                                        <a href='{{ url("/happy/{$post->id}") }}'>
                                            <span class="fas fa-smile"> HAPPY ()</span>
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href='{{ url("/sad/{$post->id}") }}'>
                                            <span class="fas fa-frown"> SAD ()</span>
                                        </a>
                                    </li>
                                    
                                </ul> -->

                                
                            @endforeach
                        @else
                            <h3>No Posts Available</h3>
                        @endif

                        <form method="POST" action='{{ url("/comment/{$post->id}") }}'>
                        {{csrf_field()}}
                            <div class="form-group">
                                <textarea id="comment" rows="6" class="form-control" name="comment" required autofocus></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-lg btn-block">POST COMMENT</button>
                            </div>
                        </form>

                        <h4><b>Comments:</b></h4>
                        @if(count($comments) > 0)
                            @foreach($comments->all() as $comment)
                                <p>{{ $comment->comment }}</p>
                                <p>Posted by: {{ $comment->name }}</p>
                                <hr/>
                            @endforeach
                        @else
                            <h3>No Comments Available</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
