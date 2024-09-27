@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold">Baremes</h1>
    <a href="{{ route('baremes.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-6 inline-block">Add Bareme</a>
    <table class="w-full bg-white shadow-md rounded mb-6">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left">Location</th>
                <th class="px-6 py-3 text-left">Currency</th>
                <th class="px-6 py-3 text-left">Pay per Day</th>
                <th class="px-6 py-3 text-left">One Meal Cost 17.5%</th>
                <th class="px-6 py-3 text-left">Accommodation Cost 65%</th>
                <th class="px-6 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($baremes as $bareme)
            <tr class="border-b">
                <td class="px-6 py-4"><a class="underline text-blue-500" href="{{route('baremes.show',$bareme->id)}}">{{ $bareme->pays }}</a></td>
                <td class="px-6 py-4">{{ $bareme->currency }}</td>
                <td class="px-6 py-4">{{ $bareme->pays_per_day }}</td>
                <td class="px-6 py-4">{{ $bareme->meal_cost }}</td>
                <td class="px-6 py-4">{{ $bareme->accomodation_cost }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('baremes.edit', $bareme->id) }}" class="text-blue-500"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('baremes.destroy', $bareme->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <div class="w-full block text-center items-center text-blue-400 bold py-1 px-1">
                            <h2>There is no Baremes to display</h2>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
