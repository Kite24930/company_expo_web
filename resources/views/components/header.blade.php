<header id="header" class="sticky top-0 w-full h-20 flex items-center justify-between bg-white z-50">
    <div>
        <a href="{{ route('index') }}" class="flex items-center justify-center">
            <div class="inline-flex items-center justify-center p-2 rounded">
                <img src="{{ asset('storage/icon.png') }}" alt="" class="w-6 h-6 object-contain inline-block md:mr-2 mr-0">
                <div class="inline-flex items-center text-sm">
                    {{ $overview->title }}
                    <span class="bg-[#6787C4] text-white text-xs font-medium me-2 px-1.5 py-0.5 rounded ml-1">2024</span>
                </div>
            </div>
        </a>
    </div>
    <div>
        @auth
            <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 rounded text-sm font-medium">マイページ</a>
        @endauth
        @guest
            <a href="{{ route('login') }}" class="inline-block px-4 py-2 rounded text-sm font-medium">ログイン</a>
        @endguest
    </div>
</header>
