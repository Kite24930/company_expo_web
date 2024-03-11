<x-dashboard.template :title="__($company->company_name.' 詳細')" css="dashboard/corporate-edit.css" :overview="$overview" hide="true">
    <main class="w-full min-h-screen md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50 flex flex-col items-center full md:pr-2.5">
        <button type="button" id="follow_btn" class="fixed bottom-24 right-4 w-12 h-12 bg-white bg-opacity-50 flex justify-center items-center rounded-full cursor-pointer z-50 shadow @guest not-login @endguest" data-target="{{ $company->company_id }}">
            @if($is_followed)
                <x-symbols.bookmark-fill />
            @else
                <x-symbols.bookmark />
            @endif
        </button>
        <div class="w-full md:px-10 flex justify-center">
            <div class="md:bg-white rounded-lg md:border shadow w-full max-w-3xl flex flex-col">
                <div id="company_header" class="w-full flex justify-start gap-4 p-4">
                    <div id="company_logo_wrapper" class="w-12 h-12 relative">
                        @if($company->company_logo)
                            <img id="company_logo" src="{{ asset('storage/company/' . $company->company_id . '/' . $company->company_logo . '?token=' . Str::random(5)) }}" alt="{{ $company->company_name }}" class="w-full h-full object-cover rounded-full border">
                        @else
                            <div class="w-12 h-12 flex justify-center items-center border rounded-full">
                                <x-symbols.company class="" />
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col gap-1">
                        <div id="company_name" class="font-bold relative">
                            {{ $company->company_name }}
                        </div>
                        <div id="industry_name_head" class="text-xs relative">
                            {{ $company->industry_name }}
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute md:relative bottom-0 left-0 bg-[#4B6FA6] rounded-tr md:rounded z-30 px-4 py-1 text-xs text-white inline-block md:ml-4 md:mb-4">
                        {{ __(date('n/j', strtotime($company->date)).' '.$company->period.' No.'.$company->booth_number) }}
                    </div>
                    <div id="company_img_wrapper" class="relative">
                        @if($company->company_img)
                            <img id="company_img" src="{{ asset('storage/company/'.$company->company_id.'/'.$company->company_img.'?token='.Str::random(5)) }}" alt="{{ $company->company_name }}" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover z-20">
                        @else
                            <img id="company_img" src="{{ asset('storage/company/default.jpg') }}" alt="イメージ画像" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover z-20">
                        @endif
                    </div>
                </div>
                <div class="py-6 px-2">
                    <div class="flex flex-col gap-4">
                        <div class="flex justify-center text-xs md:hidden">
                            企業情報
                        </div>
                        <div class="py-6 px-4 gap-4 flex flex-col">
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    業種・業態
                                </x-elements.category-title>
                                <x-elements.category-content id="industry_name" class="relative">
                                    {{ $company->industry_name }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    事業内容
                                </x-elements.category-title>
                                <x-elements.category-content id="business_detail" class="relative">
                                    <div id="business_detail_viewer"></div>
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    企業PR
                                </x-elements.category-title>
                                <x-elements.category-content id="pr" class="relative">
                                    <div id="pr_viewer"></div>
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    募集職種
                                </x-elements.category-title>
                                <x-elements.category-content id="occupation" class="relative">
                                    <ul class="list-disc list-inside">
                                        @if($occupations && $occupations->count() > 0)
                                            @foreach($occupations as $item)
                                                <li>{{ $item->recruit_occupation }}</li>
                                            @endforeach
                                        @else
                                            <li>未入力</li>
                                        @endif
                                    </ul>
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    仕事内容
                                </x-elements.category-title>
                                <x-elements.category-content id="job_detail" class="relative">
                                    <div id="job_detail_viewer"></div>
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    対象学生
                                </x-elements.category-title>
                                <x-elements.category-content id="faculty" class="relative">
                                    <ul class="list-disc list-inside">
                                        @if($target && $target->count() > 0)
                                            @foreach($target as $item)
                                                <li>{{ $item->faculty_name }}</li>
                                            @endforeach
                                        @else
                                            <li>未選択</li>
                                        @endif
                                    </ul>
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    本社所在地
                                </x-elements.category-title>
                                <x-elements.category-content id="head_office_address_wrapper" class="w-full relative">
                                    <div id="head_office_address" class="mb-2">
                                        {{ $company->head_office_address }}
                                    </div>
                                    <div id="head_office_map" class="w-full h-56 border rounded"></div>
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    設立年月
                                </x-elements.category-title>
                                <x-elements.category-content id="established_at" class="relative">
                                    {{ date('Y年n月', strtotime($company->established_at)) }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    資本金
                                </x-elements.category-title>
                                <x-elements.category-content id="capital" class="relative">
                                    {{ __(\App\Helpers\CurrencyHelper::formatCurrency($company->capital).'円') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    売上金
                                </x-elements.category-title>
                                <x-elements.category-content id="sales" class="relative">
                                    @if($company->sales)
                                        {{ __(\App\Helpers\CurrencyHelper::formatCurrency($company->sales).'円') }}
                                    @else
                                        非公開
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    従業員数
                                </x-elements.category-title>
                                <x-elements.category-content id="employees" class="relative">
                                    {{ __($company->employees.'人') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    三重大学OB・OG数
                                </x-elements.category-title>
                                <x-elements.category-content id="mie_univ_ob_og" class="relative">
                                    {{ __($company->mie_univ_ob_og.'人') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用予定人数
                                </x-elements.category-title>
                                <x-elements.category-content id="planned_number" class="relative">
                                    @if($company->planned_number)
                                        {{ __($company->planned_number.'人程度') }}
                                    @else
                                        未定
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            @if($branch_offices && $branch_offices->count() > 0)
                                <x-elements.category-wrapper>
                                    <x-elements.category-title>
                                        勤務地
                                    </x-elements.category-title>
                                    <x-elements.category-content id="branch_offices" class="w-full relative">
                                        <div id="branch_offices_wrapper" class="flex flex-col gap-2 mb-2">
                                            @foreach($branch_offices as $item)
                                                <x-elements.office-item :title="$item->office_name" :address="$item->office_address" />
                                            @endforeach
                                        </div>
                                        <div id="office_map" class="w-full h-56 border rounded"></div>
                                    </x-elements.category-content>
                                </x-elements.category-wrapper>
                            @endif
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当部署名
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_department" class="relative">
                                    {{ __($company->recruit_department) }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当者
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_in_charge_person" class="relative">
                                    {{ __($company->recruit_in_charge_person.'('.$company->recruit_in_charge_person_ruby.')') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当電話番号
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_in_charge_tel" class="relative">
                                    @if($company->recruit_in_charge_tel)
                                        {{ __($company->recruit_in_charge_tel) }}
                                    @else
                                        非公開
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当メールアドレス
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_in_charge_email" class="relative">
                                    {{ __($company->recruit_in_charge_email) }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    企業Webサイト
                                </x-elements.category-title>
                                <x-elements.category-content id="url" class="relative">
                                    @if($company->url)
                                        <a href="{{ $company->url }}" target="_blank" class="text-blue-500 underline">
                                            Webサイトを見る
                                        </a>
                                    @else
                                        未入力
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.company = @json($company);
        window.Laravel.branch_offices = @json($branch_offices);
        window.Laravel.occupations = @json($occupations);
        window.Laravel.target = @json($target);
        @auth
            window.Laravel.is_followed = @json($is_followed);
            window.Laravel.is_admission = @json($is_admission);
            window.Laravel.student = @json($student);
            window.Laravel.user = @json($user);
        @endauth
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/company-detail.js'])
</x-dashboard.template>
