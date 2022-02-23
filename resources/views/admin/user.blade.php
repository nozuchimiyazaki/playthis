@extends('layouts.adminbase')

@section('pagetitle','ユーザ情報編集')

@section('content')
    <h1 class="admin_title">ユーザ情報編集：</h1>

    <div class="form_wrap users_wrap admin_color">
        <!--<div class="col-sm-6 offset-sm-3">-->

            {!! Form::open(['route' => ['admin.userupdate', $user->id]]) !!}
                <dl class="form-group">
                    <dt class="admin_color"><span class="required">必須</span>{!! Form::label('name', '表示名：') !!}</dt>
                    <dd>{!! Form::text('name',old('name', isset($user->name) ? $user->name : ''), ['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt class="admin_color"><span class="required">必須</span>{!! Form::label('email', 'メールアドレス：') !!}</dt>
                    <dd>{!! Form::email('email',old('email', isset($user->email) ? $user->email : ''), ['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt class="admin_color">{!! Form::label('password', '新パスワード：') !!}</dt>
                    <dd>{!! Form::password('password',['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt class="admin_color">{!! Form::label('password_confirmation', '新パスワード(確認)：') !!}</dt>
                    <dd>{!! Form::password('password_confirmation',['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt class="admin_color">{!! Form::label('profile', 'プロフィール：') !!}</dt>
                    <dd>{!! Form::textarea('profile',old('profile', isset($user->profile) ? $user->profile : ''), ['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt class="admin_color">ロール：</dt>
                    <dd>
                        <div class="form-group form-check">
                            {{Form::radio('radioRole', '0', (old('radioRole') == '0' ? true: ($user->role == 0)) ? true : false, ['class'=>'form-check-input','id'=>'radioRole0'])}}{!! Form::label('radioRole0','一般ユーザ') !!}　
                            {{Form::radio('radioRole', '1', (old('radioRole') == '1' ? true: ($user->role == 1)) ? true : false, ['class'=>'form-check-input','id'=>'radioRole1'])}}{!! Form::label('radioRole1','最高管理者') !!}　
                            {{Form::radio('radioRole', '2', (old('radioRole') == '2' ? true: ($user->role == 2)) ? true : false, ['class'=>'form-check-input','id'=>'radioRole2'])}}{!! Form::label('radioRole2','編集管理者') !!}
                        </div>
                    </dd>
                </dl>

                <div class="row">
                    <div class="col-6">
                        {!! Form::submit('更新する', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                    <div class="col-6">
                        <a class="btn btn-secondary btn-block" href="{{ route('admin.users') }}">戻る</a>
                    </div>
                </div>

            {!! Form::close() !!}
        <!--</div>-->
    </div>

@endsection
