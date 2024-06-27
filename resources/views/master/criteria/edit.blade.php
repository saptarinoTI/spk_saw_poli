@extends('layouts.app')

@section('content')
    <x-breadcrumbs title="Data Kriteria">
        <li>Edit Data Kriteria</li>
    </x-breadcrumbs>
    <x-card>
        <form action="{{ route('criterias.update', $data->id) }}" method="post" class="p-4">
            @csrf
            @method('PUT')
            <div class="columns-1">
                <x-input label="Kode" name="kode" value="{{ $data->kode }}" />
                <x-input label="Kriteria" name="keterangan" value="{{ $data->keterangan }}" />
                <div class="mb-5">
                    <label class="font-semibold form-control text-[#344e41]">Atribut</label>
                    <select name="atribut" id="atribut"
                        class="@error('atribut') is-invalid @enderror w-full border border-gray-300  rounded-md m-0 py-2 px-3">
                        <option value="cost" {{ $data->atribut == 'cost' ? 'selected' : '' }}>Cost</option>
                        <option value="benefit" {{ $data->atribut == 'benefit' ? 'selected' : '' }}>Benefit</option>
                    </select>
                    @error('atribut')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <x-input label="Bobot" name="bobot" type="number" step="0.01" value="{{ $data->bobot }}" />

                <div class="mb-5">
                    <label class="font-semibold form-control text-[#344e41]">Aktif</label>
                    <select name="aktif" id="aktif"
                        class="@error('aktif') is-invalid @enderror w-full border border-gray-300  rounded-md m-0 py-2 px-3">
                        <option value="1" {{ $data->aktif == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $data->aktif == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('aktif')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <x-button route="{{ route('criterias.index') }}" />
        </form>
    </x-card>
@endsection

@section('script')
@endsection
