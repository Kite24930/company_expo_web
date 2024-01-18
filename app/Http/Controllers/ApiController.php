<?php

namespace App\Http\Controllers;

use App\Models\BranchOffice;
use App\Models\Company;
use App\Models\Industry;
use App\Models\IndustryView;
use App\Models\Occupation;
use App\Models\Target;
use App\Models\TargetView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        ],
        [
            'company_name.required' => '企業名を入力してください。',
            'company_name_ruby.required' => '企業名（ふりがな）を入力してください。',
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
        ],
        [
            'industry_id.required' => '業種を選択してください。',
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

    public function companyLogoEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'company_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'company_logo.required' => 'ロゴを選択してください。',
            'company_logo.image' => 'ロゴは画像ファイルを選択してください。',
            'company_logo.mimes' => 'ロゴはjpeg,png,jpgのいずれかのファイルを選択してください。',
            'company_logo.max' => 'ロゴは2MB以下のファイルを選択してください。',
        ]);
        try {
            $file = $request->file('company_logo');
            $file_name = 'company_logo.'.$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('company/'.$request->company_id, $file, $file_name);
            $company = Company::find($request->company_id);
            $company->company_logo = $file_name;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => 'ロゴの更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'ロゴの更新に失敗しました。',
            ]);
        }
    }

    public function companyImgEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'company_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'company_img.required' => '画像を選択してください。',
            'company_img.image' => '画像は画像ファイルを選択してください。',
            'company_img.mimes' => '画像はjpeg,png,jpgのいずれかのファイルを選択してください。',
            'company_img.max' => '画像は2MB以下のファイルを選択してください。',
        ]);
        try {
            $file = $request->file('company_img');
            $file_name = 'company_img.'.$file->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('company/'.$request->company_id, $file, $file_name);
            $company = Company::find($request->company_id);
            $company->company_img = $file_name;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '画像の更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '画像の更新に失敗しました。',
            ]);
        }
    }

    public function businessDetailEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'business_detail' => 'required',
        ],
        [
            'business_detail.required' => '事業内容を入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->business_detail = $request->business_detail;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '事業内容の更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '事業内容の更新に失敗しました。',
            ]);
        }
    }

    public function prEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'pr' => 'required',
        ],
        [
            'pr.required' => 'PRを入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->pr = $request->pr;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => 'PRの更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'PRの更新に失敗しました。',
            ]);
        }
    }

    public function occupationItemAdd(Request $request) {
        $target = $request->id;
        $value = '';
        $doc = view('components.elements.occupation-item', compact('target', 'value'))->render();
        return response()->json([
            'success' => true,
            'message' => '職種の追加が完了しました。',
            'doc' => $doc,
        ]);
    }

    public function occupationItemDelete($id, Request $request) {
        try {
            $occupation = Occupation::find($id);
            $occupation->delete();
            return response()->json([
                'success' => true,
                'message' => '職種の削除が完了しました。',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '職種の削除に失敗しました。',
            ]);
        }
    }

    public function occupationEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'occupations' => 'required',
        ],
        [
            'occupations.required' => '職種を入力してください。',
        ]);
        try {
            foreach ($request->occupations as $item) {
                if ($item['id'] > 0) {
                    $occupation = Occupation::find($item['id']);
                    $occupation->recruit_occupation = $item['recruit_occupation'];
                    $occupation->save();
                } else {
                    $occupation = Occupation::create([
                        'company_id' => $request->company_id,
                        'recruit_occupation' => $item['recruit_occupation'],
                    ]);
                }
            }
            $occupations = Occupation::where('company_id', $request->company_id)->get();
            foreach ($occupations as $occupation) {
                $target = $occupation->id;
                $value = $occupation->recruit_occupation;
                $doc[] = view('components.elements.occupation-item', compact('target', 'value'))->render();
            }
            return response()->json([
                'success' => true,
                'message' => '職種の更新が完了しました。',
                'occupations' => $occupations,
                'doc' => $doc,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '職種の更新に失敗しました。',
            ]);
        }
    }

    public function jobDetailEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'job_detail' => 'required',
        ],
        [
            'job_detail.required' => '仕事内容を入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->job_detail = $request->job_detail;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '仕事内容の更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '仕事内容の更新に失敗しました。',
            ]);
        }
    }

    public function targetEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'targets' => 'required',
        ],
        [
            'targets.required' => '対象者を入力してください。',
        ]);
        try {
            Target::where('company_id', $request->company_id)->delete();
            foreach ($request->targets as $item) {
                Target::create([
                    'company_id' => $request->company_id,
                    'faculty_id' => $item['id'],
                ]);
            }
            $targets = TargetView::where('company_id', $request->company_id)->get();
            return response()->json([
                'success' => true,
                'message' => '対象者の更新が完了しました。',
                'targets' => $targets,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '対象者の更新に失敗しました。',
            ]);
        }
    }

    public function headOfficeAddressEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'head_office_address' => 'required',
            'head_office_lat' => 'required',
            'head_office_lng' => 'required',
        ],
        [
            'head_office_address.required' => '本社所在地を入力してください。',
            'head_office_lat.required' => '本社所在地を入力してください。',
            'head_office_lng.required' => '本社所在地を入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->head_office_address = $request->head_office_address;
            $company->head_office_lat = $request->head_office_lat;
            $company->head_office_lng = $request->head_office_lng;
            $company->save();
            $branch_offices = BranchOffice::where('company_id', $request->company_id)->get();
            return response()->json([
                'success' => true,
                'message' => '本社所在地の更新が完了しました。',
                'company' => $company,
                'branch_offices' => $branch_offices,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '本社所在地の更新に失敗しました。',
            ]);
        }
    }

    public function establishedAtEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'established_at' => 'required',
        ],
        [
            'established_at.required' => '設立年月日を入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->established_at = $request->established_at;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '設立年月日の更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '設立年月日の更新に失敗しました。',
            ]);
        }
    }
}
