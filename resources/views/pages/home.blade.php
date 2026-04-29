@extends('layouts.marketing')

@section('title', 'Integramos tecnología y crecimiento para tu negocio')
@section('meta_description', 'Partner oficial de Siigo Aspel, Soft Restaurant, Zoho y Microsoft 365 en México. Implementación, capacitación y soporte certificado.')
@section('og_title', 'Logia Consulting — Partner oficial en México')

@php
/* ── Hero carousel ────────────────────────────────────────────────────────── */
$slides = [
    ['key' => 'logia',
     'logo'    => asset('images/Original_Logo_Logia_Consulting.png'),
     'name'    => 'Logia Consulting',
     'eyebrow' => 'Partner certificado · ERP &amp; CRM · México',
     'titleEm' => '25+ Años', 'titleB' => ' de Experiencia en proveer, capacitar e implementar Soluciones Tecnológicas ERP y CRM',
     'lede'    => 'Transformamos digitalmente MiPyMEs con soluciones llave en mano que impulsan el crecimiento y la eficiencia operativa.',
     'ctaA'    => ['label' => 'Solicitar Consulta',  'href' => route('booking')],
     'ctaB'    => ['label' => 'Ver soluciones',       'href' => route('partner.aspel')],
     'dotLabel' => 'Logia Consulting'],
    ['key' => 'aspel',
     'logo'    => asset('images/brands/siigo.png'),
     'name'    => 'Siigo Aspel',
     'eyebrow' => 'Partner Siigo Aspel · Gold desde 2012',
     'titleEm' => 'Siigo Aspel COI, NOI, BANCO', 'titleB' => ' — timbra y cierra tu mes.',
     'lede'    => 'Licencias originales, timbres SAT, implementación y soporte en español. La suite fiscal y administrativa líder en México.',
     'ctaA'    => ['label' => 'Ver soluciones Aspel', 'href' => route('partner.aspel')],
     'ctaB'    => ['label' => 'Comparar licencias',   'href' => route('booking')],
     'dotLabel' => 'Siigo Aspel'],
    ['key' => 'softrestaurant',
     'logo'    => asset('images/brands/softrestauran.png'),
     'name'    => 'Soft Restaurant',
     'eyebrow' => 'Distribuidor autorizado · Soft Restaurant',
     'titleEm' => 'POS para restaurantes', 'titleB' => ' que operan en serio.',
     'lede'    => 'Comandas, inventarios por receta, control de mesas y delivery Rappi/UberEats en un solo POS. De 1 a 200 sucursales.',
     'ctaA'    => ['label' => 'Conocer Soft Restaurant', 'href' => route('partner.soft')],
     'ctaB'    => ['label' => 'Agendar demo',             'href' => route('booking')],
     'dotLabel' => 'Soft Restaurant'],
    ['key' => 'zoho',
     'logo'    => asset('images/brands/zoho-logo-web.svg'),
     'name'    => 'Zoho',
     'eyebrow' => 'Authorized Partner · Zoho',
     'titleEm' => 'Zoho: 45+ apps', 'titleB' => ' trabajando como una sola.',
     'lede'    => 'CRM, Books, People, Projects, Desk — toda tu operación bajo un login, un dashboard y una factura.',
     'ctaA'    => ['label' => 'Explorar Zoho',  'href' => route('partner.zoho')],
     'ctaB'    => ['label' => 'Probar 30 días', 'href' => route('booking')],
     'dotLabel' => 'Zoho'],
    ['key' => 'microsoft',
     'logo'    => asset('images/brands/Microsoft.png'),
     'name'    => 'Microsoft 365',
     'eyebrow' => 'Microsoft Solutions Partner · Licencias 365',
     'titleEm' => 'Microsoft 365', 'titleB' => ' — productividad y seguridad empresarial.',
     'lede'    => 'Apps de escritorio, Teams, correo corporativo y Intune. Implementación y migración en español desde Logia.',
     'ctaA'    => ['label' => 'Ver Microsoft 365',  'href' => route('partner.microsoft')],
     'ctaB'    => ['label' => 'Comparar planes',    'href' => route('booking')],
     'dotLabel' => 'Microsoft 365'],
    ['key' => 'academia',
     'logo'    => asset('images/Original_Logo_Logia_Consulting.png'),
     'name'    => 'Academia Logia',
     'eyebrow' => 'Academia Logia · Cursos certificados DC-3',
     'titleEm' => 'Tu equipo,', 'titleB' => ' certificado sin salir de la oficina.',
     'lede'    => 'Aula virtual con DRM, constancia STPS DC-3 y rutas por rol: contador, administrador, gerente de restaurante o IT manager.',
     'ctaA'    => ['label' => 'Explorar Academia',      'href' => url('/campus')],
     'ctaB'    => ['label' => 'Ver catálogo de cursos', 'href' => url('/campus')],
     'dotLabel' => 'Academia Logia'],
];

