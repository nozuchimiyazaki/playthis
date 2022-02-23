@extends('layouts.base')

@section('pagetitle','ログイン')

@section('content')
    <h1 class="app_title">ログイン：</h1>

    <div class="form_wrap users_wrap">
        <!--<div class="col-sm-6 offset-sm-3">-->

            {!! Form::open(['route' => 'login.post']) !!}
                <dl class="form-group">
                    <dt>{!! Form::label('email', 'メールアドレス') !!}</dt>
                    <dd>{!! Form::email('email', null, ['class' => 'form-control']) !!}</dd>
                </dl>

                <dl class="form-group">
                    <dt>{!! Form::label('password', 'パスワード') !!}</dt>
                    <dd>{!! Form::password('password', ['class' => 'form-control']) !!}</dd>
                </dl>

                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}

            {{-- ユーザ登録ページへのリンク --}}
            <div class="text-center mt-2">New user? {!! link_to_route('signup.get', 'ユーザ登録!') !!}</div>
        <!--</div>-->
    </div>
@endsection
