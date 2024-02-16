<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use App\Models\BranchOffice;
use App\Models\Company;
use App\Models\CompanyIndustryView;
use App\Models\Date;
use App\Models\DistributionView;
use App\Models\Faculty;
use App\Models\Grade;
use App\Models\IndustryView;
use App\Models\Layout;
use App\Models\LayoutView;
use App\Models\MajorIndustry;
use App\Models\MiddleIndustry;
use App\Models\Occupation;
use App\Models\Overview;
use App\Models\Period;
use App\Models\Student;
use App\Models\StudentView;
use App\Models\TargetView;
use App\Models\User;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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
                'remarks' => $request->remarks,
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
            Schema::disableForeignKeyConstraints();
            Booth::truncate();
            Schema::enableForeignKeyConstraints();
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

    public function AdminDistributionLayoutPost (Request $request) {
        try {
            Layout::truncate();
            $date = Date::all();
            $period = Period::all();
            $booth = Booth::all();
            foreach ($date as $d) {
                foreach ($period as $p) {
                    foreach ($booth as $b) {
                        Layout::create([
                            'date_id' => $d->id,
                            'period_id' => $p->id,
                            'booth_id' => $b->id,
                        ]);
                    }
                }
            }
            return redirect()->back()->with('success', 'レイアウトテーブルの生成が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AdminAdvertisementSetting() {
        $data = [
            'overview' => Overview::find(1),
        ];
        return view('admin.ad-setting', $data);
    }

    public function AdminAdvertisementSettingPost(Request $request) {

    }

    public function AdminAdvertisementEdit() {
        $data = [
            'overview' => Overview::find(1),
        ];
        return view('admin.ad-edit', $data);
    }

    public function AdminAdvertisementEditPost(Request $request) {

    }

    public function AdminUserList() {
        $data = [
            'overview' => Overview::find(1),
            'students' => StudentView::all(),
        ];
        return view('admin.users', $data);
    }

    public function AdminUserListDetail($id) {
        $data = [
            'overview' => Overview::find(1),
            'student' => StudentView::find($id),
            'faculties' => Faculty::all(),
            'grades' => Grade::all(),
        ];
        return view('admin.user-detail', $data);
    }

    public function AdminUserListPost($id, Request $request) {
        try {
            $student = Student::find($id);
            $follow_disclosure = 0;
            if (isset($request->follow_disclosure)) {
                $follow_disclosure = 1;
            };
            $student->update([
                'student_name' => $request->student_name,
                'email' => $request->email,
                'tel' => $request->tel,
                'faculty_id' => $request->faculty_id,
                'grade_id' => $request->grade_id,
                'follow_disclosure' => $follow_disclosure,
            ]);
            return redirect()->back()->with('success', 'ユーザー情報の更新が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AdminCompanyIssue() {
        $data = [
            'overview' => Overview::find(1),
        ];
        return view('admin.company-issue', $data);
    }

    public function AdminCompanyIssuePost(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try {
            $emailCheck = User::where('email', $request->email)->get()->count();
            if ($emailCheck > 0) {
                return redirect()->back()->with('error', '既に登録されているメールアドレスです');
            }
            $password = Str::random(10);
            $company = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'api_token' => Str::random(25),
                'token' => Str::random(25),
                'first_login' => 0,
            ]);
            $company->assignRole('company');
            event(new Registered($company));

            $overview = Overview::find(1);

            $contact = 'contact@mie-projectm.com';

            $body = $request->name."様%0D%0A%0D%0A平素より大変お世話になっております。運営を担当しております株式会社プロジェクトMです。%0D%0Aこの度は".$overview->title."にお申し込みいただきまして誠にありがとうございます。%0D%0Aお手続きよりお時間をいただきまして、ありがとうございました。%0D%0A%0D%0A企業アカウントの発行が完了致しました。%0D%0A%0D%0A以下のURLからログインしてください。%0D%0A".route('index')."/login/%0D%0A%0D%0Aアカウント情報のメールアドレスはこのお送りしているメールアドレスをご使用ください。%0D%0Aパスワード：".$password."%0D%0A※初回ログイン時に任意のパスワードに変更する必要があります。%0D%0A%0D%0A%0D%0Aご不明な点等ありましたら、お手数をおかけいたしますが、下記の問い合わせ先もしくは弊社の担当までご連絡ください。%0D%0A%0D%0A今後ともどうぞよろしくお願い致します。%0D%0A%0D%0A※このメールに心当たりがない場合は、お手数ですが破棄してください。%0D%0A%0D%0A問い合わせ先%0D%0A株式会社プロジェクトM%0D%0AEmail：".$contact;

            $data = [
                'overview' => $overview,
                'company' => $company,
                'body' => $body,
            ];
            return view('admin.company-issue-send', $data)->with('success', '企業アカウントの発行が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AdminCompanyList() {
        $company_users = Company::pluck('user_id')->toArray();
        $layout_views = LayoutView::whereNotNull('company_id')->pluck('company_id')->toArray();
        $unregisted = LayoutView::whereNull('company_id')->pluck('distribution_id')->toArray();
        $data = [
            'overview' => Overview::find(1),
            'layouts' => LayoutView::whereNotNull('company_id')->get(),
            'companies' => Company::whereNotIn('id', $layout_views)->get(),
            'company_users' => User::role('company')->whereNotIn('id', $company_users)->get(),
            'distribution_views' => DistributionView::all(),
        ];
        return view('admin.companies', $data);
    }

    public function AdminCompanyLayoutPost($id, Request $request) {
        try {
            if ($request->distribution_id === 0) {
                Layout::where('company_id', $id)->update(['company_id' => null]);
            } else {
                Layout::where('id', $request->distribution_id)->update(['company_id' => $id]);
            }
            return redirect()->back()->with('success', '企業アカウントのレイアウトの更新が完了しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AdminCompanyEdit($user_id) {
        if (Auth::user()->id !== $user_id && !Auth::user()->hasRole('admin')) {
            return redirect()->back()->with('error', 'アクセス権限がありません');
        }
        $company = Company::where('user_id', $user_id)->first();
        $data = [
            'overview' => Overview::find(1),
            'company' => $company,
            'user' => User::find($user_id),
            'layout' => LayoutView::where('company_id', $company->id)->first(),
            'faculties' => Faculty::all(),
            'grades' => Grade::all(),
            'industry' => CompanyIndustryView::where('company_id', $company->id)->first(),
            'major_industry' => MajorIndustry::all(),
            'industry_views' => IndustryView::all(),
            'occupation' => Occupation::where('company_id', $company->id)->first(),
            'targets' => TargetView::where('company_id', $company->id)->get(),
            'branch_offices' => BranchOffice::where('company_id', $company->id)->get(),
        ];
        return view('admin.company-edit', $data);
    }

    public function AdminCompanyEditPost($user_id, Request $request) {

    }

    public function AdminQrIssue() {
        $layouts = LayoutView::whereNotNull('company_id')->get();
        foreach ($layouts as $layout) {
            $qr_data = [
                'company_id' => $layout->company_id,
                'distribution_id' => $layout->distribution_id,
                'date_id' => $layout->date_id,
                'period_id' => $layout->period_id,
                'booth_id' => $layout->booth_id,
            ];
            $qr_code = QrCode::create(json_encode($qr_data))
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
                ->setSize(500)
                ->setMargin(0);
            $writer = new PngWriter();
            $layout->qr = $writer->write($qr_code)->getDataUri();
        }
        $data = [
            'layouts' => $layouts,
        ];
        return view('admin.qr-issue', $data);
    }

    public function AdminQrIssueSmall() {
        $layouts = LayoutView::whereNotNull('company_id')->get();
        foreach ($layouts as $layout) {
            $qr_data = [
                'company_id' => $layout->company_id,
                'distribution_id' => $layout->distribution_id,
                'date_id' => $layout->date_id,
                'period_id' => $layout->period_id,
                'booth_id' => $layout->booth_id,
            ];
            $qr_code = QrCode::create(json_encode($qr_data))
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
                ->setSize(500)
                ->setMargin(0);
            $writer = new PngWriter();
            $layout->qr = $writer->write($qr_code)->getDataUri();
        }
        $data = [
            'layouts' => $layouts,
        ];
        return view('admin.qr-issue-small', $data);
    }

    public function AdminAdmission() {
        $data = [
            'overview' => Overview::find(1),
            'user' => Auth::user(),
        ];
        return view('admin.admission', $data);
    }

    public function AdminAdmissionPost(Request $request) {

    }
}