$slideMeta = [
    ['color' => '#FF6B00', 'bg' => 'linear-gradient(140deg,#FFF5F0,#FFFFFF)'],
    ['color' => '#009DFF', 'bg' => 'linear-gradient(140deg,#EBF7FF,#FFFFFF)'],
    ['color' => '#E25724', 'bg' => 'linear-gradient(140deg,#FFF1ED,#FFFFFF)'],
    ['color' => '#E42527', 'bg' => 'linear-gradient(140deg,#FFF0F0,#FFFFFF)'],
    ['color' => '#05A6F0', 'bg' => 'linear-gradient(140deg,#E8F4FD,#FFFFFF)'],
    ['color' => '#7C3AED', 'bg' => 'linear-gradient(140deg,#F5F0FF,#FFFFFF)'],
];

/* ── Service strip ────────────────────────────────────────────────────────── */
$services = [
    ['icon' => 'consulting', 'title' => 'Consultoría de negocio',
     'body' => 'Diagnosticamos procesos y recomendamos la stack correcta — Aspel, Zoho o Microsoft — para tu etapa.',
     'meta' => '20+ años · 1,300+ empresas'],
    ['icon' => 'impl',       'title' => 'Implementación',
     'body' => 'Migraciones, parametrización y puesta en marcha con consultores certificados por cada fabricante.',
     'meta' => 'Metodología Logia 6 fases'],
    ['icon' => 'training',   'title' => 'Capacitación DC-3',
     'body' => 'Cursos avalados con constancia STPS. Presencial en WTC, Coapa, Polanco o 100% remoto.',
     'meta' => 'Academia Logia online'],
    ['icon' => 'support',    'title' => 'Soporte en sitio y remoto',
     'body' => 'Mesa de ayuda, monitoreo y SLA empresarial. Respuesta en <15 min para clientes Premium.',
     'meta' => 'CDMX + 24/7 remoto'],
];

