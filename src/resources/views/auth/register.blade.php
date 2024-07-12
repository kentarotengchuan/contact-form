<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Serif:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
    <title>Document</title>
</head>
<body class="body">
    <header class="header">
        <div class="header__inner">
            <h1 class="header__ttl">FashionablyLate</h1>
            <form action="/login" class="login-form" method="get">
                <button type="submit" class="login-form__button">login</button>
            </form>
        </div>
    </header>
    <main>
        <div class="content">
            <h2 class="content__ttl">Register</h2>
            <div class="form-area">
                <div class="form__inner">
                <form action="/register" class="register-form" method="post">
                    @csrf
                    <label for="name-input">お名前</label>
                    <input type="text" name="name" id="name-input" placeholder="例:山田  太郎">
                    <div class="error-messages">
                    @error('name')
                        {{$errors->first('name')}}
                    @enderror
                    </div>
                    <label for="email-input">メールアドレス</label>
                    <input type="email" name="email" id="email-input" placeholder="例:test@example.com">
                    <div class="error-messages">
                    @error('email')
                        {{$errors->first('email')}}
                    @enderror
                    </div>
                    <label for="password-input">パスワード</label>
                    <input type="password" name="password" id="password-input" placeholder="例:coachtech1106"> 
                    <div class="error-messages">
                    @error('password')
                        {{$errors->first('password')}}
                    @enderror
                    </div>
                    <div class="register-form__button">
                        <button type="submit" class="button">登録</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </main>
</body>
</html>