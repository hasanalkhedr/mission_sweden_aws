@extends('layouts.error')

@section('content')
@section('title', __('NON AUTORISÉ'))
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="text-center">
        <h1 class="text-2xl font-bold text-gray-900">403 | NON AUTORISÉ</h1>
        <p class="text-xl mt-4">Oups ! Vous n'êtes pas autorisé à faire cela</p>
        <a href="{{ url('/') }}" class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">
            Retourner à l'accueil
        </a>
    </div>
</div>

@endsection
