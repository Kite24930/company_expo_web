<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function StudentAccount() {
        $data = [

        ];
        return view('student.account', $data);
    }

    public function StudentAccountEdit() {
        $data = [

        ];
        return view('student.edit', $data);
    }

    public function StudentAccountPost(Request $request) {

    }

    public function StudentFollowed() {
        $data = [

        ];
        return view('student.followed', $data);
    }

    public function StudentVisited() {
        $data = [

        ];
        return view('student.visited', $data);
    }

    public function StudentQrRead() {
        $data = [

        ];
        return view('student.qr-read', $data);
    }

    public function StudentQrPost(Request $request) {

    }

    public function StudentAdmission() {
        $data = [

        ];
        return view('student.admission', $data);
    }
}
