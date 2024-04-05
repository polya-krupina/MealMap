<x-layout>
    <div style="display: flex; justify-content: center">
        <div style="left: 1px; position: absolute">
            <a href="/"><h2>На главную</h2></a>
            <h1>Hello, {{ auth()->user()->name }}</h1>
            @role('parent')
                <p>ты так то родитель чел</p>
            @endrole
            <h2>Your kids:</h2>
            @foreach($kids as $kid)
                <x-kid-plate :kid="$kid"/>
            @endforeach
            <a href="/logout"><h2>Выйти</h2></a>
        </div>    
        <div>
            @yield('content')
        </div>
    </div>
</x-layout>