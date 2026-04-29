{{-- MegaMenu — variante hybrid flat con productos organizados por categoría --}}
{{-- Controlado por x-data="shell()" del header --}}

<div x-show="megaOpen"
     style="display:none"
     @click.outside="megaOpen = false"
     @keydown.escape.window="megaOpen = false">

    <div class="mega-backdrop" @click="megaOpen = false"></div>

    <div class="mega mega--hybrid mega--flat" role="menu" x-data="{ megaActive: 'aspel' }">

        {{-- Columna izquierda: marcas --}}
        <div class="mega__brands mega__brands--flat">
            <h5>Marcas partner</h5>

            @php
            $brands = [
                ['id' => 'aspel',          'name' => 'Siigo Aspel',     'hex' => '#009DFF', 'route' => 'partner.aspel'],
                ['id' => 'softrestaurant', 'name' => 'Soft Restaurant', 'hex' => '#E25724', 'route' => 'partner.soft'],
                ['id' => 'zoho',           'name' => 'Zoho',            'hex' => '#E42527', 'route' => 'partner.zoho'],
                ['id' => 'microsoft',      'name' => 'Microsoft 365',   'hex' => '#05A6F0', 'route' => 'partner.microsoft'],
            ];

            /* Productos agrupados por categoría — basado en kb-productos.md */
            $products = [
                'aspel' => [
                    ['group' => 'Administración', 'items' => [
                        ['name' => 'Aspel SAE',     'meta' => 'Ciclo compra-venta, inventarios y facturación', 'route' => 'partner.aspel'],
                        ['name' => 'Aspel ADM',     'meta' => 'Facturas y clientes en la nube · sin instalación', 'route' => 'partner.aspel'],
                    ]],
                    ['group' => 'Contabilidad', 'items' => [
                        ['name' => 'Aspel COI',     'meta' => 'Contabilidad integral + DIOT 2025 + SAT', 'route' => 'partner.aspel'],
                    ]],
                    ['group' => 'Bancos', 'items' => [
                        ['name' => 'Aspel BANCO',   'meta' => 'Control bancario + conciliación automática', 'route' => 'partner.aspel'],
                    ]],
                    ['group' => 'Facturación', 'items' => [
                        ['name' => 'Aspel FACTURE', 'meta' => 'CFDI 4.0 para profesionistas y emprendedores', 'route' => 'partner.aspel'],
                    ]],
                    ['group' => 'Punto de Venta', 'items' => [
                        ['name' => 'Aspel CAJA',    'meta' => 'POS para mostrador, touch y código de barras', 'route' => 'partner.aspel'],
                    ]],
                    ['group' => 'Producción', 'items' => [
                        ['name' => 'Aspel PROD',    'meta' => 'Control de manufactura, costos y órdenes', 'route' => 'partner.aspel'],
                    ]],
                    ['group' => 'Recursos Humanos', 'items' => [
                        ['name' => 'Aspel NOI',          'meta' => 'Nómina + CFDI 4.0 + prestaciones de ley', 'route' => 'partner.aspel'],
                        ['name' => 'NOI Asistente',      'meta' => 'Asistencias, geolocalización y vacaciones', 'route' => 'partner.aspel'],
                    ]],
                ],
                'softrestaurant' => [
                    ['group' => 'Sistema POS', 'items' => [
                        ['name' => 'Soft Restaurant Pro',  'meta' => '3 cajas + inventario + recetas + meseros', 'route' => 'partner.soft'],
                        ['name' => 'Soft Restaurant Lite', 'meta' => '1 caja · ideal para cafeterías y foodtrucks', 'route' => 'partner.soft'],
                    ]],
                    ['group' => 'Módulos adicionales', 'items' => [
                        ['name' => 'Soft Delivery',    'meta' => 'Integra Rappi, UberEats y DiDi Food', 'route' => 'partner.soft'],
                        ['name' => 'Soft Inventarios', 'meta' => 'Recetas, mermas y costeo de platillos', 'route' => 'partner.soft'],
                    ]],
                ],
                'zoho' => [
                    ['group' => 'Suite completa', 'items' => [
                        ['name' => 'Zoho One',      'meta' => '45+ apps integradas en un solo login', 'route' => 'partner.zoho'],
                    ]],
                    ['group' => 'CRM y Ventas', 'items' => [
                        ['name' => 'Zoho CRM Plus', 'meta' => 'CRM + automatización + marketing + helpdesk', 'route' => 'partner.zoho'],
                    ]],
                    ['group' => 'Finanzas', 'items' => [
                        ['name' => 'Zoho Books MX', 'meta' => 'Contabilidad en la nube con CFDI 4.0', 'route' => 'partner.zoho'],
                    ]],
                    ['group' => 'Operaciones', 'items' => [
                        ['name' => 'Zoho People',   'meta' => 'Recursos humanos y gestión de personal', 'route' => 'partner.zoho'],
                    ]],
                ],
                'microsoft' => [
                    ['group' => 'Microsoft 365 — Planes Business', 'items' => [
                        ['name' => 'Business Basic',    'meta' => 'Correo, Teams, OneDrive 1TB · sin apps escritorio', 'route' => 'partner.microsoft'],
                        ['name' => 'Business Standard', 'meta' => '+ Word, Excel, PowerPoint, Outlook escritorio', 'route' => 'partner.microsoft'],
                        ['name' => 'Business Premium',  'meta' => '+ Intune MDM + Defender for Business + Azure AD', 'route' => 'partner.microsoft'],
                    ]],
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

        {{-- Columna derecha: productos del brand activo, agrupados por categoría --}}
        <div class="mega__content mega__content--flat">
            @foreach($brands as $b)
            <div x-show="megaActive === '{{ $b['id'] }}'">
                <div class="mega__content-head mega__content-head--flat">
                    <div>
                        <div class="mega__content-eyebrow">Soluciones {{ $b['name'] }}</div>
                        <h4 class="mega__content-title">{{ $b['name'] }}</h4>
                    </div>
                    <a href="{{ route($b['route']) }}" class="mega__content-link"
                       @click="megaOpen = false">Ver landing completa →</a>
                </div>
                <ul class="mega__product-list">
                    @foreach($products[$b['id']] as $group)
                    <li class="mega__product-cat">{{ $group['group'] }}</li>
                    @foreach($group['items'] as $p)
                    <li>
                        <a href="{{ route($p['route']) }}"
                           class="mega__product-row"
                           @click="megaOpen = false"
                           style="text-decoration:none;display:block">
                            <span class="mega__product-row-name">{{ $p['name'] }}</span>
                            <span class="mega__product-row-meta">{{ $p['meta'] }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>

    </div>
</div>
