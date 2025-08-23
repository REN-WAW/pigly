<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pigly</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <div class="app">
        @if (Auth::check())
        
        <header class="header">
            <h1 class="header__heading">PIGLy</h1>
            @yield('link')
            
            <form action="/weight_logs/goal_setting" method="post">
                @csrf
                <input class="header__link" type="submit" value="目標体重設定">
            </form>
            
            <form action="/logout" method="post">
                @csrf
                <input class="header__link" type="submit" value="ログアウト">
            </form>
        </header>
        @endif
        
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

</html>