@extends('parent.index')

@section('content')
    <x-kid-header :kid="$kid"/>
    <h2>Вот список моих аллергий:</h2>
    <ul>
        @if(count($kid->allergies) != 0)
            @foreach($kid->allergies as $allergy)
                <li>{{ $allergy->name }}</li>
            @endforeach
        @else
            <li>а у меня нет аллергий!</li>    
        @endif
    </ul>
@endsection