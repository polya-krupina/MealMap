@props(['kids', 'groups', 'active' => -1])

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/parent-left-menu.css') }}">
    <link rel="icon" href="{{ asset('img/whiteLogo.svg') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @stack('styles')
    <title>MealMap</title>
</head>
<body>
    <nav id="menu">
        <a href="/" class="logo"><img src="{{ asset('img/whiteLogo.svg') }}" width="148px" height="25px"></a>
        <p class="kindergarten-name">Маленький Гений</p>
        <p class="user-name">Здравствуйте, {{ auth()->user()->name }}</p>
        <button id="open-chat"><img src={{ asset('img/chat.svg') }} alt="chat"></button>
        @if(auth()->user()->hasRole('parent'))
            <span id="my-children">Мои дети</span>
            <ul class="children">
                <hr></hr>
                @foreach($kids as $kid)
                <li class="child-button {{ $active == $kid->id ? 'active' : '' }}">
                    <a href="/kids/{{ $kid->id }}?date={{ Carbon\Carbon::now()->format('Y-m-d') }}" class="child"><img src="{{ asset('img/empty.jpg') }}" width="28px" height="28px"><span>{{ $kid->name }}</span></a>
                    <a href="/kids/{{ $kid->id }}/allergies" class="edit-child"><img src="{{ asset('img/edit.svg') }}"></a>
                </li>
                <hr></hr>
                @endforeach
            </ul>
            <ul class="buttons">
                <hr></hr><li><a href="/dishes" class="button {{ $active == "dishes" ? 'active' : '' }}" width="22" height="21"><img src="{{ asset('img/monthly menu.svg') }}"><span>Меню на месяц</span></a></li>
                <hr></hr><li><a href="/templates" class="button {{ $active == "templates" ? 'active' : '' }}"><img src="{{ asset('img/my templates.svg') }}"><span>Мои шаблоны</span></a></li>
                <hr></hr><li><a href="/payment" class="button {{ $active == "payment" ? 'active' : '' }}"><img src="{{ asset('img/payment.svg') }}"><span>Оплата</span></a></li>
                <hr></hr><li><a href="/logout" class="button"><img src="{{ asset('img/exit.svg') }}"><span>Выход</span></a></li>
            </ul>
            @else
            <ul class="worker-options">
                <hr></hr>
                <li class="worker-option {{ $active == "schedule" ? 'active' : '' }}">
                    <a href="/schedule?date={{ Carbon\Carbon::now()->format("Y-m-d") }}" class="option-text"><span>Посмотреть расписание</span></a>
                </li>
                <hr></hr>
                <li class="worker-option  {{ $active == "menu" ? 'active' : '' }}">
                    <a href="/menu" class="option-text"><span>Загрузить меню на месяц</span></a>
                </li>
                <hr></hr>
            </ul>
            <ul class="buttons">
                <hr></hr><li><a href="/logout" class="button"><img src={{ asset('img/exit.svg') }}><span>Выход</span></a></li>
            </ul>
        @endif
    </nav>
    <div id="chat-overlay"></div>
    <section id="chat-container">
        <div id="chat-header">
            <button id="chat-back"><img src="{{ asset('img/back-white.svg') }}" alt="back"></button>
            <p id="chat-title">Чаты</p>
        </div>
        <ul id="chat-list">
             @foreach ($groups as $group)
                <li><button class="chat-name" data-id="{{ $group->id }}">{{ $group->name }}</button></li>
             @endforeach
        </ul>
        <div id="chat-history">
            <div id="messages-list">
                <div class="message message-from" style="display:none">
                    <span class="sender-name">Вы</span>
                    <p class="messahe-content">Моего ребенка сегодня не будет</p>
                </div>
                <div class="message message-to" style="display: none">
                    <span class="sender-name">Барина Анастасия Валерьевна</span>
                    <p class="messahe-content">Здравствуйте уважаемые родители! 
                    Все ли сегодня будут?</p>
                </div>
            </div>
        </div>
        <div id="write-message">
            <input type="text" id="messahe-input" placeholder="Начните писать сообщение ..." name="body">
            <button id="send-message" type="submit"><img src={{ asset('img/send-message.svg') }} alt="send"></button>
        </div>
    </section>
    <section {{ $attributes(['class' => '']) }}>
        {{ $slot }}
    </section>
