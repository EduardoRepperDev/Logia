@extends('layouts.marketing')

@section('title', 'Integramos tecnología y crecimiento para tu negocio')
@section('meta_description', 'Partner oficial de Siigo Aspel, Soft Restaurant y Zoho One en México. Implementación, capacitación y soporte certificado.')
@section('og_title', 'Logia Consulting — Partner oficial en México')

@php
$slides = [
    ['key' => 'logia',
     'eyebrow'  => 'Partner oficial · Siigo Aspel · Soft Restaurant · Zoho · Microsoft',
     'titleA'   => 'Integramos ', 'titleEm' => 'tecnología', 'titleB' => ' y crecimiento para tu negocio.',
     'lede'     => 'Somos consultores certificados en cuatro ecosistemas. Tú nos cuentas qué mueves; nosotros elegimos, implementamos y capacitamos a tu equipo.',
     'ctaA'     => ['label' => 'Ver productos',             'href' => route('partner.aspel')],
     'ctaB'     => ['label' => 'Agendar diagnóstico gratis','href' => route('booking')],
     'dotLabel' => 'Logia Consulting'],
    ['key' => 'aspel',
     'eyebrow'  => 'Partner Siigo Aspel · Gold desde 2012',
     'titleA'   => 'Siigo Aspel ', 'titleEm' => 'COI, NOI, BANCO', 'titleB' => ' — timbra y cierra tu mes.',
     'lede'     => 'Licencias originales, timbres SAT, implementación y soporte en español. La suite fiscal y administrativa líder en México.',
     'ctaA'     => ['label' => 'Ver productos Aspel', 'href' => route('partner.aspel')],
     'ctaB'     => ['label' => 'Comparar licencias',  'href' => route('booking')],
     'dotLabel' => 'Siigo Aspel'],
    ['key' => 'softrestaurant',
     'eyebrow'  => 'Distribuidor autorizado · Soft Restaurant',
     'titleA'   => 'POS para ', 'titleEm' => 'restaurantes', 'titleB' => ' que operan en serio.',
     'lede'     => 'Comandas, inventarios por receta, control de mesas y delivery Rappi/UberEats en un solo POS. De 1 a 200 sucursales.',
     'ctaA'     => ['label' => 'Conocer Soft Restaurant', 'href' => route('partner.soft')],
     'ctaB'     => ['label' => 'Agendar demo',            'href' => route('booking')],
     'dotLabel' => 'Soft Restaurant'],
    ['key' => 'zoho',
     'eyebrow'  => 'Authorized Partner · Zoho',
     'titleA'   => 'Zoho: ', 'titleEm' => '45+ apps', 'titleB' => ' trabajando como una sola.',
     'lede'     => 'CRM, Books, People, Projects, Desk — toda tu operación bajo un login, un dashboard y una factura.',
     'ctaA'     => ['label' => 'Explorar Zoho', 'href' => route('partner.zoho')],
     'ctaB'     => ['label' => 'Probar 30 días', 'href' => route('booking')],
     'dotLabel' => 'Zoho'],
    ['key' => 'campus',
     'eyebrow'  => 'Campus Logia · Cursos certificados DC-3',
     'titleA'   => 'Tu equipo, ', 'titleEm' => 'certificado', 'titleB' => ' sin salir de la oficina.',
     'lede'     => 'Aula virtual con DRM, constancia STPS DC-3 y rutas por rol: contador, administrador, gerente de restaurante o IT manager. Desde $990 por curso.',
     'ctaA'     => ['label' => 'Explorar Campus',      'href' => url('/campus')],
     'ctaB'     => ['label' => 'Ver catálogo de cursos','href' => url('/campus')],
     'dotLabel' => 'Campus Logia'],
];

