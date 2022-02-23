@extends('layouts.adminbase')

@section('content')

    <div class="common_wrap">
        <h1 class="admin_title">ユーザ選択：</h1>

        {!! Form::open(['route' => 'admin.users']) !!}
        <div class="row align-items-center mt-4">
            <div class="col-10">
                <div class="conditions">
                    検索条件：
                    <dl>
                        <dt>{!! Form::label('id', 'id：') !!}</dt>
                        <dd>{!! Form::text('id',old('id', isset($conditions->id) ? $conditions->id : ''), ['class' => 'form-control']) !!}</dd>
                    </dl>
                    <dl>
                        <dt>{!! Form::label('name', '表示名：') !!}</dt>
                        <dd>{!! Form::text('name',old('name', isset($conditions->name) ? $conditions->name : ''), ['class' => 'form-control']) !!}</dd>
                    </dl>
                    <dl>
                        <dt>{!! Form::label('email', 'メールアドレス：') !!}</dt>
                        <dd>{!! Form::text('email',old('id', isset($conditions->email) ? $conditions->email : ''), ['class' => 'form-control']) !!}</dd>
                    </dl>
                </div>
            </div>
            <div class="col-2">
                {{-- 検索ボタン --}}
                {!! Form::submit('検索', ['class' => 'btn btn-primary btn-block']) !!}
            </div>
        </div>
        {!! Form::close() !!}

        <div class="user_lsit_area mt-4">
            検索結果： <span class="result_count">{{ $result_count }}</span>件
            <table class="user_list">
                <tr>
                    <th class="user_id">id</th>
                    <th class="username">表示名</th>
                    <th class="email">メールアドレス</th>
                </tr>
                @foreach($users as $user)

                    <tr class="border-bottom">

                        <td><a href="{{ route('admin.useredit',$user->id) }}">{{ $user->id }}</a></td>
                        <td><a href="{{ route('admin.useredit',$user->id) }}">{{ $user->name }}</a></td>
                        <td><a href="{{ route('admin.useredit',$user->id) }}">{{ $user->email }}</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
