@extends('layouts.app')

@section('content')
    <x-breadcrumbs title="Data Alternatif">
        <li>Tambah Data Alternatif</li>
    </x-breadcrumbs>
    <x-card>
        <form action="{{ route('alternatives.store') }}" method="post" class="p-4">
            @csrf
            <div class="columns-1 lg:columns-2">
                <x-input label="Kode" name="kode" />
                <x-input label="Alternatif" name="alternatif" />
            </div>
            <x-button route="{{ route('alternatives.index') }}" />
        </form>
    </x-card>
@endsection

@section('script')
@endsection
