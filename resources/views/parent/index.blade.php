<x-layout :kids="$kids" class="logo-big-container">
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
    @endpush

    <img src="img/white-green-logo.svg" class="logo-big">
</x-layout>