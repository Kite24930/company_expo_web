<x-dashboard.template title="企業情報編集" css="dashboard/corporate-edit.css" :overview="$overview" hide="true">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50 flex flex-col items-center full md:pr-2.5">
        @if($msg)
            <div class="p-2 bg-green-200 text-green-800 text-lg rounded-lg text-left w-full max-w-3xl my-4">
                {{ $msg }}
            </div>
        @endif
        <div class="w-full md:px-10 flex justify-center">
            <div class="md:bg-white rounded-lg md:border w-full max-w-3xl flex flex-col">
                <div id="company_header" class="w-full flex justify-start gap-4 p-4">
                    <div id="company_logo_wrapper" class="w-12 h-12">
                        @if($company->company_logo)
                            <img id="company_logo" src="{{ asset('storage/company/' . $company->id . '/' . $company->company_logo . '?token=' . Str::random(5)) }}" alt="{{ $company->company_name }}" class="w-full h-full object-cover rounded-full border">
                        @else
                            <img id="company_logo" src="{{ __('https://placehold.jp/3d4070/ffffff/150x150.png?text=logo') }}" alt="logo" class="w-full h-full object-cover rounded-full border">
                        @endif
                    </div>
                    <div class="flex flex-col gap-1">
                        <div id="company_name" class="font-bold">
                            {{ $company->company_name }}
                        </div>
                        <div id="industry_name_head" class="text-xs">
                            @if($industry)
                                {{ $industry->industry_name }}
                            @else
                                業種
                            @endif
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute md:relative bottom-0 left-0 bg-[#4B6FA6] rounded-tr md:rounded z-30 px-4 py-1 text-xs text-white inline-block md:ml-4 md:mb-4">
                        XX/XX 第○部
                    </div>
                    <div id="company_img_wrapper" class="relative">
                        @if($company->company_img)
                            <img id="company_img" src="{{ $comapny->company_img }}" alt="{{ $company->company_name }}" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover z-20">
                        @else
                            <img id="company_img" src="{{ __('https://placehold.jp/99cccc/ffffff/800x500.png?text=%E3%82%A4%E3%83%A1%E3%83%BC%E3%82%B8%E7%94%BB%E5%83%8F') }}" alt="イメージ画像" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover z-20">
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
                                <x-elements.category-content id="industry_name">
                                    @if($industry)
                                        {{ $industry->industry_name }}
                                    @else
                                        未選択
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    事業内容
                                </x-elements.category-title>
                                <x-elements.category-content id="business_detail">
                                    @if($company->business_detail)
                                        <div id="business_detail_viewer"></div>
                                    @else
                                        未入力
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    企業PR
                                </x-elements.category-title>
                                <x-elements.category-content id="pr">
                                    @if($company->pr)
                                        <div id="pr_viewer"></div>
                                    @else
                                        未入力
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    募集職種
                                </x-elements.category-title>
                                <x-elements.category-content id="occupation">
                                    @if($occupations && $occupations->count() > 0)
                                        <ul>
                                            @foreach($occupations as $item)
                                                <li>{{ $item->occupation_name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        未入力
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    仕事内容
                                </x-elements.category-title>
                                <x-elements.category-content id="job_detail">
                                    @if($company->job_detail)
                                        <div id="job_detail_viewer"></div>
                                    @else
                                        未入力
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    対象学生
                                </x-elements.category-title>
                                <x-elements.category-content id="faculty">
                                    @if($target && $target->count() > 0)
                                        <ul>
                                            @foreach($target as $item)
                                                <li>{{ $item->faculty_name }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        未選択
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    本社所在地
                                </x-elements.category-title>
                                <x-elements.category-content id="head_office_address">
                                    {{ $company->head_office_address }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    設立年月
                                </x-elements.category-title>
                                <x-elements.category-content id="established_at">
                                    {{ date('Y年n月', strtotime($company->established_at)) }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    資本金
                                </x-elements.category-title>
                                <x-elements.category-content id="capital">
                                    {{ __($company->capital.'万円') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    売上金
                                </x-elements.category-title>
                                <x-elements.category-content id="sales">
                                    @if($company->sales)
                                        {{ __($company->sales.'万円') }}
                                    @else
                                        未入力
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    従業員数
                                </x-elements.category-title>
                                <x-elements.category-content id="employees">
                                    {{ __($company->employees.'人') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    三重大学OB・OG数
                                </x-elements.category-title>
                                <x-elements.category-content id="mie_univ_ob_og">
                                    {{ __($company->mie_univ_ob_og.'人') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用予定人数
                                </x-elements.category-title>
                                <x-elements.category-content id="planned_number">
                                    @if($company->planned_number)
                                        {{ __($company->planned_number.'人') }}
                                    @else
                                        未定
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    勤務地
                                </x-elements.category-title>
                                <x-elements.category-content id="branch_offices">
                                    @if($branch_offices && $branch_offices->count() > 0)
                                        <ul>
                                            @foreach($branch_offices as $item)
                                                <li>{{ $item->office_name }}</li>
                                            @endforeach
                                        </ul>
                                        <div id="office_map"></div>
                                    @else
                                        未入力
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当部署名
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_department">
                                    {{ __($company->recruit_department) }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当者
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_in_charge_person">
                                    {{ __($company->recruit_in_charge_person.'('.$company->recruit_in_charge_person_ruby.')') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当電話番号
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_in_charge_tel">
                                    @if($company->recruit_in_charge_tel)
                                        {{ __($company->recruit_in_charge_tel) }}
                                    @else
                                        未入力
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当メールアドレス
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_in_charge_email">
                                    {{ __($company->recruit_in_charge_email) }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    企業Webサイト
                                </x-elements.category-title>
                                <x-elements.category-content id="url">
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
    <div id="modalWrapper" class="fixed top-0 bottom-0 left-0 right-0 w-full h-full bg-gray-600 bg-opacity-50 z-50 flex justify-center items-center">
        @csrf
        <input id="company_id" type="hidden" value="{{ $company->id }}" class="text-green-500 bg-green-100 text-red-500 bg-red-100">
        <input id="api_token" type="hidden" value="{{ Auth::user()->api_token }}">
        <div class="relative w-full h-full flex justify-center items-center">
            <div class="absolute top-10 right-10 flex flex-col items-end gap-6">
                <button id="modalClose" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white hover:bg-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </button>
                <div id="indicator" class="bg-white px-4 py-2 text-sm rounded">
                    Edit now...
                </div>
            </div>
            <x-elements.modal-item setId="company_name_edit" title="企業名編集" class="hidden">
                <div class="w-full">
                    <x-input-label for="company_name_input">企業名</x-input-label>
                    <x-text-input id="company_name_input" class="w-full" value="{{ $company->company_name }}" placeholder="企業名" />
                </div>
                <div class="w-full">
                    <x-input-label for="company_name_ruby_input">企業名（ふりがな）</x-input-label>
                    <x-text-input id="company_name_ruby_input" class="w-full" value="{{ $company->company_name_ruby }}" placeholder="企業名（ふりがな）" />
                    <x-input-label class="text-xs text-red-500">
                        ※検索や並び替えに使用しますので、株式会社等の表記はいりません。
                        <br>
                        例) 株式会社山田 → やまだ
                    </x-input-label>
                </div>
                <x-elements.button id="company_name_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="company_industry_edit" title="業種変更" class="hidden">
                <div class="w-full">
                    <x-input-label for="company_industry_input">業種</x-input-label>
                    <x-select-input id="company_industry_input" class="w-full">
                        <option value="0" class="hidden">業種を選択してください。</option>
                        @foreach($industries as $major_industry)
                            <optgroup label="{{ $major_industry['name'] }}">
                                @foreach($major_industry['industries'] as $middle_industry)
                                    <option value="{{ $middle_industry->industry_id }}" @if($industry && $industry->industry_id === $middle_industry->industry_id) selected @endif>
                                        {{ $middle_industry->industry_name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </x-select-input>
                </div>
                <x-elements.button id="company_industry_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="company_logo_edit" title="企業ロゴ編集" class="hidden">
                <div class="w-full">
                    <x-input-label for="company_logo_input_wrapper" class="mb-2">企業ロゴ</x-input-label>
                    <div id="company_logo_input_wrapper" class="p-2 border rounded-lg inline-flex items-center gap-2 hover:bg-gray-300 cursor-pointer">
                        @if($company->company_logo)
                            <img id="company_logo_preview" src="{{ asset('storage/company/' . $company->id . '/' . $company->company_logo) }}" alt="{{ $company->company_name }}" class="w-12 h-12 object-cover rounded-full border">
                        @else
                            <img id="company_logo_preview" src="{{ __('https://placehold.jp/3d4070/ffffff/150x150.png?text=logo') }}" alt="logo" class="w-12 h-12 object-cover rounded-full border">
                        @endif
                        <x-input-label class="font-semibold cursor-pointer">企業ロゴを変更する</x-input-label>
                        <input id="company_logo_input" type="file" accept="image/jpeg, image/png" class="hidden">
                    </div>
                </div>
                <x-elements.button id="company_logo_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
        </div>
    </div>
    <script>
        window.Laravel = {};
        window.Laravel.industries = @json($industries);
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/corporate/corporate-edit.js'])
</x-dashboard.template>
