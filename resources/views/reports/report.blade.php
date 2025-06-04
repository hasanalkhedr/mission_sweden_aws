@extends('layouts.app')
@section('title', __('Rapports'))
@section('content')

    <div class="overflow-x-auto relative shadow-md">
        <div class="m-4">
            @if ($employee)
                <div class="text-lg">
                    <span class="font-bold blue-color">{{ __('Name') }}:</span> {{ $employee->first_name }}
                    {{ $employee->last_name }}
                </div>
                <div class="text-lg">
                    <span class="font-bold blue-color">{{ __('Department') }}:</span>
                    {{ ucfirst(strtolower($employee->department->name)) }}
                </div>
            @else
                <div class="text-lg">
                    <span class="font-bold blue-color">{{ __('Name') }}:</span> All Employees
                </div>
            @endif

            <div class="text-lg">
                <span class="font-bold blue-color">{{ __('Date début') }}:</span> {{ $from_date }}
            </div>
            <div class="text-lg">
                <span class="font-bold blue-color">{{ __('Date fin') }}:</span> {{ $to_date }}
            </div>
        </div>

        <h2 class="blue-color text-2xl text-center py-6">Missions Rapport</h2>
        <table class="w-full text-sm text-left text-gray-500">
            @unless (count($missions) <= 0)
                <thead class="text-s text-center text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Mission #') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Employée') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('From') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('To') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Pays') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Statut') }}</th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Memoire Statut') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Total') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($missions as $mission)
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ $mission->order_number }}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ $mission->employee->first_name }} {{ $mission->employee->last_name }}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ $mission->start_date }}
                                    {{-- {{ \Carbon\Carbon::createFromFormat('Y-m-d', $mission->start_date)->format('d/m/Y') }} --}}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ $mission->end_date }}
                                    {{-- {{ \Carbon\Carbon::createFromFormat('Y-m-d', $mission->end_date)->format('d/m/Y') }} --}}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ $mission->bareme->pays }}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ __($mission->status) }}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ __($mission->memor_status) }}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                @foreach ($mission->getMemoireTotals() as $currency => $currencyAmount)
                                    <div>
                                        {{ round($currencyAmount) }}
                                        {{ $currency }}
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td colspan="6" class="px-4 py-8 border-t border-gray-300 text-lg">
                            <p class="text-center">{{ __('No Missions Found') }}</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>

        <h2 class="blue-color text-2xl text-center py-6">Tournees Rapport</h2>
        <table class="w-full text-sm text-left text-gray-500">
            @unless (count($tournees) <= 0)
                <thead class="text-s text-center text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Tourne #') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Employée') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('From') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('To') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Pays') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Statut') }}</th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Memoire Statut') }}
                        </th>
                        <th scope="col" class="py-3 px-6 blue-color">
                            {{ __('Total') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($tournees as $tournee)
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ $tournee->order_number }}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ $tournee->employee->first_name }} {{ $tournee->employee->last_name }}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ $tournee->start_date }}
                                    {{-- {{ \Carbon\Carbon::createFromFormat('Y-m-d', $tournee->start_date)->format('d/m/Y') }} --}}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ $tournee->end_date }}
                                    {{-- {{ \Carbon\Carbon::createFromFormat('Y-m-d', $tournee->end_date)->format('d/m/Y') }} --}}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ $tournee->bareme->pays }}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ __($tournee->status) }}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                <div>
                                    {{ __($tournee->memor_status) }}
                                </div>
                            </td>
                            <td class="border-b py-4 px-6 text-gray-900 whitespace-nowrap">
                                @foreach ($tournee->getMemoireTotals() as $currency => $currencyAmount)
                                    <div>
                                        {{ round($currencyAmount) }}
                                        {{ $currency }}
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td colspan="6" class="px-4 py-8 border-t border-gray-300 text-lg">
                            <p class="text-center">{{ __('No Tournees Found') }}</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </div>
@endsection
