@props(['kid'])
<h1>я, {{ $kid->name }}, учусь в группе {{ $kid->group->name }}, мой родитель - {{ $kid->user->name }}</h1>