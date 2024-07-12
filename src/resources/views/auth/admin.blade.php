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
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <title>Document</title>
</head>

<body class="body">
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
                <input type="text" name="text" class="text-form" placeholder="名前やメールアドレスを入力してください" value="{{old('text')}}">
                <div class="select-wrapper">
                    <select name="gender" class="gender-form">
                        <option value=null selected>性別</option>
                        <option value=1>1:男性</option>
                        <option value=2>2:女性</option>
                        <option value=3>3:その他</option>
                    </select>
                </div>
                <div class="select-wrapper category">
                    <select name="category_id" class="category-form">
                        <option value=null selected>お問い合わせの種類</option>
                        <option value=1>1. 商品のお届けについて</option>
                        <option value=2>2. 商品の交換について</option>
                        <option value=3>3. 商品トラブル</option>
                        <option value=4>4. ショップへのお問い合わせ</option>
                        <option value=5>5. その他</option>
                    </select>
                </div>
                <input type="date" name="date" class="date-form" value=null>
                <button type="submit" class="search-form__button">検索</button>
                <button type="submit" name="reset" value="yes" class="search-form__button search-form__button--pale">リセット</button>
            </form>
            <div class="export-paginate-area">
                <form action="{{route('export')}}" method="post">
                @csrf    
                    <button type="submit" class="export-form__button">エクスポート</button>
                </form>
                <div class="page-switch-form">       {{$contacts->links()}}
                </div>
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
                        <button class="detail__button" data-toggle="modal" data-target="#modal-{{ $contact->id }}">詳細</button>
                        <div class="modal" id="modal-{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel-{{ $contact->id }}" aria-hidden="true">
                             <div class="modal-dialog"> 
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="modal-table">
                                            <tr>
                                                <th>お名前</th>
                                                <td>{{$contact->last_name}}&emsp;{{$contact->first_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>性別</th>
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
                                            </tr>
                                            <tr>
                                                <th>メールアドレス</th>
                                                <td>{{$contact->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>電話番号</th>
                                                <td>{{$contact->tell}}</td>
                                            </tr>
                                            <tr>
                                                <th>住所</th>
                                                <td>{{$contact->address}}</td>
                                            </tr>
                                            <tr>
                                                <th>建物名</th>
                                                <td>{{$contact->building}}</td>
                                            </tr>
                                            <tr>
                                                <th>お問い合わせの種類</th>
                                                <td>
                                                @switch($contact->category_id)
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
                                                <td>{{$contact->detail}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{route('destroy',['id'=>$contact->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="delete__button">削除</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>