<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/icon.png') }}">
    <meta name="robots" content="noindex,nofollow"> <!-- 管理画面なのでクロールしない -->
    <title>企業ブースQR発行</title>
    <link rel="stylesheet" href="https://unpkg.com/sanitize.css">
    @vite(['resources/css/qr-issue-small.css'])
</head>
<body>
@foreach($layouts as $layout)
    <div class="w-full h-full flex flex-col justify-between items-center gap-6 px-4 py-10 card relative" style="background-image: url('{{ asset('storage/postcard_background.png') }}')">
        <div class="flex justify-start w-full">
            <div>
                <div class="text-sm px-6 py-3 rounded-lg flex flex-col gap-2 items-start">
                    <div>
                        {{ __(date('n/j', strtotime($layout->date)).' '.$layout->period) }}
                    </div>
                    <div class="text-5xl font-bold underline">
                        {{ __('No.'.$layout->booth_number) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="text-2xl flex justify-center items-center border p-4 rounded-lg shadow bg-white">
            {{ $layout->company_name }}
        </div>
        <div class="flex flex-col items-center gap-2">
            <div class="text-sm">▼訪問処理用QRコード▼</div>
            <div class="shadow border p-2 rounded-lg bg-white">
                <img src="{{ $layout->qr }}" alt="" class="h-48">
            </div>
        </div>
    </div>
@endforeach
<script>
    window.Laravel = {};
    window.Laravel.layouts = @json($layouts);
    console.log(window.Laravel)
</script>
@vite(['resources/js/qr-issue.js'])
</body>
</html>
