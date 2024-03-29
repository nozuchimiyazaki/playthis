@foreach($musics as $music)
    <a class="music_item" href="{!! route('music.show', ['id' => $music->musicid]) !!}">
        <div class="user_info">
            <div><img class="rounded-circle" src="{{ Gravatar::get($music->email, ['size' => 50]) }}" ></div>
            <div class="user_name">{{ $music->username }}</div>
        </div>

        <div class="music_info1">
            <dl>
                <dt>曲名：</dt>
                <dd>{{ $music->music_name }}</dd>
            </dl>
            <dl>
                <dt>アーティスト：</dt>
                <dd>{{ $music->artist }}</dd>
            </dl>
            <dl>
                <dt>解説：</dt>
                <dd>{{ mb_strimwidth($music->explanation, 0, 100, '...', 'UTF-8') }}</dd>
            </dl>
            <dl>
                <dt>コメント：</dt>
                <dd>{{ $music->comments_count }} 件</dd>
            </dl>
        </div>

        <div class="music_info2">
            <div class="level">{{ $music->getLevelName($music->level) }}</div>
            <div class="like_mark"><i class="far fa-thumbs-up"></i></div>
            <div class="like_count">{{ $music->likes_count }}</div>
        </div>
    </a>
@endforeach

{{-- ページネーションのリンク --}}
<div class="text-center center-block">
    <div class="mt-3 mb-3">
        {{-- @if (isset($musics->links()) && ($musics->links() !== null)) --}}
        @if ($musics->links() !== null)
            {{ $musics->links() }}
        @endif
    </div>
    <div class="mb-4">
        <a href="{{ env('APP_ROOT')}}/">トップページへ</a>
    </div>
</div>
