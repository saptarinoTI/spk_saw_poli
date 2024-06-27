<section class="max-w-[66rem] w-full py-3 md:py-0 lg:mx-auto container mt-6 px-4">
    <h1 class="text-2xl font-extrabold text-[#344e41]"> {{ $title }}</h1>
    <div class="p-0 m-0 mt-1 text-sm text-gray-500 breadcrumbs">
        <ul>
            <li>Home</li>
            <li>{{ $title }}</li>
            {{ $slot }}
            {{-- <li>Add Document</li> --}}
        </ul>
    </div>
</section>
