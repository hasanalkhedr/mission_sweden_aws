@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6">edit Mission Approval</h2>

    <form action="{{ route('mission_approves.update', $missionApprove->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')
        @if ($errors->any())
            <div class="text-danger text-pink-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-4">
            <label class="block text-gray-700">Mission Order</label>
            <label class="block text-gray-700">{{ $missionApprove->missionOrder->order_number }}</label>
            <label class="block text-gray-700">{{ $missionApprove->missionOrder->arrive_location }}</label>
            <input type="hidden" name="approval_id" value="{{ auth()->user()->employee->id }}">
            <input type="hidden" name="approval_role" value="{{ auth()->user()->employee->role }}">
            <label class="block text-gray-700">{{ $missionApprove->missionOrder->start_date }}</label>
            <label class="block text-gray-700">{{ $missionApprove->missionOrder->start_time }}</label>
            <label class="block text-gray-700">{{ $missionApprove->missionOrder->end_date }}</label>
            <label class="block text-gray-700">{{ $missionApprove->missionOrder->end_time }}</label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Comment</label>
            <input type="text" name="comment" id="">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <select name="status" class="w-full border-gray-300 rounded" required>
                @switch(Auth::user()->employee->role)
                    @case('supervisor')
                        <option value="sup_approve">Approve</option>
                    @break

                    @case('hr')
                        <option value="hr_approve">Approve</option>
                    @break

                    @case('sg')
                        <option value="sg_approve">Approve</option>
                    @break
                @endswitch

                <option value="rejected">Reject</option>
                <option value="draft">Review: return to employee to edit</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Soumettre</button>
    </form>
@endsection
