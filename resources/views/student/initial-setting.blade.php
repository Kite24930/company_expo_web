<x-dashboard.template title="Dashboard" css="dashboard/corporate.css" :overview="$overview" :isAdmission="$is_admission">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50 flex flex-col items-center md:pr-2.5 gap-6">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="text-center text-2xl font-bold mb-4">学生情報登録</h1>
            <form action="{{ route('student.initial-setting.post') }}" method="POST">
                @csrf
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('氏名')" />
                    <x-text-input id="name" class="block mt-1 w-full bg-gray-200" type="text" name="name" :value="$user->name" disabled autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('メールアドレス')" />
                    <x-text-input id="email" class="block mt-1 w-full bg-gray-200" type="email" name="email" :value="$user->email" disabled autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- gender -->
                <div class="mt-4">
                    <x-input-label for="gender" :value="__('生物')" />
                    <x-select-input id="gender" name="gender" class="block mt-1 w-full" required>
                        <option class="hidden">性別を選択してください</option>
                        <option value="0">男性</option>
                        <option value="1">女性</option>
                        <option value="2">非回答</option>
                    </x-select-input>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>

                <!-- faculty -->
                <div class="mt-4">
                    <x-input-label for="faculty" :value="__('学部')" />
                    <x-select-input id="faculty" name="faculty" class="block mt-1 w-full" required>
                        <option class="hidden">学部を選択してください</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->faculty_name }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('faculty')" class="mt-2" />
                </div>

                <!-- grade -->
                <div class="mt-4">
                    <x-input-label for="grade" :value="__('学年')" />
                    <x-select-input id="grade" name="grade" class="block mt-1 w-full" required>
                        <option class="hidden">学年を選択してください</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('grade')" class="mt-2" />
                </div>

                <!-- address -->
                <div class="mt-4">
                    <x-input-label for="address" :value="__('住所')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="address" />
                    <x-input-label class="text-red-500">※住所は市区町村レベルまでご記入いただければ問題ありません。</x-input-label>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- birth place -->
                <div class="mt-4">
                    <x-input-label for="birthplace" :value="__('出身地')" />
                    <x-text-input id="birthplace" class="block mt-1 w-full" type="text" name="birthplace" :value="old('birthplace')" required autocomplete="birthplace" />
                    <x-input-label class="text-red-500">※出身地は市区町村レベルまでご記入いただければ問題ありません。</x-input-label>
                    <x-input-error :messages="$errors->get('birthplace')" class="mt-2" />
                </div>

                <!-- 企業フォロー時の個人情報開示 -->
                <div class="mt-4">
                    <x-input-label :value="__('企業フォロー時の個人情報開示設定')" />
                    <div class="border-gray-300 rounded-md shadow-sm border flex flex-col gap-2 p-2">
                        <div class="flex items-center">
                            <x-text-input id="follow_disclosure_agree" name="follow_disclosure" type="radio" value="1" checked />
                            <x-input-label for="follow_disclosure_agree" :value="__('開示を許可する')" />
                        </div>
                        <div class="flex items-center">
                            <x-text-input id="follow_disclosure_disagree" name="follow_disclosure" type="radio" value="0" />
                            <x-input-label for="follow_disclosure_disagree" :value="__('開示を許可しない')" />
                        </div>
                    </div>
                    <x-input-label class="text-red-500">※開示設定をすると企業をフォローした際に企業からあなたの情報が参照できる状態になります。開示を許可しない場合、学部・学年のみ公開され、それ以外の情報は非表示になります。</x-input-label>
                    <x-input-error :messages="$errors->get('disclosure')" class="mt-2" />
                </div>

                <div class="flex justify-center mt-4">
                    <x-primary-button class="">
                        {{ __('学生情報登録') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.user = @json($user);
        window.Laravel.student = @json($student);
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/student/student.js'])
</x-dashboard.template>
