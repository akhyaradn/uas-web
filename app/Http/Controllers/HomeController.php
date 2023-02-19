<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penginapan;
use App\Models\Wisata;
use App\Models\Transportasi;
use App\Models\Peserta;
use App\Models\Tour;
use PhpParser\Node\Expr\Cast\Object_;

class HomeController extends Controller
{
    /*
     * Dashboard Pages Routs
     */
    public function index(Request $request)
    {   
        $data = (object)[];

        if(!$request->user()->is_admin) {
            $data = Tour::where('user_id', $request->user()->uuid)->get();
        }

        return view('dashboards.dashboard', compact('data'));
    }

    public function login(Request $request)
    {
        return view('auth.login');
    }
}
