@extends('layouts.app')

@section('content')
    <x-breadcrumbs title="Data Perhitungan" />
    <x-card>
        <div class="flex justify-end">
            <a href="{{ route('perhitungan.create') }}"
                class="mb-3 text-sm rounded-[28px] font-medium py-2 px-4 text-white bg-[#344e41] hover:bg-[#3a5a40] transition duration-300">Tambah
                Data</a>
        </div>
        <table id="data-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach ($criterias as $criteria)
                        <th>{{ ucwords($criteria->keterangan) }}</th>
                    @endforeach
                    <th class="w-1/5">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($datas as $data)
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
                                        -
                                    @else
                                        {{ $data->calculations[$a]->value }}
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                <div class="flex gap-1">
                                    <a href="{{ route('perhitungan.edit', $data->id) }}"
                                        class="px-2 py-1 bg-yellow-300 rounded-lg hover:bg-yellow-500"><i
                                            class='mt-1 text-gray-700 bx bxs-edit-alt'></i></a>
                                    <form method="POST" action="{{ route('perhitungan.destroy', $data->id) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit"
                                            class="px-2 py-1 text-gray-700 bg-red-300 rounded-lg hover:bg-red-500 show_confirm"
                                            data-toggle="tooltip" title='Delete'><i
                                                class='mt-1 bx bxs-trash-alt'></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="{{ 2 + count($criterias) }}" class="text-sm font-semibold text-center">Data tidak
                            tersedia.</td>
                    </tr>
                @endforelse
                {{-- <tr>
                    <td>Min/Max</td>
                    @foreach ($criterias as $criteria)
                        <td>
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
                        </td>
                    @endforeach
                </tr> --}}
            </tbody>
        </table>
    </x-card>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', '.show_confirm', function(e) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
