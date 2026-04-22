# Logia Consulting — Sitemap y Arquitectura Técnica

**Proyecto:** Plataforma web Logia Consulting (e-commerce + e-learning + blog + soporte + web informativa)
**Cliente:** Logia Consulting (CDMX — WTC, Coapa, Polanco)
**Versión:** 1.0 — 21 / Abril / 2026
**Autor:** Equipo de implementación — basado en Plan de trabajo y retroalimentación del cliente
**Estado:** BORRADOR PARA REVISIÓN DEL CLIENTE

> Este documento cubre dos entregables: (1) el **Sitemap completo** del sitio público y privado, y (2) la **Arquitectura técnica** sobre el stack Laravel 11 + Filament v3 + Livewire 3 + Tailwind + CSS Variables. Es el insumo previo a la implementación y debe firmarse por el cliente antes de avanzar a la construcción.

---

## Tabla de contenido

1. Contexto del proyecto y decisiones fundacionales
2. Doctrina "Brand Chameleon" — el principio rector del diseño
3. Stack tecnológico definitivo
4. Sitemap — sitio público
5. Sitemap — sitio privado (alumnos, clientes, admin)
6. Estructura de URLs y convenciones de rutas
7. Arquitectura de software por capas
8. Modelo de datos (entidades principales)
9. Sistema de tematización multi-marca
10. Módulos funcionales — E-commerce
11. Módulos funcionales — E-learning
12. Módulos funcionales — Blog + CMS
13. Módulos funcionales — Soporte técnico y tickets
14. Módulos funcionales — Panel administrativo (Filament)
15. Seguridad, RBAC y protección de contenido
16. Integraciones externas
17. Observaciones del cliente (imágenes anotadas) atendidas
18. Architecture Decision Records (ADRs)
19. Deployment, CI/CD y observabilidad
20. Roadmap por fases
21. Apéndice A — tokens de tematización por marca
22. Apéndice B — inventario de rutas (sitemap plano)
23. Apéndice C — riesgos abiertos y preguntas para el cliente

---

## 1. Contexto del proyecto y decisiones fundacionales

### 1.1 Perfil del cliente
Logia Consulting es una firma mexicana con más de **20 años de experiencia**, más de **1,300 clientes** atendidos, presencia presencial en tres sedes (World Trade Center CDMX, Coapa y Polanco) y el reconocimiento como **Centro de Capacitación Premium Aspel #1 en México**. Su modelo de negocio es triple:

- **Reventa de licencias** de software de sus partners (Siigo Aspel, Soft Restaurant, Zoho One y Microsoft 365).
- **Capacitación certificada** presencial y remota — con materiales y certificados avalados por las marcas.
- **Soporte técnico** presencial e implementación en sitio.

### 1.2 Marcas partner y su jerarquía comercial
| # | Marca | Rol de Logia | Prioridad de peso en la web |
|---|-------|--------------|------------------------------|
| 1 | Siigo Aspel | Partner oficial + Centro Premium #1 | Alta |
| 2 | Soft Restaurant | Partner oficial reventa + capacitación | Alta |
| 3 | Zoho One | Partner oficial reventa + capacitación | Alta |
| 4 | Microsoft 365 | Partner certificado (sólo capacitación) | Media — foco en capacitación |

### 1.3 Decisiones fundacionales (no negociables confirmadas por el cliente)
- **D1. Brand Chameleon:** cuando un usuario entra al universo de una marca partner, la UI se debe sentir como extensión oficial de esa marca (tipografía, color, iconografía, composición). Ver §2.
- **D2. Identidad Logia:** en las zonas transversales (home, blog, nosotros, checkout, dashboard de cliente) manda la identidad de Logia Consulting.
- **D3. Stack 100% Laravel** — no React, no Vue. Livewire 3 + Alpine.js para toda la interactividad.
- **D4. Admin en Filament v3** — cero custom dashboards, aprovechar el ecosistema Filament.
- **D5. DRM en e-learning** — el contenido de capacitación debe estar protegido contra descarga (videos con DRM, PDFs sin permisos de descarga).
- **D6. Pagos México-first** — Stripe MX con tarjeta, OXXO Pay y SPEI (vía Stripe).
- **D7. Pipeline de marketing (Fase 3)** — n8n + Apify + Gemini para automatizar campañas de Meta Ads.

---

## 2. Doctrina "Brand Chameleon" — el principio rector del diseño

Es la observación más crítica del cliente y se convierte en la **regla de arquitectura de presentación** de todo el sitio.

### 2.1 Enunciado
> *"Cuando un cliente entra a Logia Consulting y quiera obtener un servicio o producto, debe sentir que se metió a una página que es extensión de la marca original."*

### 2.2 Qué significa en términos concretos
Cada ruta del sitio pertenece a **exactamente un contexto visual** (un *tenant de marca*). El contexto determina:

- **Paleta de color** (primario, secundario, acentos, semánticos).
- **Tipografía** (familia display, familia cuerpo, pesos).
- **Radios, sombras y densidad** de los componentes.
- **Iconografía** (set de íconos afín a la marca).
- **Composición de hero, cards y CTAs**.
- **Tono de voz** de la copy.

### 2.3 Mapa de contextos visuales
| Contexto | Ruta raíz | Componentes de marca |
|----------|-----------|-----------------------|
| `logia` (default) | `/`, `/nosotros`, `/blog`, `/contacto`, `/checkout`, `/mi-cuenta` | Identidad Logia |
| `aspel` | `/aspel/*` | Siigo Aspel — azul corporativo + rojo acento |
| `softrestaurant` | `/soft-restaurant/*` | Soft Restaurant — naranja + neutros fríos |
| `zoho` | `/zoho/*` | Zoho One — rojo marrón / multicolor |
| `microsoft` | `/microsoft-365/*` | Fluent 2 — paleta multicolor + neutros |

### 2.4 Contrato visual (componentes que SÍ cambian vs. componentes que NO)
**Cambian por marca (tematizable):**
- Hero, cards de producto, botones primarios, tipografía, color de acento, iconos del catálogo, fondo del sticky nav dentro del contexto.

**No cambian (identidad Logia permanente):**
- Logo Logia (arriba izquierda, siempre visible).
- Footer (siempre Logia — trust signals, oficinas, contacto, aviso de privacidad).
- Breadcrumb con "Logia Consulting" como raíz.
- Copy transaccional del checkout y dashboard del cliente.
- Sello de partner oficial en cada hero de marca ("Partner oficial de Siigo Aspel / Soft Restaurant / Zoho One / Microsoft 365").

### 2.5 Implicaciones para la implementación
- El sistema de tematización debe soportarse con **CSS Variables** (ver §9) y un **middleware de Laravel** que inyecte el contexto según la URL.
- Un **layout Blade base** (`layouts.brand`) recibe el tenant y expone los tokens al árbol de componentes.
- Cada componente Livewire lee tokens desde CSS Variables — **no se hardcodean colores**.

---

## 3. Stack tecnológico definitivo

Stack confirmado por el cliente. Se documenta íntegro como referencia canónica.

### 3.1 Backend
- **Laravel 11 + PHP 8.3** — backend principal (framework y runtime).
- **Filament PHP v3** — panel admin con Chart.js nativo para dashboards.
- **Livewire 3 + Alpine.js** — UI reactiva sin SPA.
- **MySQL 8** — base de datos (hosted en Railway).
- **Laravel Sanctum** — autenticación API (dashboard y móviles futuras).
- **Spatie/laravel-permission** — RBAC con subroles.
- **Laravel Cashier + Stripe MX** — pagos (tarjeta + OXXO Pay + SPEI).

### 3.2 Frontend
- **Tailwind CSS 3** + **CSS Variables** — estilos y multi-tema por marca.
- **Alpine.js** — interactividad mínima en el lado cliente (magnetismo, mega-menú, tarjeta 3D ligera).

### 3.3 E-learning
- **Bunny.net Stream** — streaming CDN de video.
- **Bunny.net MediaCage DRM** — DRM Widevine + FairPlay (decisión pendiente P vs B — ver ADR-002).
- **Mozilla PDF.js embebido** — visor de PDF sin permisos de descarga.
- **Google Cloud Storage** — archivos y materiales protegidos.
- **Laravel DomPDF** — generación de certificados PDF (3 plantillas).
- **Spatie/laravel-medialibrary** — gestión de media.
- **Spatie/laravel-activitylog** — auditoría de accesos (quién vio qué video, cuándo, cuánto tiempo).

### 3.4 Integraciones
- **Cal.com** (Docker en Railway) — agendado de citas de capacitación / soporte / demo.
- **MS Graph API** — reuniones en Teams y webhooks de Microsoft 365 Copilot.
- **Resend.com Pro** — email transaccional (confirmación de compra, recuperación de clave, certificados, tickets).
- **Stripe México** — pagos (tarjeta, OXXO, SPEI).

### 3.5 Fase 3 (automatización marketing)
- **n8n Community** (self-hosted en Railway) — orquestación de flujos Meta Ads.
- **Apify API** — scraping de audiencias.
- **Gemini API** — generación de copy de anuncios.

### 3.6 Infraestructura
- **GitHub Actions** → **Railway** — CI/CD con auto-deploy.
- **Cloudflare Pro** — CDN + WAF + SSL Full Strict.
- **UptimeRobot** — monitoreo uptime + latencia.
- **Spatie/laravel-backup** — backups nocturnos a Google Cloud Storage.

### 3.7 Versiones mínimas requeridas
| Componente | Versión |
|-----------|---------|
| PHP | 8.3 |
| Laravel | 11.x |
| Filament | 3.2+ |
| Livewire | 3.x |
| Alpine.js | 3.x |
| Tailwind | 3.4+ |
| MySQL | 8.0+ |
| Node (build) | 20 LTS |

---

## 4. Sitemap — sitio público

El sitio público está agrupado en 7 secciones de navegación principal. El mega-menú (observación del cliente en PNG) despliega las **secciones de Logia** y **los productos de las 4 marcas**.

### 4.1 Diagrama de árbol

