<!-- resources/views/reports/mission_order_report.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="bg-white max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="px-3 mb-20 md:mb-20 flex justify-center items-center">
                <x-application-logo class="w-2/5"></x-application-logo>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-1/3 px-3 mb-6 md:mb-0">
                    <p>Beyrouth, {{ $missionOrder->order_date->format('d/m/Y') }}</p>
                </div>
                <div class="w-2/3 px-3 mt-6 mb-6 md:mb-0">
                    <h3 class="text-lg font-semibold">ORDRE DE MISSION {{ $missionOrder->order_number }}</h3>
                </div>
            </div>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-blue-200">
                        <th colspan="2" class="px-4">Missionary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-1/3 px-4">Nom, Prénom :</td>
                        <td class="w-2/3 px-4">{{ $missionOrder->employee->full_name }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/3 px-4">Fonction :</td>
                        <td class="w-2/3 px-4">{{ $missionOrder->employee->position }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/3 px-4">Résidence administrative :</td>
                        <td class="w-2/3 px-4">{{ $missionOrder->employee->administrativ_residence }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/3 px-4">Service :</td>
                        <td class="w-2/3 px-4">{{ $missionOrder->employee->service }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-blue-200">
                        <th colspan="2" class="px-4">Mission</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-1/3 px-4">Objet :</td>
                        <td class="w-2/3 px-4">{{ $missionOrder->purpose }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/3 px-4">Lieu de départ :</td>
                        <td class="w-2/3 px-4">{{ $missionOrder->departure_location }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/3 px-4">Lieu d'arrivée :</td>
                        <td class="w-2/3 px-4">{{ $missionOrder->arrive_location }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/3 px-4">Débute le :</td>
                        <td class="w-2/3 px-4">{{ $missionOrder->start_date->format('d/m/Y') }} heure
                            {{ $missionOrder->start_time }}</td>
                    </tr>
                    <tr>
                        <td class="w-1/3 px-4">S'achève le :</td>
                        <td class="w-2/3 px-4">{{ $missionOrder->end_date->format('d/m/Y') }} heure
                            {{ $missionOrder->end_time }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-blue-200">
                        <th colspan="2" class="px-4">Frais de mission</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="w-2/3 px-4">Prise en charge des frais de transport :</td>
                        <td class="w-1/3 px-4">{{ $missionOrder->charge == 1 ? 'OUI' : 'NON' }}</td>
                    </tr>
                    <tr>
                        <td class="w-2/3 px-4">Prise en charge des indemnités journalières de mission :</td>
                        <td class="w-1/3 px-4">{{ $missionOrder->ijm == 1 ? 'OUI' : 'NON' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="w-full px-4">Imputation budgétaire : 625-11 et 625-61</td>
                    </tr>
                </tbody>
            </table>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-blue-200">
                        <th colspan="2" class="px-4">Observations</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" class="w-full px-4">{{ $missionOrder->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            <table class="table-auto w-full text-left">
                <thead>
                    <tr class="bg-blue-200">
                        <th colspan="2" class="px-4">Signature de l'autorité compétente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" class="w-full px-4 pt-2 pb-40 text-right">
                        </td>
                    </tr>
                </tbody>
            </table>
        <!-- Add a print button -->
        <div class="mt-6 no-print">
            <button onclick="window.print()" class="bg-blue-500 py-2 hover:bg-blue-700 text-white font-bold px-4 rounded">
                Print Report
            </button>
        </div>
    </div>
@endsection
