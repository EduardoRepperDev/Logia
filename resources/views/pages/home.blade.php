@extends('layouts.app')

@section('title', 'Logia Consulting — Partner Siigo Aspel, Soft-Restaurant y Zoho One en México')
@section('meta_description', 'Capacitación certificada y consultoría en Siigo Aspel, Soft Restaurant y Zoho One. Cursos online, virtuales y presenciales con instructores certificados en México.')
@section('theme_class', '')
@section('robots', 'index,follow')
@section('og_title', 'Logia Consulting — Partner oficial en México')
@section('og_description', 'Capacítate con los mejores en Siigo, Soft Restaurant y Zoho One. Certificaciones, consultoría y soporte para tu empresa.')

@push('styles')
<link rel="canonical" href="{{ url('/') }}">
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
<style>
/* Hero carousel */
.hero-slide{position:absolute;inset:0;display:flex;align-items:center;opacity:0;transform:translateY(14px);transition:opacity .85s cubic-bezier(.22,1,.36,1),transform .85s cubic-bezier(.22,1,.36,1)}
.hero-slide--active{opacity:1;transform:translateY(0);z-index:2}
@keyframes lc-float{0%,100%{transform:translateY(0) rotate(0deg)}50%{transform:translateY(-16px) rotate(2deg)}}
@keyframes lc-ring{0%{transform:scale(.85);opacity:.65}100%{transform:scale(1.75);opacity:0}}
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════ HERO — Carousel auto-rotante 4 slides ══ --}}
<section class="relative overflow-hidden"
    style="min-height:calc(100vh - 72px);background:#080F1E"
    x-data="{
        c: 0,
        paused: false,
        timer: null,
        start() { this.timer = setInterval(() => { if (!this.paused) this.c = (this.c + 1) % 4; }, 6000); },
        go(i) { this.c = i; },
        prev() { this.c = (this.c - 1 + 4) % 4; },
        next() { this.c = (this.c + 1) % 4; }
    }"
    x-init="start()"
    @mouseenter="paused = true"
    @mouseleave="paused = false">

    {{-- ── SLIDE 0: Logia brand — naranja ────────────────────────────────── --}}
    <div class="hero-slide" :class="c===0 ? 'hero-slide--active' : 'pointer-events-none'">
        <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 55% 70% at 72% 50%,rgba(232,80,10,0.15) 0%,transparent 70%)"></div>
        <div class="container-brand w-full px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center gap-8 lg:gap-14 py-20 lg:py-0">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2.5 mb-7">
                        <span class="block w-1 h-6 rounded-full shrink-0" style="background:#E8500A"></span>
                        <span class="text-[11px] font-bold tracking-[0.2em] uppercase" style="color:#E8500A">Partner Certificado en México</span>
                    </div>
                    <h1 class="font-black text-white tracking-tight mb-6 leading-[0.93]" style="font-size:clamp(2.8rem,6.5vw,5.2rem)">
                        Integramos<br>
                        <span style="color:#E8500A">tecnología</span><br>
                        y crecimiento.
                    </h1>
                    <p class="text-white/50 leading-relaxed mb-9 max-w-md" style="font-size:clamp(0.875rem,1.4vw,1.05rem)">
                        Partner oficial de Siigo Aspel, Soft&#8209;Restaurant y Zoho One. Capacitación, implementación y soporte especializado en México.
                    </p>
                    <div class="flex items-center gap-4 flex-wrap">
                        <a href="{{ url('/productos') }}" class="inline-flex items-center gap-3 font-bold text-white rounded-2xl transition-all duration-200 hover:-translate-y-0.5"
                           style="background:#E8500A;padding:0.9rem 1.75rem;font-size:0.875rem;box-shadow:0 8px 28px rgba(232,80,10,0.42)">
                            Conoce nuestras soluciones
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('booking') }}" class="text-sm font-semibold text-white/45 hover:text-white/80 transition-colors underline underline-offset-4 decoration-white/20">
                            Agendar sesión gratuita →
                        </a>
                    </div>
                </div>
                <div class="hidden lg:flex items-center justify-center relative shrink-0" style="width:360px;height:400px">
                    <div class="absolute rounded-full blur-3xl opacity-12" style="width:240px;height:240px;background:#E8500A"></div>
                    <div class="absolute rounded-full border" style="width:290px;height:290px;border-color:rgba(232,80,10,0.22);animation:lc-ring 4.5s ease-out infinite"></div>
                    <div class="absolute rounded-full border" style="width:196px;height:196px;border-color:rgba(232,80,10,0.38);animation:lc-ring 4.5s ease-out infinite 1.8s"></div>
                    <div class="relative flex items-center justify-center rounded-3xl" style="width:104px;height:104px;background:rgba(232,80,10,0.14);border:1px solid rgba(232,80,10,0.42);animation:lc-float 5s ease-in-out infinite">
                        <span class="font-black text-4xl select-none" style="color:#E8500A">LC</span>
                    </div>
                    <div class="absolute top-10 right-8 rounded-xl px-3 py-1.5 text-xs font-semibold" style="background:rgba(255,255,255,0.05);border:1px solid rgba(232,80,10,0.28);color:#E8500A;animation:lc-float 6s ease-in-out infinite 1s">500+ Empresas</div>
                    <div class="absolute bottom-14 left-6 rounded-xl px-3 py-1.5 text-xs font-semibold" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.32);animation:lc-float 7s ease-in-out infinite 2s">12+ Años de experiencia</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── SLIDE 1: Siigo Aspel — azul ───────────────────────────────────── --}}
    <div class="hero-slide" :class="c===1 ? 'hero-slide--active' : 'pointer-events-none'">
        <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 55% 70% at 72% 50%,rgba(27,77,183,0.18) 0%,transparent 70%)"></div>
        <div class="container-brand w-full px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center gap-8 lg:gap-14 py-20 lg:py-0">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2.5 mb-7">
                        <span class="block w-1 h-6 rounded-full shrink-0" style="background:#1B4DB7"></span>
                        <span class="text-[11px] font-bold tracking-[0.2em] uppercase" style="color:#3B6FE0">Siigo Aspel</span>
                    </div>
                    <h1 class="font-black text-white tracking-tight mb-6 leading-[0.93]" style="font-size:clamp(2.8rem,6.5vw,5.2rem)">
                        Contabilidad<br>
                        <span style="color:#3B6FE0">sin límites</span><br>
                        para tu PYME.
                    </h1>
                    <p class="text-white/50 leading-relaxed mb-9 max-w-md" style="font-size:clamp(0.875rem,1.4vw,1.05rem)">
                        SAE, COI, NOI, CAJA, FACTURE, BANCO — el ecosistema Aspel completo con implementación y soporte certificado.
                    </p>
                    <div class="flex items-center gap-4 flex-wrap">
                        <a href="{{ url('/productos/siigo-aspel') }}" class="inline-flex items-center gap-3 font-bold text-white rounded-2xl transition-all duration-200 hover:-translate-y-0.5"
                           style="background:#1B4DB7;padding:0.9rem 1.75rem;font-size:0.875rem;box-shadow:0 8px 28px rgba(27,77,183,0.45)">
                            Ver productos Siigo
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('booking') }}" class="text-sm font-semibold text-white/45 hover:text-white/80 transition-colors underline underline-offset-4 decoration-white/20">
                            Solicitar demo →
                        </a>
                    </div>
                </div>
                <div class="hidden lg:flex items-center justify-center relative shrink-0" style="width:360px;height:400px">
                    <div class="absolute rounded-full blur-3xl opacity-12" style="width:240px;height:240px;background:#1B4DB7"></div>
                    <div class="absolute rounded-full border" style="width:290px;height:290px;border-color:rgba(27,77,183,0.22);animation:lc-ring 4.5s ease-out infinite"></div>
                    <div class="absolute rounded-full border" style="width:196px;height:196px;border-color:rgba(27,77,183,0.38);animation:lc-ring 4.5s ease-out infinite 1.8s"></div>
                    <div class="relative flex items-center justify-center rounded-3xl" style="width:104px;height:104px;background:rgba(27,77,183,0.14);border:1px solid rgba(27,77,183,0.42);animation:lc-float 5s ease-in-out infinite">
                        <span class="font-black text-4xl select-none" style="color:#3B6FE0">SA</span>
                    </div>
                    <div class="absolute top-10 right-8 rounded-xl px-3 py-1.5 text-xs font-semibold" style="background:rgba(255,255,255,0.05);border:1px solid rgba(27,77,183,0.28);color:#3B6FE0;animation:lc-float 6s ease-in-out infinite 1s">SAE · COI · NOI · BANCO</div>
                    <div class="absolute bottom-14 left-6 rounded-xl px-3 py-1.5 text-xs font-semibold" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.32);animation:lc-float 7s ease-in-out infinite 2s">Licencias Oficiales MX</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── SLIDE 2: Soft-Restaurant — naranja ────────────────────────────── --}}
    <div class="hero-slide" :class="c===2 ? 'hero-slide--active' : 'pointer-events-none'">
        <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 55% 70% at 72% 50%,rgba(232,80,10,0.15) 0%,transparent 70%)"></div>
        <div class="container-brand w-full px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center gap-8 lg:gap-14 py-20 lg:py-0">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2.5 mb-7">
                        <span class="block w-1 h-6 rounded-full shrink-0" style="background:#E8500A"></span>
                        <span class="text-[11px] font-bold tracking-[0.2em] uppercase" style="color:#E8500A">Soft-Restaurant</span>
                    </div>
                    <h1 class="font-black text-white tracking-tight mb-6 leading-[0.93]" style="font-size:clamp(2.8rem,6.5vw,5.2rem)">
                        Tu restaurante,<br>
                        siempre en<br>
                        <span style="color:#E8500A">control.</span>
                    </h1>
                    <p class="text-white/50 leading-relaxed mb-9 max-w-md" style="font-size:clamp(0.875rem,1.4vw,1.05rem)">
                        Sistema integral de punto de venta, cocina, inventarios y reportes para Food &amp; Beverage en México.
                    </p>
                    <div class="flex items-center gap-4 flex-wrap">
                        <a href="{{ url('/productos/soft-restaurant') }}" class="inline-flex items-center gap-3 font-bold text-white rounded-2xl transition-all duration-200 hover:-translate-y-0.5"
                           style="background:linear-gradient(135deg,#C44508,#E8500A);padding:0.9rem 1.75rem;font-size:0.875rem;box-shadow:0 8px 28px rgba(232,80,10,0.42)">
                            Explorar Soft-Restaurant
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('booking') }}" class="text-sm font-semibold text-white/45 hover:text-white/80 transition-colors underline underline-offset-4 decoration-white/20">
                            Solicitar demo →
                        </a>
                    </div>
                </div>
                <div class="hidden lg:flex items-center justify-center relative shrink-0" style="width:360px;height:400px">
                    <div class="absolute rounded-full blur-3xl opacity-12" style="width:240px;height:240px;background:#E8500A"></div>
                    <div class="absolute rounded-full border" style="width:290px;height:290px;border-color:rgba(232,80,10,0.22);animation:lc-ring 4.5s ease-out infinite"></div>
                    <div class="absolute rounded-full border" style="width:196px;height:196px;border-color:rgba(232,80,10,0.38);animation:lc-ring 4.5s ease-out infinite 1.8s"></div>
                    <div class="relative flex items-center justify-center rounded-3xl" style="width:104px;height:104px;background:rgba(232,80,10,0.14);border:1px solid rgba(232,80,10,0.42);animation:lc-float 5s ease-in-out infinite">
                        <span class="font-black text-4xl select-none" style="color:#E8500A">SR</span>
                    </div>
                    <div class="absolute top-10 right-8 rounded-xl px-3 py-1.5 text-xs font-semibold" style="background:rgba(255,255,255,0.05);border:1px solid rgba(232,80,10,0.28);color:#E8500A;animation:lc-float 6s ease-in-out infinite 1s">POS · Cocina · Inventarios</div>
                    <div class="absolute bottom-14 left-6 rounded-xl px-3 py-1.5 text-xs font-semibold" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.32);animation:lc-float 7s ease-in-out infinite 2s">F&amp;B Especializado</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── SLIDE 3: Zoho One — rojo ───────────────────────────────────────── --}}
    <div class="hero-slide" :class="c===3 ? 'hero-slide--active' : 'pointer-events-none'">
        <div class="absolute inset-0 pointer-events-none" style="background:radial-gradient(ellipse 55% 70% at 72% 50%,rgba(200,32,44,0.16) 0%,transparent 70%)"></div>
        <div class="container-brand w-full px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center gap-8 lg:gap-14 py-20 lg:py-0">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2.5 mb-7">
                        <span class="block w-1 h-6 rounded-full shrink-0" style="background:#C8202C"></span>
                        <span class="text-[11px] font-bold tracking-[0.2em] uppercase" style="color:#E8404C">Zoho One</span>
                    </div>
                    <h1 class="font-black text-white tracking-tight mb-6 leading-[0.93]" style="font-size:clamp(2.8rem,6.5vw,5.2rem)">
                        40+ apps.<br>
                        Una sola<br>
                        <span style="color:#E8404C">suscripción.</span>
                    </h1>
                    <p class="text-white/50 leading-relaxed mb-9 max-w-md" style="font-size:clamp(0.875rem,1.4vw,1.05rem)">
                        CRM, Contabilidad, RRHH, Proyectos y más — toda la suite empresarial Zoho en un partner de confianza.
                    </p>
                    <div class="flex items-center gap-4 flex-wrap">
                        <a href="{{ url('/productos/zoho-one') }}" class="inline-flex items-center gap-3 font-bold text-white rounded-2xl transition-all duration-200 hover:-translate-y-0.5"
                           style="background:linear-gradient(135deg,#A81A25,#C8202C);padding:0.9rem 1.75rem;font-size:0.875rem;box-shadow:0 8px 28px rgba(200,32,44,0.45)">
                            Explorar Zoho One
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('booking') }}" class="text-sm font-semibold text-white/45 hover:text-white/80 transition-colors underline underline-offset-4 decoration-white/20">
                            Solicitar demo →
                        </a>
                    </div>
                </div>
                <div class="hidden lg:flex items-center justify-center relative shrink-0" style="width:360px;height:400px">
                    <div class="absolute rounded-full blur-3xl opacity-12" style="width:240px;height:240px;background:#C8202C"></div>
                    <div class="absolute rounded-full border" style="width:290px;height:290px;border-color:rgba(200,32,44,0.22);animation:lc-ring 4.5s ease-out infinite"></div>
                    <div class="absolute rounded-full border" style="width:196px;height:196px;border-color:rgba(200,32,44,0.38);animation:lc-ring 4.5s ease-out infinite 1.8s"></div>
                    <div class="relative flex items-center justify-center rounded-3xl" style="width:104px;height:104px;background:rgba(200,32,44,0.14);border:1px solid rgba(200,32,44,0.42);animation:lc-float 5s ease-in-out infinite">
                        <span class="font-black text-4xl select-none" style="color:#E8404C">ZO</span>
                    </div>
                    <div class="absolute top-10 right-8 rounded-xl px-3 py-1.5 text-xs font-semibold" style="background:rgba(255,255,255,0.05);border:1px solid rgba(200,32,44,0.28);color:#E8404C;animation:lc-float 6s ease-in-out infinite 1s">40+ Apps integradas</div>
                    <div class="absolute bottom-14 left-6 rounded-xl px-3 py-1.5 text-xs font-semibold" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);color:rgba(255,255,255,0.32);animation:lc-float 7s ease-in-out infinite 2s">CRM · HR · Books · Projects</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── STATS BAR — persistente en todos los slides ────────────────────── --}}
    <div class="absolute bottom-[72px] left-0 right-0 z-20 border-y border-white/8 pointer-events-none" style="background:rgba(8,15,30,0.75);backdrop-filter:blur(8px)">
        <div class="container-brand px-4 sm:px-6 lg:px-8 py-4 flex flex-wrap items-center justify-center sm:justify-around gap-x-8 gap-y-3">
            <div class="text-center"><p class="text-2xl font-extrabold text-white">500+</p><p class="text-[10px] text-white/35 mt-0.5 uppercase tracking-widest">Empresas</p></div>
            <div class="w-px h-8 bg-white/10 hidden sm:block"></div>
            <div class="text-center"><p class="text-2xl font-extrabold text-white">1,200+</p><p class="text-[10px] text-white/35 mt-0.5 uppercase tracking-widest">Graduados</p></div>
            <div class="w-px h-8 bg-white/10 hidden sm:block"></div>
            <div class="text-center"><p class="text-2xl font-extrabold text-white">3</p><p class="text-[10px] text-white/35 mt-0.5 uppercase tracking-widest">Certificaciones</p></div>
            <div class="w-px h-8 bg-white/10 hidden sm:block"></div>
            <div class="text-center"><p class="text-2xl font-extrabold text-white">12+</p><p class="text-[10px] text-white/35 mt-0.5 uppercase tracking-widest">Años</p></div>
        </div>
    </div>

    {{-- ── DOTS + FLECHAS — navegación ────────────────────────────────────── --}}
    <div class="absolute bottom-6 left-0 right-0 z-20 flex items-center justify-center gap-3">
        <button @click="prev()" class="p-1.5 rounded-full hover:bg-white/10 transition-colors" aria-label="Anterior">
            <svg class="w-4 h-4 text-white/35 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <template x-for="i in 4" :key="i">
            <button @click="go(i-1)"
                    class="rounded-full transition-all duration-500"
                    :class="c === i-1 ? 'w-7 h-2 bg-white' : 'w-2 h-2 bg-white/25 hover:bg-white/50'"
                    :aria-label="'Slide ' + i"></button>
        </template>
        <button @click="next()" class="p-1.5 rounded-full hover:bg-white/10 transition-colors" aria-label="Siguiente">
            <svg class="w-4 h-4 text-white/35 hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    {{-- ── CONTADOR — top right ─────────────────────────────────────────── --}}
    <div class="absolute top-6 right-6 z-20 hidden lg:flex items-baseline gap-1 font-mono" aria-hidden="true">
        <span class="text-white/70 text-sm font-bold" x-text="String(c+1).padStart(2,'0')"></span>
        <span class="text-white/20 text-xs">/</span>
        <span class="text-white/20 text-xs">04</span>
    </div>

