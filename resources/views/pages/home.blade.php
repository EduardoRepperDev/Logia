@extends('layouts.app')

@section('title', 'Logia Consulting — Partner Siigo Aspel, Soft-Restaurant y Zoho One en México')
@section('meta_description', 'Capacitación certificada y consultoría en Siigo Aspel, Soft Restaurant y Zoho One. Cursos online, virtuales y presenciales con instructores certificados en México.')
@section('theme_class', '')
@section('robots', 'index,follow')
@section('og_title', 'Logia Consulting — Partner oficial en México')
@section('og_description', 'Capacítate con los mejores en Siigo, Soft Restaurant y Zoho One. Certificaciones, consultoría y soporte para tu empresa.')

@push('styles')
<link rel="canonical" href="{{ url('/') }}">
@endpush

@push('styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Logia Consulting",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('images/logo.png') }}",
  "description": "Partner oficial de Siigo Aspel, Soft Restaurant y Zoho One en México. Capacitación certificada y consultoría empresarial.",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+52-55-1234-5678",
    "contactType": "customer service",
    "areaServed": "MX",
    "availableLanguage": "Spanish"
  },
  "sameAs": [
    "https://www.facebook.com/logiaconsulting",
    "https://www.linkedin.com/company/logiaconsulting",
    "https://www.instagram.com/logiaconsulting"
  ]
}
</script>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════════
     HERO — headline, subheadline, 3 CTAs por producto
