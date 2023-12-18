<x-dashboard.template title="ユーザー一覧" css="dashboard/dashboard.css" :overview="$overview">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50">
        <div class="text-3xl flex justify-center items-center">
            <x-symbols.user-list class="mr-2" />ユーザー詳細
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
            <form id="sendForm" method="POST" action="{{ route('admin.user.list.post', $student->id) }}" class="w-full flex flex-col items-start m-auto gap-3 px-4">
                @csrf
                <x-dashboard.text-card title="学生名" required :value="$student->student_name" setId="student_name" class="max-w-xl" />
                <x-dashboard.select title="性別" required setId="gender" class="max-w-sm" disabled>
                    <option value="" class="hidden">性別を選択してください</option>
                    <option value="0" @if($student->gender === 0) selected @endif>男性</option>
                    <option value="1" @if($student->gender === 1) selected @endif>女性</option>
                    <option value="2" @if($student->gender === 2) selected @endif>非回答</option>
                </x-dashboard.select>
                <x-dashboard.text-card title="メールアドレス" required :value="$student->email" setId="email" class="max-w-xl" setType="email" />
                <x-dashboard.text-card title="電話番号" :value="$student->tel" setId="tel" class="max-w-xl" setType="tel" />
                <x-dashboard.select title="学部・学部" required setId="faculty_id" class="max-w-sm">
                    <option value="" class="hidden">学部を選択してください</option>
                    @foreach($faculties as $faculty)
                        <option value="{{ $faculty->id }}" @if($student->faculty_id === $faculty->id) selected @endif>{{ $faculty->faculty_name }}</option>
                    @endforeach
                </x-dashboard.select>
                <x-dashboard.select title="学年" required setId="grade_id" class="max-w-sm">
                    <option value="" class="hidden">学部を選択してください</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" @if($student->grade_id === $grade->id) selected @endif>{{ $grade->grade_name }}</option>
                    @endforeach
                </x-dashboard.select>
                <x-dashboard.text-card title="出身地" required :value="$student->birthplace" setId="birthplace" class="max-w-xl" />
                <x-dashboard.text-card title="住所" required :value="$student->address" setId="address" class="max-w-xl" />
                <x-dashboard.toggle title="フォロー企業への情報開示" required :value="$student->follow_disclosure" setId="follow_disclosure" class="max-w-xl" leftText="開示拒否" rightText="開示許可" />
                <x-dashboard.submit-button id="submitBtn" type="button">更新</x-dashboard.submit-button>
            </form>
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.student = @json($student);
        console.log(window.Laravel);
    </script>
    @vite(['resources/js/dashboard/user-detail.js'])
</x-dashboard.template>
