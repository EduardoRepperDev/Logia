<?php

namespace App\Http\Controllers;

class FrontController extends Controller
{
    private array $partners = [
        'aspel' => [
            'name'    => 'Siigo Aspel',
            'tagline' => 'La contabilidad de las PyMEs mexicanas — con el respaldo consultivo de Logia.',
            'hero'    => 'Implementamos, migramos y capacitamos en todo el ecosistema Siigo Aspel. Tu contabilidad, nómina, banca y facturación bajo un solo proveedor certificado.',
            'tag'     => 'SA',
            'logo'    => '/images/brands/siigo.png',
            'familia' => ['Aspel COI','Aspel NOI','Aspel BANCO','Aspel FACTURE','Aspel ADM','Aspel PROD','Aspel CAJA','Aspel SAE'],
            'productos' => [
                ['slug' => 'aspel-coi',   'name' => 'Aspel COI 10.0',   'desc' => 'Contabilidad integral, CFDI 4.0 y contabilidad electrónica SAT.',  'price' => '$7,980',  'priceMeta' => 'anual · 1 usuario',       'badge' => 'Best-seller'],
                ['slug' => 'aspel-noi',   'name' => 'Aspel NOI 11.0',   'desc' => 'Nómina con timbrado CFDI 4.0 y prestaciones de ley.',              'price' => '$9,450',  'priceMeta' => 'anual · 50 empleados',    'badge' => 'PyME'],
                ['slug' => 'aspel-banco', 'name' => 'Aspel BANCO 5.0',  'desc' => 'Control bancario, conciliación y flujos multi-cuenta.',            'price' => '$6,500',  'priceMeta' => 'anual · 1 usuario',       'badge' => 'Nuevo'],
            ],
        ],
        'softrestaurant' => [
            'name'    => 'Soft Restaurant',
            'tagline' => 'El POS favorito de la gastronomía mexicana, configurado por expertos Logia.',
            'hero'    => 'Cajas, comandas, inventarios, recetas y delivery integrados. Lo parametrizamos a tu menú, capacitamos a tus meseros y damos soporte en sitio cuando abres.',
            'tag'     => 'SR',
            'logo'    => '/images/brands/softrestauran.png',
            'familia' => ['POS Pro','POS Lite','Inventarios','Recetas','Delivery','Reservaciones'],
            'productos' => [
                ['slug' => 'soft-pro',      'name' => 'Soft Restaurant Pro',  'desc' => '3 cajas, inventario y recetas. El estándar de la industria.',  'price' => '$18,500', 'priceMeta' => 'anual · 3 cajas',         'badge' => 'Flagship'],
                ['slug' => 'soft-lite',     'name' => 'Soft Restaurant Lite', 'desc' => 'Para cafeterías y foodtrucks con 1 caja.',                     'price' => '$8,900',  'priceMeta' => 'anual · 1 caja',          'badge' => 'Starter'],
                ['slug' => 'soft-delivery', 'name' => 'Soft Delivery',        'desc' => 'Integra Rappi, UberEats y DiDi Food a tu POS.',                'price' => '$3,400',  'priceMeta' => 'anual',                   'badge' => 'Add-on'],
            ],
        ],
        'zoho' => [
            'name'    => 'Zoho',
            'tagline' => '45+ apps de negocio, un solo login — configuradas por tu partner mexicano.',
            'hero'    => 'CRM, finanzas, RH, marketing y operaciones en una suite integrada. Logia te ayuda a elegir qué apps prender, en qué orden y cómo conectarlas a tu facturación CFDI.',
            'tag'     => 'Z1',
            'logo'    => '/images/brands/zoho-logo-web.svg',
            'familia' => ['CRM','Books','Desk','People','Campaigns','Analytics','Creator','Projects'],
            'productos' => [
                ['slug' => 'zoho-one',   'name' => 'Zoho One',       'desc' => 'La suite completa: 45+ apps integradas, un solo usuario.',      'price' => '$1,299', 'priceMeta' => 'usuario/mes',  'badge' => 'Todo en 1'],
                ['slug' => 'zoho-crm',   'name' => 'Zoho CRM Plus',  'desc' => 'CRM + marketing + soporte + analytics.',                        'price' => '$2,399', 'priceMeta' => 'usuario/mes',  'badge' => 'Más cotizado'],
                ['slug' => 'zoho-books', 'name' => 'Zoho Books MX',  'desc' => 'Contabilidad en la nube con CFDI 4.0 y bancos MX.',             'price' => '$399',   'priceMeta' => 'usuario/mes',  'badge' => 'CFDI'],
            ],
        ],
        'microsoft' => [
            'name'    => 'Microsoft 365',
            'tagline' => 'Productividad, colaboración y seguridad — configurada por Solutions Partner.',
            'hero'    => 'Correo corporativo, Teams, Office y seguridad Defender desplegados por un Solutions Partner autorizado. Migraciones sin downtime y soporte bilingüe.',
            'tag'     => 'M365',
            'logo'    => '/images/brands/Microsoft.png',
            'familia' => ['Business Basic','Business Standard','Business Premium','Enterprise E3','Enterprise E5'],
            'productos' => [
                ['slug' => 'm365-basic', 'name' => 'Business Basic',    'desc' => 'Correo, Teams, OneDrive 1TB. Sin apps de escritorio.',            'price' => '$120', 'priceMeta' => 'usuario/mes', 'badge' => 'Inicio'],
                ['slug' => 'm365-std',   'name' => 'Business Standard', 'desc' => 'Incluye Word, Excel, PowerPoint, Outlook de escritorio.',         'price' => '$320', 'priceMeta' => 'usuario/mes', 'badge' => 'PyME'],
                ['slug' => 'm365-prem',  'name' => 'Business Premium',  'desc' => 'Standard + Intune MDM + Defender for Business + Azure AD.',       'price' => '$450', 'priceMeta' => 'usuario/mes', 'badge' => 'Seguridad'],
            ],
        ],
    ];

    public function home()
    {
        return view('pages.home');
    }

    public function partner(string $brand)
    {
        $data = $this->partners[$brand] ?? null;
        abort_if(is_null($data), 404);
        return view('pages.partner', compact('brand', 'data'));
    }

    public function pdp(string $brand, string $product)
    {
        $partnerData = $this->partners[$brand] ?? null;
        abort_if(is_null($partnerData), 404);
        $productData = collect($partnerData['productos'])->firstWhere('slug', $product);
        abort_if(is_null($productData), 404);
        return view('pages.pdp', [
            'brand'   => $brand,
            'partner' => $partnerData,
            'product' => $productData,
        ]);
    }
}
