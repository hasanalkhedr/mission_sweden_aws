@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold">Departments</h1>
    <a href="{{ route('departments.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-6 inline-block">Add Department</a>
    <table class="w-full bg-white shadow-md rounded mb-6">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left">Department Name</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $department)
            <tr>
                <td class="px-6 py-4"><a class="underline text-blue-500" href="{{route('departments.show',$department->id)}}">{{ $department->name }}</a></td>
                <td class="px-6 py-4">
                    <a href="{{ route('departments.edit', $department->id) }}" class="text-blue-500"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="2">
                        <div class="w-full block text-center items-center text-blue-400 bold py-1 px-1">
                            <h2>There is no Department to display</h2>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
