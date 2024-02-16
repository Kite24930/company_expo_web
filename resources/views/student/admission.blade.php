<x-template title="入場処理画面" css="dashboard/student.css" :overview="$overview" :isAdmission="$is_admission">
    <main class="w-full min-h-screen flex flex-col items-center gap-4 px-2">
        <h1 class="text-title md:text-2xl text-base">入場処理</h1>
        <img id="qr" src="" alt="QRコード" class="w-full max-w-md">
        <x-input-label>QRコードを入場処理用のPCに向けてください。</x-input-label>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.user = @json($user);
        window.Laravel.qr_code = @json($qr_code);
        window.Laravel.route = @json(route('index'));
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/student/admission.js'])
</x-template>
