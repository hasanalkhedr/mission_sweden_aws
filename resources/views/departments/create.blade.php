@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Create a Department</h2>
    <form action="{{ route('departments.store') }}" method="POST" class="w-full">
        @if ($errors->any())
            <div class="text-danger text-pink-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <x-form-divider>Department Data</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-label>
                    Name:
                </x-label>
                <x-text-input name="name" value="{{ old('name') }}" />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-primary-button>Soumettre</x-primary-button>
            </div>
        </div>
    </form>
@endsection
