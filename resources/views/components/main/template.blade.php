<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/icon.png') }}">
    <meta name="robots" content="noindex,nofollow"> <!-- 管理画面なのでクロールしない -->
    <title>{{ $title }}</title>
    @if($description)
        <meta name="description" content="{{ $description }}">
    @endif
    <link rel="stylesheet" href="https://unpkg.com/sanitize.css">
    @vite(['resources/css/'.$css])
</head>
<body>
<x-dashboard.header :overview="$overview">

</x-dashboard.header>
{{ $slot }}
<x-dashboard.footer>

</x-dashboard.footer>
</body>
</html>
