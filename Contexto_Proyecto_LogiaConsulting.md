# CONTEXTO DEL PROYECTO — LOGIA CONSULTING
# Pegar al inicio de cada sesión de Antigravity o cualquier IA de desarrollo
# Versión: Final · Marzo 2026

---

## IDENTIDAD DEL PROYECTO

**Cliente:** Logia Consulting — partner oficial de Siigo Aspel, Soft-Restaurant y Zoho One en México  
**Desarrollador:** Oscar Eduardo Repper Horta  
**Repo:** GitHub privado (rama main protegida, PRs obligatorios)  
**Hosting:** Railway Pro (app Laravel + MySQL + n8n + Cal.com en un solo plan)  
**Dominio principal:** logiaconsulting.com (GoDaddy como registrador, NS apuntan a Cloudflare)  
**Campus e-learning:** campus.logiaconsulting.com  
**Panel admin:** logiaconsulting.com/admin  
**Kickoff:** 1 de abril de 2026  
**Deadline contractual:** 1 de noviembre de 2026  
**Meta interna:** 14 de octubre de 2026  

---

## STACK TECNOLÓGICO — DEFINITIVO Y NO NEGOCIABLE

```
Laravel 11 + PHP 8.3          → backend principal
Livewire 3 + Alpine.js        → UI reactiva (sin React, sin Vue)
Tailwind CSS + CSS Variables  → estilos multi-tema
Filament PHP v3               → panel admin + dashboards (Chart.js nativo)
MySQL 8                       → base de datos (Railway)
Laravel Sanctum               → autenticación API
Spatie/laravel-permission     → RBAC con subroles
Laravel Cashier + Stripe MX   → pagos: OXXO Pay + SPEI + tarjeta
Bunny.net Stream              → video streaming e-learning
Bunny.net MediaCage DRM       → DRM Widevine + FairPlay (decisión pendiente cliente)
Mozilla PDF.js (embebido)     → visor PDF sin descarga
Google Cloud Storage          → archivos y materiales protegidos
Spatie/laravel-medialibrary   → gestión de media
Spatie/laravel-activitylog    → auditoría de accesos a contenido
Spatie/laravel-backup         → backups nocturnos a GCS
Laravel DomPDF                → generación de certificados PDF (3 tipos)
Cal.com (Docker en Railway)   → agendado de citas y sesiones
MS Graph API                  → Teams meetings automáticos + M365 Copilot webhooks
n8n Community (self-hosted)   → automatización Meta Ads (Fase 3)
Apify API                     → scraping de audiencias (consumido desde n8n)
Gemini API                    → copy de anuncios por producto (desde n8n)
Resend.com Pro                → email transaccional
GitHub Actions                → CI/CD → Railway auto-deploy
Cloudflare Pro                → CDN + WAF + SSL Full Strict
UptimeRobot                   → monitoreo de disponibilidad
```

**Principio rector: "No reinventar la rueda"**
- M365 Copilot ya pagado por el cliente → transcripción automática de sesiones virtuales vía webhook
- Filament Charts (Chart.js) → dashboards sin librerías externas
- Stripe SDK → OXXO + SPEI + tarjeta en una integración
- n8n ya dominado por el desarrollador → orquestador de Fase 3

---

## IDENTIDADES VISUALES (multi-tema por producto)

| Producto | Color primario | Variable CSS |
|---------|---------------|-------------|
| Siigo Aspel | Azul `#1B4DB7` | `--brand-siigo` |
| Soft-Restaurant | Naranja `#E8500A` | `--brand-soft` |
| Zoho One | Rojo `#C8202C` | `--brand-zoho` |

El Design System usa CSS custom properties para que el mismo componente cambie de tema según el contexto. Los 3 temas aplican tanto en el sitio corporativo como en el campus e-learning.

---

## FASES Y SPRINTS

### FASE 1 — Sitio Web Corporativo (S1–S6 · Abr 1 – Jun 15, 2026)

| Sprint | Fechas | Foco principal |
|--------|--------|----------------|
| Pre-Sprint | 20–31 Mar | Setup total: accesos, Railway, Cloudflare, Stripe test, Bunny.net, GCS, scaffolding Antigravity |
| S1 · 14d | 1–14 Abr | Design System 3 temas + Homepage premium |
| S2 · 10d | 15–24 Abr | Catálogo Siigo Aspel parte 1 (SAE, COI, NOI, CAJA, FACTURE, BANCO) |
| S3 · 10d | 25 Abr–4 May | Catálogo Siigo parte 2 + Soft-Restaurant completo |
| S4 · 14d | 5–18 May | Zoho One completo + páginas internas (Centros, Club, Nosotros, Contacto) |
| S5 · 14d | 19 May–1 Jun | Agendado+Teams + OXXO/SPEI/tarjeta + Gift cards + 3 landing pages Meta |
| S6 · 14d | 2–15 Jun | Blog + SEO prioritario + 301s + WCAG + Cloudflare + QA → **HITO PAGO F1** |

