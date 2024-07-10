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
            <form action="/logout" class="logout-form" method="post">
            @csrf
                <button type="submit" class="logout-form__button">logout</button>
            </form>
        </div>
    </header>
    <main>
        <div class="content">
            <h2 class="content__ttl">Admin</h2>
            <form action="{{route('search')}}" method="get" class="search-form">
            @csrf
                <input type="text" name="text" placeholder="名前やメールアドレスを入力してください" value="{{old('text')}}">
                <select name="gender">
                    <option value=null selected>性別</option>
                    <option value=1>1:男性</option>
                    <option value=2>2:女性</option>
                    <option value=3>3:その他</option>
                </select>
                <select name="category_id">
                    <option value=1>1. 商品のお届けについて</option>
                    <option value=2>2. 商品の交換について</option>
                    <option value=3>3. 商品トラブル</option>
                    <option value=4>4. ショップへのお問い合わせ</option>
                    <option value=5>5. その他</option>
                </select>
                <input type="date" name="date" value=null>
                <button type="submit" class="search-form__button">検索</button>
                <button type="submit" name="reset" value="yes" class="search-form__button search-form__button--pale">リセット</button>
            </form>
            <div class="export-paginate-area">
                <button class=export-form__button>エクスポート</button>
                <div class="page-switch-form">{{$contacts->appends(request()->query())->links()}}</div>
            </div>
            <table class="contact-table">
                <tr class="contact-table__head">
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th colspan=2>お問い合わせの種類</th>
                </tr>
                @foreach($contacts as $contact)
                <tr class="contact-table__content">
                    <td>{{$contact->last_name}}&emsp;{{$contact->first_name}}</td>
                    <td>
                    @switch($contact->gender)
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
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->category->content}}</td>
                    <td>
                        <button>詳細</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </main>
</body>

</html>