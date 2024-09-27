@extends('layouts.app')

@section('content')
    <form class="w-full">
        <x-form-divider>Bareme Data</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-label>
                    Pays *
                </x-label>
                <x-readonly-text-input name="pays" value="{{$bareme->pays}}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/2 px-3">
                <x-label>
                    MONNAIE
                </x-label>
                <x-readonly-text-input name="currency" value="{{$bareme->currency}}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    MONTANT
                </x-label>
                <x-readonly-text-input name="pays_per_day" value="{{$bareme->pays_per_day}}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-1/2 px-3">
                <x-label>
                    REPAS 17.5%
                </x-label>
                <x-readonly-text-input name="meal_cost" value="{{$bareme->meal_cost}}" />
            </div>
            <div class="w-1/2 px-3">
                <x-label>
                    HEBERGEMENT 65%
                </x-label>
                <x-readonly-text-input name="accomodation_cost" value="{{$bareme->accomodation_cost}}" />
            </div>
        </div>
    </form>
@endsection
