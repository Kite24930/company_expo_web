<div class="fixed z-50 md:w-full w-[95%] h-16 -translate-x-1/2 bg-white border border-gray-200 rounded-full md:rounded bottom-4 md:bottom-0 left-1/2">
    <div class="grid h-full grid-cols-5 mx-auto">
        <a href="{{ route('index') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 rounded-s-full hover:bg-gray-50 group">
            <x-symbols.home />
            <span class="text-xs">トップ</span>
        </a>
        <a href="{{ route('company.list') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group">
            <x-symbols.company />
            <span class="text-xs">企業一覧</span>
        </a>
        @can('access to student')
            @if($isAdmission)
                <a href="{{ route('student.visiting') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group">
                    <div class="bg-[#6787C4] rounded-full flex justify-center items-center w-8 h-8">
                        <x-symbols.qr-read />
                    </div>
                    <span class="text-xs">QR読取</span>
                </a>
            @else
                <a href="{{ route('student.visiting') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group">
                    <div class="bg-[#6787C4] rounded-full flex justify-center items-center w-8 h-8">
                        <x-symbols.qr-enter />
                    </div>
                    <span class="text-xs">QR読取</span>
                </a>
            @endif
            <a href="{{ route('student.followed') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group">
                <x-symbols.followed />
                <span class="text-xs">フォロー中</span>
            </a>
            <a href="{{ route('student.show') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 rounded-e-full hover:bg-gray-50 group">
                <x-symbols.account />
                <span class="text-xs">設定</span>
            </a>
        @endcan
        @can('access to company')
            <a href="{{ route('company.followers') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group">
                <x-symbols.visitor />
                <span class="text-xs">ビジター</span>
            </a>
            <a href="{{ route('company.followers') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group">
                <x-symbols.followed />
                <span class="text-xs">フォロワー</span>
            </a>
            <a href="{{ route('company.show') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 rounded-e-full hover:bg-gray-50 group">
                <x-symbols.setting />
                <span class="text-xs">設定</span>
            </a>
        @endcan
        @can('access to admin')
            <a href="{{ route('admin.user.list') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group">
                <x-symbols.user-list />
                <span class="text-xs">ユーザー</span>
            </a>
            <a href="{{ route('admin.company.list') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 hover:bg-gray-50 group">
                <x-symbols.corporate />
                <span class="text-xs">Company</span>
            </a>
            <a href="{{ route('admin.setting') }}" type="button" class="inline-flex flex-col items-center justify-center px-2 rounded-e-full hover:bg-gray-50 group">
                <x-symbols.setting />
                <span class="text-xs">設定</span>
            </a>
        @endcan
    </div>
</div>