</section>

{{-- ═══════════════════════════════════════ SOLUCIONES — Platzi clean cards ══ --}}
<section class="bg-[#F8FAFC] section-padded">
    <div class="container-brand">
        <div class="text-center mb-12">
            <span class="text-xs font-bold text-[#1B4DB7] uppercase tracking-widest">Nuestras soluciones</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-2">Software que transforma tu negocio</h2>
            <p class="text-gray-500 mt-3 max-w-xl mx-auto text-sm">Partner oficial de las tres plataformas líderes en México. Capacitación, implementación y soporte en un solo lugar.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Siigo Aspel --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition-shadow duration-300">
                <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#1B4DB7,#3B6FE0)"></div>
                <div class="p-7 flex flex-col flex-1">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <span class="w-2.5 h-2.5 rounded-full" style="background:#1B4DB7"></span>
                        <span class="text-xs font-bold text-[#1B4DB7] uppercase tracking-wider">Siigo Aspel</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Administración y contabilidad para PYMES</h3>
                    <p class="text-sm text-gray-500 mb-5 leading-relaxed">SAE, COI, NOI, Facture y más. La suite de gestión más utilizada por contadores en México.</p>
                    <ul class="space-y-2 mb-7 flex-1">
                        @foreach(['Contabilidad electrónica CFDI','Facturación y nómina','Control de inventarios y POS'] as $f)
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 shrink-0" fill="#1B4DB7" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ url('/productos/siigo-aspel') }}" class="mt-auto flex items-center justify-center gap-2 py-3 px-5 rounded-xl text-sm font-semibold text-white hover:-translate-y-0.5 transition-transform" style="background:#1B4DB7">
                        Ver productos <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            {{-- Soft-Restaurant --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition-shadow duration-300">
                <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#C44508,#E8500A)"></div>
                <div class="p-7 flex flex-col flex-1">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <span class="w-2.5 h-2.5 rounded-full" style="background:#E8500A"></span>
                        <span class="text-xs font-bold text-[#E8500A] uppercase tracking-wider">Soft-Restaurant</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Sistema integral para el sector F&amp;B</h3>
                    <p class="text-sm text-gray-500 mb-5 leading-relaxed">POS, cocina, inventarios y fidelización para restaurantes, bares, cadenas y franquicias.</p>
                    <ul class="space-y-2 mb-7 flex-1">
                        @foreach(['POS táctil multi-terminal','Control de cocina y delivery','Reportes de ventas en tiempo real'] as $f)
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 shrink-0" fill="#E8500A" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ url('/productos/soft-restaurant') }}" class="mt-auto flex items-center justify-center gap-2 py-3 px-5 rounded-xl text-sm font-semibold text-white hover:-translate-y-0.5 transition-transform" style="background:#E8500A">
                        Ver productos <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            {{-- Zoho One --}}
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition-shadow duration-300">
                <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#A81A25,#C8202C)"></div>
                <div class="p-7 flex flex-col flex-1">
                    <div class="inline-flex items-center gap-2 mb-4">
                        <span class="w-2.5 h-2.5 rounded-full" style="background:#C8202C"></span>
                        <span class="text-xs font-bold text-[#C8202C] uppercase tracking-wider">Zoho One</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Suite empresarial completa (40+ apps)</h3>
                    <p class="text-sm text-gray-500 mb-5 leading-relaxed">CRM, contabilidad, proyectos, RRHH y más. Una sola plataforma para toda la operación.</p>
                    <ul class="space-y-2 mb-7 flex-1">
                        @foreach(['Zoho CRM + Books + People','Automatización de procesos','Reportes y analytics avanzados'] as $f)
                        <li class="flex items-center gap-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 shrink-0" fill="#C8202C" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ url('/productos/zoho-one') }}" class="mt-auto flex items-center justify-center gap-2 py-3 px-5 rounded-xl text-sm font-semibold text-white hover:-translate-y-0.5 transition-transform" style="background:#C8202C">
                        Ver productos <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════ CURSOS — Domestika + Platzi hybrid dark ══ --}}