/* colores y fondos por slide — alimentan x-effect en la sección hero */
$slideMeta = [
    ['color' => '#FF6B00', 'bg' => 'linear-gradient(140deg,#FFF5F0,#FFFFFF)'],
    ['color' => '#009DFF', 'bg' => 'linear-gradient(140deg,#EBF7FF,#FFFFFF)'],
    ['color' => '#E25724', 'bg' => 'linear-gradient(140deg,#FFF1ED,#FFFFFF)'],
    ['color' => '#E42527', 'bg' => 'linear-gradient(140deg,#FFF0F0,#FFFFFF)'],
    ['color' => '#7C3AED', 'bg' => 'linear-gradient(140deg,#F5F0FF,#FFFFFF)'],
];

$services = [
    ['icon' => 'consulting', 'title' => 'Consultoría de negocio',
     'body' => 'Diagnosticamos procesos y recomendamos la stack correcta — Aspel, Zoho o Microsoft — para tu etapa.',
     'meta' => '20+ años · 500+ empresas'],
    ['icon' => 'impl',       'title' => 'Implementación',
     'body' => 'Migraciones, parametrización y puesta en marcha con consultores certificados por cada fabricante.',
     'meta' => 'Metodología Logia 6 fases'],
    ['icon' => 'training',   'title' => 'Capacitación DC-3',
     'body' => 'Cursos avalados con constancia STPS. Presencial en WTC, Coapa, Polanco o 100% remoto.',
     'meta' => 'Campus Logia online'],
    ['icon' => 'support',    'title' => 'Soporte en sitio y remoto',
     'body' => 'Mesa de ayuda, monitoreo y SLA empresarial. Respuesta en <15 min para clientes Premium.',
     'meta' => 'CDMX + 24/7 remoto'],
];

$tabs = [
    'todos' => [
        ['slug' => 'aspel-coi',   'brandTag' => 'SA',   'brandLogo' => '/images/brands/siigo.png',
         'brandColor' => '#009DFF', 'name' => 'Aspel COI 10.0',
         'desc' => 'Contabilidad integral con CFDI 4.0 y complementos SAT.',
         'price' => '$7,980', 'priceMeta' => 'anual · 1 usuario', 'badge' => 'Best-seller',
         'route' => route('partner.aspel')],
        ['slug' => 'soft-pro',    'brandTag' => 'SR',   'brandLogo' => '/images/brands/softrestauran.png',
         'brandColor' => '#E25724', 'name' => 'Soft Restaurant Pro',
         'desc' => 'POS para restaurante con 3 cajas, inventarios y recetas.',
         'price' => '$18,500', 'priceMeta' => 'anual · 3 cajas', 'badge' => 'Hospitality',
         'route' => route('partner.soft')],
        ['slug' => 'zoho-crm',    'brandTag' => 'Z1',   'brandLogo' => '/images/brands/zoho-logo-web.svg',
         'brandColor' => '#E42527', 'name' => 'Zoho CRM Plus',
         'desc' => 'CRM + automatización + marketing + helpdesk en un solo plan.',
         'price' => '$2,399', 'priceMeta' => 'usuario/mes', 'badge' => 'Más cotizado',
         'route' => route('partner.zoho')],
    ],
    'pyme' => [
        ['slug' => 'm365-std',    'brandTag' => 'M365', 'brandLogo' => '/images/brands/Microsoft.png',
         'brandColor' => '#05A6F0', 'name' => 'M365 Business Standard',
         'desc' => 'Apps de escritorio, Teams, correo corporativo y OneDrive 1TB.',
         'price' => '$320', 'priceMeta' => 'usuario/mes', 'badge' => 'PyME',
         'route' => route('partner.microsoft')],
        ['slug' => 'aspel-noi',   'brandTag' => 'SA',   'brandLogo' => '/images/brands/siigo.png',
         'brandColor' => '#009DFF', 'name' => 'Aspel NOI 11.0',
         'desc' => 'Nómina con CFDI 4.0 y prestaciones de ley automatizadas.',
         'price' => '$9,450', 'priceMeta' => 'anual · 50 empleados', 'badge' => 'PyME',
         'route' => route('partner.aspel')],
        ['slug' => 'zoho-books',  'brandTag' => 'Z1',   'brandLogo' => '/images/brands/zoho-logo-web.svg',
         'brandColor' => '#E42527', 'name' => 'Zoho Books',
         'desc' => 'Contabilidad en la nube con facturación CFDI y bancos mexicanos.',
         'price' => '$399', 'priceMeta' => 'usuario/mes', 'badge' => 'Nube',
         'route' => route('partner.zoho')],
    ],
    'enterprise' => [
        ['slug' => 'm365-prem',   'brandTag' => 'M365', 'brandLogo' => '/images/brands/Microsoft.png',
         'brandColor' => '#05A6F0', 'name' => 'M365 Business Premium',
         'desc' => 'Intune MDM + Defender + Azure AD Premium para empresas grandes.',
         'price' => '$450', 'priceMeta' => 'usuario/mes', 'badge' => 'Seguridad',
         'route' => route('partner.microsoft')],
        ['slug' => 'aspel-suite', 'brandTag' => 'SA',   'brandLogo' => '/images/brands/siigo.png',
         'brandColor' => '#009DFF', 'name' => 'Aspel Suite Empresa',
         'desc' => 'COI + NOI + BANCO + FACTURE con licencias multi-usuario.',
         'price' => '$48,900', 'priceMeta' => 'anual · 10 usuarios', 'badge' => 'Suite',
         'route' => route('partner.aspel')],
        ['slug' => 'zoho-one',    'brandTag' => 'Z1',   'brandLogo' => '/images/brands/zoho-logo-web.svg',
         'brandColor' => '#E42527', 'name' => 'Zoho One',
         'desc' => 'Suite completa de 45+ aplicaciones empresariales integradas.',
         'price' => '$1,299', 'priceMeta' => 'usuario/mes', 'badge' => 'Todo en 1',
         'route' => route('partner.zoho')],
    ],
];
@endphp

