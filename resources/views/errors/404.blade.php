@extends('layouts.error')

@section('content')
@section('title', __('Non trouvé'))
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="text-center">
        <h1 class="text-2xl font-bold text-gray-900">404 | Non trouvé</h1>
        <p class="text-xl mt-4">Oups ! La page ou l'itinéraire que vous avez demandé n'a pas été trouvé</p>
        <a href="{{ url('/') }}" class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">
            Retourner à l'accueil
        </a>
    </div>
</div>

@endsection
