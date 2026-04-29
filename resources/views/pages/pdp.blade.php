@extends('layouts.marketing')

@section('title', $product['name'])
@section('meta_description', $product['desc_long'] ?? $product['desc'])
@section('og_title', $product['name'] . ' — ' . $partner['name'] . ' · Logia Consulting')
@section('og_description', $product['desc'])

@section('content')
<main data-brand="{{ $brand }}">

{{-- ══ BREADCRUMB ══════════════════════════════════════════════════════════════ --}}
<section class="breadcrumb">
    <div class="container">
        <ol>
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route($partnerRoute) }}">{{ $partner['name'] }}</a></li>
            <li>{{ $product['name'] }}</li>
        </ol>
    </div>
</section>

{{-- ══ HERO PDP ═════════════════════════════════════════════════════════════════ --}}
<section class="pdp-hero">
    <div class="container">
        <div class="pdp-hero__inner">

            {{-- Copy --}}
            <div class="pdp-hero__copy">
                <span class="partner-hero__partner-badge">
                    <span style="width:8px;height:8px;border-radius:50%;background:var(--primary)"></span>
                    Partner oficial · {{ $partner['name'] }}
                </span>

                <div class="pdp-hero__logo-row">
                    @if($partner['logo'])
                    <img src="{{ $partner['logo'] }}"
                         alt="{{ $partner['name'] }}"
                         class="pdp-hero__brand-img"
                         onerror="this.style.display='none'">
                    @endif
                    <span class="pdp-hero__badge">{{ $product['badge'] }}</span>
                </div>

                <h1>{{ $product['name'] }}</h1>
                <p class="lede" style="margin-top:16px">{{ $product['desc_long'] ?? $product['desc'] }}</p>

                <div class="pdp-hero__price-block">
                    @if($product['precio_mensual'])
                    <div class="pdp-hero__price">
                        <span class="pdp-hero__price-amount">{{ $product['precio_mensual'] }}</span>
                        <span class="pdp-hero__price-meta">{{ $product['priceMeta'] }}</span>
                    </div>
                    <div class="pdp-hero__price-annual">
                        @if($product['price'] !== 'Desde cotización')
                        <span style="color:var(--text-muted);font-size:var(--text-sm)">Total anual: <b style="color:var(--text)">{{ $product['price'] }}</b> MXN + IVA</span>
                        @endif
                    </div>
                    @else
                    <div class="pdp-hero__price">
                        <span class="pdp-hero__price-amount" style="font-size:var(--text-xl)">{{ $product['price'] }}</span>
                        <span class="pdp-hero__price-meta">{{ $product['priceMeta'] }}</span>
                    </div>
                    @endif
                </div>

                <div class="hero__ctas" style="margin-top:28px">
                    <a href="{{ route('carrito', ['marca' => $brand, 'producto' => $product['slug']]) }}"
                       class="c-btn c-btn--lg">Comprar ahora</a>
                    <a href="{{ route('booking') }}" class="c-btn c-btn--ghost c-btn--lg">Hablar con asesor</a>
                </div>

                <p style="margin-top:12px;font-size:var(--text-xs);color:var(--text-muted)">
                    Precios sin IVA. Factura CFDI al RFC de tu empresa.
                </p>
            </div>

            {{-- Visual --}}
            <div class="pdp-hero__visual" aria-hidden="true">
                <div class="pdp-hero__card">
                    <div class="pdp-hero__card-top">
                        @if($partner['logo'])
                        <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}"
                             style="height:32px;width:auto;object-fit:contain"
                             onerror="this.style.display='none'">
                        @endif
                        <span class="pdp-hero__badge pdp-hero__badge--card">{{ $product['badge'] }}</span>
                    </div>
                    <div class="pdp-hero__card-name">{{ $product['name'] }}</div>
                    <div class="pdp-hero__card-desc">{{ $product['desc'] }}</div>
                    <div class="pdp-hero__card-price">
                        @if($product['precio_mensual'])
                        <b>{{ $product['precio_mensual'] }}</b>
                        <span>{{ $product['priceMeta'] }}</span>
                        @else
                        <b>{{ $product['price'] }}</b>
                        <span>{{ $product['priceMeta'] }}</span>
                        @endif
                    </div>
                    <div class="pdp-hero__card-cta">Cotizar con Logia →</div>
                    {{-- trust signals --}}
                    <div class="pdp-hero__card-trust">
                        <span>✓ Factura CFDI inmediata</span>
                        <span>✓ Activación en 24h</span>
                        <span>✓ Soporte Logia incluido</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══ FUNCIONALIDADES ══════════════════════════════════════════════════════════ --}}
