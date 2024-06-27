@extends('layouts.app')

@section('content')
    <x-breadcrumbs title="Hasil Perhitungan" />
    <x-card>

        {{-- Data Awal --}}
        <div>
            <h2 class="mb-2 text-lg font-extrabold">Data Awal</h2>
            <hr />
        </div>
        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach ($criterias as $criteria)
                        <th>{{ ucwords($criteria->keterangan) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    @if ($data->calculations->count() > 0)
                        <tr>
                            <td>{{ ucwords($data->alternatif) }}</td>
                            @foreach ($criterias as $key => $cri)
                                <td>
                                    @php
                                        $a = array_search(
                                            $cri->id,
                                            array_column($data->calculations->toArray(), 'criteria_id'),
                                        );
                                    @endphp
                                    @if ($a == '')
                                        0
                                    @else
                                        {{ $data->calculations[$a]->value }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endif
                @endforeach
            <tfoot>
                <tr>
                    <th>Min/Max</th>
                    @foreach ($criterias as $criteria)
                        @php
                            $array_minmax = [];
                        @endphp
                        <th>
                            @foreach ($criteria->calculations as $item)
                                @if ($item->criteria_id == $criteria->id)
                                    @php
                                        array_push($array_minmax, $item->value);
                                    @endphp
                                @endif
                            @endforeach
                            @if ($criteria->atribut == 'cost')
                                Cost(min): {{ min($array_minmax) }}
                            @elseif ($criteria->atribut == 'benefit')
                                Benefit(max): {{ max($array_minmax) }}
                            @endif
                        </th>
                    @endforeach
                </tr>
            </tfoot>
            </tbody>
        </table>
        {{-- Akhir Data Awal --}}

        {{-- Normalisasi --}}
        <div class="mt-10">
            <h2 class="mb-2 text-lg font-extrabold">Normalisasi</h2>
            <hr />
        </div>
        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach ($criterias as $criteria)
                        <th>{{ ucwords($criteria->keterangan) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    @if ($data->calculations->count() > 0)
                        <tr>
                            <td>{{ ucwords($data->alternatif) }}</td>
                            @foreach ($criterias as $key => $criteria)
                                @php
                                    $array_minmax = [];
                                @endphp
                                <td>
                                    @foreach ($criteria->calculations as $item)
                                        @if ($item->criteria_id == $criteria->id)
                                            @php
                                                array_push($array_minmax, $item->value);
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($a != '')
                                        @if ($criteria->atribut == 'cost' && $data->calculations[$key]->criteria_id)
                                            {{ round(min($array_minmax) / $data->calculations[$key]->value, 5) }}
                                        @elseif ($criteria->atribut == 'benefit' && $data->calculations[$key]->criteria_id)
                                            {{ round($data->calculations[$key]->value / max($array_minmax), 5) }}
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        {{-- Akhir Normalisasi --}}

        {{-- Hasil Perhitungan --}}
        <div class="mt-10">
            <h2 class="mb-2 text-lg font-extrabold">Hasil Perhitungan</h2>
            <hr />
        </div>
        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $x => $data)
                    @php
                        $total = 0;
                    @endphp
                    @if ($data->calculations->count() > 0)
                        <tr>
                            <td>{{ ucwords($data->alternatif) }}</td>
                            @foreach ($criterias as $key => $criteria)
                                @php
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
                                            $total +=
                                                (min($array_minmax) / $data->calculations[$key]->value) *
                                                $criteria->bobot;
                                        @endphp
                                    @elseif ($criteria->atribut == 'benefit' && $data->calculations[$key]->criteria_id)
                                        @php
                                            $total +=
                                                ($data->calculations[$key]->value / max($array_minmax)) *
                                                $criteria->bobot;
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                            @php
                                $rank[$data->alternatif] = $total;
                            @endphp
                            <td>{{ round($total, 5) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        {{-- Akhir Hasil Perhitungan --}}

        {{-- Perangkingan --}}
        <div class="mt-10">
            <h2 class="mb-2 text-lg font-extrabold">Perangkingan</h2>
            <hr />
        </div>
        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Total</th>
                    <th>Rangking</th>
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
        {{-- Akhir Perangkingan --}}

    </x-card>
@endsection

@section('script')
@endsection
