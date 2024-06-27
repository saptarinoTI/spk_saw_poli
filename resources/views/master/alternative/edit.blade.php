@extends('layouts.app')

@section('content')
    <x-breadcrumbs title="Data Alternatif">
        <li>Edit Data Alternatif</li>
    </x-breadcrumbs>
    <x-card>
        <form action="{{ route('alternatives.update', $data->id) }}" method="post" class="p-4">
            @csrf
            @method('PUT')
            <div class="columns-1 lg:columns-2">
                <x-input label="Kode" name="kode" readonly value="{{ $data->kode }}" />
                <x-input label="Alternatif" name="alternatif" value="{{ $data->alternatif }}" />
            </div>
            <x-button route="{{ route('alternatives.index') }}" />
        </form>
    </x-card>
@endsection

@section('script')
@endsection
