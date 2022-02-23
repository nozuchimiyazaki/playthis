@extends('layouts.base')

@section('content')
    <h1 class="app_title">ユーザ情報編集：</h1>

    <div class="form_wrap users_wrap">
        <!--<div class="col-sm-6 offset-sm-3">-->

            {!! Form::open(['route' => ['user.update', $user->id]]) !!}
                <dl class="form-group">
                    <dt><span class="required">必須</span>{!! Form::label('name', '表示名：') !!}</dt>
                    <dd>{!! Form::text('name',old('name', isset($user->name) ? $user->name : ''), ['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt><span class="required">必須</span>{!! Form::label('email', 'メールアドレス：') !!}</dt>
                    <dd>{!! Form::email('email',old('email', isset($user->email) ? $user->email : ''), ['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt>{!! Form::label('nowpassword', '現在のパスワード：') !!}</dt>
                    <dd>{!! Form::password('nowpassword',['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt>{!! Form::label('password', '新パスワード：') !!}</dt>
                    <dd>{!! Form::password('password',['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt>{!! Form::label('password_confirmation', '新パスワード(確認)：') !!}</dt>
                    <dd>{!! Form::password('password_confirmation',['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt>{!! Form::label('profile', 'プロフィール：') !!}</dt>
                    <dd>{!! Form::textarea('profile',old('profile', isset($user->profile) ? $user->profile : ''), ['class' => 'form-control']) !!}</dd>
                </dl>


                <div class="row">
                    <div class="col-6">
                        {!! Form::submit('更新する', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                    <div class="col-6">
                        <a class="btn btn-secondary btn-block" href="{{ env('APP_ROOT')}}/">戻る</a>
                    </div>
                </div>

            {!! Form::close() !!}
        <!--</div>-->
    </div>

@endsection
