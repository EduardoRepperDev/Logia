# Sprint Backlog — Logia Consulting
> Fuente de verdad de tareas sprint a sprint. Actualizar al completar cada ítem.
> Claude audita · Antigravity genera · Oscar revisa y aprueba

---

## ESTADO ACTUAL DEL PROYECTO
**Fecha:** 2026-04-06 · **Sprint activo:** S1 · **Rama activa:** main ⚠️ (ver nota Git)

### Resumen ejecutivo de avance S1

| Área | Estado |
|------|--------|
| Base scaffold (Enums, User, RoleSeeder, Cashier migration) | ✅ Completo |
| Design System CSS (3 temas, tokens, componentes) | ✅ Completo |
| Layout principal + partials header/footer | ✅ Completo |
| Homepage premium (5 secciones + Schema.org) | ✅ Completo |
| HomeController + routes named | ✅ Completo |
| `npm run build` sin errores | ✅ Completo |
| `php artisan migrate --seed` sin errores | ✅ Completo |
| Auditoría seguridad S1 (Alpine, MustVerifyEmail, Twitter Cards) | ✅ Fixes aplicados |
| robots.txt con reglas correctas | ❌ Pendiente |
| Assets públicos (logo, og-image placeholder) | ❌ Pendiente |
| .env configuración completa local | ⚠️ Parcial |
| Deploy a Railway staging | ❌ Pendiente |
| Validación visual del cliente | ❌ Pendiente (requiere staging) |
| Rama Git correcta (no commitear en main) | ⚠️ Nota pendiente |

**Criterio de cierre S1:** deploy staging funcional + validación visual del cliente ✅

---

## S1 — TAREAS PENDIENTES
> Sprint: Apr 1–14, 2026 · Entregable: Design System + Homepage + Staging deploy

### TAREA S1-T1 — robots.txt correcto
**Responsable:** Claude (fix directo)
**Archivo:** `public/robots.txt`

El actual tiene `Disallow:` vacío (permite todo). Necesita bloquear /admin y /webhooks.

```txt
User-agent: *
Disallow: /admin
Disallow: /admin/*
Disallow: /webhooks/
Disallow: /webhooks/*

Sitemap: https://logiaconsulting.com/sitemap.xml
```

**Criterio:** /admin no indexado · sitemap apunta a dominio correcto

---

### TAREA S1-T2 — Assets públicos placeholder
**Responsable:** Oscar (colocar archivos) o Antigravity
**Directorio:** `public/images/`

Crear directorio y agregar:
- `public/images/logo.png` — logo real o placeholder 200x50px hasta recibir del cliente
- `public/images/og-default.jpg` — imagen OG 1200x630px (usada en todas las páginas sin OG propio)
- `public/images/favicon.ico` → ya existe en `/public/favicon.ico`, verificar es el correcto

El código ya referencia estas rutas en `layouts/app.blade.php` y `pages/home.blade.php`.
Sin estos archivos → error 404 en imágenes y OG sin imagen.

---

### TAREA S1-T3 — .env local completo
**Responsable:** Oscar
**Archivo:** `.env` (nunca commitear)

Valores a actualizar/confirmar para desarrollo local:

```env
APP_NAME="Logia Consulting"          # ✅ ya aplicado
APP_TIMEZONE=America/Mexico_City     # ❌ falta — actualmente UTC
APP_LOCALE=es                        # ❌ falta — actualmente 'en'
APP_FALLBACK_LOCALE=es               # ❌ falta
APP_FAKER_LOCALE=es_MX               # ❌ falta
APP_URL=http://logia-consulting.test  # ✅ ya aplicado
```

Estos NO cambian la funcionalidad del S1 pero el timezone correcto afecta logs,
timestamps de actividad y matrículas generadas con fecha.

---

### TAREA S1-T4 — Deploy a Railway Staging
**Responsable:** Oscar (accesos Railway) + Antigravity (Dockerfile/config si es necesario)