```
/ (home — contexto logia)
├── /nosotros
│   ├── /nosotros/historia
│   ├── /nosotros/equipo
│   ├── /nosotros/certificaciones
│   └── /nosotros/oficinas         (WTC, Coapa, Polanco — con mapa)
│
├── /productos                      (landing con grid de las 4 marcas)
│   │
│   ├── /aspel                      (landing Siigo Aspel — contexto aspel)
│   │   ├── /aspel/siigo-nube
│   │   ├── /aspel/siigo-aspel-sae
│   │   ├── /aspel/siigo-aspel-adm
│   │   ├── /aspel/siigo-aspel-noi
│   │   ├── /aspel/siigo-aspel-noi-asistente
│   │   ├── /aspel/siigo-aspel-coi
│   │   ├── /aspel/siigo-aspel-facture
│   │   ├── /aspel/siigo-aspel-caja
│   │   ├── /aspel/siigo-aspel-prod
│   │   ├── /aspel/siigo-aspel-banco
│   │   ├── /aspel/siigo-aspel-adm-tienda
│   │   ├── /aspel/siigo-aspel-adm-timbres
│   │   ├── /aspel/siigo-nube-facturacion
│   │   ├── /aspel/servidor-virtual-aspel
│   │   ├── /aspel/espacio-aspel
│   │   ├── /aspel/timbres
│   │   └── /aspel/sat-reader       (Siigo Fiscal)
│   │
│   ├── /soft-restaurant            (landing Soft Restaurant — contexto softrestaurant)
│   │   ├── /soft-restaurant/punto-de-venta
│   │   ├── /soft-restaurant/control-de-cocina
│   │   ├── /soft-restaurant/inventarios
│   │   ├── /soft-restaurant/reportes-fb
│   │   ├── /soft-restaurant/delivery
│   │   ├── /soft-restaurant/franquicias
│   │   └── /soft-restaurant/version-standard
│   │
│   ├── /zoho                       (landing Zoho One — contexto zoho)
│   │   ├── /zoho/crm
│   │   ├── /zoho/books
│   │   ├── /zoho/people
│   │   ├── /zoho/projects
│   │   ├── /zoho/desk
│   │   ├── /zoho/inventory
│   │   ├── /zoho/campaigns
│   │   ├── /zoho/analytics
│   │   ├── /zoho/creator
│   │   └── /zoho/apps              (index de las 40+ apps)
│   │
│   └── /microsoft-365              (landing MS 365 — contexto microsoft)
│       ├── /microsoft-365/business-basic
│       ├── /microsoft-365/business-standard
│       ├── /microsoft-365/business-premium
│       ├── /microsoft-365/apps-for-business
│       ├── /microsoft-365/copilot
│       └── /microsoft-365/capacitaciones
│
├── /capacitacion                   (e-learning — catálogo público de cursos)
│   ├── /capacitacion/aspel
│   ├── /capacitacion/soft-restaurant
│   ├── /capacitacion/zoho
│   ├── /capacitacion/microsoft-365
│   ├── /capacitacion/curso/{slug}  (detalle — preview + CTA compra)
│   ├── /capacitacion/calendario    (cursos presenciales próximos)
│   └── /capacitacion/certificaciones-oficiales
│
├── /servicios
│   ├── /servicios/implementacion
│   ├── /servicios/soporte-remoto
│   ├── /servicios/soporte-presencial
│   ├── /servicios/consultoria
│   └── /servicios/migracion
│
├── /blog
│   ├── /blog/categoria/{slug}
│   ├── /blog/tag/{slug}
│   ├── /blog/autor/{slug}
│   └── /blog/{year}/{month}/{slug} (post)
│
├── /contacto
│   ├── /contacto/ventas
│   ├── /contacto/soporte
│   ├── /contacto/capacitacion
│   └── /contacto/agendar-cita       (embed Cal.com)
│
└── /legal
    ├── /legal/aviso-de-privacidad
    ├── /legal/terminos-y-condiciones
    ├── /legal/politica-de-cookies
    └── /legal/politica-de-devoluciones
```

### 4.2 Rutas funcionales (no menú principal)
| Ruta | Función |
|------|---------|
| `/buscar?q=` | Búsqueda global (productos + cursos + posts) con Laravel Scout |
| `/carrito` | Carrito persistente (sesión + usuario autenticado) |
| `/checkout` | Flujo de pago (contexto logia forzado) |
| `/checkout/success/{order}` | Página de confirmación con descarga de factura |
| `/iniciar-sesion` | Login |
| `/registrarse` | Registro |
| `/recuperar-clave` | Password reset |
| `/verificar-email/{token}` | Verificación de email |
| `/feed.xml` | RSS del blog |
| `/sitemap.xml` | XML sitemap generado automáticamente |
| `/robots.txt` | Robots |

### 4.3 Convenciones del menú principal (header)
Orden de izquierda a derecha según observación del cliente y patrón Siigo (ref. PNG):

```
[Logo Logia (ampliado)]   Productos ▾   Capacitación ▾   Servicios ▾   Nosotros ▾   Blog     [Iniciar sesión]   [Agendar sesión gratuita]
```

**Mega-menú de "Productos"** (observación crítica del cliente): al hover o click despliega un rectángulo full-width con dos zonas:
1. **Zona izquierda (Logia)** — enlaces a secciones transversales: Implementación, Soporte, Consultoría, Capacitación.
2. **Zona derecha (4 columnas, una por marca)** — cada columna encabezada por el logo de la marca y una lista de sus productos (mismo patrón que usa Siigo Aspel en su menú de "Soluciones"). Cada item lleva al URL correspondiente del contexto de esa marca.

Ver §17.1 para el spec de implementación de este mega-menú.

---

## 5. Sitemap — sitio privado (alumnos, clientes, admin)

### 5.1 Dashboard del cliente final (`/mi-cuenta/*`)
Acceso: usuarios autenticados con rol `cliente` o superior.

```
/mi-cuenta
├── /mi-cuenta/resumen              (dashboard home — compras recientes, cursos activos, tickets abiertos)
├── /mi-cuenta/licencias            (todas las licencias compradas y su estado)
│   └── /mi-cuenta/licencias/{id}   (detalle + descarga instalador + clave)
├── /mi-cuenta/pedidos
│   └── /mi-cuenta/pedidos/{id}     (factura PDF, reenvío por email)
├── /mi-cuenta/facturacion          (datos fiscales para CFDI)
├── /mi-cuenta/metodos-de-pago
├── /mi-cuenta/direcciones
└── /mi-cuenta/perfil               (cambiar clave, 2FA, preferencias)
```

### 5.2 Dashboard del alumno (`/aula/*`)
Acceso: usuarios con rol `alumno` (se asigna automáticamente al comprar cualquier curso).

```
/aula
├── /aula/mis-cursos                (lista de cursos comprados, progreso %)
├── /aula/curso/{slug}
│   ├── /aula/curso/{slug}/modulo/{n}           (reproductor video + materiales)
│   ├── /aula/curso/{slug}/quiz/{id}            (quizzes)
│   ├── /aula/curso/{slug}/tareas
│   └── /aula/curso/{slug}/foro                 (Q&A por curso)
├── /aula/certificados              (descarga certificados DomPDF)
│   └── /aula/certificados/{id}/verificar       (URL pública para QR de verificación)
├── /aula/calendario                (próximas sesiones presenciales agendadas)
└── /aula/soporte                   (atajo a tickets del área de capacitación)
```

### 5.3 Portal de soporte (`/soporte/*`)
Acceso: cualquier usuario autenticado.

```
/soporte
├── /soporte/tickets                (listado del usuario)
│   ├── /soporte/tickets/nuevo      (formulario + adjuntos)
│   └── /soporte/tickets/{id}       (hilo de conversación)
├── /soporte/base-de-conocimiento   (KB pública + KB interna según rol)
│   └── /soporte/kb/{categoria}/{slug}
└── /soporte/agendar-sesion         (Cal.com — sesión remota o en sitio)
```

### 5.4 Panel administrativo Filament (`/admin/*`)
Acceso restringido por `Spatie/laravel-permission`. Ver §14 para los resources.

```
/admin
├── /admin/login
├── /admin/dashboard                (KPIs con Chart.js: ventas MTD, cursos, tickets, NPS)
│
├── CATÁLOGO
│   ├── /admin/marcas               (CRUD de las 4 marcas partner)
│   ├── /admin/productos            (licencias de software)
│   ├── /admin/categorias
│   ├── /admin/precios              (reglas de precio, descuentos, cupones)
│   └── /admin/banners              (banner de publicidad editable — observación cliente)
│
├── E-LEARNING
│   ├── /admin/cursos
│   ├── /admin/modulos
│   ├── /admin/lecciones            (upload a Bunny Stream desde aquí)
│   ├── /admin/quizzes
│   ├── /admin/certificados         (plantillas DomPDF)
│   └── /admin/instructores
│
├── CMS / BLOG
│   ├── /admin/posts
│   ├── /admin/categorias-blog
│   ├── /admin/tags
│   ├── /admin/autores
│   └── /admin/paginas              (páginas estáticas editables)
│
├── VENTAS
│   ├── /admin/pedidos
│   ├── /admin/facturas             (emisión CFDI — integración con PAC externo)
│   ├── /admin/licencias            (pool de claves a entregar)
│   └── /admin/cupones
│
├── CRM LIGERO
│   ├── /admin/leads
│   ├── /admin/clientes
│   └── /admin/empresas
│
├── SOPORTE
│   ├── /admin/tickets              (bandeja con SLA + asignaciones)
│   ├── /admin/categorias-ticket
│   └── /admin/sla-reglas
│
├── USUARIOS & SEGURIDAD
│   ├── /admin/usuarios
│   ├── /admin/roles
│   ├── /admin/permisos
│   └── /admin/auditoria            (Spatie activitylog)
│
├── MARKETING (Fase 3)
│   ├── /admin/campanas             (Meta Ads via n8n)
│   ├── /admin/audiencias           (Apify)
│   └── /admin/copys-ia             (Gemini)
│
└── AJUSTES
    ├── /admin/ajustes/generales
    ├── /admin/ajustes/marcas       (tokens, logos, tipografías por marca)
    ├── /admin/ajustes/integraciones (Stripe, Bunny, Cal.com, MS Graph, Resend)
    ├── /admin/ajustes/email        (plantillas)
    └── /admin/ajustes/backups      (estado + restauración)
```

