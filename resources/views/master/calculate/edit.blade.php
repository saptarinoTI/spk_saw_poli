@extends('layouts.app')

@section('content')
    <x-breadcrumbs title="Data Perhitungan">
        <li>Ubah Data Perhitungan</li>
    </x-breadcrumbs>
    <x-card>
        <form action="{{ route('perhitungan.update', $data->id) }}" method="post" class="p-4">
            @csrf
            @method('put')
            <div class="columns-1">
                <x-input value="{{ ucwords($data->calculations[0]->alternative->alternatif) }}" label="Alternatif"
                    name="atribut_id" readonly />
                <x-input value="{{ $data->calculations[0]->tahun }}" label="Tahun" name="tahun" readonly />
                @foreach ($criterias as $key => $cri)
                    <td>
                        @php
                            $a = array_search($cri->id, array_column($data->calculations->toArray(), 'criteria_id'));
                        @endphp
                        @if ($a == '')
                            <x-input label="{{ ucwords($cri->keterangan) }}" name="criteria_{{ $key + 1 }}"
                                type="number" />
                        @else
                            <x-input label="{{ ucwords($cri->keterangan) }}" name="criteria_{{ $key + 1 }}"
                                type="number" value="{{ $data->calculations[$a]->value }}" />
                        @endif
                    </td>
                @endforeach
                {{-- <x-input label="{{ ucwords($cri->keterangan) }}" name="criteria_{{ $cri->id }}"
                        type="number" /> --}}
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
