@extends('layouts.base')

@section('content')
    <div class="common_wrap">
        {!! Form::open(['route' => ['musics.update', $music->id]]) !!}
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
                        {{Form::radio('radiolevel', '0', (old('radiolevel') == '0' ? true: ($music->level == 0)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel0'])}}{!! Form::label('radioLevel0','低 初心者でも弾けるレベル') !!}<br>
                        {{Form::radio('radiolevel', '1', (old('radiolevel') == '1' ? true: ($music->level == 1)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel1'])}}{!! Form::label('radioLevel1','中 これが弾ければ脱初心者') !!}<br>
                        {{Form::radio('radiolevel', '2', (old('radiolevel') == '2' ? true: ($music->level == 2)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel2'])}}{!! Form::label('radioLevel2','高 結構練習しないと弾けない') !!}<br>
                        {{Form::radio('radiolevel', '9', (old('radiolevel') == '9' ? true: ($music->level == 9)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel9'])}}{!! Form::label('radioLevel9','最高 神わざレベル') !!}
                    </dd>
                </dl>
                <dl>
                    <dt>ジャンル：</dt>
                    <dd>
                        @foreach($genres as $genre)
                            <input type="checkbox" id="checkGenre{{$genre->id}}" name="checkGenre[]" value="{{$genre->id}}" {{ ($genre->selected) ? 'checked' : '' }}> <label for="checkGenre{{$genre->id}}">{{$genre->name}}</label>　
                        @endforeach
                    </dd>
                </dl>
                <dl>
                    <dt>プレイスタイル：</dt>
                    <dd>
                        @foreach($styles as $style)
                            <input type="checkbox" id="checkStyle{{$style->id}}" name="checkStyle[]" value="{{$style->id}}" {{ ($style->selected) ? 'checked' : '' }}> <label for="checkStyle{{$style->id}}">{{$style->name}}</label>　
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

                <div>
                    {!! Form::submit('更新する', ['class' => 'btn btn_entry btn-block']) !!}
                </div>
            </div>
        {!! Form::close() !!}

    </div>

@endsection
