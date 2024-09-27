@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Mission Orders</h2>

    <a href="{{ route('mission_orders.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-6 inline-block">Ordre de
        Mission</a>

    <table class="w-full bg-white shadow-md rounded mb-6">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left">Order Number</th>
                <th class="px-6 py-3 text-left">Employee</th>
                <th class="px-6 py-3 text-left">Purpose</th>
                <th class="px-6 py-3 text-left">Location</th>
                <th class="px-6 py-3 text-left">Start Date</th>
                <th class="px-6 py-3 text-left">End Date</th>
                <th class="px-6 py-3 text-left">status</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($missionOrders as $missionOrder)
                <tr class="border-b">
                    <td class="px-6 py-4"><a class="underline text-blue-500" href="{{route('mission_orders.show',$missionOrder->id)}}">{{ $missionOrder->order_number }}</a></td>
                    <td class="px-6 py-4">{{ $missionOrder->employee->full_name }}</td>
                    <td class="px-6 py-4">{{ $missionOrder->purpose }}</td>
                    <td class="px-6 py-4">{{ $missionOrder->location }}</td>
                    <td class="px-6 py-4">{{ $missionOrder->start_date }}</td>
                    <td class="px-6 py-4">{{ $missionOrder->end_date }}</td>
                    <td class="px-6 py-4">{{ $missionOrder->status }}</td>
                    <td class="px-6 py-4">
                        <!-- Employee Actions -->
                        @if ($missionOrder->employee_id == auth()->user()->employee->id && $missionOrder->status == 'draft')
                            <a href="{{ route('mission_orders.edit', $missionOrder->id) }}"
                                class="text-blue-500 hover:underline"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('mission_orders.destroy', $missionOrder->id) }}" method="POST"
                                class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-4"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <!-- Supervisor Actions -->
                        @elseif (auth()->user()->employee->role == 'supervisor' &&
                                $missionOrder->status == 'draft' &&
                                $missionOrder->employee_id != auth()->user()->employee->id &&
                                $missionOrder->employee->department_id == auth()->user()->employee->department_id)
                            <a href="{{ route('supervisor_approve', $missionOrder) }}"
                                class="text-blue-500 hover:underline"><i class="fas fa-eye"></i></a>
                            <!-- Hr Actions -->
                        @elseif (auth()->user()->employee->role == 'hr' && $missionOrder->status == 'sup_approve')
                            <a href="{{ route('hr_approve', $missionOrder) }}"
                                class="text-blue-500 hover:underline"><i class="fas fa-eye"></i></a>
                            <!-- SG Actions -->
                        @elseif (auth()->user()->employee->role == 'sg' && $missionOrder->status == 'hr_approve')
                            <a href="{{ route('sg_approve', $missionOrder) }}"
                                class="text-blue-500 hover:underline"><i class="fas fa-eye"></i></a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="w-full block text-center items-center text-blue-400 bold py-1 px-1">
                            <h2>There is no Missions to display</h2>
                        </div>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
