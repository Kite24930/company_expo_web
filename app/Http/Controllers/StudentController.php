<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Faculty;
use App\Models\FollowerView;
use App\Models\Grade;
use App\Models\LayoutView;
use App\Models\Overview;
use App\Models\Student;
use App\Models\StudentView;
use App\Models\TargetView;
use App\Models\VisitorView;
use App\Providers\RouteServiceProvider;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function StudentInitialSetting() {
        $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
        if ($admission) {
            $is_admission = true;
        } else {
            $is_admission = false;
        }
        $data = [
            'overview' => Overview::find(1),
            'user' => auth()->user(),
            'student' => StudentView::where('user_id', auth()->user()->id)->first(),
            'is_admission' => $is_admission,
            'faculties' => Faculty::all(),
            'grades' => Grade::all(),
        ];
        return view('student.initial-setting', $data);
    }

    public function StudentInitialSettingPost (Request $request) {
        $request->validate([
            'gender' => 'required',
            'faculty' => 'required',
            'grade' => 'required',
            'address' => 'required',
            'birthplace' => 'required',
            'follow_disclosure' => 'required',
        ]);

        $user = auth()->user();

        try {
            Student::create([
                'user_id' => $user->id,
                'student_name' => $user->name,
                'gender' => $request->gender,
                'email' => $user->email,
                'faculty_id' => $request->faculty,
                'grade_id' => $request->grade,
                'address' => $request->address,
                'birthplace' => $request->birthplace,
                'follow_disclosure' => $request->follow_disclosure,
            ]);

            return redirect(RouteServiceProvider::HOME)->with('success', '初期設定が完了しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '初期設定に失敗しました。');
        }
    }

    public function StudentAccount() {
        $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
        if ($admission) {
            $is_admission = true;
        } else {
            $is_admission = false;
        }
        $data = [
            'overview' => Overview::find(1),
            'user' => auth()->user(),
            'student' => StudentView::where('user_id', auth()->user()->id)->first(),
            'is_admission' => $is_admission,
            'faculties' => Faculty::all(),
            'grades' => Grade::all(),
        ];
        return view('student.account', $data);
    }

    public function StudentAccountEdit() {
        $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
        if ($admission) {
            $is_admission = true;
        } else {
            $is_admission = false;
        }
        $data = [
            'overview' => Overview::find(1),
            'user' => auth()->user(),
            'student' => StudentView::where('user_id', auth()->user()->id)->first(),
            'is_admission' => $is_admission,
            'faculties' => Faculty::all(),
            'grades' => Grade::all(),
        ];
        return view('student.edit', $data);
    }

    public function StudentAccountPost(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'faculty_id' => 'required',
            'grade_id' => 'required',
            'address' => 'required',
            'birthplace' => 'required',
            'follow_disclosure' => 'nullable',
        ],
        [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'faculty_id.required' => '学部を選択してください。',
            'grade_id.required' => '学年を選択してください。',
            'address.required' => '住所を入力してください。',
            'birthplace.required' => '出身地を入力してください。',
        ]);

        try {
            if ($request->follow_disclosure === null) {
                $follow_disclosure = 0;
            } else {
                $follow_disclosure = 1;
            }
            $student = Student::where('user_id', auth()->user()->id)->first();
            $student->email = $request->email;
            $student->faculty_id = $request->faculty_id;
            $student->grade_id = $request->grade_id;
            $student->address = $request->address;
            $student->birthplace = $request->birthplace;
            $student->follow_disclosure = $follow_disclosure;
            $student->save();

            return redirect()->back()->with('success', 'アカウント情報を更新しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'アカウント情報の更新に失敗しました。');
        }
    }

    public function StudentFollowed() {
        $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
        if ($admission) {
            $is_admission = true;
        } else {
            $is_admission = false;
        }
        $followed = FollowerView::where('student_user_id', auth()->user()->id)->orderBy('distribution_id')->get();
        $data = [
            'overview' => Overview::find(1),
            'companies' => $followed,
            'user' => auth()->user(),
            'student' => StudentView::where('user_id', auth()->user()->id)->first(),
            'is_admission' => $is_admission,
            'faculties' => Faculty::all(),
            'grades' => Grade::all(),
        ];
        return view('student.followed', $data);
    }

    public function StudentVisited() {
        $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
        if ($admission) {
            $is_admission = true;
        } else {
            $is_admission = false;
        }
        $visited = VisitorView::where('student_user_id', auth()->user()->id)->orderBy('distribution_id')->get();
        $data = [
            'overview' => Overview::find(1),
            'companies' => $visited,
            'user' => auth()->user(),
            'student' => StudentView::where('user_id', auth()->user()->id)->first(),
            'is_admission' => $is_admission,
            'faculties' => Faculty::all(),
            'grades' => Grade::all(),
        ];
        return view('student.visited', $data);
    }

    public function StudentQrRead() {
        $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
        if ($admission) {
            $is_admission = true;
        } else {
            $is_admission = false;
        }
        $data = [
            'overview' => Overview::find(1),
            'user' => auth()->user(),
            'student' => StudentView::where('user_id', auth()->user()->id)->first(),
            'is_admission' => $is_admission,
            'faculties' => Faculty::all(),
            'grades' => Grade::all(),
        ];
        return view('student.qr-read', $data);
    }

    public function StudentQrPost(Request $request) {

    }

    public function StudentAdmission() {
        $admission = Admission::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();
        if ($admission) {
            $is_admission = true;
        } else {
            $is_admission = false;
        }
        $qr_data = [
            'user_id' => encrypt(auth()->user()->id),
            'issue_date' => date('Y-m-d'),
            'token' => encrypt(auth()->user()->api_token),
        ];
        $qr_code = QrCode::create(json_encode($qr_data))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(500)
            ->setMargin(0);
        $writer = new PngWriter();
        $result = $writer->write($qr_code);
        $data = [
            'overview' => Overview::find(1),
            'user' => auth()->user(),
            'student' => StudentView::where('user_id', auth()->user()->id)->first(),
            'is_admission' => $is_admission,
            'faculties' => Faculty::all(),
            'grades' => Grade::all(),
            'qr_code' => $result->getDataUri(),
        ];
        return view('student.admission', $data);
    }
}
