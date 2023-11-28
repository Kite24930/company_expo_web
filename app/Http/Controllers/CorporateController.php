<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CorporateController extends Controller
{
    public function CorporateAccount() {
        $data = [

        ];
        return view('corporate.account', $data);
    }

    public function CorporateAccountEdit() {
        $data = [

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
