@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-6">Edit Expense</h2>

<form action="{{ route('expenses.update', $expense->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-gray-700">Mission Order</label>
        <select name="mission_order_id" class="w-full border-gray-300 rounded" required>
            @foreach ($missionOrders as $order)
            <option value="{{ $order->id }}" {{ $order->id == $expense->mission_order_id ? 'selected' : '' }}>
                {{ $order->order_number }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Amount</label>
        <input type="number" name="amount" value="{{ $expense->amount }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Currency</label>
        <input type="text" name="currency" value="{{ $expense->currency }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Description</label>
        <textarea name="description" class="w-full border-gray-300 rounded" required>{{ $expense->description }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">Document</label>
        <input type="file" name="document" class="w-full border-gray-300 rounded">
        <p class="text-sm text-gray-600 mt-2">Current document: <a href="{{ asset('storage/'.$expense->document) }}" class="text-blue-500 hover:underline" target="_blank">View Document</a></p>
    </div>

    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Expense</button>
</form>
@endsection
