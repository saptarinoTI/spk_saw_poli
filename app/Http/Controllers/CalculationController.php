<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Calculation;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CalculationController extends Controller
{
    public function index()
    {
        $tahun = date('Y');

        $criterias = Criteria::where('aktif', 1)->orderBy('kode')->get();
        $calculations = Calculation::where('tahun', $tahun)->get();
        $datas = Alternative::with('calculations')->get();

        $array_minmax = [];

        return view('master.calculate.index', compact('datas', 'criterias', 'calculations', 'array_minmax', 'tahun'));
    }

    public function create()
    {
        $alternatives = Alternative::all();
        $criterias = Criteria::where('aktif', 1)->orderBy('kode')->get();
        return view('master.calculate.create', compact('alternatives', 'criterias'));
    }

    public function store(Request $request)
    {
        $calc = Calculation::where('alternative_id', $request->atribut_id)->where('tahun', $request->tahun)->first();

        if ($calc) {
            Session::flash('error', 'Alternatif ' . $calc->alternative->alternatif  . ' dengan tahun ' . $request->tahun . ' telah terdaftar.');
            return back();
        }


        $criterias = Criteria::where('aktif', 1)->get();
        $validate_array = ['atribut_id' => 'required', 'tahun' => 'required'];
        for ($x = 1; $x <= count($criterias); $x++) {
            $validate_array['criteria_' . $x] = 'required';
        }
        $datas = $request->validate($validate_array);
        $criterias = Criteria::where('aktif', 1)->get();

        // dd($datas);
        DB::beginTransaction();
        try {
            foreach ($criterias as $x => $criteria) {
                $cri = 'criteria_' . $x + 1;
                Calculation::create([
                    'alternative_id' => $request->atribut_id,
                    'criteria_id' => $criteria->id,
                    'tahun' => $request->tahun,
                    'value' =>  $request->$cri,
                ]);
            }

            DB::commit();
            Session::flash('sukses', 'Data berhasil disimpan.');
            return to_route('perhitungan.index');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function edit(string $id)
    {
        $data = Alternative::findOrFail($id);
        $criterias = Criteria::where('aktif', 1)->get();

        return view('master.calculate.edit', compact('data', 'criterias'));
    }

    public function update(Request $request, string $id)
    {
        $calc = Calculation::where('tahun', $request->tahun)->where('alternative_id', $id)->get();

        $criterias = Criteria::where('aktif', 1)->get();
        for ($x = 1; $x <= count($criterias); $x++) {
            $validate_array['criteria_' . $x] = 'required';
        }
        $datas = $request->validate($validate_array);

        DB::beginTransaction();
        try {
            foreach ($calc as $cal) {
                $cal->delete();
            }

            foreach ($criterias as $x => $criteria) {
                $cri = 'criteria_' . $x + 1;
                Calculation::create([
                    'alternative_id' => $id,
                    'criteria_id' => $criteria->id,
                    'tahun' => $request->tahun,
                    'value' =>  $request->$cri,
                ]);
            }
            DB::commit();

            Session::flash('sukses', 'Data berhasil disimpan.');
            return to_route('perhitungan.index');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function destroy(string $id)
    {
        $datas = Calculation::where('alternative_id', $id)->get();

        DB::beginTransaction();
        try {
            foreach ($datas as $data) {
                $data->delete();
            }

            DB::commit();
            Session::flash('sukses', 'Data berhasil dihapus.');
            return to_route('perhitungan.index');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }
}
