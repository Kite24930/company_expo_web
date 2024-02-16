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
    @vite(['resources/css/qr-issue.css'])
</head>
<body>
@foreach($layouts as $layout)
    <div class="w-full h-full flex flex-col justify-between items-center gap-10 p-20">
        <div class="flex justify-between w-full px-10">
            <div>
                <div class="text-5xl p-10 bg-blue-950 text-white rounded-lg flex flex-col items-center gap-10">
                    <div>
                        {{ __(date('n/j', strtotime($layout->date)).' '.$layout->period) }}
                    </div>
                    <div class="text-[100px]">
                        {{ __('No.'.$layout->booth_number) }}
                    </div>
                </div>
            </div>
            <div>
                <img src="{{ $layout->qr }}" alt="" class="h-96">
            </div>
        </div>
        <div class="text-[125px] flex-1 flex justify-center items-center">{{ $layout->company_name }}</div>
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
