<x-template title="フォロー企業一覧" css="dashboard/student.css" :overview="$overview" :isAdmission="$is_admission">
    <main class="w-full min-h-screen flex flex-col items-center gap-4 px-2">
        <h1 class="text-title md:text-2xl text-base">フォロー企業一覧</h1>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.followed = @json($followed);
        console.log(window.Laravel)
    </script>
    @vite(['resources/js/student/student.js'])
</x-template>
