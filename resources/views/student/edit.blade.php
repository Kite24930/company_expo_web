<x-dashboard.template title="ユーザー情報編集" css="dashboard/student.css" :overview="$overview" :isAdmission="$is_admission">
    <main class="w-full min-h-screen md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50 flex flex-col items-center md:pr-2.5 gap-4 px-2">
        <h1 class="text-title md:text-2xl text-base">ユーザー情報編集</h1>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <x-auth-session-status class="mb-4" :status="session('success')" />
        <x-auth-session-status class="mb-4" :status="session('error')" />
        <form action="{{ route('student.store') }}" method="POST" class="bg-white shadow-sm px-6 py-4 flex gap-4 flex-col rounded-lg border w-full max-w-xl">
            @csrf
            <div>
                <div class="py-2.5 font-semibold text-sm">ユーザー名</div>
                <x-text-input class="w-full text-sm bg-gray-200" id="student_name" name="student_name" :value="$student->student_name" disabled />
                <x-input-error :messages="$errors->get('student_name')" class="mt-2" />
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">メールアドレス</div>
                <x-text-input class="w-full text-sm" id="email" name="email" :value="$student->email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">学部</div>
                <x-select-input id="faculty_id" name="faculty_id" class="w-full text-sm">
                    @foreach($faculties as $faculty)
                        <option value="{{ $faculty->id }}" {{ $student->faculty_id === $faculty->id ? 'selected' : '' }}>{{ $faculty->faculty_name }}</option>
                    @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">学年</div>
                <x-select-input id="grade_id" name="grade_id" class="w-full text-sm">
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" {{ $student->grade_id === $grade->id ? 'selected' : '' }}>{{ $grade->grade_name }}</option>
                    @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">住所</div>
                <x-text-input class="w-full text-sm" id="address" name="address" :value="$student->address" />
                <x-input-label class="text-red-500 text-xs">※住所は市区町村までの記入としてください。</x-input-label>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">出身地</div>
                <x-text-input class="w-full text-sm" id="birthplace" name="birthplace" :value="$student->birthplace" />
                <x-input-label class="text-red-500 text-xs">※出身地は市区町村までの記入としてください。</x-input-label>
                <x-input-error :messages="$errors->get('birthplace')" class="mt-2" />
            </div>
            <div>
                <div class="py-2.5 font-semibold text-sm">フォロー企業への情報開示設定</div>
                <label class="flex items-center cursor-pointer p-2.5">
                    <span class="me-3 text-sm font-medium text-gray-900">開示を許可しない</span>
                    <div class="relative inline-flex items-center cursor-pointer">
                        <input id="follow_disclosure" name="follow_disclosure" type="checkbox" value="follow_disclosure" class="sr-only peer" {{ $student->follow_disclosure === 1 ? __('checked') : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900">開示を許可する</span>
                </label>
                <x-input-label class="text-red-500 text-xs">※学部と学年は常に企業に開示されます。開示を許可すると氏名やメールアドレス、住所、出身地がフォローした企業に開示されます。</x-input-label>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <x-elements.button class="m-auto" type="submit">更新する</x-elements.button>
        </form>
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