@section('content')
<main data-brand="logia">

{{-- ══ HERO ══════════════════════════════════════════════════════════════════ --}}
<section class="hero"
         x-data="heroCarousel({{ count($slides) }}, @json($slideMeta))"
         :style="{ '--primary': meta[slide].color, background: meta[slide].bg }"
         style="transition: background 600ms ease">
    <div class="container">
        <div class="hero__inner">

            {{-- Copy --}}
            <div class="hero__copy">
                @foreach($slides as $i => $s)
                <div x-show="slide === {{ $i }}"
                     style="{{ $i === 0 ? '' : 'display:none' }}">
                    <span class="eyebrow">{{ $s['eyebrow'] }}</span>
                    <h1 class="hero__title">
                        {{ $s['titleA'] }}<em>{{ $s['titleEm'] }}</em>{{ $s['titleB'] }}
                    </h1>
                    <p class="hero__lede">{{ $s['lede'] }}</p>
                    <div class="hero__ctas">
                        <a href="{{ $s['ctaA']['href'] }}" class="c-btn c-btn--lg">{{ $s['ctaA']['label'] }}</a>
                        <a href="{{ $s['ctaB']['href'] }}" class="c-btn c-btn--ghost c-btn--lg">{{ $s['ctaB']['label'] }}</a>
                    </div>
                </div>
                @endforeach

                {{-- Slide dots --}}
                <div class="hero__slide-nav" role="tablist" aria-label="Slides del hero">
                    @foreach($slides as $i => $s)
                    <button class="hero__slide-dot"
                            :aria-current="slide === {{ $i }} ? 'true' : 'false'"
                            @click="$data.slide = {{ $i }}"
                            aria-label="{{ $s['dotLabel'] }}">
                        <span class="hero__slide-dot__label">{{ $s['dotLabel'] }}</span>
                    </button>
                    @endforeach
                </div>

                {{-- Stats con iconos --}}
                <div class="hero__stats">
                    <div style="display:flex;align-items:center;gap:12px">
                        <div aria-hidden="true" style="width:40px;height:40px;border-radius:10px;background:color-mix(in srgb,var(--primary) 12%,transparent);display:grid;place-items:center;color:var(--primary);flex-shrink:0;transition:background 600ms ease,color 600ms ease">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <div class="hero__stat-num">20<small>+</small></div>
                            <div class="hero__stat-label">Años acompañando PyMEs</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:12px">
                        <div aria-hidden="true" style="width:40px;height:40px;border-radius:10px;background:color-mix(in srgb,var(--primary) 12%,transparent);display:grid;place-items:center;color:var(--primary);flex-shrink:0;transition:background 600ms ease,color 600ms ease">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="9" cy="7" r="4" stroke="currentColor" stroke-width="2"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <div>
                            <div class="hero__stat-num">500<small>+</small></div>
                            <div class="hero__stat-label">Clientes activos en México</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:12px">
                        <div aria-hidden="true" style="width:40px;height:40px;border-radius:10px;background:color-mix(in srgb,var(--primary) 12%,transparent);display:grid;place-items:center;color:var(--primary);flex-shrink:0;transition:background 600ms ease,color 600ms ease">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><rect x="2" y="3" width="20" height="14" rx="2" stroke="currentColor" stroke-width="2"/><path d="M8 21h8M12 17v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        </div>
                        <div>
                            <div class="hero__stat-num">4</div>
                            <div class="hero__stat-label">Partnerships oficiales</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visual 3D --}}
            <div class="hero__visual" aria-hidden="true"
                 x-data="heroVisual()"
                 @pointermove="onMove"
                 @pointerleave="onLeave"
                 style="perspective:1400px;position:relative;min-height:460px">
                <div x-ref="stage" style="position:relative;width:100%;height:460px;transform-style:preserve-3d;transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1)">

                    {{-- Órbitas --}}
                    <svg viewBox="0 0 560 460" style="position:absolute;inset:0;width:100%;height:100%" aria-hidden="true">
                        <ellipse cx="280" cy="230" rx="240" ry="140" fill="none" stroke="var(--border)" stroke-width="1" stroke-dasharray="2 6"/>
                        <ellipse cx="280" cy="230" rx="190" ry="110" fill="none" stroke="var(--border)" stroke-width="1"/>
                        <circle  cx="280" cy="230" r="140" fill="var(--primary)" opacity="0.08"/>
                    </svg>

                    {{-- Logo central flotante --}}
                    <div style="position:absolute;left:50%;top:50%;width:210px;height:210px;margin-left:-105px;margin-top:-105px;display:grid;place-items:center;transform:translateZ(40px);transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1)">
                        <img src="{{ asset('images/Original_Logo_Logia_Consulting.png') }}"
                             alt="Logia Consulting"
                             style="width:100%;height:100%;object-fit:contain">
                    </div>

                    {{-- Tarjeta: clientes --}}
                    <div data-depth="70" style="position:absolute;left:24px;top:40px;width:168px;height:96px;transform:translateZ(70px);transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1);border-radius:14px;background:var(--surface);border:1px solid var(--border);box-shadow:0 27px 59px rgba(15,23,42,0.14);padding:14px">
                        <div style="font-size:28px;font-weight:700;color:var(--text);letter-spacing:-0.02em">500+</div>
                        <div style="font-size:12px;color:var(--text-muted);margin-top:4px">Clientes activos</div>
                        <div style="margin-top:12px;height:6px;border-radius:4px;background:var(--surface-2);overflow:hidden">
                            <div style="width:68%;height:100%;background:var(--primary)"></div>
                        </div>
                    </div>

                    {{-- Tarjeta: partner badge --}}
                    <div data-depth="90" style="position:absolute;left:380px;top:20px;width:150px;height:52px;transform:translateZ(90px);transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1);border-radius:14px;background:var(--primary);border:none;box-shadow:0 32px 69px rgba(15,23,42,0.15);padding:0 16px;display:flex;align-items:center;gap:10px">
                        <span style="width:8px;height:8px;border-radius:50%;background:#fff;flex-shrink:0"></span>
                        <div style="color:#fff">
                            <div style="font-size:13px;font-weight:700;line-height:1.1">Partner oficial</div>
                            <div style="font-size:11px;opacity:.85;margin-top:2px">4 ecosistemas</div>
                        </div>
                    </div>

                    {{-- Tarjeta: años --}}
                    <div data-depth="110" style="position:absolute;left:400px;top:280px;width:130px;height:130px;transform:translateZ(110px);transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1);border-radius:50%;background:var(--primary);box-shadow:0 37px 79px rgba(15,23,42,0.16);display:grid;place-items:center">
                        <div style="text-align:center;color:#fff">
                            <div style="font-size:32px;font-weight:700;letter-spacing:-0.02em">20+</div>
                            <div style="font-size:11px;opacity:.9;letter-spacing:.1em;text-transform:uppercase;margin-top:2px">años</div>
                        </div>
                    </div>

                    {{-- Tarjeta: servicios --}}
                    <div data-depth="60" style="position:absolute;left:30px;top:300px;width:188px;height:110px;transform:translateZ(60px);transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1);border-radius:14px;background:var(--surface);border:1px solid var(--border);box-shadow:0 24px 54px rgba(15,23,42,0.13);padding:14px">
                        <div style="font-size:10px;font-weight:700;color:var(--text-muted);letter-spacing:.12em;text-transform:uppercase;margin-bottom:8px">Incluye</div>
                        @foreach(['Consultoría','Implementación','Capacitación'] as $row)
                        <div style="display:flex;align-items:center;gap:8px;padding:4px 0;font-size:12px;color:var(--text)">
                            <span style="width:5px;height:5px;border-radius:50%;background:var(--primary);flex-shrink:0"></span> {{ $row }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ SERVICE STRIP (compact banner) ═══════════════════════════════════════ --}}