**Pasos:**
1. Crear proyecto en Railway Pro
2. Agregar MySQL 8 plugin en Railway
3. Conectar repositorio GitHub → auto-deploy en push a `main`
4. Configurar variables de entorno en Railway (ver lista en Contexto_Proyecto.md §Variables)
5. Verificar que `php artisan migrate --seed` corra en Railway en el primer deploy
6. Confirmar URL pública de staging (Railway genera una del tipo `*.up.railway.app`)
7. Verificar que los 3 temas CSS y la homepage cargan correctamente

**Prerequisito:** tener cuenta Railway Pro activa y repositorio en GitHub.

**Variables mínimas para staging funcional:**
```env
APP_ENV=staging
APP_DEBUG=false           # NUNCA true en staging
APP_KEY=                  # php artisan key:generate
APP_URL=https://*.up.railway.app
DB_CONNECTION=mysql
DB_HOST=                  # Railway provee
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=              # Railway provee
DB_PASSWORD=              # Railway provee
```

---

### TAREA S1-T5 — Crear rama Git correcta
**Responsable:** Oscar
**Nota:** Todo el trabajo S1 está en `main` directamente (inconsistente con el manual).

Para los siguientes sprints usar el flujo correcto desde el inicio:
```bash
git checkout -b feature/s2-catalogo-siigo
# desarrollar...
# PR → main
```

Para S1 (ya en main): crear el tag de cierre cuando el cliente valide.
```bash
git tag -a v0.1.0-s1-complete -m "Sprint 1: Design System + Homepage"
git push origin v0.1.0-s1-complete
```

---

### TAREA S1-T6 — Validación visual del cliente
**Responsable:** Oscar (agenda reunión/envía video)

Con staging arriba, el cliente debe aprobar:
- [ ] Homepage: hero, 3 secciones de producto con colores correctos
- [ ] Los 3 colores de tema visibles (azul Siigo, naranja Soft, rojo Zoho)
- [ ] Navbar responsive (probar en móvil)
- [ ] Footer con links y copyright
- [ ] Performance básico (no Lighthouse formal, eso es S6)

**Pendiente del cliente:**
- Teléfono real → actualizar footer y JSON-LD Schema.org
- Email real → actualizar footer (`hola@logiaconsulting.com` puede ser correcto, confirmar)
- URLs reales de RRSS (Facebook, LinkedIn, Instagram)
- Logo vectorial/PNG real para `public/images/logo.png`

---

## S1 — CRITERIOS DE ACEPTACIÓN (checklist de cierre)

```
☐ php artisan migrate --seed — sin errores            ✅ HECHO
☐ 3 temas CSS: cambiar clase en body aplica tema      ✅ HECHO
☐ Homepage renderiza con 3 colores de producto        ✅ HECHO (verificar en navegador)
☐ Navbar responsive — menú mobile funciona            ✅ HECHO (Alpine via Livewire)
☐ Schema.org Organization válido                      ⬜ Test con Google Rich Results post-staging
☐ Twitter Cards correctas                             ✅ HECHO
☐ npm run build sin errores                           ✅ HECHO
☐ robots.txt con /admin bloqueado                     ❌ S1-T1
☐ Assets logo + og-image existen                      ❌ S1-T2
☐ Deploy Railway staging funcional                    ❌ S1-T4
☐ Cliente valida diseño visualmente                   ❌ S1-T6
```

---

## INFORMACIÓN PENDIENTE DEL CLIENTE (bloquea S2+)