════════════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden min-h-screen flex items-center" style="background: linear-gradient(145deg, #080F1E 0%, #0D1B3E 45%, #10264F 100%)">

    {{-- Blur blobs decorativos --}}
    <div class="absolute top-0 left-0 w-[600px] h-[600px] rounded-full opacity-20 blur-3xl pointer-events-none" style="background: radial-gradient(circle, #1B4DB7 0%, transparent 70%); transform: translate(-30%, -30%)"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] rounded-full opacity-15 blur-3xl pointer-events-none" style="background: radial-gradient(circle, #3B6FE0 0%, transparent 70%); transform: translate(30%, 30%)"></div>
    <div class="absolute top-1/2 left-1/2 w-[300px] h-[300px] rounded-full opacity-10 blur-2xl pointer-events-none" style="background: radial-gradient(circle, #E8500A 0%, transparent 70%); transform: translate(-50%, -50%)"></div>

    <div class="container-brand section-padded relative z-10 py-28">
        <div class="max-w-4xl mx-auto text-center">

            {{-- Eyebrow --}}
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-2 mb-8 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                <span class="text-white/80 text-xs font-medium tracking-wider uppercase">Partner Certificado en México</span>
            </div>

            {{-- Headline --}}
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-[1.1] tracking-tight mb-6">
                Domina el software que
                <br>
                <span class="relative inline-block">
                    <span class="bg-gradient-to-r from-blue-400 via-blue-300 to-indigo-300 bg-clip-text text-transparent">impulsa tu empresa</span>
                    <svg class="absolute -bottom-2 left-0 w-full h-2 opacity-50" viewBox="0 0 300 8" fill="none"><path d="M0 6 Q75 1 150 5 Q225 9 300 4" stroke="url(#grad1)" stroke-width="2.5" stroke-linecap="round"/><defs><linearGradient id="grad1" x1="0" x2="300" y1="0" y2="0"><stop offset="0%" stop-color="#60A5FA"/><stop offset="100%" stop-color="#818CF8"/></linearGradient></defs></svg>
                </span>
            </h1>

            {{-- Subheadline --}}
            <p class="text-lg sm:text-xl text-white/65 leading-relaxed max-w-2xl mx-auto mb-12">
                Capacitación certificada, consultoría especializada y soporte continuo en
                <strong class="text-white/90 font-semibold">Siigo</strong>,
                <strong class="text-white/90 font-semibold">Soft Restaurant</strong> y
                <strong class="text-white/90 font-semibold">Zoho One</strong>.
                Más de 500 empresas en México confían en Logia.
            </p>

            {{-- 3 CTAs por producto --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                {{-- Siigo — azul --}}
                <a href="{{ url('/siigo') }}"
                   class="group relative flex items-center gap-3 px-6 py-4 rounded-xl font-semibold text-sm text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl min-w-[190px] justify-center"
                   style="background: linear-gradient(135deg, #1B4DB7, #3B6FE0); box-shadow: 0 4px 20px rgba(27,77,183,0.5)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Cursos Siigo
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                {{-- Soft Restaurant — naranja --}}
                <a href="{{ url('/soft') }}"
                   class="group relative flex items-center gap-3 px-6 py-4 rounded-xl font-semibold text-sm text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl min-w-[190px] justify-center"
                   style="background: linear-gradient(135deg, #C44508, #FF6B2B); box-shadow: 0 4px 20px rgba(232,80,10,0.5)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    Soft Restaurant
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>

                {{-- Zoho One — rojo --}}
                <a href="{{ url('/zoho') }}"
                   class="group relative flex items-center gap-3 px-6 py-4 rounded-xl font-semibold text-sm text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl min-w-[190px] justify-center"
                   style="background: linear-gradient(135deg, #A81A25, #E8404C); box-shadow: 0 4px 20px rgba(200,32,44,0.5)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Zoho One
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Social proof --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mt-14 pt-10 border-t border-white/10">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">500+</div>
                    <div class="text-xs text-white/50 mt-1">Empresas capacitadas</div>
                </div>
                <div class="hidden sm:block w-px h-10 bg-white/15"></div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">10+</div>
                    <div class="text-xs text-white/50 mt-1">Años de experiencia</div>
                </div>
                <div class="hidden sm:block w-px h-10 bg-white/15"></div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">98%</div>
                    <div class="text-xs text-white/50 mt-1">Tasa de satisfacción</div>
                </div>
                <div class="hidden sm:block w-px h-10 bg-white/15"></div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">3</div>
                    <div class="text-xs text-white/50 mt-1">Partners oficiales</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce opacity-50">
        <span class="text-white/40 text-xs tracking-widest uppercase">Scroll</span>
        <svg class="w-4 h-4 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     SECCIÓN: Nuestras Soluciones — 3 product cards
════════════════════════════════════════════════════════════ --}}
<section id="soluciones" class="section-padded bg-white">
    <div class="container-brand">

        {{-- Header de sección --}}
        <div class="text-center mb-16">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-blue-600 mb-3">Nuestras soluciones</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Tres plataformas. Un solo partner.</h2>
            <p class="text-gray-500 max-w-xl mx-auto text-base leading-relaxed">Somos el único partner en México con capacitación certificada oficial en los tres sistemas más adoptados por PyMEs y restaurantes.</p>
            <div class="flex justify-center mt-5">
                <div class="w-12 h-1 rounded-full bg-gradient-to-r from-blue-600 to-indigo-500"></div>
            </div>
        </div>

        {{-- Product cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Card Siigo --}}
            <article class="theme-siigo group relative flex flex-col rounded-2xl overflow-hidden border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="p-8 pb-6" style="background: linear-gradient(135deg, #1B4DB7 0%, #3B6FE0 100%)">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-xl mb-2">Siigo</h3>
                    <p class="text-blue-100 text-sm leading-relaxed">ERP contable líder en México para contadores, CFOs y PyMEs que necesitan eficiencia fiscal y administrativa.</p>
                </div>
                <div class="p-8 pt-6 flex flex-col flex-1 bg-white">
                    <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Contabilidad y facturación CFDI 4.0</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Nómina y recursos humanos</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Inventarios y punto de venta</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Certificación oficial Siigo Aspel</li>
                    </ul>
                    <a href="{{ url('/siigo') }}" class="inline-flex items-center justify-center gap-2 font-semibold text-sm py-3 px-6 rounded-xl text-white transition-all duration-200 group-hover:gap-3" style="background: linear-gradient(135deg, #1B4DB7, #3B6FE0)">
                        Ver cursos Siigo
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </article>

            {{-- Card Soft Restaurant --}}
            <article class="theme-soft group relative flex flex-col rounded-2xl overflow-hidden border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 md:-mt-4 md:scale-[1.03] z-10">
                <div class="absolute top-4 right-4 z-20">
                    <span class="text-xs font-bold text-white bg-white/25 backdrop-blur-sm px-3 py-1 rounded-full border border-white/30">Más popular</span>
                </div>
                <div class="p-8 pb-6" style="background: linear-gradient(135deg, #C44508 0%, #FF6B2B 100%)">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-xl mb-2">Soft Restaurant</h3>
                    <p class="text-orange-100 text-sm leading-relaxed">Sistema lider en gestión de restaurantes, bares y hoteles. Control total de mesa, cocina y reportes.</p>
                </div>
                <div class="p-8 pt-6 flex flex-col flex-1 bg-white">
                    <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Punto de venta para restaurantes</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Control de mesas y comanda digital</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Recetas, costos e inventario</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Delivery y apps externas</li>
                    </ul>
                    <a href="{{ url('/soft') }}" class="inline-flex items-center justify-center gap-2 font-semibold text-sm py-3 px-6 rounded-xl text-white transition-all duration-200 group-hover:gap-3" style="background: linear-gradient(135deg, #C44508, #FF6B2B)">
                        Ver cursos Soft Restaurant
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </article>

            {{-- Card Zoho One --}}
            <article class="theme-zoho group relative flex flex-col rounded-2xl overflow-hidden border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="p-8 pb-6" style="background: linear-gradient(135deg, #A81A25 0%, #E8404C 100%)">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-white font-bold text-xl mb-2">Zoho One</h3>
                    <p class="text-red-100 text-sm leading-relaxed">Suite empresarial completa: CRM, proyectos, RRHH, marketing y más de 45 apps integradas para escalar tu negocio.</p>
                </div>
                <div class="p-8 pt-6 flex flex-col flex-1 bg-white">
                    <ul class="space-y-3 text-sm text-gray-600 mb-8 flex-1">
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>CRM y automatización de ventas</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Marketing y campañas digitales</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Gestión de proyectos y RRHH</li>
                        <li class="flex items-center gap-3"><svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Certificación Zoho Authorized Partner</li>
                    </ul>
                    <a href="{{ url('/zoho') }}" class="inline-flex items-center justify-center gap-2 font-semibold text-sm py-3 px-6 rounded-xl text-white transition-all duration-200 group-hover:gap-3" style="background: linear-gradient(135deg, #A81A25, #E8404C)">
                        Ver cursos Zoho One
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </article>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     SECCIÓN: Por qué Logia — 4 valores diferenciales
════════════════════════════════════════════════════════════ --}}
<section id="por-que-logia" class="section-padded" style="background: #F8FAFC">
    <div class="container-brand">

        <div class="text-center mb-16">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-blue-600 mb-3">Por qué elegirnos</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Lo que nos hace diferentes</h2>
            <p class="text-gray-500 max-w-xl mx-auto text-base leading-relaxed">No somos solo capacitadores. Somos el partner estratégico que acompaña a tu empresa en cada etapa.</p>
            <div class="flex justify-center mt-5"><div class="w-12 h-1 rounded-full bg-gradient-to-r from-blue-600 to-indigo-500"></div></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            @php
            $valores = [
                [
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
                    'color' => 'from-blue-500 to-blue-700',
                    'title' => 'Certificación oficial',
                    'desc'  => 'Instructores certificados directamente por Siigo, Soft Restaurant y Zoho. Garantía de conocimiento real y actualizado.',
                ],
                [
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>',
                    'color' => 'from-purple-500 to-purple-700',
                    'title' => 'Formación a medida',
                    'desc'  => 'Diseñamos rutas de aprendizaje según el sector, tamaño y objetivos de tu empresa. Sin material genérico.',
                ],
                [
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                    'color' => 'from-orange-500 to-orange-700',
                    'title' => 'Resultados rápidos',
                    'desc'  => 'Metodología práctica con casos reales. Tu equipo opera con autonomía desde la primera semana de capacitación.',
                ],
                [
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>',
                    'color' => 'from-green-500 to-green-700',
                    'title' => 'Soporte continuo',
                    'desc'  => 'Acompañamiento post-capacitación, sesiones de soporte y acceso a materiales actualizados de por vida.',
                ],
            ];
            @endphp

            @foreach($valores as $valor)
            <div class="group text-center p-8 rounded-2xl bg-white border border-gray-100 hover:border-gray-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $valor['color'] }} flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $valor['icon'] !!}</svg>
                </div>
                <h3 class="text-gray-900 font-bold text-base mb-3">{{ $valor['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $valor['desc'] }}</p>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     SECCIÓN: Cómo trabajamos — 3 pasos
════════════════════════════════════════════════════════════ --}}
<section id="como-trabajamos" class="section-padded bg-white">
    <div class="container-brand">

        <div class="text-center mb-16">
            <span class="inline-block text-xs font-semibold tracking-widest uppercase text-blue-600 mb-3">Nuestro proceso</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Así trabajamos contigo</h2>
            <p class="text-gray-500 max-w-xl mx-auto text-base leading-relaxed">Un proceso simple y probado que garantiza resultados desde el primer día.</p>
            <div class="flex justify-center mt-5"><div class="w-12 h-1 rounded-full bg-gradient-to-r from-blue-600 to-indigo-500"></div></div>
        </div>

        <div class="relative">
            {{-- Línea conectora (escritorio) --}}
            <div class="hidden lg:block absolute top-12 left-1/6 right-1/6 h-px bg-gradient-to-r from-blue-200 via-indigo-300 to-purple-200 z-0" style="left: 16.67%; right: 16.67%;"></div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 relative z-10">

                @php
                $pasos = [
                    [
                        'num'   => '01',
                        'color' => 'from-blue-500 to-blue-700',
                        'ring'  => 'ring-blue-200',
                        'title' => 'Diagnóstico gratuito',
                        'desc'  => 'Analizamos el nivel actual de tu equipo, los procesos de tu empresa y definimos juntos los objetivos de capacitación.',
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>',
                    ],
                    [
                        'num'   => '02',
                        'color' => 'from-indigo-500 to-purple-700',
                        'ring'  => 'ring-indigo-200',
                        'title' => 'Plan personalizado',
                        'desc'  => 'Diseñamos un programa de capacitación a la medida: modalidad, horarios, nivel y casos de uso específicos de tu sector.',
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
                    ],
                    [
                        'num'   => '03',
                        'color' => 'from-purple-500 to-pink-600',
                        'ring'  => 'ring-purple-200',
                        'title' => 'Capacitación y certificación',
                        'desc'  => 'Tus colaboradores se forman con instructores certificados y obtienen constancias oficiales. Nosotros medimos el impacto.',
                        'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
                    ],
                ];
                @endphp

                @foreach($pasos as $paso)
                <div class="flex flex-col items-center text-center group">
                    <div class="relative w-24 h-24 mb-8">
                        <div class="absolute inset-0 rounded-full ring-8 {{ $paso['ring'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br {{ $paso['color'] }} flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $paso['icon'] !!}</svg>
                        </div>
                        <span class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-white border-2 border-gray-100 flex items-center justify-center text-xs font-bold text-gray-700 shadow-sm">{{ $paso['num'] }}</span>
                    </div>
                    <h3 class="text-gray-900 font-bold text-lg mb-3">{{ $paso['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-xs">{{ $paso['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════
     CTA FINAL — Agenda tu consulta gratis
════════════════════════════════════════════════════════════ --}}
<section id="agenda" class="relative overflow-hidden section-padded py-24" style="background: linear-gradient(135deg, #0D1B3E 0%, #1B4DB7 60%, #3B6FE0 100%)">

    {{-- Decoración --}}
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(circle at 25% 50%, white 1px, transparent 1px), radial-gradient(circle at 75% 50%, white 1px, transparent 1px); background-size: 60px 60px;"></div>

    <div class="container-brand relative z-10 text-center">
        <div class="max-w-2xl mx-auto">

            <div class="inline-flex items-center gap-2 bg-white/15 border border-white/25 rounded-full px-5 py-2 mb-8">
                <svg class="w-4 h-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="text-white/80 text-xs font-semibold tracking-wide">100% gratuito · Sin compromiso</span>
            </div>

            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                ¿Listo para llevar tu empresa<br>al siguiente nivel?
            </h2>
            <p class="text-white/70 text-lg leading-relaxed mb-10">
                Agenda una sesión de consulta gratuita de 30 minutos con uno de nuestros expertos. Analizaremos tus necesidades y te recomendaremos el mejor camino.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('booking') }}"
                   class="group inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-white font-bold text-base transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                   style="color: #1B4DB7">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Agenda tu consulta gratis
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
                <a href="https://wa.me/525512345678" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl border-2 border-white/30 text-white font-semibold text-base transition-all duration-300 hover:bg-white/10 hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Escríbenos por WhatsApp
                </a>
            </div>

            <p class="text-white/40 text-xs mt-8">
                Respondemos en menos de 2 horas · Lunes a viernes 9am–7pm CST
            </p>
        </div>
    </div>
</section>

@endsection