<section class="service-strip">
    <div class="container">
        <div class="service-strip__grid">
            @foreach($services as $s)
            <div class="service-strip__item">
                <div class="service-strip__icon" aria-hidden="true">
                    @if($s['icon'] === 'consulting')
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h10M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="19" cy="12" r="2" fill="currentColor"/></svg>
                    @elseif($s['icon'] === 'impl')
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="4" y="4" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="2"/><rect x="14" y="14" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="2"/><path d="M10 7h4v7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    @elseif($s['icon'] === 'training')
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M3 8l9-4 9 4-9 4-9-4z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M7 11v4c0 1 2 2 5 2s5-1 5-2v-4" stroke="currentColor" stroke-width="2"/></svg>
                    @else
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M12 3a8 8 0 0 0-8 8v5a2 2 0 0 0 2 2h2v-7H5v-.001A7 7 0 0 1 19 11V11h-3v7h2a2 2 0 0 0 2-2v-5a8 8 0 0 0-8-8z" stroke="currentColor" stroke-width="1.8"/></svg>
                    @endif
                </div>
                <div>
                    <div class="service-strip__title">{{ $s['title'] }}</div>
                    <div class="service-strip__body">{{ $s['body'] }}</div>
                    <div class="service-strip__meta">{{ $s['meta'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ CAMPUS ══════════════════════════════════════════════════════════════════ --}}
<section class="campus">
    <div class="container">
        <div class="campus__grid">
            <div>
                <span class="eyebrow" style="color:var(--accent)">Campus Logia · E-learning</span>
                <h2 style="margin-top:16px" class="campus__title">
                    Tu equipo, <em>certificado</em> en semanas — no en meses.
                </h2>
                <p class="lede" style="margin-top:16px">
                    Aula virtual con video protegido, PDFs con DRM y tres plantillas de certificado. Rutas de aprendizaje por rol: contador, administrador, gerente de restaurante o IT manager.
                </p>
                <ul class="campus__bullets">
                    <li>
                        <span class="campus__bullet-num">1</span>
                        <div><strong>Contenido protegido</strong>
                            <p>Widevine + FairPlay en video; PDF.js cifrado en documentos. Nada se descarga.</p>
                        </div>
                    </li>
                    <li>
                        <span class="campus__bullet-num">2</span>
                        <div><strong>Constancia DC-3 STPS</strong>
                            <p>Cursos avalados con constancia oficial. Tres plantillas de certificado descargable.</p>
                        </div>
                    </li>
                    <li>
                        <span class="campus__bullet-num">3</span>
                        <div><strong>Rutas por rol</strong>
                            <p>Desde $990 por curso. Planes empresa con licencias para todo tu equipo.</p>
                        </div>
                    </li>
                </ul>
                <div style="margin-top:28px">
                    <a href="{{ url('/campus') }}" class="c-btn c-btn--accent c-btn--lg">Explorar Campus</a>
                </div>
            </div>
            <div class="campus__player" aria-label="Vista previa del campus">
                <div class="campus__player-cert">
                    <div class="campus__player-cert__badge">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M12 2 L14 7 L19 7 L15 11 L17 17 L12 14 L7 17 L9 11 L5 7 L10 7 Z" fill="currentColor"/></svg>
                    </div>
                    <div>
                        <div class="campus__player-cert__label">Constancia</div>
                        <div class="campus__player-cert__value">DC-3 STPS incluida</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ PRODUCTOS DESTACADOS ═══════════════════════════════════════════════════ --}}