### FASE 2 — E-Learning Campus (S7–S12 · Jun 16 – Sep 3, 2026)

| Sprint | Fechas | Foco principal |
|--------|--------|----------------|
| S7 · 10d | 16–25 Jun | Schema DB completo + auth + roles/subroles + matrículas |
| S8 · 14d | 26 Jun–9 Jul | Modalidad Online + DRM (Widevine/FairPlay) + progressive unlock + watermark |
| S9 · 14d | 10–23 Jul | PDF.js seguro + Modalidad Virtual (Teams+M365 Copilot) + Presencial + subroles |
| S10 · 14d | 24 Jul–6 Ago | Panel Filament + dashboards + 3 certs (Brand/STPS-DC3/Colegiados) + suscripciones |
| S11 · 14d | 7–20 Ago | DRM hardening + sesión única + audit log + penetration test + SSO |
| S12 · 14d | 21 Ago–3 Sep | QA integral + Core Web Vitals + pruebas móvil → **HITO PAGO F2** |

### FASE 3 — Marketing Digital IA (S13–S15 · Sep 4 – Oct 7, 2026)

| Sprint | Fechas | Foco principal |
|--------|--------|----------------|
| S13 · 14d | 4–17 Sep | n8n + Meta Business API + 3 pipelines Apify (Siigo/SoftRest/Zoho) |
| S14 · 10d | 18–27 Sep | Gemini copy por audiencia + pipeline completo punta a punta |
| S15 · 10d | 28 Sep–7 Oct | Dashboard métricas + QA leads reales + docs n8n JSON → **HITO PAGO F3** |
| Buffer · 7d | 8–14 Oct | Correcciones + deploy producción |
| 🎯 | 14 Oct | Meta interna — sistema completo en producción |
| 📤 | 15 Oct–1 Nov | Entrega formal al cliente |
| 🛡️ | 1 Nov | Deadline contractual |

---

## MODELOS DE BASE DE DATOS

```
users               → auth + Cashier + Spatie roles
courses             → brand (siigo|soft_restaurant|zoho_one), modality, certificate_type
modules             → orden dentro del course
lessons             → tipo (video|pdf|text|quiz), bunny_video_id, gcs_file_path
matriculas          → código único LOG-SIIGO-2026-00001, ligada a enrollment
enrollments         → user+course, status, payment_method, stripe refs
progress            → user+lesson, porcentaje completado, is_completed
quiz_attempts       → score, passed, respuestas JSON
certificates        → uuid, tipo (brand|stps|collegiate), pdf en GCS, QR verificación
gift_cards          → código UUID, monto, fecha expiración, redención
booking_slots       → tipo cita, instructor, teams_join_url, marca
session_transcripts → resumen M365 Copilot, transcripción, ligada a booking_slot
leads               → producto, audiencia, meta_ad_id, status del lead
```

---

## ROLES Y PERMISOS

| Rol | Acceso clave |
|-----|-------------|
| super-admin | Todo sin restricción |
| admin | Panel completo: cursos, usuarios, pagos, reportes, leads |
| coordinator | Grupos, inscripciones, reportes (sin pagos ni config) |
| trainer-senior | Sus propios cursos: CRUD completo + invitar estudiantes + descargar materiales |
| trainer-junior | Solo ver grupos asignados. Sin edición, sin descarga |
| student | Sus cursos contratados, progreso, certificados |
| guest | Contenido demo únicamente |

---

## PROTECCIÓN DE CONTENIDO — SISTEMA DE 7 CAPAS

**Capa 1 — DRM hardware** (si se elige Escenario P):
Bunny.net MediaCage Enterprise. Widevine L1+L3 (Chrome/Android) + FairPlay (Safari/iOS). Pantalla en negro al grabar con software.

**Capa 2 — PDF sin descarga:**
Manuales fragmentados en chunks de 10-15 páginas en DB. Renderizados server-side con DomPDF + watermark dinámico. Servidos vía PDF.js con toolbar deshabilitado (sin imprimir, sin descargar, sin copiar texto).

**Capa 3 — Watermark dinámico trazable:**
Nombre completo + número de matrícula incrustado en overlay de video y en cada página de PDF. Si el contenido se filtra, identifica al responsable exacto.

**Capa 4 — Desbloqueo progresivo:**
El backend valida antes de emitir cualquier URL de contenido. Reglas: video ≥85% visto + quiz ≥70% aprobado = sección desbloqueada. Sin validación → 403.

