@extends('layouts.base')

@section('content')
    <h1 class="app_title">ユーザ登録：</h1>

    <div class="form_wrap users_wrap">
        <!--<div class="col-sm-6 offset-sm-3">-->

            {!! Form::open(['route' => 'signup.post']) !!}
                <dl class="form-group">
                    <dt><span class="required">必須</span>{!! Form::label('name', '表示名：') !!}</dt>
                    <dd>{!! Form::text('name',null, ['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt><span class="required">必須</span>{!! Form::label('email', 'メールアドレス：') !!}</dt>
                    <dd>{!! Form::email('email',null, ['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt><span class="required">必須</span>{!! Form::label('password', 'パスワード：') !!}</dt>
                    <dd>{!! Form::password('password',['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt><span class="required">必須</span>{!! Form::label('password_confirmation', 'パスワード(確認)：') !!}</dt>
                    <dd>{!! Form::password('password_confirmation',['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt>{!! Form::label('profile', 'プロフィール：') !!}</dt>
                    <dd>{!! Form::textarea('profile',null, ['class' => 'form-control']) !!}</dd>
                </dl>

                {!! Form::submit('登録する', ['class' => 'btn btn-primary btn-block']) !!}

            {!! Form::close() !!}
        <!--</div>-->
    </div>

@endsection