/* ── Soluciones destacadas — 4 por tab ───────────────────────────────────── */
$tabs = [
    'todos' => [
        ['slug' => 'aspel-coi',  'brandTag' => 'SA',   'brandLogo' => '/images/brands/siigo.png',
         'brandColor' => '#009DFF', 'name' => 'Aspel COI 11',
         'desc' => 'Contabilidad integral con CFDI 4.0, contabilidad electrónica y DIOT 2025.',
         'price' => '$4,373', 'priceMeta' => 'anual · 1 usuario', 'badge' => 'Best-seller',
         'route' => route('partner.aspel')],
        ['slug' => 'soft-pro',   'brandTag' => 'SR',   'brandLogo' => '/images/brands/softrestauran.png',
         'brandColor' => '#E25724', 'name' => 'Soft Restaurant Pro',
         'desc' => 'POS para restaurante con 3 cajas, inventarios y recetas integradas.',
         'price' => '$18,500', 'priceMeta' => 'anual · 3 cajas', 'badge' => 'Hospitality',
         'route' => route('partner.soft')],
        ['slug' => 'zoho-crm',   'brandTag' => 'Z1',   'brandLogo' => '/images/brands/zoho-logo-web.svg',
         'brandColor' => '#E42527', 'name' => 'Zoho CRM Plus',
         'desc' => 'CRM + automatización de marketing + helpdesk en un solo plan.',
         'price' => '$2,399', 'priceMeta' => 'usuario/mes', 'badge' => 'Más cotizado',
         'route' => route('partner.zoho')],
        ['slug' => 'm365-std',   'brandTag' => 'M365', 'brandLogo' => '/images/brands/Microsoft.png',
         'brandColor' => '#05A6F0', 'name' => 'M365 Business Standard',
         'desc' => 'Apps de escritorio Office, Teams, correo corporativo y OneDrive 1TB.',
         'price' => '$320', 'priceMeta' => 'usuario/mes', 'badge' => 'PyME',
         'route' => route('partner.microsoft')],
    ],
    'emprendedor' => [
        ['slug' => 'aspel-adm',     'brandTag' => 'SA',   'brandLogo' => '/images/brands/siigo.png',
         'brandColor' => '#009DFF', 'name' => 'Aspel ADM',
         'desc' => 'Facturas, inventarios y clientes en la nube. Sin instalación, desde cualquier dispositivo.',
         'price' => '$148', 'priceMeta' => 'usuario/mes anual', 'badge' => 'Nube',
         'route' => route('partner.aspel')],
        ['slug' => 'aspel-facture', 'brandTag' => 'SA',   'brandLogo' => '/images/brands/siigo.png',
         'brandColor' => '#009DFF', 'name' => 'Aspel FACTURE',
         'desc' => 'Facturas, honorarios, notas de crédito y viáticos. CFDI 4.0 completo.',
         'price' => '$174', 'priceMeta' => 'usuario/mes anual', 'badge' => 'Fácil',
         'route' => route('partner.aspel')],
        ['slug' => 'zoho-books',    'brandTag' => 'Z1',   'brandLogo' => '/images/brands/zoho-logo-web.svg',
         'brandColor' => '#E42527', 'name' => 'Zoho Books MX',
         'desc' => 'Contabilidad en la nube con facturación CFDI y bancos mexicanos conectados.',
         'price' => '$399', 'priceMeta' => 'usuario/mes', 'badge' => 'CFDI',
         'route' => route('partner.zoho')],
        ['slug' => 'm365-basic',    'brandTag' => 'M365', 'brandLogo' => '/images/brands/Microsoft.png',
         'brandColor' => '#05A6F0', 'name' => 'M365 Business Basic',
         'desc' => 'Correo corporativo, Teams y OneDrive 1TB. Ideal para equipos que empiezan.',
         'price' => '$120', 'priceMeta' => 'usuario/mes', 'badge' => 'Inicio',
         'route' => route('partner.microsoft')],
    ],
    'pyme' => [
        ['slug' => 'aspel-sae',  'brandTag' => 'SA',   'brandLogo' => '/images/brands/siigo.png',
         'brandColor' => '#009DFF', 'name' => 'Aspel SAE 10',
         'desc' => 'Ciclo compra-venta, inventarios, sucursales y facturación CFDI 4.0.',
         'price' => '$8,670', 'priceMeta' => 'anual · 1 usuario', 'badge' => 'Administración',
         'route' => route('partner.aspel')],
        ['slug' => 'aspel-noi',  'brandTag' => 'SA',   'brandLogo' => '/images/brands/siigo.png',
         'brandColor' => '#009DFF', 'name' => 'Aspel NOI 11',
         'desc' => 'Nómina con CFDI 4.0, prestaciones de ley y cálculo de finiquitos.',
         'price' => '$5,310', 'priceMeta' => 'anual · 1 usuario', 'badge' => 'Nómina',
         'route' => route('partner.aspel')],
        ['slug' => 'soft-lite',  'brandTag' => 'SR',   'brandLogo' => '/images/brands/softrestauran.png',
         'brandColor' => '#E25724', 'name' => 'Soft Restaurant Lite',
         'desc' => 'Para cafeterías y foodtrucks. 1 caja, inventario y facturación incluida.',
         'price' => '$8,900', 'priceMeta' => 'anual · 1 caja', 'badge' => 'Starter',
         'route' => route('partner.soft')],
        ['slug' => 'm365-std',   'brandTag' => 'M365', 'brandLogo' => '/images/brands/Microsoft.png',
         'brandColor' => '#05A6F0', 'name' => 'M365 Business Standard',
         'desc' => 'Apps de escritorio Office, Teams, correo y OneDrive 1TB.',
         'price' => '$320', 'priceMeta' => 'usuario/mes', 'badge' => 'PyME',
         'route' => route('partner.microsoft')],
    ],
    'enterprise' => [
        ['slug' => 'm365-prem',  'brandTag' => 'M365', 'brandLogo' => '/images/brands/Microsoft.png',
         'brandColor' => '#05A6F0', 'name' => 'M365 Business Premium',
         'desc' => 'Intune MDM + Defender for Business + Azure AD. Seguridad empresarial.',
         'price' => '$450', 'priceMeta' => 'usuario/mes', 'badge' => 'Seguridad',
         'route' => route('partner.microsoft')],
        ['slug' => 'aspel-coi',  'brandTag' => 'SA',   'brandLogo' => '/images/brands/siigo.png',
         'brandColor' => '#009DFF', 'name' => 'Aspel COI 11',
         'desc' => 'Contabilidad electrónica, DIOT 2025 y módulo fiscal SAT completo.',
         'price' => '$4,373', 'priceMeta' => 'anual · 1 usuario', 'badge' => 'Contabilidad',
         'route' => route('partner.aspel')],
        ['slug' => 'zoho-one',   'brandTag' => 'Z1',   'brandLogo' => '/images/brands/zoho-logo-web.svg',
         'brandColor' => '#E42527', 'name' => 'Zoho One',
         'desc' => 'Suite completa de 45+ aplicaciones empresariales en un solo login.',
         'price' => '$1,299', 'priceMeta' => 'usuario/mes', 'badge' => 'Todo en 1',
         'route' => route('partner.zoho')],
        ['slug' => 'soft-pro',   'brandTag' => 'SR',   'brandLogo' => '/images/brands/softrestauran.png',
         'brandColor' => '#E25724', 'name' => 'Soft Restaurant Pro',
         'desc' => 'POS completo con 3 cajas, inventarios, recetas y delivery integrado.',
         'price' => '$18,500', 'priceMeta' => 'anual · 3 cajas', 'badge' => 'Hospitality',
         'route' => route('partner.soft')],
    ],
];

