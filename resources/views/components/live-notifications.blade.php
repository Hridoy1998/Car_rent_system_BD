<div x-data="liveNotifications()" class="fixed top-24 right-6 z-50 flex flex-col gap-3 w-80">
    <template x-for="notif in notifications" :key="notif.id">
        <div x-show="notif.show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-8"
             class="bg-gray-900/90 backdrop-blur-xl border border-indigo-500/30 p-4 rounded-2xl shadow-[0_10px_30px_rgba(79,102,241,0.2)] flex items-start gap-4">
             <div class="text-indigo-400 mt-1">
                 <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
             </div>
             <div class="flex-1">
                 <h4 class="text-white text-xs font-black tracking-widest uppercase mb-1" x-text="notif.title"></h4>
                 <p class="text-gray-400 text-[10px]" x-text="notif.message"></p>
                 <template x-if="notif.action_url">
                     <a :href="notif.action_url" class="mt-2 inline-block text-[9px] text-indigo-400 font-bold uppercase tracking-widest hover:text-white">View Details →</a>
                 </template>
             </div>
             <button @click="dismiss(notif.id)" class="text-gray-500 hover:text-white"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('liveNotifications', () => ({
            notifications: [],
            authId: {{ auth()->id() ?? 'null' }},

            init() {
                if(this.authId && window.Echo) {
                    window.Echo.private('user.' + this.authId)
                        .listen('NotificationCreated', (e) => {
                            let notif = {
                                id: Date.now(),
                                title: e.title,
                                message: e.message,
                                action_url: e.action_url,
                                show: true
                            };
                            this.notifications.push(notif);
                            
                            // Auto dismiss after 7 seconds
                            setTimeout(() => {
                                this.dismiss(notif.id);
                            }, 7000);
                        });
                }
            },
            dismiss(id) {
                let notif = this.notifications.find(n => n.id === id);
                if(notif) {
                    notif.show = false;
                    setTimeout(() => {
                        this.notifications = this.notifications.filter(n => n.id !== id);
                    }, 300);
                }
            }
        }));
    });
</script>
