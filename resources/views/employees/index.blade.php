@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold">Employees</h2>
    <a href="{{ route('employees.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-6 inline-block">Add new Employee</a>
    <table class="w-full bg-white shadow-md rounded mb-6">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left">Full Name</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">Role</th>
                <th class="px-6 py-3 text-left">Position</th>
                <th class="px-6 py-3 text-left">Résidence administrative
                </th>
                <th class="px-6 py-3 text-left">Service</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $employee)
            <tr  class="border-b">
                <td class="px-6 py-4"><a class="underline text-blue-500" href="{{route('employees.show',$employee->id)}}">{{ $employee->full_name }}</a></td>
                <td class="px-6 py-4">{{ $employee->email }}</td>
                <td class="px-6 py-4">{{ $employee->role }}</td>
                <td class="px-6 py-4">{{ $employee->position }}</td>
                <td class="px-6 py-4">{{ $employee->administrativ_residence }}</td>
                <td class="px-6 py-4">{{ $employee->service }}</td>

                <td class="px-6 py-4">
                    <a href="{{ route('employees.edit', $employee->id) }}" class="text-blue-500"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="w-full block text-center items-center text-blue-400 bold py-1 px-1">
                            <h2>There is no Employees to display</h2>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
