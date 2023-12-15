@can('access to admin')
    <x-dashboard.menu-item route="admin.setting">
        基本設定
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.distribution">
        ブース設定
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.advertisement.setting">
        広告一覧
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.user.list">
        ユーザー一覧
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.company.issue">
        企業アカウント発行
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.company.list">
        企業一覧
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.qr.issue">
        ブースQRコード発行
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="admin.admission">
        入場処理
    </x-dashboard.menu-item>
@endcan
@can('access to company')
    <x-dashboard.menu-item route="company.show">
        アカウント情報
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="company.edit">
        企業情報編集
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="company.followers">
        フォロワー一覧
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="company.visitors">
        アカウント情報
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="company.advertisement">
        広告設定
    </x-dashboard.menu-item>
@endcan
@can('access to student')
    <x-dashboard.menu-item route="student.show">
        アカウント情報
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="student.edit">
        学生情報編集
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="student.followed">
        フォロー企業一覧
    </x-dashboard.menu-item>
    <x-dashboard.menu-item route="student.visited">
        訪問企業一覧
    </x-dashboard.menu-item>
@endcan
