<x-dashboard.template title="Dashboard" css="dashboard/dashboard.css" :overview="$overview">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50">
        <div class="text-3xl flex justify-center items-center">
            <x-symbols.setting class="mr-2" />広告設定
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
        準備中
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.overview = @json($overview);
        console.log(window.Laravel);
    </script>
    @vite(['resources/js/dashboard/dashboard.js'])
</x-dashboard.template>
