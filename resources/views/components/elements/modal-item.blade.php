<div {!! $attributes->merge([
    'id' => $setId,
    'class' => 'bg-white p-4 rounded-lg border w-full max-w-3xl'
    ]) !!}>
    <h1 class="text-lg font-bold">{{ $title }}</h1>
    <div class="p-4 flex flex-col items-center gap-6">
        {{ $slot }}
    </div>
</div>
