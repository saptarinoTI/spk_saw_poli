<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="emerald">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SPK Pelayanan Poli') }}</title>


    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/js/yearPicker/dist/yearpicker.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <link rel="stylesheet" href="{{ asset('build/assets/app-DLdDE5XI.css') }}">

    <style>
        table.dataTable {
            border-collapse: collapse !important;
        }

        .dataTables_length select,
        .dataTables_filter input {
            border: solid 1px #a8a8a8;
            border-radius: 8px;
            padding: 3px 5px;
        }

        table.dataTable thead th,
        table.dataTable thead td {
            padding: 10px 18px !important;
            border-bottom: 1px solid #a8a8a8 !important;
        }

        table.dataTable tbody th,
        table.dataTable tbody td {
            padding: 10px 18px !important;
            border-bottom: 1px solid #a8a8a8 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.3em 0.7em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            color: #333 !important;
            border: 1px solid transparent;
            border-radius: 10px;
            background: transparent !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: rgb(52, 78, 65) !important;
            color: #ffffff !important;
            border: transparent;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background-color: rgb(74, 105, 90) !important;
            color: #ffffff !important;
            border: transparent;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.next.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous.disabled:hover {
            background-color: transparent !important;
            color: #000 !important;
        }

        input:read-only {
            background-color: #d9d9d9 !important;
        }
    </style>
</head>

<body class="min-h-screen bg-[#e9f5db]">

    <!-- ========== HEADER ========== -->
    <header class="sticky inset-x-0 z-50 flex flex-wrap w-full top-4 md:justify-start md:flex-nowrap">
        <nav class="relative max-w-[66rem] w-full bg-[#588157] rounded-[28px] py-3 ps-5 pe-2 md:flex md:items-center md:justify-between md:py-0 mx-2 lg:mx-auto animate__animated animate__slideInDown"
            aria-label="Global">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a class="flex-none inline-block" href="">
                    <h1 class="font-light text-[#e9f5db] logo-text"><span class="text-xl">SPK</span>PelayananPoll</h1>
                </a>
                <!-- End Logo -->

                <div class="md:hidden">
                    <button type="button"
                        class="flex items-center justify-center text-sm font-semibold text-white rounded-full hs-collapse-toggle size-8 bg-neutral-800 disabled:opacity-50 disabled:pointer-events-none"
                        data-hs-collapse="#navbar-collapse" aria-controls="navbar-collapse"
                        aria-label="Toggle navigation">
                        <i class='flex-shrink-0 bx bx-menu-alt-right hs-collapse-open:hidden bx-sm'></i>
                        <i class='flex-shrink-0 hidden bx bx-x bx-sm hs-collapse-open:block'></i>
                    </button>
                </div>
            </div>

            <!-- Collapse -->
            <div id="navbar-collapse"
                class="hidden overflow-hidden transition-all duration-300 hs-collapse basis-full grow md:block">
                <div class="flex flex-col py-2 md:flex-row md:items-center md:justify-end md:py-0 md:ps-7">
                    <a class="py-3 text-sm text-white ps-px sm:px-3 md:py-4 hover:text-neutral-300"
                        href="{{ route('dashboard') }}">Dashboard</a>

                    <div
                        class="hs-dropdown [--strategy:static] md:[--strategy:fixed] [--adaptive:none] py-3 ps-px sm:px-3 md:py-4">
                        <button type="button"
                            class="flex items-center w-full text-sm text-white hover:text-neutral-300">
                            Data Master
                            <i class='bx bxs-chevron-down bx-xs ms-1'></i>
                        </button>

                        <div
                            class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-48 hidden z-10 bg-neutral-800 md:shadow-md rounded-lg p-2 before:absolute top-full before:-top-5 before:start-0 before:w-full before:h-5">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-white hover:text-neutral-300 font-medium"
                                href="{{ route('alternatives.index') }}">
                                Alternatif
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-white hover:text-neutral-300 font-medium"
                                href="{{ route('criterias.index') }}">
                                Kriteria
                            </a>
                        </div>
                    </div>

                    <a class="py-3 text-sm text-white ps-px sm:px-3 md:py-4 hover:text-neutral-300"
                        href="{{ route('perhitungan.index') }}">Perhitungan</a>
                    <a class="py-3 text-sm text-white ps-px sm:px-3 md:py-4 hover:text-neutral-300"
                        href="{{ route('hasil.index') }}">Hasil</a>

                    <div class="me-2 md:ms-6">
                        <form
                            class="inline-flex items-center w-full px-4 py-2 text-sm text-white bg-[#bc4749] rounded-full"
                            action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Collapse -->
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <main class="w-full py-2 text-sm lg:py-4">
        @yield('content')
    </main>

    <script src="{{ asset('build/assets/app-6JcJmGPt.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/yearPicker/dist/yearpicker.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('sukses'))
        <script>
            Swal.fire({
                title: "Sukses!",
                text: "{{ $message }}",
                icon: "success"
            });
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                title: "Gagal!",
                text: "{{ $message }}",
                icon: "error"
            });
        </script>
    @endif


    @yield('script')
</body>

</html>
