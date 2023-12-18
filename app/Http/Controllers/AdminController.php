<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use App\Models\Date;
use App\Models\Overview;
use App\Models\Period;
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
            return redirect()->back()->with('success', '基本設定の更新が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AdminDistribution() {
        $data = [
            'overview' => Overview::find(1),
            'dates' => Date::all(),
            'date_max_id' => Date::max('id'),
            'periods' => Period::all(),
            'period_max_id' => Period::max('id'),
            'booth_max_number' => Booth::max('booth_number'),
        ];
        return view('admin.distribution', $data);
    }

    public function AdminDistributionPost(Request $request) {
        try {
            foreach($request->id as $id) {
                Date::updateOrCreate(
                    ['id' => $id],
                    ['date' => $request->date[$id]]
                );
            }
            return redirect()->back()->with('success', '日程の更新が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AdminDistributionDelete($id) {
        try {
            $date = Date::find($id);
            $date->delete();
            return redirect()->back()->with('success', '日程の削除が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AdminDistributionPeriodPost(Request $request) {
        try {
            foreach($request->id as $id) {
                Period::updateOrCreate(
                    ['id' => $id],
                    [
                        'period' => $request->period[$id],
                        'period_start' => $request->period_start[$id],
                        'period_end' => $request->period_end[$id],
                    ]
                );
            }
            return redirect()->back()->with('success', '時間の更新が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AdminDistributionPeriodDelete($id) {
        try {
            $period = Period::find($id);
            $period->delete();
            return redirect()->back()->with('success', '時間の削除が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AdminDistributionBoothPost(Request $request) {
        try {
            Booth::truncate();
            for($i = 1; $i <= $request->booth_max_number; $i++) {
                Booth::create([
                    'booth_number' => $i,
                ]);
            }
            return redirect()->back()->with('success', 'ブースの更新が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