<section class="featured" x-data="{ tab: 'todos' }">
    <div class="container">
        <div class="featured__head">
            <div>
                <span class="eyebrow">Productos destacados</span>
                <h2 style="margin-top:16px">Una licencia, una factura, un soporte.</h2>
            </div>
            <div class="featured__tabs" role="tablist" aria-label="Filtro por segmento">
                @foreach(['todos' => 'Todos', 'pyme' => 'PyME', 'enterprise' => 'Enterprise'] as $k => $l)
                <button :aria-pressed="tab === '{{ $k }}'" @click="tab = '{{ $k }}'">{{ $l }}</button>
                @endforeach
            </div>
        </div>

        @foreach($tabs as $tabKey => $products)
        <div class="featured__grid" x-show="tab === '{{ $tabKey }}'" style="{{ $tabKey === 'todos' ? '' : 'display:none' }}">
            @foreach($products as $p)
            <article class="product3d" data-brand="logia"
                     x-data="product3dCard()"
                     @pointermove="onMove"
                     @pointerleave="onLeave">
                <div class="product3d__inner" x-ref="inner">
                    <header class="product3d__header">
                        {{-- Chip: logo con dimensiones explícitas (fix SVG) --}}
                        <span class="product3d__brand-chip"
                              style="background:#fff;border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;min-height:30px">
                            <img src="{{ $p['brandLogo'] }}"
                                 alt="{{ $p['brandTag'] }}"
                                 height="22"
                                 style="height:22px;width:auto;max-width:80px;object-fit:contain;pointer-events:none;display:block"
                                 onerror="this.parentElement.style.background='{{ $p['brandColor'] }}';this.style.display='none';this.insertAdjacentHTML('afterend','<span style=color:#fff;font-size:11px;font-weight:700;letter-spacing:.06em>{{ $p['brandTag'] }}</span>')">
                        </span>
                        <div class="product3d__price">
                            <div class="product3d__price-now">{{ $p['price'] }}</div>
                            <div class="product3d__price-meta">{{ $p['priceMeta'] }}</div>
                        </div>
                    </header>
                    <div class="product3d__visual">
                        <div x-ref="badge" class="product3d__badge">{{ $p['badge'] }}</div>
                        {{-- Floating brand icon --}}
                        <div x-ref="icon" class="product3d__icon" style="position:absolute;left:18px;bottom:14px">
                            <div style="width:48px;height:48px;border-radius:12px;background:#fff;box-shadow:0 10px 24px rgba(15,23,42,0.18);display:grid;place-items:center;border:1px solid var(--border)">
                                <img src="{{ $p['brandLogo'] }}"
                                     alt="{{ $p['brandTag'] }}"
                                     width="32" height="32"
                                     style="width:32px;height:32px;object-fit:contain;pointer-events:none"
                                     onerror="this.style.display='none'">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product3d__title">{{ $p['name'] }}</div>
                        <div class="product3d__meta">{{ $p['desc'] }}</div>
                    </div>
                    <a href="{{ $p['route'] }}" class="product3d__cta" style="text-decoration:none">
                        Ver detalle
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        @endforeach
    </div>
