@extends('layouts.marketing')

@section('title', $data['name'])
@section('meta_description', $data['tagline'])
@section('og_title', $data['name'] . ' — Logia Consulting')

@section('content')
<main data-brand="{{ $brand }}">

{{-- ══ BREADCRUMB ══════════════════════════════════════════════════════════════ --}}
<section class="breadcrumb">
    <div class="container">
        <ol>
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('home') }}">Productos</a></li>
            <li>{{ $data['name'] }}</li>
        </ol>
    </div>
</section>

{{-- ══ HERO PARTNER ════════════════════════════════════════════════════════════ --}}
<section class="partner-hero">
    <div class="container">
        <div class="partner-hero__inner">
            <div class="partner-hero__copy">
                <span class="partner-hero__partner-badge">
                    <span style="width:8px;height:8px;border-radius:50%;background:var(--primary)"></span>
                    Partner oficial Logia · {{ $data['name'] }}
                </span>
                <div class="partner-hero__logo">
                    <span class="partner-hero__logo-mark partner-hero__logo-mark--img">
                        @if($data['logo'])
                            <img src="{{ $data['logo'] }}" alt="{{ $data['name'] }}"
                                 onerror="this.style.display='none';this.parentElement.textContent='{{ $data['tag'] }}'">
                        @else
                            {{ $data['tag'] }}
                        @endif
                    </span>
                    {{ $data['name'] }}
                </div>
                <h1 style="text-wrap:balance">{{ $data['tagline'] }}</h1>
                <p class="lede">{{ $data['hero'] }}</p>
                <div class="hero__ctas" style="margin-top:12px">
                    <button class="c-btn c-btn--lg">Ver productos</button>
                    <a href="{{ route('booking') }}" class="c-btn c-btn--ghost c-btn--lg">Hablar con especialista</a>
                </div>
                <div style="margin-top:32px;display:flex;flex-wrap:wrap;gap:8px">
                    @foreach($data['familia'] as $f)
                    <span style="padding:6px 12px;border-radius:9999px;background:rgba(255,255,255,0.55);border:1px solid var(--border);font-size:12px;font-weight:600;color:var(--text)">
                        {{ $f }}
                    </span>
                    @endforeach
                </div>
            </div>
            {{-- Visual decorativo --}}
            <div aria-hidden="true" style="display:flex;align-items:center;justify-content:center">
                <div style="width:240px;height:240px;border-radius:50%;background:var(--primary-soft,var(--surface-2));display:grid;place-items:center;box-shadow:var(--shadow-xl)">
                    @if($data['logo'])
                    <img src="{{ $data['logo'] }}" alt="{{ $data['name'] }}"
                         style="width:160px;height:160px;object-fit:contain"
                         onerror="this.style.display='none'">
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ PRODUCTOS ════════════════════════════════════════════════════════════════ --}}
<section class="featured" style="background:var(--bg)">
    <div class="container">
        <div class="featured__head">
            <div>
                <span class="eyebrow">Productos {{ $data['name'] }}</span>
                <h2 style="margin-top:16px">Licenciamiento, implementación y soporte — todo por Logia.</h2>
            </div>
        </div>
        <div class="featured__grid">
            @foreach($data['productos'] as $p)
            <article class="product3d" data-brand="{{ $brand }}"
                     x-data="product3dCard()"
                     @pointermove="onMove"
                     @pointerleave="onLeave">
                <div class="product3d__inner" x-ref="inner">
                    <header class="product3d__header">
                        <span class="product3d__brand-chip"
                              style="background:#fff;border:1px solid var(--border);display:inline-flex;align-items:center;justify-content:center;min-height:30px">
                            @if($data['logo'])
                            <img src="{{ $data['logo'] }}" alt="{{ $data['tag'] }}"
                                 height="22"
                                 style="height:22px;width:auto;max-width:80px;object-fit:contain;pointer-events:none;display:block"
                                 onerror="this.style.display='none'">
                            @else
                                <span style="font-size:11px;font-weight:700;letter-spacing:.06em">{{ $data['tag'] }}</span>
                            @endif
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
                                @if($data['logo'])
                                <img src="{{ $data['logo'] }}" alt="{{ $data['tag'] }}"
                                     width="32" height="32"
                                     style="width:32px;height:32px;object-fit:contain;pointer-events:none"
                                     onerror="this.style.display='none'">
                                @endif
                            </div>
                        </div>
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
                        <h4>Partner oficial {{ $data['name'] }}</h4>
                        <p>Tu licencia pasa por un canal autorizado — factura CFDI inmediata y acceso a updates oficiales.</p>
                    </article>
                    <article class="support-card">
                        <span class="support-card__tag">2 · Soporte</span>
                        <h4>Mesa de ayuda en México</h4>
                        <p>Consultores Logia que conocen tu setup. Sin tickets que se pierden en soporte del fabricante.</p>
                    </article>
                    <article class="support-card">
                        <span class="support-card__tag">3 · Campus</span>
                        <h4>Capacitación para tu equipo</h4>
                        <p>Cursos certificados DC-3 para que tus colaboradores dominen la herramienta desde el día uno.</p>
                    </article>
                    <article class="support-card">
                        <span class="support-card__tag">4 · Pagos</span>
                        <h4>Tarjeta, SPEI u OXXO</h4>
                        <p>Factura a tu RFC al instante. También renovamos tus licencias antes de que venzan.</p>
                    </article>
                </div>
            </div>
            <aside class="support__visual" style="background:var(--accent)">
                <span class="eyebrow" style="color:#fff">Caso de éxito</span>
                <h2 style="margin-top:16px;color:#fff">"Logia implementó {{ $data['name'] }} en 21 días."</h2>
                <p style="color:rgba(255,255,255,0.85)">Migramos a más de 120 usuarios desde la versión anterior sin interrumpir operación. Capacitamos al equipo en dos sesiones.</p>
                <div class="support__visual-sla">
                    <div><b style="color:#fff">21</b><span>Días de implementación</span></div>
                    <div><b style="color:#fff">120</b><span>Usuarios migrados</span></div>
                    <div><b style="color:#fff">0</b><span>Horas de downtime</span></div>
                </div>
            </aside>
        </div>
    </div>
</section>

</main>
@endsection
