@extends('parent.index')

@section('content')
    <h1>я, {{ $kid->name }}, учусь в группе {{ $kid->group->name }}, мой родитель - {{ $kid->user->name }}</h1>
@endsection