@extends('layouts.base')

@section('pagetitle','HOME')

@section('content')
    <h1 class="app_title">トップページ</h1>

    <div class="common_wrap">
        <div class="guide_area">
            <div class="guide_wrap guide_search modal_open js-modal-open">
                <div class="guide_label">検索条件</div>
                <div class="guide_body">{{ $search }}</div>
            </div>
            <div class="guide_wrap guide_sort">
                <div class="guide_label">並び順</div>
                <div class="guide_body">{{ $order }}</div>
            </div>
        </div>

        <div class="result_area">
            検索結果： <span class="result_count">{{ $result_count }}</span>件
        </div>

        @include('musics.musics')

    </div>

    {{-- 検索ウィンドウ --}}
    @include('musics.search')

    @include('commons.entry')

@endsection
