<div>
    <style>
    /* AI Chat Widget - Independent Styles */
    .ai-chat-widget-container { position: fixed; bottom: 1rem; left: 0; right: 0; z-index: 50; padding-left: 1rem; padding-right: 1rem; }
    @media (min-width: 640px) { .ai-chat-widget-container { bottom: 1rem; right: 1rem; left: auto; padding: 0; } }

    .ai-chat-toggle-btn { margin-left: auto; background: linear-gradient(to right, #1f2937, #000000); color: white; padding: 0.75rem 1.5rem; border-radius: 9999px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); transition: all 0.2s; display: flex; align-items: center; gap: 0.5rem; font-weight: 500; border: none; cursor: pointer; }
    .ai-chat-toggle-btn:hover { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); transform: scale(1.05); }
    .dark .ai-chat-toggle-btn { background: linear-gradient(to right, #374151, #111827); }

    .ai-chat-window { margin-top: 0.5rem; width: 100%; max-width: 28rem; margin-left: auto; margin-right: auto; background-color: white; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); border-radius: 1rem; display: flex; flex-direction: column; overflow: hidden; border: 1px solid #e5e7eb; height: calc(100vh - 100px); max-height: 600px; }
    @media (min-width: 640px) { .ai-chat-window { width: 24rem; margin: 0; } }
    .dark .ai-chat-window { background-color: #111827; border-color: #374151; }

    .ai-chat-header { background: linear-gradient(to right, #1f2937, #000000); color: white; padding: 1rem 1.25rem; font-weight: 600; display: flex; justify-content: space-between; align-items: center; }
    .dark .ai-chat-header { background: linear-gradient(to right, #374151, #111827); }
    .ai-chat-header-left { display: flex; align-items: center; gap: 0.5rem; }
    .ai-chat-status-indicator { width: 0.5rem; height: 0.5rem; background-color: #4ade80; border-radius: 9999px; animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
    .dark .ai-chat-status-indicator { background-color: #22c55e; }
    .ai-chat-close-btn { color: white; background: transparent; border: none; cursor: pointer; transition: all 0.2s; font-size: 1.5rem; line-height: 1; width: 2rem; height: 2rem; border-radius: 9999px; display: flex; align-items: center; justify-content: center; }
    .ai-chat-close-btn:hover { background-color: rgba(255, 255, 255, 0.2); }
    .dark .ai-chat-close-btn:hover { background-color: rgba(255, 255, 255, 0.1); }

    .ai-chat-box { flex: 1; padding: 0.75rem; overflow-y: auto; background-color: #f9fafb; }
    @media (min-width: 640px) { .ai-chat-box { padding: 1rem; } }
    .dark .ai-chat-box { background-color: #1f2937; }

    .ai-chat-message-container { margin-top: 0.5rem; margin-bottom: 0.5rem; }
    @media (min-width: 640px) { .ai-chat-message-container { margin-top: 0.75rem; margin-bottom: 0.75rem; } }
    .ai-chat-message-container.user { display: flex; justify-content: flex-end; }
    .ai-chat-message-container.assistant { display: flex; justify-content: flex-start; }
    .ai-chat-message { padding: 0.75rem 1rem; border-radius: 1rem; max-width: 85%; word-wrap: break-word; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); font-size: 0.875rem; }
    @media (min-width: 640px) { .ai-chat-message { max-width: 75%; padding: 0.625rem 1rem; font-size: 1rem; } }
    .ai-chat-message.user { background: linear-gradient(to right, #1f2937, #000000); color: white; }
    .dark .ai-chat-message.user { background: linear-gradient(to right, #374151, #111827); }
    .ai-chat-message.assistant { background-color: white; color: #1f2937; border: 1px solid #e5e7eb; }
    .dark .ai-chat-message.assistant { background-color: #374151; color: #f9fafb; border-color: #4b5563; }

    .ai-chat-loading { display: flex; justify-content: flex-start; }
    .ai-chat-loading-content { background-color: white; color: #1f2937; border: 1px solid #e5e7eb; padding: 0.75rem 1rem; border-radius: 1rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    @media (min-width: 640px) { .ai-chat-loading-content { padding: 0.625rem 1rem; } }
    .dark .ai-chat-loading-content { background-color: #374151; color: #f9fafb; border-color: #4b5563; }
    .ai-chat-loading-dots { display: flex; align-items: center; gap: 0.5rem; }
    .ai-chat-loading-dots-container { display: flex; gap: 0.25rem; }
    .ai-chat-loading-dot { width: 0.5rem; height: 0.5rem; background-color: #9ca3af; border-radius: 9999px; animation: bounce 1.4s infinite; }
    .dark .ai-chat-loading-dot { background-color: #6b7280; }
    .ai-chat-loading-dot:nth-child(1) { animation-delay: 0ms; }
    .ai-chat-loading-dot:nth-child(2) { animation-delay: 150ms; }
    .ai-chat-loading-dot:nth-child(3) { animation-delay: 300ms; }
    .ai-chat-loading-text { font-size: 0.75rem; color: #6b7280; }
    @media (min-width: 640px) { .ai-chat-loading-text { font-size: 0.875rem; } }
    .dark .ai-chat-loading-text { color: #9ca3af; }

    .ai-chat-empty { color: #9ca3af; text-align: center; padding-top: 2rem; padding-bottom: 2rem; }
    .dark .ai-chat-empty { color: #6b7280; }
    .ai-chat-empty-icon { height: 2.5rem; width: 2.5rem; margin-left: auto; margin-right: auto; margin-bottom: 0.5rem; opacity: 0.5; }
    @media (min-width: 640px) { .ai-chat-empty-icon { height: 3rem; width: 3rem; } }
    .ai-chat-empty-text { font-size: 0.875rem; }
    @media (min-width: 640px) { .ai-chat-empty-text { font-size: 1rem; } }

    .ai-chat-form { display: flex; border-top: 1px solid #e5e7eb; background-color: white; }
    .dark .ai-chat-form { border-top-color: #374151; background-color: #1f2937; }
    .ai-chat-input { flex: 1; padding: 0.75rem 1rem; font-size: 0.875rem; outline: none; border: none; box-shadow: none; background-color: white; color: #111827; }
    @media (min-width: 640px) { .ai-chat-input { padding: 1rem; font-size: 1rem; } }
    .ai-chat-input:focus { outline: none; border: none; box-shadow: none; ring: 0; }
    .ai-chat-input::placeholder { color: #9ca3af; }
    .ai-chat-input:disabled { background-color: #f9fafb; color: #9ca3af; }
    .dark .ai-chat-input { background-color: #1f2937; color: #f9fafb; }
    .dark .ai-chat-input::placeholder { color: #6b7280; }
    .dark .ai-chat-input:disabled { background-color: #111827; color: #4b5563; }
    .ai-chat-submit-btn { background: linear-gradient(to right, #1f2937, #000000); color: white; padding-left: 1rem; padding-right: 1rem; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 0.25rem; font-weight: 500; min-width: 60px; border: none; cursor: pointer; }
    @media (min-width: 640px) { .ai-chat-submit-btn { padding-left: 1.5rem; padding-right: 1.5rem; gap: 0.5rem; min-width: 80px; } }
    .ai-chat-submit-btn:hover { opacity: 0.9; }
    .ai-chat-submit-btn:disabled { opacity: 0.5; cursor: not-allowed; }
    .dark .ai-chat-submit-btn { background: linear-gradient(to right, #374151, #111827); }
    .ai-chat-submit-text { font-size: 0.875rem; }
    @media (min-width: 640px) { .ai-chat-submit-text { font-size: 1rem; } }
    .ai-chat-submit-icon { height: 1rem; width: 1rem; }
    @media (min-width: 640px) { .ai-chat-submit-icon { height: 1.25rem; width: 1.25rem; } }

    .ai-chat-box a { text-decoration: underline; font-weight: 500; transition: opacity 0.2s; }
    .ai-chat-box a:hover { opacity: 0.8; }
    .ai-chat-message.user a { color: #93c5fd; }
    .ai-chat-message.assistant a { color: #2563eb; }
    .dark .ai-chat-message.assistant a { color: #60a5fa; }
    .ai-chat-box ul { margin: 0.5rem 0; padding-left: 1.25rem; list-style-type: disc; }
    .ai-chat-box ol { margin: 0.5rem 0; padding-left: 1.25rem; list-style-type: decimal; }
    .ai-chat-box li { margin: 0.25rem 0; }
    .ai-chat-box strong { font-weight: 600; }
    .ai-chat-box em { font-style: italic; }
    .ai-chat-box p { margin: 0.5rem 0; }

    @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
    @keyframes bounce { 0%, 80%, 100% { transform: translateY(0); } 40% { transform: translateY(-0.5rem); } }
    @media (min-width: 375px) { .xs\:inline { display: inline; } .xs\:hidden { display: none; } }
    </style>

    <div x-data="defineAiChatVariables()" class="ai-chat-widget-container">

        <button
            class="ai-chat-toggle-btn"
            x-cloak x-show="!open" x-transition:enter="transition ease-out duration-300 delay-[250ms]"
            x-transition:enter-start="opacity-0 scale-75 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0" @click="open = true">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                    clip-rule="evenodd" />
            </svg>
            <span class="hidden xs:inline">AI Assistant</span>
            <span class="xs:hidden">AI</span>
        </button>

        <div x-cloak x-show="open" x-transition:enter="transition ease-out duration-400 transform"
            x-transition:enter-start="translate-y-8 opacity-0 scale-90"
            x-transition:enter-end="translate-y-0 opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-250 transform"
            x-transition:leave-start="translate-y-0 opacity-100 scale-100"
            x-transition:leave-end="translate-y-8 opacity-0 scale-90" @click.away="open = false"
            class="ai-chat-window">
            <div class="ai-chat-header">
                <div class="ai-chat-header-left">
                    <div class="ai-chat-status-indicator"></div>
                    <span>AI Assistant</span>
                </div>
                <button @click="open = false" class="ai-chat-close-btn">&times;</button>
            </div>

            <div id="chat-box" class="ai-chat-box">
                <template x-for="(msg, index) in chatHistory" :key="index">
                    <div class="ai-chat-message-container" :class="msg.role === 'user' ? 'user' : 'assistant'">
                        <div class="ai-chat-message" :class="msg.role === 'user' ? 'user' : 'assistant'"
                            x-html="msg.content"></div>
                    </div>
                </template>

                <div x-show="isLoading" class="ai-chat-loading">
                    <div class="ai-chat-loading-content">
                        <div class="ai-chat-loading-dots">
                            <div class="ai-chat-loading-dots-container">
                                <span class="ai-chat-loading-dot"></span>
                                <span class="ai-chat-loading-dot"></span>
                                <span class="ai-chat-loading-dot"></span>
                            </div>
                            <span class="ai-chat-loading-text">AI is typing...</span>
                        </div>
                    </div>
                </div>

                <p x-show="chatHistory.length === 0" class="ai-chat-empty">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ai-chat-empty-icon"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span class="ai-chat-empty-text">Start the conversation...</span>
                </p>
            </div>

            <form @submit.prevent="submitMessage()" class="ai-chat-form">
                <input type="text" x-model="messageInput" placeholder="Type your message..."
                    class="ai-chat-input"
                    :disabled="isLoading" required>
                <button type="submit" class="ai-chat-submit-btn" :disabled="isLoading">
                    <span class="ai-chat-submit-text">Send</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="ai-chat-submit-icon" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                    </svg>
                </button>
            </form>
        </div>

        <script>
            function scrollChatToBottom() {
                const chatBox = document.getElementById('chat-box');
                if (chatBox) {
                    setTimeout(() => {
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }, 50);
                }
            }

            function defineAiChatVariables() {

                return {

                    open: false,
                    chatHistory: @entangle('chatHistory'),
                    messageInput: '',
                    isLoading: false,
                    observer: null,

                    init() {
                        this.$watch('open', val => {
                            if (val) {
                                this.$nextTick(scrollChatToBottom);
                                this.startObserving();
                            } else {
                                this.stopObserving();
                            }
                        });

                        this.$watch('chatHistory', () => {
                            this.$nextTick(scrollChatToBottom);
                        });
                    },

                    async submitMessage() {

                        const message = this.messageInput.trim();

                        this.chatHistory.push({
                            role: 'user',
                            content: message
                        });

                        this.isLoading = true;

                        try {
                            const result = await this.$wire.getAiResponse(message);

                            if (result && result.success) {
                                this.messageInput = '';
                            }

                            if (result && !result.success) {
                                this.chatHistory.pop();
                            }
                        } catch (error) {
                            console.error('Error sending message:', error);
                            this.chatHistory.pop();
                        } finally {
                            this.isLoading = false;
                        }
                    },

                    startObserving() {
                        const chatBox = document.getElementById('chat-box');
                        if (chatBox && !this.observer) {
                            this.observer = new MutationObserver(() => {
                                scrollChatToBottom();
                            });
                            this.observer.observe(chatBox, {
                                childList: true,
                                subtree: true,
                                attributes: true
                            });
                        }
                    },

                    stopObserving() {
                        if (this.observer) {
                            this.observer.disconnect();
                            this.observer = null;
                        }
                    }
                }
            }
        </script>

    </div>
</div>
