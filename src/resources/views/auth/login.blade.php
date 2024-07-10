<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <p class="header__ttl">FashionablyLate</p>
            <form action="/register" class="register-form" method="get">
                <button type="submit" class="register-form__button">register</button>
            </form>
        </div>
    </header>
    <main>
        <div class="content">
            <h2 class="content__ttl">Login</h2>
            <div class="form-area">
                <form action="/login" class="login-form" method="post">
                    @csrf
                    <label for="email-input">メールアドレス</label>
                    <input type="email" name="email" id="email-input" placeholder="例:test@example.com">
                    @error('email')
                    <div class="error-messages">
                        {{$errors->first('email')}}
                    </div>
                    @enderror
                    <label for="password-input">パスワード</label>
                    <input type="password" name="password" id="password-input" placeholder="例:coachtech1106">
                    @error('password')
                    <div class="error-messages" style="width:100%">
                        {{$errors->first('password')}}
                    </div>
                    @enderror
                    <button type="submit" class="login-form__button">ログイン</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>