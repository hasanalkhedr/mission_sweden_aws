@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Mission Approvals</h2>

<a href="{{ route('mission_approves.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-6 inline-block">Create New Approval</a>

<table class="min-w-full bg-white shadow-md rounded mb-6">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left">Mission Order</th>
            <th class="px-6 py-3 text-left">Approval Role</th>
            <th class="px-6 py-3 text-left">Status</th>
            <th class="px-6 py-3 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($approvals as $approval)
        <tr class="border-b">
            <td class="px-6 py-4">{{ $approval->missionOrder->order_number }}</td>
            <td class="px-6 py-4">{{ $approval->approval_role }}</td>
            <td class="px-6 py-4">{{ $approval->status }}</td>
            <td class="px-6 py-4">
                <a href="{{ route('mission_approves.edit', $approval->id) }}" class="text-blue-500 hover:underline">Edit</a>
                <form action="{{ route('mission_approves.destroy', $approval->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline ml-4">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
