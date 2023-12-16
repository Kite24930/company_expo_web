<div {!! $attributes->merge(['class' => 'rounded-2xl bg-white border px-4 py-6 w-full']) !!}>
    <div class="flex items-center gap-3">
        {{ $title }}
        @if (isset($required))
            <div class="inline-block px-2 py-1 text-xs rounded bg-required text-white">必須</div>
        @else
            <div class="inline-block px-2 py-1 text-xs rounded bg-gray-300">任意</div>
        @endif
    </div>
    @if(isset($description))
        <div class="color-required text-sm">{{ $description }}</div>
    @endif
    <div class="inline-flex items-center mt-2 border-gray-300 rounded-md shadow-sm border p-2">
        <span class="me-3 text-sm font-medium text-gray-900 dark:text-gray-300">切り替わりなし</span>
        <label class="relative inline-flex items-center cursor-pointer">
            <input id="{{ $setId }}" name="{{ $setId }}" type="checkbox" value="{{ $setId }}" class="sr-only peer" @if($value === 1) checked @endif>
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
        </label>
        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">切り替わりあり</span>
    </div>

</div>
