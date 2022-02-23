@extends('layouts.base')

@section('content')

    <div class="common_wrap">
        <div class="row user_area mb-4">
            <div class="col-2">
                <div><img class="rounded-circle" src="{{ Gravatar::get($user->email, ['size' => 100]) }}" ></div>
            </div>
            <div class="col-10">
                <div class="music_info1">
                    <dl>
                        <dt>ユーザ：</dt>
                        <dd>{{ $user->name }}</dd>
                    </dl>
                    <dl>
                        <dt>プロフィール：</dt>
                        <dd>{{ mb_strimwidth($user->profile, 0, 100, '...', 'UTF-8') }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="result_area">
            {{ $user->name }}さんが投稿した曲： <span class="result_count">{{ $result_count }}</span>件
        </div>

        @include('musics.musics')

    </div>

    @include('commons.entry')

@endsection
