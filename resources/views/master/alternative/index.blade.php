@extends('layouts.app')

@section('content')
    <x-breadcrumbs title="Data Alternatif" />
    <x-card>
        <div class="flex justify-end">
            <a href="{{ route('alternatives.create') }}"
                class="mb-3 text-sm rounded-[28px] font-medium py-2 px-4 text-white bg-[#344e41] hover:bg-[#3a5a40] transition duration-300">Tambah
                Data</a>
        </div>
        <table id="data-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Alternatif</th>
                    <th class="w-1/5">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ ucwords($data->kode) }}</td>
                        <td>{{ ucwords($data->alternatif) }}</td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('alternatives.edit', $data->id) }}"
                                    class="px-2 py-1 bg-yellow-300 rounded-lg hover:bg-yellow-500"><i
                                        class='mt-1 text-gray-700 bx bxs-edit-alt'></i></a>
                                <form method="POST" action="{{ route('alternatives.destroy', $data->id) }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit"
                                        class="px-2 py-1 text-gray-700 bg-red-300 rounded-lg hover:bg-red-500 show_confirm"
                                        data-toggle="tooltip" title='Delete'><i class='mt-1 bx bxs-trash-alt'></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            var table = $('#data-table').DataTable({
                aLengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
            });
        });

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
