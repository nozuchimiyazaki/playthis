<div class="modal js-modal">
    <div class="modal_bg js-modal-close"></div>
    <div class="common_wrap search modal_content">
        <h1 class="app_title">検索条件</h1>

        {!! Form::open(['route' => ['musics.result']]) !!}
            <div class="music_info_desc">
                <dl>
                    <dt>{!! Form::label('music_name','曲名：') !!}</dt>
                    <dd>{!! Form::text('music_name', old('music_name', isset($condition->music_name) ? $condition->music_name : ''), ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>{!! Form::label('artist','アーティスト：') !!}</dt>
                    <dd>{!! Form::text('artist', old('artist', isset($condition->artist) ? $condition->artist : ''), ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>{!! Form::label('album','アルバム：') !!}</dt>
                    <dd>{!! Form::text('album', old('album', isset($condition->album) ? $condition->album : ''), ['class' => 'form-control']) !!}</dd>
                </dl>
                <dl>
                    <dt>曲の難易度：</dt>
                    <dd>
                        <div class="form-group form-check">
                            {{Form::radio('radiolevel', '0', (old('radiolevel') == '0' ? true: ($condition->level == 0)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel0'])}}{!! Form::label('radioLevel0','低 初心者でも弾けるレベル') !!}<br>
                            {{Form::radio('radiolevel', '1', (old('radiolevel') == '1' ? true: ($condition->level == 1)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel1'])}}{!! Form::label('radioLevel1','中 これが弾ければ脱初心者') !!}<br>
                            {{Form::radio('radiolevel', '2', (old('radiolevel') == '2' ? true: ($condition->level == 2)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel2'])}}{!! Form::label('radioLevel2','高 結構練習しないと弾けない') !!}<br>
                            {{Form::radio('radiolevel', '9', (old('radiolevel') == '9' ? true: ($condition->level == 9)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel9'])}}{!! Form::label('radioLevel9','最高 神わざレベル') !!}<br>
                            {{Form::radio('radiolevel', '-1', (old('radiolevel') == '-1' ? true: ($condition->level == -1)) ? true : false, ['class'=>'form-check-input','id'=>'radioLevel-1'])}}{!! Form::label('radioLevel-1','全て') !!}
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
                    <dt>{!! Form::label('explanation','この文字列を含む：') !!}</dt>
                    <dd>{!! Form::textarea('explanation', old('explanation', isset($condition->explanation) ? $condition->explanation : ''), ['class' => 'form-control', 'rows' => '2']) !!}</dd>
                </dl>

                <div class="row mt-4">
                    <div class="col-6">{!! Form::submit('検索する', ['class' => 'btn btn_entry btn-block']) !!}</div>
                    <div class="col-6"><button class="js-modal-close btn btn-secondary btn-block" href="">閉じる</button></div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
$(function(){
    $('.js-modal-open').on('click', function(){
        $('body').addClass('body_modal_open');
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click', function(){
        $('body').removeClass('body_modal_open');
        $('.js-modal').fadeOut();
        return false;
    });
});
</script>