/* ── Testimoniales ────────────────────────────────────────────────────────── */
$testimonials = [
    ['quote' => 'Logia implementó Aspel COI en solo 15 días. Migramos 3 años de contabilidad sin un solo error. Su equipo conoce el producto mejor que nadie.',
     'name' => 'Lic. María González', 'role' => 'Directora — Despacho Fiscal MG',
     'brandColor' => '#009DFF', 'brandName' => 'Siigo Aspel', 'initials' => 'MG'],
    ['quote' => 'Con Soft Restaurant Pro abrimos nuestra segunda sucursal sin caos. Las comandas digitales redujeron los errores de pedido a cero desde el primer día.',
     'name' => 'Chef Rodrigo Herrera', 'role' => 'Propietario — Taberna Don Rodrigo',
     'brandColor' => '#E25724', 'brandName' => 'Soft Restaurant', 'initials' => 'RH'],
    ['quote' => 'Zoho One centralizó nuestro CRM, contabilidad y RRHH. Logia nos capacitó en tres sesiones. Llevamos 2 años creciendo con el mismo sistema.',
     'name' => 'Ing. Carlos Mendoza', 'role' => 'COO — Distribuidora Mendoza SA',
     'brandColor' => '#E42527', 'brandName' => 'Zoho One', 'initials' => 'CM'],
    ['quote' => 'Microsoft 365 transformó el trabajo remoto de nuestros 80 empleados. Logia migró todos los correos en un fin de semana sin downtime ni pérdida de datos.',
     'name' => 'Dra. Laura Paz', 'role' => 'CEO — Grupo Paz & Asociados',
     'brandColor' => '#05A6F0', 'brandName' => 'Microsoft 365', 'initials' => 'LP'],
    ['quote' => 'Aspel SAE conectó nuestras 4 sucursales en tiempo real. El inventario consolidado que no teníamos en años, listo en 3 semanas de implementación.',
     'name' => 'Alberto Ríos', 'role' => 'Director de Operaciones — Ferretería Ríos',
     'brandColor' => '#009DFF', 'brandName' => 'Siigo Aspel', 'initials' => 'AR'],
    ['quote' => 'Los cursos DC-3 de la Academia Logia certificaron a 12 contadores de nuestro despacho. Online, prácticos y con constancia STPS reconocida.',
     'name' => 'CPC Sandra Torres', 'role' => 'Socia fundadora — Torres & Consultores',
     'brandColor' => '#FF6B00', 'brandName' => 'Academia Logia', 'initials' => 'ST'],
];
$testimonialPages = array_chunk($testimonials, 3);

$slidesAlpine = [];
foreach ($slides as $i => $s) {
    $slidesAlpine[] = [
        'logo'  => $s['logo'],
        'name'  => $s['name'],
        'color' => $slideMeta[$i]['color'],
        'bg'    => $slideMeta[$i]['bg'],
    ];
}
@endphp

@section('content')
<main data-brand="logia">