---

## 6. Estructura de URLs y convenciones de rutas

### 6.1 Reglas de URLs
- **Idioma:** todo en español, URLs limpias en kebab-case.
- **Sin sufijos `.html`** ni `.php`.
- **Sin trailing slash** (middleware de Laravel lo normaliza).
- **UTM-safe:** los query strings de Meta Ads no rompen rutas.
- **Slugs estables:** al cambiar el nombre comercial de un producto, se crea un 301 en una tabla `redirects` del admin.

### 6.2 Ejemplos canónicos
| Patrón | Ejemplo | Marca / contexto |
|--------|---------|------------------|
| `/` | `/` | logia |
| `/{marca}` | `/aspel` | aspel |
| `/{marca}/{producto}` | `/aspel/siigo-aspel-sae` | aspel |
| `/capacitacion/curso/{slug}` | `/capacitacion/curso/siigo-aspel-sae-intermedio` | logia (con chips de marca) |
| `/blog/{year}/{month}/{slug}` | `/blog/2026/04/cambios-cfdi-4-0` | logia |

### 6.3 Parámetros de query estandarizados
| Query | Significado |
|-------|-------------|
| `?ref=` | Campaña (free-form, se guarda en `orders.referral_source`) |
| `?utm_*` | Estándar UTM — se mapea a columnas del `orders` |
| `?preview=1` | Previsualización editorial (requiere rol) |
| `?theme_override=` | **DEV ONLY** — fuerza un contexto visual (off en producción) |

---

## 7. Arquitectura de software por capas

La aplicación sigue un estilo **monolito modular** en Laravel (no microservicios). Internamente se organiza en **módulos de dominio** (bounded contexts) con fronteras claras.

### 7.1 Diagrama de capas

```
┌─────────────────────────────────────────────────────────────────┐
│  CANALES DE ENTRADA                                             │
│  ──────────────────────────                                     │
│  - Web pública (Livewire + Blade)                               │
│  - Panel admin (Filament v3)                                    │
│  - Aula (Livewire + Blade)                                      │
│  - API móvil futura (Sanctum — /api/v1/*)                       │
│  - Webhooks (Stripe, Cal.com, MS Graph, Bunny, Resend)          │
└──────────────────────────┬──────────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────────┐
│  CAPA DE APLICACIÓN (Use Cases / Actions)                       │
│  ──────────────────────────                                     │
│  - App\Actions\Orders\PlaceOrder                                │
│  - App\Actions\Courses\EnrollStudent                            │
│  - App\Actions\Support\OpenTicket                               │
│  - App\Actions\Billing\IssueCfdi                                │
│  (patrón Action class estilo Spatie — una clase, un caso de uso)│
└──────────────────────────┬──────────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────────┐
│  CAPA DE DOMINIO — MÓDULOS (Bounded Contexts)                   │
│  ──────────────────────────                                     │
│  Catalog     │ Learning   │ Commerce   │ Support   │ Billing    │
│  Users       │ Content    │ Branding   │ Marketing │ Analytics  │
└──────────────────────────┬──────────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────────┐
│  CAPA DE PERSISTENCIA                                           │
│  ──────────────────────────                                     │
│  - Eloquent Models + Repositories                               │
│  - MySQL 8 (Railway)                                            │
│  - Redis (cache + sessions + queues) — opcional Railway         │
│  - Google Cloud Storage (archivos protegidos)                   │
└──────────────────────────┬──────────────────────────────────────┘
                           │
┌──────────────────────────▼──────────────────────────────────────┐
│  INTEGRACIONES EXTERNAS (Gateways)                              │
│  ──────────────────────────                                     │
│  Stripe MX │ Bunny Stream │ Cal.com │ MS Graph │ Resend │ n8n   │
└─────────────────────────────────────────────────────────────────┘
```

### 7.2 Organización de directorios propuesta

```
app/
├── Actions/                 # use cases (PlaceOrder, EnrollStudent…)
├── Domain/                  # bounded contexts
│   ├── Catalog/             # Brand, Product, Category, Price
│   ├── Commerce/            # Cart, Order, Coupon
│   ├── Learning/            # Course, Module, Lesson, Enrollment, Certificate, Quiz
│   ├── Billing/             # Invoice, Cfdi, TaxProfile
│   ├── Support/             # Ticket, Message, Sla
│   ├── Users/               # User, Role, Permission, Company
│   ├── Content/             # Post, Page, Banner, Author, Tag
│   ├── Branding/            # BrandTheme, ThemeToken
│   └── Marketing/           # Campaign, Lead, UtmReport
├── Filament/                # Resources y Pages por módulo
├── Http/
│   ├── Controllers/         # mínimo — delegan a Actions
│   ├── Livewire/            # componentes por página pública
│   ├── Middleware/
│   │   ├── ResolveBrandContext.php    # §9
│   │   └── EnforceTenantRedirect.php
│   └── Requests/
├── Jobs/                    # IssueCertificateJob, SyncLicenseJob, SendWelcomeJob…
├── Mail/                    # Mailables
├── Notifications/
├── Policies/
├── Providers/
├── Services/                # wrappers de API externos (StripeService, BunnyService…)
└── Support/                 # helpers, macros
```

### 7.3 Principios de ingeniería adoptados
- **Thin controllers, fat actions** — los controladores orquestan, no implementan lógica de negocio.
- **Eloquent como repositorio** — nada de Doctrine; aprovechamos el Active Record de Laravel.
- **Feature tests con Pest** — cobertura mínima 70% en Fase 1, 85% en Fase 2.
- **Form Requests siempre** — nunca validación inline en controllers.
- **Policies siempre** — toda acción sensible pasa por Gate.
- **Jobs con cola Redis** — emails, certificados, webhooks outbound van a cola.
- **Logs estructurados** — Monolog con context, enviar a Railway logs (y stderr en prod).

---

## 8. Modelo de datos (entidades principales)

### 8.1 Diagrama ER de alto nivel

```
                              ┌────────────┐
                              │   Brand    │  (aspel, soft-restaurant, zoho, microsoft, logia)
                              └─────┬──────┘
                                    │ 1
                                    │
                                    │ *
                              ┌─────▼──────┐
          ┌──────────────────►│  Product   │◄──────────────┐
          │                   └─────┬──────┘               │
          │                         │ 1                    │
          │                         │                      │
          │                         │ *                    │
          │                   ┌─────▼──────┐               │
          │                   │ Price /    │               │
          │                   │ License    │               │
          │                   └────────────┘               │
          │                                                │
  ┌───────┴────┐      ┌────────────┐      ┌────────────┐   │
  │  Category  │      │   Cart     │─────►│ CartItem   │───┘
  └────────────┘      └─────┬──────┘      └────────────┘
                            │ 1
                            │ checkout
                            │
                      ┌─────▼──────┐         ┌────────────┐
                      │   Order    │────────►│ OrderItem  │
                      └─────┬──────┘         └────────────┘
                            │                       │
                            │                       │
                      ┌─────▼──────┐         ┌──────▼──────┐
                      │  Payment   │         │  Invoice    │
                      │ (Stripe)   │         │  (CFDI 4.0) │
                      └────────────┘         └─────────────┘

  ┌────────────┐      ┌────────────┐      ┌────────────┐      ┌────────────┐
  │   User     │─────►│ Enrollment │─────►│   Course   │─────►│   Module   │
  └────────────┘      └─────┬──────┘      └─────┬──────┘      └─────┬──────┘
                            │                   │                    │
                      ┌─────▼──────┐      ┌─────▼──────┐      ┌─────▼──────┐
                      │Certificate │      │  Lesson    │      │   Quiz     │
                      │ (DomPDF)   │      │ (Bunny DRM)│      │            │
                      └────────────┘      └────────────┘      └────────────┘

  ┌────────────┐      ┌────────────┐      ┌────────────┐
  │   User     │─────►│  Ticket    │─────►│  Message   │
  └────────────┘      └────────────┘      └────────────┘
                            │
                            │ assigned_to
                            │
                      ┌─────▼──────┐
                      │  Agent     │
                      └────────────┘

  ┌────────────┐      ┌────────────┐      ┌────────────┐
  │   Post     │─────►│ Category   │      │  Banner    │
  └────┬───────┘      └────────────┘      │(home only) │
       │ *                                └────────────┘
       ▼ 1
  ┌────────────┐
  │   Author   │
  └────────────┘
```

### 8.2 Tablas principales (resumen)

| Tabla | Campos clave | Notas |
|-------|--------------|-------|
| `brands` | slug, name, logo_path, primary_color, accent_color, font_stack, theme_json | Controla la tematización (§9) |
| `products` | brand_id, category_id, slug, name, short_desc, long_desc, hero_json, sku | Polimórfico con `licenseable` |
| `product_variants` | product_id, sku, price_mxn, currency, billing_period (monthly/yearly/perpetual) | Variantes de licencia |
| `licenses` | product_variant_id, key, status (available/assigned/revoked), assigned_to, assigned_at | Pool de llaves |
| `coupons` | code, type (percent/fixed), value, valid_from, valid_to, max_uses, used, applicable_brands_json | Reglas de descuento |
| `orders` | user_id, status, subtotal, discount, tax, total, currency, utm_json, stripe_payment_intent_id | Un order por compra |
| `order_items` | order_id, product_variant_id, qty, unit_price, total | Snapshot de precio |
| `invoices` | order_id, cfdi_uuid, xml_path, pdf_path, status, issued_at | CFDI 4.0 vía PAC externo |
| `courses` | brand_id, slug, title, level, duration_min, price_mxn, instructor_id | Cursos de capacitación |
| `course_modules` | course_id, order, title | Secciones |
| `lessons` | module_id, order, title, type (video/pdf/quiz/link), bunny_video_id, pdf_path | DRM-protected |
| `quizzes` / `quiz_questions` / `quiz_attempts` | — | Evaluaciones |
| `enrollments` | user_id, course_id, started_at, completed_at, progress_pct | 1 por alumno-curso |
| `certificates` | enrollment_id, serial, issued_at, pdf_path, verification_code | QR público de verificación |
| `tickets` | user_id, brand_id, category_id, subject, body, status, priority, sla_deadline, agent_id | Soporte |
| `ticket_messages` | ticket_id, user_id, body, attachments_json, is_internal | Hilo |
| `posts` | author_id, category_id, slug, title, body_md, published_at, seo_json | Blog |
| `banners` | position, image_path, link_url, starts_at, ends_at, active | Banner editable (§17.2) |
| `pages` | slug, title, body_md, seo_json | Páginas estáticas |
| `settings` | key, value_json, group | Configuración global |
| `redirects` | from_path, to_path, http_code, active | Para cambios de slug |
| `activity_log` | Spatie | Auditoría |

