<a href="{{ route('index') }}" class="flex items-center justify-center">
    <div class="inline-flex items-center justify-center p-2 rounded bg-blue-50">
        <img src="{{ asset('storage/icon.png') }}" alt="" class="w-10 h-10 object-contain inline-block md:mr-2 mr-0">
        <div class="md:inline-flex items-center hidden">
            {{ $overview->title }}
            <span class="bg-[#6787C4] text-white text-xs font-medium me-2 px-1.5 py-0.5 rounded ml-1">2024</span>
        </div>
    </div>
</a>
