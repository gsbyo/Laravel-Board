<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/write.css') }}" >
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>writePage</title>
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
        </script>

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- include summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    </head>
    <body>

    <div id="write-container">
        <h3 style="padding: 10px;">글쓰기</h3>
        <form method="post" action="/board/write/post" id="write-form">
            @csrf
            <div class="input-box">
                <span>제목 : </span><input type="text" name="title">
            </div>
            <div class="input-box">
                <textarea id="summernote" name="content"></textarea>
            </div>
        </form>
        <div class="button-wrap">
            <button id="sub-button">작성하기</button>
        </div>
    </div>


    <script src="{{asset('js/write.js')}}"></script>

    </body>
</html>