### 8.3 Convenciones de BD
- Todas las tablas tienen `id` (UUID v7), `created_at`, `updated_at`, `deleted_at` (soft deletes donde aplica).
- Moneda: todos los montos en MXN en columnas `decimal(12,2)`.
- Textos largos (descripciones) en `mediumtext` y se editan con Markdown + sanitización.
- Timestamps en UTC, se convierten a `America/Mexico_City` en la capa de presentación.

---

## 9. Sistema de tematización multi-marca

El sistema que materializa la doctrina "Brand Chameleon" (§2). Se apoya en **CSS Custom Properties** inyectadas por middleware.

### 9.1 Arquitectura

```
URL: /aspel/siigo-aspel-sae
       │
       ▼
┌──────────────────────────────┐
│ ResolveBrandContext middleware│
│  - lee el primer segmento    │
│  - busca Brand en BD         │
│  - inyecta en request()      │
│  - comparte con view()       │
└─────────┬────────────────────┘
          │
          ▼
┌──────────────────────────────┐
│ layouts.brand Blade          │
│  <html data-brand="aspel">   │
│  <style> :root{ --primary: … } </style>
└─────────┬────────────────────┘
          │
          ▼
┌──────────────────────────────┐
│ Todos los componentes leen   │
│ var(--primary), var(--font-  │
│ display), var(--radius-card) │
└──────────────────────────────┘
```

### 9.2 Capas de tokens

**Capa 1 — Tokens globales (neutrals, spacing, motion)** — iguales para todas las marcas:
```css
:root {
  --space-1: 4px;  --space-2: 8px;  --space-3: 12px;
  --space-4: 16px; --space-6: 24px; --space-8: 32px;
  --ease-out: cubic-bezier(0.2, 0.8, 0.2, 1);
  --duration-fast: 150ms;
  --duration-base: 250ms;
}
```

**Capa 2 — Tokens por marca** — inyectados según contexto (paletas oficiales del cliente, entregadas 21-abr-2026):
```css
[data-brand="aspel"] {
  --primary: #009DFF;    /* azul brillante oficial Siigo Aspel */
  --primary-fg: #FFFFFF;
  --accent: #3B4758;     /* gris azulado oficial */
  --surface: #FFFFFF;
  --bg: #F5F8FC;
  --border: #AAB0B8;     /* gris claro oficial */
  --text: #1A2230;
  --text-muted: #3B4758;
  --font-display: "Gotham", "Montserrat", sans-serif;
  --font-body:    "Roboto", "Inter", sans-serif;
  --radius-card: 10px;
  --shadow-card: 0 6px 20px rgba(0,157,255,0.14);
  /* NOTA WCAG: #009DFF/blanco ≈3.0:1. No usar como body. CTAs large-bold únicamente. */
}

[data-brand="softrestaurant"] {
  --primary: #E25724;    /* naranja cobre oficial Soft Restaurant */
  --primary-fg: #FFFFFF;
  --primary-alt: #E7803C;/* naranja claro oficial — decoración secundaria */
  --accent:  #584569;    /* púrpura oficial de la marca */
  --surface: #FFFFFF;
  --bg:      #FFF7F1;
  --border:  #E8C9B3;
  --text:    #3C3B44;    /* charcoal oficial */
  --text-muted: #6B6773;
  --font-display: "Inter", "Manrope", sans-serif;
  --font-body:    "Inter", sans-serif;
  --radius-card: 14px;
  --shadow-card: 0 8px 26px rgba(226,87,36,0.16);
  /* NOTA WCAG: #E25724/blanco ≈4.2:1, borderline. Exigir font-weight >=500 sobre primary. */
}

[data-brand="zoho"] {
  --primary: #E42527;    /* rojo oficial del logo Zoho */
  --primary-fg: #FFFFFF;
  --accent:  #226DB4;    /* azul oficial del logo */
  --surface: #FFFFFF;
  --bg:      #F8F8F6;
  --text:    #1B1B1B;
  --text-muted: #5A5A5A;
  /* Semánticos = los 4 chips del logo */
  --success: #089949;
  --warning: #F9B21D;
  --danger:  #E42527;
  --info:    #226DB4;
  --font-display: "Puvi", "Lato", sans-serif;
  --font-body:    "Lato", "Inter", sans-serif;
  --radius-card: 6px;
  --shadow-card: 0 2px 10px rgba(228,37,39,0.10);
}

[data-brand="microsoft"] {
  --primary: #05A6F0;    /* azul Outlook oficial */
  --primary-fg: #FFFFFF;
  --accent:  #F35325;    /* naranja PowerPoint oficial */
  --surface: #FFFFFF;
  --bg:      #FAFAFA;
  --text:    #081C28;    /* navy oficial — AAA body */
  --text-muted: #4A5766;
  /* Semánticos = los 4 chips del cuadrado Microsoft */
  --success: #81BC06;    /* verde Excel */
  --warning: #FFBA08;    /* amarillo Office */
  --danger:  #F35325;    /* naranja PowerPoint */
  --info:    #05A6F0;    /* azul Outlook */
  --font-display: "Segoe UI Variable", "Segoe UI", system-ui, sans-serif;
  --font-body:    "Segoe UI Variable", system-ui, sans-serif;
  --radius-card: 4px;    /* Fluent 2 */
  --shadow-card: 0 1.6px 3.6px rgba(8,28,40,0.132);
  /* NOTA WCAG: #05A6F0/blanco ≈2.8:1. No usar como body. Texto = #081C28. */
}

[data-brand="logia"] {
  /* Oficial MICLOGIA.pdf — Pantone 1505 C / 424 C / Cool Gray 1 C / 285 C */
  --primary:      #FF6B00;    /* Pantone 1505 C — naranja dominante */
  --primary-fg:   #FFFFFF;
  --accent:       #0071CE;    /* Pantone 285 C — azul CONSULTING */
  --brand-gray:   #717271;    /* Pantone 424 C — "LOGIA" */
  --brand-gray-light: #DBD9D6;/* Pantone Cool Gray 1 C */
  --surface:      #FFFFFF;
  --bg:           #FAFAFA;
  --border:       #DBD9D6;
  --text:         #2A2A2A;
  --text-muted:   #717271;
  --font-display: "Helvetica Neue", "Helvetica", "Arial", system-ui, sans-serif;
  --font-body:    "Helvetica", "Helvetica Neue", "Arial", system-ui, sans-serif;
  --radius-card:  12px;
  --shadow-card:  0 8px 24px rgba(255,107,0,0.10);
}
```

> ✅ **Tokens Logia reconciliados** con `MICLOGIA.pdf` v1.1 — ver apéndice A.1 y `docs/02-design-system.md` §4.1 para reglas de uso del naranja (no cumple AA body sobre blanco; requiere bold ≥16px o texto large).

### 9.3 Middleware `ResolveBrandContext`

```php
// app/Http/Middleware/ResolveBrandContext.php
class ResolveBrandContext
{
    public function handle(Request $request, Closure $next)
    {
        $slug = $this->resolveBrandSlug($request); // aspel | softrestaurant | zoho | microsoft | logia
        $brand = Brand::where('slug', $slug)->firstOrFail();

        // Disponible en controladores, views y Livewire components
        app()->instance('brand.context', $brand);
        view()->share('brand', $brand);

        return $next($request);
    }

    protected function resolveBrandSlug(Request $r): string
    {
        $first = $r->segment(1);
        return match (true) {
            $first === 'aspel'            => 'aspel',
            $first === 'soft-restaurant'  => 'softrestaurant',
            $first === 'zoho'             => 'zoho',
            $first === 'microsoft-365'    => 'microsoft',
            default                       => 'logia',
        };
    }
}
```

### 9.4 Layout Blade raíz
```blade
{{-- resources/views/layouts/brand.blade.php --}}
<!DOCTYPE html>
<html lang="es-MX" data-brand="{{ $brand->slug }}">
<head>
    @include('partials.head-meta')
    <style>
      /* Tokens globales + tokens de marca del BD (para que admin pueda editarlos sin redeploy) */
      {!! $brand->renderCssVariables() !!}
    </style>
</head>
<body class="bg-[var(--bg)] text-[var(--text)] font-[var(--font-body)]">
    <x-site-header />
    <main>{{ $slot }}</main>
    <x-site-footer />   {{-- siempre identidad Logia --}}
</body>
</html>
```

### 9.5 Uso de tokens en Tailwind (no hardcode)
```html
<button class="bg-[var(--primary)] text-[var(--primary-fg)] rounded-[var(--radius-card)]
               shadow-[var(--shadow-card)] hover:brightness-110 transition">
  Explorar Siigo Aspel
</button>
```

### 9.6 Edición desde el admin (observación del cliente)
En `/admin/ajustes/marcas` cada marca tiene editor de tokens con preview live. Los tokens se persisten en `brands.theme_json` y se regeneran sin redeploy. El panel admin usa su propia tematización Filament nativa (no afectada).

---

## 10. Módulos funcionales — E-commerce

