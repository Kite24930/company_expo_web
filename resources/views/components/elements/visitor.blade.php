<div class="p-2 bg-white border rounded-lg flex flex-col md:min-w-[250px] min-w-full gap-2 {{ __('faculty-'.$student->student_faculty_id) }} {{ __('grade-'.$student->student_grade_id) }} @if($student->disclosure === 1) public @endif visitor">
    <div class="flex gap-2 items-center">
        <div class="w-[45px] text-xs px-2 py-1 border rounded text-center @if(in_array($student->student_faculty_id, [3, 4, 9])) text-white @endif" style="{{ __('background-color: '.$student->student_faculty_color) }}">{{ mb_substr($student->student_faculty_name, 0, 2) }}</div>
        <div class="w-[65px] text-xs px-2 py-1 border rounded text-center" style="{{ __('background-color: '.$student->student_grade_color) }}">
            @switch($student->student_grade_id)
                @case(1)
                    学部1年
                    @break
                @case(2)
                    学部2年
                    @break
                @case(3)
                    学部3年
                    @break
                @case(4)
                    学部4年
                    @break
                @case(5)
                    学部5年
                    @break
                @case(6)
                    学部6年
                    @break
                @case(7)
                    院1年
                    @break
                @case(8)
                    院2年
                    @break
                @case(9)
                    院3年
                    @break
                @case(10)
                    院4年
                    @break
                @default
                    その他
            @endswitch
        </div>
    </div>
    @if($student->disclosure === 1)
        <div>
            <div class="text-xs text-gray-400">氏名</div>
            <div class="px-2 text-sm">{{ $student->student_name }}</div>

        </div>
        <div class="text-sm">
            <div class="text-xs text-gray-400">メールアドレス</div>
            <div class="px-2 text-sm"><a class="underline" href="{{ __('mailto:'.$student->student_emial) }}">{{ $student->student_email }}</a></div>
        </div>
        <div class="text-sm">
            <div class="text-xs text-gray-400">住所</div>
            <div class="px-2 text-sm">{{ $student->student_address }}</div>
        </div>
        <div class="text-sm pr-2">
            <div class="text-xs text-gray-400">出身地</div>
            <div class="px-2 text-sm">{{ $student->student_birthplace }}</div>
        </div>
    @else
        <div class="text-sm text-gray-500 bg-gray-100 text-center flex-1 rounded flex justify-center items-center">
            非公開
        </div>
    @endif
</div>

