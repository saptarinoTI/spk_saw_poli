@props([
    'type' => 'text',
    'name',
    'label',
    'required' => true,
])

@if ($type == 'text' || $type == 'number' || $type == 'date')
    <div class="mb-5">
        <label class="font-semibold form-control text-[#344e41]">{{ $label }}</label>
        <input {{ $attributes }} type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            placeholder="Masukkan {{ $label }}"
            class="@error('$name') is-invalid @enderror w-full border border-gray-300  rounded-md m-0 py-2 px-3"{{ $required ? ' required' : ' ' }} />
        @error($name)
            <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror
    </div>
@endif

@if ($type == 'datepicker')
    <div class="mb-5">
        <label class="font-semibold form-control text-[#344e41]">{{ $label }}</label>
        <input {{ $attributes }} type="text" name="{{ $name }}" id="datepicker"
            placeholder="Masukkan {{ $label }}"
            class="@error('$name') is-invalid @enderror w-full border border-gray-300  rounded-md m-0 py-2 px-3 yearpicker"{{ $required ? ' required' : ' ' }} />
        @error($name)
            <div class="text-sm text-red-400">{{ $message }}</div>
        @enderror
    </div>
@endif
