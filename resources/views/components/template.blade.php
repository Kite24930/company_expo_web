<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/icon.png') }}">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://unpkg.com/sanitize.css">
    @vite(['resources/css/'.$css])
</head>
<body class="bg-gray-50">
<x-header :overview="$overview" />
{{ $slot }}
@if(isset($isAdmission))
    <x-footer :isAdmission="$isAdmission" />
@else
    <x-footer :isAdmission="false" />
@endif
<x-info :overview="$overview" />
</body>
</html>
