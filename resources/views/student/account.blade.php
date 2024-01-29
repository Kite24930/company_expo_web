<x-dashboard.template title="Dashboard" css="dashboard/student.css" :overview="$overview" :isAdmission="$is_admission">
    <main class="w-full min-h-screen md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50 flex flex-col items-center md:pr-2.5 gap-4 px-2">
        <h1 class="text-title md:text-2xl text-base">ユーザー情報</h1>
        <div class="bg-white shadow-sm px-6 py-4 flex gap-4 flex-col rounded-lg border w-full max-w-xl">
            <div>
                <div class="py-2.5 font-semibold text-sm">ユーザー名</div>
                <div class="p-2.5 text-sm">{{ $student->student_name }}</div>
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">メールアドレス</div>
                <div class="p-2.5 text-sm">{{ $student->email }}</div>
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">学部</div>
                <div class="p-2.5 text-sm">{{ $student->faculty_name }}</div>
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">学年</div>
                <div class="p-2.5 text-sm">{{ $student->grade_name }}</div>
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">住所</div>
                <div class="p-2.5 text-sm">{{ $student->address }}</div>
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">出身地</div>
                <div class="p-2.5 text-sm">{{ $student->birthplace }}</div>
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">フォロー企業への情報開示設定</div>
                <div class="p-2.5 text-sm">{{ $student->follow_disclosure === 1 ? __('許可中') : __('許可しない') }}</div>
            </div>
            <x-elements.link-button :href="route('student.edit')" class="m-auto">編集する</x-elements.link-button>
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.user = @json($user);
        window.Laravel.student = @json($student);
        window.Laravel.is_admission = @json($is_admission);
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/student/student.js'])
</x-dashboard.template>
