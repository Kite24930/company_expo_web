<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\BranchOffice;
use App\Models\CompanyView;
use App\Models\Date;
use App\Models\FollowerView;
use App\Models\LayoutView;
use App\Models\MajorIndustry;
use App\Models\Overview;
use App\Models\Period;
use App\Models\TargetView;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function Index() {
        $data = [
            'overview' => Overview::find(1),
            'dates' => Date::all(),
            'periods' => Period::all(),
            'layout_views' => LayoutView::all(),
            'major_industries' => MajorIndustry::all(),
            'advertisements' => Advertisement::all(),
        ];
        if (Auth()->check()) {
            $data['follower_views'] = FollowerView::where('student_user_id', Auth()->user()->id)->get();
            $data['visitor_views'] = FollowerView::where('student_user_id', Auth()->user()->id)->get();
        }
        return view('main.index', $data);
    }

    public function CompanyList() {
        $data = [
            'layout_views' => LayoutView::all(),
            'branch_offices' => BranchOffice::all(),
            'target_views' => TargetView::all(),
        ];
        if (Auth()->check()) {
            $data['follower_views'] = FollowerView::where('student_user_id', Auth()->user()->id)->get();
            $data['visitor_views'] = FollowerView::where('student_user_id', Auth()->user()->id)->get();
        }
        return view('main.list', $data);
    }

    public function CompanyDetail($id) {
        $data = [
            'company_views' => CompanyView::find($id),
            'branch_offices' => BranchOffice::where('company_id', $id)->get(),
            'target_views' => TargetView::where('company_id', $id)->get(),
        ];
        if (Auth()->check()) {
            $data['follower_views'] = FollowerView::where('student_user_id', Auth()->user()->id)->where('company_id', $id)->get();
            $data['visitor_views'] = FollowerView::where('student_user_id', Auth()->user()->id)->where('company_id', $id)->get();
        }
        return view('main.list', $data);
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
        return view('main.policy');
    }

    public function TermsOfUse() {
        return view('main.terms');
    }
}
