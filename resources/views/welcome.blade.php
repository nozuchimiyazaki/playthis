@extends('layouts.base')

@section('content')
    <h1 class="app_title">トップページ：</h1>

    <div class="common_wrap">
        <div class="guide_area">
            <a href="#" class="guide_wrap guide_search">
                <div class="guide_label">検索条件</div>
                <div class="guide_body">{!! $search !!}</div>
            </a>
            <a href="#" class="guide_wrap guide_sort">
                <div class="guide_label">並べ替え</div>
                <div class="guide_body">{!! $order !!}</div>
            </a>
        </div>

        <div class="result_area">
            検索結果： {{ $musics->count() }}件
        </div>

        @include('musics.musics')

    </div>

    @include('commons.entry')

@endsection
