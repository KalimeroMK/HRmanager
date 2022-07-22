<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    
    public function showPolicy()
    {
        return view('hrms.policies');
    }
    
    public function showForms()
    {
        return view('hrms.forms');
    }
    
}



