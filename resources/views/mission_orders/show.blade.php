<!-- resources/views/mission_orders/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">{{ $missionOrder->order_number }} - Mission Order Details</h2>

        <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
            <div>
                <p>{{ $missionOrder->order_date->format('d/m/Y') }}</p>
                <h1>ORDRE DE MISSION {{ $missionOrder->order_number }}</h1>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">Employee:</p>
                <p>{{ $missionOrder->employee->full_name }}</p>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">Purpose:</p>
                <p>{{ $missionOrder->purpose }}</p>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">Description:</p>
                <p>{{ $missionOrder->description }}</p>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">Departure Location:</p>
                <p>{{ $missionOrder->departure_location }}</p>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">Arrive Location:</p>
                <p>{{ $missionOrder->arrive_location }}</p>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">Start Date and Time:</p>
                <p>{{ $missionOrder->start_date->format('d/m/Y') }} at {{ $missionOrder->start_time }}</p>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">End Date and Time:</p>
                <p>{{ $missionOrder->end_date->format('d/m/Y') }} at {{ $missionOrder->end_time }}</p>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">Status:</p>
                <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-blue-500 rounded-full">
                    {{ ucfirst($missionOrder->status) }}
                </span>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">Total Amount:</p>
                <p>{{ $missionOrder->total_amount }} {{ $missionOrder->currency }}</p>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">No. of Meals:</p>
                <p>{{ $missionOrder->no_meals }}</p>
            </div>

            <div>
                <p class="text-gray-700 font-semibold">No. of Accommodations:</p>
                <p>{{ $missionOrder->no_accomodation }}</p>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('mission_orders.report',$missionOrder) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Print Mission Orders
            </a>
        </div>
        <div class="mt-6">
            <a href="{{ route('mission_orders.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to Mission Orders
            </a>
        </div>
    </div>
</div>
@endsection
