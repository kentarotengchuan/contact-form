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
        </div>
    </header>
    <main>
        <div class="content">
            <h2 class="content__ttl">Contact</h2>
                <form action="/" class="store-form" method="post">
                    @csrf
                    <div class="flex">
                        <p class="store-form__head" style="width:33%">お名前<span class="red">※</span></p>
                        <div class="store-form__input" style="width:66%">
                            <input type="text" name="last_name" placeholder="例:山田" value="{{old('last_name')}}">
                            <input type="text" name="first_name" placeholder="例:太郎" value="{{old('first_name')}}">
                        </div>
                    </div>
                    <div class="flex">
                        <p class="store-form__head">性別<span class="red">※</span></p>
                        <div class="store-form__input">
                            <input type="radio" name="gender" id="gender-input" value=1 @if(old('gender')==1)checked @endif>
                            <label for="gender-input">男性</label>
                            <input type="radio" name="gender" id="gender-input" value=2 @if(old('gender')==2)checked @endif>
                            <label for="gender-input">女性</label>
                            <input type="radio" name="gender" id="gender-input" value=3 @if(old('gender')==3)checked @endif>
                            <label for="gender-input">その他</label>
                        </div>
                    </div>
                    <div class="flex">
                        <p class="store-form__head">メールアドレス<span class="red">※</span></p>
                        <div class="store-form__input">
                            <input type="email" name="email" placeholder="例:test@example.com" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="flex">
                        <p class="store-form__head">電話番号<span class="red">※</span></p>
                        <div class="store-form__input">
                            <input type="text" name="first_tell" value="{{old('first_tell')}}">
                            <div class="hyphen">-</div>
                            <input type="text" name="second_tell" value="{{old('second_tell')}}">
                            <div class="hyphen">-</div>
                            <input type="text" name="third_tell" value="{{old('third_tell')}}">
                        </div>
                    </div>
                    <div class="flex">
                        <p class="store-form__head">住所<span class="red">※</span></p>
                        <div class="store-form__input">
                            <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{old('address')}}">
                        </div>
                    </div>
                    <div class="flex">
                        <p class="store-form__head">建物名</p>
                        <div class="store-form__input">
                            <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{old('building')}}">
                        </div>
                    </div>
                    <div class="flex">
                        <p class="store-form__head">お問い合わせの種類<span class="red">※</span></p>
                        <div class="store-form__input">
                            <select name="category_id">
                                <option value=1 @if(old('category_id')==1)selected @endif>1. 商品のお届けについて</option>
                                <option value=2 @if(old('category_id')==2)selected @endif>2. 商品の交換について</option>
                                <option value=3 @if(old('category_id')==3)selected @endif>3. 商品トラブル</option>
                                <option value=4 @if(old('category_id')==4)selected @endif>4. ショップへのお問い合わせ</option>
                                <option value=5 @if(old('category_id')==5)selected @endif>5. その他</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex">
                        <p class="store-form__head">お問い合わせ内容<span class="red">※</span></p>
                        <div class="store-form__input">
                            <textarea name="detail" cols="30" rows="10" placeholder="お問い合わせ内容をご記載ください">{{old('detail')}}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="strore-form__button">確認画面</button>
                </form>
        </div>
    </main>
</body>

</html>