@extends('layouts.app')

@section('content')
    <x-breadcrumbs title="Hasil Perhitungan" />
    <x-card>
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
                        <th>
                            @foreach ($criteria->calculations as $item)
                                @php
                                    array_push($array_minmax, $item->value);
                                @endphp
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
                            @foreach ($criterias as $key => $cri)
                                <td>
                                    @if ($a == '')
                                        0
                                    @else
                                        @if ($cri->atribut == 'cost')
                                            {{ min($array_minmax) / $data->calculations[$a]->value }}
                                        @elseif ($cri->atribut == 'benefit')
                                            {{ $data->calculations[$a]->value / max($array_minmax) }}
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

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
                            @foreach ($criterias as $key => $cri)
                                @if ($a != '')
                                    @if ($cri->atribut == 'cost')
                                        @php
                                            $total +=
                                                (min($array_minmax) / $data->calculations[$a]->value) * $cri->bobot;
                                        @endphp
                                    @elseif ($cri->atribut == 'benefit')
                                        @php
                                            $total +=
                                                ($data->calculations[$a]->value / max($array_minmax)) * $cri->bobot;
                                        @endphp
                                    @endif
                                @endif
                            @endforeach
                            @php
                                $rank[$data->alternatif] = $total;
                            @endphp
                            <td>{{ $total }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <div class="mt-10">
            <h2 class="mb-2 text-lg font-extrabold">Perangkingan</h2>
            <hr />
        </div>
        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @php
                    arsort($rank);
                @endphp
                @foreach ($rank as $r => $rnk)
                    <tr>
                        <td>{{ ucwords($r) }}</td>
                        <td>{{ $rnk }}</td>
                    </tr>
                @endforeach
                {{-- @foreach ($datas as $x => $data) --}}
                {{-- @php
                        for ($x = 0; $x < count($rank); $x++) {
                            arsort($rank);
                            print_r($rank);
                            echo '<br>';
                        }
                    @endphp --}}
                {{-- @endforeach --}}
            </tbody>
        </table>
    </x-card>
@endsection

@section('script')
@endsection
