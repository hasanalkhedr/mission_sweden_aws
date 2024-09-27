@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold">Employees</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
    <table class="min-w-full border border-gray-300 mt-4">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Full Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Role</th>
                <th class="border border-gray-300 px-4 py-2">Position</th>
                <th class="border border-gray-300 px-4 py-2">Résidence administrative
                </th>
                <th class="border border-gray-300 px-4 py-2">Service</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->full_name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->email }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->role }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->position }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->administrativ_residence }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $employee->service }}</td>

                <td class="border border-gray-300 px-4 py-2">
                    <a href="{{ route('employees.edit', $employee->id) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
