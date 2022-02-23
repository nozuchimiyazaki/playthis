<header class="mb-4">
    <!--<nav class="navbar navbar-expand-sm navbar-dark bg-dark">-->
    <nav class="navbar navbar-dark playthis_background_color">
            {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="{{ env('APP_ROOT')}}/">PlayThis これ弾いてみて！</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ env('APP_ROOT')}}/" class="nav-link">HOME</a></li>
                <li class="nav-item">{!! link_to_route('musics.result', '検索',[], ['class' => 'nav-link']) !!}</li>
                <li class="nav-item">{!! link_to_route('music.new', 'おすすめ曲を投稿',[], ['class' => 'nav-link']) !!}</li>
                @if (Auth::check())
                    {{-- ユーザログイン済み --}}
                    <li class="nav-item">{!! link_to_route('user.musics', '投稿した曲一覧',['id' => Auth::id()], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('user.edit', 'ユーザ情報編集',['id' => Auth::id()], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト',[], ['class' => 'nav-link']) !!}</li>
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

        </div>
    </div>
</header>
