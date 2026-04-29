@extends('layouts.marketing')

@section('title', 'Pago seguro')
@section('robots', 'noindex,nofollow')

@section('content')
<main data-brand="logia" x-data="checkoutPage()">

{{-- ══ STEPPER ══════════════════════════════════════════════════════════════════ --}}
<section class="cart-stepper">
    <div class="container">
        <ol class="cart-steps">
            <li class="cart-step is-done">
                <span class="cart-step__num">✓</span>
                <span class="cart-step__label">Carrito</span>
            </li>
            <li class="cart-step is-current">
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

<section class="cart-section">
    <div class="container">
        <div class="cart__grid">

            {{-- ══ LEFT — Billing + Payment ══════════════════════════════════════ --}}
            <div class="cart__main">

                {{-- Paso visible: billing o payment --}}
                <div x-show="step === 'billing'">
                    <h2 class="ckout-section-title">Datos de facturación</h2>

                    <form class="ckout-form" @submit.prevent="step = 'payment'">
                        <div class="ckout-form__grid">
                            <div class="cart-field ckout-field--full">
                                <label class="cart-field__label" for="rfc">RFC <span style="color:var(--danger)">*</span></label>
                                <input id="rfc" type="text" class="cart-input" placeholder="XAXX010101000"
                                       x-model="rfc" maxlength="13" required>
                                <span class="cart-field__hint">Persona Física o Moral · 12 o 13 caracteres</span>
                            </div>
                            <div class="cart-field ckout-field--full">
                                <label class="cart-field__label" for="razon">Razón Social <span style="color:var(--danger)">*</span></label>
                                <input id="razon" type="text" class="cart-input" placeholder="Mi Empresa S.A. de C.V."
                                       x-model="razonSocial" required>
                            </div>
                            <div class="cart-field">
                                <label class="cart-field__label" for="cp">Código Postal <span style="color:var(--danger)">*</span></label>
                                <input id="cp" type="text" class="cart-input" placeholder="06600"
                                       x-model="cp" maxlength="5" required>
                            </div>
                            <div class="cart-field">
                                <label class="cart-field__label" for="regimen">Régimen Fiscal <span style="color:var(--danger)">*</span></label>
                                <div class="cart-field__select">
                                    <select id="regimen" x-model="regimen" required class="cart-input">
                                        <option value="">Selecciona…</option>
                                        <option value="601">601 · General de Ley Personas Morales</option>
                                        <option value="612">612 · Personas Físicas con Actividades Empresariales</option>
                                        <option value="616">616 · Sin Obligaciones Fiscales</option>
                                        <option value="621">621 · Incorporación Fiscal</option>
                                        <option value="626">626 · Régimen Simplificado de Confianza</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cart-field ckout-field--full">
                                <label class="cart-field__label" for="uso">Uso de CFDI <span style="color:var(--danger)">*</span></label>
                                <div class="cart-field__select">
                                    <select id="uso" x-model="cfdiUso" required class="cart-input">
                                        <option value="G03">G03 · Gastos en general</option>
                                        <option value="I04">I04 · Equipo de cómputo y accesorios</option>
                                        <option value="D10">D10 · Pagos por servicios educativos</option>
                                        <option value="S01">S01 · Sin efectos fiscales</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cart-field">
                                <label class="cart-field__label" for="email">Correo electrónico <span style="color:var(--danger)">*</span></label>
                                <input id="email" type="email" class="cart-input" placeholder="compras@miempresa.com"
                                       x-model="email" required>
                                <span class="cart-field__hint">Recibirás la factura y la licencia aquí</span>
                            </div>
                            <div class="cart-field">
                                <label class="cart-field__label" for="tel">Teléfono</label>
                                <input id="tel" type="tel" class="cart-input" placeholder="55 1234-5678"
                                       x-model="telefono">
                            </div>
                        </div>
                        <button type="submit" class="c-btn c-btn--lg" style="margin-top:24px;width:100%">
                            Continuar al pago →
                        </button>
                    </form>
                </div>

                {{-- Paso de pago --}}
                <div x-show="step === 'payment'" style="display:none">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px">
                        <button type="button" @click="step = 'billing'" class="c-btn c-btn--ghost c-btn--sm">← Atrás</button>
                        <h2 class="ckout-section-title" style="margin:0">Método de pago</h2>
                    </div>

                    {{-- Tabs método de pago --}}
                    <div class="pay-tabs">
                        <button type="button" class="pay-tab" @click="payMethod = 'card'"
                                :class="{ 'is-active': payMethod === 'card' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="2" y="5" width="20" height="14" rx="2" stroke="currentColor" stroke-width="2"/><path d="M2 10h20" stroke="currentColor" stroke-width="2"/></svg>
                            Tarjeta
                        </button>
                        <button type="button" class="pay-tab" @click="payMethod = 'oxxo'"
                                :class="{ 'is-active': payMethod === 'oxxo' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 9h18M3 15h18M12 3v18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            OXXO Pay
                        </button>
                        <button type="button" class="pay-tab" @click="payMethod = 'spei'"
                                :class="{ 'is-active': payMethod === 'spei' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 3h18v18H3z" stroke="currentColor" stroke-width="2" rx="2"/><path d="M3 9h18M9 21V9" stroke="currentColor" stroke-width="2"/></svg>
                            SPEI
                        </button>
                    </div>

                    {{-- Tarjeta crédito/débito --}}
                    <div x-show="payMethod === 'card'">
                        <form class="ckout-form pay-card-form" @submit.prevent="submitPayment">
                            <div class="cart-field ckout-field--full">
                                <label class="cart-field__label" for="cardnum">Número de tarjeta <span style="color:var(--danger)">*</span></label>
                                <div class="pay-card-input">
                                    <input id="cardnum" type="text" class="cart-input" placeholder="1234 5678 9012 3456"
                                           x-model="cardNum" maxlength="19" required
                                           @input="formatCard">
                                    <div class="pay-card-brands">
                                        <span class="pay-card-brand">VISA</span>
                                        <span class="pay-card-brand">MC</span>
                                        <span class="pay-card-brand">AMEX</span>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-field ckout-field--full">
                                <label class="cart-field__label" for="cardname">Nombre en la tarjeta <span style="color:var(--danger)">*</span></label>
                                <input id="cardname" type="text" class="cart-input" placeholder="NOMBRE APELLIDO"
                                       x-model="cardName" required style="text-transform:uppercase">
                            </div>
                            <div class="cart-field">
                                <label class="cart-field__label" for="cardexp">Vencimiento <span style="color:var(--danger)">*</span></label>
                                <input id="cardexp" type="text" class="cart-input" placeholder="MM / AA"
                                       x-model="cardExp" maxlength="7" required
                                       @input="formatExp">
                            </div>
                            <div class="cart-field">
                                <label class="cart-field__label" for="cardcvv">
                                    CVV <span style="color:var(--danger)">*</span>
                                    <button type="button" style="border:none;background:none;color:var(--text-muted);cursor:help;font-size:12px" title="3 dígitos al reverso de tu tarjeta (4 dígitos en AMEX al frente)">?</button>
                                </label>
                                <input id="cardcvv" type="password" class="cart-input" placeholder="•••"
                                       x-model="cardCvv" maxlength="4" required>
                            </div>

                            <div class="pay-secure-badge">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2"/></svg>
                                Pago cifrado con TLS 1.3 · procesado por Stripe México
                            </div>

                            <button type="submit" class="c-btn c-btn--lg pay-submit-btn"
                                    :disabled="processing">
                                <template x-if="!processing">
                                    <span>Pagar ahora →</span>
                                </template>
                                <template x-if="processing">
                                    <span>Procesando…</span>
                                </template>
                            </button>
                        </form>
                    </div>

                    {{-- OXXO Pay --}}
                    <div x-show="payMethod === 'oxxo'" style="display:none">
                        <div class="pay-oxxo">
                            <div class="pay-oxxo__logo">OXXO</div>
                            <h3>Paga en efectivo en cualquier OXXO</h3>
                            <ol class="pay-oxxo__steps">
                                <li>Haz clic en "Generar voucher OXXO" para obtener tu referencia de pago.</li>
                                <li>Acude a cualquier tienda OXXO en México y pide realizar un pago de servicio.</li>
                                <li>Indica el número de referencia y paga en efectivo.</li>
                                <li>Tu licencia se activa en máximo 2 días hábiles tras confirmar el pago.</li>
                            </ol>
                            <div class="pay-oxxo__note">
                                El voucher vence en <b>72 horas</b>. Monto máximo por voucher: <b>$10,000 MXN</b>.
                                Montos mayores requieren múltiples pagos.
                            </div>
                            <button type="button" class="c-btn c-btn--lg" @click="submitPayment"
                                    style="width:100%;background:#DD0000;border-color:#DD0000">
                                Generar voucher OXXO →
                            </button>
                        </div>
                    </div>

                    {{-- SPEI --}}
                    <div x-show="payMethod === 'spei'" style="display:none">
                        <div class="pay-spei">
                            <div class="pay-spei__head">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 6h18M3 12h18M3 18h18" stroke="var(--primary)" stroke-width="2" stroke-linecap="round"/></svg>
                                <div>
                                    <div style="font-weight:700;font-size:16px">Transferencia SPEI</div>
                                    <div style="font-size:13px;color:var(--text-muted)">Confirmación en 1-2 horas hábiles</div>
                                </div>
                            </div>
                            <ol class="pay-oxxo__steps">
                                <li>Haz clic en "Obtener CLABE SPEI" y recibirás una CLABE única para tu pago.</li>
                                <li>Entra a tu banca en línea y realiza una transferencia SPEI a la CLABE indicada.</li>
                                <li>Usa como concepto tu RFC para facilitar la identificación del pago.</li>
                                <li>Tu licencia se activa en 1-2 horas hábiles tras confirmar la transferencia.</li>
                            </ol>
                            <div class="pay-oxxo__note">
                                Sin límite de monto. Horario SPEI: 24/7 con acreditación en horario bancario.
                            </div>
                            <button type="button" class="c-btn c-btn--lg" @click="submitPayment"
                                    style="width:100%">
                                Obtener CLABE SPEI →
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ══ RIGHT — Order summary ══════════════════════════════════════════ --}}
            <aside class="cart__summary">
                <h3>Tu pedido</h3>
                <div class="cart__summary-section">
                    <div class="ckout-order-item">
                        <div class="ckout-order-item__icon" style="background:var(--primary-soft);color:var(--primary)">L</div>
                        <div>
                            <div style="font-weight:600;font-size:14px">Licencia software</div>
                            <div style="font-size:12px;color:var(--text-muted)">Plan anual · 1 usuario</div>
                        </div>
                    </div>
                </div>

                <dl class="cart__summary-totals">
                    <div><dt>Subtotal</dt><dd>—</dd></div>
                    <div><dt>IVA 16%</dt><dd>—</dd></div>
                </dl>

                <div class="cart__total">
                    <span>Total</span>
                    <strong>—</strong>
                </div>

                <ul class="cart__trust" style="margin-top:20px">
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" stroke="currentColor" stroke-width="2"/></svg>
                        Pago cifrado SSL · Stripe México
                    </li>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/></svg>
                        Factura CFDI 4.0 en minutos
                    </li>
                    <li>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/><path d="M12 8v4l3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        Activación &lt; 24 horas hábiles
                    </li>
                </ul>

                <div style="margin-top:20px;padding:16px;background:var(--surface-2);border-radius:12px;font-size:13px">
                    <b>¿Necesitas ayuda?</b>
                    <p style="color:var(--text-muted);margin-top:6px">
                        55 5599-0685 · ventas@logiaconsulting.com<br>
                        Lun-Vie 9–18h
                    </p>
                </div>
            </aside>

        </div>
    </div>
</section>

</main>
@endsection
