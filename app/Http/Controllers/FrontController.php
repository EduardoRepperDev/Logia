<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    private array $partners = [

        /* ── SIIGO ASPEL ─────────────────────────────────────────────────────── */
        'aspel' => [
            'name'    => 'Siigo Aspel',
            'tagline' => 'La contabilidad de las PyMEs mexicanas — con el respaldo consultivo de Logia.',
            'hero'    => 'Implementamos, migramos y capacitamos en todo el ecosistema Siigo Aspel. Tu contabilidad, nómina, banca y facturación bajo un solo proveedor certificado.',
            'tag'     => 'SA',
            'logo'    => '/images/brands/siigo.png',
            'familia' => ['SAE','COI','NOI','BANCO','ADM','FACTURE','CAJA','PROD','NOI Asistente'],
            'productos' => [

                [
                    'slug'          => 'sae',
                    'name'          => 'Aspel SAE 10.0',
                    'categoria'     => 'Administración',
                    'desc'          => 'Ciclo compra-venta, inventarios, CFDI 4.0 y punto de venta en un solo sistema.',
                    'price'         => '$8,670',
                    'precio_mensual'=> '$722.50',
                    'priceMeta'     => 'anual · 1 usuario',
                    'badge'         => 'PyME',
                    'desc_long'     => 'SAE controla y automatiza el ciclo completo de compra-venta: inventarios, sucursales, clientes, facturación CFDI 4.0, cuentas por cobrar y pagar, vendedores y proveedores. Incluye app móvil SAE Móvil para pedidos y cotizaciones en campo.',
                    'features'      => [
                        'Facturación CFDI 4.0 — Carta Porte, Comercio Exterior, Impuestos Locales',
                        'Integración con tiendas en línea: Claro Shop, Mercado Libre, Amazon',
                        'Cobros digitales CoDi (QR y mensaje de texto)',
                        'Punto de Venta integrado: factura global, cambio de precios, crédito',
                        'Importación masiva desde Excel: clientes, proveedores, inventarios',
                        'App SAE Móvil para pedidos, cotizaciones e inventarios en campo',
                        'Gestión centralizada de sucursales y perfiles de usuario',
                    ],
                    'specs'         => [
                        'Tipo'    => 'Escritorio + App Móvil',
                        'SO'      => 'Windows 10/11, Server 2016/2019/2022',
                        'CPU'     => 'Core 2 a 2 GHz (32/64 bits)',
                        'RAM'     => '2 GB',
                        'Disco'   => '2.8 GB libres',
                        'BD'      => 'Firebird® o MS-SQL®',
                        'Empresas'=> 'Hasta 99 empresas por licencia',
                    ],
                    'integrations'  => ['Aspel COI','Aspel BANCO','Aspel CAJA','Aspel PROD','NOI Asistente'],
                ],

                [
                    'slug'          => 'coi',
                    'name'          => 'Aspel COI 11.0',
                    'categoria'     => 'Contabilidad',
                    'desc'          => 'Contabilidad integral, contabilidad electrónica SAT, DIOT 2025 y multimoneda.',
                    'price'         => '$4,373',
                    'precio_mensual'=> '$364.38',
                    'priceMeta'     => 'anual · 1 usuario',
                    'badge'         => 'Contadores',
                    'desc_long'     => 'COI procesa, integra y mantiene actualizada la información contable y fiscal de hasta 999 empresas. Automatiza cálculos, contabilizaciones y gestión de CFDI, y cumple con todos los requisitos de contabilidad electrónica del SAT.',
                    'features'      => [
                        'Catálogo de cuentas: hasta 20 dígitos, 9 niveles y código agrupador SAT',
                        'Pólizas ilimitadas: modelo, ajuste cambiario, alfanuméricas, importación Excel',
                        'DIOT 2025: 54 campos, archivo .txt, hoja de trabajo Excel e IVA fronterizo',
                        'Tablero de CFDIs: descarga SAT, validación, semáforo fiscal, preclasificación',
                        'Módulo de activos: alta, baja, depreciación contable y fiscal',
                        'Multimoneda: hasta 99 monedas con ajuste cambiario automático',
                        'Contabilidad electrónica: catálogo, balanza, pólizas y auxiliares en XML/ZIP',
                    ],
                    'specs'         => [
                        'Tipo'    => 'Escritorio',
                        'SO'      => 'Windows 10/11, Server 2016/2019/2022',
                        'CPU'     => 'Core 2 a 2 GHz',
                        'RAM'     => '2 GB',
                        'Disco'   => '1.6 GB libres',
                        'BD'      => 'Firebird® o MS-SQL®',
                        'Empresas'=> 'Hasta 999 empresas por licencia',
                    ],
                    'integrations'  => ['Aspel SAE','Aspel BANCO','Aspel NOI','Aspel CAJA'],
                ],

                [
                    'slug'          => 'noi',
                    'name'          => 'Aspel NOI 11.0',
                    'categoria'     => 'Nómina',
                    'desc'          => 'Nómina con timbrado CFDI 4.0, prestaciones de ley y hasta 50 empleados.',
                    'price'         => '$5,310',
                    'precio_mensual'=> '$442.50',
                    'priceMeta'     => 'anual · 50 empleados',
                    'badge'         => 'RRHH',
                    'desc_long'     => 'NOI automatiza el cálculo de nómina con cumplimiento total del SAT: timbrado CFDI 4.0, IMSS, INFONAVIT, ISR y todas las prestaciones de ley. Genera recibos digitales y se integra con NOI Asistente para control de asistencias.',
                    'features'      => [
                        'Timbrado CFDI 4.0 de recibos de nómina incluido',
                        'Cálculo automático: IMSS, INFONAVIT, ISR, retenciones y percepciones',
                        'Prestaciones de ley: vacaciones, prima vacacional, aguinaldo, PTU',
                        'Integración con NOI Asistente para captura ágil de asistencias',
                        'Generación de pólizas contables para Aspel COI',
                        'Dispersión de nómina bancaria (múltiples bancos)',
                        'Reportes: SUA, IDSE, SIPARE, constancias de retención anuales',
                    ],
                    'specs'         => [
                        'Tipo'      => 'Escritorio',
                        'SO'        => 'Windows 10/11, Server 2016/2019/2022',
                        'CPU'       => 'Core 2 a 2 GHz',
                        'RAM'       => '2 GB',
                        'Disco'     => '2 GB libres',
                        'BD'        => 'Firebird® o MS-SQL®',
                        'Empleados' => 'Hasta 50 (licencias adicionales disponibles)',
                    ],
                    'integrations'  => ['Aspel COI','NOI Asistente'],
                ],

                [
                    'slug'          => 'banco',
                    'name'          => 'Aspel BANCO 6.0',
                    'categoria'     => 'Tesorería',
                    'desc'          => 'Control bancario multi-cuenta, conciliación automática y comprobantes de pago 2.0.',
                    'price'         => '$5,454',
                    'precio_mensual'=> '$454.50',
                    'priceMeta'     => 'anual · 1 usuario',
                    'badge'         => 'Tesorería',
                    'desc_long'     => 'BANCO controla todos los movimientos de cuentas bancarias y realiza la conciliación automática a partir de estados de cuenta. Genera comprobantes de recepción de pagos y contabiliza pólizas en línea con COI, adjuntando el UUID del CFDI.',
                    'features'      => [
                        'Tablero de saldos reales y en tránsito con gráficas personalizables',
                        'Hasta 99 monedas y formatos de cheque de los principales bancos MX',
                        'Conciliación bancaria automática desde hoja de cálculo',
                        'Generación de Recibos de Pago 2.0 con validación fiscal integrada',
                        'Agenda de movimientos: planificación de cobros y pagos sin afectar saldo',
                        'Dispersión de nómina y cheques automáticos',
                        'Pólizas inteligentes asociadas a concepto bancario',
                    ],
                    'specs'         => [
                        'Tipo'    => 'Escritorio',
                        'SO'      => 'Windows 8.1/10/11, Server 2012/2016/2019',
                        'CPU'     => 'Core 2 a 2 GHz',
                        'RAM'     => '2 GB',
                        'Disco'   => '610 MB libres',
                        'BD'      => 'Firebird® o MS-SQL®',
                        'Empresas'=> 'Hasta 99 empresas por licencia',
                    ],
                    'integrations'  => ['Aspel SAE','Aspel COI'],
                ],

                [
                    'slug'          => 'adm',
                    'name'          => 'Aspel ADM 3.0',
                    'categoria'     => 'Administración',
                    'desc'          => 'Facturación CFDI 4.0 en la nube desde cualquier dispositivo, sin instalación.',
                    'price'         => '$1,776',
                    'precio_mensual'=> '$148.00',
                    'priceMeta'     => 'anual · plan Básica',
                    'badge'         => 'Emprendedor',
                    'desc_long'     => 'ADM es la solución en la nube para emprendedores y PyMEs que requieren movilidad: gestiona clientes, productos, cotizaciones, pedidos, inventarios y facturación CFDI 4.0 desde móvil, tablet o computadora, sin necesidad de instalación.',
                    'features'      => [
                        'Facturas, recibos de honorarios, arrendamiento, notas de crédito y REP',
                        'Hasta 3 sesiones simultáneas en cualquier dispositivo',
                        'Control de CxC, crédito a clientes y estados de cuenta (Premium)',
                        'Inventario con catálogo de productos con foto, IVA e IEPS',
                        'Cobros digitales CoDi integrados',
                        'Estadísticas en tiempo real: clientes top y productos más vendidos',
                        'Funciona sin conexión — sincroniza al reconectarse',
                    ],
                    'specs'         => [
                        'Tipo'    => 'Web + App Móvil',
                        'Web'     => 'Cualquier navegador moderno',
                        'Móvil'   => 'Android (Google Play) · iOS (App Store)',
                        'Conexión'=> 'Internet requerido (modo offline parcial)',
                        'Planes'  => 'Básica $1,776/año · Premium $5,280/año',
                    ],
                    'integrations'  => [],
                ],

                [
                    'slug'          => 'facture',
                    'name'          => 'Aspel FACTURE 6.0',
                    'categoria'     => 'Facturación',
                    'desc'          => 'Facturación CFDI 4.0 para profesionistas y emprendedores — simple y rápida.',
                    'price'         => '$2,092',
                    'precio_mensual'=> '$174.33',
                    'priceMeta'     => 'anual · 1 usuario',
                    'badge'         => 'Profesionistas',
                    'desc_long'     => 'FACTURE expide documentos fiscales digitales con cumplimiento total: facturas, notas de crédito, recibos de honorarios, arrendamiento, viáticos y retenciones. Ideal para profesionistas, despachos y emprendedores que requieren facturación sin complicaciones.',
                    'features'      => [
                        'CFDI 4.0: facturas, REP, retenciones, facturas globales e IEPS',
                        'Complementos: carta porte, comercio exterior, notarios, INE, donatarias',
                        'Viáticos: genera CFDI a partir del CFDI de nómina automáticamente',
                        'Control de comprobantes: filtro pagado/no pagado',
                        'Tablero gráfico de ingresos, gastos, pagos y retenciones',
                        'Envío por correo en PDF y XML desde la aplicación',
                        'Catálogos de clientes y productos con imagen',
                    ],
                    'specs'         => [
                        'Tipo'     => 'Escritorio',
                        'SO'       => 'Windows 8.1/10, Server 2012/2016/2019',
                        'CPU'      => 'Core 2 a 2 GHz',
                        'RAM'      => '2 GB',
                        'Disco'    => '400 MB libres',
                        'BD'       => 'Firebird®',
                        'Conexión' => 'Internet requerido para timbrado',
                    ],
                    'integrations'  => [],
                ],

                [
                    'slug'          => 'caja',
                    'name'          => 'Aspel CAJA 5.0',
                    'categoria'     => 'Punto de venta',
                    'desc'          => 'Punto de Venta para mostrador: táctil, código de barras y factura inmediata.',
                    'price'         => '$2,808',
                    'precio_mensual'=> '$234.00',
                    'priceMeta'     => 'anual · 1 usuario / 99 cajas',
                    'badge'         => 'POS',
                    'desc_long'     => 'CAJA convierte tu equipo de cómputo en un punto de venta completo: controla ventas, facturación e inventarios de uno o varios comercios. Compatible con impresoras de tickets, cajones de dinero, básculas, lectores de código de barras, pantallas táctiles y terminales de pago.',
                    'features'      => [
                        'Hasta 99 puntos de venta, pantallas touch y bitácora de operaciones',
                        'Facturación CFDI 4.0 directa desde ticket de venta',
                        '10 listas de precios, hasta 4 impuestos por producto y KITs',
                        'Factura global y cobros digitales CoDi',
                        'Consolidación de ventas e inventarios de múltiples puntos de venta',
                        'Reportes: ventas por hora, producto, cajero, comisión y corte de caja',
                        'Acceso controlado: bloqueo, cambio de precios y cancelaciones con permiso',
                    ],
                    'specs'         => [
                        'Tipo'     => 'Escritorio',
                        'SO'       => 'Windows 8.1/10/11, Server 2012/2016/2019',
                        'CPU'      => 'Core 2 a 2 GHz',
                        'RAM'      => '2 GB',
                        'Disco'    => '610 MB libres',
                        'BD'       => 'Firebird® o MS-SQL®',
                        'Cajas'    => 'Hasta 99 cajas por licencia',
                    ],
                    'integrations'  => ['Aspel SAE','Aspel COI'],
                ],

                [
                    'slug'          => 'prod',
                    'name'          => 'Aspel PROD 5.0',
                    'categoria'     => 'Manufactura',
                    'desc'          => 'Control de manufactura, costos de producción y órdenes de fabricación.',
                    'price'         => '$8,099',
                    'precio_mensual'=> '$674.93',
                    'priceMeta'     => 'anual · 1 usuario',
                    'badge'         => 'Manufactura',
                    'desc_long'     => 'PROD planea y controla los procesos de fabricación: administra inventarios y costos de productos terminados, gestiona órdenes de producción por etapas y calcula el plan maestro de compras. Requiere Aspel SAE y se integra directamente con su base de datos.',
                    'features'      => [
                        'Tablero de órdenes: activas por prioridad/avance, en espera y terminadas',
                        'Explosión de materiales y plan maestro de compras automatizado',
                        'Costeo estándar y real con prorrateo de costos indirectos (3 factores)',
                        'Fabricación automática y directa en un solo movimiento',
                        'Control de lotes, series, caducidades y números de serie',
                        'Órdenes de producción con seguimiento por etapas',
                        'Múltiples plantas de fabricación y almacenes por planta',
                    ],
                    'specs'         => [
                        'Tipo'      => 'Escritorio',
                        'SO'        => 'Windows 8.1/10/11, Server 2012/2016/2019',
                        'CPU'       => 'Core 2 a 2 GHz',
                        'RAM'       => '2 GB',
                        'Disco'     => '610 MB libres',
                        'Requiere'  => 'Aspel SAE 9.0 o superior',
                        'Empresas'  => 'Hasta 99 empresas por licencia',
                    ],
                    'integrations'  => ['Aspel SAE'],
                ],

                [
                    'slug'          => 'noi-asistente',
                    'name'          => 'NOI Asistente 2.0',
                    'categoria'     => 'Nómina',
                    'desc'          => 'Asistencias por geolocalización, checador móvil y vacaciones desde el celular.',
                    'price'         => 'Desde cotización',
                    'precio_mensual'=> null,
                    'priceMeta'     => 'cotizar con asesor',
                    'badge'         => 'Add-on',
                    'desc_long'     => 'NOI Asistente gestiona las asistencias del personal desde una app móvil: reloj checador, geolocalización GPS, autorización de vacaciones y permisos. Se sincroniza en tiempo real con Aspel NOI para el cálculo de nómina.',
                    'features'      => [
                        'Reloj checador desde smartphone — sin hardware adicional',
                        'Geolocalización GPS dentro de límites predefinidos por sucursal',
                        'Acceso por huella digital o NIP de seguridad',
                        'Autorización de vacaciones, permisos e incapacidades desde móvil',
                        'Organigrama de la empresa con indicadores de incidencias',
                        'Sincronización en tiempo real con Aspel NOI',
                        'Horarios en recorrido para personal de campo',
                    ],
                    'specs'         => [
                        'Tipo'    => 'App Móvil + Web',
                        'Web'     => 'IE 11+, Chrome, Firefox, Safari, Edge',
                        'Android' => '5.0+ QuadCore 1.7 GHz',
                        'iOS'     => '9.3 o superior',
                        'Conexión'=> 'Internet requerido',
                    ],
                    'integrations'  => ['Aspel NOI'],
                ],

            ], // fin productos aspel
        ],

        /* ── SOFT RESTAURANT ─────────────────────────────────────────────────── */
        'softrestaurant' => [
            'name'    => 'Soft Restaurant',
            'tagline' => 'El POS favorito de la gastronomía mexicana, configurado por expertos Logia.',
            'hero'    => 'Cajas, comandas, inventarios, recetas y delivery integrados. Lo parametrizamos a tu menú, capacitamos a tus meseros y damos soporte en sitio cuando abres.',
            'tag'     => 'SR',
            'logo'    => '/images/brands/softrestauran.png',
            'familia' => ['POS Pro','POS Lite','Inventarios','Recetas','Delivery','Reservaciones'],
            'productos' => [
                [
                    'slug'          => 'soft-pro',
                    'name'          => 'Soft Restaurant Pro',
                    'desc'          => '3 cajas, inventario y recetas. El estándar de la industria restaurantera.',
                    'price'         => '$18,500',
                    'precio_mensual'=> null,
                    'priceMeta'     => 'anual · 3 cajas',
                    'badge'         => 'Flagship',
                    'desc_long'     => 'Soft Restaurant Pro es el sistema POS más completo para restaurantes: gestiona pedidos, comandas, inventarios, recetas y costos de platillos desde hasta 3 cajas. Incluye módulos de meseros, cocina y reportes de ventas.',
                    'features'      => [
                        'Hasta 3 cajas POS simultáneas con comandas a cocina',
                        'Control de inventarios, recetas y costeo de platillos',
                        'Módulo de meseros con asignación de mesas y propinas',
                        'Facturas CFDI 4.0 desde cualquier caja',
                        'Reportes de ventas por producto, mesero, turno y sucursal',
                        'Integración con Soft Delivery para Rappi, UberEats y DiDi Food',
                    ],
                    'specs'         => [],
                    'integrations'  => ['Soft Delivery','Soft Inventarios'],
                ],
                [
                    'slug'          => 'soft-lite',
                    'name'          => 'Soft Restaurant Lite',
                    'desc'          => 'Para cafeterías y foodtrucks con 1 caja — rápido y sin complicaciones.',
                    'price'         => '$8,900',
                    'precio_mensual'=> null,
                    'priceMeta'     => 'anual · 1 caja',
                    'badge'         => 'Starter',
                    'desc_long'     => 'Soft Restaurant Lite está diseñado para negocios pequeños con una sola caja de venta: cafeterías, foodtrucks y pequeños restaurantes que necesitan agilidad, CFDI 4.0 y reportes básicos sin complejidad de configuración.',
                    'features'      => [
                        '1 caja POS con pantalla táctil o teclado',
                        'Facturación CFDI 4.0 desde el ticket',
                        'Control básico de inventarios y precios',
                        'Reportes de ventas por día y producto',
                        'Configuración rápida — ideal para apertura de negocios',
                    ],
                    'specs'         => [],
                    'integrations'  => [],
                ],
                [
                    'slug'          => 'soft-delivery',
                    'name'          => 'Soft Delivery',
                    'desc'          => 'Integra Rappi, UberEats y DiDi Food a tu POS sin doble captura.',
                    'price'         => '$3,400',
                    'precio_mensual'=> null,
                    'priceMeta'     => 'anual',
                    'badge'         => 'Add-on',
                    'desc_long'     => 'Soft Delivery centraliza los pedidos de plataformas de delivery (Rappi, UberEats, DiDi Food) directamente en tu POS Soft Restaurant. Elimina la doble captura, reduce errores y sincroniza inventarios en tiempo real.',
                    'features'      => [
                        'Pedidos de Rappi, UberEats y DiDi Food en una sola pantalla',
                        'Sin doble captura — pedidos van directo a cocina',
                        'Sincronización de menú y precios desde Soft Restaurant',
                        'Reportes consolidados de ventas delivery vs. mesa',
                    ],
                    'specs'         => [],
                    'integrations'  => ['Soft Restaurant Pro','Soft Restaurant Lite'],
                ],
            ],
        ],

        /* ── ZOHO ────────────────────────────────────────────────────────────── */
        'zoho' => [
            'name'    => 'Zoho',
            'tagline' => '45+ apps de negocio, un solo login — configuradas por tu partner mexicano.',
            'hero'    => 'CRM, finanzas, RH, marketing y operaciones en una suite integrada. Logia te ayuda a elegir qué apps prender, en qué orden y cómo conectarlas a tu facturación CFDI.',
            'tag'     => 'Z1',
            'logo'    => '/images/brands/zoho-logo-web.svg',
            'familia' => ['CRM','Books','Desk','People','Campaigns','Analytics','Creator','Projects'],
            'productos' => [
                [
                    'slug'          => 'zoho-one',
                    'name'          => 'Zoho One',
                    'desc'          => 'La suite completa: 45+ apps integradas bajo un solo login y una factura.',
                    'price'         => '$1,299',
                    'precio_mensual'=> '$1,299',
                    'priceMeta'     => 'usuario/mes',
                    'badge'         => 'Todo en 1',
                    'desc_long'     => 'Zoho One es el sistema operativo de tu negocio: CRM, contabilidad, RH, marketing, soporte, proyectos y analytics en una sola plataforma con un único login. Ideal para empresas que quieren evitar el caos de múltiples suscripciones.',
                    'features'      => [
                        '45+ apps de negocio en un solo login y factura mensual',
                        'CRM + automatización de ventas + pipeline visual',
                        'Zoho Books MX con CFDI 4.0 y bancos mexicanos',
                        'Zoho People para RH, nómina y control de asistencias',
                        'Zoho Desk para soporte al cliente multi-canal',
                        'Zoho Analytics para dashboards y reportes avanzados',
                        'Zoho Campaigns para email marketing y automatización',
                    ],
                    'specs'         => [
                        'Tipo'     => 'SaaS — 100% en la nube',
                        'Acceso'   => 'Web + Apps móviles iOS y Android',
                        'Seguridad'=> 'SSO, 2FA, roles y permisos granulares',
                        'Soporte'  => 'Español disponible',
                    ],
                    'integrations'  => ['Zoho CRM Plus','Zoho Books MX','Zoho People','Zoho Desk'],
                ],
                [
                    'slug'          => 'zoho-crm',
                    'name'          => 'Zoho CRM Plus',
                    'desc'          => 'CRM + marketing + soporte + analytics — todo conectado en una sola vista.',
                    'price'         => '$2,399',
                    'precio_mensual'=> '$2,399',
                    'priceMeta'     => 'usuario/mes',
                    'badge'         => 'Más cotizado',
                    'desc_long'     => 'CRM Plus integra ventas, marketing, soporte y analytics en un sistema unificado. Automatiza seguimientos, califica leads con IA (Zia), y da a tu equipo de ventas visibilidad total del ciclo desde el primer contacto hasta el cierre.',
                    'features'      => [
                        'Pipeline visual de ventas con automatización de seguimientos',
                        'Calificación de leads con IA Zia y predicción de cierre',
                        'Marketing automation: emails, redes sociales, WhatsApp',
                        'Zoho Desk integrado para soporte post-venta',
                        'Analytics nativo con dashboards personalizables',
                        'App móvil para equipo de ventas en campo',
                    ],
                    'specs'         => [
                        'Tipo'  => 'SaaS — 100% en la nube',
                        'Acceso'=> 'Web + Apps móviles iOS y Android',
                    ],
                    'integrations'  => ['Zoho One','Zoho Books MX','Zoho People'],
                ],
                [
                    'slug'          => 'zoho-books',
                    'name'          => 'Zoho Books MX',
                    'desc'          => 'Contabilidad en la nube con CFDI 4.0, bancos MX y conciliación automática.',
                    'price'         => '$399',
                    'precio_mensual'=> '$399',
                    'priceMeta'     => 'usuario/mes',
                    'badge'         => 'CFDI',
                    'desc_long'     => 'Zoho Books MX está adaptado para la realidad fiscal mexicana: facturación CFDI 4.0, conexión con los principales bancos MX para conciliación automática, declaraciones e integración con el SAT. Ideal para empresas que quieren contabilidad real en la nube.',
                    'features'      => [
                        'Facturación CFDI 4.0 desde la nube — sin PAC adicional',
                        'Conciliación bancaria automática con los principales bancos MX',
                        'Declaraciones de IVA, ISR y DIOT simplificadas',
                        'Multi-moneda con tipo de cambio automático',
                        'Portal de clientes para pago en línea',
                        'Integración con Zoho CRM y Zoho Inventory',
                    ],
                    'specs'         => [
                        'Tipo'  => 'SaaS — 100% en la nube',
                        'Acceso'=> 'Web + Apps móviles iOS y Android',
                    ],
                    'integrations'  => ['Zoho One','Zoho CRM Plus'],
                ],
            ],
        ],

        /* ── MICROSOFT 365 ───────────────────────────────────────────────────── */
        'microsoft' => [
            'name'    => 'Microsoft 365',
            'tagline' => 'Productividad, colaboración y seguridad — configurada por Solutions Partner.',
            'hero'    => 'Correo corporativo, Teams, Office y seguridad Defender desplegados por un Solutions Partner autorizado. Migraciones sin downtime y soporte bilingüe.',
            'tag'     => 'M365',
            'logo'    => '/images/brands/Microsoft.png',
            'familia' => ['Business Basic','Business Standard','Business Premium','Enterprise E3','Enterprise E5'],
            'productos' => [
                [
                    'slug'          => 'm365-basic',
                    'name'          => 'Business Basic',
                    'desc'          => 'Correo corporativo, Teams y OneDrive 1TB. Sin apps de escritorio.',
                    'price'         => '$120',
                    'precio_mensual'=> '$120',
                    'priceMeta'     => 'usuario/mes',
                    'badge'         => 'Inicio',
                    'desc_long'     => 'Business Basic incluye correo corporativo con Exchange, Microsoft Teams para videollamadas y chat, y OneDrive con 1 TB de almacenamiento. Ideal para equipos que trabajan desde el navegador sin necesidad de instalar Office.',
                    'features'      => [
                        'Correo corporativo con Exchange Online y dominio propio',
                        'Microsoft Teams: videollamadas, chat y colaboración',
                        'OneDrive Business con 1 TB de almacenamiento por usuario',
                        'SharePoint Online para gestión documental en equipo',
                        'Office Online: Word, Excel, PowerPoint en el navegador',
                        'Soporte técnico de Microsoft 24/7',
                    ],
                    'specs'         => [
                        'Apps escritorio'=> 'No incluidas (Office Online únicamente)',
                        'Almacenamiento' => '1 TB OneDrive + 50 GB buzón Exchange',
                        'Usuarios máx'   => '300 usuarios',
                    ],
                    'integrations'  => ['Microsoft Teams','SharePoint','OneDrive'],
                ],
                [
                    'slug'          => 'm365-std',
                    'name'          => 'Business Standard',
                    'desc'          => 'Word, Excel, PowerPoint, Outlook de escritorio + Teams + OneDrive 1TB.',
                    'price'         => '$320',
                    'precio_mensual'=> '$320',
                    'priceMeta'     => 'usuario/mes',
                    'badge'         => 'PyME',
                    'desc_long'     => 'Business Standard incluye todo lo de Basic más las apps de Office instaladas en escritorio: Word, Excel, PowerPoint, Outlook, Publisher y Access. El plan más popular para equipos que trabajan con archivos complejos de Office.',
                    'features'      => [
                        'Todo lo de Business Basic incluido',
                        'Office instalado en escritorio: Word, Excel, PowerPoint, Outlook',
                        'Hasta 5 dispositivos por usuario (PC, Mac, tablet, móvil)',
                        'Microsoft Teams con salas de reunión y webinars',
                        'Bookings para gestión de citas con clientes',
                        'MileIQ para seguimiento de kilometraje empresarial',
                    ],
                    'specs'         => [
                        'Apps escritorio' => 'Word, Excel, PowerPoint, Outlook, Publisher, Access',
                        'Dispositivos'    => '5 por usuario (PC/Mac/tablet/móvil)',
                        'Almacenamiento'  => '1 TB OneDrive + 50 GB buzón Exchange',
                        'Usuarios máx'    => '300 usuarios',
                    ],
                    'integrations'  => ['Microsoft Teams','SharePoint','OneDrive','Bookings'],
                ],
                [
                    'slug'          => 'm365-prem',
                    'name'          => 'Business Premium',
                    'desc'          => 'Standard + Intune MDM + Defender for Business + Azure AD Premium P1.',
                    'price'         => '$450',
                    'precio_mensual'=> '$450',
                    'priceMeta'     => 'usuario/mes',
                    'badge'         => 'Seguridad',
                    'desc_long'     => 'Business Premium es el plan más completo para PyMEs: incluye todo el Office 365 más una capa de seguridad empresarial con Defender for Business, gestión de dispositivos con Intune MDM y control de identidades con Azure AD Premium.',
                    'features'      => [
                        'Todo lo de Business Standard incluido',
                        'Microsoft Defender for Business — protección antimalware avanzada',
                        'Intune MDM: gestión y control remoto de dispositivos corporativos',
                        'Azure AD Premium P1: acceso condicional y MFA avanzado',
                        'Azure Information Protection P1: clasificación de datos sensibles',
                        'Microsoft Purview: prevención de pérdida de datos (DLP)',
                    ],
                    'specs'         => [
                        'Apps escritorio' => 'Word, Excel, PowerPoint, Outlook, Publisher, Access',
                        'Seguridad'       => 'Defender + Intune + Azure AD P1',
                        'Dispositivos'    => '5 por usuario (PC/Mac/tablet/móvil)',
                        'Usuarios máx'    => '300 usuarios',
                    ],
                    'integrations'  => ['Microsoft Teams','Intune','Azure AD','Defender'],
                ],
            ],
        ],

    ];

    /* Lista de precios sin descuento (mensual, sin IVA) — fuente: kb-productos.md */
    private array $listPrices = [
        'sae'          => 963.33,
        'coi'          => 485.83,
        'noi'          => 590.00,
        'banco'        => 505.00,
        'adm'          => 185.00,  // ADM Básica
        'facture'      => 217.92,
        'caja'         => 260.00,
        'prod'         => 749.92,
        'noi-asistente'=> null,
        'm365-basic'   => null,
        'm365-std'     => null,
        'm365-prem'    => null,
        'zoho-one'     => null,
        'zoho-crm'     => null,
        'zoho-books'   => null,
        'soft-pro'     => null,
        'soft-lite'    => null,
        'soft-delivery'=> null,
    ];

    private array $discountPct = [
        'sae'    => 25, 'coi'     => 25, 'noi'  => 25,
        'banco'  => 10, 'adm'     => 20, 'facture' => 20,
        'caja'   => 10, 'prod'    => 10,
    ];

    /* Servicios Logia — add-ons upsell en el carrito */
    private array $logiaSrv = [
        [
            'slug'  => 'impl',
            'name'  => 'Implementación Logia',
            'desc'  => 'Instalación, configuración y parametrización a tu operación',
            'price' => 3500,
            'icon'  => 'M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2V9M9 21H5a2 2 0 0 0-2-2V9m0 0h18',
        ],
        [
            'slug'  => 'cap',
            'name'  => 'Capacitación DC-3',
            'desc'  => '8 horas presenciales o en línea — certificado oficial',
            'price' => 2800,
            'icon'  => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
        ],
        [
            'slug'  => 'sop',
            'name'  => 'Póliza de Soporte Básica',
            'desc'  => '5 llamadas de asesoría · Lun-Vie 9-18h · vigencia 1 año',
            'price' => 3840,
            'icon'  => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0zm-5 0a4 4 0 1 1-8 0 4 4 0 0 1 8 0z',
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

    public function carrito(Request $request)
    {
        $brand   = $request->get('marca', 'aspel');
        $slug    = $request->get('producto');
        $partnerRouteNames = [
            'aspel' => 'partner.aspel', 'softrestaurant' => 'partner.soft',
            'zoho'  => 'partner.zoho',  'microsoft'       => 'partner.microsoft',
        ];

        $partnerData = $this->partners[$brand] ?? $this->partners['aspel'];
        $productData = $slug
            ? collect($partnerData['productos'])->firstWhere('slug', $slug)
            : null;

        $complements = $productData
            ? collect($partnerData['productos'])
                ->where('slug', '!=', $productData['slug'])
                ->values()->toArray()
            : [];

        return view('pages.carrito', [
            'brand'        => $brand,
            'partner'      => $partnerData,
            'product'      => $productData,
            'partnerRoute' => $partnerRouteNames[$brand] ?? 'home',
            'complements'  => $complements,
            'logiaSrv'     => $this->logiaSrv,
            'listPrice'    => $productData ? ($this->listPrices[$slug] ?? null) : null,
            'discountPct'  => $productData ? ($this->discountPct[$slug] ?? 0) : 0,
        ]);
    }

    public function checkout(Request $request)
    {
        return view('pages.checkout');
    }

    public function confirmacion()
    {
        return view('pages.checkout-confirmacion');
    }

    public function pdp(string $brand, string $product)
    {
        $partnerData = $this->partners[$brand] ?? null;
        abort_if(is_null($partnerData), 404);
        $productData = collect($partnerData['productos'])->firstWhere('slug', $product);
        abort_if(is_null($productData), 404);

        $partnerRouteNames = [
            'aspel'          => 'partner.aspel',
            'softrestaurant' => 'partner.soft',
            'zoho'           => 'partner.zoho',
            'microsoft'      => 'partner.microsoft',
        ];

        return view('pages.pdp', [
            'brand'       => $brand,
            'partner'     => $partnerData,
            'product'     => $productData,
            'partnerRoute'=> $partnerRouteNames[$brand] ?? 'home',
        ]);
    }
}
