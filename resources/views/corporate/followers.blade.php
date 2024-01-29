<x-dashboard.template title="フォロワー一覧" css="dashboard/corporate.css" :overview="$overview" hide="true">
    <main class="w-full min-h-screen md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50 flex flex-col items-center full md:pr-2.5">
        <div class="w-full px-6 max-w-5xl">
            <h1 class="text-3xl">フォロワー一覧</h1>
            <div class="text-sm pl-4">
                ※情報開示を許可している学生のみ個人情報が開示されます。
            </div>
            <div data-accordion="collapse" class="px-4 py-2 bg-white border rounded-lg mb-4">
                <h3 id="sort-accordion">
                    <button type="button" class="flex items-center justify-between w-full p-4 font-medium text-gray-500 border border-gray-200 rounded-t-lg  hover:bg-gray-200" data-accordion-target="#sort-body" aria-expanded="false" aria-controls="sort-body">
                        <span>絞り込み条件</span>
                        <svg data-accordion-icon class="w-3 h-3 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h3>
                <div id="sort-body" class="hidden p-4 border rounded-b-lg" aria-labelledby="sort-accordion">
                    <div class="flex items-center gap-4">
                        <x-primary-button id="all-select">全て選択</x-primary-button>
                        <x-primary-button id="all-unselect">全て解除</x-primary-button>
                        <x-elements.checkbox setId="public-check" setValue="public" class="public sort-item" notation="非公開を含める" checked />
                    </div>
                    <div class="flex pt-4">
                        <div class="flex-1">
                            <div class="text-xs text-gray-500">学部学科</div>
                            <div class="pl-2">
                                @foreach($faculties as $faculty)
                                    <x-elements.checkbox :setId="__('faculty-'.$faculty->id)" :setValue="'faculty-'.$faculty->id" class="faculty-sort sort-item" :notation="$faculty->faculty_name" checked />
                                @endforeach
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="text-xs text-gray-500">学年</div>
                            <div class="pl-2">
                                @foreach($grades as $grade)
                                    <x-elements.checkbox :setId="__('grade-'.$grade->id)" :setValue="'grade-'.$grade->id" class="grade-sort sort-item" :notation="$grade->grade_name" checked />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap justify-evenly gap-4 p-4 rounded-lg bg-white border">
                @foreach($followers as $student)
                    <x-elements.follower :student="$student" />
                @endforeach
            </div>
        </div>
        <div class="hidden rotate-180"></div>
    </main>
    <script>
        window.Laravel = {};
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/corporate/followers.js'])
</x-dashboard.template>