{{-- ══ HERO ══════════════════════════════════════════════════════════════════ --}}
<section class="hero"
         x-data="heroCarousel({{ count($slides) }}, @json($slidesAlpine))"
         :style="{ background: slides[slide].bg }"
         style="background:linear-gradient(140deg,#FFF5F0,#FFFFFF)">
    <div class="container">
        <div class="hero__inner">

            {{-- Copy --}}
            <div class="hero__copy">

                {{-- Partner badges — act as navigation between brand slides --}}
                <div class="hero__badges" aria-label="Partners oficiales certificados">
                    @foreach([
                        [1, asset('images/brands/siigo.png'),        'Siigo Aspel',    'Partner Gold'],
                        [2, asset('images/brands/softrestauran.png'), 'Soft Restaurant','Distribuidor autorizado'],
                        [3, asset('images/brands/zoho-logo-web.svg'),'Zoho Partner',   'Authorized Partner'],
                        [4, asset('images/brands/Microsoft.png'),    'Microsoft 365',  'Solutions Partner'],
                    ] as [$idx, $bLogo, $bName, $bTag])
                    <button type="button"
                            class="hero__badge"
                            :class="{ 'hero__badge--active': slide === {{ $idx }} }"
                            @click="goTo({{ $idx }})"
                            title="{{ $bName }} — {{ $bTag }}">
                        <img src="{{ $bLogo }}" alt="{{ $bName }}"
                             onerror="this.parentElement.style.display='none'">
                    </button>
                    @endforeach
                </div>

                {{-- Per-slide text (SSR + class-toggle — no FOUC) --}}
                @foreach($slides as $i => $s)
                <div class="{{ $i !== 0 ? 'hero-slide--hidden' : '' }}"
                     :class="{ 'hero-slide--hidden': slide !== {{ $i }} }">
                    <span class="eyebrow">{!! $s['eyebrow'] !!}</span>
                    <h1 class="hero__title">
                        <em>{{ $s['titleEm'] }}</em>{{ $s['titleB'] }}
                    </h1>
                    <p class="hero__lede">{{ $s['lede'] }}</p>
                    <div class="hero__ctas">
                        <a href="{{ $s['ctaA']['href'] }}" class="c-btn c-btn--lg"
                           style="background:{{ $slideMeta[$i]['color'] }};border-color:{{ $slideMeta[$i]['color'] }}">
                            {{ $s['ctaA']['label'] }}
                        </a>
                        <a href="{{ $s['ctaB']['href'] }}" class="c-btn c-btn--ghost c-btn--lg">{{ $s['ctaB']['label'] }}</a>
                    </div>
                </div>
                @endforeach

            </div>

            {{-- Visual 3D — tilt handled by heroCarousel onMove/onLeave --}}
            <div class="hero__visual" aria-hidden="true"
                 x-ref="visualWrap"
                 @pointermove="onMove"
                 @pointerleave="onLeave"
                 style="perspective:1400px;position:relative;min-height:460px">
                <div x-ref="stage" style="position:relative;width:100%;height:460px;transform-style:preserve-3d;transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1)">
                    <svg viewBox="0 0 560 460" style="position:absolute;inset:0;width:100%;height:100%" aria-hidden="true">
                        <ellipse cx="280" cy="230" rx="240" ry="140" fill="none" stroke="var(--border)" stroke-width="1" stroke-dasharray="2 6"/>
                        <ellipse cx="280" cy="230" rx="190" ry="110" fill="none" stroke="var(--border)" stroke-width="1"/>
                        <circle cx="280" cy="230" r="140" :fill="slides[slide].color" opacity="0.08"/>
                    </svg>
                    {{-- Logo central — fades to the current brand logo --}}
                    <div style="position:absolute;left:50%;top:50%;width:210px;height:210px;margin-left:-105px;margin-top:-105px;display:grid;place-items:center;transform:translateZ(40px);transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1)">
                        <img src="{{ asset('images/Original_Logo_Logia_Consulting.png') }}"
                             :src="slides[slide].logo"
                             :alt="slides[slide].name"
                             x-ref="centerLogo"
                             style="width:100%;height:100%;object-fit:contain;transition:opacity 220ms ease">
                    </div>
                    {{-- Card: clientes --}}
                    <div data-depth="70" style="position:absolute;left:24px;top:40px;width:168px;height:96px;transform:translateZ(70px);transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1);border-radius:14px;background:var(--surface);border:1px solid var(--border);box-shadow:0 27px 59px rgba(15,23,42,0.14);padding:14px">
                        <div style="font-size:28px;font-weight:700;color:var(--text);letter-spacing:-0.02em">2,000+</div>
                        <div style="font-size:12px;color:var(--text-muted);margin-top:4px">Clientes activos</div>
                        <div style="margin-top:12px;height:6px;border-radius:4px;background:var(--surface-2);overflow:hidden">
                            <div :style="{ width: '82%', height: '100%', background: slides[slide].color }"></div>
                        </div>
                    </div>
                    {{-- Pill: partner certificado --}}
                    <div data-depth="90" style="position:absolute;left:380px;top:20px;width:155px;height:52px;transform:translateZ(90px);transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1);border-radius:14px;box-shadow:0 32px 69px rgba(15,23,42,0.15);padding:0 16px;display:flex;align-items:center;gap:10px"
                         :style="{ background: slides[slide].color }">
                        <span style="width:8px;height:8px;border-radius:50%;background:#fff;flex-shrink:0"></span>
                        <div style="color:#fff">
                            <div style="font-size:13px;font-weight:700;line-height:1.1">Partner certificado</div>
                            <div style="font-size:11px;opacity:.85;margin-top:2px">4 ecosistemas</div>
                        </div>
                    </div>
                    {{-- Circle: años --}}
                    <div data-depth="110" style="position:absolute;left:400px;top:280px;width:130px;height:130px;transform:translateZ(110px);transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1);border-radius:50%;box-shadow:0 37px 79px rgba(15,23,42,0.16);display:grid;place-items:center"
                         :style="{ background: slides[slide].color }">
                        <div style="text-align:center;color:#fff">
                            <div style="font-size:32px;font-weight:700;letter-spacing:-0.02em">25+</div>
                            <div style="font-size:11px;opacity:.9;letter-spacing:.1em;text-transform:uppercase;margin-top:2px">años</div>
                        </div>
                    </div>
                    {{-- Card: satisfacción --}}
                    <div data-depth="60" style="position:absolute;left:30px;top:300px;width:188px;height:100px;transform:translateZ(60px);transition:transform 160ms cubic-bezier(0.2,0.8,0.2,1);border-radius:14px;background:var(--surface);border:1px solid var(--border);box-shadow:0 24px 54px rgba(15,23,42,0.13);padding:14px">
                        <div style="font-size:10px;font-weight:700;color:var(--text-muted);letter-spacing:.12em;text-transform:uppercase;margin-bottom:10px">Satisfacción</div>
                        <div style="font-size:26px;font-weight:700;color:var(--text);letter-spacing:-0.02em">97.3%</div>
                        <div style="margin-top:10px;height:6px;border-radius:4px;background:var(--surface-2);overflow:hidden">
                            <div :style="{ width: '97.3%', height: '100%', background: slides[slide].color }"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══ STATS STRIP ═════════════════════════════════════════════════════════ --}}
