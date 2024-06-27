<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Calculation;
use App\Models\Criteria;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index()
    {
        $tahun = date('Y');

        $criterias = Criteria::where('aktif', 1)->get();
        $calculations = Calculation::where('tahun', $tahun)->get();
        $datas = Alternative::with('calculations')->get();

        $rank = [];

        return view('master.hasil.test', compact('datas', 'criterias', 'calculations', 'rank'));
    }
}
