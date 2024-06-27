@extends('layouts.app')

@section('content')
    <x-breadcrumbs title="Data Perhitungan">
        <li>Tambah Data Perhitungan</li>
    </x-breadcrumbs>
    <x-card>
        <form action="{{ route('perhitungan.store') }}" method="post" class="p-4">
            @csrf
            <div class="columns-1">
                <div class="mb-5">
                    <label class="font-semibold form-control text-[#344e41]">Alternatif</label>
                    <select name="atribut_id" id="atribut_id"
                        class="@error('atribut_id') is-invalid @enderror w-full border border-gray-300  rounded-md m-0 py-2 px-3">
                        @foreach ($alternatives as $alternative)
                            <option value="{{ $alternative->id }}">{{ ucwords($alternative->alternatif) }}</option>
                        @endforeach
                    </select>
                    @error('atribut_id')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <x-input type="text" label="Tahun" name="tahun" readonly value="{{ date('Y') }}" />
                @foreach ($criterias as $key => $criteria)
                    <x-input label="{{ ucwords($criteria->keterangan) }}" name="criteria_{{ $key + 1 }}"
                        type="number" />
                @endforeach
            </div>

            <x-button route="{{ route('perhitungan.index') }}" />
        </form>
    </x-card>
@endsection

@section('script')
    <script>
        $('#datepicker').yearpicker();
    </script>
@endsection