<section class="bg-[#0F172A] section-padded">
    <div class="container-brand">
        <div class="flex items-end justify-between mb-10">
            <div>
                <span class="text-xs font-bold text-blue-400 uppercase tracking-widest">Campus Logia</span>
                <h2 class="text-3xl font-bold text-white mt-1">Cursos más populares</h2>
            </div>
            <a href="{{ url('/campus') }}" class="hidden sm:flex items-center gap-1 text-sm font-semibold text-blue-400 hover:text-blue-300 transition-colors">
                Ver catálogo <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @php
        $courses = [
            ['brand'=>'Siigo Aspel','color_from'=>'#1B4DB7','color_to'=>'#3B6FE0','level'=>'Básico',
             'title'=>'Administración SAE para PYMES: Del cero al experto',
             'instructor_initials'=>'MG','instructor_name'=>'María González','instructor_color'=>'#1B4DB7',
             'lessons'=>12,'duration'=>'6h 30min','rating'=>4.9,'reviews'=>124],
            ['brand'=>'Soft-Restaurant','color_from'=>'#C44508','color_to'=>'#E8500A','level'=>'Intermedio',
             'title'=>'Soft-Restaurant desde cero: Configura tu restaurante',
             'instructor_initials'=>'CM','instructor_name'=>'Carlos Martínez','instructor_color'=>'#E8500A',
             'lessons'=>8,'duration'=>'4h 15min','rating'=>4.8,'reviews'=>87],
            ['brand'=>'Zoho One','color_from'=>'#A81A25','color_to'=>'#C8202C','level'=>'Avanzado',
             'title'=>'Zoho CRM Avanzado: Automatiza tu proceso comercial',
             'instructor_initials'=>'AL','instructor_name'=>'Ana López','instructor_color'=>'#C8202C',
             'lessons'=>15,'duration'=>'9h 00min','rating'=>5.0,'reviews'=>56],
        ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($courses as $course)
            <article class="bg-white/5 border border-white/8 rounded-2xl overflow-hidden flex flex-col hover:bg-white/[0.08] transition-colors group cursor-pointer">
                {{-- Thumbnail con gradiente de marca --}}
                <div class="aspect-video relative overflow-hidden" style="background:linear-gradient(135deg,{{ $course['color_from'] }},{{ $course['color_to'] }})">
                    <span class="absolute top-3 left-3 text-xs font-bold text-white bg-black/30 backdrop-blur-sm px-2.5 py-1 rounded-full">{{ $course['brand'] }}</span>
                    <span class="absolute top-3 right-3 text-xs text-white/80 bg-black/25 px-2 py-0.5 rounded">{{ $course['level'] }}</span>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <div class="w-12 h-12 rounded-full bg-black/30 backdrop-blur-sm flex items-center justify-center">
                            <svg class="w-5 h-5 text-white ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>
                {{-- Card body —  Domestika instructor chip --}}
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="text-white font-semibold text-sm leading-snug mb-3 line-clamp-2">{{ $course['title'] }}</h3>
                    {{-- Instructor chip (Domestika) --}}
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white shrink-0" style="background:{{ $course['instructor_color'] }}">{{ $course['instructor_initials'] }}</div>
                        <span class="text-xs text-white/50">{{ $course['instructor_name'] }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-white/35 mb-3">
                        <span>{{ $course['lessons'] }} lecciones</span><span>·</span><span>{{ $course['duration'] }}</span>
                    </div>
                    {{-- Rating (Udemy) --}}
                    <div class="flex items-center gap-1.5 mt-auto">
                        <span class="text-amber-400 text-xs">★★★★★</span>
                        <span class="text-white text-xs font-semibold">{{ $course['rating'] }}</span>
                        <span class="text-white/30 text-xs">({{ $course['reviews'] }})</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ url('/campus') }}" class="inline-flex items-center gap-2 border border-white/15 text-white/60 hover:text-white hover:border-white/30 text-sm font-medium px-6 py-3 rounded-xl transition-all">
                Ver todos los cursos <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════ INSTRUCTORES — Domestika style ══ --}}
