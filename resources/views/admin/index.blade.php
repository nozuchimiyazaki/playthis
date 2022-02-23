@extends('layouts.adminbase')

@section('pagetitle','管理者メニュー')

@section('content')
    <h1 class="admin_title">管理者メニュー：</h1>

    <div class="common_wrap">
        <div class="admin_menu_area">
            <div class="admin_menu_item">
                <h2>ユーザ管理</h2>
                <div class="admin_menu_body">
                    <ul>
                        <li><a href="{{ route('admin.users') }}">ユーザ情報編集</a></li>
                    </ul>
                </div>
            </div>

            <div class="admin_menu_item">
                <h2>統計情報</h2>
                <div class="admin_menu_body">
                    <ul>
                        <li>将来的に提供</li>
                    </ul>
                </div>
            </div>

            <div class="admin_menu_item">
                <h2>システム管理</h2>
                <div class="admin_menu_body">
                    <ul>
                        <li><a href="">ジャンル登録</a></li>
                        <li><a href="{{ route('admin.editstyles') }}">プレイスタイル登録</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
