@extends(Theme::wrapper())
@section('title', 'Chat')
@section('container')
    <div class="card chat-box" id="mychatbox">
        <div class="card-header">
            <h4>Chat with Pulse</h4>
            <div class="card-header-action">
                <div class="dropdown d-inline">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start"
                        style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>
                        <a class="dropdown-item has-icon" href="#"><i class="far fa-file"></i> Save a transcript</a>
                        <a class="dropdown-item has-icon text-danger" href="#"><i class="fa-regular fa-trash-can"></i>
                            End Chat</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body chat-content" tabindex="2" style="overflow: hidden; outline: none;">
            <div class="chat-item chat-left" style="">
                <img src="https://cdn-icons-png.flaticon.com/512/4712/4712035.png" />
                <div class="chat-details">
                    <div class="chat-text">
                        Hi, {{ auth()->user()->username }} <br><br>

                        I'm Pulse, a chat AI support bot. Before we proceed, may I know which department you want to
                        contact?
                        <br> Please let me know which department you need assistance with so I can route your inquiry to the
                        appropriate channel.
                    </div>
                    <div class="chat-time">10:34</div>
                </div>
            </div>
            <!-- Removed chat items with hard-coded messages -->
            {{-- <div class="chat-item chat-left chat-typing" style="">
                <img src="https://cdn-icons-png.flaticon.com/512/4712/4712035.png" />
                <div class="chat-details">
                    <div class="chat-text"></div>
                </div>
            </div> --}}

            {{-- select department --}}
            <div class="select-department">
                <a onclick="selectDepartment('general')" class="btn btn-outline-secondary">🌐 General Inquiries</a>
                <a onclick="selectDepartment('technical')" class="btn btn-outline-secondary">🛠️ Technical Support</a>
                <a onclick="selectDepartment('billing')" class="btn btn-outline-secondary">💰 Billing and Payments</a>
            </div>
        </div>
        <div class="card-footer chat-form">
            <form id="chat-form">
                <input type="text" class="form-control" placeholder="Type a message" />
                <button class="btn btn-primary">
                    <i class="far fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        const chatForm = document.getElementById('chat-form');
        const chatInput = chatForm.querySelector('input[type="text"]');
        const chatContent = document.querySelector('.chat-content');
        const chatTyping = document.querySelector('.chat-item.chat-typing');
        let conversationHistory = '';

        chatForm.addEventListener('submit', async function(event) {
            event.preventDefault();
            const userMessage = chatInput.value.trim();
            if (!userMessage) return;
            chatInput.value = '';

            addChatMessage(userMessage, 'right', '{{ User::AvatarUri(auth()->user()->id) }}');
            chatTyping.style.display = 'block';

            try {
                const url = new URL('https://pro.wemx.net/support/chat/req');
                // url.searchParams.append('prompt', conversationHistory + userMessage);
                url.searchParams.append('prompt', userMessage);

                const response = await fetch(url, {
                    method: 'GET',
                });

                const responseBody = await response.json();
                // console.log(responseBody)
                const chatGptResponse = responseBody.res;

                addChatMessage(chatGptResponse, 'left',
                    'https://cdn-icons-png.flaticon.com/512/4712/4712035.png');
            } catch (error) {
                console.error('Error fetching API:', error);
            }

            chatTyping.style.display = 'none';
        });

        function addChatMessage(message, side, imageUrl, button = '<span></span>') {
            const chatItem = document.createElement('div');
            chatItem.className = 'chat-item chat-' + side;

            chatItem.innerHTML = `
            <img src="${imageUrl}" />
            <div class="chat-details">
                <div class="chat-text">${message}</div>
                <div class="chat-time">${getCurrentTime()}</div>
            </div>

            ${button}
        `;

            chatContent.appendChild(chatItem);
            chatContent.scrollTop = chatContent.scrollHeight;

            // Save the conversation history
            conversationHistory +=
                `User: ${side === 'right' ? message : ''}\nAI: ${side === 'left' ? message : ''}\n`;
        }

        function selectDepartment(department) {
            if (department == 'general') {
                // auto user response
                addChatMessage('I need assistance regarding general issues', 'right',
                    '{{ User::AvatarUri(auth()->user()->id) }}');

                // bot response
                addChatMessage(
                    'I understand you need help with general issues. Please describe your concern in as much details as possible.',
                    'left', 'https://cdn-icons-png.flaticon.com/512/4712/4712035.png');
            } else if (department == 'technical') {
                // auto user response
                addChatMessage('I need assistance with technical support', 'right',
                    '{{ User::AvatarUri(auth()->user()->id) }}');

                // bot response
                addChatMessage(
                    'I understand you need help with technical issues. Please describe your concern in as much details as possible.',
                    'left', 'https://cdn-icons-png.flaticon.com/512/4712/4712035.png');
            } else if (department == 'billing') {
                // auto user response
                addChatMessage('I need assistance regarding the Billing department', 'right',
                    '{{ User::AvatarUri(auth()->user()->id) }}');

                // bot response
                addChatMessage(
                    'As an Chat support bot, I am not authorized to handle financial matters. Please open a ticket using the button below and one of our human agents will assist you with your issue regarding the Billing department. Thank you!',
                    'left', 'https://cdn-icons-png.flaticon.com/512/4712/4712035.png',
                    '<a href="https://pro.wemx.net/tickets/create?department=Billing%20Enquiries" target="_blank" class="btn btn-outline-secondary mt-4">🎫 Open Ticket</a>'
                );
            } else {
                addChatMessage('I don\'t recognize ' + department + ', please select one of the valid departments.', 'left',
                    'https://cdn-icons-png.flaticon.com/512/4712/4712035.png');
            }
        }

        function getCurrentTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            return `${hours}:${minutes}`;
        }
    </script>
@endsection
