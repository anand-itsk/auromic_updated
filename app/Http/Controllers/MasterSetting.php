<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterSetting extends Controller
{
    public function setting()
    {
        return view('settings.index');
    }
}
