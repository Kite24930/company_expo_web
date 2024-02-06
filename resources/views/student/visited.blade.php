<x-template title="訪問企業一覧" css="dashboard/student.css" :overview="$overview" :isAdmission="$is_admission">
    <main class="w-full min-h-screen flex flex-col items-center gap-4 p-2">
        <h1 class="text-title md:text-2xl text-xl">訪問企業一覧</h1>
        <div class="text-sm">企業名をクリックすると企業詳細画面に移動できます。<br>訪問企業への情報開示設定を変更できます。</div>
        <x-input-label class="text-red-500 text-xs max-w-lg">※学部と学年は常に企業に開示されます。開示を許可すると氏名やメールアドレス、住所、出身地がフォローした企業に開示されます。</x-input-label>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
        <div class="w-full p-4 bg-white border rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($companies as $company)
                    <div class="w-full bg-white border rounded-lg shadow-md">
                        <div class="p-4 flex flex-col gap-2">
                            <div>
                                <div class="bg-[#4B6FA6] rounded px-4 py-1 text-xs text-white inline-block">
                                    {{ __(date('n/j', strtotime($company->date)).' '.$company->period.' No.'.$company->booth_number) }}
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($company->company_logo)
                                    <img src="{{ asset('storage/company/'.$company->company_id.'/'.$company->company_logo) }}" alt="{{ $company->company_name }}" class="w-10 h-10 object-cover rounded-full border">
                                @else
                                    <div class="w-10 h-10 flex justify-center items-center border rounded-full">
                                        <x-symbols.company class="" />
                                    </div>
                                @endif
                                <div class="flex items-start justify-between flex-1">
                                    <div class="flex flex-col gap-1">
                                        <a href="{{ route('company.detail', $company->company_id) }}" class="text-lg font-bold hover:underline">{{ $company->company_name }}</a>
                                        <div class="text-sm">{{ $company->industry_name }}</div>
                                    </div>
                                    <button type="button" class="follow-btn h-10 w-10 rounded-full flex justify-center items-center border" data-target="{{ $company->company_id }}">
                                        <x-symbols.bookmark-fill class="w-full h-full" />
                                    </button>
                                </div>
                            </div>
                            <div>
                                <div class="py-2.5 font-semibold text-sm">情報開示設定</div>
                                <label class="flex items-center cursor-pointer px-2.5">
                                    <span class="me-3 text-sm font-medium text-gray-900">開示を許可しない</span>
                                    <div class="relative inline-flex items-center cursor-pointer">
                                        <input id="{{ __('disclosure_'.$company->company_id) }}" name="{{ __('disclosure_'.$company->company_id) }}" type="checkbox" value="disclosure" class="sr-only peer disclosure" {{ $company->disclosure === 1 ? __('checked') : '' }} data-target="{{ $company->company_id }}">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </div>
                                    <span class="ms-3 text-sm font-medium text-gray-900">開示を許可する</span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.companies = @json($companies);
        window.Laravel.student = @json($student);
        window.Laravel.user = @json($user);
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/visit.js'])
</x-template>