### 10.1 Flujo de compra (happy path)
1. Usuario navega `/aspel/siigo-aspel-sae` (contexto visual aspel).
2. Elige variante (mensual / anual / perpetua) → click **"Comprar ahora"**.
3. Producto se agrega al **carrito** (Livewire, persistido en `cart` table + cookie para invitados).
4. Usuario entra a `/checkout` — **contexto visual cambia a `logia`** (aquí manda confianza).
5. Si no está autenticado, se le ofrece **checkout como invitado** o **registro**.
6. Captura datos fiscales (RFC, razón social, CP, uso CFDI, régimen fiscal).
7. Elige método de pago: Tarjeta / OXXO Pay / SPEI.
8. `Stripe\PaymentIntent` creado vía Cashier — redirección a Stripe Checkout.
9. Webhook `payment_intent.succeeded` → dispara `Actions\Orders\CompleteOrder`:
   - Marca `orders.status = paid`.
   - Asigna `License` del pool al cliente.
   - Encola `IssueCfdiJob` (PAC externo).
   - Encola `SendOrderConfirmationJob` (Resend).
   - Si el producto incluye capacitación: `Actions\Courses\EnrollStudent`.
10. Usuario ve `/checkout/success/{order}` con: factura PDF, clave de licencia, enlace al aula.

### 10.2 Particularidades México
- **CFDI 4.0** obligatorio — integración con PAC (Facturama / Finkok / SW) vía adapter.
- **OXXO Pay** — el recibo con código de barras va por email. `orders.status = pending_payment` hasta que Stripe notifica. TTL 3 días.
- **SPEI** — Stripe genera CLABE virtual por pago. También `pending_payment` hasta confirmar.
- **Envío de licencias por email** — las llaves se mandan sólo después de confirmar pago (nunca on-intent).

### 10.3 Reglas de precio
- Precio base en `product_variants.price_mxn`.
- Cupones (`coupons`) pueden aplicar:
  - Global / por marca / por producto / por cliente.
  - Percent o fixed.
  - `max_uses` + `max_uses_per_user`.
- IVA 16% calculado en `OrderItem::tax` (ley Mex — ya incluido o desglosado según config de la marca).

### 10.4 Dashboards Filament clave
- **Ventas del día / MTD / YTD** (ChartJS line).
- **Top productos por marca** (bar).
- **Método de pago breakdown** (pie).
- **Licencias en pool vs asignadas** (gauge).
- **Cupones más usados** (table).

---

## 11. Módulos funcionales — E-learning

### 11.1 Estructura pedagógica
```
Course
  └── Module (varios, ordenables)
        └── Lesson (varias, ordenables)
              ├── type: video   (Bunny Stream con DRM)
              ├── type: pdf     (PDF.js embebido)
              ├── type: quiz    (→ Quiz + QuizQuestion)
              ├── type: task    (entrega de archivo, revisa instructor)
              └── type: session (sesión presencial o Teams — agenda via Cal.com)
```

### 11.2 Protección de contenido (DRM)
- **Videos:** Bunny Stream con **MediaCage DRM** (Widevine + FairPlay). El token de reproducción se firma server-side por cada sesión de alumno y expira en 2h.
- **PDFs:** `Spatie/laravel-medialibrary` guarda el archivo en GCS con URL firmada de 5 min. Se visualiza con `PDF.js` embebido y parámetros `disableDownload`, `disablePrint`. La ruta jamás sirve el PDF directo.
- **Screenshot:** no es prevenible 100% en web, pero:
  - Overlay watermark dinámico con email + IP + timestamp del alumno (CSS + Canvas sobre el video).
  - CSS `-webkit-user-select: none`, detección de devtools abiertos (Alpine).
- **Auditoría:** `Spatie/laravel-activitylog` registra cada acceso a lesson, timestamp, duración, completado.

### 11.3 Tipos de certificado (3 plantillas DomPDF)
| Tipo | Plantilla | Trigger |
|------|-----------|---------|
| Asistencia | `cert-asistencia.blade.php` | Alumno completa 100% de lecciones |
| Aprovechamiento | `cert-aprovechamiento.blade.php` | Alumno completa + aprueba quiz final ≥80% |
| Oficial del partner | `cert-oficial-{brand}.blade.php` | Curso es "oficial" y se firma con credencial de Logia ante la marca |

Cada certificado tiene:
- Serial único (`LOG-{brand}-{year}-{####}`).
- Código QR enlazando a `/aula/certificados/{id}/verificar` (ruta pública).
- Firma digital del titular de Logia Consulting.

### 11.4 Sesiones presenciales (WTC / Coapa / Polanco)
- Cada curso puede tener `in_person_sessions` con fecha, sede, cupo.
- Alumno reserva cupo desde el aula → integración con Cal.com para bloquear agenda del instructor.
- Lista de asistencia la pasa el instructor desde el admin Filament.

### 11.5 Dashboard del instructor (`/admin` con rol `instructor`)
Ver sólo sus cursos, entregas por revisar, alumnos activos, NPS de su curso, horas impartidas.

---

## 12. Módulos funcionales — Blog + CMS

### 12.1 Requerimientos
- Editor WYSIWYG estilo Notion (Filament `TiptapEditor` o `MarkdownEditor`).
- Portada con imagen hero, resumen, categorías, tags, autor, fecha.
- SEO por post (`seo_title`, `seo_description`, `og_image`, `canonical`).
- **Indexado por marca**: un post puede estar "taggeado" para una marca y aparecer en su landing (ej. artículos de Aspel en `/aspel`).
- Schema.org `Article` inyectado.
- Newsletter opt-in en footer de post (integra Resend).

### 12.2 Flujo editorial
1. Editor crea post → `status: draft`.
2. Preview en `/blog/{slug}?preview=1` (requiere rol editor+).
3. Programar publicación con `published_at`.
4. Al publicar: `ArticlePublished` event → invalida caché, notifica en Teams (MS Graph webhook).

### 12.3 Rendimiento
- Cada post cacheado 1h con `cache:route`.
- Imágenes servidas vía Cloudflare Image Resizing (variaciones on-the-fly).
- RSS cacheado 10 min.

---

## 13. Módulos funcionales — Soporte técnico y tickets

### 13.1 Canales de entrada
- Portal: `/soporte/tickets/nuevo`.
- Email: `soporte@logiaconsulting.com` → parser Laravel recibe via Resend inbound → crea ticket.
- Chat: widget embebido (Fase 2).

### 13.2 SLA
| Prioridad | Respuesta | Resolución |
|-----------|-----------|------------|
| Crítica | 1h | 4h |
| Alta | 4h | 24h |
| Media | 8h | 72h |
| Baja | 24h | 7d |

El `sla_deadline` se calcula al crear el ticket. Jobs programados (Laravel scheduler) avisan al agente 30 min antes de vencer.

### 13.3 Asignación
- Por defecto, round-robin entre agentes con permiso en la marca del ticket.
- Manualmente reasignable desde Filament.
- Regla: tickets de Aspel prefieren agentes con certificación Aspel vigente.

### 13.4 Base de conocimiento
- Artículos markdown, categorizados por marca.
- Sugerencias contextuales al abrir ticket (el form sugiere artículos relevantes por título).

---

## 14. Módulos funcionales — Panel administrativo (Filament v3)

### 14.1 Resources principales
```
App\Filament\Resources\
├── BrandResource
├── ProductResource
├── CategoryResource
├── CouponResource
├── OrderResource
├── InvoiceResource
├── LicenseResource
├── CourseResource
├── LessonResource
├── QuizResource
├── CertificateTemplateResource
├── EnrollmentResource
├── PostResource
├── PageResource
├── BannerResource
├── TicketResource
├── UserResource
├── RoleResource
├── LeadResource
├── CompanyResource
└── SettingResource
```

### 14.2 Dashboards con Chart.js
- **Overview** — ventas, cursos, tickets, NPS.
- **Ventas** — breakdown por marca, cohort analysis, forecast simple.
- **Cursos** — alumnos activos, completions, NPS por curso, top instructores.
- **Soporte** — tickets abiertos por prioridad, SLA cumplido, CSAT.

### 14.3 Roles Filament y accesos
| Rol | Acceso |
|-----|--------|
| `superadmin` | Todo |
| `admin_marca` | CRUD productos / precios / posts / banners de su marca |
| `editor` | CRUD posts / páginas / banners |
| `instructor` | Cursos propios, lessons, quizzes, enrollments de sus cursos |
| `agente_soporte` | Tickets de su marca asignada, KB |
| `vendedor` | Leads, órdenes, cupones |
| `contador` | Órdenes read-only, facturas, reportes fiscales |

### 14.4 Observación del cliente — banner de publicidad
El admin tiene un resource `BannerResource` donde se configura la imagen, URL destino, fechas de vigencia y segmento de audiencia (anónimo / clientes / alumnos). Sólo se muestra en `/` (home). Ver §17.2.

---

## 15. Seguridad, RBAC y protección de contenido

### 15.1 Autenticación
- **Sanctum** para sesión web + tokens API.
- **2FA TOTP opcional** (Google2FA QRCode — ya está en `vendor/` del proyecto).
- **Rate limiting** en login (5 intentos / 15 min / IP).
- Password policy: mínimo 10 caracteres, no común, contador zxcvbn en registro.

### 15.2 RBAC con Spatie
- Permissions por módulo (`catalog.products.update`, `learning.lessons.create`, etc.) — granular.
- Roles compuestos por permissions — se administran en Filament.
- Gate check en cada Action y Policy — nunca confiar en UI.

### 15.3 Protección de contenido educativo
Detallado en §11.2. Claves:
- URLs firmadas de corta duración (5 min).
- Token DRM por sesión.
- Watermark dinámico.
- Activity log por cada lesson view.

### 15.4 Seguridad de infraestructura
- **Cloudflare WAF** activo con reglas OWASP.
- **SSL Full Strict** forzado.
- **HSTS** con `max-age=31536000; includeSubDomains; preload`.
- **Security headers:** CSP, X-Frame-Options (DENY), X-Content-Type-Options, Referrer-Policy, Permissions-Policy.
- **Secrets** en Railway env + Vault (no en repo).
- **Backups** cifrados a GCS con retención 30 días.