| Item | Bloquea | Estado |
|------|---------|--------|
| Logo vectorial (.ai/.svg/.png) | S1-T2, S2 | ❌ No recibido |
| Teléfono real | S1, footer | ❌ Placeholder +52-55-1234-5678 |
| Email corporativo real | S1, footer, notificaciones | ❌ Placeholder |
| URLs reales de RRSS | S1, footer, Schema.org | ❌ Placeholders |
| Catálogo Siigo Aspel completo (fichas técnicas, precios) | S2 | ❌ No recibido |
| Catálogo Soft-Restaurant (características, planes) | S3 | ❌ No recibido |
| Catálogo Zoho One | S4 | ❌ No recibido |
| Imágenes/fotos de productos | S2–S4 | ❌ No recibidas |
| Decisión DRM: Escenario P ($99/mes) o B ($60-111/mes) | S7 | ❌ Pendiente (deadline: 15 jun) |
| Registro STPS / formato DC-3 exacto | S10 | ❌ En proceso según cliente |
| Confirmación M365 incluye Copilot/transcripción automática | S9 | ❌ Pendiente |
| Contenido grabado Zoho One disponible | S8 | ❌ Pendiente |

---

## S2 — SPRINT PLANNING PREVIO
> Fechas: Apr 15–24 (10 días) · Foco: Catálogo Siigo Aspel parte 1

**Prerequisito:** S1 completado y cliente aprobó el design system.

**Entregable:** 6 páginas de producto Siigo Aspel + comparador + gestión desde Filament.

### Estructura de URL objetivo (SEO desde S2):
```
/productos/siigo-aspel                → index de la marca
/productos/siigo-aspel/sae            → producto SAE
/productos/siigo-aspel/coi            → producto COI
/productos/siigo-aspel/noi            → producto NOI
/productos/siigo-aspel/caja           → producto CAJA
/productos/siigo-aspel/facture        → producto FACTURE
/productos/siigo-aspel/banco          → producto BANCO
```

### Tareas S2 (preliminar, detallar al iniciar sprint):

**S2-T1: Migración `products`**
```
productos: id, brand (enum), slug, name, short_description, description (longtext),
           features (JSON), plans (JSON), price_from, is_active, sort_order,
           meta_title, meta_description, schema_type, created_at, updated_at
Índices: brand, slug (unique), is_active
```

**S2-T2: Model Product + Resource Filament**
- Model con Spatie MediaLibrary (imagen destacada, galería)
- FilamentResource: tabla + form con todos los campos
- Scope: `brand()`, `active()`, `siigo()`

**S2-T3: ProductController + rutas**
```php
Route::get('/productos/{brand}', [ProductController::class, 'index'])->name('products.brand.index');
Route::get('/productos/{brand}/{slug}', [ProductController::class, 'show'])->name('products.show');
```

**S2-T4: Vistas (Antigravity genera)**
- `pages/productos/index.blade.php` — galería de productos de la marca
- `pages/productos/show.blade.php` — página individual con features, planes, CTA
- Componente Blade: `components/product-card.blade.php`
- Tema aplicado automáticamente según `$product->brand`

**S2-T5: SEO por producto**
- Schema.org `Product` en cada página show
- meta_title y meta_description dinámicos del modelo
- Canonical dinámico
- BreadcrumbList: Home → Siigo Aspel → SAE

**S2-T6: Comparador de productos**
- Vista `/productos/siigo-aspel/comparar`
- Livewire component: `ProductComparator`
- Selección de hasta 3 productos, tabla de características lado a lado

**Dato bloqueante:** recibir catálogo real de Siigo Aspel del cliente antes de iniciar S2.
Sin fichas técnicas, se pueden crear las páginas con estructura pero sin contenido real.

---

## S3–S6 — BACKLOG RESUMIDO

### S3 (Apr 25–May 4): Catálogo Siigo parte 2 + Soft-Restaurant completo
- Misma estructura que S2: 4 productos Siigo Nube + sección Soft-Restaurant en tema naranja
- Formularios de cotización y demo por producto (`StoreLeadRequest`, `LeadService`)
- Lead guardado en DB, notificación por email al equipo

### S4 (May 5–18): Zoho One + páginas internas
- Sección Zoho con overview suite 40+ apps, CRM, Books, People, Desk, Projects, Analytics
- Páginas: `/nosotros`, `/contacto`, `/centros-capacitacion`, `/club-logia`
- Formulario de contacto general con validación y rate limiting

