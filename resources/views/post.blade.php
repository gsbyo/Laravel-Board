<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/post.css') }}" >
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset = "UTF-8">
        <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
        </script>
    <title>postPage</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body style="background-color: ghostwhite;">
        <div id="post-container">
            <div id="title-wrap">
                <div id="title-box">
                    <h2>
                        {{$post->title}}
                    </h2>
                </div>
                <div id="ex-box">
                    <span>
                        {{$post->user}}
                        {{$post->created_at}}
                    </span>
                </div>
            </div>
            <div id="content-box">
                <div>
                    {!! $post->content !!}
                </div>
            </div>
        </div>

        <div id="comment-container">
            <div id="comment-form">
                <div id="comment-area">
                    <textarea id="comment-input"></textarea>
                </div>
                <div class="button-wrap">
                    <button id="comment-button">댓글 작성</button>
                </div>
            </div>

            <div id="comment-box">
             <div id="h3-comment" style="padding: 10px;">
             <h3 style="padding: 10px;">Comments</h3>
            </div>
              @foreach ($comments as $comment)
              <div class="comment">
                <div class="comment-user">
                 <span>{{$comment->user}} {{$comment->created_at}}</span>
                </div>
                <div class="comment-content">
                 <span>{{ $comment->content }}</span>
               </div>
             </div>
              @endforeach
             {{-- <% for(var i = 0; i < comment.length; ++i){ %>
               <div class="comment">
                   <div class="comment-user">
                    <span><%= comment[i].user %> <%= comment[i].day %></span>
                   </div>
                   <div class="comment-content">
                    <span><%= comment[i].content %></span>
                  </div>
               </div>
               <% } %> --}}
               <div id="paging-box">

               </div>
            </div>
        </div>

        <script>
        var curPost = {{$post->id}}
        var totalComment = {{$count}}
        </script>

        <script src="{{asset('js/post.js')}}"></script>
</body>
</html>