</body>
@stack('scripts')
<script>
    let button = document.getElementById('send-message');
    document.getElementById('messahe-input').addEventListener('keydown', function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            button.click();
        }
    });
</script>
<script>
    let fromExample = document.querySelector('.message-from');
    let toExample = document.querySelector('.message-to');
    let actualGroup = undefined;
    let chatField = document.querySelector('#messages-list');
    function clearAllChilds(e){
        let child = e.lastElementChild;
        while (child) {
            e.removeChild(child);
            child = e.lastElementChild;
        }
    }

    function makeAnotherMessage(author_id, message){
        let lastMessage = Array.from(document.querySelectorAll('.message')).last();
        let newMessage;
        if (message.user_id != author_id){
            newMessage = toExample.cloneNode(true);
            newMessage.querySelector('.sender-name').innerHTML = message.user.name;
        } else {
            newMessage = fromExample.cloneNode(true);
        }
        newMessage.querySelector('.messahe-content').innerHTML = message.body;
        newMessage.style.display = 'inline-block';
        document.querySelector('#messages-list').append(newMessage);
    }

    function downloadAndSetupData(group_id = 1){
        let user_id = {{ auth()->user()->id }};
        if (group_id == undefined)
            return;
        axios.get('/get-messages/'+group_id).then((response)=>{
            response.data.forEach( (el) => makeAnotherMessage(user_id, el));
        }).catch((response) => console.log(response));
    }
</script>
<script>
    Array.prototype.last = function() {
        return this[this.length - 1];
    }
    document.getElementById('open-chat').addEventListener('click', function() {
        downloadAndSetupData(actualGroup);
        document.getElementById('chat-overlay').style.display = 'block';
        document.getElementById('chat-container').style.display = 'flex';
    });
    document.getElementById('chat-overlay').addEventListener('click', function() {
        document.getElementById('chat-overlay').style.display = 'none';
        document.getElementById('chat-container').style.display = 'none';
        clearAllChilds(chatField);
    });
</script>
<script>
    document.getElementById('send-message').addEventListener('click', (event) => {
        let newMessage = fromExample.cloneNode(true);
        let messageBody= document.querySelector("#messahe-input");
        let lastMessage = Array.from(document.querySelectorAll('.message')).last();

        if (messageBody.value.length == 0){
            event.preventDefault();
            return;
        }
        let data = {
            'body': messageBody.value,
            'group_id': actualGroup
        };
        axios.post('/send-message', data).then((response)=>{console.log(response.data)}).catch((response) => console.log(response));

        newMessage.querySelector('.messahe-content').innerHTML = messageBody.value;
        messageBody.value = '';
        newMessage.style.display = 'inline-block';
        document.querySelector('#messages-list').append(newMessage);
    })
</script>
<script>
    const chatNames = document.querySelectorAll('.chat-name');
    const chatList = document.querySelector('#chat-list');
    const chatHistory = document.querySelector('#chat-history');
    const writeMessage = document.querySelector('#write-message');
    const chatBack = document.querySelector('#chat-back');
    chatNames.forEach(chatName => {
        chatName.addEventListener('click', () => {
            actualGroup = chatName.dataset.id;
            clearAllChilds(chatField);
            downloadAndSetupData(actualGroup);
            chatList.style.display = 'none';
            chatHistory.style.display = 'block';
            writeMessage.style.display = 'flex';
            chatBack.style.display = 'block';
            document.querySelector('#chat-title').textContent = chatName.textContent;
        });
    });
    chatBack.addEventListener('click', () => {
        actualGroup = undefined;
        chatList.style.display = 'block';
        chatHistory.style.display = 'none';
        writeMessage.style.display = 'none';
        chatBack.style.display = 'none';
        document.querySelector('#chat-title').textContent = 'Чаты';
    });
</script>
</html>