**Capa 5 — Validación de matrícula en tiempo real:**
Cada request verifica: token JWT activo + matrícula existe y activa + subscription_status activo en DB + progreso suficiente. Middleware: `ValidateMatricula`.

**Capa 6 — Sesión única:**
Nuevo login revoca el token anterior automáticamente. No se puede compartir credenciales.

**Capa 7 — Auditoría completa:**
Spatie Activity Log en cada acceso a contenido: usuario, matrícula, lección, IP, timestamp, dispositivo. Visible desde Filament.

---

## SERVICIOS CLAVE Y SU RESPONSABILIDAD

### TeamsService.php
Usa MS Graph API con OAuth2 client credentials flow.
- `getAccessToken()` → POST a Azure AD token endpoint
- `createMeeting(data)` → POST `/users/{organizerId}/onlineMeetings` → retorna join_url
- `getMeetingTranscript(meetingId)` → GET transcripts post-sesión → importa resumen M365 Copilot

### BunnyStreamService.php
- `getSignedUrl(videoId, matriculaCode)` → HMAC-SHA256 con expiración 2h
- `uploadVideo(filePath, title)` → POST a Bunny Stream API
- DRM: token incluye matrícula, usuario y expiración

### CertificateService.php
- `generate(enrollment)` → detecta tipo → renderiza blade → DomPDF → sube a GCS → crea Certificate con UUID
- Tipos: `brand` (logos Logia), `stps` (DC-3 NOM-030), `collegiate` (logos colegio dinámico)

### StripeService.php
- `createPaymentIntent(course, user, method)` → 'card' | 'oxxo' | 'customer_balance'(SPEI)
- OXXO: expira en 3 días, máximo $10,000 MXN por voucher
- `handleWebhook(request)` → verifica signing_secret SIEMPRE antes de procesar

### GiftCardService.php
- `generate(amount, quantity, batchRef)` → UUID masivos desde Filament
- `redeem(code, user)` → valida vigencia, aplica en checkout

---

## OBSERVERS (efectos secundarios automáticos)

**EnrollmentObserver::created():**
→ Genera matrícula automáticamente con formato LOG-{BRAND}-{AÑO}-{SECUENCIA}
→ Registra en Activity Log

**ProgressObserver::updated():**
→ Cuando `is_completed` cambia a true, recalcula % total del enrollment
→ Si enrollment llega a 100% → marca como 'completed' → llama CertificateService::generate()

---

## SESIONES VIRTUALES — FLUJO COMPLETO

```
1. Estudiante agenda desde campus → Cal.com webhook → Laravel crea BookingSlot
2. TeamsService::createMeeting() → genera teams_join_url
3. Emails automáticos (Resend): confirmación al estudiante + al instructor
4. Sesión ocurre en Teams (M365 graba automáticamente)
5. Post-sesión: Teams webhook → Laravel recibe → TeamsService::getMeetingTranscript()
6. Se crea SessionTranscript con resumen IA + transcripción completa
7. Visible en el perfil del estudiante y en el historial del coordinador
```

Este flujo protege contra coaches que intenten evadir la plataforma: toda comunicación queda transcrita automáticamente.

---

## SECCIÓN SEO (prioridad explícita del cliente)

Aplicar desde S1, no solo en S6:
- Estructura de URLs limpia desde el inicio: `/productos/siigo/sae`, `/cursos/zoho/crm`, etc.
- Schema.org en todas las páginas: `Organization`, `Product`, `Course`, `Article`, `BreadcrumbList`
- Meta tags dinámicos por página (título, descripción, OG, Twitter Cards)
- Sitemap XML dinámico con prioridades
- Redirecciones 301 de todas las URLs del sitio anterior (ninguna URL queda rota)
- Lighthouse SEO ≥90 en producción
- `robots.txt` correcto desde el primer deploy

---

## CONVENCIONES DE CÓDIGO — OBLIGATORIAS

```
Controllers   → solo reciben request, delegan a Services, retornan respuesta
Services      → toda la lógica de negocio compleja
Form Requests → toda la validación (nunca inline en controllers)
Policies      → autorización granular por modelo
Enums PHP 8.1 → estados: CourseStatus, EnrollmentStatus, PaymentMethod, CertificateType, ProductBrand, UserRole
Observers     → efectos secundarios (emails, logs, matrículas, certificados)
Migrations    → siempre con método down() funcional. NUNCA editar migración existente
Jobs          → tareas asíncronas en Queue (envío de emails, generación de PDFs, backups)
Feature Tests → para flujos críticos: pagos, auth, progreso, DRM, certificados
```

---

## VARIABLES DE ENTORNO NECESARIAS