<section class="bg-white section-padded">
    <div class="container-brand">
        <div class="text-center mb-12">
            <span class="text-xs font-bold text-[#1B4DB7] uppercase tracking-widest">Nuestro equipo</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-2">Aprende de los mejores</h2>
            <p class="text-gray-500 mt-3 max-w-lg mx-auto text-sm">Instructores certificados con experiencia real en implementación, no solo teoría.</p>
        </div>

        @php
        $instructors = [
            ['initials'=>'MG','color'=>'#1B4DB7','name'=>'María González','role'=>'Experta Siigo Aspel',
             'bio'=>'15 años implementando Siigo en PYMES mexicanas. Contadora pública certificada y ex-consultora Aspel.','courses'=>5,'students'=>420],
            ['initials'=>'CM','color'=>'#E8500A','name'=>'Carlos Martínez','role'=>'Consultor Soft-Restaurant',
             'bio'=>'Ha capacitado más de 80 restaurantes y cadenas de F&B en México y Latinoamérica.','courses'=>3,'students'=>290],
            ['initials'=>'AL','color'=>'#C8202C','name'=>'Ana López','role'=>'Implementadora Zoho One',
             'bio'=>'Zoho Partner certificada. Especialista en automatización de procesos con CRM, Books y Analytics.','courses'=>7,'students'=>530],
        ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach($instructors as $instructor)
            <div class="border border-gray-100 rounded-2xl p-6 flex flex-col hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center text-white font-bold text-lg shrink-0" style="background:{{ $instructor['color'] }}">{{ $instructor['initials'] }}</div>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">{{ $instructor['name'] }}</p>
                        <p class="text-xs font-semibold mt-0.5" style="color:{{ $instructor['color'] }}">{{ $instructor['role'] }}</p>
                    </div>
                </div>
                <p class="text-sm text-gray-500 leading-relaxed mb-5">{{ $instructor['bio'] }}</p>
                <div class="flex items-center gap-5 text-xs text-gray-400 mb-5">
                    <span><strong class="text-gray-700 font-semibold">{{ $instructor['courses'] }}</strong> cursos</span>
                    <span><strong class="text-gray-700 font-semibold">{{ $instructor['students'] }}</strong> estudiantes</span>
                </div>
                <a href="{{ url('/instructores') }}" class="mt-auto text-xs font-semibold flex items-center gap-1 hover:opacity-75 transition-opacity" style="color:{{ $instructor['color'] }}">
                    Ver perfil <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════ POR QUÉ LOGIA — 4 valores ══ --}}
