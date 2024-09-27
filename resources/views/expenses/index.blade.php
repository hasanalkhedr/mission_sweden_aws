@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Expenses</h2>

<a href="{{ route('expenses.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded mb-6 inline-block">Create New Expense</a>

<table class="min-w-full bg-white shadow-md rounded mb-6">
    <thead>
        <tr>
            <th class="px-6 py-3 text-left">Mission Order</th>
            <th class="px-6 py-3 text-left">Amount</th>
            <th class="px-6 py-3 text-left">Currency</th>
            <th class="px-6 py-3 text-left">Description</th>
            <th class="px-6 py-3 text-left">Document</th>
            <th class="px-6 py-3 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
        <tr class="border-b">
            <td class="px-6 py-4">{{ $expense->missionOrder->order_number }}</td>
            <td class="px-6 py-4">{{ $expense->amount }}</td>
            <td class="px-6 py-4">{{ $expense->currency }}</td>
            <td class="px-6 py-4">{{ $expense->description }}</td>
            <td class="px-6 py-4">
                <a href="{{ asset('storage/'.$expense->document) }}" class="text-blue-500 hover:underline" target="_blank">View Document</a>
            </td>
            <td class="px-6 py-4">
                <a href="{{ route('expenses.edit', $expense->id) }}" class="text-blue-500 hover:underline">Edit</a>
                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline-block">
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
