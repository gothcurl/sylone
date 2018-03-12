@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
                
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

                                <ul class="nav nav-pills">
                                    <li role="presentation">
                                        <a href='{{ url("/like/{$post->id}") }}'>
                                            <span class="fas fa-thumbs-up"> LIKE ()</span>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href='{{ url("/dislike/{$post->id}") }}'>
                                            <span class="fas fa-thumbs-down"> DISLIKE ()</span>
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
                                    <li role="presentation">
                                        <a href='{{ url("/comment/{$post->id}") }}'>
                                            <span class="fas fa-comment-alt"> COMMENT</span>
                                        </a>
                                    </li>
                                </ul>

                                
                            @endforeach
                        @else
                            <h3>No Posts Available</h3>
                        @endif     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
