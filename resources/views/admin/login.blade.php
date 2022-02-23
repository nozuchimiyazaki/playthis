@extends('layouts.adminbase')

@section('content')
    <h1 class="app_title">管理者ログイン：</h1>

    <div class="form_wrap users_wrap">
        <!--<div class="col-sm-6 offset-sm-3">-->

            {!! Form::open(['route' => 'admin.login.post']) !!}
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

        <!--</div>-->
    </div>
@endsection
