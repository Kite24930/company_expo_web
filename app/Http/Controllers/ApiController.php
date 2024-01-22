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

    public function capitalEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'capital' => 'required',
        ],
        [
            'capital.required' => '資本金を入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->capital = $request->capital;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '資本金の更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '資本金の更新に失敗しました。',
            ]);
        }
    }

    public function salesEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'sales' => 'nullable',
        ],
        [
            'sales.required' => '売上高を入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->sales = $request->sales;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '売上高の更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '売上高の更新に失敗しました。',
            ]);
        }
    }

    public function employeesEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'employees' => 'required',
        ],
        [
            'employees.required' => '従業員数を入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->employees = $request->employees;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '従業員数の更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '従業員数の更新に失敗しました。',
            ]);
        }
    }

    public function mieUnivObOgEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'mie_univ_ob_og' => 'required',
        ],
        [
            'mie_univ_ob_og.required' => '三重大OB・OGを入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->mie_univ_ob_og = $request->mie_univ_ob_og;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '三重大OB・OGの更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '三重大OB・OGの更新に失敗しました。',
            ]);
        }
    }

    public function plannedNumberEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'planned_number' => 'nullable',
        ],
        [
            'planned_number.required' => '採用予定人数を入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->planned_number = $request->planned_number;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '採用予定人数の更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '採用予定人数の更新に失敗しました。',
            ]);
        }
    }

    public function branchInsertHeadOffice(Request $request) {
        try {
            $request->validate([
                'company_id' => 'required',
            ],
            [
                'company_id.required' => '本社所在地を入力してください。',
            ]);
            $head_office = Company::find($request->company_id);
            $office = BranchOffice::create([
                'company_id' => $request->company_id,
                'office_name' => '本社',
                'office_address' => $head_office->head_office_address,
                'office_lat' => $head_office->head_office_lat,
                'office_lng' => $head_office->head_office_lng,
            ]);
            $branch_offices = BranchOffice::where('company_id', $request->company_id)->get();
            foreach ($branch_offices as $office) {
                $doc[] = view('components.elements.branch-office-item', compact('office'))->render();
            }
            return response()->json([
                'success' => true,
                'message' => '支店所在地の追加が完了しました。',
                'branch_offices' => $branch_offices,
                'office' => $office,
                'doc' => $doc,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '支店所在地の追加に失敗しました。',
            ]);
        }
    }

    public function branchOfficeDelete($id, $company_id, Request $request) {
        try {
            $office = BranchOffice::find($id);
            $office->delete();
            $branch_offices = BranchOffice::where('company_id', $company_id)->get();
            return response()->json([
                'success' => true,
                'message' => '支店所在地の削除が完了しました。',
                'branch_offices' => $branch_offices,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '支店所在地の削除に失敗しました。',
            ]);
        }
    }

    public function branchOfficeAdd($target, Request $request) {
        $doc = view('components.elements.branch-office-add-item', compact('target'))->render();
        return response()->json([
            'success' => true,
            'message' => '支店所在地の追加が完了しました。',
            'doc' => $doc,
        ]);
    }

    public function branchOfficeEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'branch_offices' => 'required',
        ],
        [
            'branch_offices.required' => '支店所在地を入力してください。',
        ]);
        try {
            foreach ($request->branch_offices as $item) {
                if ($item['id'] > 0) {
                    $office = BranchOffice::find($item['id']);
                    $office->office_name = $item['office_name'];
                    $office->office_address = $item['office_address'];
                    $office->office_lat = $item['office_lat'];
                    $office->office_lng = $item['office_lng'];
                    $office->save();
                } else {
                    $office = BranchOffice::create([
                        'company_id' => $request->company_id,
                        'office_name' => $item['office_name'],
                        'office_address' => $item['office_address'],
                        'office_lat' => $item['office_lat'],
                        'office_lng' => $item['office_lng'],
                    ]);
                }
            }
            $branch_offices = BranchOffice::where('company_id', $request->company_id)->get();
            foreach ($branch_offices as $office) {
                $doc[] = view('components.elements.branch-office-item', compact('office'))->render();
            }
            return response()->json([
                'success' => true,
                'message' => '支店所在地の更新が完了しました。',
                'branch_offices' => $branch_offices,
                'doc' => $doc,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '支店所在地の更新に失敗しました。',
            ]);
        }
    }

    public function recruitInChargeEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'recruit_department' => 'required',
            'recruit_in_charge_person' => 'required',
            'recruit_in_charge_person_ruby' => 'required',
            'recruit_in_charge_tel' => 'nullable',
            'recruit_in_charge_email' => 'required',
        ],
        [
            'recruit_department.required' => '採用担当部署を入力してください。',
            'recruit_in_charge_person.required' => '採用担当者を入力してください。',
            'recruit_in_charge_person_ruby.required' => '採用担当者（ふりがな）を入力してください。',
            'recruit_in_charge_tel.required' => '採用担当者電話番号を入力してください。',
            'recruit_in_charge_email.required' => '採用担当者メールアドレスを入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->recruit_department = $request->recruit_department;
            $company->recruit_in_charge_person = $request->recruit_in_charge_person;
            $company->recruit_in_charge_person_ruby = $request->recruit_in_charge_person_ruby;
            $company->recruit_in_charge_tel = $request->recruit_in_charge_tel;
            $company->recruit_in_charge_email = $request->recruit_in_charge_email;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => '採用担当者の更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '採用担当者の更新に失敗しました。',
            ]);
        }
    }

    public function urlEdit(Request $request) {
        $request->validate([
            'company_id' => 'required',
            'url' => 'nullable',
        ],
        [
            'url.required' => 'URLを入力してください。',
        ]);
        try {
            $company = Company::find($request->company_id);
            $company->url = $request->url;
            $company->save();
            return response()->json([
                'success' => true,
                'message' => 'URLの更新が完了しました。',
                'company' => $company,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'URLの更新に失敗しました。',
            ]);
        }
    }
}
