{{-- Chat Widget --}}
<div id="chat-widget" class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">

    {{-- Chat Window --}}
    <div id="chat-window"
         class="hidden w-[360px] rounded-2xl border border-white/[0.08] bg-gray-900 shadow-2xl shadow-black/40 overflow-hidden transition-all duration-300"
         style="max-height: 520px;">

        {{-- Header --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-white/[0.06] bg-gray-900">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center">
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714a2.25 2.25 0 001.591 1.591L21 14.5"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">Cihan's Assistant</p>
                    <div class="flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-xs text-gray-500">Online</span>
                    </div>
                </div>
            </div>
            <button id="close-chat" class="text-gray-600 hover:text-white transition-colors p-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Messages --}}
        <div id="chat-messages" class="overflow-y-auto px-4 py-4 space-y-3" style="height: 360px;">
            {{-- Welcome message --}}
            <div class="flex gap-2.5">
                <div class="w-6 h-6 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-3 h-3 text-indigo-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                    </svg>
                </div>
                <div class="bg-white/[0.05] border border-white/[0.06] rounded-2xl rounded-tl-sm px-4 py-2.5 max-w-[260px]">
                    <p class="text-sm text-gray-300 leading-relaxed">Hi! I'm Cihan's AI assistant. Ask me anything about his work, projects, or skills! 👋</p>
                </div>
            </div>
        </div>

        {{-- Input --}}
        <div class="px-4 py-3 border-t border-white/[0.06]">
            <div class="flex items-center gap-2">
                <input id="chat-input"
                       type="text"
                       placeholder="Ask me anything..."
                       class="flex-1 px-4 py-2.5 rounded-xl bg-white/[0.05] border border-white/[0.08] text-white text-sm placeholder-gray-600 focus:outline-none focus:border-indigo-500/50 transition-all">
                <button id="chat-send"
                        class="w-9 h-9 rounded-xl bg-indigo-600 hover:bg-indigo-500 flex items-center justify-center shrink-0 transition-colors disabled:opacity-50">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Toggle Button --}}
    <button id="chat-toggle"
            class="w-14 h-14 rounded-full bg-indigo-600 hover:bg-indigo-500 flex items-center justify-center shadow-lg shadow-indigo-600/30 transition-all duration-200 hover:scale-105">
        <svg id="chat-icon-open" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
        <svg id="chat-icon-close" class="w-6 h-6 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>

</div>

<script>
(function() {
    // Anonymous ID
    let anonId = localStorage.getItem('chat_anon_id');
    if (!anonId) {
        anonId = 'anon_' + Math.random().toString(36).substr(2, 16) + Date.now();
        localStorage.setItem('chat_anon_id', anonId);
    }

    const toggle = document.getElementById('chat-toggle');
    const window_ = document.getElementById('chat-window');
    const closeBtn = document.getElementById('close-chat');
    const input = document.getElementById('chat-input');
    const sendBtn = document.getElementById('chat-send');
    const messages = document.getElementById('chat-messages');
    const iconOpen = document.getElementById('chat-icon-open');
    const iconClose = document.getElementById('chat-icon-close');

    let isOpen = false;
    let isLoading = false;

    function openChat() {
        isOpen = true;
        window_.classList.remove('hidden');
        setTimeout(() => window_.classList.add('opacity-100'), 10);
        iconOpen.classList.add('hidden');
        iconClose.classList.remove('hidden');
        input.focus();
    }

    function closeChat() {
        isOpen = false;
        window_.classList.add('hidden');
        iconOpen.classList.remove('hidden');
        iconClose.classList.add('hidden');
    }

    toggle.addEventListener('click', () => isOpen ? closeChat() : openChat());
    closeBtn.addEventListener('click', closeChat);

    function addMessage(content, role) {
        const isUser = role === 'user';
        const div = document.createElement('div');
        div.className = 'flex gap-2.5' + (isUser ? ' justify-end' : '');
        div.innerHTML = isUser
            ? `<div class="bg-indigo-600 rounded-2xl rounded-tr-sm px-4 py-2.5 max-w-[260px]">
                <p class="text-sm text-white leading-relaxed">${escapeHtml(content)}</p>
               </div>`
            : `<div class="w-6 h-6 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center shrink-0 mt-0.5">
                <svg class="w-3 h-3 text-indigo-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
               </div>
               <div class="bg-white/[0.05] border border-white/[0.06] rounded-2xl rounded-tl-sm px-4 py-2.5 max-w-[260px]">
                <p class="text-sm text-gray-300 leading-relaxed">${escapeHtml(content)}</p>
               </div>`;
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    function addTyping() {
        const div = document.createElement('div');
        div.id = 'typing-indicator';
        div.className = 'flex gap-2.5';
        div.innerHTML = `<div class="w-6 h-6 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center shrink-0 mt-0.5">
            <svg class="w-3 h-3 text-indigo-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
        </div>
        <div class="bg-white/[0.05] border border-white/[0.06] rounded-2xl rounded-tl-sm px-4 py-3">
            <div class="flex gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-gray-500 animate-bounce" style="animation-delay:0ms"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-gray-500 animate-bounce" style="animation-delay:150ms"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-gray-500 animate-bounce" style="animation-delay:300ms"></span>
            </div>
        </div>`;
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    function removeTyping() {
        const t = document.getElementById('typing-indicator');
        if (t) t.remove();
    }

    function escapeHtml(text) {
        return text.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>');
    }

    async function sendMessage() {
        const text = input.value.trim();
        if (!text || isLoading) return;

        isLoading = true;
        sendBtn.disabled = true;
        input.value = '';

        addMessage(text, 'user');
        addTyping();

        try {
            const res = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ message: text, anonymous_id: anonId }),
            });

            const data = await res.json();
            removeTyping();

            if (data.reply) {
                addMessage(data.reply, 'assistant');
            } else {
                addMessage('Sorry, something went wrong. Please try again.', 'assistant');
            }
        } catch (e) {
            removeTyping();
            addMessage('Connection error. Please try again.', 'assistant');
        } finally {
            isLoading = false;
            sendBtn.disabled = false;
            input.focus();
        }
    }

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
})();
</script>