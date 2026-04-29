@extends('layouts.marketing')

@section('title', 'Carrito de compras')
@section('robots', 'noindex,nofollow')

@section('content')
<main data-brand="logia"
      x-data="cartPage(
          @json($product),
          @json($partner),
          @json($complements),
          @json($logiaSrv),
          {{ $listPrice ?? 'null' }},
          {{ $discountPct }}
      )">

{{-- ══ STEPPER ══════════════════════════════════════════════════════════════════ --}}
<section class="cart-stepper">
    <div class="container">
        <ol class="cart-steps">
            <li class="cart-step is-current">
                <span class="cart-step__num">1</span>
                <span class="cart-step__label">Carrito de compras</span>
            </li>
            <li class="cart-step is-upcoming">
                <span class="cart-step__num">2</span>
                <span class="cart-step__label">Datos de facturación</span>
            </li>
            <li class="cart-step is-upcoming">
                <span class="cart-step__num">3</span>
                <span class="cart-step__label">Pago seguro</span>
            </li>
        </ol>
    </div>
</section>

{{-- ══ CART ═════════════════════════════════════════════════════════════════════ --}}
<section class="cart-section">
    <div class="container">
        <header class="cart__hero">
            <h1>Carrito de compras</h1>
            <p class="lede" style="margin:8px auto 0;text-align:center;max-width:52ch">
                Verifica los productos que elegiste y continúa con el proceso de compra.
            </p>
        </header>

        <div class="cart__grid">

            {{-- ══ COLUMNA IZQUIERDA — productos ════════════════════════════════ --}}
            <div class="cart__main">

                {{-- Estado vacío si no hay producto --}}
                @if(!$product)
                <div class="cart-empty">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    <p>Tu carrito está vacío</p>
                    <a href="{{ route('home') }}" class="c-btn c-btn--ghost">Ver productos</a>
                </div>
                @else

                {{-- ── Producto principal ──────────────────────────────────────── --}}
                <article class="cart-item">
                    <div class="cart-item__head">
                        <div class="cart-item__brand">
                            @if($partner['logo'])
                            <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}"
                                 style="height:28px;width:auto;object-fit:contain"
                                 onerror="this.style.display='none'">
                            @else
                            <span class="cart-item__brand-mark">{{ $partner['tag'] }}</span>
                            @endif
                            <div>
                                <div class="cart-item__brand-name">{{ $partner['name'] }}</div>
                                <a href="{{ route($partnerRoute) }}" class="cart-item__details">Ver landing →</a>
                            </div>
                        </div>
                        <div class="cart-item__price-block">
                            <template x-if="periodObj.discount > 0">
                                <span class="cart-item__discount-pill"
                                      x-text="'-' + Math.round(periodObj.discount * 100) + '%'"></span>
                            </template>
                            <div class="cart-item__price-now" x-text="fmt(displayTotal)"></div>
                            <div class="cart-item__price-suffix" x-text="periodSuffix"></div>
                        </div>
                    </div>

                    <div class="cart-item__name">
                        <span>{{ $product['name'] }}</span>
                        <span class="cart-item__badge" style="background:var(--primary-soft);color:var(--primary)">
                            {{ $product['badge'] }}
                        </span>
                    </div>

                    <div class="cart-item__config">
                        {{-- Periodicidad --}}
                        <div class="cart-field">
                            <span class="cart-field__label">Periodicidad</span>
                            <div class="cart-period-tabs">
                                <button type="button"
                                        @click="period = 'mensual'"
                                        :class="{ 'is-active': period === 'mensual' }"
                                        class="cart-period-tab">
                                    Mensual
                                    @if($listPrice)
                                    <small>${{ number_format($listPrice, 2) }}/mes</small>
                                    @endif
                                </button>
                                <button type="button"
                                        @click="period = 'anual'"
                                        :class="{ 'is-active': period === 'anual' }"
                                        class="cart-period-tab">
                                    Anual
                                    @if($discountPct)
                                    <small class="cart-period-tab__badge">-{{ $discountPct }}%</small>
                                    @endif
                                    <small>${{ $product['precio_mensual'] }}/mes</small>
                                </button>
                                <button type="button"
                                        @click="period = 'tres'"
                                        :class="{ 'is-active': period === 'tres' }"
                                        class="cart-period-tab">
                                    3 años
                                    <small class="cart-period-tab__badge">Mejor precio</small>
                                </button>
                            </div>
                        </div>

                        {{-- Número de usuarios --}}
                        <div class="cart-field">
                            <span class="cart-field__label">Número de usuarios</span>
                            <div class="cart-stepper-input">
                                <button type="button" @click="users = Math.max(1, users - 1)" aria-label="Quitar usuario">−</button>
                                <span x-text="users"></span>
                                <button type="button" @click="users++" aria-label="Agregar usuario">+</button>
                            </div>
                            <span class="cart-field__hint">Usuarios adicionales tienen costo extra.</span>
                        </div>

                        {{-- Póliza distribuidor --}}
                        <div class="cart-field">
                            <span class="cart-field__label">Póliza de distribuidor <em style="font-style:normal;font-weight:400;color:var(--text-muted)">(opcional)</em></span>
                            <input type="text" class="cart-input" placeholder="Código de póliza" x-model="poliza">
                        </div>
                    </div>
                </article>

                {{-- ── Servicios Logia ─────────────────────────────────────────── --}}
                <h3 class="cart-section-title">
                    Servicios Logia — que tu inversión rinda desde el día 1
                </h3>
                <div class="cart-services">
                    @foreach($logiaSrv as $srv)
                    <article class="cart-srv"
                             :class="{ 'is-added': addedSrv.includes('{{ $srv['slug'] }}') }">
                        <div class="cart-srv__icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="{{ $srv['icon'] }}"/>
                            </svg>
                        </div>
                        <div class="cart-srv__body">
                            <div class="cart-srv__name">{{ $srv['name'] }}</div>
                            <div class="cart-srv__desc">{{ $srv['desc'] }}</div>
                            <div class="cart-srv__price">${{ number_format($srv['price'], 0, '.', ',') }} <span>MXN + IVA</span></div>
                        </div>
                        <button type="button"
                                class="cart-srv__btn"
                                @click="toggleSrv('{{ $srv['slug'] }}', {{ $srv['price'] }})">
                            <span x-show="!addedSrv.includes('{{ $srv['slug'] }}')">Agregar</span>
                            <span x-show="addedSrv.includes('{{ $srv['slug'] }}')" style="display:none">✓ Agregado</span>
                        </button>
                    </article>
                    @endforeach
                </div>

                {{-- ── Productos complementarios ───────────────────────────────── --}}
                @if(count($complements) > 0)
                <h3 class="cart-section-title">Productos complementarios — ecosistema integrado</h3>
                <div class="cart-complements">
                    @foreach(array_slice($complements, 0, 4) as $c)
                    <article class="cart-comp"
                             :class="{ 'is-added': addedProd.includes('{{ $c['slug'] }}') }">
                        @if($partner['logo'])
                        <img src="{{ $partner['logo'] }}" alt="{{ $partner['tag'] }}"
                             style="height:20px;width:auto;object-fit:contain;opacity:.7"
                             onerror="this.style.display='none'">
                        @endif
                        <div class="cart-comp__body">
                            <div class="cart-comp__name">{{ $c['name'] }}</div>
                            <div class="cart-comp__desc">{{ $c['desc'] }}</div>
                            <div class="cart-comp__price">
                                @if($c['precio_mensual'])
                                <b>{{ $c['precio_mensual'] }}</b><span>/mes plan anual</span>
                                @else
                                <b>{{ $c['price'] }}</b><span>{{ $c['priceMeta'] }}</span>
                                @endif
                            </div>
                        </div>
                        <button type="button"
                                class="cart-comp__btn"
                                @click="toggleProd('{{ $c['slug'] }}', {{ str_replace(['$',','], '', $c['price']) ?? 0 }})">
                            <span x-show="!addedProd.includes('{{ $c['slug'] }}')">+ Agregar</span>
                            <span x-show="addedProd.includes('{{ $c['slug'] }}')" style="display:none">✓ Agregado</span>
                        </button>
                    </article>
                    @endforeach
                </div>
                @endif

                @endif {{-- end @if($product) --}}
            </div>

            {{-- ══ COLUMNA DERECHA — resumen de compra ══════════════════════════ --}}
            <aside class="cart__summary">
                <h3>Resumen de compra</h3>

                @if($product)
                <div class="cart__summary-section">
                    <h4>Productos y servicios</h4>
                    <ul class="cart__summary-list">
                        <li>
                            <span>{{ $product['name'] }} <em x-text="'· ' + periodLabel"></em></span>
                            <span x-text="fmt(mainTotal)"></span>
                        </li>
                        <template x-for="(s, i) in addedSrvData" :key="i">
                            <li>
                                <span x-text="s.name"></span>
                                <span x-text="fmt(s.price)"></span>
                            </li>
                        </template>
                        <template x-for="(p, i) in addedProdData" :key="i">
                            <li>
                                <span x-text="p.name"></span>
                                <span x-text="fmt(p.price)"></span>
                            </li>
                        </template>
                    </ul>
                </div>

                <dl class="cart__summary-totals">
                    <div>
                        <dt>Subtotal</dt>
                        <dd x-text="fmt(subtotal)"></dd>
                    </div>
                    <template x-if="codeDiscount > 0">
                        <div class="is-discount">
                            <dt>Descuento código</dt>
                            <dd x-text="'-' + fmt(codeDiscount)"></dd>
                        </div>
                    </template>
                    <div>
                        <dt>IVA 16%</dt>
                        <dd x-text="fmt(tax)"></dd>
                    </div>
                </dl>

                <div class="cart__code">
                    <input type="text" class="cart-input" placeholder="Código de descuento" x-model="code">
                    <button type="button" class="c-btn c-btn--ghost c-btn--sm" @click="applyCode">Validar</button>
                </div>

                <div class="cart__total">
                    <span>Total a pagar</span>
                    <strong x-text="fmt(total)"></strong>
                </div>
                <p style="font-size:11px;color:var(--text-muted);margin-top:4px">Precios en MXN · incluye IVA</p>

                <a href="{{ route('checkout') }}" class="c-btn c-btn--lg cart__cta">
                    Continuar con el pago →
                </a>

                <ul class="cart__trust">
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2"/></svg>
                        Pago seguro — Stripe + OXXO + SPEI
                    </li>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="2" y="5" width="20" height="14" rx="2" stroke="currentColor" stroke-width="2"/><path d="M2 10h20" stroke="currentColor" stroke-width="2"/></svg>
                        Factura CFDI 4.0 al RFC de tu empresa
                    </li>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Activación de licencia en 24 horas hábiles
                    </li>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.24h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.84a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="2"/></svg>
                        Soporte Logia incluido 90 días
                    </li>
                </ul>

                <div style="margin-top:20px;padding-top:16px;border-top:1px solid var(--border)">
                    <p style="font-size:12px;color:var(--text-muted);text-align:center;margin-bottom:12px">¿Prefieres hablar primero?</p>
                    <a href="{{ route('booking') }}" class="c-btn c-btn--ghost"
                       style="width:100%;text-align:center;justify-content:center">
                        Agendar demo gratuita →
                    </a>
                </div>
                @else
                <div style="padding:32px 0;text-align:center;color:var(--text-muted)">
                    <p>Agrega un producto para ver el resumen.</p>
                    <a href="{{ route('home') }}" class="c-btn c-btn--ghost" style="margin-top:16px">Explorar soluciones</a>
                </div>
                @endif
            </aside>

        </div>
    </div>
</section>

</main>
@endsection