```env
# App
APP_NAME="Logia Consulting"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://logiaconsulting.com

# DB (Railway MySQL)
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=logia_consulting
DB_USERNAME=
DB_PASSWORD=

# Stripe México
STRIPE_KEY=
STRIPE_SECRET=
STRIPE_WEBHOOK_SECRET=

# Microsoft Graph / Teams / M365 Copilot
AZURE_TENANT_ID=
AZURE_CLIENT_ID=
AZURE_CLIENT_SECRET=
TEAMS_ORGANIZER_USER_ID=

# Cal.com
CALCOM_API_KEY=
CALCOM_WEBHOOK_SECRET=

# Bunny.net
BUNNY_STREAM_LIBRARY_ID=
BUNNY_STREAM_API_KEY=
BUNNY_STREAM_CDN_HOSTNAME=
BUNNY_STREAM_DRM_ENABLED=true   # false = Escenario B (sin DRM hardware)

# Google Cloud Storage
GCS_PROJECT_ID=
GCS_BUCKET=
GCS_KEY_FILE_PATH=storage/app/gcs-credentials.json

# Email (Resend)
RESEND_API_KEY=
MAIL_MAILER=smtp
MAIL_HOST=smtp.resend.com
MAIL_PORT=465
MAIL_USERNAME=resend
MAIL_PASSWORD=       # = RESEND_API_KEY
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@logiaconsulting.com
MAIL_FROM_NAME="Logia Consulting"

# Cloudflare
CLOUDFLARE_ZONE_ID=
CLOUDFLARE_API_TOKEN=

# Meta API (usado desde n8n, no desde Laravel directamente)
META_APP_ID=
META_ACCESS_TOKEN=

# Backups
BACKUP_DISK=gcs
BACKUP_NOTIFICATION_EMAIL=sistemas@logiaconsulting.com
```

---

## COSTOS DE INFRAESTRUCTURA (verificados 17/03/2026)

### Escenario P — DRM Enterprise (Widevine + FairPlay)
| Servicio | USD/mes |
|---------|---------|
| Railway Pro | $35–55 |
| Bunny.net Stream CDN | $3–8 |
| **Bunny.net MediaCage DRM Enterprise** | **$99–105** |
| Google Cloud Storage | $2–8 |
| Cloudflare Pro | $20 |
| Resend Pro | $20 |
| **Total mensual** | **$179–216 USD (~$3,580–4,320 MXN)** |

### Escenario B — Sin DRM hardware
| Servicio | USD/mes |
|---------|---------|
| Railway Pro | $35–55 |
| Bunny.net Stream CDN | $3–8 |
| Google Cloud Storage | $2–8 |
| Cloudflare Pro | $20 |
| Resend | $0–20 |
| **Total mensual** | **$60–111 USD (~$1,200–2,220 MXN)** |

El cliente elige el escenario antes del inicio de S7 (15 de junio de 2026).

---

## PUNTOS PENDIENTES AL 20 DE MARZO (reunión de firma)

- [ ] Confirmar escenario de protección: P (DRM $99/mes) o B (básico $60–111/mes)
- [ ] Solicitar formato DC-3 exacto para certificado STPS Tipo 2
- [ ] Verificar que licencias M365 incluyen Teams Premium/Copilot (transcripción automática)
- [ ] Definir nickname del correo técnico para servicios de terceros (sistemas@ ya en uso)
- [ ] Confirmar contenido grabado disponible de Zoho One para S8
- [ ] Recibir: logo vectorial, colores HEX, tipografías, catálogo de productos

---

## CÓMO USAR ESTE ARCHIVO

**Al iniciar sesión en Antigravity:** Carga este archivo como contexto del proyecto antes de dar cualquier tarea. Esto garantiza que el agente conozca el stack, los modelos, los servicios y las convenciones sin que tengas que re-explicarlos.

**Tarea tipo para Antigravity:**
```
[Contexto: ver Contexto_Proyecto_LogiaConsulting.md]

Sprint actual: S1 — Design System Multi-tema
Tarea: Crear el sistema de temas CSS con variables custom properties para los 3 productos.
Archivo objetivo: resources/css/app.css + resources/views/layouts/app.blade.php
El layout debe detectar el contexto de la página (ruta o parámetro) y aplicar
el tema correspondiente. Usa los colores exactos del contexto del proyecto.
```

**Al hacer debug o review de código:**
```
[Contexto: ver Contexto_Proyecto_LogiaConsulting.md]

Revisa este código del EnrollmentObserver y verifica:
1. El formato de la matrícula es LOG-{BRAND}-{AÑO}-{SECUENCIA_5_DÍGITOS}
2. El Activity Log incluye matrícula, usuario, curso e IP
3. No hay race condition en la secuencia (usar transacción DB)
[pegar código aquí]
```
