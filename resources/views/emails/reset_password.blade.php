<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ config('app.name') }}
        <br>
        パスワードリセットメール
    </div>
    <div class="mb-4 text-sm text-gray-600">
        このメールは、パスワードリセットの申請を受け付けたため、送信されています。
        <br>
        お心当たりがない場合は、このメールを破棄してください。
    </div>
    <div class="mb-4 text-sm text-gray-600">
        パスワードリセットをご希望の場合は、以下のリンクをクリックしてください。
    </div>
    <div class="mb-4 text-sm text-gray-600 flex justify-center">
        <x-elements.link-button :href="$reset_url">パスワードリセット</x-elements.link-button>
    </div>
</x-guest-layout>