@if(!empty($product['features']))
<section class="pdp-features">
    <div class="container">
        <div class="pdp-features__head">
            <span class="eyebrow">Funcionalidades clave</span>
            <h2 style="margin-top:12px">¿Qué incluye {{ $product['name'] }}?</h2>
        </div>
        <ul class="pdp-features__list">
            @foreach($product['features'] as $f)
            <li class="pdp-feature-item">
                <span class="pdp-feature-item__check" aria-hidden="true">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                        <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span>{{ $f }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</section>
@endif

{{-- ══ INTEGRACIONES ════════════════════════════════════════════════════════════ --}}
@if(!empty($product['integrations']))
<section class="pdp-integrations">
    <div class="container">
        <span class="eyebrow">Ecosistema integrado</span>
        <h2 style="margin-top:12px;margin-bottom:24px">Funciona junto con</h2>
        <div class="pdp-integrations__grid">
            @foreach($product['integrations'] as $int)
            <div class="pdp-int-chip">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ $int }}
            </div>
            @endforeach
        </div>
        <p style="margin-top:20px;color:var(--text-muted);font-size:var(--text-sm)">
            Logia configura las integraciones entre sistemas — no tienes que hacerlo tú.
        </p>
    </div>
</section>
@endif

{{-- ══ REQUERIMIENTOS TÉCNICOS ════════════════════════════════════════════════ --}}
@if(!empty($product['specs']))
<section class="pdp-specs">
    <div class="container">
        <div class="pdp-specs__inner">
            <div>
                <span class="eyebrow">Especificaciones</span>
                <h3 style="margin-top:12px">Requerimientos técnicos</h3>
                <p style="margin-top:8px;color:var(--text-muted);font-size:var(--text-sm)">
                    Logia verifica la compatibilidad de tu infraestructura antes de la instalación.
                </p>
            </div>
            <dl class="pdp-specs__table">
                @foreach($product['specs'] as $label => $value)
                <div class="pdp-specs__row">
                    <dt>{{ $label }}</dt>
                    <dd>{{ $value }}</dd>
                </div>
                @endforeach
            </dl>
        </div>
    </div>
</section>
@endif

