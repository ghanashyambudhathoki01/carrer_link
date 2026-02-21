<div x-data="chatbot()" x-cloak>
    <style>
        @keyframes pulse-slow {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.9; }
        }
        .animate-pulse-slow { animation: pulse-slow 3s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        .glass-chat {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
    {{-- Chat Bubble Button --}}
    <button @click="toggleChat()" 
            class="fixed bottom-6 right-6 w-14 h-14 bg-blue-600 text-white rounded-2xl shadow-2xl hover:bg-blue-700 transition-all flex items-center justify-center z-[9999] hover:scale-110 active:scale-95 group">
        <svg x-show="!isOpen" class="w-7 h-7 animate-pulse-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
        <svg x-show="isOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        {{-- Tooltip --}}
        <span class="absolute right-full mr-4 px-3 py-1 bg-gray-900 text-white text-[10px] font-bold uppercase tracking-widest rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
            Need Help?
        </span>
    </button>

    {{-- Chat Window --}}
    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-12 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-12 scale-95"
         class="fixed bottom-24 right-6 w-80 sm:w-96 glass dark:glass-dark rounded-[2.5rem] shadow-2xl z-[9999] overflow-hidden flex flex-col border border-white/20 dark:border-gray-800/50">
        
        {{-- Header --}}
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white relative">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-md">
                    🤖
                </div>
                <div>
                    <h3 class="font-black text-sm uppercase tracking-wider">CareerLink Bot</h3>
                    <p class="text-[10px] text-blue-100 font-bold opacity-80">Online & Ready to Help</p>
                </div>
            </div>
        </div>

        {{-- Messages --}}
        <div id="chat-messages" class="flex-1 min-h-[300px] max-h-[400px] overflow-y-auto p-6 space-y-4 bg-white/50 dark:bg-gray-900/50 backdrop-blur-xl">
            <template x-for="msg in messages">
                <div :class="msg.role === 'bot' ? 'flex justify-start' : 'flex justify-end'">
                    <div :class="msg.role === 'bot' ? 'bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 shadow-sm border border-gray-100 dark:border-gray-700 rounded-2xl rounded-tl-none' : 'bg-blue-600 text-white shadow-xl shadow-blue-100/50 rounded-2xl rounded-tr-none'"
                         class="max-w-[85%] px-4 py-3 text-xs leading-relaxed font-medium">
                        <span x-text="msg.content"></span>
                    </div>
                </div>
            </template>
            <div x-show="isTyping" class="flex justify-start">
                <div class="bg-white dark:bg-gray-800 px-4 py-3 rounded-2xl rounded-tl-none shadow-sm flex gap-1 items-center">
                    <span class="w-1 h-1 bg-gray-400 rounded-full animate-bounce"></span>
                    <span class="w-1 h-1 bg-gray-400 rounded-full animate-bounce delay-150"></span>
                    <span class="w-1 h-1 bg-gray-400 rounded-full animate-bounce delay-300"></span>
                </div>
            </div>
        </div>

        {{-- Input --}}
        <div class="p-4 bg-gray-50/50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700">
            <form @submit.prevent="sendMessage()" class="relative">
                <input type="text" x-model="userInput" placeholder="Ask about jobs, resume, plans..." 
                       class="w-full bg-white dark:bg-gray-900 border-none rounded-2xl pl-4 pr-12 py-3 text-xs focus:ring-2 focus:ring-blue-500 shadow-inner dark:text-white">
                <button type="submit" class="absolute right-2 top-2 p-1.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function chatbot() {
        return {
            isOpen: false,
            userInput: '',
            isTyping: false,
            messages: [
                { role: 'bot', content: 'Hi! I\'m your CareerLink assistant. How can I help you today? Try asking about "jobs", "resume", or "dashboard".' }
            ],
            userRole: '{{ auth()->user()->role ?? "guest" }}',

            toggleChat() {
                this.isOpen = !this.isOpen;
                if(this.isOpen) {
                    this.scrollToBottom();
                }
            },

            scrollToBottom() {
                setTimeout(() => {
                    const el = document.getElementById('chat-messages');
                    el.scrollTop = el.scrollHeight;
                }, 100);
            },

            sendMessage() {
                const input = this.userInput.trim().toLowerCase();
                if (!input) return;

                this.messages.push({ role: 'user', content: this.userInput });
                this.userInput = '';
                this.isTyping = true;
                this.scrollToBottom();

                setTimeout(() => {
                    this.isTyping = false;
                    const response = this.getResponse(input);
                    this.messages.push({ role: 'bot', content: response });
                    this.scrollToBottom();
                }, 800);
            },

            getResponse(input) {
                // If-Else Chatbot Logic
                if (input.includes('hello') || input.includes('hi') || input.includes('hey')) {
                    return "Hello there! Hope you're having a great day at CareerLink.";
                } else if (input.includes('job') || input.includes('internship')) {
                    return "You can explore the latest opportunities in the 'Jobs' or 'Internships' section in the sidebar!";
                } else if (input.includes('resume') || input.includes('cv')) {
                    if (this.userRole === 'job_seeker') {
                        return "Use our premium Resume Builder to create a stunning CV. Look for it in your sidebar!";
                    }
                    return "Resume tools are available for Job Seekers to help them land their dream role.";
                } else if (input.includes('plan') || input.includes('price') || input.includes('subscription')) {
                    return "Check out our premium plans in the 'Subscriptions' section to unlock advanced features.";
                } else if (input.includes('event')) {
                    return "Don't miss out on upcoming career events! You can view and register for them in the 'Events' tab.";
                } else if (input.includes('dashboard')) {
                    return "Your dashboard gives you a quick overview of your applications, profile, and active system stats.";
                } else if (input.includes('help') || input.includes('support')) {
                    return "I can help with dashboard navigation, resume building, and job searching. What specific area are you stuck on?";
                } else if (input.includes('admin') || input.includes('super admin')) {
                    if (this.userRole === 'admin' || this.userRole === 'super_admin') {
                        return "Welcome back, chief! You can manage users, approve jobs, and monitor system performance from here.";
                    }
                    return "The Admin portal is restricted to system administrators only.";
                } else if (input.includes('thank')) {
                    return "You're very welcome! Let me know if you need anything else.";
                } else {
                    return "I'm not quite sure I understand. Could you try asking about jobs, resumes, or system features?";
                }
            }
        }
    }
</script>
