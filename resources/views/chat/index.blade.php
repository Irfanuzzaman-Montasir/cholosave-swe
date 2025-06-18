@extends($isAdmin ? 'layouts.group_admin' : 'layouts.group_member')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-sm border border-slate-200 h-[70vh] flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-slate-200 rounded-t-xl">
            <div class="px-4 py-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <a href="{{ $isAdmin ? route('groups.admin.dashboard', $groupId) : route('groups.member.dashboard', $groupId) }}" 
                       class="text-slate-600 hover:text-slate-800 transition-colors">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <h1 class="text-xl font-semibold text-slate-800">
                            Group Chat @if($isAdmin)<span class="text-sm font-normal text-blue-600 bg-blue-50 px-2 py-1 rounded-full ml-2">Admin Mode</span>@endif
                        </h1>
                    </div>
                </div>
            </div>
        </header>
        <!-- Chat Container -->
        <div class="flex-1 p-6 overflow-y-auto messages space-y-4">
            @foreach($messages as $message)
                <div class="message {{ $message->user_id === auth()->id() ? 'flex justify-end' : 'flex justify-start' }}">
                    <div class="max-w-[70%] group">
                        <div class="flex items-center mb-1 {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <span class="text-sm text-slate-600 font-medium">
                                {{ $message->user->name }}
                                @if($message->is_admin)
                                    <span class="bg-blue-50 text-blue-600 text-xs px-2 py-0.5 rounded-full">Admin</span>
                                @endif
                            </span>
                            <span class="text-xs text-slate-400 ml-2">
                                {{ $message->created_at->format('h:i A') }}
                            </span>
                        </div>
                        <div class="message-bubble {{ $message->user_id === auth()->id() 
                            ? 'bg-blue-500 text-white rounded-2xl rounded-tr-sm' 
                            : 'bg-slate-100 text-slate-800 rounded-2xl rounded-tl-sm' }} 
                            p-4 transition-all">
                            {{ $message->message }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Message Input Area -->
        <div class="border-t border-slate-200 p-4 bg-slate-50 rounded-b-xl">
            <form class="message-form flex gap-3">
                <div class="flex-1 relative">
                    <textarea 
                        name="message" 
                        class="message-input w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none bg-white"
                        placeholder="Type your message..."
                    ></textarea>
                </div>
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors duration-200 flex items-center gap-2 font-medium shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    <i class="fas fa-paper-plane"></i>
                    <span>Send</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.messages::-webkit-scrollbar {
    width: 6px;
}
.messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}
.messages::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}
.messages::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
.message {
    animation: fadeIn 0.3s ease-in-out;
}
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.message-input {
    min-height: 48px;
    max-height: 120px;
}
.message-bubble {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}
</style>
@endpush

