@extends('layouts.marketing')
@section('title', 'Pedido confirmado')
@section('robots', 'noindex,nofollow')
@section('content')
<main data-brand="logia" style="min-height:70vh;display:flex;align-items:center;justify-content:center;padding:80px 16px">
    <div style="max-width:520px;width:100%;text-align:center">
        <div style="width:72px;height:72px;border-radius:50%;background:#DCFCE7;display:grid;place-items:center;margin:0 auto 24px">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M5 13l4 4L19 7" stroke="#16A34A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h1 style="font-size:2rem;margin-bottom:12px">¡Pedido confirmado!</h1>
        <p style="color:var(--text-muted);font-size:16px;line-height:1.6;margin-bottom:32px">
            Recibirás tu factura CFDI y los datos de activación en el correo que proporcionaste.<br>
            Un asesor Logia te contactará en menos de 24 horas hábiles.
        </p>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('home') }}" class="c-btn c-btn--ghost">Ir al inicio</a>
            <a href="{{ route('booking') }}" class="c-btn">Agendar implementación</a>
        </div>
        <p style="margin-top:32px;font-size:13px;color:var(--text-muted)">
            55 5599-0685 · ventas@logiaconsulting.com
        </p>
    </div>
</main>
@endsection
