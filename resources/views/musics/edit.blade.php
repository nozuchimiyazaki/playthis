@extends('layouts.base')

@section('pagetitle','曲の編集')

@section('content')
    <div class="common_wrap">
        {!! Form::open(['route' => ['music.update', $music->id]]) !!}
            <div class="music_info_desc">
                <dl>
                    <dt>{!! Form::label('music_name','曲名：') !!}</dt>
                    <dd>{!! Form::text('music_name', old('music_name', isset($music->music_name) ? $music->music_name : ''), ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>{!! Form::label('artist','アーティスト：') !!}</dt>
                    <dd>{!! Form::text('artist', old('artist', isset($music->artist) ? $music->artist : ''), ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>{!! Form::label('album','アルバム：') !!}</dt>
                    <dd>{!! Form::text('album', old('album', isset($music->album) ? $music->album : ''), ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>曲の難易度：</dt>
                    <dd>
                        <div class="form-group form-check">
                            {{Form::radio('radiolevel', '0', (old('radiolevel') == '0' ? true: ($music->level == 0)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel0'])}}{!! Form::label('radioLevel0','低 初心者でも弾けるレベル') !!}<br>
                            {{Form::radio('radiolevel', '1', (old('radiolevel') == '1' ? true: ($music->level == 1)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel1'])}}{!! Form::label('radioLevel1','中 これが弾ければ脱初心者') !!}<br>
                            {{Form::radio('radiolevel', '2', (old('radiolevel') == '2' ? true: ($music->level == 2)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel2'])}}{!! Form::label('radioLevel2','高 結構練習しないと弾けない') !!}<br>
                            {{Form::radio('radiolevel', '9', (old('radiolevel') == '9' ? true: ($music->level == 9)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel9'])}}{!! Form::label('radioLevel9','最高 神わざレベル') !!}
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>ジャンル：</dt>
                    <dd>
                        @foreach($genres as $genre)
                            <input type="checkbox" id="checkGenre{{$genre->id}}" name="checkGenre[]" value="{{$genre->id}}" {{ (is_array(old('checkGenre')) && in_array($genre->id, old('checkGenre'))) ? 'checked' : (($genre->selected) ? 'checked' : '') }}> <label for="checkGenre{{$genre->id}}">{{$genre->name}}</label>　
                        @endforeach
                    </dd>
                </dl>
                <dl>
                    <dt>プレイスタイル：</dt>
                    <dd>
                        @foreach($styles as $style)
                            <input type="checkbox" id="checkStyle{{$style->id}}" name="checkStyle[]" value="{{$style->id}}" {{ (is_array(old('checkStyle')) && in_array($style->id, old('checkStyle'))) ? 'checked' : (($style->selected) ? 'checked' : '') }}> <label for="checkStyle{{$style->id}}">{{$style->name}}</label>　
                        @endforeach
                    </dd>
                </dl>
                <dl>
                    <dt>{!! Form::label('explanation','曲の解説：') !!}</dt>
                    <dd>{!! Form::textarea('explanation', old('explanation', isset($music->explanation) ? $music->explanation : ''), ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>Youtube URL：</dt>
                    <dd>
                        {!! Form::text('url1', old('url1', isset($music->url1) ? $music->url1 : ''), ['class' => 'form-control']) !!}
                        {!! Form::text('url2', old('url2', isset($music->url2) ? $music->url2 : ''), ['class' => 'form-control']) !!}
                        {!! Form::text('url3', old('url3', isset($music->url3) ? $music->url3 : ''), ['class' => 'form-control']) !!}
                    </dd>
                </dl>

                <dl>
                    <dt>コメント：</dt>
                    <dd>
                        {{ $music->comments->count() }} 件<br>

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
                                    <div class="row">
                                        <div class="col-10 comment_text">
                                            {!! nl2br(htmlspecialchars($comment->comment_text)) !!}
                                        </div>
                                        <div class="col-2 comment_delete">
                                            <input type="checkbox" id="checkComment{{ $comment->id }}" name="checkComment[]" value="{{$comment->id}}" {{ (is_array(old('checkComment')) && in_array($comment->id, old('checkComment'))) ? 'checked' : (($comment->delete_request != '') ? 'checked' : '') }}> <label for="checkComment{{$comment->id}}" class="comment_delete_label">削除希望</label>　
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </dd>
                </dl>

                <div class="mt-4">
                    {!! Form::submit('更新する', ['class' => 'btn btn_entry btn-block']) !!}
                </div>
            </div>
        {!! Form::close() !!}

    </div>

@endsection
