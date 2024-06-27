<nav class="relative max-w-[85rem] w-full mx-auto px-8 lg:flex lg:items-center lg:justify-between md:px-6 lg:px-8 container py-3"
    aria-label="Global">
    <div class="flex items-center justify-between">
        <a class="flex-none text-lg font-bold" href="#" aria-label="Brand">
            <h1 class="text-emerald-900 logo-text"><span class="text-2xl">SPK</span>PelayananPoli</h1>
        </a>
        <div class="lg:hidden">
            <button type="button"
                class="flex items-center justify-center text-sm font-semibold text-gray-800 border border-gray-200 rounded-lg hs-collapse-toggle size-9 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                data-hs-collapse="#navbar-collapse-with-animation" aria-controls="navbar-collapse-with-animation"
                aria-label="Toggle navigation">
                <svg class="hs-collapse-open:hidden size-4" width="16" height="16" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
                <svg class="flex-shrink-0 hidden hs-collapse-open:block size-4" width="16" height="16"
                    fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </button>
        </div>
    </div>
    <div id="navbar-collapse-with-animation"
        class="hidden overflow-hidden transition-all duration-300 hs-collapse basis-full grow lg:block">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-end lg:ps-7">
            <a class="py-3 font-bold text-emerald-800 ps-px lg:px-3 hover:text-gray-900" href="#">Beranda</a>
            <div
                class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] sm:[--trigger:hover] py-3 ps-px lg:px-3">
                <button type="button" class="flex items-center w-full font-semibold text-gray-800 hover:text-gray-900">
                    Data Master
                    <i class='bx bx-chevron-down'></i>
                </button>

                <div
                    class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 sm:w-48 hidden z-10 bg-white sm:shadow-md rounded-lg p-2 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5">
                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500"
                        href="#">
                        Data Alternatif
                    </a>
                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500"
                        href="#">
                        Data Kriteria
                    </a>
                </div>
            </div>
            <a class="py-3 font-bold text-gray-800 ps-px lg:px-3 hover:text-gray-900" href="#">Data
                Perhitungan</a>
            <a class="py-3 font-bold text-gray-800 ps-px lg:px-3 hover:text-gray-900" href="#">Data
                Hasil</a>

            <div
                class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] sm:[--trigger:hover] py-3 ps-px sm:px-3 flex items-center gap-3">
                <i class='rotate-90 bx bx-minus bx-sm'></i>
                <button type="button"
                    class="flex items-center w-full gap-1 font-semibold text-gray-800 hover:text-gray-900">
                    <i class='bx bxs-user-circle bx-xs'></i>
                    Superadmin
                </button>

                <div
                    class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 sm:w-48 hidden z-10 bg-white sm:shadow-md rounded-lg p-2 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5">
                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500"
                        href="#">
                        Ganti Password
                    </a>
                    <form action="">
                        <div
                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500">
                            <button class="font-bold text-left text-red-700 btn-block">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
