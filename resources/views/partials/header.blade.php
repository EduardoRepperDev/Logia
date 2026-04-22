<header class="navbar" x-data="{ mobileOpen: false, scrolled: false }" @scroll.window="scrolled = window.scrollY > 20" :class="scrolled ? 'shadow-lg' : ''">
    <div class="container-brand px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-[72px]">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center shrink-0 group">
                <img src="{{ asset('images/logo.png') }}" alt="Logia Consulting" class="h-10 w-auto transition-transform group-hover:scale-105" />
            </a>

            {{-- Nav Desktop --}}
            <nav class="hidden lg:flex items-center gap-0.5" aria-label="Navegación principal">

                {{-- Dropdown: Productos --}}
                <div class="relative" x-data="{ open: false, t: null }"
                     @mouseenter="clearTimeout(t); open = true" @mouseleave="t = setTimeout(() => open = false, 120)">
                    <button class="nav-link flex items-center gap-1 px-3 py-2 rounded-lg text-sm hover:bg-gray-50">
                        Productos
                        <svg :class="open ? 'rotate-180' : ''" class="w-3 h-3 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="absolute top-full left-0 mt-1 w-72 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                        <a href="{{ url('/productos/siigo-aspel') }}" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors group">
                            <span class="w-2 h-2 rounded-full mt-1.5 shrink-0" style="background:#1B4DB7"></span>
                            <div><p class="text-sm font-semibold text-gray-800 group-hover:text-[#1B4DB7]">Siigo Aspel</p><p class="text-xs text-gray-500 mt-0.5">Software de gestión para PYMES</p></div>
                        </a>
                        <a href="{{ url('/productos/soft-restaurant') }}" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors group">
                            <span class="w-2 h-2 rounded-full mt-1.5 shrink-0" style="background:#E8500A"></span>
                            <div><p class="text-sm font-semibold text-gray-800 group-hover:text-[#E8500A]">Soft-Restaurant</p><p class="text-xs text-gray-500 mt-0.5">Sistema integral para F&amp;B</p></div>
                        </a>
                        <a href="{{ url('/productos/zoho-one') }}" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition-colors group">
                            <span class="w-2 h-2 rounded-full mt-1.5 shrink-0" style="background:#C8202C"></span>
                            <div><p class="text-sm font-semibold text-gray-800 group-hover:text-[#C8202C]">Zoho One</p><p class="text-xs text-gray-500 mt-0.5">Suite empresarial completa (40+ apps)</p></div>
                        </a>
                    </div>
                </div>

                {{-- Dropdown: Capacitación --}}
                <div class="relative" x-data="{ open: false, t: null }"
                     @mouseenter="clearTimeout(t); open = true" @mouseleave="t = setTimeout(() => open = false, 120)">
                    <button class="nav-link flex items-center gap-1 px-3 py-2 rounded-lg text-sm hover:bg-gray-50">
                        Capacitación
                        <svg :class="open ? 'rotate-180' : ''" class="w-3 h-3 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="absolute top-full left-0 mt-1 w-64 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                        <a href="{{ url('/cursos/online') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700 hover:text-[#1B4DB7]">
                            <span class="text-base">🖥</span> Cursos Online
                        </a>
                        <a href="{{ url('/cursos/virtuales') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700 hover:text-[#1B4DB7]">
                            <span class="text-base">👥</span> Cursos Virtuales
                        </a>
                        <a href="{{ url('/cursos/presenciales') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700 hover:text-[#1B4DB7]">
                            <span class="text-base">🏢</span> Cursos Presenciales
                        </a>
                        <div class="my-1 border-t border-gray-100"></div>
                        <a href="{{ url('/campus') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 transition-colors text-sm font-semibold text-[#1B4DB7]">
                            <span class="text-base">📚</span> Ver campus →
                        </a>
                    </div>
                </div>

                {{-- Dropdown: Servicios --}}
                <div class="relative" x-data="{ open: false, t: null }"
                     @mouseenter="clearTimeout(t); open = true" @mouseleave="t = setTimeout(() => open = false, 120)">
                    <button class="nav-link flex items-center gap-1 px-3 py-2 rounded-lg text-sm hover:bg-gray-50">
                        Servicios
                        <svg :class="open ? 'rotate-180' : ''" class="w-3 h-3 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="absolute top-full left-0 mt-1 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                        <a href="{{ url('/servicios/consultoria') }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700 hover:text-[#1B4DB7]">Consultoría</a>
                        <a href="{{ url('/servicios/implementacion') }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700 hover:text-[#1B4DB7]">Implementación</a>
                        <a href="{{ url('/servicios/soporte-tecnico') }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700 hover:text-[#1B4DB7]">Soporte Técnico</a>
                    </div>
                </div>

                {{-- Dropdown: Nosotros --}}
                <div class="relative" x-data="{ open: false, t: null }"
                     @mouseenter="clearTimeout(t); open = true" @mouseleave="t = setTimeout(() => open = false, 120)">
                    <button class="nav-link flex items-center gap-1 px-3 py-2 rounded-lg text-sm hover:bg-gray-50">
                        Nosotros
                        <svg :class="open ? 'rotate-180' : ''" class="w-3 h-3 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="absolute top-full left-0 mt-1 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                        <a href="{{ url('/nosotros') }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700 hover:text-[#1B4DB7]">Quiénes somos</a>
                        <a href="{{ url('/instructores') }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700 hover:text-[#1B4DB7]">Nuestros instructores</a>
                        <a href="{{ url('/centros-capacitacion') }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700 hover:text-[#1B4DB7]">Centros de capacitación</a>
                        <a href="{{ url('/club-logia') }}" class="block px-4 py-3 hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700 hover:text-[#1B4DB7]">Club Logia</a>
                    </div>
                </div>

                {{-- Blog - directo --}}
                <a href="{{ url('/blog') }}" class="nav-link px-3 py-2 rounded-lg text-sm hover:bg-gray-50">Blog</a>
            </nav>

            {{-- CTA Desktop --}}
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    <a href="{{ url('/campus') }}" class="btn-outline text-xs px-4 py-2">Mi Campus</a>
                @else
                    <a href="{{ route('filament.admin.auth.login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 px-3 py-2">Iniciar sesión</a>
                @endauth
                <a href="{{ route('booking') }}" class="btn-primary text-xs px-5 py-2.5">Agendar sesión gratuita</a>
            </div>

            {{-- Hamburger mobile --}}
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors" :aria-expanded="mobileOpen.toString()" aria-label="Menú">
                <svg x-show="!mobileOpen" class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen" style="display:none" class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display:none" class="lg:hidden border-t border-gray-100 bg-white max-h-[80vh] overflow-y-auto">
        <div class="container-brand px-4 py-4 space-y-1">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 py-2">Productos</p>
            <a href="{{ url('/productos/siigo-aspel') }}" class="flex items-center gap-3 py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50"><span class="w-2 h-2 rounded-full shrink-0" style="background:#1B4DB7"></span>Siigo Aspel</a>
            <a href="{{ url('/productos/soft-restaurant') }}" class="flex items-center gap-3 py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50"><span class="w-2 h-2 rounded-full shrink-0" style="background:#E8500A"></span>Soft-Restaurant</a>
            <a href="{{ url('/productos/zoho-one') }}" class="flex items-center gap-3 py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50"><span class="w-2 h-2 rounded-full shrink-0" style="background:#C8202C"></span>Zoho One</a>
            <div class="border-t border-gray-100 my-2"></div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 py-2">Capacitación</p>
            <a href="{{ url('/cursos/online') }}" class="block py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Cursos Online</a>
            <a href="{{ url('/cursos/virtuales') }}" class="block py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Cursos Virtuales</a>
            <a href="{{ url('/cursos/presenciales') }}" class="block py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Cursos Presenciales</a>
            <div class="border-t border-gray-100 my-2"></div>
            <a href="{{ url('/servicios/consultoria') }}" class="block py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Consultoría</a>
            <a href="{{ url('/nosotros') }}" class="block py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Nosotros</a>
            <a href="{{ url('/instructores') }}" class="block py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Instructores</a>
            <a href="{{ url('/blog') }}" class="block py-2.5 px-3 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Blog</a>
            <div class="pt-3 pb-2 flex flex-col gap-2">
                @auth
                    <a href="{{ url('/campus') }}" class="btn-outline text-center">Mi Campus</a>
                @else
                    <a href="{{ route('filament.admin.auth.login') }}" class="btn-outline text-center">Iniciar sesión</a>
                @endauth
                <a href="{{ route('booking') }}" class="btn-primary text-center">Agendar sesión gratuita</a>
            </div>
        </div>
    </div>
</header>
