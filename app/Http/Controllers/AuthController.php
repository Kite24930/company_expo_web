<?php

namespace App\Http\Controllers;

use App\Models\Overview;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function dashboard() {
        if (Auth()->user()->first_login === 0) {
            return redirect()->route('profile.first-login');
        }
        if (Auth()->user()->getRoleNames()[0] == 'student') {
            return redirect()->route('student.show');
        } else if (Auth()->user()->getRoleNames()[0] == 'company') {
            return redirect()->route('company.show');
        }
        $data = [
            'overview' => Overview::find(1),
            'role' => Auth()->user()->getRoleNames()[0]
        ];
        return view('dashboard', $data);
    }
}
