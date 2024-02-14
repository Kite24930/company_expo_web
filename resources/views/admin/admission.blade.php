<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/icon.png') }}">
    <meta name="robots" content="noindex,nofollow"> <!-- 管理画面なのでクロールしない -->
    <title>{{ __($overview->title.' 入場処理') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/sanitize.css">
    @vite(['resources/css/main.css'])
</head>
<body class="bg-gray-50 flex flex-col justify-center items-center min-h-screen p-6">
    <div class="flex gap-4 items-center">
        <x-application-logo class="h-20 w-20 object-contain" />
        <h1 class="text-5xl font-bold">{{ __($overview->title.' 入場処理') }}</h1>
    </div>
    <div class="w-full p-6 flex-1 flex flex-col justify-center items-center gap-2">
        <div id="msg">Unable to access video stream.</div>
        <canvas id="canvas" class="w-full max-w-lg flex-1 bg-gray-500 rounded-3xl"></canvas>
        <button id="reading" type="button" class="text-2xl font-semibold">Reading Start</button>
    </div>
@vite(['resources/js/dashboard/admin-admission.js'])
</body>
</html>
