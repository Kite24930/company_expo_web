<x-dashboard.template title="Dashboard" css="dashboard/dashboard.css" :overview="$overview">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50">
        <div class="text-3xl flex justify-center items-center">
            <x-symbols.setting class="mr-2" />基本設定
        </div>
        @if (session('success'))
            <div class="flex justify-center items-center w-full">
                <div class="mb-4 font-medium text-sm text-green-600 p-2 rounded-md bg-green-100">
                    {{ session('success') }}
                </div>
            </div>
        @elseif (session('error'))
            <div class="flex justify-center items-center w-full">
                <div class="mb-4 font-medium text-sm text-red-600 p-2 rounded-md bg-red-100">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <form id="sendForm" method="POST" action="{{ route('admin.setting.post') }}" class="w-full flex flex-col items-start m-auto gap-3 px-4">
            @csrf
            <x-dashboard.text-card title="イベント対象者" required :value="$overview->target" setId="target" class="max-w-xl" />
            <x-dashboard.text-card title="イベント名" required :value="$overview->title" setId="title" class="max-w-xl" />
            <x-dashboard.md-box title="補足・備考" required :value="$overview->description" class="w-full" setId="description" />
            <x-dashboard.text-card title="開催場所" required :value="$overview->place" setId="place" class="max-w-xl" />
            <x-dashboard.toggle title="ピリオド企業切り替わりあり" required :value="$overview->period_change_status" setId="period_change_status" class="max-w-xl" description="ピリオド切り替わり時に企業の入れ替えがあるかどうか" />
            <x-dashboard.md-box title="フッター【主催・共催】" required :value="$overview->footer_hosts" setId="footer_hosts" class="w-full" />
            <x-dashboard.md-box title="フッター【担当者】" required :value="$overview->footer_in_charge" setId="footer_in_charge" class="w-full" />
            <x-dashboard.submit-button id="submitBtn">更新</x-dashboard.submit-button>
        </form>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.overview = @json($overview);
        console.log(window.Laravel);
    </script>
    @vite(['resources/js/dashboard/admin-setting.js'])
</x-dashboard.template>
