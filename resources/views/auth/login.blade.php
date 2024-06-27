<!doctype html>
<html data-theme="emerald">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SPK Pelayanan Poli') }}</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('build/assets/app-DLdDE5XI.css') }}">

    <style>
        /* All animations will take twice as long to finish */
        .image {
            --animate-duration: 3.5s;
        }
    </style>
</head>

<body>

    <section class="min-h-screen bg-[#588157] flex justify-center items-center flex-col md:flex-row pt-10 md:p-0">
        {{-- Image --}}
        <div class="flex flex-col items-center justify-center h-full md:w-1/2 xl:w-3/4">
            <img src="{{ asset('images/data-analysis-1-74.png') }}" alt=""
                class="w-2/3 animate__animated animate__pulse animate__infinite image" />
            <p class="text-sm font-bold text-[#dad7cd] md:mb-0 mb-10 animate__animated animate__fadeInUp">
                {{ date('Y') }}
                <i class='bx bx-copyright'></i>
                SPKPelayanPoli
            </p>
        </div>
        {{-- Form Login --}}
        <div
            class="flex flex-col items-center w-full h-auto bg-[#e9f5db] md:justify-center md:h-screen md:w-1/2 py-9 md:p-0">

            <div class="mb-5 text-center animate__animated animate__fadeInDown">
                <h2 class="text-2xl font-extrabold">Welcome to <span class="mb-1 text-lg logo-text text-[#344e41]"><span
                            class="text-xl">SPK</span>PelayananPoli</span>
                </h2>
                <p class="text-xs font-semibold text-[#a3b18a]">Enter your credentials to access your account.</p>
            </div>

            <form class="w-full mt-8 md:w-11/12 lg:w-4/5 px-14 text-slate-600" method="post"
                action="{{ route('login.process') }}">
                @csrf
                <div class="animate__animated animate__zoomIn">
                    <div class="mb-5">
                        <label class="mb-1 text-sm font-semibold form-control text-[#344e41]">Username</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan Username"
                            class="@error('username') is-invalid @enderror w-full input input-bordered" required />
                        @error('username')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label class="mb-1 text-sm font-semibold form-control text-[#344e41]">Password</label>
                        <input type="password" name="password" id="password" placeholder="*************"
                            class="w-full input input-bordered" required />
                    </div>
                </div>
                <button type="submit"
                    class="mt-3 text-sm w-full rounded-[28px] font-medium py-2 text-white bg-[#344e41] hover:bg-[#3a5a40] transition duration-300 animate__animated animate__fadeInUp">Sign
                    in</button>
            </form>
        </div>
    </section>


    <script src="{{ asset('build/assets/app-6JcJmGPt.js') }}"></script>
</body>

</html>
