<x-dashboard.template title="ユーザー一覧" css="dashboard/dashboard.css" :overview="$overview">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50">
        <div class="text-3xl flex justify-center items-center">
            <x-symbols.user-list class="mr-2" />企業一覧
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
        <p class="text-lg border-y text-center my-2">ブース割当て済</p>
        <div class="w-full flex flex-wrap gap-4 justify-center">
            @foreach($layouts as $company)
                <form method="POST" action="{{ route('admin.company.layout.post', $company->company_id) }}" class="max-w-sm w-[30%] p-4 bg-green-100 border border-green-200 rounded-lg shadow text-xs flex flex-col gap-2">
                    @csrf
                    <div class="flex items-center">
                        @if($company->company_logo)
                            <img src="{{ asset('storage/' . $company->company_logo) }}" alt="{{ $company->company_name }}" class="w-8 h-8 rounded-full mr-2" />
                        @else
                            <x-symbols.company class="mr-2" />
                        @endif
                        {{ $company->company_name }}
                    </div>
                    <p class="text-xs">{{ $company->company_name_ruby }}</p>
                    <x-select-input name="distribution_id" class="text-sm">
                        <option class="hidden">ブース番号を選択</option>
                        <option value="0">リセット</option>
                        @foreach($distribution_views as $distribution)
                            <option value="{{ $distribution->id }}" @if($distribution->id === $company->distribution_id) selected @endif>{{ $distribution->date.' '.$distribution->period.' No.'.$distribution->booth_number }}</option>
                        @endforeach
                    </x-select-input>
                    <x-dashboard.add-button type="submit" class="w-full justify-center text-xs !py-1">ブース番号を登録</x-dashboard.add-button>
                    @if($company->mieet_plus_id)
                        <div class="flex items-center">
                            <x-symbols.check class="mr-2" />
                            Mieet Plus 連携済
                        </div>
                    @else
                        <div class="flex items-center">
                            <x-symbols.no-check class="mr-2" />
                            Mieet Plus 未連携
                        </div>
                    @endif
                    <div class="flex items-center">
                        <x-symbols.account class="mr-2" />
                        {{ $company->recruit_in_charge_person }}
                    </div>
                    <div class="flex items-center">
                        <x-symbols.tel class="mr-2" />
                        @if($company->recruit_in_charge_tel)
                            {{ $company->recruit_in_charge_tel }}
                        @else
                            -
                        @endif
                    </div>
                    <div class="flex items-center">
                        <x-symbols.mail class="mr-2" />
                        {{ $company->recruit_in_charge_email }}
                    </div>
                    <x-dashboard.link-button href="{{ route('admin.company.edit', $company->user_id) }}" class="w-full justify-center">編集</x-dashboard.link-button>
                </form>
            @endforeach
        </div>
        <p class="text-lg border-y text-center my-2">ブース未割当て</p>
        <div class="w-full flex flex-wrap gap-4 justify-center">
            @foreach($companies as $company)
                <form method="POST" action="{{ route('admin.company.layout.post', $company->id) }}" class="max-w-sm w-[30%] p-4 bg-white border border-gray-200 rounded-lg shadow text-xs flex flex-col gap-2">
                    @csrf
                    <div class="flex items-center">
                        @if($company->company_logo)
                            <img src="{{ asset('storage/' . $company->company_logo) }}" alt="{{ $company->company_name }}" class="w-8 h-8 rounded-full mr-2" />
                        @else
                            <x-symbols.company class="mr-2" />
                        @endif
                        {{ $company->company_name }}
                    </div>
                    <p class="text-xs">{{ $company->company_name_ruby }}</p>
                    <x-select-input name="distribution_id" class="text-sm">
                        <option class="hidden">ブース番号を選択</option>
                        <option value="0">リセット</option>
                        @foreach($distribution_views as $distribution)
                            <option value="{{ $distribution->id }}">{{ $distribution->date.' '.$distribution->period.' No.'.$distribution->booth_number }}</option>
                        @endforeach
                    </x-select-input>
                    <x-dashboard.add-button type="submit" class="w-full justify-center text-xs !py-1">ブース番号を登録</x-dashboard.add-button>
                    @if($company->mieet_plus_id)
                        <div class="flex items-center">
                            <x-symbols.check class="mr-2" />
                            Mieet Plus 連携済
                        </div>
                    @else
                        <div class="flex items-center">
                            <x-symbols.no-check class="mr-2" />
                            Mieet Plus 未連携
                        </div>
                    @endif
                    <div class="flex items-center">
                        <x-symbols.account class="mr-2" />
                        {{ $company->recruit_in_charge_person }}
                    </div>
                    <div class="flex items-center">
                        <x-symbols.tel class="mr-2" />
                        @if($company->recruit_in_charge_tel)
                            {{ $company->recruit_in_charge_tel }}
                        @else
                            -
                        @endif
                    </div>
                    <div class="flex items-center">
                        <x-symbols.mail class="mr-2" />
                        {{ $company->recruit_in_charge_email }}
                    </div>
                    <x-dashboard.link-button href="{{ route('admin.company.edit', $company->user_id) }}" class="w-full justify-center">編集</x-dashboard.link-button>
                </form>
            @endforeach
        </div>
        <p class="text-lg border-y text-center my-2">情報未登録</p>
        <div class="w-full flex flex-wrap gap-4 justify-center">
            @foreach($company_users as $company)
                <div class="max-w-sm w-[30%] p-4 bg-red-100 border border-red-200 rounded-lg shadow text-xs flex flex-col gap-2">
                    <div class="flex items-center">
                        <x-symbols.company class="mr-2" />
                        {{ $company->name }}
                    </div>
                    <div class="flex items-center">
                        <x-symbols.mail class="mr-2" />
                        {{ $company->email }}
                    </div>
                    <x-dashboard.link-button href="{{ route('admin.company.edit', $company->id) }}" class="w-full justify-center">登録</x-dashboard.link-button>
                </div>
            @endforeach
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.layouts = @json($layouts);
        window.Laravel.companies = @json($companies);
        window.Laravel.company_users = @json($company_users);
        window.Laravel.distribution_views = @json($distribution_views);
        console.log(window.Laravel);
    </script>
    @vite(['resources/js/dashboard/company-list.js'])
</x-dashboard.template>