</section>

{{-- ══ SOPORTE ════════════════════════════════════════════════════════════════ --}}
<section class="support">
    <div class="container">
        <div class="support__grid">
            <div>
                <span class="eyebrow">Soporte técnico</span>
                <h2 style="margin-top:16px;margin-bottom:16px">Cuando algo se cae, no queremos que esperes.</h2>
                <p class="lede" style="margin-bottom:28px">Equipo certificado en México, mesa de ayuda en español y SLA contractual. No tercerizamos soporte — todo lo resuelve un consultor Logia.</p>
                <div class="support__cards">
                    <article class="support-card">
                        <span class="support-card__tag">En sitio</span>
                        <h4>Visita técnica CDMX</h4>
                        <p>Nuestro equipo se presenta en tu oficina. Cobertura en CDMX, GDL y MTY.</p>
                    </article>
                    <article class="support-card">
                        <span class="support-card__tag">Remoto 24/7</span>
                        <h4>Mesa de ayuda 24/7</h4>
                        <p>Chat, teléfono y ticket. Acceso remoto seguro con sesión auditada.</p>
                    </article>
                </div>
            </div>
            <aside class="support__visual">
                <span class="eyebrow" style="color:var(--primary)">Plan Enterprise</span>
                <h2 style="margin-top:16px">Soporte dedicado con consultor asignado.</h2>
                <p>Un consultor Logia conoce tu setup, tus procesos y tu equipo.</p>
                <a href="{{ route('booking') }}" class="c-btn c-btn--lg">Cotizar plan</a>
                <div class="support__visual-sla">
                    <div><b>15m</b><span>Respuesta Premium</span></div>
                    <div><b>99.5%</b><span>SLA mensual</span></div>
                    <div><b>24/7</b><span>Mesa de ayuda</span></div>
                </div>
            </aside>
        </div>
    </div>
