@can('access to admin')
    <x-dashboard.menu-item route="admin.setting">
        <x-symbols.setting class="mr-2"/>
        基本設定
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.distribution">
        <x-symbols.booth class="mr-2"/>
        ブース設定
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.advertisement.setting">
        <x-symbols.ad class="mr-2"/>
        広告一覧
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.user.list">
        <x-symbols.user-list class="mr-2"/>
        ユーザー一覧
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.company.issue">
        <x-symbols.issue class="mr-2"/>
        企業アカウント発行
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.company.list">
        <x-symbols.company class="mr-2"/>
        企業一覧
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.qr.issue">
        <x-symbols.qr-issue class="mr-2"/>
        ブースQRコード発行
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.qr.issue.small">
        <x-symbols.qr-issue class="mr-2"/>
        ブースQRコード発行（卓上用）
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.booth_number.issues">
        <x-symbols.qr-issue class="mr-2"/>
        ブース番号発行
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.admission">
        <x-symbols.enter class="mr-2"/>
        入場処理
    </x-dashboard.menu-item>
@endcan
@can('access to company')
    <x-dashboard.menu-item route="company.show">
        <x-symbols.account class="mr-2"/>
        マイページTOP
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="company.edit">
        <x-symbols.setting class="mr-2"/>
        企業情報編集
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="company.one_word_pr">
        <x-symbols.tag class="mr-2"/>
        ひとことPR編集
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="company.followers">
        <x-symbols.followed class="mr-2"/>
        フォロワー一覧
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="company.visitors">
        <x-symbols.visitor class="mr-2"/>
        ビジター一覧
    </x-dashboard.menu-item>
{{--    <x-dashboard.menu-item route="company.advertisement">--}}
{{--        <x-symbols.ad class="mr-2"/>--}}
{{--        広告設定--}}
{{--    </x-dashboard.menu-item>--}}
@endcan
@can('access to student')
    <x-dashboard.menu-item route="student.show">
        <x-symbols.account class="mr-2"/>
        マイページTOP
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="student.edit">
        <x-symbols.setting class="mr-2"/>
        学生情報編集
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="student.followed">
        <x-symbols.followed class="mr-2"/>
        フォロー企業一覧
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="student.visited">
        <x-symbols.visitor class="mr-2"/>
        訪問企業一覧
    </x-dashboard.menu-item>
@endcan
<li class="py-1 border-b">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="py-2 md:pl-6 pl-2 flex justify-start w-full hover:bg-blue-300 rounded-lg">
            <x-symbols.logout class="mr-2" />
            ログアウト
        </button>
    </form>
</li>
