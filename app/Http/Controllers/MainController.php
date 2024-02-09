<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Advertisement;
use App\Models\BranchOffice;
use App\Models\Company;
use App\Models\Date;
use App\Models\Faculty;
use App\Models\Follower;
use App\Models\FollowerView;
use App\Models\IndustryView;
use App\Models\LayoutView;
use App\Models\MajorIndustry;
use App\Models\Occupation;
use App\Models\Overview;
use App\Models\Period;
use App\Models\StudentView;
use App\Models\TargetView;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public $prefectures = [
        '北海道',
        '青森県',
        '岩手県',
        '宮城県',
        '秋田県',
        '山形県',
        '福島県',
        '茨城県',
        '栃木県',
        '群馬県',
        '埼玉県',
        '千葉県',
        '東京都',
        '神奈川県',
        '新潟県',
        '富山県',
        '石川県',
        '福井県',
        '山梨県',
        '長野県',
        '岐阜県',
        '静岡県',
        '愛知県',
        '三重県',
        '滋賀県',
        '京都府',
        '大阪府',
        '兵庫県',
        '奈良県',
        '和歌山県',
        '鳥取県',
        '島根県',
        '岡山県',
        '広島県',
        '山口県',
        '徳島県',
        '香川県',
        '愛媛県',
        '高知県',
        '福岡県',
        '佐賀県',
        '長崎県',
        '熊本県',
        '大分県',
        '宮崎県',
        '鹿児島県',
        '沖縄県',
    ];

    public $weekdays = [
        '日',
        '月',
        '火',
        '水',
        '木',
        '金',
        '土',
    ];

    public function Index() {
        $major_industries = MajorIndustry::all();
        foreach ($major_industries as $major_industry) {
            $industries[] = [
                'id' => $major_industry->id,
                'name' => $major_industry->major_class_name,
                'industries' => implode(',', IndustryView::where('major_class_id', $major_industry->id)->pluck('industry_id')->toArray()),
            ];
        }
        $data = [
            'overview' => Overview::find(1),
            'dates' => Date::all(),
            'periods' => Period::all(),
            'industries' => $industries,
            'weekdays' => $this->weekdays,
        ];
        if (Auth()->check()) {
            $data['follows'] = FollowerView::where('student_user_id', Auth()->user()->id)->pluck('company_id')->toArray();
            $data['visitors'] = FollowerView::where('student_user_id', Auth()->user()->id)->pluck('company_id')->toArray();
            $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
            if ($admission) {
                $data['is_admission'] = true;
            } else {
                $data['is_admission'] = false;
            }
            $data['student'] = StudentView::where('user_id', auth()->user()->id)->first();
            $data['user'] = auth()->user();
        } else {
            $data['is_admission'] = false;
        }
        return view('main.index', $data);
    }

    public function CompanyList(Request $request) {
        $search = [
            'keyword' => $request->keyword,
            'faculties' => explode(',', $request->faculties),
            'industries' => explode(',', $request->industries),
            'occupation' => $request->occupation,
            'capital' => $request->capital,
            'capital_type' => $request->capital_type,
            'sales' => $request->sales,
            'sales_type' => $request->sales_type,
            'employees' => $request->employees,
            'employees_type' => $request->employees_type,
            'mie_univ_ob_og' => $request->mie_univ_ob_og,
            'mie_univ_ob_og_type' => $request->mie_univ_ob_og_type,
            'branch_office' => explode(',', $request->branch_office),
        ];
        $filter = LayoutView::pluck('company_id')->toArray();
        if ($search['keyword']) {
            $filter = array_intersect($filter, LayoutView::where('company_name', 'like', '%' . $search['keyword'] . '%')->orWhere('business_detail', 'like', '%' .$search['keyword'] . '%')->orWhere('pr', 'like', '%' .$search['keyword'] . '%')->orWhere('job_detail', 'like', '%' .$search['keyword'] . '%')->pluck('company_id')->toArray());
        }
        if ($search['faculties'][0] != '') {
            $filter = array_intersect($filter, TargetView::whereIn('faculty_id', $search['faculties'])->pluck('company_id')->toArray());
        }
        if ($search['industries'][0] != '') {
            $filter = array_intersect($filter, LayoutView::whereIn('industry_id', $search['industries'])->pluck('company_id')->toArray());
        }
        if ($search['occupation']) {
            $filter = array_intersect($filter, Occupation::where('recruit_occupation', 'like', '%' . $search['occupation'] . '%')->pluck('company_id')->toArray());
        }
        if ($search['capital']) {
            if ($search['capital_type'] === 'up') {
                $filter = array_intersect($filter, LayoutView::where('capital', '>=', $search['capital'])->pluck('company_id')->toArray());
            } else {
                $filter = array_intersect($filter, LayoutView::where('capital', '<=', $search['capital'])->pluck('company_id')->toArray());
            }
        }
        if ($search['sales']) {
            if ($search['sales_type'] === 'up') {
                $filter = array_intersect($filter, LayoutView::where('sales', '>=', $search['sales'])->pluck('company_id')->toArray());
            } else {
                $filter = array_intersect($filter, LayoutView::where('sales', '<=', $search['sales'])->pluck('company_id')->toArray());
            }
        }
        if ($search['employees']) {
            if ($search['employees_type'] === 'up') {
                $filter = array_intersect($filter, LayoutView::where('employees', '>=', $search['employees'])->pluck('company_id')->toArray());
            } else {
                $filter = array_intersect($filter, LayoutView::where('employees', '<=', $search['employees'])->pluck('company_id')->toArray());
            }
        }
        if ($search['mie_univ_ob_og']) {
            if ($search['mie_univ_ob_og_type'] === 'up') {
                $filter = array_intersect($filter, LayoutView::where('mie_univ_ob_og', '>=', $search['mie_univ_ob_og'])->pluck('company_id')->toArray());
            } else {
                $filter = array_intersect($filter, LayoutView::where('mie_univ_ob_og', '<=', $search['mie_univ_ob_og'])->pluck('company_id')->toArray());
            }
        }
        if ($search['branch_office'][0] != '') {
            $branch_offices = [];
            foreach ($search['branch_office'] as $branch_office) {
                $branch_offices = array_merge($branch_offices, BranchOffice::where('office_address', 'like', '%' . $this->prefectures[$branch_office] . '%')->pluck('company_id')->toArray());
            }
            $filter = array_intersect($filter, $branch_offices);
        }
        $dates = Date::all();
        $periods = Period::all();
        foreach ($dates as $date) {
            foreach ($periods as $period) {
                $layout[$date->date][$period->period] = LayoutView::where('date', $date->date)->where('period', $period->period)->whereIn('company_id', $filter)->orderBy('distribution_id')->get();
                foreach ($layout[$date->date][$period->period] as $company) {
                    $branch_offices[$company->company_id] = BranchOffice::where('company_id', $company->company_id)->get();
                    $targets[$company->company_id] = TargetView::where('company_id', $company->company_id)->get();
                    $occupations[$company->company_id] = Occupation::where('company_id', $company->company_id)->get();
                }
            }
        }
        if (!isset($branch_offices)) {
            $branch_offices = null;
        }
        if (!isset($targets)) {
            $targets = null;
        }
        if (!isset($occupations)) {
            $occupations = null;
        }
        $data = [
            'overview' => Overview::find(1),
            'filter' => $filter,
            'layout' => $layout,
            'branch_offices' => $branch_offices,
            'targets' => $targets,
            'occupations' => $occupations,
            'dates' => Date::all(),
            'periods' => Period::all(),
            'faculties' => Faculty::all(),
            'industries' => IndustryView::all(),
            'prefectures' => $this->prefectures,
            'search' => $search,
        ];
        if (Auth()->check()) {
            $data['follows'] = FollowerView::where('student_user_id', Auth()->user()->id)->pluck('company_id')->toArray();
            $data['visitors'] = FollowerView::where('student_user_id', Auth()->user()->id)->pluck('company_id')->toArray();
            $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
            if ($admission) {
                $data['is_admission'] = true;
            } else {
                $data['is_admission'] = false;
            }
            $data['student'] = StudentView::where('user_id', auth()->user()->id)->first();
            $data['user'] = auth()->user();
        } else {
            $data['is_admission'] = false;
        }
        return view('main.list', $data);
    }

    public function CompanyDetail($id) {
        $data = [
            'overview' => Overview::find(1),
            'company' => LayoutView::where('company_id', $id)->first(),
            'branch_offices' => BranchOffice::where('company_id', $id)->get(),
            'target' => TargetView::where('company_id', $id)->get(),
            'occupations' => Occupation::where('company_id', $id)->get(),
        ];
        if (Auth()->check()) {
            $is_followed = FollowerView::where('student_user_id', Auth()->user()->id)->where('company_id', $id)->first();
            if ($is_followed) {
                $data['is_followed'] = true;
            } else {
                $data['is_followed'] = false;
            }
            $data['student'] = StudentView::where('user_id', auth()->user()->id)->first();
            $data['user'] = auth()->user();
            $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
            if ($admission) {
                $data['is_admission'] = true;
            } else {
                $data['is_admission'] = false;
            }
        } else {
            $data['is_admission'] = false;
        }
        return view('main.detail', $data);
    }

    public function CompanySearch() {
        $data = [

        ];
        return view('main.search', $data);
    }

    public function Advertisement($id) {
        $data = [
            'advertisement' => Advertisement::find($id),
        ];
        return view('main.advertisement', $data);
    }

    public function PrivacyPolicy() {
        $data = [
            'overview' => Overview::find(1),
        ];
        if (Auth()->check()) {
            $data['follower_views'] = FollowerView::where('student_user_id', Auth()->user()->id)->get();
            $data['visitor_views'] = FollowerView::where('student_user_id', Auth()->user()->id)->get();
            $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
            if ($admission) {
                $data['is_admission'] = true;
            } else {
                $data['is_admission'] = false;
            }
        } else {
            $data['is_admission'] = false;
        }
        return view('main.policy', $data);
    }

    public function TermsOfUse() {
        $data = [
            'overview' => Overview::find(1),
        ];
        if (Auth()->check()) {
            $data['follower_views'] = FollowerView::where('student_user_id', Auth()->user()->id)->get();
            $data['visitor_views'] = FollowerView::where('student_user_id', Auth()->user()->id)->get();
            $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
            if ($admission) {
                $data['is_admission'] = true;
            } else {
                $data['is_admission'] = false;
            }
        } else {
            $data['is_admission'] = false;
        }
        return view('main.terms', $data);
    }
}
