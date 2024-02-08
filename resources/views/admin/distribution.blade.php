<x-dashboard.template title="Dashboard" css="dashboard/dashboard.css" :overview="$overview">
    <main class="w-full md:pl-80 pt-20 md:pt-4 pb-24 bg-gray-50">
        <div class="text-3xl flex justify-center items-center">
            <x-symbols.booth class="mr-2" />ブース設定
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
        <form id="sendForm" method="POST" action="{{ route('admin.date.post') }}" class="flex flex-col items-start m-auto gap-3 px-4">
            @csrf
            <div class="rounded-2xl bg-white border px-4 py-6 max-w-xl flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    開催日
                    <div class="inline-block px-2 py-1 text-xs rounded bg-required text-white">必須</div>
                </div>
                <div class="w-full flex flex-col items-start gap-3 border-gray-300 rounded-md shadow-sm border p-2">
                    @foreach ($dates as $date)
                        <div class="flex items-center gap-3 border-gray-300 rounded-md shadow-sm border p-2">
                            <input type="hidden" value="{{ $date->id }}" name="id[]">
                            <x-text-input name="date[{{ $date->id }}]" value="{{ $date->date }}" type="date" />
                            <x-dashboard.delete-button class="dateDeleteBtn"  data-url="{{ route('admin.date.delete', $date->id) }}" data-token="{{ csrf_token() }}">削除</x-dashboard.delete-button>
                        </div>
                    @endforeach
                    <x-dashboard.add-button id="dateAddBtn">日程追加</x-dashboard.add-button>
                </div>
            </div>
            <x-dashboard.submit-button>開催日 更新</x-dashboard.submit-button>
        </form>
        <form id="sendForm" method="POST" action="{{ route('admin.period.post') }}" class="flex flex-col items-start m-auto gap-3 px-4 mt-6">
            @csrf
            <div class="rounded-2xl bg-white border px-4 py-6 flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    開催区分
                    <div class="inline-block px-2 py-1 text-xs rounded bg-required text-white">必須</div>
                </div>
                <div class="w-full flex flex-col items-start gap-3 border-gray-300 rounded-md shadow-sm border p-2">
                    @foreach ($periods as $period)
                        <div class="flex items-center gap-3 border-gray-300 rounded-md shadow-sm border p-2">
                            <input type="hidden" value="{{ $period->id }}" name="id[]">
                            <x-text-input name="period[{{ $period->id }}]" value="{{ $period->period }}" type="text" />
                            <x-text-input name="period_start[{{ $period->id }}]" value="{{ $period->period_start }}" type="time" />
                            <span>〜</span>
                            <x-text-input name="period_end[{{ $period->id }}]" value="{{ $period->period_end }}" type="time" />
                            <x-dashboard.delete-button class="periodDeleteBtn" data-url="{{ route('admin.period.delete', $period->id) }}" data-token="{{ csrf_token() }}">削除</x-dashboard.delete-button>
                        </div>
                    @endforeach
                    <x-dashboard.add-button id="periodAddBtn">区分追加</x-dashboard.add-button>
                </div>
            </div>
            <x-dashboard.submit-button>開催区分 更新</x-dashboard.submit-button>
        </form>
        <form id="sendForm" method="POST" action="{{ route('admin.booth.post') }}" class="flex flex-col items-start m-auto gap-3 px-4 mt-6">
            @csrf
            <div class="rounded-2xl bg-white border px-4 py-6 flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    最大ブース数
                    <div class="inline-block px-2 py-1 text-xs rounded bg-required text-white">必須</div>
                </div>
                <div class="w-full flex flex-col items-start gap-3 border-gray-300 rounded-md shadow-sm border p-2">
                    <x-text-input name="booth_max_number" value="{{ $booth_max_number }}" type="number" />
                </div>
            </div>
            <x-dashboard.submit-button>最大ブース数 更新</x-dashboard.submit-button>
        </form>
        <form id="sendForm" method="POST" action="{{ route('admin.layout.post') }}" class="flex flex-col items-start m-auto gap-3 px-4 mt-6">
            @csrf
            <div class="rounded-2xl bg-white border px-4 py-6 flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    レイアウトテーブル生成
                    <div class="inline-block px-2 py-1 text-xs rounded bg-required text-white">必須</div>
                </div>
                <x-dashboard.submit-button>レイアウトテーブル 更新</x-dashboard.submit-button>
            </div>
        </form>
    </main>
    <script>
        window.Laravel = {};
        window.Laravel.dates = @json($dates);
        window.Laravel.date_max_id = @json($date_max_id);
        window.Laravel.periods = @json($periods);
        window.Laravel.period_max_id = @json($period_max_id);
        window.Laravel.booth_max_number = @json($booth_max_number);
        console.log(window.Laravel);
    </script>
    @vite(['resources/js/dashboard/distribution.js'])
</x-dashboard.template>
