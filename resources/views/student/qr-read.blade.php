<x-template title="入場処理画面" css="dashboard/student.css" :overview="$overview" :isAdmission="$is_admission">
    <main class="w-full flex flex-col items-center gap-4 px-2 py-4">
        <h1 class="text-title md:text-2xl text-base">企業訪問 QR読み取り</h1>
        @if(session('success'))
            <div class="w-full flex justify-center items-center">
                <div class="text-xs bg-green-100 text-green-800 p-4 rounded-lg">
                    {!! nl2br(e(session('success'))) !!}
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="w-full flex justify-center items-center">
                <div class="text-xs bg-red-100 text-red-800 p-4 rounded-lg">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @if(isset($errors) && $errors->count() > 0)
            <div class="w-full flex justify-center items-center">
                <div class="text-xs bg-red-100 text-red-800 p-4 rounded-lg">
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            </div>
        @endif
        <div id="qr-read" class="w-full p-6 flex-1 flex flex-col justify-center items-center gap-2">
            <div id="msg">Unable to access video stream.</div>
            <div class="w-full max-w-xl flex-1 flex items-center">
                <canvas id="canvas" class="w-full h-full bg-gray-500 rounded-3xl"></canvas>
            </div>
            <button id="reading" type="button" class="text-2xl font-semibold shadow bg-white px-4 py-2 rounded-lg">Reading Start</button>
        </div>
        <x-input-label>企業ブースにあるQRコードを読み込んでください。</x-input-label>
        <div id="result" class="w-full h-full px-4 py-10 flex-1 bg-gray-200 border rounded-lg fixed left-0 right-0 top-0 bottom-0 z-50 hidden" tabindex="-1" aria-hidden="true">
            <form action="{{ route('student.visiting') }}" method="POST" class="flex flex-col gap-4 justify-center bg-white p-4 rounded-lg">
                @csrf
                <div>
                    <x-input-label>企業名</x-input-label>
                    <div id="company_name" class="text-2xl font-bold"></div>
                    <input type="hidden" id="company_id" name="company_id" value="">
                </div>
                <div>
                    <x-input-label>情報開示設定</x-input-label>
                    <div class="flex justify-center gap-4">
                        <label class="px-4 py-2 border border-blue-800 cursor-pointer rounded-lg hover:bg-blue-300 hover:text-white">
                            <input type="radio" id="disclosure_true" name="disclosure" value="1" class="disclosure hidden">
                            開示する
                        </label>
                        <label class="px-4 py-2 border border-blue-800 cursor-pointer rounded-lg hover:bg-blue-300 hover:text-white">
                            <input type="radio" id="disclosure_false" name="disclosure" value="0" class="disclosure hidden">
                            開示しない
                        </label>
                    </div>
                </div>
                <x-elements.button id="submit_btn" type="submit" class="hover:bg-gray-200 bg-gray-200" disabled>登録</x-elements.button>
            </form>
        </div>
    </main>
    <div class="bg-blue-800"></div>
    <script>
        window.Laravel = {};
        window.Laravel.user = @json($user);
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/student/qr-read.js'])
</x-template>
