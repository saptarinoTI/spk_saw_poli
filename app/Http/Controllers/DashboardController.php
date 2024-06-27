<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Calculation;
use App\Models\Criteria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = date('Y');

        $cCriterias = Criteria::get();
        $criterias = Criteria::where('aktif', 1)->get();
        $calculations = Calculation::where('tahun', $tahun)->get();
        $datas = Alternative::with('calculations')->get();

        $rank = [];

        return view('master.dashboard',  compact('cCriterias', 'datas', 'criterias', 'calculations', 'rank', 'tahun'));
    }
}
