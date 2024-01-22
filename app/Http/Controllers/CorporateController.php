<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use App\Models\Company;
use App\Models\Faculty;
use App\Models\Industry;
use App\Models\IndustryView;
use App\Models\LayoutView;
use App\Models\MajorIndustry;
use App\Models\Occupation;
use App\Models\Overview;
use App\Models\TargetView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorporateController extends Controller
{
    public function CorporateAccount() {
        $data = [
            'overview' => Overview::find(1),
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

    public function CorporateAdvertisement() {
        $data = [

        ];
        return view('corporate.advertisement', $data);
    }

    public function CorporateAdvertisementPost(Request $request) {

    }

    public function CorporateFollowers() {
        $data = [

        ];
        return view('corporate.followers', $data);
    }

    public function CorporateVisitors() {
        $data = [

        ];
        return view('corporate.visitors', $data);
    }
}
