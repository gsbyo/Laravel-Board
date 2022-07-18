<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/registeration.css') }}" >
        <meta charset = "UTF-8">
        <title>registrationPage</title>
    </head>
    <body>
            <div class="registeration-container">
                <h2 style="width: 100%">회원가입</h2>
                <form action="{{ route('register-user') }}", method="POST">
                    @csrf
                    <div class="input-box">
                        <div class="input-wrap">
                            <div style="width: 30%; text-align:left;">
                           <label>이름</label>
                       </div>
                       <div style="width: 70%">
                           <input type="text" name="name">
                       </div>
                        </div>
                       <div style="width: 100%">
                       <span>@error('username') {{$message}}
                       @enderror</span>
                       </div>
                       </div>
                       <div class="input-box">
                        <div class="input-wrap">
                            <div style="width: 30%; text-align:left;">
                           <label>아이디</label>
                       </div>
                       <div style="width: 70%">
                           <input type="text" name="username">
                       </div>
                        </div>
                        <div style="width: 100%">
                            <span>@error('password') {{$message}}
                             @enderror</span>
                           </div>
                       </div>
                       <div class="input-box">
                        <div class="input-wrap">
                       <div style="width: 30%; text-align:left;">
                           <label>비밀번호</label>
                       </div>
                       <div style="width: 70%">
                           <input type="password" name="password">
                       </div>
                        </div>
                        <div style="width: 100%">
                            <span>@error('password') {{$message}}
                             @enderror</span>
                           </div>
                       </div>
                       <div class="input-box">
                        <div class="input-wrap">
                            <div style="width: 30%; text-align:left;">
                           <label>e-mail</label>
                       </div>
                       <div style="width: 70%">
                           <input type="email" name="email">
                       </div>
                        </div>
                        <div style="width: 100%">
                            <span>@error('password') {{$message}}
                             @enderror</span>
                           </div>
                       </div>
                <div class="line"></div>
                <div id="button-box">
                    <button type="submit">가입하기</button>
                </div>
                @if(Session::has('success'))
                <div>{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                <div>{{Session::get('fail')}}</div>
                @endif
            </form>
            </div>
    </body>
</html>

