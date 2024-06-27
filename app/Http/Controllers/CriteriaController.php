<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CriteriaController extends Controller
{
    public function index(Request $request): View
    {
        $datas = Criteria::all();
        return view('master.criteria.index', compact('datas'));
    }

    public function create(): View
    {
        return view('master.criteria.create');
    }

    public function store(Request $request)
    {
        $datas = $request->validate([
            'kode' => ['required', 'unique:criterias,kode'],
            'keterangan' => ['required'],
            'atribut' => ['required', 'in:cost,benefit'],
            'bobot' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            Criteria::create($datas);

            DB::commit();
            Session::flash('sukses', 'Data berhasil disimpan.');
            return to_route('criterias.index');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function edit(string $id)
    {
        $data = Criteria::findOrFail($id);
        return view('master.criteria.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $sql = Criteria::findOrFail($id);
        $datas = $request->validate([
            'kode' => ['required', Rule::unique('criterias')->ignore($id)],
            'keterangan' => ['required'],
            'atribut' => ['required', 'in:cost,benefit'],
            'bobot' => ['required'],
            'aktif' => ['required']
        ]);

        DB::beginTransaction();
        try {
            $sql->update($datas);

            DB::commit();
            Session::flash('sukses', 'Data berhasil disimpan.');
            return to_route('criterias.index');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }

    public function destroy(string $id)
    {
        $data = Criteria::findOrFail($id);

        DB::beginTransaction();
        try {
            $data->delete();

            DB::commit();
            Session::flash('sukses', 'Data berhasil dihapus.');
            return to_route('criterias.index');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }
}
