<x-dashboard.template title="Dashboard" css="dashboard/dashboard.css" :overview="$overview">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50">
        <div class="text-3xl flex justify-center items-center">
            <x-symbols.setting class="mr-2" />企業アカウント発行
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
        <form id="sendForm" method="POST" action="{{ route('admin.company.issue.post') }}" class="w-full flex flex-col items-start m-auto gap-3 px-4">
            @csrf
            <x-dashboard.text-card title="登録名" required value="" setId="name" class="max-w-xl" />
            <x-dashboard.text-card title="メールアドレス" required value="" setId="email" class="max-w-xl" />
            <x-dashboard.submit-button id="submitBtn">登録</x-dashboard.submit-button>
        </form>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.overview = @json($overview);
        console.log(window.Laravel);
    </script>
    @vite(['resources/js/dashboard/company-issue.js'])
</x-dashboard.template>
