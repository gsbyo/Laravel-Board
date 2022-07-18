<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/board.css') }}" >
        <meta charset = "UTF-8">
        <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
        </script>
        <title>boardPage</title>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <h1 style="text-align: center">게시판</h1>

        @if(Session::get('loginId'))
        <div class="user-box">
            <p><span style="margin-right: 40px">{{Session::get('loginUsername')}}님 안녕하세요</span><a href="/logout">로그아웃</a></p>
        </div>
        @else
        <div class="user-box">
            <a href="/login">로그인</a>
        </div>
        @endif

        <body style="background-color: gainsboro;">
            <div id="board-container">
                <table>
                   <tr id="t-header">
                        <td>번호</td>
                        <td>제목</td>
                        <td>작성자</td>
                        <td>날짜</td>
                    </tr>
                      @foreach ($posts as $post)
                        <tr class="post-box">
                          <td class="post-id">{{$post->id}}</td>
                          <td>{{$post->title}}</td>
                          <td>{{$post->user}}</td>
                          <td>{{$post->created_at}}</td>
                        </tr>
                      @endforeach
                </table>
            </div>
            <div id="paging-box">

            </div>
            <div class="button-wrap">
                <select id="search-option">
                    <option value="0">제목</option>
                    <option value="1">내용</option>
                    <option value="2">제목+내용</option>
                </select>
                <input type="text" id="search-input" placeholder="검색어를 입력해주세요">
                <button type="button" id="search-button">검색</button>
                <button type="button" onclick="location.href='/board/write/post';">글쓰기</button>
            </div>

            <script>var totalCount = {{$count}}</script>
            <script src="{{asset('js/search.js')}}"></script>

    </body>
</html>