@push('scripts')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    // Define variables first
    const groupId = {{ $groupId }};
    const userId = {{ auth()->id() }};
    const username = "{{ auth()->user()->name }}";
    const isAdmin = {{ $isAdmin ? 'true' : 'false' }};

    // Debug information
    console.log('=== Chat Debug Information ===');
    console.log('Group ID:', groupId);
    console.log('User ID:', userId);
    console.log('Username:', username);
    console.log('Is Admin:', isAdmin);

    // Initialize Pusher
    const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
        cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
        forceTLS: true,
        enabledTransports: ['ws', 'wss'],
        disabledTransports: ['xhr_streaming', 'xhr_polling'],
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }
    });

    // Debug Pusher connection
    pusher.connection.bind('state_change', states => {
        console.log('Pusher connection state changed:', states);
    });

    pusher.connection.bind('connected', () => {
        console.log('Pusher connected successfully');
    });

    pusher.connection.bind('error', (err) => {
        console.error('Pusher connection error:', err);
    });

    // Subscribe to channel
    const channel = pusher.subscribe('group.' + groupId);
    
    channel.bind('pusher:subscription_succeeded', () => {
        console.log('Successfully subscribed to channel: group.' + groupId);
    });

    channel.bind('pusher:subscription_error', (error) => {
        console.error('Error subscribing to channel:', error);
    });

    channel.bind('new-message', function(data) {
        console.log('Received new message event:', data);
        
        // Don't add the message if it's from the current user
        if (data.user_id === userId) {
            console.log('Skipping own message');
            return;
        }

        const messagesDiv = document.querySelector('.messages');
        if (!messagesDiv) {
            console.error('Messages container not found');
            return;
        }

        console.log('Adding new message to chat:', data);

        // Format the time
        const messageTime = data.created_at || new Date().toLocaleTimeString([], { 
            hour: 'numeric', 
            minute: '2-digit', 
            hour12: true 
        });

        const messageElem = document.createElement('div');
        const adminBadge = data.is_admin 
            ? '<span class="bg-blue-50 text-blue-600 text-xs px-2 py-0.5 rounded-full">Admin</span>' 
            : '';
        
        messageElem.className = `message flex justify-start`;
        messageElem.innerHTML = `
            <div class="max-w-[70%] group">
                <div class="flex items-center mb-1 justify-start">
                    <span class="text-sm text-slate-600 font-medium">
                        ${data.username} ${adminBadge}
                    </span>
                    <span class="text-xs text-slate-400 ml-2">${messageTime}</span>
                </div>
                <div class="message-bubble bg-slate-100 text-slate-800 rounded-2xl rounded-tl-sm p-4">
                    ${data.message.message}
                </div>
            </div>`;
        
        messagesDiv.appendChild(messageElem);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
        console.log('Message added to chat successfully');
    });

    // Handle form submission
    const messageForm = document.querySelector('.message-form');
    if (messageForm) {
        messageForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            console.log('Form submitted!');
            
            const messageInput = document.querySelector('textarea[name="message"]');
            const message = messageInput ? messageInput.value.trim() : '';
            const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : null;
            
            if (message !== '') {
                try {
                    console.log('Sending message:', message);
                    const response = await fetch(`/groups/${groupId}/chat`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            message: message,
                            group_id: groupId
                        })
                    });

                    const data = await response.json();
                    console.log('Server response:', data);

                    if (data.success) {
                        // Add the message to the chat immediately for the sender
                        const messagesDiv = document.querySelector('.messages');
                        const messageElem = document.createElement('div');
                        const time = new Date().toLocaleTimeString([], { 
                            hour: 'numeric', 
                            minute: '2-digit', 
                            hour12: true 
                        });
                        
                        const adminBadge = isAdmin 
                            ? '<span class="bg-blue-50 text-blue-600 text-xs px-2 py-0.5 rounded-full">Admin</span>' 
                            : '';
                        
                        messageElem.className = `message flex justify-end`;
                        messageElem.innerHTML = `
                            <div class="max-w-[70%] group">
                                <div class="flex items-center mb-1 justify-end">
                                    <span class="text-sm text-slate-600 font-medium">
                                        ${username} ${adminBadge}
                                    </span>
                                    <span class="text-xs text-slate-400 ml-2">${time}</span>
                                </div>
                                <div class="message-bubble bg-blue-500 text-white rounded-2xl rounded-tr-sm p-4">
                                    ${message}
                                </div>
                            </div>`;
                        
                        messagesDiv.appendChild(messageElem);
                        messagesDiv.scrollTop = messagesDiv.scrollHeight;
                        
                        messageInput.value = '';
                        console.log('Message added to sender\'s chat');
                    } else {
                        console.error('Failed to send message:', data.error);
                        alert('Failed to send message. Please try again.');
                    }
                } catch (error) {
                    console.error('Error sending message:', error);
                    alert('Error sending message. Please try again.');
                }
            }
        });
    }

    // Auto-scroll to bottom on page load
    document.addEventListener('DOMContentLoaded', function() {
        const messagesDiv = document.querySelector('.messages');
        if (messagesDiv) {
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }
    });
</script>
@endpush 