<section class="stats-strip">
    <div class="container">
        <p class="stats-strip__title">Nuestra Trayectoria en Números</p>
        <div class="stats-strip__grid">
            <div class="stats-strip__item">
                <strong class="stats-strip__num">+2,000</strong>
                <span class="stats-strip__label">Clientes</span>
            </div>
            <div class="stats-strip__item">
                <strong class="stats-strip__num">+4,600</strong>
                <span class="stats-strip__label">Usuarios</span>
            </div>
            <div class="stats-strip__item">
                <strong class="stats-strip__num">+1,700</strong>
                <span class="stats-strip__label">Cursos</span>
            </div>
            <div class="stats-strip__item">
                <strong class="stats-strip__num">25<small>+</small></strong>
                <span class="stats-strip__label">Años de experiencia</span>
            </div>
            <div class="stats-strip__item">
                <strong class="stats-strip__num">97.3<small>%</small></strong>
                <span class="stats-strip__label">Satisfacción</span>
            </div>
        </div>
    </div>
</section>

{{-- ══ SOLUCIONES DESTACADAS ════════════════════════════════════════════════ --}}
<section class="featured" x-data="{ tab: 'todos' }">
    <div class="container">
        <div class="featured__head">
            <div>
                <span class="eyebrow">Soluciones destacadas</span>
                <h2 style="margin-top:16px">Una licencia, una factura, un soporte.</h2>
            </div>
            <div class="featured__tabs" role="tablist" aria-label="Filtro por segmento">
                @foreach(['todos' => 'Todos', 'emprendedor' => 'Emprendedor', 'pyme' => 'PyME', 'enterprise' => 'Enterprise'] as $k => $l)
                <button :aria-pressed="tab === '{{ $k }}'" @click="tab = '{{ $k }}'">{{ $l }}</button>
                @endforeach
            </div>
        </div>

        @foreach($tabs as $tabKey => $products)
        <div class="featured__grid{{ $tabKey !== 'todos' ? ' hero-slide--hidden' : '' }}"
             :class="{ 'hero-slide--hidden': tab !== '{{ $tabKey }}' }">
            @foreach($products as $p)
            <article class="product3d" data-brand="logia"
                     x-data="product3dCard()"
                     @pointermove="onMove"
                     @pointerleave="onLeave">
                <div class="product3d__inner" x-ref="inner">
                    <header class="product3d__header">
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

{{-- ══ SERVICE STRIP ═══════════════════════════════════════════════════════ --}}
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

{{-- ══ SOPORTE (negocio principal — implementación y soporte) ══════════════ --}}
<section class="support">
    <div class="container">
        <div class="support__grid">
            <div>
                <span class="eyebrow">Soporte técnico · Implementación</span>
                <h2 style="margin-top:16px;margin-bottom:16px">Cuando algo se cae, no queremos que esperes.</h2>
                <p class="lede" style="margin-bottom:28px">Equipo certificado en México, mesa de ayuda en español y SLA contractual. No tercerizamos soporte — todo lo resuelve un consultor Logia que conoce tu sistema.</p>
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
                    <article class="support-card">
                        <span class="support-card__tag">Implementación</span>
                        <h4>Puesta en marcha certificada</h4>
                        <p>Metodología Logia de 6 fases: diagnóstico, parametrización, migración, capacitación, go-live y acompañamiento.</p>
                    </article>
                    <article class="support-card">
                        <span class="support-card__tag">SLA Empresarial</span>
                        <h4>Consultor asignado</h4>
                        <p>Un especialista Logia conoce tu setup, tus procesos y tu equipo. No empiezas de cero en cada llamada.</p>
                    </article>
                </div>
            </div>
            <aside class="support__visual">
                <span class="eyebrow" style="color:var(--primary)">Plan Enterprise</span>
                <h2 style="margin-top:16px">Soporte dedicado con consultor asignado.</h2>
                <p>Respuesta garantizada, seguimiento proactivo y revisiones periódicas de tu sistema.</p>
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

