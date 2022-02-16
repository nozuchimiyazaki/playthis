@extends('layouts.base')

@section('content')
    <div class="common_wrap">
        <div class="music_info_desc">
            <dl>
                <dt>曲名：</dt>
                <dd>{{ $music->music_name }}</dd>
            </dl>
            <dl>
                <dt>アーティスト：</dt>
                <dd>{{ $music->artist }}</dd>
            </dl>
            <dl>
                <dt>アルバム：</dt>
                <dd>{{ $music->album }}</dd>
            </dl>
            <dl>
                <dt>曲の難易度：</dt>
                <dd>{{ $music->level_name }}</dd>
            </dl>
            <dl>
                <dt>ジャンル：</dt>
                <dd>
                    @foreach($music->genres as $genre)
                        {{ $genre->name }}
                    @endforeach
                </dd>
            </dl>
            <dl>
                <dt>プレイスタイル：</dt>
                <dd>
                    @foreach($music->styles as $style)
                        {{ $style->name }}
                    @endforeach
                </dd>
            </dl>
            <dl>
                <dt>曲の解説：</dt>
                <dd>{!! nl2br(htmlspecialchars($music->explanation)) !!}</dd>
            </dl>
            <dl>
                <dt>投稿者：</dt>
                <dd>
                    <div class="row">
                        <div class="col-9 author_area">
                            <div><img class="rounded-circle" src="{{ Gravatar::get($music->user->email, ['size' => 50]) }}" ></div>
                            <div class="user_name">{{ $music->user->name }}</div>
                            <div class="created">{{ $music->created_at }}</div>
                        </div>
                        <div class="col-3 likes_area">
                            @if (Auth::check())
                                <?php $likeOn = false; ?>
                                @foreach($music->likes as $like)
                                    @if ($like->user_id == \Auth::id())
                                        <?php $likeOn = true; ?>
                                    @endif
                                @endforeach
                                @if ($likeOn)
                                    <div class="like_mark"><i class="fas fa-thumbs-up"></i></div>
                                @else
                                    <div class="like_mark"><i class="far fa-thumbs-up"></i></div>
                                @endif
                            @else
                                <div class="like_mark"><i class="far fa-thumbs-up"></i></div>
                            @endif
                            <div class="like_count">{{ $music->likes->count() }}</div>
                        </div>
                </dd>
            </dl>
            <dl>
                <dt></dt>
                <dd>
                    @foreach($music->movies as $movie)
                        <div class="movie_wrapper">
                            <div class="frame_wrapper">
                                <iframe src="https://www.youtube.com/embed/{{ $movie->youtube_id }}?modestbranding=0" frameborder="0" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endforeach
                </dd>
            </dl>
            <dl>
                <dt>コメント：</dt>
                <dd>
                    {{ $music->comments->count() }} 件<br>

                    <div class="comment_entry_area">
                        {!! Form::open(['route' => ['comment.store', $music->id]]) !!}
                            {!! Form::label('comment_text','コメントを入力：') !!}
                            <div class="row">
                                <div class="col-11">{!! Form::textarea('comment_text', null, ['class' => 'form-control', 'rows' => '2']) !!}</div>
                                <div class="col-1">{!! Form::submit('投稿', ['class' => 'btn btn_entry']) !!}</div>
                            </div>
                        {!! Form::close() !!}
                    </div>

                    @foreach($music->comments as $comment)
                        <div class="row">
                            <div class="col-1 comment_avatar">
                                <img class="rounded-circle align-middle" src="{{ Gravatar::get($comment->email, ['size' => 25]) }}" alt="">
                            </div>
                            <div class="col-11">
                                <div class="row comment_meta">
                                    <div class="col-10 comment_username">
                                        {{ $comment->username}}
                                    </div>
                                    <div class="col-2 text-right comment_date">
                                        {{ $comment->created_at->format('Y/m/d') }}
                                    </div>
                                </div>
                                <div class="comment_text">
                                    {!! nl2br(htmlspecialchars($comment->comment_text)) !!}
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </dd>
            </dl>
        </div>

    </div>

    @if (Auth::check())
        @if ($music->user_id == \Auth::id())
            <div class="btn_wrap">
                <div class="common_wrap">
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn_entry btn-block" href="#">編集する</a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn_entry btn-block" href="#">削除する</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

@endsection
