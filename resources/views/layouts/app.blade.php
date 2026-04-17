<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="@yield('robots', 'index,follow')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Capacitación Profesional') | Logia Consulting</title>
    <meta name="description" content="@yield('meta_description', 'Logia Consulting — Capacitación certificada en Siigo, Soft Restaurant y Zoho One.')">

    {{-- OG Tags --}}
    <meta property="og:type"        content="website">
    <meta property="og:site_name"   content="Logia Consulting">
    <meta property="og:title"       content="@yield('og_title', 'Logia Consulting')">
    <meta property="og:description" content="@yield('og_description', 'Capacitación certificada en Siigo, Soft Restaurant y Zoho One.')">
    <meta property="og:image"       content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:url"         content="@yield('og_url', url()->current())">

    {{-- Twitter Cards --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="@yield('og_title', 'Logia Consulting')">
    <meta name="twitter:description" content="@yield('og_description', 'Capacitación certificada en Siigo, Soft Restaurant y Zoho One.')">
    <meta name="twitter:image"       content="@yield('og_image', asset('images/og-default.jpg'))">

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300..800;1,14..32,300..800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @stack('styles')
</head>
<body class="@yield('theme_class', 'theme-siigo') font-sans antialiased bg-white text-neutral-900 pt-[72px]">

    @include('partials.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('partials.footer')

    @livewireScripts
    @stack('scripts')
</body>
</html>
