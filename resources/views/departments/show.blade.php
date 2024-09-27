@extends('layouts.app')

@section('content')
    <form class="w-full">
        <x-form-divider>Department Data</x-form-divider>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <x-label>
                    Name:
                </x-label>
                <x-readonly-text-input name="name" value="{{$department->name }}" />
            </div>
        </div>
    </form>
@endsection
