<x-template title="企業一覧" css="main.css" :overview="$overview" :isAdmission="$is_admission">
    <div class="hidden flex items-center justify-between w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow fixed bottom-20 left-4 z-50 toast inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 bg-blue-100 rounded-lg text-sm ms-3 font-normal ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 w-3 h-3"></div>
    <main class="w-full min-h-screen flex flex-col items-center gap-4 px-2">
        <div id="move_page_top" class="fixed bottom-20 right-4 w-12 h-12 bg-white bg-opacity-50 flex justify-center items-center rounded-full cursor-pointer z-50">
            <x-symbols.arrow-up />
        </div>
        <div class="w-full flex md:justify-center justify-start py-4 px-2">
            <h1 class="text-title md:text-2xl text-base">企業一覧</h1>
        </div>
        <div class="w-full flex md:flex-row flex-col min-h-screen pb-4 gap-2">
            <div class="md:w-80 w-full bg-white rounded-r-lg flex flex-col gap-4">
                <div class="relative">
                    <div class="absolute top-0 left-0 flex items-center border-r h-full px-1">
                        <button id="search_btn" class="cursor-pointer w-8 h-8 flex justify-center items-center" type="button">
                            <x-symbols.search />
                        </button>
                    </div>
                    <input id="search" type="text" class="border-gray-300 text-sm w-full pl-12 pr-4 py-2 rounded-lg bg-gray-50" placeholder="フリーワード検索" @if(isset($search['keyword'])) value="{{ $search['keyword'] }}" @endif>
                </div>
                <div>
                    <div>
                        <h2 id="sort_window_toggle_btn" class="px-2">
                            <x-elements.button data-modal-target="sort_window" data-modal-toggle="sort_window" class="w-full" svgCancel="true" >
                                <div class="flex items-center gap-1">
                                    <x-symbols.change-arrow />
                                    <span class="text-white text-sm">検索条件変更</span>
                                </div>
                            </x-elements.button>
                        </h2>
                        <div id="sort_window" class="px-2 hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-500 bg-opacity-50" tabindex="-1" aria-hidden="true">
                            <div class="w-full max-w-lg bg-white max-h-[calc(100dvh-200px)] overflow-y-auto rounded-lg">
                                <div class="flex flex-col w-full rounded-lg border border-gray-300 p-2">
                                    <h2 class="text-xl text-center font-semibold">検索条件変更</h2>
                                    <x-elements.button id="reset_btn" class="w-full my-2" svgCancel="true" >
                                        <div class="flex items-center gap-1">
                                            <x-symbols.search-clear />
                                            <span class="text-white text-sm">条件クリア</span>
                                        </div>
                                    </x-elements.button>
                                    <div class="flex flex-col w-full h-full max-h-80 overflow-y-auto border p-2 rounded-lg">
                                        <div>
                                            <div class="py-2.5 font-semibold text-sm">
                                                フリーワード
                                                <x-input-label class="!text-xs text-red-500">※会社名、事業内容、PR、仕事内容に対して、検索を行います。</x-input-label>
                                            </div>
                                            @if(isset($search['keyword']))
                                                <x-text-input id="search_keyword" class="w-full" placeholder="フリーワード" :value="$search['keyword']" />
                                            @else
                                                <x-text-input id="search_keyword" class="w-full" placeholder="フリーワード" />
                                            @endif
                                        </div>
                                        <div>
                                            <div class="py-2.5 font-semibold text-sm flex gap-2 items-center">
                                                対象学部
                                                <x-primary-button id="faculty_all_select" class="!px-2 !py-1 all-select" data-target="search-faculty">
                                                    全て選択
                                                </x-primary-button>
                                                <x-primary-button id="faculty_all_cancel" class="!px-2 !py-1 all-cancel" data-target="search-faculty">
                                                    全て解除
                                                </x-primary-button>
                                            </div>
                                            <div class="px-2 py-1 max-h-40 overflow-y-auto border flex flex-col gap-2">
                                                @foreach($faculties as $faculty)
                                                    @if($search['faculties'][0] !== '')
                                                        @if(in_array($faculty->id, $search['faculties']))
                                                            <x-elements.checkbox :setId="'search_faculty_'.$faculty->id" :setValue="$faculty->id" :notation="$faculty->faculty_name" class="search-faculty" data-id="{{ $faculty->id }}" checked />
                                                        @else
                                                            <x-elements.checkbox :setId="'search_faculty_'.$faculty->id" :setValue="$faculty->id" :notation="$faculty->faculty_name" class="search-faculty" data-id="{{ $faculty->id }}" />
                                                        @endif
                                                    @else
                                                        <x-elements.checkbox :setId="'search_faculty_'.$faculty->id" :setValue="$faculty->id" :notation="$faculty->faculty_name" class="search-faculty" data-id="{{ $faculty->id }}" checked />
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div>
                                            <div class="py-2.5 font-semibold text-sm flex gap-2 items-center">
                                                業種
                                                <x-primary-button id="industry_all_select" class="!px-2 !py-1 all-select" data-target="search-industry">
                                                    全て選択
                                                </x-primary-button>
                                                <x-primary-button id="industry_all_cancel" class="!px-2 !py-1 all-cancel" data-target="search-industry">
                                                    全て解除
                                                </x-primary-button>
                                            </div>
                                            <div class="px-2 py-1 max-h-40 overflow-y-auto border flex flex-col gap-2">
                                                @foreach($industries as $industry)
                                                    @if($search['industries'][0] !== '')
                                                        @if(in_array($industry->industry_id, $search['industries']))
                                                            <x-elements.checkbox :setId="'search_industry_'.$industry->industry_id" :setValue="$industry->industry_id" :notation="$industry->industry_name" class="search-industry" data-id="{{ $industry->industry_id }}" checked />
                                                        @else
                                                            <x-elements.checkbox :setId="'search_industry_'.$industry->industry_id" :setValue="$industry->industry_id" :notation="$industry->industry_name" class="search-industry" data-id="{{ $industry->industry_id }}" />
                                                        @endif
                                                    @else
                                                        <x-elements.checkbox :setId="'search_industry_'.$industry->industry_id" :setValue="$industry->industry_id" :notation="$industry->industry_name" class="search-industry" data-id="{{ $industry->industry_id }}" checked />
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div>
                                            <div class="py-2.5 font-semibold text-sm">
                                                募集職種
                                            </div>
                                            @if(isset($search['occupation']))
                                                <x-text-input id="search_occupation" class="w-full" placeholder="募集職種" :value="$search['occupation']" />
                                            @else
                                                <x-text-input id="search_occupation" class="w-full" placeholder="募集職種" />
                                            @endif
                                        </div>
                                        <div>
                                            <div class="py-2.5 font-semibold text-sm">
                                                資本金
                                            </div>
                                            <div class="flex gap-2 items-center w-full">
                                                @if(isset($search['capital']))
                                                    <x-text-input id="search_capital" class="flex-1" placeholder="資本金" type="number" :value="$search['capital']" />
                                                @else
                                                    <x-text-input id="search_capital" class="flex-1" placeholder="資本金" type="number" />
                                                @endif
                                                <span class="text-xs">万円</span>
                                                <x-select-input id="search_capital_type" class="text-xs">
                                                    <option value="up" @if(isset($search['capital']) && $search['capital_type'] === 'up') selected @endif>以上</option>
                                                    <option value="down" @if(isset($search['capital']) && $search['capital_type'] === 'down') selected @endif>以下</option>
                                                </x-select-input>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="py-2.5 font-semibold text-sm">
                                                売上高
                                            </div>
                                            <div class="flex gap-2 items-center w-full">
                                                @if(isset($search['sales']))
                                                    <x-text-input id="search_sales" class="flex-1" placeholder="売上高" type="number" :value="$search['sales']" />
                                                @else
                                                    <x-text-input id="search_sales" class="flex-1" placeholder="売上高" type="number" />
                                                @endif
                                                <span class="text-xs">万円</span>
                                                <x-select-input id="search_sales_type" class="text-xs">
                                                    <option value="up" @if(isset($search['sales']) && $search['sales_type'] === 'up') selected @endif>以上</option>
                                                    <option value="down" @if(isset($search['sales']) && $search['sales_type'] === 'down') selected @endif>以下</option>
                                                </x-select-input>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="py-2.5 font-semibold text-sm">
                                                従業員数
                                            </div>
                                            <div class="flex gap-2 items-center w-full">
                                                @if(isset($search['employees']))
                                                    <x-text-input id="search_employees" class="flex-1" placeholder="従業員数" type="number" :value="$search['employees']" />
                                                @else
                                                    <x-text-input id="search_employees" class="flex-1" placeholder="従業員数" type="number" />
                                                @endif
                                                <span class="text-xs">人</span>
                                                <x-select-input id="search_employees_type" class="text-xs">
                                                    <option value="up" @if(isset($search['employees']) && $search['employees_type'] === 'up') selected @endif>以上</option>
                                                    <option value="down" @if(isset($search['employees']) && $search['employees_type'] === 'down') selected @endif>以下</option>
                                                </x-select-input>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="py-2.5 font-semibold text-sm">
                                                三重大学OB・OG数
                                            </div>
                                            <div class="flex gap-2 items-center w-full">
                                                @if(isset($search['mie_univ_ob_og']))
                                                    <x-text-input id="search_mie_univ_ob_og" class="flex-1" placeholder="三重大学OB・OG数" type="number" :value="$search['mie_univ_ob_og']" />
                                                @else
                                                    <x-text-input id="search_mie_univ_ob_og" class="flex-1" placeholder="三重大学OB・OG数" type="number" />
                                                @endif
                                                <span class="text-xs">人</span>
                                                <x-select-input id="search_mie_univ_ob_og_type" class="text-xs">
                                                    <option value="up" @if(isset($search['mie_univ_ob_og']) && $search['mie_univ_ob_og_type'] === 'up') selected @endif>以上</option>
                                                    <option value="down" @if(isset($search['mie_univ_ob_og']) && $search['mie_univ_ob_og_type'] === 'down') selected @endif>以下</option>
                                                </x-select-input>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="py-2.5 font-semibold text-sm flex gap-2 items-center">
                                                勤務地
                                                <x-primary-button id="branch_office_all_select" class="!px-2 !py-1 all-select" data-target="search-branch-office">
                                                    全て選択
                                                </x-primary-button>
                                                <x-primary-button id="branch_office_all_cancel" class="!px-2 !py-1 all-cancel" data-target="search-branch-office">
                                                    全て解除
                                                </x-primary-button>
                                            </div>
                                            <div class="px-2 py-1 max-h-40 overflow-y-auto border flex flex-col gap-2">
                                                @foreach($prefectures as $index => $prefecture)
                                                    @if($search['branch_office'][0] !== '')
                                                        @if(in_array($index, $search['branch_office']))
                                                            <x-elements.checkbox :setId="'search_branch_office_'.$index" :setValue="$index" :notation="$prefecture" class="search-branch-office" checked />
                                                        @else
                                                            <x-elements.checkbox :setId="'search_branch_office_'.$index" :setValue="$index" :notation="$prefecture" class="search-branch-office" />
                                                        @endif
                                                    @else
                                                        <x-elements.checkbox :setId="'search_branch_office_'.$index" :setValue="$index" :notation="$prefecture" class="search-branch-office" checked />
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2.5">
                                        <x-elements.button id="detailed_search_btn" class="w-full" svgCancel="true" >
                                            <div class="flex items-center gap-1">
                                                <x-symbols.search-white />
                                                <span class="text-white text-sm">詳細検索</span>
                                            </div>
                                        </x-elements.button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 p-4 border-t border-r border-l rounded-lg">
                <div class="w-full">
                    <ul class="text-sm flex flex-wrap -mb-px font-medium text-center sticky top-20" id="date_tab" data-tabs-toggle="#period_tab" role="tablist">
                        @foreach($dates as $index => $date)
                            <li class="flex-1" role="presentation">
                                <button class="inline-block px-4 py-2 border-b-2 hover:text-gray-600 hover:border-gray-300 w-full tab-item border border-gray-200 @if($index === 0) rounded-tl-lg @elseif($index === count($dates) - 1) rounded-tr-lg @endif" id="{{ __('date_tab_'.$date->id) }}" data-tabs-target="{{ __('#by_date_'.$date->id) }}" type="button" role="tab" aria-controls="{{ __('by_date_'.$date->id) }}" aria-selected="{{ $index === 0 ? 1 : 0 }}">
                                    {{ date('n-j(D)', strtotime($date->date)) }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div id="period_tab" class="border rounded-b-lg">
                    @foreach($dates as $index => $date)
                        <div id="{{ __('by_date_'.$date->id) }}">
                            <ul class="text-sm flex flex-wrap -mb-px font-medium text-center" id="{{ __('period_tab_'.$date->id) }}" data-tabs-toggle="{{ __('period_inner_tab_'.$date->id) }}" role="tablist">
                                @foreach($periods as $i => $period)
                                    <li class="flex-1" role="presentation">
                                        <button class="inline-block px-4 py-2 border-b-2 hover:text-gray-600 hover:border-gray-300 w-full tab-item border-b border-gray-200" id="{{ __('period_tab_'.$date->id.'_'.$period->id) }}" data-tabs-target="{{ __('#by_period_'.$date->id.'_'.$period->id) }}" type="button" role="tab" aria-controls="{{ __('by_period_'.$date->id.'_'.$period->id) }}" aria-selected="{{ $i === 0 ? 1 : 0 }}">
                                            {{ $period->period }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                            <div id="{{ __('period_inner_tab_'.$date->id) }}" class="border rounded-b-lg overflow-y-auto">
                                @foreach($periods as $i => $period)
                                    <div id="{{ __('by_period_'.$date->id.'_'.$period->id) }}" class="flex flex-wrap p-4 justify-center gap-x-4 gap-y-6">
                                        @if(count($layout[$date->date][$period->period]) === 0)
                                            <div class="w-full text-center">
                                                <p>該当する企業がありません。</p>
                                            </div>
                                        @else
                                            @foreach($layout[$date->date][$period->period] as $company)
                                                <div class="flex flex-col items-center relative w-full max-w-[300px] rounded-lg shadow">
                                                    @if($one_word_pr[$company->company_id])
                                                        <div class="text-xs py-1 px-2 rounded absolute top-0 -left-2 z-20 -rotate-12 text-center" style="{{ __('background-color: '.$one_word_pr[$company->company_id]->background_color.'; color: '.$one_word_pr[$company->company_id]->text_color) }}">
                                                            {!! nl2br(e($one_word_pr[$company->company_id]->one_word_pr)) !!}
                                                        </div>
                                                    @endif
                                                    <div class="company_img_wrapper relative w-full z-10">
                                                        @if($company->company_img === null)
                                                            <img src="{{ asset('storage/company/default.jpg') }}" alt="{{ $company->company_name }}" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover rounded-t-lg">
                                                        @else
                                                            <img src="{{ asset('storage/company/'.$company->company_id.'/'.$company->company_img) }}" alt="{{ $company->company_name }}" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover rounded-t-lg z-20">
                                                        @endif
                                                        <div class="absolute bottom-0 left-0 bg-[#4B6FA6] rounded-tr z-30 px-4 py-1 text-white text-xs">
                                                            {{ __('No. '.$company->booth_number) }}
                                                        </div>
                                                    </div>
                                                    <div class="w-full rounded-b-lg border py-4 px-2 flex flex-col gap-2 flex-1 justify-between">
                                                        <div class="flex flex-col gap-2">
                                                            <div class="flex justify-between">
                                                                <div class="flex gap-2 items-center flex-1 flex-wrap">
                                                                    @foreach($targets[$company->company_id] as $target)
                                                                        <div class="p-1 px-2.5 rounded-full bg-[#637381] text-white text-xs">
                                                                            @if($target->faculty_id < 6 || $target->faculty_id === 11)
                                                                                {{ mb_substr($target->faculty_name, 0, 1) }}
                                                                                @else
                                                                                {{ mb_substr($target->faculty_name, 0, 1).'院' }}
                                                                            @endif

                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <button type="button" class="follow-btn h-8 w-8 rounded-full flex justify-center items-center @guest not-login @endguest" data-target="{{ $company->company_id }}">
                                                                    @auth
                                                                        @if(in_array($company->company_id, $follows))
                                                                            <x-symbols.bookmark-fill class="w-full h-full" />
                                                                        @else
                                                                            <x-symbols.bookmark class="w-full h-full" />
                                                                        @endif
                                                                    @endauth
                                                                    @guest
                                                                        <x-symbols.bookmark class="w-full h-full" />
                                                                    @endguest
                                                                </button>
                                                            </div>
                                                            <div class="flex items-center gap-2">
                                                                @if($company->company_logo)
                                                                    <img src="{{ asset('storage/company/'.$company->company_id.'/'.$company->company_logo) }}" alt="{{ $company->company_name }}" class="w-9 h-9 object-cover rounded-full border">
                                                                @else
                                                                    <div class="w-9 h-9 flex justify-center items-center border rounded-full">
                                                                        <x-symbols.company class="" />
                                                                    </div>
                                                                @endif
                                                                <div class="flex flex-col gap-1">
                                                                    <div class="font-bold">
                                                                        {{ $company->company_name }}
                                                                    </div>
                                                                    <div class="text-xs">
                                                                        {{ $company->industry_name }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="py-0.5 px-2.5 text-xs font-semibold border border-gray-500 inline-block">募集職種</div>
                                                                <div class="flex ml-4 flex-wrap gap-x-4 gap-y-1 pt-2">
                                                                    @foreach($occupations[$company->company_id] as $occupation)
                                                                        <span class="text-xs">
                                                                        ・
                                                                        {{ $occupation->recruit_occupation }}
                                                                    </span>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-center">
                                                            <x-elements.link-button  href="{{ route('company.detail', $company->company_id) }}" class="duration-500 hover:scale-110">
                                                                詳細を見る
                                                            </x-elements.link-button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.filter = @json($filter);
        window.Laravel.layout = @json($layout);
        window.Laravel.branch_offices = @json($branch_offices);
        window.Laravel.targets = @json($targets);
        window.Laravel.occupations = @json($occupations);
        window.Laravel.dates = @json($dates);
        window.Laravel.periods = @json($periods);
        window.Laravel.faculties = @json($faculties);
        window.Laravel.industries = @json($industries);
        window.Laravel.prefectures = @json($prefectures);
        window.Laravel.search = @json($search);
        @auth
            window.Laravel.follows = @json($follows);
            window.Laravel.visitors = @json($visitors);
            window.Laravel.is_admission = @json($is_admission);
            window.Laravel.student = @json($student);
            window.Laravel.user = @json($user);
        @endauth
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/company-list.js'])
</x-template>
