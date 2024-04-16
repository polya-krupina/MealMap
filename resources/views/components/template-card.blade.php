@props(['template'])

<div class="template-card">
    <div class="template-title">
        <h2>{{ $template->name }}</h2>
        <button class="template-options"></button>
        <div class="template-oprions-list">
            <a href="/templates/{{ $template->id }}/edit"><p>Изменить шаблон</p></a>
            <hr></hr>
            <form action="/templates/{{ $template->id }}/delete" method="post">
                @csrf
                <button type="submit" class="delete-template">Удалить шаблон</button>
            </form>
        </div>
    </div>
    <div class="templates-meals">
        @foreach ($template->meals as $meal)
            <div class="template-meal">
                <p class="template-meal-name">{{ $meal->meal_type->name }}</p>
                <hr></hr>
                <ul class="template-meal-menu">
                    @foreach ($meal->dishes as $dish)
                      <li class="template-meal-dish">{{ ucwords($dish->name) }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
