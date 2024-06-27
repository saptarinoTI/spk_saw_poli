@props(['route' => ''])
<div class="flex gap-2">
    <button type="submit"
        class="px-4 py-2 font-medium text-white rounded-lg bg-[#344e41] hover:bg-[#3a5a40] transition duration-300">Simpan</button>
    <a href="{{ $route }}"
        class="px-4 py-2 font-medium text-344e41 rounded-lg border border-[#344e41] hover:text-white hover:bg-[#3a5a40] transition duration-300">Kembali</a>
</div>