### 15.5 Privacidad y cumplimiento
- Aviso de privacidad conforme a la **LFPDPPP (Mex)**.
- Banner de cookies con categorías (necesarias / analítica / marketing) — `analytics` y `marketing` opt-in explícito.
- Derechos ARCO: formulario en `/legal/aviso-de-privacidad` que genera ticket interno.
- Logs limpios de PII donde no es necesario.

### 15.6 Matriz de roles × acceso (resumen)
| Recurso | guest | cliente | alumno | agente | instructor | editor | admin_marca | superadmin |
|---------|:-----:|:-------:|:------:|:------:|:----------:|:------:|:-----------:|:----------:|
| Catálogo público | R | R | R | R | R | R | R | R |
| Checkout | — | W | W | — | — | — | — | W |
| Licencias propias | — | R | R | — | — | — | — | RW |
| Aula (cursos propios) | — | — | R | — | — | — | — | RW |
| Aula (cualquier curso) | — | — | — | — | RW¹ | — | — | RW |
| Tickets propios | — | RW | RW | RW² | RW² | — | — | RW |
| Admin CMS (blog) | — | — | — | — | — | RW | RW³ | RW |
| Admin catálogo | — | — | — | — | — | — | RW³ | RW |
| Admin usuarios | — | — | — | — | — | — | — | RW |

¹ sólo sus cursos   ² tickets asignados o de su marca   ³ sólo de su marca

---

## 16. Integraciones externas

### 16.1 Stripe México
- Cashier 15.x.
- Productos sincronizados: *no*. Creamos `PaymentIntent` dinámico por orden (permite cupones y variantes complejas).
- Webhooks escuchados: `payment_intent.succeeded`, `payment_intent.payment_failed`, `charge.refunded`, `checkout.session.expired` (OXXO TTL).
- Moneda: MXN.
- Compliance: PCI DSS SAQ-A (Stripe-hosted form — no tocamos tarjeta).

### 16.2 Bunny.net (Stream + MediaCage DRM + Storage)
- Adapter `BunnyService` con métodos: `uploadVideo`, `signPlaybackToken`, `listLibrary`, `getAnalytics`.
- Library dedicada por marca (tenant).
- CDN edge rules: geo-block fuera de LATAM opcional.
- Fallback automático a H.264/HLS si navegador no soporta DRM.

### 16.3 Cal.com (Docker en Railway)
- Self-hosted con Postgres dedicado.
- Embedido en `/contacto/agendar-cita` y `/aula/calendario`.
- Webhooks → crea `Appointment` en BD local + sync a MS Graph (Teams meeting).

### 16.4 MS Graph API (Microsoft 365)
- App registration con permisos: `OnlineMeetings.ReadWrite.All`, `Calendars.ReadWrite.Shared`.
- Client credentials flow — flujo app-only.
- Usos:
  - Crear Teams meetings para capacitación y demos.
  - Webhooks de M365 Copilot (Fase 3 — opcional).
  - Sync calendarios de consultores.

### 16.5 Resend.com Pro
- Dominio `logiaconsulting.com` con SPF, DKIM, DMARC.
- Plantillas React Email → compiladas a MJML → servidas por Laravel mailable.
- Inbound parsing: `soporte@` → webhook crea ticket.

### 16.6 n8n + Apify + Gemini (Fase 3)
- **n8n** con workflows disparables por cron o webhook.
- Flujo típico: "Campaña Meta Ads":
  1. Apify scraping de audiencia relevante.
  2. Gemini genera copy (3 variantes A/B/C).
  3. n8n publica en Meta Ads API con presupuesto configurado.
  4. Tracking de conversiones vuelve al admin via webhook.

### 16.7 PAC para CFDI 4.0 (pendiente de elegir)
Candidatos: Facturama, Finkok, SW Sapien. Decisión en ADR-006.

---

## 17. Observaciones del cliente (imágenes anotadas) atendidas

Esta sección mapea cada observación del PNG a un spec técnico listo para dev.

### 17.1 OBS-01 — Mega-menú de "Productos" (crítica)
**Anotación cliente:** *"Cuando se haga hover en la etiqueta o se clickee se debe desplegar un rectángulo con todas las secciones disponibles de Logia Consulting, y todos los productos de Siigo Aspel, SoftRestaurant, Zoho One y Microsoft 365."*

**Spec de implementación:**
- Componente Livewire `<x-mega-menu>` o Alpine puro (preferido por performance).
- Disparo: `mouseenter` del botón "Productos" (con delay de 150ms para evitar flickering) + `click` para touch.
- Cierre: `mouseleave` del rectángulo (delay 300ms) + click fuera + `Esc`.
- Layout: full-width, pegado debajo del header, `max-w-screen-xl` centrado.
- Estructura:
  ```
  ┌──────────────────────────────────────────────────────────────────┐
  │ Logia Consulting        │ Siigo Aspel │ Soft Restaurant │ Zoho One │ MS 365 │
  │ - Implementación        │ - Siigo Nube│ - POS           │ - CRM    │ - B.B. │
  │ - Soporte remoto        │ - SAE       │ - Cocina        │ - Books  │ - B.S. │
  │ - Soporte presencial    │ - NOI       │ - Inventarios   │ - People │ - B.P. │
  │ - Consultoría           │ - COI       │ - Reportes F&B  │ - ...    │ - Cop. │
  │ - Migración             │ - FACTURE   │ - Franquicias   │          │        │
  │                         │ - ...       │                 │          │        │
  └──────────────────────────────────────────────────────────────────┘
  ```
- Cada item: `<a>` con `title` rendereando nombre completo y `description` breve.
- Accesibilidad: `role="menu"`, navegación con flechas, `aria-expanded` correcto, focus trap.
- Performance: renderizado server-side una vez, cacheado 1h.
- Responsive: en móvil se transforma en acordeón.

### 17.2 OBS-02 — Banner de publicidad editable (crítica)
**Anotación cliente:** *"Este banner de publicidad solo va en la home page y es editable desde la pantalla de administrador."*

**Spec de implementación:**
- Componente `<x-home-banner>` que sólo se incluye en `resources/views/pages/home.blade.php`.
- Carga el registro activo de `BannerResource` con scope `position=home-top` y `now between starts_at and ends_at`.
- Dimensiones recomendadas: 1440 × 120 px (ratio 12:1).
- Campos editables desde `/admin/banners`:
  - `image_path` (upload via Spatie medialibrary).
  - `image_path_mobile` (opcional).
  - `link_url`, `link_target` (_self / _blank), `link_rel`.
  - `alt_text`.
  - `starts_at`, `ends_at`.
  - `audience` (all / anonymous / clients / students).
  - `active` (toggle).
  - `background_color` (opcional) — para que no haya banda blanca.
- Admin permite **preview en vivo** sobre `/` con un token temporal.
- Analítica: cada click se loguea en `banner_clicks` (banner_id, user_id, timestamp).

### 17.3 OBS-03 — Tarjeta 3D del producto
**Anotación cliente:** *"Tarjeta 3D del producto — ya sea Siigo Aspel, Soft Restaurant, Zoho One, Microsoft 365."*

**Spec de implementación:**
- Componente `<x-product-3d-card brand="...">` con efecto parallax/tilt en CSS 3D puro (no Three.js — overkill para una tarjeta).
- Librería sugerida: **Atropos.js** o implementación manual con Alpine (~60 líneas). Atropos pesa ~7KB gzip.
- Comportamiento: sigue el cursor con `perspective()` + `rotateX()` + `rotateY()`, máximo 12° de tilt.
- Capas internas: logo de la marca (flotante), título, bullets de features — cada una con `translateZ` distinto para dar profundidad.
- Contenido dinámico según `brand.slug`:
  - `aspel` → mockup de Siigo Nube.
  - `softrestaurant` → mockup del POS táctil.
  - `zoho` → grid de íconos de apps.
  - `microsoft` → mockup Fluent de Copilot.
- Usa tokens `var(--primary)` + `var(--shadow-card)` para que se adapte al contexto.
- Fallback sin JS: tarjeta estática pero estéticamente completa.
- Accesibilidad: `prefers-reduced-motion: reduce` desactiva el tilt.

### 17.4 OBS-04 — Tarjetas flotantes con magnetismo por cursor
**Anotación cliente:** *"Estas tarjetas flotantes deben ser influenciadas como efecto 'magnetismo por cursor' cuando pase se tiene que direccionar un poco por el mouse. Al clickearlas deben redireccionar a alguna solución dentro del producto que se muestra en el carrusel."*

**Spec de implementación:**
- Componente `<x-magnetic-chip>` con Alpine + `matter-js` no — sólo matemática simple:
  ```js
  // Alpine data
  magnetic: {
    dx: 0, dy: 0,
    onMove(e) {
      const r = this.$el.getBoundingClientRect();
      const cx = r.left + r.width/2;
      const cy = r.top + r.height/2;
      this.dx = (e.clientX - cx) * 0.18;   // factor de atracción
      this.dy = (e.clientY - cy) * 0.18;
    },
    onLeave() { this.dx = 0; this.dy = 0; }
  }
  ```
  El chip usa `transform: translate(${dx}px, ${dy}px)` con `transition: transform 200ms cubic-bezier(0.2,0.8,0.2,1)`.
- Ancla: el contenedor del hero (sólo ahí se activa el listener `mousemove`).
- Click: cada chip tiene `link_url` apuntando a la ruta del producto/solución (configurado en `BrandResource.floating_chips_json` en admin).
- Ejemplos para Soft Restaurant (como en la imagen): `Control de cocina` → `/soft-restaurant/control-de-cocina`; `POS Táctil` → `/soft-restaurant/punto-de-venta`; `Inventarios` → `/soft-restaurant/inventarios`; `Reportes F&B` → `/soft-restaurant/reportes-fb`.
- Cambian cuando el usuario avanza el carrusel de marcas en el hero.
- Accesibilidad: `prefers-reduced-motion` desactiva el magnetismo; siempre son `<a>` clickeables con keyboard.

### 17.5 OBS-05 — Ampliar imagen de Logia Consulting
**Anotación cliente:** *"Ampliar imagen de Logia Consulting"* (sobre el logo del header).

