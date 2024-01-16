<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Industry;
use App\Models\IndustryView;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function Followed($id, Request $request) {

    }

    public function Unfollowed($id, Request $request) {

    }

    public function companyNameEdit (Request $request) {
        $request->validate([
            'company_id' => 'required',
            'company_name' => 'required',
            'company_name_ruby' => 'required',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->company_name = $request->company_name;
            $company->company_name_ruby = $request->company_name_ruby;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '企業名の更新が完了しました。',
                'company_name' => $request->company_name,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '企業名の更新に失敗しました。',
            ]);
        }
    }

    public function companyIndustryEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'industry_id' => 'required',
        ]);
        try {
            $industry = Industry::updateOrCreate(
                ['company_id' => $request->company_id],
                ['industry_id' => $request->industry_id]
            );
            $industry_data = IndustryView::where('industry_id', $request->industry_id)->first();
            return response()->json([
                'success' => true,
                'message' => '業種の更新が完了しました。',
                'industry' => $industry_data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '業種の更新に失敗しました。',
            ]);
        }
    }
}
