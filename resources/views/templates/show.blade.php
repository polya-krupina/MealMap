<x-layout :kids="$kids" class="page-content" active="templates">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/parent.css') }}">
        <link rel="stylesheet" href="{{ asset('css/templates.css') }}">
        <link rel="stylesheet" href="{{ asset('css/parent-day-menu.css') }}">
    @endpush
    <div id="header-templates">
        <h1>Мои шаблоны</h1>
        <a href="/templates/create" id="create-template">Создать шаблон на день</a>
    </div>
    ы
    <div id="my-templates-list">
        @foreach ($presets as $template)
            <x-template-card :template="$template"></x-template-card>
        @endforeach
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const templateOptionsButtons = document.querySelectorAll('.template-options');

            templateOptionsButtons.forEach(function(button) {   
                button.addEventListener('click', function(event) {
                    const optionsList = this.nextElementSibling;
                    if (optionsList.style.display === 'none' || optionsList.style.display === '') {
                        optionsList.style.display = 'flex';
                    } else {
                        optionsList.style.display = 'none';
                    }
                    event.stopPropagation();
                });
            });

            document.addEventListener('click', function(event) {
                templateOptionsButtons.forEach(function(button) {
                    const optionsList = button.nextElementSibling;
                    if (!optionsList.contains(event.target) && event.target !== button) {
                        optionsList.style.display = 'none';
                    }
                });
            });
        });
    </script>
    @endpush
</x-layout>