**Spec de implementación:**
- El logo en el header pasa de ~28px de alto a **~44–48px** (escala 1.6×) para mayor presencia.
- Se usa el SVG nativo provisto en MICLOGIA.pdf (archivo a confirmar).
- Se mantiene relación de aspecto.
- En scroll condensado (sticky), el logo se reduce a 36px con transición suave.

### 17.6 OBS-06 — Carrusel del hero con cambio de marca
**Anotación cliente (implícita):** el hero muestra un carrusel rotando entre las marcas (la PNG muestra Soft Restaurant activo con "Tu restaurante, siempre en control").

**Spec de implementación:**
- Slide por marca: {logo chip, H1, subtitle, CTA principal, CTA secundario, mock 3D card, floating chips}.
- Auto-avance 8s, pausa al hover.
- Dots inferiores clickeables.
- Cambio dispara: actualización del contexto visual del hero (pero NO de la página completa — la página sigue siendo `/` con contexto `logia`). El hero tiene su propia "cápsula visual" con `data-hero-brand="softrestaurant"`.
- Los chips magnéticos de §17.4 cambian con el slide.

---

## 18. Architecture Decision Records (ADRs)

Registros cortos de las decisiones no triviales. Cada ADR tiene: contexto, decisión, alternativas consideradas, consecuencias.

### ADR-001 — Multi-tematización vía CSS Variables + Blade layouts (no React)
- **Contexto:** el cliente requiere que la UI se sienta como extensión de cada marca (§2).
- **Decisión:** usar CSS Custom Properties inyectadas por middleware según el primer segmento de la URL, con Blade layouts tematizables. No React, no Vue, no Nuxt.
- **Alternativas:** (a) Next.js con tokens en `globals.css` y ThemeProvider — descartada: el stack del cliente es 100% Laravel; (b) Tailwind multi-theme con `class=""` — descartada por legibilidad y por no permitir edición de tokens desde admin sin rebuild.
- **Consecuencias +:** edición de tokens desde admin sin redeploy, performance óptima (SSR puro), simplicidad del stack.
- **Consecuencias −:** animaciones/transiciones entre temas son "hard switches" (aceptable porque cambia por navegación de página).

### ADR-002 — Bunny MediaCage DRM vs Widevine directo (PENDIENTE)
- **Contexto:** se requiere DRM para videos.
- **Opciones:** (a) **Bunny MediaCage** (Widevine + FairPlay gestionado por Bunny); (b) Widevine directo con tokens firmados por nosotros.
- **Trade-off:** Bunny MediaCage es más costoso por stream pero cero operación; Widevine directo requiere licencia con Google y mantener servidor de licencias.
- **Recomendación:** **Bunny MediaCage** en Fase 1 — baja complejidad operativa y time-to-market. Reevaluar en Fase 3 cuando el volumen justifique economía propia.

### ADR-003 — LMS propio sobre Filament vs tercero (Moodle / LearnWorlds)
- **Contexto:** el cliente tiene requisitos específicos (certificados con branding logia, licencias + cursos en mismo checkout, integración tickets + cursos).
- **Decisión:** **LMS propio sobre Filament** — más trabajo inicial pero integración perfecta con e-commerce y soporte.
- **Alternativas:** Moodle (pesado, PHP viejo, UI anticuada), LearnWorlds/Teachable (SaaS, no integra checkout de licencias, mensual alto).
- **Consecuencias +:** coherencia total, UX unificado, sin costo recurrente de SaaS.
- **Consecuencias −:** más desarrollo en Fase 1 — ~6 semanas extra para LMS mínimo viable.

### ADR-004 — Cal.com self-hosted vs Calendly SaaS
- **Contexto:** agendado de citas de capacitación, demo, soporte presencial.
- **Decisión:** **Cal.com self-hosted en Docker en Railway** — gratuito, open source, integra con MS Graph sin pagar plan empresarial.
- **Alternativas:** Calendly ($10/mes/usuario + $15 para Teams integration), Acuity, Microsoft Bookings (requiere licencia M365 en cada consultor).
- **Consecuencias +:** costo cero, integración nativa con MS Graph y webhooks.
- **Consecuencias −:** hay que mantener el contenedor y su Postgres — mitigable con backups Spatie.

### ADR-005 — Monolito Laravel vs microservicios
- **Contexto:** el stack anuncia una aplicación con muchos módulos (commerce, learning, support, marketing).
- **Decisión:** **monolito modular** — carpetas de dominio dentro del mismo proyecto, BD única, deploy único.
- **Alternativas:** microservicios (commerce, learning, support separados) — rechazado por overhead operativo injustificado al tamaño del proyecto.
- **Consecuencias +:** deploy simple, transacciones cruzadas fáciles, costo bajo.
- **Consecuencias −:** al escalar mucho habrá que extraer módulos — aceptable, Laravel lo permite.

### ADR-006 — PAC para CFDI 4.0 (PENDIENTE)
- **Opciones:** Facturama, Finkok, SW Sapien.
- **Criterios:** costo por timbre, uptime, soporte México, API limpia.
- **Recomendación preliminar:** **Facturama** por API moderna y docs claros. Negociar paquete de ~5,000 timbres/mes.

### ADR-007 — Editor de contenido (posts y páginas)
- **Decisión:** usar el **`FilamentTiptapEditor`** como block editor con bloques custom (hero, CTA, columna, quote, embed). Fallback markdown para usuarios power.

### ADR-008 — Búsqueda global
- **Decisión:** **Laravel Scout + Meilisearch** (self-hosted en Railway) para Fase 2. En Fase 1 basta con `LIKE %q%` indexado.

---

## 19. Deployment, CI/CD y observabilidad

### 19.1 Entornos
| Entorno | URL | BD | Notas |
|---------|-----|----|----|
| local | `logia.test` (Laragon) | MySQL local | para dev |
| staging | `staging.logiaconsulting.com` | Railway staging | deploy en cada push a `develop` |
| production | `logiaconsulting.com` | Railway prod | deploy en push a `main` con aprobación manual |

### 19.2 Pipeline de CI/CD (GitHub Actions)
```yaml
# .github/workflows/ci.yml (resumen)
on: [push, pull_request]
jobs:
  test:
    - composer install
    - npm ci && npm run build
    - php artisan test --coverage --min=70
    - php artisan pint --test
    - npx eslint .
  deploy-staging:
    needs: test
    if: github.ref == 'refs/heads/develop'
    - railway up --service logia-staging
  deploy-prod:
    needs: test
    if: github.ref == 'refs/heads/main'
    environment: production   # requiere aprobación
    - railway up --service logia-prod
    - artisan migrate --force
    - artisan queue:restart
```

### 19.3 Observabilidad
- **UptimeRobot**: probe HTTP cada 60s a `/healthz`, `/admin/login`, `/aula`. Alertas a Teams y SMS.
- **Laravel Telescope** — sólo en staging.
- **Logs estructurados** → Railway.
- **Errores** → Sentry (opcional — ADR-009).
- **Métricas de negocio** → dashboard Filament (ventas, nps, sla cumplimiento).

### 19.4 Backups y DR
- `spatie/laravel-backup` cron diario 02:00 AM CDMX → GCS bucket `logia-backups/prod/`.
- Retención: 30 días rolling + snapshot mensual durante 12 meses.
- Runbook de restore documentado en `/docs/runbooks/restore.md`.
- Objetivo **RPO = 24h / RTO = 4h**.

---

## 20. Roadmap por fases

### Fase 1 — MVP vendible (semanas 1–10)
- Infra, CI/CD, staging y prod operativos.
- Identidad Logia consolidada + tematización 4 marcas.
- Sitio público: home, landings de marcas, catálogo de productos, blog, nosotros, contacto.
- E-commerce: carrito, checkout, Stripe MX, CFDI 4.0 (Facturama), pool de licencias.
- Dashboard cliente: licencias, pedidos, facturas.
- Admin Filament: catálogo, pedidos, banners, usuarios, roles, posts.
- Observaciones del cliente atendidas (§17).

### Fase 2 — E-learning y soporte (semanas 11–20)
- Cursos, módulos, lecciones con Bunny Stream + DRM.
- Reproductor con watermark y activity log.
- Quizzes, tareas, certificados DomPDF.
- Sesiones presenciales + Cal.com + MS Graph.
- Portal de soporte con tickets, SLA, KB.
- CRM ligero: leads, empresas, oportunidades.
- Búsqueda global con Meilisearch.

### Fase 3 — Automatización y escala (semanas 21–28)
- n8n self-hosted con workflows Meta Ads.
- Integración Apify + Gemini.
- Webhooks MS 365 Copilot (opcional).
- Dashboards de atribución UTM completos.
- Mobile app embrión (Sanctum API ya expuesta).

---

## 21. Apéndice A — tokens de tematización por marca

### A.1 Logia Consulting (oficial — MICLOGIA.pdf)
| Token | Valor | Pantone | Notas |
|-------|-------|---------|-------|
| `--primary` | `#FF6B00` | 1505 C | Naranja dominante, swoosh + "I" del logo |
| `--accent` | `#0071CE` | 285 C | Azul "CONSULTING" |
| `--brand-gray` | `#717271` | 424 C | Gris "LOGIA" |
| `--brand-gray-light` | `#DBD9D6` | Cool Gray 1 C | Gris estructural |
| `--bg` | `#FAFAFA` | — | Fondo neutro |
| `--border` | `#DBD9D6` | Cool Gray 1 C | Borde default |
| `--text` | `#2A2A2A` | — | Body (AA sobre blanco, 14.7:1) |
| `--text-muted` | `#717271` | 424 C | Secundario |
| `--font-display` | Helvetica Neue | — | Tipografía oficial secundaria del manual |
| `--font-body` | Helvetica | — | Tipografía oficial primaria del manual |
| `--radius-card` | 12px | — | — |

