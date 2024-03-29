<x-dashboard.template title="企業情報編集" css="dashboard/corporate-edit.css" :overview="$overview" hide="true">
    <main class="w-full min-h-screen md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50 flex flex-col items-center full md:pr-2.5">
        <div class="p-2 bg-blue-200 text-blue-800 text-lg rounded-lg text-left w-full max-w-3xl my-4 border border-gray-800">
            各項目を編集する場合は、項目上の編みかけ部分をクリックしてください。
        </div>
        @if($msg)
            <div class="p-2 bg-green-200 text-green-800 text-lg rounded-lg text-left w-full max-w-3xl my-4">
                {{ $msg }}
            </div>
        @endif
        <div class="w-full md:px-10 flex justify-center">
            <div class="md:bg-white rounded-lg md:border w-full max-w-3xl flex flex-col">
                <div id="company_header" class="w-full flex justify-start gap-4 p-4">
                    <div id="company_logo_wrapper" class="w-12 h-12 relative">
                        <x-elements.edit-cover target="company_logo_edit" size="24" />
                        @if($company->company_logo)
                            <img id="company_logo" src="{{ asset('storage/company/' . $company->id . '/' . $company->company_logo . '?token=' . Str::random(5)) }}" alt="{{ $company->company_name }}" class="w-full h-full object-cover rounded-full border">
                        @else
                            <img id="company_logo" src="{{ __('https://placehold.jp/3d4070/ffffff/150x150.png?text=logo') }}" alt="logo" class="w-full h-full object-cover rounded-full border">
                        @endif
                    </div>
                    <div class="flex flex-col gap-1">
                        <div id="company_name" class="font-bold relative">
                            <x-elements.edit-cover target="company_name_edit" size="24" />
                            {{ $company->company_name }}
                        </div>
                        <div id="industry_name_head" class="text-xs relative">
                            <x-elements.edit-cover target="company_industry_edit" size="15" />
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
                        <x-elements.edit-cover target="company_img_edit" size="100" />
                        @if($company->company_img)
                            <img id="company_img" src="{{ asset('storage/company/'.$company->id.'/'.$company->company_img.'?token='.Str::random(5)) }}" alt="{{ $company->company_name }}" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover z-20">
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
                                <x-elements.category-content id="industry_name" class="relative">
                                    <x-elements.edit-cover target="company_industry_edit" size="24" />
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
                                <x-elements.category-content id="business_detail" class="relative">
                                    <x-elements.edit-cover target="business_detail_edit" size="24" />
                                    <div id="business_detail_viewer"></div>
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    企業PR
                                </x-elements.category-title>
                                <x-elements.category-content id="pr" class="relative">
                                    <x-elements.edit-cover target="pr_edit" size="24" />
                                    <div id="pr_viewer"></div>
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    募集職種
                                </x-elements.category-title>
                                <x-elements.category-content id="occupation" class="relative">
                                    <x-elements.edit-cover target="occupation_edit" size="24" />
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
                                    <x-elements.edit-cover target="job_detail_edit" size="24" />
                                    <div id="job_detail_viewer"></div>
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    対象学生
                                </x-elements.category-title>
                                <x-elements.category-content id="faculty" class="relative">
                                    <x-elements.edit-cover target="target_edit" size="24" />
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
                                    <x-elements.edit-cover target="head_office_address_edit" size="24" />
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
                                    <x-elements.edit-cover target="established_at_edit" size="24" />
                                    {{ date('Y年n月', strtotime($company->established_at)) }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    資本金
                                </x-elements.category-title>
                                <x-elements.category-content id="capital" class="relative">
                                    <x-elements.edit-cover target="capital_edit" size="24" />
                                    {{ __($company->capital.'万円') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    売上金
                                </x-elements.category-title>
                                <x-elements.category-content id="sales" class="relative">
                                    <x-elements.edit-cover target="sales_edit" size="24" />
                                    @if($company->sales)
                                        {{ __($company->sales.'万円') }}
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
                                    <x-elements.edit-cover target="employees_edit" size="24" />
                                    {{ __($company->employees.'人') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    三重大学OB・OG数
                                </x-elements.category-title>
                                <x-elements.category-content id="mie_univ_ob_og" class="relative">
                                    <x-elements.edit-cover target="mie_univ_ob_og_edit" size="24" />
                                    {{ __($company->mie_univ_ob_og.'人') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用予定人数
                                </x-elements.category-title>
                                <x-elements.category-content id="planned_number" class="relative">
                                    <x-elements.edit-cover target="planned_number_edit" size="24" />
                                    @if($company->planned_number)
                                        {{ __($company->planned_number.'人程度') }}
                                    @else
                                        未定
                                    @endif
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    勤務地
                                </x-elements.category-title>
                                <x-elements.category-content id="branch_offices" class="w-full relative">
                                    <x-elements.edit-cover target="branch_offices_edit" size="24" />
                                    <div id="branch_offices_wrapper" class="flex flex-col gap-2 mb-2">
                                        @if($branch_offices && $branch_offices->count() > 0)
                                            @foreach($branch_offices as $item)
                                                <x-elements.office-item :title="$item->office_name" :address="$item->office_address" />
                                            @endforeach
                                        @endif
                                    </div>
                                    <div id="office_map" class="w-full h-56 border rounded"></div>
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当部署名
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_department" class="relative">
                                    <x-elements.edit-cover target="recruit_in_charge_edit" size="24" />
                                    {{ __($company->recruit_department) }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当者
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_in_charge_person" class="relative">
                                    <x-elements.edit-cover target="recruit_in_charge_edit" size="24" />
                                    {{ __($company->recruit_in_charge_person.'('.$company->recruit_in_charge_person_ruby.')') }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    採用担当電話番号
                                </x-elements.category-title>
                                <x-elements.category-content id="recruit_in_charge_tel" class="relative">
                                    <x-elements.edit-cover target="recruit_in_charge_edit" size="24" />
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
                                    <x-elements.edit-cover target="recruit_in_charge_edit" size="24" />
                                    {{ __($company->recruit_in_charge_email) }}
                                </x-elements.category-content>
                            </x-elements.category-wrapper>
                            <x-elements.category-wrapper>
                                <x-elements.category-title>
                                    企業Webサイト
                                </x-elements.category-title>
                                <x-elements.category-content id="url" class="relative">
                                    <x-elements.edit-cover target="url_edit" size="24" />
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
    <div id="modalWrapper" class="fixed top-0 bottom-0 left-0 right-0 w-full h-full bg-gray-600 bg-opacity-50 z-50 justify-center items-center hidden">
        @csrf
        <input id="company_id" type="hidden" value="{{ $company->id }}" class="text-green-500 bg-green-100 text-red-500 bg-red-100">
        <input id="api_token" type="hidden" value="{{ Auth::user()->api_token }}">
        <div class="relative w-full h-full flex flex-col justify-center items-center">
            <ul id="errorIndicator" class="bg-white rounded-lg mb-2 hidden w-full max-w-3xl p-4 list-disc list-inside">

            </ul>
            <div class="absolute top-10 right-10 flex flex-col items-end gap-6">
                <button id="modalClose" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white hover:bg-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </button>
                <div id="indicator" class="bg-white px-4 py-2 text-sm rounded">
                    Edit now...
                </div>
            </div>
            <x-elements.modal-item setId="company_name_edit" title="企業名編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="company_name_input">企業名</x-input-label>
                    <x-text-input id="company_name_input" class="w-full" value="{{ $company->company_name }}" placeholder="企業名" />
                </div>
                <div class="w-full">
                    <x-input-label for="company_name_ruby_input">企業名（ふりがな）</x-input-label>
                    <x-text-input id="company_name_ruby_input" class="w-full" value="{{ $company->company_name_ruby }}" placeholder="企業名（ふりがな）" />
                    <x-input-label class="text-xs text-red-500">
                        ※検索や並び替えに使用しますので、株式会社等の表記はいりません。ひらがなでご記入ください。
                        <br>
                        例) 株式会社山田 → やまだ
                    </x-input-label>
                </div>
                <x-elements.button id="company_name_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="company_industry_edit" title="業種変更" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
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
            <x-elements.modal-item setId="company_logo_edit" title="企業ロゴ編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
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
            <x-elements.modal-item setId="company_img_edit" title="企業イメージ画像編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="company_img_edit_wrapper" class="mb-2">企業イメージ画像</x-input-label>
                    <div id="company_img_edit_wrapper" class="relative">
                        @if($company->company_img)
                            <img id="company_img_preview" src="{{ asset('storage/company/'.$company->id.'/'.$company->company_img.'?token='.Str::random(5)) }}" alt="{{ $company->company_name }}" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover z-20">
                        @else
                            <img id="company_img_preview" src="{{ __('https://placehold.jp/99cccc/ffffff/800x500.png?text=%E3%82%A4%E3%83%A1%E3%83%BC%E3%82%B8%E7%94%BB%E5%83%8F') }}" alt="イメージ画像" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover z-20">
                        @endif
                    </div>
                    <div id="company_img_input_wrapper" class="p-2 border rounded-lg inline-flex items-center gap-2 hover:bg-gray-300 cursor-pointer mt-2">
                        <x-input-label class="font-semibold cursor-pointer">企業イメージ画像を変更する</x-input-label>
                        <input id="company_img_input" type="file" accept="image/jpeg, image/png" class="hidden">
                    </div>
                </div>
                <x-elements.button id="company_img_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="business_detail_edit" title="事業内容編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="business_detail_wrapper" class="mb-2">事業内容</x-input-label>
                    <div id="business_detail_editor"></div>
                    <x-input-label class="text-xs text-red-500">
                        ※事業内容は、企業自体が行っている内容をご記入ください。<br>今回の募集職種に関する内容は、仕事内容の項目でご記入ください。
                    </x-input-label>
                    <x-input-label class="text-xs text-green-500">
                        ※編集画面の上部にありますツールバーを使用して、文字の装飾や箇条書きなどを行うことができます。絵文字も使用できます。
                    </x-input-label>
                </div>
                <x-elements.button id="business_detail_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="pr_edit" title="企業PR編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="pr_wrapper" class="mb-2">企業PR</x-input-label>
                    <div id="pr_editor"></div>
                    <x-input-label class="text-xs text-red-500">
                        ※企業PRは、企業の特色など学生に推していきたいポイントをご記入ください。
                    </x-input-label>
                    <x-input-label class="text-xs text-green-500">
                        ※編集画面の上部にありますツールバーを使用して、文字の装飾や箇条書きなどを行うことができます。絵文字も使用できます。
                    </x-input-label>
                </div>
                <x-elements.button id="pr_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="occupation_edit" title="募集職種編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full flex flex-col gap-2">
                    <div id="occupation_insert_point" class="w-full flex flex-col gap-2">
                        @if($occupations && $occupations->count() > 0)
                            @foreach($occupations as $occupation)
                                <x-elements.occupation-item :target="$occupation->id" :value="$occupation->recruit_occupation" />
                            @endforeach
                        @else
                            <x-elements.occupation-item target="0" value="" />
                        @endif
                    </div>
                    <div>
                        <x-elements.add-btn id="occupation-add" />
                    </div>
                    <x-input-label class="text-red-500 text-sm">※募集職種ごとにご記入ください。</x-input-label>
                </div>
                <x-elements.button id="occupation_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="job_detail_edit" title="仕事内容編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="job_detail_wrapper" class="mb-2">募集職種仕事内容</x-input-label>
                    <div id="job_detail_editor"></div>
                    <x-input-label class="text-xs text-red-500">
                        ※企業PRは、企業の特色など学生に推していきたいポイントをご記入ください。
                    </x-input-label>
                    <x-input-label class="text-xs text-green-500">
                        ※編集画面の上部にありますツールバーを使用して、文字の装飾や箇条書きなどを行うことができます。絵文字も使用できます。
                    </x-input-label>
                </div>
                <x-elements.button id="job_detail_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="target_edit" title="対象学生編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full flex flex-col items-start gap-2">
                    @foreach($faculties as $faculty)
                        @if(in_array($faculty->id, $target_list))
                            <x-elements.checkbox :setValue="$faculty->id" :setId="__('target-'.$faculty->faculty_name)" :notation="$faculty->faculty_name" class="target-input" checked />
                        @else
                            <x-elements.checkbox :setValue="$faculty->id" :setId="__('target-'.$faculty->faculty_name)" :notation="$faculty->faculty_name" class="target-input" />
                        @endif
                    @endforeach
                </div>
                <x-elements.button id="target_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="head_office_address_edit" title="本社所在地編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="head_office_address_input">本社所在地</x-input-label>
                    <x-text-input id="head_office_address_input" class="w-full" value="{{ $company->head_office_address }}" placeholder="本社所在地" />
                    <x-input-label class="text-xs text-red-500">
                        ※本社所在地は、都道府県からご記入ください。
                        <br>
                        マップのピンの座標が実際のページでも表示されます。
                        <br>
                        住所を変更したあとは、必ずマップに反映してください。
                    </x-input-label>
                </div>
                <x-elements.button id="head_office_map_btn">
                    本社所在地をマップに反映
                </x-elements.button>
                <div class="w-full">
                    <div id="head_office_edit_map" class="w-full h-56">

                    </div>
                    <x-input-label class="text-xs text-red-500">
                        ※マップのピンはドラッグすることで調整できます。
                        <br>
                        本社所在地をマップに反映後、ズレている場合は調整してください。
                    </x-input-label>
                </div>
                <x-elements.button id="head_office_address_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="established_at_edit" title="設立年月編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="established_at_input">設立年月</x-input-label>
                    <div class="flex gap-2 items-center">
                        <x-text-input id="established_at_year_input" class="w-28" value="{{ date('Y', strtotime($company->established_at)) }}" placeholder="設立年月" type="number" />年
                        <x-select-input id="established_at_month_input">
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" @if((int)date('n', strtotime($company->established_at)) === $i) selected @endif>{{ __($i.'月') }}</option>
                            @endfor
                        </x-select-input>
                    </div>
                    <x-input-label class="text-xs text-red-500">
                        ※設立年月は、西暦でご記入ください。
                    </x-input-label>
                </div>
                <x-elements.button id="established_at_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="capital_edit" title="資本金編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="capital_input">資本金</x-input-label>
                    <div class="flex gap-2 items-center">
                        <x-text-input id="capital_input" class="w-44" value="{{ $company->capital }}" placeholder="資本金" type="number" />万円
                    </div>
                    <x-input-label class="text-xs text-red-500">
                        ※資本金は、万円単位でご記入ください。
                    </x-input-label>
                </div>
                <x-elements.button id="capital_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="sales_edit" title="売上金編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="sales_input">売上金</x-input-label>
                    <div class="flex flex-col gap-2 items-start">
                        @if($company->sales)
                            <x-elements.checkbox :setValue="$company->id" :setId="__('sales_input_null')" :notation="__('売上金を非公開にする')" class="sales-input" />
                            <div class="flex gap-2 items-center">
                                <x-text-input id="sales_input" class="w-44" value="{{ $company->sales }}" placeholder="売上金" type="number" />万円
                            </div>
                        @else
                            <x-elements.checkbox :setValue="$company->id" :setId="__('sales_input_null')" :notation="__('売上金を非公開にする')" class="sales-input" checked />
                            <div class="flex gap-2 items-center">
                                <x-text-input id="sales_input" class="w-44 bg-gray-300" value="{{ $company->sales }}" placeholder="売上金" type="number" disabled />万円
                            </div>
                        @endif
                    </div>
                    <x-input-label class="text-xs text-red-500">
                        ※売上金は、万円単位でご記入ください。
                    </x-input-label>
                </div>
                <x-elements.button id="sales_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="employees_edit" title="従業員数編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="employees_input">従業員数</x-input-label>
                    <div class="flex gap-2 items-center">
                        <x-text-input id="employees_input" class="w-44" value="{{ $company->employees }}" placeholder="従業員数" type="number" />人
                    </div>
                </div>
                <x-elements.button id="employees_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="mie_univ_ob_og_edit" title="三重大学OB・OG数編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="mie_univ_ob_og_input">三重大学OB・OG数</x-input-label>
                    <div class="flex gap-2 items-center">
                        <x-text-input id="mie_univ_ob_og_input" class="w-44" value="{{ $company->mie_univ_ob_og }}" placeholder="三重大学OB・OG数" type="number" />人
                    </div>
                </div>
                <x-elements.button id="mie_univ_ob_og_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="planned_number_edit" title="採用予定人数編集" class="max-h-[80dvh] overflow-y-auto hidden modal-item">
                <div class="w-full">
                    <x-input-label for="planned_number_input">採用予定人数</x-input-label>
                    <div class="flex flex-col gap-2 items-start">
                        @if($company->planned_number)
                            <x-elements.checkbox :setValue="$company->id" :setId="__('planned_number_input_null')" :notation="__('採用予定人数を未定にする')" class="planned-number-input" />
                            <div class="flex gap-2 items-center">
                                <x-text-input id="planned_number_input" class="w-44" value="{{ $company->planned_number }}" placeholder="採用予定人数" type="number" />人程度
                            </div>
                        @else
                            <x-elements.checkbox :setValue="$company->id" :setId="__('planned_number_input_null')" :notation="__('採用予定人数を未定にする')" class="planned-number-input" checked />
                            <div class="flex gap-2 items-center">
                                <x-text-input id="planned_number_input" class="w-44 bg-gray-300" value="{{ $company->planned_number }}" placeholder="採用予定人数" type="number" disabled />人程度
                            </div>
                        @endif
                    </div>
                </div>
                <x-elements.button id="planned_number_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="branch_offices_edit" title="勤務地編集" class="max-h-[80dvh] overflow-y-auto modal-item hidden">
                <div class="w-full">
                    @php $check = true; @endphp
                    @foreach($branch_offices as $branch_office)
                        @if($branch_office->office_name === '本社' && $branch_office->office_address === $company->head_office_address)
                            @php $check = false; @endphp
                        @endif
                    @endforeach
                    @if($check)
                        <button id="branch_insert_head_office_btn" type="button" class="border rounded bg-blue-100 hover:bg-blue-900 hover:text-white px-2 py-1 my-2">本社を勤務地に追加</button>
                    @endif
                    <div class="w-full flex flex-col">
                        <div class="flex gap-2">
                            <x-input-label class="text-sm w-44">勤務地名</x-input-label>
                            <x-input-label class="text-sm">勤務地住所</x-input-label>
                        </div>
                        <div id="branch_office_body" class="flex flex-col w-full gap-2">
                            @foreach($branch_offices as $branch_office)
                                <x-elements.branch-office-item :office="$branch_office" />
                            @endforeach
                            @if(count($branch_offices) === 0)
                                <x-elements.branch-office-add-item target="0" />
                            @endif
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-elements.add-btn id="branch_office_add" />
                    </div>
                    <x-input-label class="text-xs text-red-500">
                        ※勤務地住所は、都道府県からご記入ください。
                        <br>
                        マップのピンの座標が実際のページでも表示されます。
                        <br>
                        住所を変更したあとは、必ずマップに反映してください。
                        <br>
                        登録済みの勤務地名及び勤務地住所は、変更できません。
                        <br>
                        編集したい場合は、一度削除してから追加してください。
                    </x-input-label>
                </div>
                <x-elements.button id="branch_office_map_btn">
                    勤務地をマップに反映
                </x-elements.button>
                <div class="w-full">
                    <div id="branch_office_edit_map" class="w-full h-56">

                    </div>
                    <x-input-label class="text-xs text-red-500">
                        ※マップのピンはドラッグすることで調整できます。
                        <br>
                        勤務地をマップに反映後、ズレている場合は調整してください。
                    </x-input-label>
                </div>
                <x-elements.button id="branch_offices_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="recruit_in_charge_edit" title="採用担当編集" class="max-h-[80dvh] overflow-y-auto modal-item hidden">
                <div class="w-full">
                    <x-input-label for="recruit_department_input">採用担当部署</x-input-label>
                    <div class="flex gap-2 items-center">
                        <x-text-input id="recruit_department_input" class="w-full" value="{{ $company->recruit_department }}" placeholder="採用担当部署" />
                    </div>
                </div>
                <div class="w-full">
                    <x-input-label for="recruit_in_charge_person_input">採用担当者</x-input-label>
                    <div class="flex gap-2 items-center">
                        <x-text-input id="recruit_in_charge_person_input" class="w-full" value="{{ $company->recruit_in_charge_person }}" placeholder="採用担当者" />
                    </div>
                </div>
                <div class="w-full">
                    <x-input-label for="recruit_in_charge_person_ruby_input">採用担当者（ふりがな）</x-input-label>
                    <div class="flex gap-2 items-center">
                        <x-text-input id="recruit_in_charge_person_ruby_input" class="w-full" value="{{ $company->recruit_in_charge_person_ruby }}" placeholder="採用担当者（ふりがな）" />
                    </div>
                    <x-input-label class="text-xs text-red-500">
                        ※ふりがなはひらがなでご入力ください。
                    </x-input-label>
                </div>
                <div class="w-full">
                    <x-input-label for="recruit_in_charge_tel_input">採用担当電話番号[任意]</x-input-label>
                    @if($company->recruit_in_charge_tel !== null)
                        <x-elements.checkbox :setValue="$company->id" :setId="__('recruit_in_charge_tel_input_null')" :notation="__('採用担当電話番号を非表示にする')" class="recruit-in-charge-tel-input" />
                        <div class="flex gap-2 items-center">
                            <x-text-input id="recruit_in_charge_tel_input" class="w-full" value="{{ $company->recruit_in_charge_tel }}" placeholder="採用担当電話番号" type="tel" />
                        </div>
                    @else
                        <x-elements.checkbox :setValue="$company->id" :setId="__('recruit_in_charge_tel_input_null')" :notation="__('採用担当電話番号を非表示にする')" class="recruit-in-charge-tel-input" checked />
                        <div class="flex gap-2 items-center">
                            <x-text-input id="recruit_in_charge_tel_input" class="w-full bg-gray-300" value="{{ $company->recruit_in_charge_tel }}" placeholder="採用担当電話番号" type="tel" desabled />
                        </div>
                    @endif
                    <x-input-label class="text-xs text-red-500">
                        ※採用担当電話番号は任意項目です。
                    </x-input-label>
                </div>
                <div class="w-full">
                    <x-input-label for="recruit_in_charge_email_input">採用担当メールアドレス</x-input-label>
                    <div class="flex gap-2 items-center">
                        <x-text-input id="recruit_in_charge_email_input" class="w-full" value="{{ $company->recruit_in_charge_email }}" placeholder="採用担当メールアドレス" type="email" />
                    </div>
                </div>
                <x-elements.button id="recruit_in_charge_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
            <x-elements.modal-item setId="url_edit" title="企業Webサイト編集" class="max-h-[80dvh] overflow-y-auto modal-item hidden">
                <div class="w-full">
                    <x-input-label for="url_input">企業Webサイト</x-input-label>
                    @if($company->url !== null)
                        <x-elements.checkbox :setValue="$company->id" :setId="__('url_input_null')" :notation="__('企業Webサイトを非表示にする')" class="url-input" />
                        <div class="flex gap-2 items-center">
                            <x-text-input id="url_input" class="w-full" value="{{ $company->url }}" placeholder="企業Webサイト" type="url" />
                        </div>
                    @else
                        <x-elements.checkbox :setValue="$company->id" :setId="__('url_input_null')" :notation="__('企業Webサイトを非表示にする')" class="url-input" checked />
                        <div class="flex gap-2 items-center">
                            <x-text-input id="url_input" class="w-full bg-gray-300" value="{{ $company->url }}" placeholder="企業Webサイト" type="url" desabled />
                        </div>
                    @endif
                    <x-input-label class="text-xs text-red-500">
                        ※企業Webサイトは任意項目です。
                        <br>
                        HPや求人サイトのURLをご記入ください。
                    </x-input-label>
                </div>
                <x-elements.button id="url_btn">
                    更新
                </x-elements.button>
            </x-elements.modal-item>
        </div>
    </div>
    <script>
        window.Laravel = {};
        window.Laravel.company = @json($company);
        window.Laravel.branch_offices = @json($branch_offices);
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/corporate/corporate-edit.js'])
</x-dashboard.template>