{{-- ══ POR QUÉ LOGIA ═══════════════════════════════════════════════════════════ --}}
<section class="support">
    <div class="container">
        <div class="support__grid">
            <div>
                <span class="eyebrow">Por qué con Logia</span>
                <h2 style="margin-top:16px;margin-bottom:16px">Tres razones para no comprar licencias sueltas.</h2>
                <div class="support__cards">
                    <article class="support-card">
                        <span class="support-card__tag">1 · Certificados</span>
                        <h4>Partner oficial {{ $partner['name'] }}</h4>
                        <p>Tu licencia pasa por un canal autorizado — factura CFDI inmediata y acceso a updates oficiales.</p>
                    </article>
                    <article class="support-card">
                        <span class="support-card__tag">2 · Implementación</span>
                        <h4>Configuramos el sistema por ti</h4>
                        <p>No solo te entregamos la licencia — la instalamos, configuramos y parametrizamos para tu empresa.</p>
                    </article>
                    <article class="support-card">
                        <span class="support-card__tag">3 · Capacitación</span>
                        <h4>Campus Logia certificado DC-3</h4>
                        <p>Cursos certificados para que tu equipo domine {{ $product['name'] }} desde el día uno.</p>
                    </article>
                    <article class="support-card">
                        <span class="support-card__tag">4 · Soporte</span>
                        <h4>Mesa de ayuda en México</h4>
                        <p>Consultores que conocen tu setup — no tickets que se pierden en soporte del fabricante.</p>
                    </article>
                </div>
            </div>
            <aside class="support__visual" style="background:var(--primary)">
                <span class="eyebrow" style="color:rgba(255,255,255,0.7)">¿Tienes dudas?</span>
                <h2 style="margin-top:16px;color:#fff">Habla con un asesor Logia hoy.</h2>
                <p style="color:rgba(255,255,255,0.85)">
                    Te ayudamos a elegir la edición correcta, verificamos la compatibilidad con tus sistemas actuales y te damos una cotización con factura CFDI en minutos.
                </p>
                <div style="margin-top:28px;display:flex;gap:12px;flex-wrap:wrap">
                    <a href="{{ route('booking') }}" class="c-btn c-btn--lg"
                       style="background:#fff;color:var(--primary)">
                        Agendar demo gratuita
                    </a>
                </div>
                <div class="support__visual-sla" style="margin-top:32px">
                    <div><b style="color:#fff">24h</b><span style="color:rgba(255,255,255,0.75)">Activación de licencia</span></div>
                    <div><b style="color:#fff">20+</b><span style="color:rgba(255,255,255,0.75)">Años de experiencia</span></div>
                    <div><b style="color:#fff">1,300+</b><span style="color:rgba(255,255,255,0.75)">Clientes atendidos</span></div>
                </div>
            </aside>
        </div>
    </div>
</section>

{{-- ══ OTROS PRODUCTOS DEL PARTNER ════════════════════════════════════════════ --}}
@php
$otherProducts = collect($partner['productos'])->where('slug', '!=', $product['slug'])->take(3)->values();
@endphp
@if($otherProducts->count() > 0)
<section class="featured" style="background:var(--surface-2,var(--surface))">
    <div class="container">
        <div class="featured__head">
            <div>
                <span class="eyebrow">También de {{ $partner['name'] }}</span>
                <h2 style="margin-top:12px">Completa tu ecosistema</h2>
            </div>
            <a href="{{ route($partnerRoute) }}"
               class="c-btn c-btn--ghost">
                Ver todos →
            </a>
        </div>
        <div class="featured__grid">
            @foreach($otherProducts as $p)
            <article class="product3d" data-brand="{{ $brand }}"
                     x-data="product3dCard()"
                     @pointermove="onMove"
                     @pointerleave="onLeave">
                <div class="product3d__inner" x-ref="inner">
                    <header class="product3d__header">
                        <span class="product3d__brand-chip"
                              style="background:#fff;border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;min-height:30px">
                            @if($partner['logo'])
                            <img src="{{ $partner['logo'] }}" alt="{{ $partner['tag'] }}"
                                 height="22"
                                 style="height:22px;width:auto;max-width:80px;object-fit:contain"
                                 onerror="this.style.display='none'">
                            @endif
                        </span>
                        <div class="product3d__price">
                            <div class="product3d__price-now">{{ $p['price'] }}</div>
                            <div class="product3d__price-meta">{{ $p['priceMeta'] }}</div>
                        </div>
                    </header>
                    <div class="product3d__visual">
                        <div x-ref="badge" class="product3d__badge">{{ $p['badge'] }}</div>
                    </div>
                    <div>
                        <div class="product3d__title">{{ $p['name'] }}</div>
                        <div class="product3d__meta">{{ $p['desc'] }}</div>
                    </div>
                    <a href="{{ route('pdp', ['brand' => $brand, 'product' => $p['slug']]) }}"
                       class="product3d__cta" style="text-decoration:none">
                        Ver detalle
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

</main>
@endsection