{{-- ══ TESTIMONIALES (auto-running carousel) ═══════════════════════════════ --}}
<section class="testimonials" x-data="testimonialCarousel({{ count($testimonialPages) }})">
    <div class="container">
        <div class="testimonials__head">
            <div>
                <span class="eyebrow">Lo que dicen nuestros clientes</span>
                <h2 style="margin-top:16px">+1,300 empresas han elegido Logia Consulting.</h2>
            </div>
            <div class="testimonials__nav">
                <button class="testimonials__arrow" @click="prev()" aria-label="Testimoniales anteriores">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <button class="testimonials__arrow" @click="next()" aria-label="Testimoniales siguientes">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        </div>

        @foreach($testimonialPages as $pi => $group)
        <div class="{{ $pi !== 0 ? 'hero-slide--hidden' : '' }}"
             :class="{ 'hero-slide--hidden': page !== {{ $pi }} }">
            <div class="testimonials__grid">
                @foreach($group as $t)
                <article class="testimonial-card">
                    <div class="testimonial-card__head">
                        <span class="testimonial-card__quote" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor"><path d="M11.192 15.757c0-.88-.23-1.618-.69-2.217-.326-.412-.768-.683-1.327-.812-.55-.128-1.07-.137-1.54-.028-.16-.95.1-1.956.76-3.022.66-1.065 1.515-1.867 2.558-2.403L9.373 5c-.8.396-1.56.898-2.26 1.505-.71.607-1.34 1.305-1.9 2.094s-.98 1.68-1.25 2.69-.346 2.04-.217 3.1c.168 1.4.62 2.52 1.356 3.35.735.84 1.652 1.26 2.748 1.26.965 0 1.766-.29 2.4-.878.628-.576.94-1.365.94-2.368zm9.124 0c0-.88-.23-1.618-.69-2.217-.326-.42-.77-.692-1.327-.817-.56-.124-1.074-.13-1.54-.022-.16-.94.09-1.95.75-3.02.66-1.06 1.514-1.86 2.557-2.4L18.49 5c-.8.396-1.555.898-2.26 1.505-.708.607-1.34 1.305-1.894 2.094-.556.79-.97 1.68-1.24 2.69-.273 1-.345 2.04-.217 3.1.168 1.4.62 2.52 1.356 3.35.735.84 1.652 1.26 2.748 1.26.965 0 1.766-.29 2.4-.878.628-.576.94-1.365.94-2.368z"/></svg>
                        </span>
                        <span class="testimonial-card__tag" style="background:{{ $t['brandColor'] }}">{{ $t['brandName'] }}</span>
                    </div>
                    <p class="testimonial-card__quote-text">{{ $t['quote'] }}</p>
                    <div class="testimonial-card__foot">
                        <div class="testimonial-card__avatar" style="background:{{ $t['brandColor'] }}">{{ $t['initials'] }}</div>
                        <div>
                            <div class="testimonial-card__name">{{ $t['name'] }}</div>
                            <div class="testimonial-card__role">{{ $t['role'] }}</div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endforeach

        <div class="testimonials__dots" style="margin-top:32px">
            @foreach($testimonialPages as $pi => $_)
            <button class="testimonials__dot"
                    :class="{ 'is-active': page === {{ $pi }} }"
                    @click="page = {{ $pi }}"
                    aria-label="Página {{ $pi + 1 }} de testimoniales"></button>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ ACADEMIA (sección prominente — reemplaza Campus) ════════════════════ --}}
