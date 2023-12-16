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
    <x-text-input :value="$value" :id="$setId" :name="$setId" class="w-full mt-2" />
</div>
