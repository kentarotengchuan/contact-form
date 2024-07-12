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
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <title>Document</title>
</head>

<body class="body">
    <header class="header">
        <div class="header__inner">
            <p class="header__ttl">FashionablyLate</p>
        </div>
    </header>
    <main>
        <div class="content">
            <h2 class="content__ttl">Contact</h2>
            <form action="/confirm" class="store-form" method="post">
            @csrf
                <div class="flex">
                    <p class="store-form__head">お名前<span class="red">※</span></p>
                    <div class="store-form__input">
                        <input type="text" name="last_name" class="name-form" placeholder="例:山田" value="{{old('last_name')}}">
                        <div class="space"></div>
                        <input type="text" name="first_name" class="name-form" placeholder="例:太郎" value="{{old('first_name')}}">
                    </div>  
                    <div class="error-messages">
                        @error('first_name')
                        <div class="space-before-error"></div>
                        <p class="error-text">{{$errors->first('first_name')}}</p>
                        @enderror
                        @error('last_name')
                        <div class="space-before-error"></div>
                        <p class="error-text">{{$errors->first('last_name')}}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex">
                    <p class="store-form__head">性別<span class="red">※</span></p>
                    <div class="store-form__input-gender">
                        <input type="radio" name="gender" id="gender-input" value=1 @if(old('gender')==1)checked @endif>
                        <label for="gender-input">男性</label>
                        <input type="radio" name="gender" id="gender-input" value=2 @if(old('gender')==2)checked @endif>
                        <label for="gender-input">女性</label>
                        <input type="radio" name="gender" id="gender-input" value=3 @if(old('gender')==3)checked @endif>
                        <label for="gender-input">その他</label>
                    </div>
                    <div class="error-messages">
                        @error('gender')
                        <div class="space-before-error"></div>
                        <p class="error-text">{{$errors->first('gender')}}</p>
                        @enderror
                    </div>    
                </div>
                <div class="flex">
                    <p class="store-form__head">メールアドレス<span class="red">※</span></p>
                    <div class="store-form__input">
                        <input type="email" name="email" class="email-form" placeholder="例:test@example.com" value="{{old('email')}}">
                    </div>
                    <div class="error-messages">
                        @error('email')
                        <div class="space-before-error"></div>
                        <p class="error-text">{{$errors->first('email')}}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex">
                    <p class="store-form__head">電話番号<span class="red">※</span></p>
                    <div class="store-form__input store-form__input-tell">
                        <input type="text" name="first_tell" value="{{old('first_tell')}}" placeholder="080">
                        <div class="hyphen">-</div>
                        <input type="text" name="second_tell" value="{{old('second_tell')}}" placeholder="1234">
                        <div class="hyphen">-</div>
                        <input type="text" name="third_tell" value="{{old('third_tell')}}" placeholder="5678">
                    </div>
                    @if($errors->has('first_tell')|$errors->has('second_tell')|$errors->has('third_tell'))
                    <div class="space-before-error"></div>
                    <div class="error-messages-tell">
                        <div class="error-message-tell">
                            @error('first_tell')                       
                            @foreach($errors->get('first_tell') as $error)
                            <p class="error-text">{{$error}}</p>
                            @endforeach
                            @enderror
                        </div>
                        <div class="error-message-tell">
                            @error('second_tell')
                            @foreach($errors->get('second_tell') as $error)
                            <p class="error-text">{{$error}}</p>
                            @endforeach
                            @enderror
                        </div>
                        <div class="error-message-tell">
                            @error('third_tell')
                            @foreach($errors->get('third_tell') as $error)
                            <p class="error-text">{{$error}}</p>
                            @endforeach
                            @enderror
                    </div>
                    </div>
                    @endif
                </div>
                <div class="flex">
                    <p class="store-form__head">住所<span class="red">※</span></p>
                    <div class="store-form__input">
                        <input type="text" name="address" class="address-form "placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{old('address')}}">
                    </div>                       
                    <div class="error-messages">
                        @error('address')
                        <div class="space-before-error"></div>
                        <p class="error-text">{{$errors->first('address')}}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex">
                    <p class="store-form__head">建物名</p>
                    <div class="store-form__input">
                        <input type="text" name="building" class="building-form" placeholder="例:千駄ヶ谷マンション101" value="{{old('building')}}">
                    </div>
                </div>
                <div class="flex">
                    <p class="store-form__head">お問い合わせの種類<span class="red">※</span></p>
                    <div class="store-form__input">
                    <?PHP $category=filter_input(INPUT_GET,"category_id");?>
                    <script>
                    document.addEventListener('formdata', (e)=>{
                    if(document.querySelector('[name=category_id]').value==""){
                        e.formData.delete('category_id');
                    }
                    });
                    </script>
                        <select name="category_id">
                            <option value='' selected>選択してください</option>
                            <option value=1 @if(old('category_id')==1)selected @endif>1. 商品のお届けについて</option>
                            <option value=2 @if(old('category_id')==2)selected @endif>2. 商品の交換について</option>
                            <option value=3 @if(old('category_id')==3)selected @endif>3. 商品トラブル</option>
                            <option value=4 @if(old('category_id')==4)selected @endif>4. ショップへのお問い合わせ</option>
                            <option value=5 @if(old('category_id')==5)selected @endif>5. その他</option>
                        </select>
                    </div>
                    <div class="error-messages">
                        @error('category_id')
                        <div class="space-before-error"></div>
                        <p class="error-text">{{$errors->first('category_id')}}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex">
                    <p class="store-form__head">お問い合わせ内容<span class="red">※</span></p>
                    <div class="store-form__input">
                        <textarea name="detail" cols="30" rows="10" placeholder="お問い合わせ内容をご記載ください">{{old('detail')}}</textarea>
                    </div>
                    <div class="error-messages">
                        @error('detail')
                        <div class="space-before-error"></div>
                        <p class="error-text">{{$errors->first('detail')}}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="store-form__button">確認画面</button>
            </form>
        </div>
    </main>
</body>

</html>