<x-template :title="$overview->title" css="main.css" :overview="$overview" :isAdmission="$is_admission">
    <main class="w-full min-h-screen flex flex-col items-center gap-4 px-2">
        <div class="w-full py-10 bg-[#F4F7FF] overflow-hidden relative">
            <div id="background_clip_1" class="absolute -right-[60%] bottom-0 h-full bg-[#e4eafb] z-[3] w-full -skew-x-12">

            </div>
            <div id="background_clip_2" class="absolute -right-[70%] bottom-0 h-full bg-[#dae2fa] z-[5] w-full -skew-x-12">

            </div>
            <div class="flex md:flex-row flex-col gap-9 w-full justify-center md:min-h-[512px] relative z-10">
                <div class="w-full md:w-auto flex flex-col justify-center gap-2 px-4">
                    <div class="text-[#4B6FA6] font-semibold">
                        {{ $overview->target }}
                    </div>
                    <h1 class="text-3xl font-bold">
                        {{ $overview->title }}
                    </h1>
                    <div class="flex items-center gap-2">
                        @foreach (explode('/', $overview->remarks) as $remark)
                            <div class="remark rounded px-2 py-1 text-xs text-gray-800">{{ $remark }}</div>
                        @endforeach
                    </div>
                    <div class="hidden md:flex flex-col gap-2 bg-white p-4 rounded-lg shadow">
                        <div class="flex items-center gap-4">
                            <div class="border border-red-500 inline-block px-2 py-0.5 text-sm text-red-500 font-semibold">
                                日時
                            </div>
                            <div class="flex flex-col gap-1">
                                @foreach ($dates as $date)
                                    <div class="text-red-500 font-semibold">
                                        {{ date('Y/n/j', strtotime($date->date)).'('.$weekdays[date('w', strtotime($date->date))].')' }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex flex-col gap-1">
                                @foreach ($periods as $period)
                                    <div class="text-sm font-semibold">
                                        {{ $period->period }}
                                        {{ date('G:i', strtotime($period->period_start)).'〜'.date('G:i', strtotime($period->period_end)) }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="border border-gray-800 inline-block px-2 py-0.5 text-sm font-semibold">
                                場所
                            </div>
                            <div class="font-semibold">
                                {{ $overview->place }}
                            </div>
                        </div>
                    </div>
                    <div class="text-gray-500 text-sm">
                        {!! nl2br(e($overview->description)) !!}
                    </div>
                </div>
                <div id="img_wrapper" class="w-full min-h-[calc(100dvw-16px)] md:min-h-[512px] max-h-[512px] relative max-w-lg">
                    <div class="absolute top-0 right-0 w-[95%] z-30">
                        <div id="top_img_wrapper" class="max-w-full relative w-full before:content-[''] before:block before:pt-[100%]">
                            <img src="{{ asset('storage/top.jpg') }}" alt="top image" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover rounded-tl-[56px] rounded-br-[56px] object-right shadow">
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 flex items-end gap-6 z-30">
                        <div class="flex flex-col gap-6">
                            <div class="bg-[#6787C4] h-1.5 w-1.5 rounded-full"></div>
                            <div class="bg-[#6787C4] h-1.5 w-1.5 rounded-full"></div>
                            <div class="bg-[#6787C4] h-1.5 w-1.5 rounded-full"></div>
                            <div class="bg-[#6787C4] h-1.5 w-1.5 rounded-full"></div>
                            <div class="bg-[#6787C4] h-1.5 w-1.5 rounded-full"></div>
                        </div>
                        <div class="bg-[#6787C4] h-1.5 w-1.5 rounded-full"></div>
                        <div class="bg-[#6787C4] h-1.5 w-1.5 rounded-full"></div>
                        <div class="bg-[#6787C4] h-1.5 w-1.5 rounded-full"></div>
                        <div class="bg-[#6787C4] h-1.5 w-1.5 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full flex md:hidden flex-col">
            <div class="flex flex-col items-center">
                <h6 class="text-xs text-gray-400 font-semibold">About</h6>
                <h2 class="font-semibold text-xl">開催概要</h2>
            </div>
            <div class="w-full shadow rounded-lg p-4">
                <div class="flex items-center gap-2 text-sm">
                    <x-symbols.date />
                    開催日時
                </div>
                <div class="pl-6 pt-2">
                    @foreach ($dates as $date)
                        <div class="font-semibold text-lg">
                            {{ date('Y/n/j', strtotime($date->date)).'('.$weekdays[date('w', strtotime($date->date))].')' }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full shadow rounded-lg p-4">
                <div class="flex items-center gap-2 text-sm">
                    <x-symbols.time />
                    開催時間
                </div>
                <div class="pl-6 pt-2">
                    @foreach ($periods as $period)
                        <div class="font-semibold text-lg">
                            {{ $period->period }}
                            {{ date('G:i', strtotime($period->period_start)).'〜'.date('G:i', strtotime($period->period_end)) }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-full shadow rounded-lg p-4">
                <div class="flex items-center gap-2 text-sm">
                    <x-symbols.place />
                    開催場所
                </div>
                <div class="font-semibold text-lg pl-6 pt-2">
                    {{ $overview->place }}
                </div>
            </div>
        </div>
        <div id="online" class="w-full flex flex-col items-center pt-6">
            <div class="flex flex-col items-center">
                <h6 class="text-xs text-gray-400 font-semibold">Online</h6>
                <h2 class="font-semibold text-xl">オンライン開催</h2>
            </div>
            <div class="flex flex-col md:flex-row items-center md:justify-center gap-6 mb-6">
                @if(date('Y-m-d') == '2024-03-27' || date('Y-m-d') == '2024-03-28')
                    <a href="https://zoom.us/j/91505849191?pwd=bnBuMkhqN0tnd2JTc1NzUnZ5bFoxdz09" class="relative max-w-xs shadow">
                        <img src="{{ asset('storage/zoom.jpg') }}" alt="オンライン開催" class="relative z-10 rounded-lg">
                        <div class="absolute top-0 left-0 rounded-lg w-full h-full company-list z-20"></div>
                        <div class="absolute bottom-6 left-6 z-30 flex flex-col gap-2">
                            <div class="font-semibold text-white text-xl">Zoomに接続</div>
                            <div class="text-white text-sm">
                                本イベントはオンラインでも開催されます。
                                <br>
                                このボタンからZoomに接続してください。
                            </div>
                        </div>
                        <div class="absolute top-2 right-2 font-medium text-xs text-white z-30">
                            <img src="{{ asset('storage/click.png') }}" alt="Click" class="w-20 h-20 object-contain rotate-12">
                        </div>
                    </a>
                @else
                    <div class="relative max-w-xs shadow">
                        <img src="{{ asset('storage/zoom.jpg') }}" alt="オンライン開催" class="relative z-10 rounded-lg">
                        <div class="absolute top-0 left-0 rounded-lg w-full h-full company-list z-20"></div>
                        <div class="absolute bottom-6 left-6 z-30 flex flex-col gap-2">
                            <div class="font-semibold text-white text-xl">Zoomに接続</div>
                            <div class="text-white text-sm">
                                本イベントはオンラインでも開催されます。
                                <br>
                                このボタンは開催日のみ有効になります。
                            </div>
                        </div>
                    </div>
                @endif
                <div class="max-w-xs md:px-4">
                    <div class="text-base font-semibold text-[#2EA7EB]">オンライン開催について</div>
                    <div class="text-sm text-gray-500">
                        本イベントはオンラインでも開催されます。
                        <br>
                        オンライン開催では、三翠ホールで開催中の企業説明会に参加している企業が約2分程度のプレゼンテーションを順次行います。
                        <br>
                        詳細はタイムテーブルをご確認ください。
                        @if(date('Y-m-d') == '2024-03-27' || date('Y-m-d') == '2024-03-28')
                            <br>
                            ボタンもしくは下記リンクよりZoomに接続できます。
                        @endif
                    </div>
                    <div class="text-xs text-red-500">
                        ※一部企業はオンライン開催には参加いたしません。
                    </div>
                    @if(date('Y-m-d') == '2024-03-27' || date('Y-m-d') == '2024-03-28')
                        <div class="text-xs py-2">
                            <a href="https://zoom.us/j/91505849191?pwd=bnBuMkhqN0tnd2JTc1NzUnZ5bFoxdz09" class="underline bg-blue-500 text-white hover:bg-blue-700 p-2 rounded">
                                Zoomに接続
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div id="time_table" class="w-full max-w-xl rounded-lg shadow">
                <h2 id="period_1_head">
                    <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-lg focus:ring-4 focus:ring-gray-200" aria-expanded="false" aria-controls="period_1_body">
                        <span class="text-sm">3/27(Wed) タイムテーブル</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="period_1_body" class="hidden p-4" aria-labelledby="period_1_head">
                    準備中
                </div>
                <h2 id="period_2_head">
                    <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-b-lg focus:ring-4 focus:ring-gray-200" aria-expanded="false" aria-controls="period_2_body">
                        <span class="text-sm">3/28(Thu) タイムテーブル</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="period_2_body" class="hidden p-4" aria-labelledby="period_1_head">
                    準備中
                </div>
            </div>
        </div>
        <div class="w-full flex flex-col items-center pt-6">
            <div class="flex flex-col items-center">
                <h6 class="text-xs text-gray-400 font-semibold">Company List</h6>
                <h2 class="font-semibold text-xl">参加企業</h2>
            </div>
            <a href="{{ route('company.list') }}" class="relative max-w-sm shadow">
                <img src="{{ asset('storage/company_list.jpg') }}" alt="参加企業一覧" class="relative z-10 rounded-lg">
                <div class="absolute top-0 left-0 rounded-lg w-full h-full company-list z-20"></div>
                <div class="absolute bottom-6 left-6 z-30 flex flex-col gap-2">
                    <div class="font-semibold text-white text-xl">参加企業一覧</div>
                    <div class="text-white text-sm">
                        のべ200社が集合！
                        <br>
                        あなたの希望に合った企業を見つけよう！
                    </div>
                </div>
                <div class="absolute top-2 right-2 font-medium text-xs text-white z-30">
                    <img src="{{ asset('storage/click.png') }}" alt="Click" class="w-20 h-20 object-contain rotate-12">
                </div>
            </a>
        </div>
        <div class="w-full flex flex-col items-center pt-6">
            <div class="flex flex-col items-center">
                <h6 class="text-xs text-gray-400 font-semibold">Floor Map</h6>
                <h2 class="font-semibold text-xl">会場マップ</h2>
            </div>
            <div class="flex flex-col gap-2 items-center">
                <div class="text-sm text-gray-500">
                    会場マップをご覧いただけます。
                    <br>
                    会場内のブースレイアウトを確認し、効率的な企業訪問を行いましょう。
                    <br>
                    会場マップはクリックorタップで拡大表示できます。
                </div>
                <img src="{{ asset('storage/layout/floormap.jpg') }}" alt="1日目第一部ブースレイアウト" id="floor_map" class="w-full max-w-sm shadow rounded-lg">
            </div>
        </div>
        <div id="industries_list" class="w-full flex flex-col items-center py-6">
            <div class="flex flex-col items-center">
                <h6 class="text-xs text-gray-400 font-semibold">Search by Industry</h6>
                <h2 class="font-semibold text-xl">業種から企業を探す</h2>
            </div>
            <div class="flex md:flex-row flex-col md:gap-6 w-full items-center md:justify-center pt-4">
                <div class="min-w-[384px] flex flex-col gap-2 items-center">
                    @foreach ($industries as $index => $industry)
                        <a href="{{ route('company.list').'?industries='.$industry['industries'] }}" class="shadow w-full max-w-sm p-2 flex items-center justify-between hover:bg-gray-200">
                            <div class="flex-1 flex items-center gap-2">
                                <div class="max-w-[60px] relative w-full before:content-[''] before:block before:pt-[100%]">
                                    <img src="{{ asset('storage/industry/industry_'.$industry['id'].'.jpg') }}" alt="{{ $industry['name'] }}" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover object-right shadow">
                                </div>
                                <div class="text-sm text-[#2EA7EB]">
                                    {{ $industry['name'] }}
                                </div>
                            </div>
                            <div>
                                <svg width="30" height="30" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="ic:baseline-arrow-right">
                                        <path id="Vector" d="M7.16663 11.8334L10.5 8.50008L7.16663 5.16675V11.8334Z" fill="#2EA7EB"/>
                                    </g>
                                </svg>
                            </div>
                        </a>
                        @if ($index === 9)
                </div>
                <div class="min-w-[384px] flex flex-col gap-2 items-center">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.overview = @json($overview);
        window.Laravel.dates = @json($dates);
        window.Laravel.periods = @json($periods);
        window.Laravel.industries = @json($industries);
        window.Laravel.weekdays = @json($weekdays);
        console.log(window.Laravel);
    </script>
    @vite(['resources/js/index.js'])
</x-template>