<section class="academia">
    <div class="container">
        <div class="academia__band">
            <div class="academia__copy">
                <span class="eyebrow academia__eyebrow">Academia Logia · E-learning certificado</span>
                <h2 class="academia__title">
                    <em>Certifica</em> a tu equipo.<br>Sin salir de la oficina.
                </h2>
                <p class="academia__lede">
                    Aula virtual con video DRM, constancia STPS DC-3 y rutas de aprendizaje por rol. Presencial en WTC, Coapa y Polanco — o 100% remoto desde cualquier dispositivo.
                </p>
                <div class="academia__stats">
                    <div><b>200+</b><span>Cursos certificados</span></div>
                    <div><b>DC-3</b><span>Constancia STPS</span></div>
                    <div><b>4 marcas</b><span>Aspel · Zoho · Soft · M365</span></div>
                </div>
                <div class="academia__bullets">
                    <div class="academia__bullet">
                        <span style="color:#FF6B00;font-weight:700">✓</span>
                        <span>Contenido protegido con DRM — sin descargas no autorizadas</span>
                    </div>
                    <div class="academia__bullet">
                        <span style="color:#FF6B00;font-weight:700">✓</span>
                        <span>Certificados PDF personalizados con sello Logia y constancia STPS</span>
                    </div>
                    <div class="academia__bullet">
                        <span style="color:#FF6B00;font-weight:700">✓</span>
                        <span>Planes empresa desde 5 usuarios — factura a tu RFC al instante</span>
                    </div>
                </div>
                <div class="academia__ctas">
                    <a href="{{ url('/campus') }}" class="c-btn c-btn--lg"
                       style="background:#FF6B00;border-color:#FF6B00;color:#fff">Explorar Academia</a>
                    <a href="{{ route('booking') }}" class="c-btn c-btn--ghost c-btn--lg"
                       style="border-color:rgba(255,255,255,0.25);color:rgba(255,255,255,0.85)">Hablar con un asesor</a>
                </div>
            </div>
            <div class="academia__visual" aria-hidden="true">
                <div class="academia__course-card">
                    <div class="academia__cc-left" style="background:#009DFF">
                        <div class="academia__cc-label">Curso · Aspel</div>
                        <div class="academia__cc-name">Aspel COI — Nivel básico</div>
                        <div class="academia__cc-link">Ver módulos <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg></div>
                    </div>
                    <div class="academia__cc-right">
                        <div class="academia__cc-chapter">Módulo 4</div>
                        <div class="academia__cc-lesson">Contabilidad Electrónica SAT</div>
                        <div class="academia__cc-progress">4/6 módulos completados</div>
                        <a href="{{ url('/campus') }}" class="academia__cc-cta">Continuar</a>
                    </div>
                </div>
                <div class="academia__course-card" style="margin-top:12px;transform:translateX(14px)">
                    <div class="academia__cc-left" style="background:#E42527">
                        <div class="academia__cc-label">Curso · Zoho</div>
                        <div class="academia__cc-name">Zoho CRM — Administrador</div>
                        <div class="academia__cc-link">Ver módulos <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg></div>
                    </div>
                    <div class="academia__cc-right">
                        <div class="academia__cc-chapter">Módulo 2</div>
                        <div class="academia__cc-lesson">Automatización de ventas</div>
                        <div class="academia__cc-progress">2/8 módulos completados</div>
                        <a href="{{ url('/campus') }}" class="academia__cc-cta">Continuar</a>
                    </div>
                </div>
                <div class="academia__course-card" style="margin-top:12px;transform:translateX(-8px)">
                    <div class="academia__cc-left" style="background:#05A6F0">
                        <div class="academia__cc-label">Curso · Microsoft</div>
                        <div class="academia__cc-name">Microsoft Teams — Usuarios</div>
                        <div class="academia__cc-link">Ver módulos <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg></div>
                    </div>
                    <div class="academia__cc-right">
                        <div class="academia__cc-chapter">Módulo 3</div>
                        <div class="academia__cc-lesson">Reuniones y canales</div>
                        <div class="academia__cc-progress">3/4 módulos completados</div>
                        <a href="{{ url('/campus') }}" class="academia__cc-cta">Continuar</a>
                    </div>
                </div>
                <div class="academia__cert-badge">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="#FF6B00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="rgba(255,107,0,0.15)"/></svg>
                    <div>
                        <div style="font-size:13px;font-weight:700;color:#fff">Constancia oficial DC-3</div>
                        <div style="font-size:11px;color:rgba(255,255,255,0.55);margin-top:2px">Avalada por la Secretaría del Trabajo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ PARTNERS / CERTIFICACIONES ══════════════════════════════════════════ --}}
<section class="certs">
    <div class="container">
        <div style="text-align:center;margin-bottom:32px">
            <span class="eyebrow">Partners oficiales autorizados</span>
            <h2 style="margin-top:16px">4 marcas líderes bajo un solo proveedor certificado.</h2>
        </div>
        <div class="certs__row" style="grid-template-columns:repeat(4,1fr)">
            @foreach([
                ['name' => 'Siigo Aspel',     'logo' => '/images/brands/siigo.png',        'tag' => 'Partner autorizado', 'route' => 'partner.aspel'],
                ['name' => 'Soft Restaurant', 'logo' => '/images/brands/softrestauran.png', 'tag' => 'Partner autorizado', 'route' => 'partner.soft'],
                ['name' => 'Zoho',            'logo' => '/images/brands/zoho-logo-web.svg', 'tag' => 'Partner autorizado', 'route' => 'partner.zoho'],
                ['name' => 'Microsoft 365',   'logo' => '/images/brands/Microsoft.png',     'tag' => 'Solutions Partner',  'route' => 'partner.microsoft'],
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
