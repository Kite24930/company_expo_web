<x-dashboard.template title="企業情報編集" css="dashboard/corporate-edit.css" :overview="$overview" hide="true">
    <main class="w-full min-h-screen md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50 flex flex-col justify-center items-center full md:pr-2.5">
        @if($msg)
            <div class="p-2 bg-green-200 text-green-800 text-lg rounded-lg text-left w-full max-w-3xl my-4">
                {{ $msg }}
            </div>
        @endif
        <div class="w-full md:px-10 flex justify-center items-center gap-10">
            <div>
                <form action="{{ route('company.one_word_pr.post') }}" method="POST" class="rounded-lg border py-4 px-2 flex flex-col gap-2">
                    @csrf
                    <x-input-label>ひとことPR</x-input-label>
                    @if($one_word_pr)
                        <x-textarea-input id="one_word_pr" name="one_word_pr" rows="2" cols="20" class="w-full text-center" required>{{ $one_word_pr->one_word_pr }}</x-textarea-input>
                    @else
                        <x-textarea-input id="one_word_pr" name="one_word_pr" rows="2" cols="20" class="w-full text-center" required></x-textarea-input>
                    @endif
                    <x-input-label>文字色</x-input-label>
                    @if($one_word_pr)
                        <x-text-input type="color" id="text_color" name="text_color" value="{{ $one_word_pr->text_color }}" />
                    @else
                        <x-text-input type="color" id="text_color" name="text_color" value="#ffffff" />
                    @endif
                    <x-input-label>背景色</x-input-label>
                    @if($one_word_pr)
                        <x-text-input type="color" id="background_color" name="background_color" value="{{ $one_word_pr->background_color }}" />
                    @else
                        <x-text-input type="color" id="background_color" name="background_color" value="#ff0000" />
                    @endif
                    <x-elements.button type="submit">
                        更新
                    </x-elements.button>
                </form>
                <form action="{{ route('company.one_word_pr.delete') }}" method="POST" class="rounded-lg border py-4 px-2 flex flex-col gap-2">
                    @csrf
                    @method('DELETE')
                    <x-elements.button type="submit" class="bg-gray-700">
                        削除
                    </x-elements.button>
                </form>
            </div>
            <div>
                <div class="flex flex-col items-center relative w-full max-w-[300px] rounded-lg shadow">
                    @if($one_word_pr)
                        <div class="text-xs py-1 px-2 rounded absolute top-0 -left-2 z-20 -rotate-12 text-center" style="{{ __('background-color: '.$one_word_pr->background_color.'; color: '.$one_word_pr->text_color) }}">
                            {!! nl2br(e($one_word_pr->one_word_pr)) !!}
                        </div>
                    @else
                        <div class="text-xs py-1 px-2 rounded absolute top-0 -left-2 z-20 -rotate-12 text-center" style="background-color: #ff0000; color: #ffffff">
                            あいうえおかきくけこ
                            <br>
                            さしすせそたちつてと
                        </div>
                    @endif
                    <div class="company_img_wrapper relative w-full z-10">
                        @if($company->company_img === null)
                            <img src="{{ asset('storage/company/default.jpg') }}" alt="{{ $company->company_name }}" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover rounded-t-lg">
                        @else
                            <img src="{{ asset('storage/company/'.$company->id.'/'.$company->company_img) }}" alt="{{ $company->company_name }}" class="absolute top-0 left-0 bottom-0 right-0 w-full h-full object-cover rounded-t-lg z-20">
                        @endif
                        <div class="absolute bottom-0 left-0 bg-[#4B6FA6] rounded-tr z-30 px-4 py-1 text-white text-xs">
                            {{ __('No. '.$company->booth_number) }}
                        </div>
                    </div>
                    <div class="w-full rounded-b-lg border py-4 px-2 flex flex-col gap-2 flex-1 justify-between">
                        <div class="flex flex-col gap-2">
                            <div class="flex justify-between">
                                <div class="flex gap-2 items-center flex-1 flex-wrap">
                                    @foreach($targets as $target)
                                        <div class="p-1 px-2.5 rounded-full bg-[#637381] text-white text-xs">{{ mb_substr($target->faculty_name, 0, 1) }}</div>
                                    @endforeach
                                </div>
                                <button type="button" class="follow-btn h-8 w-8 rounded-full flex justify-center items-center" data-target="{{ $company->id }}">
                                    <x-symbols.bookmark class="w-full h-full" />
                                </button>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($company->company_logo)
                                    <img src="{{ asset('storage/company/'.$company->id.'/'.$company->company_logo) }}" alt="{{ $company->company_name }}" class="w-9 h-9 object-cover rounded-full border">
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
                                    @foreach($occupations as $occupation)
                                        <span class="text-xs">・
                                            {{ $occupation->recruit_occupation }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <x-elements.link-button  href="#" class="duration-500 hover:scale-110">
                                詳細を見る
                            </x-elements.link-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.company = @json($company);
        window.Laravel.one_word_pr = @json($one_word_pr);
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/corporate/corporate-one-word.js'])
</x-dashboard.template>
