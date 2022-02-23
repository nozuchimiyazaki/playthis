@extends('layouts.base')

@section('pagetitle','おすすめ曲の投稿')

@section('content')
    <div class="common_wrap">
        {!! Form::open(['route' => ['music.store']]) !!}
            <div class="music_info_desc">
                <dl>
                    <dt>{!! Form::label('music_name','曲名：') !!}</dt>
                    <dd>{!! Form::text('music_name', null, ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>{!! Form::label('artist','アーティスト：') !!}</dt>
                    <dd>{!! Form::text('artist', null, ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>{!! Form::label('album','アルバム：') !!}</dt>
                    <dd>{!! Form::text('album', null, ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>曲の難易度：</dt>
                    <dd>
                        <div class="form-group form-check">
                            {{Form::radio('radiolevel', '0', (old('radiolevel') == '0' ? true : ($level == 0)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel0'])}}{!! Form::label('radioLevel0','低 初心者でも弾けるレベル') !!}<br>
                            {{Form::radio('radiolevel', '1', (old('radiolevel') == '1' ? true : ($level == 1)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel1'])}}{!! Form::label('radioLevel1','中 これが弾ければ脱初心者') !!}<br>
                            {{Form::radio('radiolevel', '2', (old('radiolevel') == '2' ? true : ($level == 2)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel2'])}}{!! Form::label('radioLevel2','高 結構練習しないと弾けない') !!}<br>
                            {{Form::radio('radiolevel', '9', (old('radiolevel') == '9' ? true : ($level == 9)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel9'])}}{!! Form::label('radioLevel9','最高 神わざレベル') !!}
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>ジャンル：</dt>
                    <dd>
                        @foreach($genres as $genre)
                            <input type="checkbox" id="checkGenre{{$genre->id}}" name="checkGenre[]" value="{{$genre->id}}" {{ (is_array(old('checkGenre')) && in_array($genre->id, old('checkGenre'))) ? 'checked' : '' }}> <label for="checkGenre{{$genre->id}}">{{$genre->name}}</label>　
                        @endforeach
                    </dd>
                </dl>
                <dl>
                    <dt>プレイスタイル：</dt>
                    <dd>
                        @foreach($styles as $style)
                            <input type="checkbox" id="checkStyle{{$style->id}}" name="checkStyle[]" value="{{$style->id}}" {{ (is_array(old('checkStyle')) && in_array($style->id, old('checkStyle'))) ? 'checked' : '' }}> <label for="checkStyle{{$style->id}}">{{$style->name}}</label>　
                        @endforeach
                    </dd>
                </dl>
                <dl>
                    <dt>{!! Form::label('explanation','曲の解説：') !!}</dt>
                    <dd>{!! Form::textarea('explanation', null, ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>Youtube URL：</dt>
                    <dd>
                        {!! Form::text('url1', null, ['class' => 'form-control']) !!}
                        {!! Form::text('url2', null, ['class' => 'form-control']) !!}
                        {!! Form::text('url3', null, ['class' => 'form-control']) !!}
                    </dd>
                </dl>

                <div class="mt-4">
                    {!! Form::submit('投稿する', ['class' => 'btn btn_entry btn-block']) !!}
                </div>
            </div>
        {!! Form::close() !!}

    </div>

@endsection
