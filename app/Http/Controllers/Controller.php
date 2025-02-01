<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        $user = Auth::user()->user_type;
        switch ($user) {
            case 777:
                return redirect()->route('doc.dash');
                break;
            case 755:
                return redirect()->route('rec.dash');
                break;
                default:
                return redirect()->route('login');
        }
    }
}
