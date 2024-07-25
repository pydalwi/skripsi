<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;

class ThemeController extends Controller
{

    public function __construct(){
        $this->menuUrl   = url('setting/theme');     // set URL untuk menu ini
        $this->menuTitle = 'User Profile';                       // set nama menu
        $this->viewPath  = 'setting.profile.';         // untuk menunjukkan direktori view. Diakhiri dengan tanda titik
    }

    public function index($theme = ''){
        switch (strtolower($theme)){
            case 'dark' : $theme = 'dark'; break;
            default : $theme = 'light'; break;
        }
        session()->put('theme', $theme);

        return redirect()->back();
    }
}
