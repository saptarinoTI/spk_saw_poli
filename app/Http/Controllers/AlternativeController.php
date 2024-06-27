<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AlternativeController extends Controller
{
    public function index(Request $request): View
    {
        $datas = Alternative::all();
        return view('master.alternative.index', compact('datas'));
    }

    public function create(): View
    {
        return view('master.alternative.create');
    }

    public function store(Request $request)
    {
        $kode = strtolower($request->kode);
        $alternatif = $request->alternatif;

        $request->validate([
            'kode' => ['required', 'unique:alternatives,kode'],
            'alternatif' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            Alternative::create([
                'kode' => $kode,
                'alternatif' => $alternatif,
            ]);

            DB::commit();
            Session::flash('sukses', 'Data berhasil disimpan.');
            return to_route('alternatives.index');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function edit(string $id)
    {
        $data = Alternative::findOrFail($id);
        return view('master.alternative.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Alternative::findOrFail($id);
        $request->validate([
            'kode' => ['required', Rule::unique('alternatives')->ignore($id)],
        ]);

        DB::beginTransaction();
        try {
            $data->update([
                'alternatif' => $request->alternatif,
            ]);

            DB::commit();
            Session::flash('sukses', 'Data berhasil disimpan.');
            return to_route('alternatives.index');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function destroy(string $id)
    {
        $data = Alternative::findOrFail($id);

        DB::beginTransaction();
        try {
            $data->delete();

            DB::commit();
            Session::flash('sukses', 'Data berhasil dihapus.');
            return to_route('alternatives.index');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }
}
