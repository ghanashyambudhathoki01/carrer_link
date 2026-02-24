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

    <!-- Chat Bubble Button -->
    <button @click="toggleChat()" 
            class="fixed bottom-6 right-6 w-14 h-14 bg-blue-600 text-white rounded-2xl shadow-2xl hover:bg-blue-700 transition-all flex items-center justify-center z-[9999] hover:scale-110 active:scale-95 group">
        <svg x-show="!isOpen" class="w-7 h-7 animate-pulse-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
        <svg x-show="isOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span class="absolute right-full mr-4 px-3 py-1 bg-gray-900 text-white text-[10px] font-bold uppercase tracking-widest rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
            Need Help?
        </span>
    </button>

    <!-- Chat Window -->
    <div x-show="isOpen"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-12 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-12 scale-95"
         class="fixed bottom-24 right-6 w-80 sm:w-96 glass dark:glass-dark rounded-[2.5rem] shadow-2xl z-[9999] overflow-hidden flex flex-col border border-white/20 dark:border-gray-800/50">
        
        <!-- Header -->
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

        <!-- Messages -->
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

        <!-- Input -->
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
                { role: 'bot', content: 'Hello! 👋 I\'m the CareerLink assistant.\nHow can I help you today?\nTry asking about: jobs • internships • resume • dashboard • profile • events • plans' }
            ],
            userRole: '{{ auth()->user()->role ?? "guest" }}',

            // Developer credit (short version used in most answers)
            devCredit: "\n\n— Developed by Ghanashyam Budhathoki\nContact: ghanashyambudhathoki03@gmail.com",

            toggleChat() {
                this.isOpen = !this.isOpen;
                if (this.isOpen) this.scrollToBottom();
            },

            scrollToBottom() {
                setTimeout(() => {
                    const el = document.getElementById('chat-messages');
                    if (el) el.scrollTop = el.scrollHeight;
                }, 80);
            },

            sendMessage() {
                let input = this.userInput.trim();
                if (!input) return;

                this.messages.push({ role: 'user', content: input });
                this.userInput = '';
                this.isTyping = true;
                this.scrollToBottom();

                setTimeout(() => {
                    this.isTyping = false;
                    const response = this.getResponse(input.toLowerCase());
                    this.messages.push({ role: 'bot', content: response });
                    this.scrollToBottom();
                }, 600 + Math.random() * 900);
            },

            getResponse(input) {
                // ───────────────────────────────────────────────────────────────
                //                   Expanded keyword-based responses
                // ───────────────────────────────────────────────────────────────

                if (/^(hi|hello|hey|salut|sup|yo)/i.test(input)) {
                    return "Hey there! 😊 Nice to see you!\nHow can I assist you today?" + this.devCredit;
                }
                else if (input.includes('who are you') || input.includes('what are you') || input.includes('your name')) {
                    return "I'm the CareerLink Assistant — here to help with jobs, resumes, dashboard, and more!" + this.devCredit;
                }
                else if (input.includes('who made') || input.includes('who created') || input.includes('developer') || input.includes('creator') || input.includes('ghanashyam')) {
                    return "I was developed by **Ghanashyam Budhathoki**.\nYou can contact him at: ghanashyambudhathoki03@gmail.com" + this.devCredit;
                }
                else if (input.includes('job') || input.includes('jobs') || input.includes('vacancy') || input.includes('hiring')) {
                    return "Check the **Jobs** section in the sidebar — filter by location, category, remote/onsite, salary…" + this.devCredit;
                }
                else if (input.includes('intern') || input.includes('internship') || input.includes('trainee')) {
                    return "Great choice! → **Internships** tab has many entry-level and learning opportunities." + this.devCredit;
                }
                else if (input.includes('resume') || input.includes('cv') || input.includes('curriculum vitae')) {
                    if (this.userRole === 'job_seeker') {
                        return "You can build & improve your resume right now using our **Resume Builder** in the sidebar. Want ATS tips too?";
                    }
                    return "Resume creation & optimization tools are available for **Job Seekers**." + this.devCredit;
                }
                else if (input.includes('cover letter') || input.includes('motivation letter')) {
                    return "We don't have an automatic cover letter generator yet, but a strong, personalized one is very important. Need a good structure/template suggestion?" + this.devCredit;
                }
                else if (input.includes('plan') || input.includes('price') || input.includes('premium') || input.includes('subscription') || input.includes('upgrade')) {
                    return "See all plans & features → **Subscriptions** page in the menu." + this.devCredit;
                }
                else if (input.includes('event') || input.includes('webinar') || input.includes('workshop') || input.includes('career fair')) {
                    return "Upcoming career events, webinars & workshops → check the **Events** section!" + this.devCredit;
                }
                else if (input.includes('dashboard') || input.includes('home') || input.includes('overview')) {
                    return "Your dashboard shows: application status • profile strength • recent activity • quick stats" + this.devCredit;
                }
                else if (input.includes('profile') || input.includes('edit profile') || input.includes('update profile') || input.includes('settings')) {
                    return "Click your avatar (top right) → **Edit Profile** to update photo, skills, experience, education…" + this.devCredit;
                }
                else if (input.includes('company') || input.includes('companies') || input.includes('employer') || input.includes('organization')) {
                    return "Browse companies, see open positions & read reviews (where available) in the **Companies** section." + this.devCredit;
                }
                else if (input.includes('application') || input.includes('applied') || input.includes('my applications') || input.includes('status')) {
                    return "Track all your applications → **My Applications** page" + this.devCredit;
                }
                else if (input.includes('admin') || input.includes('super admin') || input.includes('manage users') || input.includes('approve jobs')) {
                    if (this.userRole === 'admin' || this.userRole === 'super_admin') {
                        return "Admin mode active 👨‍💻\nManage users • jobs • approvals • reports • settings" + this.devCredit;
                    }
                    return "This area is only accessible to administrators." + this.devCredit;
                }
                else if (input.includes('thank') || input.includes('thanks') || input.includes('ty') || input.includes('appreciate')) {
                    return "You're very welcome! 😄 Happy to help anytime." + this.devCredit;
                }
                else if (input.includes('bye') || input.includes('goodbye') || input.includes('see you') || input.includes('later')) {
                    return "Take care! 👋 Come back whenever you need career support." + this.devCredit;
                }
                else if (input.includes('help') || input.includes('support') || input.includes('problem') || input.includes('issue') || input.includes('stuck')) {
                    return "I'm here for you! 😊\nTell me exactly what's confusing or not working — I'll try to guide you." + this.devCredit;
                }

                // Fallback answer
                return "Hmm… I'm still learning new questions 😅\n\nYou can ask me about:\n• jobs / internships\n• resume / CV\n• profile / dashboard\n• companies / events\n• premium plans\n• admin features (if you're admin)\n\nOr just say hi! 😉" + this.devCredit;
            }
        }
    }
</script>