### A.2 Siigo Aspel (paleta oficial — cliente 21-abr-2026)
| Token | Valor | Fuente oficial |
|-------|-------|----------------|
| `--primary` | `#009DFF` | Azul brillante oficial Siigo Aspel |
| `--accent` | `#3B4758` | Gris azulado oficial |
| `--border` | `#AAB0B8` | Gris claro oficial |
| `--bg` | `#F5F8FC` | Derivado (blanco con tinte azul) |
| `--text` | `#1A2230` | Derivado del accent para AAA body |
| `--text-muted` | `#3B4758` | Oficial |
| `--font-display` | Gotham / Montserrat | Observado en el site |
| `--radius-card` | 10px | — |

> ⚠ WCAG: `#009DFF` sobre blanco ≈3.0:1 — falla AA body. No usar para párrafos; sólo CTAs large-bold e iconos.

### A.3 Soft Restaurant (paleta oficial — cliente 21-abr-2026)
| Token | Valor | Fuente oficial |
|-------|-------|----------------|
| `--primary` | `#E25724` | Naranja cobre oscuro oficial |
| `--primary-alt` | `#E7803C` | Naranja claro oficial (decoración secundaria) |
| `--accent` | `#584569` | Púrpura distintivo oficial |
| `--bg` | `#FFF7F1` | Blanco cálido derivado |
| `--text` | `#3C3B44` | Charcoal oficial |
| `--text-muted` | `#6B6773` | Derivado |
| `--font-display` | Inter / Manrope | — |
| `--radius-card` | 14px | Estilo más "suave" |

> ⚠ WCAG: `#E25724` sobre blanco ≈4.2:1, borderline AA. Exigir `font-weight ≥ 500` en texto sobre primary.

### A.4 Zoho One (paleta oficial — los 4 chips del logo, cliente 21-abr-2026)
| Token | Valor | Fuente oficial |
|-------|-------|----------------|
| `--primary` / `--danger` | `#E42527` | Chip rojo del logo Zoho |
| `--accent` / `--info` | `#226DB4` | Chip azul del logo Zoho |
| `--success` | `#089949` | Chip verde del logo Zoho |
| `--warning` | `#F9B21D` | Chip amarillo del logo Zoho |
| `--bg` | `#F8F8F6` | — |
| `--font-display` | Puvi / Lato | Familia oficial de Zoho |
| `--radius-card` | 6px | Estilo más denso |

> Los 4 chips del logo Zoho se mapean directo a los 4 semánticos del sistema — mapeo más limpio de las 5 marcas.

### A.5 Microsoft 365 (paleta oficial — cuadrado Microsoft + navy, cliente 21-abr-2026)
| Token | Valor | Fuente oficial |
|-------|-------|----------------|
| `--primary` / `--info` | `#05A6F0` | Azul Outlook (chip del cuadrado Microsoft) |
| `--accent` / `--danger` | `#F35325` | Naranja PowerPoint (chip) |
| `--success` | `#81BC06` | Verde Excel (chip) |
| `--warning` | `#FFBA08` | Amarillo Office (chip) |
| `--text` | `#081C28` | Navy oficial — AAA body (16.8:1) |
| `--text-muted` | `#4A5766` | Derivado |
| `--bg` | `#FAFAFA` | — |
| `--font-display` | Segoe UI Variable | Oficial Microsoft |
| `--radius-card` | 4px | Fluent 2 baja el radio |

> ⚠ WCAG: `#05A6F0` sobre blanco ≈2.8:1 — falla AA. Sólo CTAs large-bold; texto usa `#081C28`.

### A.6 Paleta Zoho multi-color (íconos del mega-menú)
Los 4 chips del logo Zoho sirven también como paleta multi-color para íconos de módulos:
- Rojo: `#E42527`
- Verde: `#089949`
- Azul: `#226DB4`
- Amarillo: `#F9B21D`

### A.7 Paleta Microsoft 365 multi-color (íconos de apps del mega-menú)
Los 4 chips del cuadrado Microsoft mapean a los 4 productos estrella:
- Azul Outlook: `#05A6F0`
- Verde Excel: `#81BC06`
- Naranja PowerPoint: `#F35325`
- Amarillo Office (Word highlight): `#FFBA08`
- Navy texto: `#081C28`

---

## 22. Apéndice B — inventario plano de rutas

```
# Sitio público
GET  /
GET  /nosotros
GET  /nosotros/historia
GET  /nosotros/equipo
GET  /nosotros/certificaciones
GET  /nosotros/oficinas
GET  /productos
GET  /aspel
GET  /aspel/{producto}
GET  /soft-restaurant
GET  /soft-restaurant/{producto}
GET  /zoho
GET  /zoho/{producto}
GET  /microsoft-365
GET  /microsoft-365/{producto}
GET  /capacitacion
GET  /capacitacion/{marca}
GET  /capacitacion/curso/{slug}
GET  /capacitacion/calendario
GET  /capacitacion/certificaciones-oficiales
GET  /servicios
GET  /servicios/{servicio}
GET  /blog
GET  /blog/categoria/{slug}
GET  /blog/tag/{slug}
GET  /blog/autor/{slug}
GET  /blog/{year}/{month}/{slug}
GET  /contacto
GET  /contacto/{tipo}
GET  /legal/{doc}

# E-commerce público
GET  /buscar
GET  /carrito
POST /carrito/agregar
PUT  /carrito/item/{id}
DEL  /carrito/item/{id}
GET  /checkout
POST /checkout/submit
GET  /checkout/success/{order}
GET  /checkout/cancelled/{order}

# Auth
GET  /iniciar-sesion
POST /iniciar-sesion
GET  /registrarse
POST /registrarse
POST /cerrar-sesion
GET  /recuperar-clave
POST /recuperar-clave/enviar
GET  /restablecer-clave/{token}
POST /restablecer-clave
GET  /verificar-email/{token}

# Dashboard cliente
GET  /mi-cuenta/resumen
GET  /mi-cuenta/licencias
GET  /mi-cuenta/licencias/{id}
GET  /mi-cuenta/pedidos
GET  /mi-cuenta/pedidos/{id}
GET  /mi-cuenta/pedidos/{id}/factura.pdf
GET  /mi-cuenta/facturacion
GET  /mi-cuenta/metodos-de-pago
GET  /mi-cuenta/direcciones
GET  /mi-cuenta/perfil

# Aula
GET  /aula
GET  /aula/mis-cursos
GET  /aula/curso/{slug}
GET  /aula/curso/{slug}/modulo/{n}
GET  /aula/curso/{slug}/lesson/{id}
POST /aula/curso/{slug}/lesson/{id}/progress
GET  /aula/curso/{slug}/quiz/{id}
POST /aula/curso/{slug}/quiz/{id}/submit
GET  /aula/curso/{slug}/tareas
POST /aula/curso/{slug}/tareas/{id}/entregar
GET  /aula/curso/{slug}/foro
GET  /aula/certificados
GET  /aula/certificados/{id}/descargar.pdf
GET  /aula/certificados/{id}/verificar    (pública — sólo GET)
GET  /aula/calendario
GET  /aula/soporte

# Soporte
GET  /soporte/tickets
GET  /soporte/tickets/nuevo
POST /soporte/tickets
GET  /soporte/tickets/{id}
POST /soporte/tickets/{id}/responder
GET  /soporte/base-de-conocimiento
GET  /soporte/kb/{categoria}/{slug}
GET  /soporte/agendar-sesion

# Admin Filament (/admin/*)
# ... todos los resources listados en §5.4 + §14.1

# Webhooks (POST only)
POST /webhooks/stripe
POST /webhooks/bunny
POST /webhooks/calcom
POST /webhooks/msgraph
POST /webhooks/resend/inbound

# API v1 (Sanctum)
GET  /api/v1/me
GET  /api/v1/my-courses
GET  /api/v1/my-licenses
GET  /api/v1/lessons/{id}/playback-token   (DRM-signed)

# Utilidades
GET  /healthz
GET  /sitemap.xml
GET  /feed.xml
GET  /robots.txt
```

---

## 23. Apéndice C — riesgos abiertos y preguntas para el cliente

| # | Riesgo / pregunta | A quién toca resolver | Prioridad |
|---|-------------------|-----------------------|-----------|
| R-01 | Confirmar paleta y tipografía exactas de Logia Consulting desde MICLOGIA.pdf (tokens de §A.1 son provisionales) | Cliente | Alta |
| R-02 | Decidir PAC para CFDI 4.0 (Facturama recomendado) — ADR-006 | Logia + dev | Alta |
| R-03 | Definir proveedor de DRM: Bunny MediaCage vs Widevine directo — ADR-002 | Dev | Media |
| R-04 | Confirmar lista exacta de productos de Zoho One y Microsoft 365 que Logia resellea | Cliente | Alta |
| R-05 | Validar si se requiere integración con ERP interno de Logia para sincronizar ventas | Cliente | Media |
| R-06 | Política de devoluciones y refunds (días, condiciones por marca) | Cliente legal | Alta |
| R-07 | Derechos de uso de logos y assets de los partners (permisos comerciales) | Cliente legal | Alta |
| R-08 | Alta de dominios SPF/DKIM/DMARC para Resend | Dev | Media |
| R-09 | Capacidad de Railway para el volumen esperado (estimación de tráfico) | Dev | Media |
| R-10 | Definir SLA externo con cliente final (contractual) para soporte | Cliente comercial | Alta |
| R-11 | Integración con Facebook/Meta Business Manager (necesita tokens y BM access) — Fase 3 | Cliente marketing | Baja (Fase 3) |
| R-12 | Plan de migración de contenido existente de logiaconsulting.com (URLs legacy + redirects 301) | Dev + cliente | Alta |

---

## Cierre

Este documento es la **referencia canónica** del sitemap y la arquitectura para la web de Logia Consulting. Todo cambio de alcance debe reflejarse aquí con número de revisión. Entregables siguientes:

1. **Design System multi-marca (documento hermano)** — detalle de componentes: Button, Card, Hero, Nav, Footer, Form Controls, Empty States, etc., con todas las variantes por marca.
2. **Wireframes de baja fidelidad** — home, landing de producto, curso, checkout, mi cuenta.
3. **Prototipo de mega-menú y tarjeta 3D** — en HTML estático listo para validar con cliente antes de implementar.

---

*Fin del documento. Versión 1.0 — 21 / Abril / 2026.*





