<?php

namespace App\Http\Controllers;

use App\Models\Overview;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminSetting() {
        $data = [
            'overview' => Overview::find(1),
        ];
        return view('admin.setting', $data);
    }

    public function AdminSettingPost(Request $request) {
        try {
            $overview = Overview::find(1);
            $period_change_status = 0;
            if (isset($request->period_change_status)) {
                $period_change_status = 1;
            };
            $overview->update([
                'target' => $request->target,
                'title' => $request->title,
                'description' => $request->description,
                'place' => $request->place,
                'period_change_status' => $period_change_status,
                'footer_hosts' => $request->footer_hosts,
                'footer_in_charge' => $request->footer_in_charge,
            ]);
            return redirect()->back1()->with('success', '基本設定の更新が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AdminDistribution() {
        $data = [

        ];
        return view('admin.distribution', $data);
    }

    public function AdminDistributionPost(Request $request) {

    }

    public function AdminAdvertisementSetting() {
        $data = [

        ];
        return view('admin.ad-setting', $data);
    }

    public function AdminAdvertisementSettingPost(Request $request) {

    }

    public function AdminAdvertisementEdit() {
        $data = [

        ];
        return view('admin.ad-edit', $data);
    }

    public function AdminAdvertisementEditPost(Request $request) {

    }

    public function AdminUserList() {
        $data = [

        ];
        return view('admin.users', $data);
    }

    public function AdminUserListPost($id, Request $request) {

    }

    public function AdminCompanyIssue() {
        $data = [

        ];
        return view('admin.company-issue', $data);
    }

    public function AdminCompanyIssuePost(Request $request) {

    }

    public function AdminCompanyList() {
        $data = [

        ];
        return view('admin.companies', $data);
    }

    public function AdminCompanyEdit($id) {
        $data = [

        ];
        return view('admin.company-edit', $data);
    }

    public function AdminCompanyEditPost($id, Request $request) {

    }

    public function AdminQrIssue() {
        $data = [

        ];
        return view('admin.qr-issue', $data);
    }

    public function AdminAdmission() {
        $data = [

        ];
        return view('admin.admission', $data);
    }

    public function AdminAdmissionPost(Request $request) {

    }
}
