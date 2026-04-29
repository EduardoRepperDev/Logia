<!doctype html>
<html lang="es-MX" data-brand="{{ $brand ?? 'logia' }}"
      x-data="shell()" :data-brand="brand" :data-theme="dark ? 'dark' : 'light'">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Logia Consulting') | Logia Consulting</title>
    <meta name="description" content="@yield('meta_description', 'Partner oficial de Siigo Aspel, Soft Restaurant y Zoho One en México.')">
    <meta name="robots" content="@yield('robots', 'index,follow')">

    {{-- OG --}}
    <meta property="og:type"        content="website">
    <meta property="og:site_name"   content="Logia Consulting">
    <meta property="og:title"       content="@yield('og_title', 'Logia Consulting')">
    <meta property="og:description" content="@yield('og_description', 'Partner oficial de Siigo Aspel, Soft Restaurant y Zoho One en México.')">
    <meta property="og:url"         content="{{ url()->current() }}">

    @vite(['resources/css/marketing.css', 'resources/js/marketing.js'])
    @livewireStyles
    @stack('head')
</head>
<body>

{{-- ── NAVBAR ─────────────────────────────────────────────────────────────── --}}
<header data-brand="logia" class="c-navbar" style="top:0">
    <div class="c-navbar__inner">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="c-navbar__brand" aria-label="Ir al inicio de Logia Consulting">
            <img src="{{ asset('images/Original_Logo_Logia_Consulting.png') }}" alt="Logia Consulting">
        </a>

        {{-- Nav Desktop --}}
        <nav class="c-navbar__menu" aria-label="Navegación principal">
            <button class="c-navbar__menu-item"
                    @click="megaOpen = !megaOpen"
                    :aria-expanded="megaOpen.toString()">
                Productos
                <svg viewBox="0 0 12 12" aria-hidden="true">
                    <path d="M2 4 L6 8 L10 4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <a href="{{ url('/servicios') }}" class="c-navbar__menu-item" style="text-decoration:none;color:inherit">Servicios</a>
            <a href="{{ url('/campus') }}" class="c-navbar__menu-item" style="text-decoration:none;color:inherit">Campus</a>
            <a href="{{ url('/soporte') }}" class="c-navbar__menu-item" style="text-decoration:none;color:inherit">Soporte</a>
            <a href="{{ url('/blog') }}" class="c-navbar__menu-item" style="text-decoration:none;color:inherit">Blog</a>
            <a href="{{ url('/nosotros') }}" class="c-navbar__menu-item" style="text-decoration:none;color:inherit">Nosotros</a>
        </nav>

        {{-- CTAs --}}
        <div class="c-navbar__actions">
            <button class="c-navbar__search" aria-label="Buscar cursos, productos…">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
                    <path d="m21 21-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
                Buscar cursos, productos…
                <kbd>⌘K</kbd>
            </button>
            <a href="{{ route('filament.admin.auth.login') }}" class="c-btn c-btn--ghost c-btn--sm">Ingresar</a>
            <a href="{{ route('booking') }}" class="c-btn c-btn--sm">Agendar</a>
        </div>
    </div>

    {{-- MegaMenu --}}
    @include('partials.mega-menu')
</header>

{{-- ── MAIN ─────────────────────────────────────────────────────────────────── --}}
@yield('content')

{{-- ── FOOTER ───────────────────────────────────────────────────────────────── --}}
<footer data-brand="logia" class="c-footer">
    <div class="container">
        <div class="c-footer__grid">

            {{-- Marca --}}
            <div class="c-footer__brand">
                <img src="{{ asset('images/Original_Logo_Logia_Consulting.png') }}" alt="Logia Consulting">
                <p>Integrando tecnología y crecimiento empresarial. Partner oficial de Siigo Aspel, Soft Restaurant, Zoho One y Microsoft 365 en México.</p>
                <div class="c-footer__offices">
                    <span><b>WTC CDMX</b> · Piso 14</span>
                    <span><b>Coapa</b> · Av. Canal 1402</span>
                    <span><b>Polanco</b> · Masaryk 214</span>
                </div>
            </div>

            {{-- Productos --}}
            <div>
                <h5>Productos</h5>
                <ul>
                    <li><a href="{{ route('partner.aspel') }}">Siigo Aspel</a></li>
                    <li><a href="{{ route('partner.soft') }}">Soft Restaurant</a></li>
                    <li><a href="{{ route('partner.zoho') }}">Zoho One</a></li>
                    <li><a href="{{ route('partner.microsoft') }}">Microsoft 365</a></li>
                </ul>
            </div>

            {{-- Campus --}}
            <div>
                <h5>Campus</h5>
                <ul>
                    <li><a href="#">Cursos certificados</a></li>
                    <li><a href="#">Aula virtual</a></li>
                    <li><a href="#">Certificados DC-3</a></li>
                    <li><a href="#">Planes empresa</a></li>
                </ul>
            </div>

            {{-- Soporte --}}
            <div>
                <h5>Soporte</h5>
                <ul>
                    <li><a href="#">En sitio · CDMX</a></li>
                    <li><a href="#">Remoto 24/7</a></li>
                    <li><a href="#">Mesa de ayuda</a></li>
                    <li><a href="#">SLA empresariales</a></li>
                </ul>
            </div>

            {{-- Logia --}}
            <div>
                <h5>Logia</h5>
                <ul>
                    <li><a href="{{ url('/nosotros') }}">Nosotros</a></li>
                    <li><a href="#">Casos de éxito</a></li>
                    <li><a href="{{ url('/blog') }}">Blog</a></li>
                    <li><a href="{{ url('/contacto') }}">Contacto</a></li>
                </ul>
            </div>
        </div>

        <div class="c-footer__bottom">
            <span>&copy; {{ date('Y') }} Logia Consulting · RFC LOG920410XX1 · Todos los derechos reservados</span>
            <span>Aviso de privacidad · Términos</span>
        </div>
    </div>
</footer>

@livewireScripts
@stack('scripts')
</body>
</html>
