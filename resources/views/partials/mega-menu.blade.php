{{-- MegaMenu — variante hybrid (flat) activa por defecto --}}
{{-- Controlado por x-data="shell()" del header --}}

<div x-show="megaOpen"
     x-transition:enter="transition ease-out duration-150"
     x-transition:enter-start="opacity-0 -translate-y-1"
     x-transition:enter-end="opacity-100 translate-y-0"
     style="display:none"
     @click.outside="megaOpen = false"
     @keydown.escape.window="megaOpen = false">

    <div class="mega-backdrop" @click="megaOpen = false"></div>

    <div class="mega mega--hybrid mega--flat" role="menu" x-data="{ megaActive: 'aspel' }">
        {{-- Columna izquierda: marcas --}}
        <div class="mega__brands mega__brands--flat">
            <h5>Marcas</h5>

            @php
            $brands = [
                ['id' => 'aspel',          'name' => 'Siigo Aspel',     'hex' => '#009DFF', 'route' => 'partner.aspel'],
                ['id' => 'softrestaurant', 'name' => 'Soft Restaurant', 'hex' => '#E25724', 'route' => 'partner.soft'],
                ['id' => 'zoho',           'name' => 'Zoho',            'hex' => '#E42527', 'route' => 'partner.zoho'],
                ['id' => 'microsoft',      'name' => 'Microsoft 365',   'hex' => '#05A6F0', 'route' => 'partner.microsoft'],
            ];
            $products = [
                'aspel' => [
                    ['slug' => 'aspel-coi',     'name' => 'Aspel COI',     'meta' => 'Contabilidad integral · Licencia anual'],
                    ['slug' => 'aspel-noi',     'name' => 'Aspel NOI',     'meta' => 'Nómina + CFDI 4.0'],
                    ['slug' => 'aspel-facture', 'name' => 'Aspel FACTURE', 'meta' => 'Facturación electrónica'],
                ],
                'softrestaurant' => [
                    ['slug' => 'soft-pro',      'name' => 'Soft Restaurant Pro', 'meta' => 'POS completo · 3 cajas'],
                    ['slug' => 'soft-delivery', 'name' => 'Soft Delivery',       'meta' => 'Integración Rappi / UberEats'],
                    ['slug' => 'soft-stock',    'name' => 'Soft Inventarios',    'meta' => 'Recetas y mermas'],
                ],
                'zoho' => [
                    ['slug' => 'zoho-crm',    'name' => 'Zoho CRM Plus', 'meta' => 'CRM + automatización'],
                    ['slug' => 'zoho-books',  'name' => 'Zoho Books',    'meta' => 'Contabilidad con CFDI'],
                    ['slug' => 'zoho-people', 'name' => 'Zoho People',   'meta' => 'Recursos humanos'],
                ],
                'microsoft' => [
                    ['slug' => 'm365-basic',   'name' => 'M365 Business Basic',    'meta' => 'Correo, Teams, OneDrive'],
                    ['slug' => 'm365-std',     'name' => 'M365 Business Standard', 'meta' => '+ Apps de escritorio'],
                    ['slug' => 'm365-premium', 'name' => 'M365 Business Premium',  'meta' => '+ Intune + Defender'],
                ],
            ];
            @endphp

            @foreach($brands as $b)
            <button class="mega__brand-row"
                    :aria-current="$data.megaActive === '{{ $b['id'] }}' ? 'true' : 'false'"
                    @mouseenter="$data.megaActive = '{{ $b['id'] }}'"
                    @focus="$data.megaActive = '{{ $b['id'] }}'"
                    @click="megaOpen = false; window.location = '{{ route($b['route']) }}'">
                <span class="mega__brand-dot" style="background:{{ $b['hex'] }}" aria-hidden="true"></span>
                <span class="mega__brand-row-name">{{ $b['name'] }}</span>
                <span class="mega__brand-row-arrow" aria-hidden="true">→</span>
            </button>
            @endforeach
        </div>

        {{-- Columna derecha: productos del brand activo --}}
        <div class="mega__content mega__content--flat">
            @foreach($brands as $b)
            <div x-show="megaActive === '{{ $b['id'] }}'">
                <div class="mega__content-head mega__content-head--flat">
                    <div>
                        <div class="mega__content-eyebrow">Productos</div>
                        <h4 class="mega__content-title">{{ $b['name'] }}</h4>
                    </div>
                    <a href="{{ route($b['route']) }}" class="mega__content-link"
                       @click="megaOpen = false">Ver landing completa →</a>
                </div>
                <ul class="mega__product-list">
                    @foreach($products[$b['id']] as $p)
                    <li>
                        <a href="{{ route($b['route']) }}"
                           class="mega__product-row"
                           @click="megaOpen = false"
                           style="text-decoration:none;display:block">
                            <span class="mega__product-row-name">{{ $p['name'] }}</span>
                            <span class="mega__product-row-meta">{{ $p['meta'] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
