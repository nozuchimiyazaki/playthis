<header class="mb-4">
    <!--<nav class="navbar navbar-expand-sm navbar-dark bg-dark">-->
    <nav class="navbar navbar-dark bg-dark">
            {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="{{ env('APP_ROOT')}}/">PlayThis</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="#" class="nav-link">検索</a></li>
                <li class="nav-item"><a href="#" class="nav-link">おすすめ曲を投稿</a></li>
                @if (Auth::check())
                    {{-- ユーザログイン済み --}}
                    {{-- ログアウトへのリンク --}}
                    <li class="nav-item">{!! link_to_route('logout.get', 'Logout') !!}</li>
                @else
                    {{-- ログインページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('login', 'ログイン' ,[], ['class' => 'nav-link']) !!}</li>
                    {{-- ユーザ登録ページへのリンク --}}
                    <li class="nav-item">{!! link_to_route('signup.get', 'ユーザ登録', [], ['class' => 'nav-link']) !!}</li>
                @endif

            </ul>
        </div>
    </nav>
    <div class="owner_area">
        <div class="owner_wrap">
            <div class="hello">
                こんにちは
                @if (Auth::check())
                    {{ Auth::user()->name }}
                    <?php $email = Auth::user()->email ?>
                @else
                    ゲスト
                    <?php $email = 'dummy@dummy.com'?>
                @endif
                 さん
            </div>
            <img class="rounded-circle" src="{{ Gravatar::get($email, ['size' => 30]) }}" alt="">
            <!--<i class="far fa-user-circle"></i>-->
        </div>
    </div>
</header>
