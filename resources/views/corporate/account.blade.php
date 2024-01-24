<x-dashboard.template title="Dashboard" css="dashboard/corporate.css" :overview="$overview">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50 flex flex-col items-center md:pr-2.5 gap-6">
        <div class="w-full px-6 max-w-5xl">
            <h1 class="text-3xl text-center">アカウント情報</h1>
            <div class="flex flex-col w-full bg-white border-gray-800 border rounded-lg p-4 gap-4">
                <div>
                    <x-input-label>アカウント名</x-input-label>
                    <div class="text-lg font-semibold pl-2">{{ $account->name }}</div>
                </div>
                <div>
                    <x-input-label>登録メールアドレス</x-input-label>
                    <div class="text-lg font-semibold pl-2">{{ $account->email }}</div>
                </div>
                <div>
                    <x-elements.link-button href="{{ route('profile.edit') }}">プロフィールを編集</x-elements.link-button>
                </div>
            </div>
        </div>
        <div class="w-full px-6 max-w-5xl">
            <h1 class="text-3xl text-center">学生サマリー</h1>
            <div class="flex flex-col w-full bg-white border-gray-800 border rounded-lg p-4 items-center justify-center">
                <div class="w-full">
                    <ul class="text-xs flex flex-wrap -mb-px font-medium text-center" id="major_tab" data-tabs-toggle="#middle_tab" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="faculty_tab_btn" data-tabs-target="#by_faculty" type="button" role="tab" aria-controls="by_faculty" aria-selected="true">
                                学部・学科別
                            </button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="grade_tab_btn" data-tabs-target="#by_grade" type="button" role="tab" aria-controls="by_grade" aria-selected="false">
                                学年別
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="w-full p-2 border rounded-lg mt-2" id="middle_tab">
                    <div id="by_faculty">
                        <ul class="text-xs flex flex-wrap -mb-px font-medium text-center" id="faculty_tab" data-tabs-toggle="#faculty_tab_group" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="all_faculty_tab_btn" data-tabs-target="#all_faculty" type="button" role="tab" aria-controls="all_faculty" aria-selected="true">
                                    全学部
                                </button>
                            </li>
                            <li class="w-full"></li>
                            @foreach($faculties as $faculty)
                                <li class="me-2" role="presentation">
                                    <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="{{ __('faculty_tab_btn_'.$faculty->id) }}" data-tabs-target="{{ __('#faculty_'.$faculty->id) }}" type="button" role="tab" aria-controls="{{ __('faculty_'.$faculty->id) }}" aria-selected="false">
                                        {{ $faculty->faculty_name }}
                                    </button>
                                </li>
                                @if($faculty->id === 5)
                                    <li class="w-full"></li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="w-full p-2 border rounded-lg mt-2" id="faculty_tab_group">
                            <div class="w-full flex justify-start items-center gap-10" id="all_faculty">
                                <div class="flex flex-col justify-center items-center pl-10">
                                    <h3>全学部</h3>
                                    <div class="w-[300px] h-[300px]">
                                        <canvas id="all_faculty_chart"></canvas>
                                    </div>
                                </div>
                                <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                    @foreach($faculties as $faculty)
                                        <div class="flex gap-4 border-b items-center text-sm">
                                            <div>
                                                <div class="w-4 h-4 border" style="{{ __('background-color: '.$faculty->color) }}">

                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                {{ $faculty->faculty_name }}
                                            </div>
                                            <div>
                                                @if($student_count['all'] !== 0)
                                                    {{ __($students['faculty'][$faculty->id].'人  ('.round($students['faculty'][$faculty->id] / $student_count['all'] * 100, 2).'%)') }}
                                                @else
                                                    {{ __('0人  (0%)') }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @foreach($faculties as $faculty)
                                <div class="w-full flex justify-start items-center gap-10" id="{{ __('faculty_'.$faculty->id) }}">
                                    <div class="flex flex-col justify-center items-center pl-10">
                                        <h3>{{ $faculty->faculty_name }}</h3>
                                        <div class="w-[300px] h-[300px]">
                                            <canvas id="{{ __('faculty_chart_'.$faculty->id) }}"></canvas>
                                        </div>
                                    </div>
                                    <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                        @foreach($grades as $grade)
                                            <div class="flex gap-4 border-b items-center text-sm">
                                                <div>
                                                    <div class="w-4 h-4 border" style="{{ __('background-color: '.$grade->color) }}">

                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    {{ $grade->grade_name }}
                                                </div>
                                                <div>
                                                    @if($student_count['faculty'][$faculty->id] !== 0)
                                                        {{ __($students[$faculty->id][$grade->id].'人 ('.round($students[$faculty->id][$grade->id] / $student_count['faculty'][$faculty->id] * 100, 2).'%)') }}
                                                    @else
                                                        {{ __('0人 (0%)') }}
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="by_grade">
                        <ul class="text-xs flex flex-wrap -mb-px font-medium text-center" id="grade_tab" data-tabs-toggle="#grade_tab_group" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="all_grade_tab_btn" data-tabs-target="#all_grade" type="button" role="tab" aria-controls="all_grade" aria-selected="true">
                                    全学年
                                </button>
                            </li>
                            <li class="w-full"></li>
                            @foreach($grades as $grade)
                                <li class="me-2" role="presentation">
                                    <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="{{ __('grade_tab_btn_'.$grade->id) }}" data-tabs-target="{{ __('#grade_'.$grade->id) }}" type="button" role="tab" aria-controls="{{ __('grade_'.$grade->id) }}" aria-selected="false">
                                        {{ $grade->grade_name }}
                                    </button>
                                </li>
                                @if($grade->id === 6)
                                    <li class="w-full"></li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="w-full p-2 border rounded-lg mt-2" id="grade_tab_group">
                            <div class="w-full flex justify-start items-center gap-10" id="all_grade">
                                <div class="flex flex-col justify-center items-center pl-10">
                                    <h3>全学年</h3>
                                    <div class="w-[300px] h-[300px]">
                                        <canvas id="all_grade_chart"></canvas>
                                    </div>
                                </div>
                                <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                    @foreach($grades as $grade)
                                        <div class="flex gap-4 border-b items-center text-sm">
                                            <div>
                                                <div class="w-4 h-4 border" style="{{ __('background-color: '.$grade->color) }}">

                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                {{ $grade->grade_name }}
                                            </div>
                                            <div>
                                                @if($student_count['all'] !== 0)
                                                    {{ __($students['faculty'][$grade->id].'人 ('.round($students['grade'][$grade->id] / $student_count['all'] * 100, 2).'%)') }}
                                                @else
                                                    {{ __('0人 (0%)') }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @foreach($grades as $grade)
                                <div class="w-full flex justify-start items-center gap-10" id="{{ __('grade_'.$grade->id) }}">
                                    <div class="flex flex-col justify-center items-center pl-10">
                                        <h3>{{ $grade->grade_name }}</h3>
                                        <div class="w-[300px] h-[300px]">
                                            <canvas id="{{ __('grade_chart_'.$grade->id) }}"></canvas>
                                        </div>
                                    </div>
                                    <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                        @foreach($faculties as $faculty)
                                            <div class="flex gap-4 border-b items-center text-sm">
                                                <div>
                                                    <div class="w-4 h-4 border" style="{{ __('background-color: '.$faculty->color) }}">

                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    {{ $faculty->faculty_name }}
                                                </div>
                                                <div>
                                                    @if($student_count['grade'][$grade->id] !== 0)
                                                        {{ __($students[$faculty->id][$grade->id].'人 ('.round($students[$faculty->id][$grade->id] / $student_count['grade'][$grade->id] * 100, 2).'%)') }}
                                                    @else
                                                        {{ __('0人 (0%)') }}
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full px-6 max-w-5xl">
            <h1 class="text-3xl text-center">フォロワーサマリー</h1>
            <div class="flex flex-col w-full bg-white border-gray-800 border rounded-lg p-4 items-center justify-center">
                <div class="w-full">
                    <ul class="text-xs flex flex-wrap -mb-px font-medium text-center" id="follower_major_tab" data-tabs-toggle="#follower_middle_tab" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="follower_faculty_tab_btn" data-tabs-target="#follower_by_faculty" type="button" role="tab" aria-controls="follower_by_faculty" aria-selected="true">
                                学部・学科別
                            </button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="follower_grade_tab_btn" data-tabs-target="#follower_by_grade" type="button" role="tab" aria-controls="follower_by_grade" aria-selected="false">
                                学年別
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="w-full p-2 border rounded-lg mt-2" id="follower_middle_tab">
                    <div id="follower_by_faculty">
                        <ul class="text-xs flex flex-wrap -mb-px font-medium text-center" id="follower_faculty_tab" data-tabs-toggle="#follower_faculty_tab_group" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="follower_all_faculty_tab_btn" data-tabs-target="#follower_all_faculty" type="button" role="tab" aria-controls="follower_all_faculty" aria-selected="true">
                                    全学部
                                </button>
                            </li>
                            <li class="w-full"></li>
                            @foreach($faculties as $faculty)
                                <li class="me-2" role="presentation">
                                    <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="{{ __('follower_faculty_tab_btn_'.$faculty->id) }}" data-tabs-target="{{ __('#follower_faculty_'.$faculty->id) }}" type="button" role="tab" aria-controls="{{ __('follower_faculty_'.$faculty->id) }}" aria-selected="false">
                                        {{ $faculty->faculty_name }}
                                    </button>
                                </li>
                                @if($faculty->id === 5)
                                    <li class="w-full"></li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="w-full p-2 border rounded-lg mt-2" id="faculty_tab_group">
                            <div class="w-full flex justify-start items-center gap-10" id="follower_all_faculty">
                                <div class="flex flex-col justify-center items-center pl-10">
                                    <h3>全学部</h3>
                                    <div class="w-[300px] h-[300px]">
                                        <canvas id="follower_all_faculty_chart"></canvas>
                                    </div>
                                </div>
                                <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                    @foreach($faculties as $faculty)
                                        <div class="flex gap-4 border-b items-center text-sm">
                                            <div>
                                                <div class="w-4 h-4 border" style="{{ __('background-color: '.$faculty->color) }}">

                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                {{ $faculty->faculty_name }}
                                            </div>
                                            <div>
                                                @if($follower_count['all'] !== 0)
                                                    {{ __($followers['faculty'][$faculty->id].'人 ('.round($followers['faculty'][$faculty->id] / $follower_count['all'] * 100, 2).'%)') }}
                                                @else
                                                    {{ __('0人 (0%)') }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @foreach($faculties as $faculty)
                                <div class="w-full flex justify-start items-center gap-10" id="{{ __('follower_faculty_'.$faculty->id) }}">
                                    <div class="flex flex-col justify-center items-center pl-10">
                                        <h3>{{ $faculty->faculty_name }}</h3>
                                        <div class="w-[300px] h-[300px]">
                                            <canvas id="{{ __('follower_faculty_chart_'.$faculty->id) }}"></canvas>
                                        </div>
                                    </div>
                                    <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                        @foreach($grades as $grade)
                                            <div class="flex gap-4 border-b items-center text-sm">
                                                <div>
                                                    <div class="w-4 h-4 border" style="{{ __('background-color: '.$grade->color) }}">

                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    {{ $grade->grade_name }}
                                                </div>
                                                <div>
                                                    @if($follower_count['faculty'][$faculty->id] !== 0)
                                                        {{ __($followers[$faculty->id][$grade->id].'人 ('.round($followers[$faculty->id][$grade->id] / $follower_count['faculty'][$faculty->id] * 100, 2).'%)') }}
                                                    @else
                                                        {{ __('0人 (0%)') }}
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="follower_by_grade">
                        <ul class="text-xs flex flex-wrap -mb-px font-medium text-center" id="follower_grade_tab" data-tabs-toggle="#follower_grade_tab_group" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="follower_all_grade_tab_btn" data-tabs-target="#follower_all_grade" type="button" role="tab" aria-controls="follower_all_grade" aria-selected="true">
                                    全学年
                                </button>
                            </li>
                            <li class="w-full"></li>
                            @foreach($grades as $grade)
                                <li class="me-2" role="presentation">
                                    <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="{{ __('follower_grade_tab_btn_'.$grade->id) }}" data-tabs-target="{{ __('#follower_grade_'.$grade->id) }}" type="button" role="tab" aria-controls="{{ __('follower_grade_'.$grade->id) }}" aria-selected="false">
                                        {{ $grade->grade_name }}
                                    </button>
                                </li>
                                @if($grade->id === 6)
                                    <li class="w-full"></li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="w-full p-2 border rounded-lg mt-2" id="follower_grade_tab_group">
                            <div class="w-full flex justify-start items-center gap-10" id="follower_all_grade">
                                <div class="flex flex-col justify-center items-center pl-10">
                                    <h3>全学年</h3>
                                    <div class="w-[300px] h-[300px]">
                                        <canvas id="follower_all_grade_chart"></canvas>
                                    </div>
                                </div>
                                <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                    @foreach($grades as $grade)
                                        <div class="flex gap-4 border-b items-center text-sm">
                                            <div>
                                                <div class="w-4 h-4 border" style="{{ __('background-color: '.$grade->color) }}">

                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                {{ $grade->grade_name }}
                                            </div>
                                            <div>
                                                @if($follower_count['all'] !== 0)
                                                    {{ __($followers['faculty'][$grade->id].'人 ('.round($followers['grade'][$grade->id] / $follower_count['all'] * 100, 2).'%)') }}
                                                @else
                                                    {{ __('0人 (0%)') }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @foreach($grades as $grade)
                                <div class="w-full flex justify-start items-center gap-10" id="{{ __('follower_grade_'.$grade->id) }}">
                                    <div class="flex flex-col justify-center items-center pl-10">
                                        <h3>{{ $grade->grade_name }}</h3>
                                        <div class="w-[300px] h-[300px]">
                                            <canvas id="{{ __('follower_grade_chart_'.$grade->id) }}"></canvas>
                                        </div>
                                    </div>
                                    <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                        @foreach($faculties as $faculty)
                                            <div class="flex gap-4 border-b items-center text-sm">
                                                <div>
                                                    <div class="w-4 h-4 border" style="{{ __('background-color: '.$faculty->color) }}">

                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    {{ $faculty->faculty_name }}
                                                </div>
                                                <div>
                                                    @if($follower_count['grade'][$grade->id] !== 0)
                                                        {{ __($followers[$faculty->id][$grade->id].'人 ('.round($followers[$faculty->id][$grade->id] / $follower_count['grade'][$grade->id] * 100, 2).'%)') }}
                                                    @else
                                                        {{ __('0人 (0%)') }}
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full px-6 max-w-5xl">
            <h1 class="text-3xl text-center">ビジターサマリー</h1>
            <div class="flex flex-col w-full bg-white border-gray-800 border rounded-lg p-4 items-center justify-center">
                <div class="w-full">
                    <ul class="text-xs flex flex-wrap -mb-px font-medium text-center" id="visitor_major_tab" data-tabs-toggle="#visitor_middle_tab" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="visitor_faculty_tab_btn" data-tabs-target="#visitor_by_faculty" type="button" role="tab" aria-controls="visitor_by_faculty" aria-selected="true">
                                学部・学科別
                            </button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="visitor_grade_tab_btn" data-tabs-target="#visitor_by_grade" type="button" role="tab" aria-controls="visitor_by_grade" aria-selected="false">
                                学年別
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="w-full p-2 border rounded-lg mt-2" id="visitor_middle_tab">
                    <div id="visitor_by_faculty">
                        <ul class="text-xs flex flex-wrap -mb-px font-medium text-center" id="visitor_faculty_tab" data-tabs-toggle="#visitor_faculty_tab_group" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="visitor_all_faculty_tab_btn" data-tabs-target="#visitor_all_faculty" type="button" role="tab" aria-controls="visitor_all_faculty" aria-selected="true">
                                    全学部
                                </button>
                            </li>
                            <li class="w-full"></li>
                            @foreach($faculties as $faculty)
                                <li class="me-2" role="presentation">
                                    <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="{{ __('visitor_faculty_tab_btn_'.$faculty->id) }}" data-tabs-target="{{ __('#visitor_faculty_'.$faculty->id) }}" type="button" role="tab" aria-controls="{{ __('visitor_faculty_'.$faculty->id) }}" aria-selected="false">
                                        {{ $faculty->faculty_name }}
                                    </button>
                                </li>
                                @if($faculty->id === 5)
                                    <li class="w-full"></li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="w-full p-2 border rounded-lg mt-2" id="faculty_tab_group">
                            <div class="w-full flex justify-start items-center gap-10" id="visitor_all_faculty">
                                <div class="flex flex-col justify-center items-center pl-10">
                                    <h3>全学部</h3>
                                    <div class="w-[300px] h-[300px]">
                                        <canvas id="visitor_all_faculty_chart"></canvas>
                                    </div>
                                </div>
                                <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                    @foreach($faculties as $faculty)
                                        <div class="flex gap-4 border-b items-center text-sm">
                                            <div>
                                                <div class="w-4 h-4 border" style="{{ __('background-color: '.$faculty->color) }}">

                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                {{ $faculty->faculty_name }}
                                            </div>
                                            <div>
                                                @if($visitor_count['all'] !== 0)
                                                    {{ __($visitors['faculty'][$faculty->id].'人 ('.round($visitors['faculty'][$faculty->id] / $visitor_count['all'] * 100, 2).'%)') }}
                                                @else
                                                    {{ __('0人 (0%)') }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @foreach($faculties as $faculty)
                                <div class="w-full flex justify-start items-center gap-10" id="{{ __('visitor_faculty_'.$faculty->id) }}">
                                    <div class="flex flex-col justify-center items-center pl-10">
                                        <h3>{{ $faculty->faculty_name }}</h3>
                                        <div class="w-[300px] h-[300px]">
                                            <canvas id="{{ __('visitor_faculty_chart_'.$faculty->id) }}"></canvas>
                                        </div>
                                    </div>
                                    <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                        @foreach($grades as $grade)
                                            <div class="flex gap-4 border-b items-center text-sm">
                                                <div>
                                                    <div class="w-4 h-4 border" style="{{ __('background-color: '.$grade->color) }}">

                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    {{ $grade->grade_name }}
                                                </div>
                                                <div>
                                                    @if($visitor_count['faculty'][$faculty->id] !== 0)
                                                        {{ __($visitors[$faculty->id][$grade->id].'人 ('.round($visitors[$faculty->id][$grade->id] / $visitor_count['faculty'][$faculty->id] * 100, 2).'%)') }}
                                                    @else
                                                        {{ __('0人 (0%)') }}
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="visitor_by_grade">
                        <ul class="text-xs flex flex-wrap -mb-px font-medium text-center" id="visitor_grade_tab" data-tabs-toggle="#visitor_grade_tab_group" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="visitor_all_grade_tab_btn" data-tabs-target="#visitor_all_grade" type="button" role="tab" aria-controls="visitor_all_grade" aria-selected="true">
                                    全学年
                                </button>
                            </li>
                            <li class="w-full"></li>
                            @foreach($grades as $grade)
                                <li class="me-2" role="presentation">
                                    <button class="inline-block px-4 py-2 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="{{ __('visitor_grade_tab_btn_'.$grade->id) }}" data-tabs-target="{{ __('#visitor_grade_'.$grade->id) }}" type="button" role="tab" aria-controls="{{ __('visitor_grade_'.$grade->id) }}" aria-selected="false">
                                        {{ $grade->grade_name }}
                                    </button>
                                </li>
                                @if($grade->id === 6)
                                    <li class="w-full"></li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="w-full p-2 border rounded-lg mt-2" id="visitor_grade_tab_group">
                            <div class="w-full flex justify-start items-center gap-10" id="visitor_all_grade">
                                <div class="flex flex-col justify-center items-center pl-10">
                                    <h3>全学年</h3>
                                    <div class="w-[300px] h-[300px]">
                                        <canvas id="visitor_all_grade_chart"></canvas>
                                    </div>
                                </div>
                                <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                    @foreach($grades as $grade)
                                        <div class="flex gap-4 border-b items-center text-sm">
                                            <div>
                                                <div class="w-4 h-4 border" style="{{ __('background-color: '.$grade->color) }}">

                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                {{ $grade->grade_name }}
                                            </div>
                                            <div>
                                                @if($visitor_count['all'] !== 0)
                                                    {{ __($visitors['faculty'][$grade->id].'人 ('.round($visitors['grade'][$grade->id] / $visitor_count['all'] * 100, 2).'%)') }}
                                                @else
                                                    {{ __('0人 (0%)') }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @foreach($grades as $grade)
                                <div class="w-full flex justify-start items-center gap-10" id="{{ __('visitor_grade_'.$grade->id) }}">
                                    <div class="flex flex-col justify-center items-center pl-10">
                                        <h3>{{ $grade->grade_name }}</h3>
                                        <div class="w-[300px] h-[300px]">
                                            <canvas id="{{ __('visitor_grade_chart_'.$grade->id) }}"></canvas>
                                        </div>
                                    </div>
                                    <div class="h-full flex flex-col justify-center p-4 gap-1.5">
                                        @foreach($faculties as $faculty)
                                            <div class="flex gap-4 border-b items-center text-sm">
                                                <div>
                                                    <div class="w-4 h-4 border" style="{{ __('background-color: '.$faculty->color) }}">

                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    {{ $faculty->faculty_name }}
                                                </div>
                                                <div>
                                                    @if($visitor_count['grade'][$grade->id] !== 0)
                                                        {{ __($visitors[$faculty->id][$grade->id].'人 ('.round($visitors[$faculty->id][$grade->id] / $visitor_count['grade'][$grade->id] * 100, 2).'%)') }}
                                                    @else
                                                        {{ __('0人 (0%)') }}
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.account = @json($account);
        window.Laravel.students = @json($students);
        window.Laravel.faculties = @json($faculties);
        window.Laravel.grades = @json($grades);
        window.Laravel.followers = @json($followers);
        window.Laravel.visitors = @json($visitors);
        window.Laravel.student_count = @json($student_count);
        window.Laravel.follower_count = @json($follower_count);
        window.Laravel.visitor_count = @json($visitor_count);
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/corporate/corporate.js'])
</x-dashboard.template>
