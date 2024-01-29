<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Faculty;
use App\Models\Grade;
use App\Models\Overview;
use App\Models\Student;
use App\Models\StudentView;
use App\Providers\RouteServiceProvider;
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

    }

    public function StudentFollowed() {
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
        return view('student.followed', $data);
    }

    public function StudentVisited() {
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
        $data = [
            'overview' => Overview::find(1),
            'user' => auth()->user(),
            'student' => StudentView::where('user_id', auth()->user()->id)->first(),
            'is_admission' => $is_admission,
            'faculties' => Faculty::all(),
            'grades' => Grade::all(),
        ];
        return view('student.admission', $data);
    }
}
