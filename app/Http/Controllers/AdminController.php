<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminSetting() {
        $data = [

        ];
        return view('admin.setting', $data);
    }

    public function AdminSettingPost(Request $request) {

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
