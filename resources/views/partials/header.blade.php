<header class="navbar" x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.scrollY > 20)" :class="{ 'shadow-lg': scrolled }">
    <div class="container-brand px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-[72px]">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-lg flex items-center justify-center transition-transform group-hover:scale-105" style="background: var(--brand-gradient, var(--brand-primary))">
                    <span class="text-white font-bold text-sm leading-none">LC</span>
                </div>
                <span class="text-[15px] font-bold tracking-tight" style="color: var(--neutral-900)">
                    Logia <span style="color: var(--brand-primary)">Consulting</span>
                </span>
            </a>

            {{-- Nav Desktop --}}
            <nav class="hidden lg:flex items-center gap-8" aria-label="Navegación principal">
                <a href="{{ url('/') }}"        class="nav-link">Inicio</a>
                <a href="{{ url('/cursos') }}"  class="nav-link">Cursos</a>
                <a href="{{ url('/siigo') }}"   class="nav-link">Siigo</a>
                <a href="{{ url('/soft') }}"    class="nav-link">Soft Restaurant</a>
                <a href="{{ url('/zoho') }}"    class="nav-link">Zoho One</a>
                <a href="{{ url('/nosotros') }}" class="nav-link">Nosotros</a>
            </nav>

            {{-- CTA desktop --}}
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    <a href="{{ url('/campus') }}" class="btn-outline text-xs px-4 py-2">Mi Campus</a>
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="btn-primary text-xs px-4 py-2">Panel</a>
                @else
                    <a href="{{ route('filament.admin.auth.login') }}" class="btn-outline text-xs px-4 py-2">Iniciar sesión</a>
                    <a href="{{ url('/cursos') }}" class="btn-primary text-xs px-4 py-2">Ver cursos</a>
                @endauth
            </div>

            {{-- Hamburger mobile --}}
            <button @click="open = !open" class="lg:hidden p-2 rounded-lg transition-colors" :class="open ? 'bg-gray-100' : 'hover:bg-gray-50'" aria-label="Abrir menú" :aria-expanded="open.toString()">
                <svg x-show="!open" class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- Menú mobile --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden border-t border-gray-100 bg-white" style="display:none">
        <nav class="container-brand px-4 py-4 space-y-1" aria-label="Menú mobile">
            <a href="{{ url('/') }}"         class="block py-3 px-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[var(--brand-primary)] transition-colors">Inicio</a>
            <a href="{{ url('/cursos') }}"   class="block py-3 px-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[var(--brand-primary)] transition-colors">Cursos</a>
            <a href="{{ url('/siigo') }}"    class="block py-3 px-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[var(--brand-primary)] transition-colors">Siigo</a>
            <a href="{{ url('/soft') }}"     class="block py-3 px-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[var(--brand-primary)] transition-colors">Soft Restaurant</a>
            <a href="{{ url('/zoho') }}"     class="block py-3 px-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[var(--brand-primary)] transition-colors">Zoho One</a>
            <a href="{{ url('/nosotros') }}" class="block py-3 px-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-[var(--brand-primary)] transition-colors">Nosotros</a>

            <div class="pt-3 pb-1 flex flex-col gap-2">
                @auth
                    <a href="{{ url('/campus') }}" class="btn-outline text-center">Mi Campus</a>
                @else
                    <a href="{{ route('filament.admin.auth.login') }}" class="btn-outline text-center">Iniciar sesión</a>
                    <a href="{{ url('/cursos') }}" class="btn-primary text-center">Ver cursos</a>
                @endauth
            </div>
        </nav>
    </div>
</header>
