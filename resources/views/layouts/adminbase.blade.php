<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>@yield('pagetitle') |PlayThis 管理者機能</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ config('app.app_root') }}/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>

        {{-- ナビゲーションバー --}}
        @include('commons.adminheader')

        <div class="container">
            {{-- エラーメッセージ --}}
            @include('commons.messages')

            @yield('content')
        </div>

        <footer class="admin_footer">
            <div class="text-center">Copyright &copy; miyazaki All Rights Reserved.</div>
        </footer>

        {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>

    </body>
</html>
