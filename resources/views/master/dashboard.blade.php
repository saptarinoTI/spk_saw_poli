@extends('layouts.app')

@section('content')
    <section class="max-w-[66rem] w-full py-3 md:py-0 lg:mx-auto container mt-6 px-4">
        <h1 class="text-3xl font-extrabold text-[#344e41]">Dashboard</h1>
        <div class="p-0 m-0 mt-1 text-sm text-gray-500 breadcrumbs">
            <ul>
                <li>Dashboard</li>
            </ul>
        </div>
    </section>

    <section class="max-w-[66rem] w-full py-3 md:py-0 lg:mx-auto container mt-6 px-4 grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="flex flex-col animate__animated animate__lightSpeedInLeft transition bg-green-100 rounded-[28px] shadow">
            <div class="p-4 md:p-5">
                <h2 class="text-lg font-bold text-green-900">Data Alternatif</h2>
                <p class="text-4xl font-extrabold text-gray-900">{{ $datas->count() }}</p>
                <small class="text-sm font-semibold text-gray-500">Alternatif</small>
            </div>
        </div>

        <div class="flex flex-col animate__animated animate__lightSpeedInRight transition bg-red-100 rounded-[28px] shadow">
            <div class="p-4 md:p-5">
                <h2 class="text-lg font-bold text-red-900">Data Kriteria</h2>
                <p class="text-4xl font-extrabold text-gray-900">{{ $cCriterias->count() }}</p>
                <small class="text-sm font-semibold text-gray-500">Kriteria</small>
            </div>
        </div>

    </section>

    <x-card>
        {{-- Data Awal --}}
        @foreach ($datas as $data)
            @php
                $total = 0;
            @endphp
            @if ($data->calculations->count() > 0)
                @foreach ($criterias as $key => $criteria)
                    @php
                        $a = array_search($criteria->id, array_column($data->calculations->toArray(), 'criteria_id'));
                        $array_minmax = [];
                    @endphp
                    @foreach ($criteria->calculations as $item)
                        @if ($item->criteria_id == $criteria->id)
                            @php
                                array_push($array_minmax, $item->value);
                            @endphp
                        @endif
                    @endforeach
                    @if ($a != '')
                        @if ($criteria->atribut == 'cost' && $data->calculations[$key]->criteria_id)
                            @php
                                $total += (min($array_minmax) / $data->calculations[$key]->value) * $criteria->bobot;
                            @endphp
                        @elseif ($criteria->atribut == 'benefit' && $data->calculations[$key]->criteria_id)
                            @php
                                $total += ($data->calculations[$key]->value / max($array_minmax)) * $criteria->bobot;
                            @endphp
                        @endif
                    @endif
                @endforeach
                @php
                    $rank[$data->alternatif] = $total;
                @endphp
            @endif
        @endforeach
        {{-- Akhir Data Awal --}}

        <div>
            <h2 class="mb-2 text-lg font-extrabold">Perangkingan Data Alternatif Thn.{{ $tahun }}</h2>
            <hr />
        </div>
        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Rangking</th>
                    <th>Alternatif</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    arsort($rank);
                    $no = 1;
                @endphp
                @foreach ($rank as $r => $rnk)
                    <tr>
                        <th>{{ $no }}</th>
                        <td>{{ ucwords($r) }}</td>
                        <td>{{ round($rnk, 5) }}</td>
                    </tr>
                    @php
                        $no++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </x-card>
@endsection

@section('script')
@endsection
