 <div class="flex flex-col flex-1">
            
            <!-- NAVBAR (Top Nav) -->
            <header class="h-16 bg-white border-b border-[var(--mh-border)] flex items-center justify-between px-6 shadow-sm">
                <!-- Mobile Toggle Menu (hanya muncul di HP) -->
                <button class="md:hidden p-2 rounded-md hover:bg-[var(--mh-surface-hover)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <div class="flex-1 flex justify-end items-center space-x-4">
                    <span class="text-sm text-[var(--mh-muted)] italic">{{ date('D, d M Y') }}</span>
                    <div class="h-8 w-px bg-[var(--mh-border)]"></div>
                    <button class="relative p-2 text-[var(--mh-muted)] hover:text-[var(--mh-primary)]">
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>
                </div>
            </header>