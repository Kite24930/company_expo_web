<x-dashboard.template title="ユーザー一覧" css="dashboard/dashboard.css" :overview="$overview">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50">
        <div class="text-3xl flex justify-center items-center">
            <x-symbols.user-list class="mr-2" />ユーザー一覧
        </div>
        @if (session('success'))
            <div class="flex justify-center items-center w-full">
                <div class="mb-4 font-medium text-sm text-green-600 p-2 rounded-md bg-green-100">
                    {{ session('success') }}
                </div>
            </div>
        @elseif (session('error'))
            <div class="flex justify-center items-center w-full">
                <div class="mb-4 font-medium text-sm text-red-600 p-2 rounded-md bg-red-100">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <div class="w-full flex flex-wrap gap-4 justify-center">
            @foreach($students as $student)
                <div class="max-w-sm w-[30%] p-4 bg-white border border-gray-200 rounded-lg shadow text-sm flex flex-col gap-1">
                    <div class="flex items-center">
                        <x-symbols.account class="mr-2" />
                        <span class="text-lg font-bold">{{ $student->student_name }}</span>
                        @switch($student->gender)
                            @case(0)
                                <span class="text-xs ml-2">[男性]</span>
                                @break
                            @case(1)
                                <span class="text-xs ml-2">[女性]</span>
                                @break
                            @case(2)
                                <span class="text-xs ml-2">[非回答]</span>
                                @break
                        @endswitch
                    </div>
                    <p class="text-right">{{ $student->faculty_name.'/'.$student->grade_name }}</p>
                    <div class="flex items-center">
                        <x-symbols.tel class="mr-2" />
                    @if($student->tel)
                        <span>{{ $student->tel }}</span>
                    @endif
                    </div>
                    <div class="flex items-center">
                        <x-symbols.mail class="mr-2" />
                        <span>{{ $student->email }}</span>
                    </div>
                    <x-dashboard.link-button href="{{ route('admin.user.list.detail', $student->id) }}" class="justify-center">詳細・編集</x-dashboard.link-button>
                </div>
            @endforeach
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.students = @json($students);
        console.log(window.Laravel);
    </script>
    @vite(['resources/js/dashboard/user-list.js'])
</x-dashboard.template>
