<footer class="bg-gray-200 md:mb-16 mb-20 p-4 flex md:flex-row flex-col justify-center md:gap-20 gap-4">
    <div class="max-w-sm">
        <div class="text-xl font-semibold mb-4">
            {{ $overview->title }}
        </div>
        <div>
            {!! nl2br(e($overview->footer_hosts)) !!}
        </div>
    </div>
    <div class="max-w-sm md:pt-10">
        {!! nl2br(e($overview->footer_in_charge)) !!}
        <div class="pl-4">
            <a href="https://www.mie-projectm.com/" class="underline hover:text-blue-600">会社HP</a>
        </div>
    </div>
    <div class="max-w-sm md:pt-10">
        <div>
            <a href="{{ route('privacy-policy') }}" class="underline hover:text-blue-600">プライバシーポリシー</a>
        </div>
        <div>
            <a href="{{ route('terms') }}" class="underline hover:text-blue-600">利用規約</a>
        </div>
    </div>
</footer>
