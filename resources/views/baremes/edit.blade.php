@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Create a Bareme</h2>
    <form action="{{ route('baremes.update', $bareme->id) }}" method="POST" class="w-full">
        @if ($errors->any())
            <div class="text-danger text-pink-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        @method('PUT')
        <x-form-divider>Bareme Data</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-label>
                    Pays *
                </x-label>
                <x-text-input name="pays" value="{{ old('pays', $bareme->pays) }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/2 px-3">
                <x-label>
                    MONNAIE
                </x-label>
                <x-text-input name="currency" value="{{ old('currency', $bareme->currency) }}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    MONTANT
                </x-label>
                <x-text-input name="pays_per_day" value="{{ old('pays_per_day', $bareme->pays_per_day) }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-primary-button>Soumettre</x-primary-button>
            </div>
        </div>
    </form>
@endsection
