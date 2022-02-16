@foreach($musics as $music)
    <a class="music_item" href="{!! route('musics.show', ['id' => $music->id]) !!}">
        <div class="user_info">
            <div><img class="rounded" src="{{ Gravatar::get($music->user->email, ['size' => 50]) }}" ></div>
            <div class="user_name">{{ $music->user->name }}</div>
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
                <dd>{{ $music->comments->count() }} 件</dd>
            </dl>
        </div>

        <div class="music_info2">
            <div class="level">{{ $music->level_name }}</div>
            <div class="like_mark"><i class="far fa-thumbs-up"></i></div>
            <div class="like_count">{{ $music->likes->count() }}</div>
        </div>
    </a>
@endforeach
