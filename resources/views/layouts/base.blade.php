<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>PlayThis</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        {{-- <link rel="stylesheet" href="/playthis/public/css/style.css"> --}}
        <link rel="stylesheet" href="{{ config('app.app_root') }}css/style.css">
    </head>

    <body>

        {{-- ナビゲーションバー --}}
        @include('commons.header')

        <div class="container">
            {{-- エラーメッセージ --}}
            @include('commons.messages')

            @yield('content')
        </div>

        <footer>
            <div class="text-center">Copyright &copy; miyazaki All Rights Reserved.</div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>
