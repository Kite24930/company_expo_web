<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use App\Models\Company;
use App\Models\Faculty;
use App\Models\FollowerView;
use App\Models\Grade;
use App\Models\Industry;
use App\Models\IndustryView;
use App\Models\LayoutView;
use App\Models\MajorIndustry;
use App\Models\Occupation;
use App\Models\OneWordPr;
use App\Models\Overview;
use App\Models\StudentView;
use App\Models\TargetView;
use App\Models\User;
use App\Models\VisitorView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorporateController extends Controller
{
    public function CorporateAccount() {
        $company_id = Company::where('user_id', Auth::user()->id)->first();
        if ($company_id === null) {
            return redirect()->route('company.edit');
        }
        $company_id = $company_id->id;
        $faculties = Faculty::all();
        $faculty_ids = Faculty::pluck('id')->toArray();
        $grades = Grade::all();
        foreach ($faculty_ids as $faculty_id) {
            $students['faculty'][$faculty_id] = StudentView::where('faculty_id', $faculty_id)->count();
            $followers['faculty'][$faculty_id] = FollowerView::where('student_faculty_id', $faculty_id)->where('company_id', $company_id)->count();
            $visitors['faculty'][$faculty_id] = VisitorView::where('student_faculty_id', $faculty_id)->where('company_id', $company_id)->count();
            foreach ($grades as $grade) {
                $students[$faculty_id][$grade->id] = StudentView::where('faculty_id', $faculty_id)->where('grade_id', $grade->id)->count();
                $followers[$faculty_id][$grade->id] = FollowerView::where('student_faculty_id', $faculty_id)->where('company_id', $company_id)->where('student_grade_id', $grade->id)->count();
                $visitors[$faculty_id][$grade->id] = VisitorView::where('student_faculty_id', $faculty_id)->where('company_id', $company_id)->where('student_grade_id', $grade->id)->count();
            }
        }
        foreach ($grades as $grade) {
            $students['grade'][$grade->id] = StudentView::where('grade_id', $grade->id)->count();
            $followers['grade'][$grade->id] = FollowerView::where('student_grade_id', $grade->id)->where('company_id', $company_id)->count();
            $visitors['grade'][$grade->id] = VisitorView::where('student_grade_id', $grade->id)->where('company_id', $company_id)->count();
        }
        $student_count['all'] = StudentView::count();
        $follower_count['all'] = FollowerView::where('company_id', $company_id)->count();
        $visitor_count['all'] = VisitorView::where('company_id', $company_id)->count();
        foreach ($faculties as $faculty) {
            $student_count['faculty'][$faculty->id] = StudentView::where('faculty_id', $faculty->id)->count();
            $follower_count['faculty'][$faculty->id] = FollowerView::where('student_faculty_id', $faculty->id)->where('company_id', $company_id)->count();
            $visitor_count['faculty'][$faculty->id] = VisitorView::where('student_faculty_id', $faculty->id)->where('company_id', $company_id)->count();
        }
        foreach ($grades as $grade) {
            $student_count['grade'][$grade->id] = StudentView::where('grade_id', $grade->id)->count();
            $follower_count['grade'][$grade->id] = FollowerView::where('company_id', $company_id)->where('student_grade_id', $grade->id)->count();
            $visitor_count['grade'][$grade->id] = VisitorView::where('company_id', $company_id)->where('student_grade_id', $grade->id)->count();
        }
        $data = [
            'overview' => Overview::find(1),
            'account' => User::find(Auth::user()->id),
            'faculties' => $faculties,
            'grades' => $grades,
            'students' => $students,
            'followers' => $followers,
            'visitors' => $visitors,
            'student_count' => $student_count,
            'follower_count' => $follower_count,
            'visitor_count' => $visitor_count,
        ];
        return view('corporate.account', $data);
    }

    public function CorporateAccountEdit() {
        $company = Company::where('user_id', Auth::user()->id)->first();
        $msg = null;
        if (!$company) {
            $company = Company::create([
                'user_id' => Auth::user()->id,
                'company_logo' => null,
                'company_img' => null,
                'company_name' => '企業名',
                'company_name_ruby' => 'キギョウメイ',
                'mieet_plus_id' => null,
                'url' => null,
                'business_detail' => null,
                'pr' => null,
                'head_office_address' => '未入力',
                'head_office_lat' => 35.0,
                'head_office_lng' => 135.0,
                'established_at' => date('Y-m-d'),
                'capital' => 0,
                'sales' => null,
                'employees' => 0,
                'mie_univ_ob_og' => 0,
                'job_detail' => null,
                'planned_number' => null,
                'recruit_department' => '未入力',
                'recruit_in_charge_person' => '未入力',
                'recruit_in_charge_person_ruby' => 'みにゅうりょく',
                'recruit_in_charge_tel' => null,
                'recruit_in_charge_email' => '未入力',
            ]);
            $msg = '初期設定が完了しました。各項目を入力してください。' ;
        }
        $industry_id = Industry::where('company_id', $company->id)->first();
        if ($industry_id) {
            $industry = IndustryView::where('industry_id', $industry_id->industry_id)->first();
        }
        else {
            $industry = null;
        }
        $occupations = Occupation::where('company_id', $company->id)->get();
        $target = TargetView::where('company_id', $company->id)->get();
        $target_list = TargetView::where('company_id', $company->id)->pluck('faculty_id')->toArray();
        $branch_offices = BranchOffice::where('company_id', $company->id)->get();
        $major_industries = MajorIndustry::all();
        foreach ($major_industries as $major_industry) {
            $industries[] = [
                'id' => $major_industry->id,
                'name' => $major_industry->major_class_name,
                'industries' => IndustryView::where('major_class_id', $major_industry->id)->get(),
            ];
        }
        $faculties = Faculty::all();
        $data = [
            'overview' => Overview::find(1),
            'msg' => $msg,
            'company' => $company,
            'industry' => $industry,
            'occupations' => $occupations,
            'target' => $target,
            'target_list' => $target_list,
            'branch_offices' => $branch_offices,
            'industries' => $industries,
            'faculties' => $faculties,
        ];
        return view('corporate.edit', $data);
    }

    public function CorporateAccountEditPost(Request $request) {

    }

    public function CorporateOneWordPr() {
        $company = Company::where('user_id', Auth::user()->id)->first();
        $msg = null;
        if (!$company) {
            $company = Company::create([
                'user_id' => Auth::user()->id,
                'company_logo' => null,
                'company_img' => null,
                'company_name' => '企業名',
                'company_name_ruby' => 'キギョウメイ',
                'mieet_plus_id' => null,
                'url' => null,
                'business_detail' => null,
                'pr' => null,
                'head_office_address' => '未入力',
                'head_office_lat' => 35.0,
                'head_office_lng' => 135.0,
                'established_at' => date('Y-m-d'),
                'capital' => 0,
                'sales' => null,
                'employees' => 0,
                'mie_univ_ob_og' => 0,
                'job_detail' => null,
                'planned_number' => null,
                'recruit_department' => '未入力',
                'recruit_in_charge_person' => '未入力',
                'recruit_in_charge_person_ruby' => 'みにゅうりょく',
                'recruit_in_charge_tel' => null,
                'recruit_in_charge_email' => '未入力',
            ]);
            $msg = '初期設定が完了しました。各項目を入力してください。' ;
        }
        $industry_id = Industry::where('company_id', $company->id)->first();
        if ($industry_id) {
            $industry = IndustryView::where('industry_id', $industry_id->industry_id)->first();
        }
        else {
            $industry = null;
        }
        $occupations = Occupation::where('company_id', $company->id)->get();
        $target = TargetView::where('company_id', $company->id)->get();
        $target_list = TargetView::where('company_id', $company->id)->pluck('faculty_id')->toArray();
        $branch_offices = BranchOffice::where('company_id', $company->id)->get();
        $major_industries = MajorIndustry::all();
        foreach ($major_industries as $major_industry) {
            $industries[] = [
                'id' => $major_industry->id,
                'name' => $major_industry->major_class_name,
                'industries' => IndustryView::where('major_class_id', $major_industry->id)->get(),
            ];
        }
        $faculties = Faculty::all();
        $one_word_pr = OneWordPr::where('company_id', $company->id)->first();
        $data = [
            'overview' => Overview::find(1),
            'msg' => $msg,
            'company' => $company,
            'industry' => $industry,
            'occupations' => $occupations,
            'targets' => $target,
            'target_list' => $target_list,
            'branch_offices' => $branch_offices,
            'industries' => $industries,
            'faculties' => $faculties,
            'one_word_pr' => $one_word_pr,
        ];
        return view('corporate.one_word_pr', $data);
    }

    public function CorporateOneWordPrPost(Request $request) {
        $request->validate([
            'one_word_pr' => 'required',
            'text_color' => 'required',
            'background_color' => 'required',
        ],
        [
            'one_word_pr.required' => 'PR文を入力してください。',
            'text_color.required' => '文字色を選択してください。',
            'background_color.required' => '背景色を選択してください。',
        ]);

        try {
            $company = Company::where('user_id', Auth::user()->id)->first();
            $one_word_pr = OneWordPr::updateOrCreate(
                ['company_id' => $company->id],
                [
                    'one_word_pr' => $request->one_word_pr,
                    'text_color' => $request->text_color,
                    'background_color' => $request->background_color,
                ]
            );
            return back()->with('success', 'PR文を更新しました。');
        } catch (\Exception $e) {
            return back()->with('error', 'エラーが発生しました。');
        }
    }

    public function CorporateOneWordPrDelete() {
        $company = Company::where('user_id', Auth::user()->id)->first();
        $one_word_pr = OneWordPr::where('company_id', $company->id)->first();
        if ($one_word_pr) {
            $one_word_pr->delete();
            return back()->with('success', 'PR文を削除しました。');
        } else {
            return back()->with('error', 'PR文が見つかりませんでした。');
        }
    }

    public function CorporateAdvertisement() {
        $data = [

        ];
        return view('corporate.advertisement', $data);
    }

    public function CorporateAdvertisementPost(Request $request) {

    }

    public function CorporateFollowers() {
        $company_id = Company::where('user_id', Auth::user()->id)->first()->id;
        $followers = FollowerView::where('company_id', $company_id)->get();
        $faculties = Faculty::all();
        $grades = Grade::all();
        $data = [
            'overview' => Overview::find(1),
            'followers' => $followers,
            'faculties' => $faculties,
            'grades' => $grades,
        ];
        return view('corporate.followers', $data);
    }

    public function CorporateVisitors() {
        $company_id = Company::where('user_id', Auth::user()->id)->first()->id;
        $visitors = VisitorView::where('company_id', $company_id)->get();
        $faculties = Faculty::all();
        $grades = Grade::all();
        $data = [
            'overview' => Overview::find(1),
            'visitors' => $visitors,
            'faculties' => $faculties,
            'grades' => $grades,
        ];
        return view('corporate.visitors', $data);
    }
}