### S5 (May 19–Jun 1): Agendado + Pagos + Gift Cards + Landing pages
- Cal.com en Docker/Railway + webhook → `BookingSlot` → TeamsService::createMeeting()
- Stripe MX: tarjeta + OXXO Pay + SPEI
- Gift cards: migración, GiftCardService, generación masiva desde Filament
- 3 landing pages sin navbar (para Meta Ads): `/landing/siigo`, `/landing/soft-restaurant`, `/landing/zoho`

### S6 (Jun 2–15): Blog + SEO técnico + QA → HITO PAGO F1
- Blog/Centro de recursos con Filament Pages (crear/editar artículos)
- SEO audit completo: 301s del sitio viejo, sitemap XML dinámico, Lighthouse ≥85/90
- WCAG 2.1 AA: audit con Axe DevTools
- Cloudflare WAF + SSL Full Strict activado
- GA4 + GTM configurados
- Aviso de privacidad conforme LFPDPPP

---

## REQUERIMIENTOS E-LEARNING CONFIRMADOS (implementar en S7–S9)

### Perfil de instructor visible en cursos (Domestika-style)
- Tarjeta del instructor en página de curso: avatar, nombre, rol, bio corta, # cursos, # estudiantes
- Página `/instructores/{slug}` con perfil completo + listado de sus cursos
- En catálogo de cursos: chip con avatar + nombre del instructor en cada card

### Instructor puede editar sus propios cursos (si coordinator lo habilita)
**Regla de negocio:**
- `trainer-senior`: puede CRUD sus propios cursos si `can_edit_own_courses = true` en su perfil
- `trainer-junior`: solo visualización, sin edición
- `coordinator`: activa/desactiva el permiso `can_edit_own_courses` por instructor desde Filament
- **Implementación:** Spatie Permission + Gate policy `update` en `CoursePolicy` verifica `$user->can_edit_own_courses`

### Instructor edita su propio perfil
- Ruta: `/campus/perfil/instructor` (solo para roles trainer-*)
- Campos editables: bio, foto, especialidad, linkedin, redes
- Campos NO editables por él: nombre, email, roles (solo admin/coordinator los cambia)

### Cliente puede escoger instructor al agendar
- En formulario de agendado (Cal.com + Livewire): selector de instructor disponible por producto
- Filtro: mostrar solo instructores activos con disponibilidad en el producto seleccionado
- `BookingSlot` almacena `user_id` del instructor asignado

---

## NOTAS TÉCNICAS

### Sobre HTTrack / sitio actual
- Sitio actual en GoDaddy: migrar SOLO contenido (textos, URLs para 301s, imágenes usables)
- NO reutilizar ningún código del sitio viejo ("Efecto Frankenstein")
- Las URLs del sitio viejo se mapean en S6 con redirects 301
- Información útil del HTTrack: estructura de navegación, textos actuales, lista de URLs existentes

### Sobre Filament v5 vs v3
- Scaffold tiene Filament v5.4 instalado (plan decía v3 — usar lo instalado)
- API de Form builders y Resources es compatible en concepto, verificar sintaxis en v5
- Panel admin en `/admin` — configurar guard en `AdminPanelProvider`

### Sobre Alpine.js
- Livewire v4 provee Alpine automáticamente vía `@livewireScripts`
- NO instalar alpinejs por separado via npm — redundante y puede causar conflictos
- Ya corregido en `layouts/app.blade.php`

### Sobre DB local vs Railway
- Local: SQLite (funciona para desarrollo S1-S2)
- Staging/Producción: MySQL 8 en Railway
- Antes de S5 (pagos): cambiar local a MySQL para paridad con producción

---

*Última actualización: 2026-04-06 · Claude Sonnet 4.6*
*Actualizar este archivo al iniciar y cerrar cada sprint.*