</section>

{{-- ══ PARTNERS / CERTIFICACIONES ══════════════════════════════════════════════ --}}
<section class="certs">
    <div class="container">
        <div style="text-align:center;margin-bottom:32px">
            <span class="eyebrow">Partners oficiales autorizados</span>
            <h2 style="margin-top:16px">4 marcas líderes bajo un solo proveedor certificado.</h2>
        </div>
        <div class="certs__row" style="grid-template-columns:repeat(4,1fr)">
            @foreach([
                ['name' => 'Siigo Aspel',     'logo' => '/images/brands/siigo.png',          'tag' => 'Partner autorizado', 'route' => 'partner.aspel'],
                ['name' => 'Soft Restaurant', 'logo' => '/images/brands/softrestauran.png',   'tag' => 'Partner autorizado', 'route' => 'partner.soft'],
                ['name' => 'Zoho',            'logo' => '/images/brands/zoho-logo-web.svg',   'tag' => 'Partner autorizado', 'route' => 'partner.zoho'],
                ['name' => 'Microsoft 365',   'logo' => '/images/brands/Microsoft.png',       'tag' => 'Solutions Partner',  'route' => 'partner.microsoft'],
            ] as $b)
            <a href="{{ route($b['route']) }}" class="cert-badge"
               style="padding:24px;background:#fff;border:1px solid var(--border);align-items:center;text-decoration:none">
                <img src="{{ $b['logo'] }}" alt="{{ $b['name'] }}"
                     height="48"
                     style="height:48px;width:auto;max-width:120px;object-fit:contain;margin-bottom:12px"
                     onerror="this.style.display='none'">
                <strong>{{ $b['name'] }}</strong>
                <span>{{ $b['tag'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

</main>
@endsection
