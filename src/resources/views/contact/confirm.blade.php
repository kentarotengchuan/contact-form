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
            <h2 class="content__ttl">Confirm</h2>
            <table class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>{{$contact["last_name"]}}&emsp;{{$contact["first_name"]}}</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                    @switch($contact["gender"])
                        @case(1)
                            男性
                            @break
                        @case(2)
                            女性
                            @break
                        @default
                            その他
                    @endswitch
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{$contact["email"]}}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{$contact["first_tell"]}}{{$contact["second_tell"]}}{{$contact["third_tell"]}}</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{$contact["address"]}}</td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>{{$contact["building"]}}</td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>
                    @switch($contact["category_id"])
                        @case(1)
                        1. 商品のお届けについて
                        @break
                        @case(2)
                        2. 商品の交換について
                        @break
                        @case(3)
                        3. 商品トラブル
                        @break
                        @case(4)
                        4. ショップへのお問い合わせ
                        @break
                        @case(5)
                        5. その他
                        @break
                    @endswitch
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>{{$contact["detail"]}}</td>
                </tr>
            </table>
            <div class="buttons">
                <form action="{{route('regist')}}" method="post">
                @csrf
                    <input type="hidden" name="first_name" value="{{$contact["first_name"]}}">
                    <input type="hidden" name="last_name" value="{{$contact["last_name"]}}">
                    <input type="hidden" name="gender" value="{{$contact["gender"]}}">
                    <input type="hidden" name="email" value="{{$contact["email"]}}">
                    <input type="hidden" name="first_tell" value="{{$contact["first_tell"]}}">
                    <input type="hidden" name="second_tell" value="{{$contact["second_tell"]}}">
                    <input type="hidden" name="third_tell" value="{{$contact["third_tell"]}}">
                    <input type="hidden" name="address" value="{{$contact["address"]}}">
                    <input type="hidden" name="building" value="{{$contact["building"]}}">
                    <input type="hidden" name="category_id" value={{$contact["category_id"]}}>
                    <input type="hidden" name="detail" value="{{$contact["detail"]}}">
                    <button type="submit" class="confirm-form__button">送信</button>
                </form>
                <a href="" onclick="history.back()">修正</a>
            </div>
        </div>
    </main>
</body>

</html>