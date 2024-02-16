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
    <div id="qr-read" class="w-full p-6 flex-1 flex flex-col justify-center items-center gap-2">
        <div id="msg">Unable to access video stream.</div>
        <div class="w-full max-w-xl flex-1 flex items-center">
            <canvas id="canvas" class="w-full h-full bg-gray-500 rounded-3xl"></canvas>
        </div>
        <button id="reading" type="button" class="text-2xl font-semibold">Reading Start</button>
    </div>
    <div id="result" class="w-full h-full px-20 py-10 flex-1 bg-gray-200 border rounded-lg fixed left-0 right-0 top-0 bottom-0 z-50 hidden" tabindex="-1" aria-hidden="true">
        <div class="flex flex-col gap-10 justify-center">
            <div class="flex items-center justify-center gap-4">
                <x-input-label class="!text-3xl">氏名</x-input-label>
                <div id="student_name" class="text-5xl font-bold"></div>
            </div>
            <div class="flex items-center justify-center gap-4">
                <x-input-label class="!text-3xl">学部</x-input-label>
                <div id="student_faculty" class="text-5xl font-bold"></div>
            </div>
            <div class="flex items-center justify-center gap-4">
                <x-input-label class="!text-3xl">学年</x-input-label>
                <div id="student_grade" class="text-5xl font-bold"></div>
            </div>
            <button id="commit" type="button" class="text-2xl font-semibold px-6 py-3 bg-white rounded-lg shadow hover:bg-blue-800 hover:text-white">入場</button>
            <button id="delete_admission" type="button" class="text-xl">入場処理取消</button>
        </div>
    </div>
    <div class="hidden bg-gray-900/50 "></div>
@vite(['resources/js/dashboard/admin-admission.js'])
    <script>
        window.Laravel = {};
        window.Laravel.user = @json($user);
        // console.log(window.Laravel);
    </script>
</body>
</html>
