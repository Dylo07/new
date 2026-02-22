<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function returnPolicy()
    {
        return view('policies.return-policy');
    }

    public function privacyPolicy()
    {
        return view('policies.privacy-policy');
    }

    public function termsAndConditions()
    {
        return view('policies.terms-and-conditions');
    }
}
