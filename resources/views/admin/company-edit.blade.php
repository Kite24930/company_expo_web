<x-dashboard.template title="Dashboard" css="dashboard/dashboard.css" :overview="$overview">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50">
        <div class="text-3xl flex justify-center items-center">
            <x-symbols.setting class="mr-2" />企業詳細設定
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
        <form id="sendForm" method="POST" action="{{ route('admin.company.edit.post', $company->user_id) }}" class="w-full flex flex-col items-start m-auto gap-3 px-4" enctype="multipart/form-data">
            @csrf
            <x-dashboard.text-card title="会社名" required :value="$company->company_name" setId="company_name" class="max-w-xl" />
            <x-dashboard.text-card title="会社名（ふりがな）" required :value="$company->company_name_ruby" setId="company_name_ruby" class="max-w-xl" />
            <div class="rounded-2xl bg-white border px-4 py-6 w-full max-w-lg">
                <div class="flex items-center gap-3">
                    企業ロゴ
                    <div class="inline-block px-2 py-1 text-xs rounded bg-gray-300">任意</div>
                </div>
                <div class="color-required text-sm">※ 画像を変更する場合は、新しい画像を選択してください。</div>
                @if($company->company_logo)
                    <img src="{{ asset($company->company_logo) }}" alt="{{ $company->company_name }}" class="rounded-full h-8 w-8 object-cover my-2" id="logo-preview">
                @else
                    <img src="http://via.placeholder.com/50x50" alt="{{ $company->company_name }}" class="rounded-full h-8 w-8 object-cover my-2" id="logo-preview">
                @endif
                <input type="file" name="company_logo" accept="image/jpeg, image/png" id="company-logo">
            </div>
            <x-dashboard.submit-button id="submitBtn">更新</x-dashboard.submit-button>
        </form>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.overview = @json($overview);
        console.log(window.Laravel);
    </script>
    @vite(['resources/js/dashboard/company-detail.js'])
</x-dashboard.template>
