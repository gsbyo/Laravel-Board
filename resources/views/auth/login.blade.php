<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}" >
        <meta charset = "UTF-8">
        <title>loginPage</title>
    </head>
    <body>
     <div class="login-container">
        <h2 style="width: 100%">LOGIN</h2>
        <form action="{{route('login-user')}}", method="POST">
            @csrf
            <div class="input-box">
                   <input type="text" name="username" placeholder="아이디를 입력해주세요">
                </div>
               <div style="width: 100%">
               <span>@error('username'){{$message}}
               @enderror</span>
               </div>
               <div class="input-box">
                   <input type="password" name="password"  placeholder="비밀번호를 입력해주세요">
                </div>
               <div style="width: 100%">
                <span>@error('password'){{$message}}
                 @enderror</span>
               </div>
               <div class="input-box">
                @if(Session::has('fail'))
                <div style="width: 100%; color:red; font-size:10px">{{Session::get('fail')}}</div>
                @endif
               </div>
               <div id="button-box">
                <button type="submit" id="login-button">로그인</button>
               </div>
               <div id="button-box">
                <button type="button" id="naver-login-button" onClick="location.href='/auth/login/naver'">네이버 로그인</button>
               </div>
        </form>
     </div>
    </body>
</html>

