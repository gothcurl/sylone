@extends('layouts.app')
<style type="text/css">
    .avatar{
        border-radius: 100%;
        max-width: 100px;
    }
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                @endif

                @if(session('response'))
                    <div class="alert alert-success">{{session('response')}}</div>
                @endif
            <div class="panel panel-default ">
                <div class="panel-heading">
                <div class="row"> 
                <div class="col-md-4" align="left"><h3>Dashboard</h3></div>
                    <div class="col-lg-8">
                    <form method="POST" action='{{ url("/search") }}'>
                    {{ csrf_field() }}
                            <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="...">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        Search
                                    </button>
                                </span>
                            </div>
                            </form>
                        </div>
                    </div>
                    </div>
            

                <div class="panel-body">
                <div class="col-md-4">
                @if(!empty($profile))
                    <img src="{{ $profile -> profile_pic }}" class="avatar" alt="" width="200" height="200">
                @else
                    <img src="{{ url('images/avatar.jpg') }}" class="avatar" alt="" width="200" height="200">
                @endif

                @if(!empty($profile))
                    <p class="lead"><b>{{ $profile -> name }}</b></p>
                @else
                    <p></p>
                @endif

                @if(!empty($profile))
                    <p><i>{{ $profile -> designation }}</i></p>
                @else
                    <p></p>
                @endif
                    
                </div>
                    <div class="col-md-8">
                        @if(count($posts) > 0)
                            @foreach($posts->all() as $post)
                                <center><h4><b>{{$post->post_title}}</b></h4></center>
                                <center><img src="{{ $post->post_image }}" alt="" width="400" height="300"></center>
                                <p></p>
                                <center><p>{{ substr($post->post_body, 0, 150) }}</p></center>

                                <ul class="nav nav-pills">
                                    <li role="presentation">
                                        <a href='{{ url("/view/{$post->id}") }}'>
                                            <span class="fas fa-eye"> VIEW</span>
                                        </a>
                                    </li>
                                    @if(Auth::id() == 1)
                                    <li role="presentation">
                                        <a href='{{ url("/edit/{$post->id}") }}'>
                                            <span class="fas fa-edit"> EDIT</span>
                                        </a>
                                    </li>

                                    <li role="presentation">
                                        <a href='{{ url("/delete/{$post->id}") }}'>
                                            <span class="fas fa-trash-alt"> DELETE</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                                <cite style="float:left">Posted on: {{date('M j, Y H:i', strtotime($post->updated_at))}} </cite>
                                <hr/>
                            @endforeach
                        @else
                            <h3>No Posts Available</h3>
                        @endif

                        <center>{{$posts->links()}}</center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