<section class="bg-[#F1F5F9] section-padded">
    <div class="container-brand">
        <div class="text-center mb-12">
            <span class="text-xs font-bold text-[#1B4DB7] uppercase tracking-widest">Por qué elegirnos</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-2">La diferencia Logia</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @php
            $values = [
                ['icon'=>'🏆','title'=>'Certificación oficial','desc'=>'Partner certificado de Siigo Aspel, Soft-Restaurant y Zoho One en México.'],
                ['icon'=>'🎓','title'=>'3 modalidades','desc'=>'Online, virtual en vivo y presencial. Aprende como quieras, cuando quieras.'],
                ['icon'=>'🛡','title'=>'Garantía 7 días','desc'=>'Si no quedas satisfecho en los primeros 7 días, te devolvemos el 100%.'],
                ['icon'=>'⚡','title'=>'Soporte post-curso','desc'=>'Acceso a nuestro canal de soporte por 30 días después de completar tu curso.'],
            ];
            @endphp
            @foreach($values as $value)
            <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-sm transition-shadow">
                <div class="text-3xl mb-4">{{ $value['icon'] }}</div>
                <h3 class="font-bold text-gray-900 mb-2">{{ $value['title'] }}</h3>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $value['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════ TESTIMONIOS — Udemy style ══ --}}
<section class="bg-white section-padded">
    <div class="container-brand">
        <div class="text-center mb-12">
            <span class="text-xs font-bold text-[#1B4DB7] uppercase tracking-widest">Testimonios</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mt-2">Lo que dicen nuestros clientes</h2>
        </div>
        @php
        $testimonials = [
            ['stars'=>5,'quote'=>'Gracias a Logia ahora todo mi equipo maneja SAE correctamente. Los cursos son muy completos y prácticos.',
             'name'=>'Roberto Sánchez','company'=>'Distribuidora Torres','product'=>'Siigo Aspel','color'=>'#1B4DB7'],
            ['stars'=>5,'quote'=>'Implementamos Soft-Restaurant en toda nuestra cadena de 5 restaurantes con soporte de Logia. Excelente servicio.',
             'name'=>'Fernanda Ríos','company'=>'Grupo F&B Capital','product'=>'Soft-Restaurant','color'=>'#E8500A'],
            ['stars'=>5,'quote'=>'El curso de Zoho CRM cambió la forma en que gestionamos nuestros prospectos. ROI visible desde el primer mes.',
             'name'=>'Miguel Ángel Torres','company'=>'SolTech PYME','product'=>'Zoho One','color'=>'#C8202C'],
        ];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($testimonials as $t)
            <div class="border border-gray-100 rounded-2xl p-6 flex flex-col">
                <div class="flex items-center gap-0.5 mb-4">
                    @for($s = 0; $s < $t['stars']; $s++)
                    <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-sm text-gray-600 leading-relaxed flex-1 mb-5">&ldquo;{{ $t['quote'] }}&rdquo;</p>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $t['name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $t['company'] }}</p>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full text-white" style="background:{{ $t['color'] }}">{{ $t['product'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════ CTA FINAL dark ══ --}}
<section class="section-padded" style="background:linear-gradient(135deg,#080F1E 0%,#0D1B3E 60%,#163D99 100%)">
    <div class="container-brand text-center">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">¿Listo para capacitar a tu equipo?</h2>
        <p class="text-white/55 max-w-xl mx-auto mb-10 text-lg">Agenda una sesión gratuita de 30 minutos con uno de nuestros especialistas y encuentra el plan ideal para tu empresa.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('booking') }}" class="btn-primary px-8 py-4 text-base">Agendar sesión gratuita</a>
            <a href="{{ url('/campus') }}" class="inline-flex items-center gap-2 border border-white/20 text-white/80 hover:text-white hover:border-white/40 font-semibold px-8 py-4 rounded-xl text-base transition-all">Ver catálogo de cursos</a>
        </div>
        <p class="text-white/30 text-xs mt-8">Respondemos en menos de 2 horas · Lunes a viernes 9am–7pm CST</p>
    </div>
</section>

@endsection
