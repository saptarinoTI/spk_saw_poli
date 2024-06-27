@extends('layouts.app')

@section('content')
    <x-breadcrumbs title="Data Kriteria">
        <li>Tambah Data Kriteria</li>
    </x-breadcrumbs>
    <x-card>
        <form action="{{ route('criterias.store') }}" method="post" class="p-4">
            @csrf
            <div class="columns-1">
                <x-input label="Kode" name="kode" />
                <x-input label="Kriteria" name="keterangan" />

                <div class="mb-5">
                    <label class="font-semibold form-control text-[#344e41]">Atribut</label>
                    <select name="atribut" id="atribut"
                        class="@error('atribut') is-invalid @enderror w-full border border-gray-300  rounded-md m-0 py-2 px-3">
                        <option value="cost">Cost</option>
                        <option value="benefit">Benefit</option>
                    </select>
                    @error('atribut')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <x-input label="Bobot" name="bobot" type="number" step="0.01" />
            </div>
            <x-button route="{{ route('criterias.index') }}" />
        </form>
    </x-card>
@endsection

@section('script')
@endsection
