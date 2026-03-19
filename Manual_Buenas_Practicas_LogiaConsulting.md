# Manual de Buenas Prácticas y Nomenclatura
## Proyecto: Logia Consulting — Sistema Digital Integral
## Stack: Laravel 11 · Filament v3 · Livewire 3 · MySQL 8
## Versión: 1.0 · Marzo 2026

---

## 0. Filosofía del Proyecto

Tres principios que guían cada decisión técnica:

1. **YAGNI** (You Aren't Gonna Need It) — no construir lo que no se necesita en el sprint actual. La complejidad prematura es el principal enemigo del deadline.
2. **No reinventar la rueda** — Filament ya tiene tablas, Cashier ya tiene pagos, Spatie ya tiene permisos. Usar los paquetes para lo que fueron diseñados.
3. **Código que se explica solo** — nombres descriptivos, funciones pequeñas con una sola responsabilidad, comentarios solo donde la lógica de negocio no es obvia.

---

## 1. Estructura del Proyecto Laravel

### 1.1 Dónde va cada cosa

```
app/Models/           → Solo propiedades, relaciones, scopes, accessors y mutators
app/Services/         → Toda la lógica de negocio compleja
app/Http/Controllers/ → Recibir request, llamar Service, retornar respuesta (máx. 10 líneas de lógica)
app/Http/Requests/    → Toda la validación (nunca inline en el controller)
app/Http/Middleware/  → Lógica que aplica antes/después de una request HTTP
app/Policies/         → Autorización por modelo (¿puede este usuario hacer X con este recurso?)
app/Enums/            → Estados y tipos fijos del dominio
app/Observers/        → Efectos secundarios de eventos del modelo (nunca en el controller)
app/Jobs/             → Tareas asíncronas que van a la Queue (emails, PDFs, backups)
app/Filament/         → Todo lo del panel de administración
database/migrations/  → Una migración por tabla, nunca editar las ya ejecutadas
database/seeders/     → Datos de prueba y datos iniciales del sistema (roles, permisos)
resources/views/      → Blade templates (layouts, páginas, componentes, emails, certificados)
resources/js/         → Alpine.js components y utilidades JS mínimas
resources/css/        → Tailwind + CSS custom properties para los 3 temas de marca
routes/web.php        → Rutas del sitio y del campus
routes/api.php        → Rutas de la API (n8n, Meta Ads, integraciones)
```

### 1.2 Lo que NO debe estar en un Controller

```php
// MAL — lógica de negocio en el controller
public function store(Request $request)
{
    $course = Course::find($request->course_id);
    $price = $course->price * (1 - $request->discount / 100);
    $stripe = new \Stripe\PaymentIntent($price);
    $enrollment = Enrollment::create([...]);
    Matricula::create(['code' => 'LOG-' . ...]);
    Mail::to($request->user())->send(new EnrollmentConfirmation($enrollment));
    return redirect()->route('campus.dashboard');
}

// BIEN — el controller delega
public function store(EnrollmentRequest $request)
{
    $enrollment = $this->enrollmentService->create(
        $request->user(),
        Course::findOrFail($request->course_id),
        $request->validated()
    );
    return redirect()->route('campus.dashboard')->with('success', 'Inscripción completada.');
}
```

---

## 2. Nomenclatura — Bases de Datos

### 2.1 Tablas
```
Plural, snake_case, en español si el dominio es español:
✅  courses, enrollments, matriculas, quiz_attempts, gift_cards
✅  booking_slots, session_transcripts, virtual_sessions, leads
❌  Course, Enrollment, MatriculaTable, quizAttempts
```

### 2.2 Columnas
```
snake_case, descriptivas, sin abreviaciones crípticas:
✅  stripe_payment_intent_id, bunny_video_id, is_completed, completed_at
✅  min_completion_percentage, teams_join_url, gcs_file_path
❌  spi, bvi, compl, min_compl_pct, tjurl

Convenciones obligatorias:
- Booleanos: prefijo is_  → is_completed, is_available, is_required, is_used
- Timestamps de estado: sufijo _at → paid_at, completed_at, used_at, issued_at
- Claves foráneas: {tabla_singular}_id → course_id, user_id, enrollment_id
- Claves de servicios externos: {servicio}_{tipo}_id → stripe_payment_intent_id, bunny_video_id
- JSON: nombre descriptivo del contenido → answers (quiz), metadata, attendees
```

### 2.3 Índices
```php
// Nombrar índices explícitamente en migraciones complejas:
$table->index(['user_id', 'course_id'], 'idx_enrollments_user_course');
$table->unique(['user_id', 'lesson_id'], 'uq_progress_user_lesson');

// Siempre indexar claves foráneas y columnas de búsqueda frecuente:
$table->index('status');       // enrollments, leads
$table->index('brand');        // courses
$table->index('stripe_id');    // users
```

### 2.4 Regla de migraciones
```
NUNCA editar una migración que ya fue ejecutada en cualquier entorno.
Si necesitas cambiar una columna, crear una NUEVA migración:

✅  2026_04_10_add_location_to_courses_table.php
✅  2026_04_15_change_price_to_decimal_in_courses_table.php
❌  Editar 2026_04_01_create_courses_table.php
```

---

## 3. Nomenclatura — Código PHP / Laravel

### 3.1 Clases
```php
// PascalCase siempre
class EnrollmentService {}
class TeamsWebhookController {}
class ValidateMatricula {}           // Middleware
class EnrollmentObserver {}
class CourseCreated {}               // Event
class SendEnrollmentConfirmation {}  // Job (acción descriptiva)
class EnrollmentStatus {}            // Enum
```

### 3.2 Métodos y funciones
```php
// camelCase, verbos descriptivos
public function createEnrollment(User $user, Course $course): Enrollment
public function generateMatriculaCode(Course $course): string
public function getSignedVideoUrl(string $videoId, string $matricula): string
public function isSubscriptionActive(): bool   // Accessor/método de modelo

// Evitar nombres genéricos:
❌  process(), handle() sin contexto, doStuff(), make()
✅  processStripeWebhook(), handleCalcomBooking(), makeSignedUrl()

// Exception: handle() es el nombre correcto para Jobs y Listeners de Laravel:
class SendEnrollmentConfirmation implements ShouldQueue {
    public function handle(): void  // ← esto está bien, es la convención de Laravel
}
```

### 3.3 Variables
```php
// camelCase, descriptivas
$enrollmentStatus = EnrollmentStatus::Active;
$paymentIntentId  = $stripe->id;
$videoSignedUrl   = $bunnyService->getSignedUrl($lesson->bunny_video_id);
$isEligible       = $this->checkProgressEligibility($enrollment);

// Evitar:
❌  $e, $c, $s, $tmp, $data, $result, $response (sin contexto)
✅  $enrollment, $course, $stripeResponse, $validatedData, $gcsUploadResult

// En loops, usar nombres del dominio:
foreach ($enrollments as $enrollment)    // ✅
foreach ($enrollments as $e)             // ❌
```

### 3.4 Constantes y Enums
```php
// Enums PHP 8.1 con backed type string siempre para persistencia:
enum EnrollmentStatus: string {
    case Pending   = 'pending';
    case Active    = 'active';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
}

enum CertificateType: string {
    case Brand      = 'brand';
    case Stps       = 'stps';
    case Collegiate = 'collegiate';
}

enum ProductBrand: string {
    case Siigo          = 'siigo';
    case SoftRestaurant = 'soft_restaurant';
    case ZohoOne        = 'zoho_one';
}

// Uso en código:
$enrollment->status = EnrollmentStatus::Active;    // ✅
$enrollment->status = 'active';                    // ❌
```

### 3.5 Comentarios en código
```php
// Comentar el POR QUÉ, no el QUÉ (el código ya dice el qué):

// ❌ Comentario innecesario (el código ya lo dice):
// Obtener el enrollment del usuario
$enrollment = Enrollment::where('user_id', $user->id)->first();

// ✅ Comentario valioso (explica una decisión no obvia):
// Usamos lockForUpdate() para evitar race conditions en la generación
// de matrículas — dos requests simultáneas podrían generar el mismo código.
$lastMatricula = Matricula::whereYear('created_at', $year)
                           ->lockForUpdate()
                           ->orderByDesc('id')
                           ->first();

// ✅ PHPDoc en métodos de Services (ayuda a Antigravity y a futuros desarrolladores):
/**
 * Genera una URL firmada para el video de Bunny.net con expiración de 2 horas.
 * La firma incluye la matrícula para audit trail si el URL se filtra.
 *
 * @param string $videoId   ID del video en Bunny.net Stream
 * @param string $matricula Código de matrícula del estudiante (ej: LOG-SIIGO-2026-00001)
 * @return string           URL firmada con expiración
 */
public function getSignedUrl(string $videoId, string $matricula): string
```

---

## 4. Nomenclatura — Git

### 4.1 Ramas (branches)
```
Patrón: {tipo}/{sprint}-{descripcion-kebab-case}

Tipos:
  feature/   → funcionalidad nueva
  fix/        → corrección de bug
  hotfix/     → corrección urgente en producción
  refactor/   → mejora de código sin cambio de funcionalidad
  chore/      → actualizaciones de dependencias, configuración

Ejemplos:
✅  feature/s1-homepage-multitema
✅  feature/s5-oxxo-pay-integration
✅  feature/s8-drm-bunny-widevine
✅  fix/s9-pdf-watermark-encoding
✅  hotfix/stripe-webhook-signature
✅  chore/update-filament-v3-3

❌  oscar-trabajando
❌  nueva-funcionalidad
❌  fix-bug
❌  wip
```

### 4.2 Commits
```
Patrón: {tipo}({alcance}): {descripción en imperativo}

Tipos:
  feat     → funcionalidad nueva
  fix      → corrección de bug
  docs     → documentación
  style    → formato, espacios (sin cambio lógico)
  refactor → refactorización
  test     → agregar o corregir tests
  chore    → dependencias, configuración, build

Ejemplos:
✅  feat(enrollment): generar matrícula automática al inscribirse
✅  feat(stripe): integrar OXXO Pay con voucher de código de barras
✅  fix(drm): corregir firma HMAC en URLs de Bunny.net al cambiar timezone
✅  feat(filament): agregar widget de inscripciones en dashboard de admin
✅  docs(readme): documentar setup de GCS con service account
✅  test(enrollment): agregar test de generación de matrícula con concurrencia

❌  update code
❌  fix stuff
❌  trabajando en el login
❌  commit
❌  WIP

Reglas adicionales:
- Máximo 72 caracteres en la primera línea
- Si necesitas más contexto, dejar línea en blanco y agregar cuerpo
- Cada commit debe compilar y pasar los tests (nunca commitear código roto)
- Commits atómicos: un commit = un cambio lógico (no mezclar 5 cosas en uno)
```

### 4.3 Flujo de trabajo Git
```
1. Siempre trabajar en una rama feature/, nunca en main directamente
2. Hacer commits pequeños y frecuentes (cada vez que algo funciona)
3. Al terminar el feature, crear Pull Request hacia main
4. Antes del PR, hacer rebase con main para resolver conflictos en tu rama
5. Revisar el propio PR antes de mergear (checklist de cierre de sprint)
6. main siempre debe estar deployable — si hay duda, no mergear

Flujo diario:
  git checkout main && git pull              # actualizar main
  git checkout -b feature/s1-homepage       # crear rama
  # ... desarrollar y hacer commits ...
  git push origin feature/s1-homepage       # subir rama
  # crear PR en GitHub, revisar, mergear
```

---

## 5. Nomenclatura — Rutas y URLs

### 5.1 Sitio web corporativo
```
Patrón: /categoria/subcategoria (kebab-case, en español)

/                               → Homepage
/productos/siigo-aspel          → Sección Siigo Aspel
/productos/siigo-aspel/sae      → Producto SAE específico
/productos/siigo-aspel/coi      → Producto COI específico
/productos/soft-restaurant      → Sección Soft-Restaurant
/productos/zoho-one             → Sección Zoho One
/servicios/capacitacion         → Servicios de capacitación
/servicios/soporte-tecnico      → Soporte técnico
/agenda-tu-cita                 → Sistema de agendado
/blog                           → Blog / Centro de recursos
/blog/{slug}                    → Artículo individual
/nosotros                       → Página de empresa
/contacto                       → Formulario de contacto
/verificar/{uuid}               → Verificación de certificados (pública)
```

### 5.2 Campus e-learning
```
/campus                         → Dashboard del estudiante
/campus/cursos                  → Catálogo de cursos disponibles
/campus/cursos/{slug}           → Detalle del curso
/campus/cursos/{slug}/lecciones/{id} → Lección específica (protegida)
/campus/mis-cursos              → Cursos inscritos del estudiante
/campus/certificados            → Certificados del estudiante
/campus/certificados/{uuid}/descargar → Descarga de certificado
/campus/perfil                  → Perfil y configuración del estudiante
```

### 5.3 Panel de administración
```
/admin                          → Dashboard de administración (Filament)
/admin/cursos                   → Gestión de cursos
/admin/usuarios                 → Gestión de usuarios
/admin/inscripciones            → Gestión de inscripciones
/admin/pagos                    → Registros de pagos
/admin/gift-cards               → Gestión de gift cards
/admin/certificados             → Certificados emitidos
/admin/agenda                   → Gestión de citas y disponibilidad
/admin/leads                    → Leads de campañas Meta
```

### 5.4 Nomenclatura de rutas en código
```php
// Named routes: {seccion}.{recurso}.{accion}
Route::get('/campus/cursos/{course}', ...)->name('campus.courses.show');
Route::get('/campus/certificados', ...)->name('campus.certificates.index');
Route::post('/campus/cursos/{course}/inscribirse', ...)->name('campus.courses.enroll');

// Webhooks: siempre prefijo /webhooks/
Route::post('/webhooks/stripe', ...)->name('webhooks.stripe');
Route::post('/webhooks/calcom', ...)->name('webhooks.calcom');
Route::post('/webhooks/teams',  ...)->name('webhooks.teams');

// API: versioned, prefijo /api/v1/
Route::prefix('api/v1')->group(function () {
    Route::post('/leads', ...)->name('api.v1.leads.store');
    Route::get('/metrics/leads', ...)->name('api.v1.metrics.leads');
});
```

---

## 6. Nomenclatura — Archivos y Clases

### 6.1 Models
```php
// PascalCase singular
User, Course, Module, Lesson, Enrollment, Matricula,
Progress, QuizAttempt, Certificate, GiftCard, GiftCardRedemption,
BookingSlot, VirtualSession, SessionTranscript, Lead
```

### 6.2 Controllers
```php
// {Recurso}Controller → siempre Resource controllers cuando aplica
CourseController
EnrollmentController
CertificateController
PaymentController
BookingController
ContentController       // signed URLs para video y PDF
TeamsWebhookController
MetaWebhookController
```

### 6.3 Services
```php
// {Dominio}Service → un Service por dominio externo o de negocio complejo
TeamsService            // MS Graph API
BunnyStreamService      // Bunny.net Stream + DRM
GoogleCloudService      // GCS signed URLs
StripeService           // Pagos: card + OXXO + SPEI
CertificateService      // Generación de los 3 tipos de PDF
GiftCardService         // Generación y redención de gift cards
MatriculaService        // Generación de códigos de matrícula
MetaAdsService          // Triggers a n8n pipelines
```

### 6.4 Form Requests
```php
// {Accion}{Recurso}Request
StoreEnrollmentRequest
UpdateCourseRequest
StoreBlogPostRequest
ProcessPaymentRequest
StoreLeadRequest
RedeemGiftCardRequest
```

### 6.5 Jobs
```php
// Acción descriptiva en imperativo (qué hace el job)
SendEnrollmentConfirmationEmail
GenerateCertificatePdf
ImportTeamsTranscript
ProcessStripeWebhookEvent
BackupDatabaseToGcs
SendCourseCompletionEmail
```

### 6.6 Views Blade
```
resources/views/
├── layouts/
│   ├── app.blade.php          → Layout principal del sitio
│   ├── campus.blade.php       → Layout del campus e-learning
│   └── email.blade.php        → Layout de emails
├── components/
│   ├── product-card.blade.php → Card reutilizable de producto
│   ├── course-card.blade.php  → Card de curso en catálogo
│   └── progress-bar.blade.php → Barra de progreso de curso
├── pages/
│   ├── home.blade.php
│   ├── productos/
│   │   ├── siigo-aspel.blade.php
│   │   └── zoho-one.blade.php
│   └── blog/
│       ├── index.blade.php
│       └── show.blade.php
├── campus/
│   ├── dashboard.blade.php
│   ├── courses/
│   │   ├── index.blade.php
│   │   ├── show.blade.php
│   │   └── lesson.blade.php
│   └── certificates/
│       └── index.blade.php
├── certificates/              → Templates para DomPDF
│   ├── brand.blade.php
│   ├── stps.blade.php
│   └── collegiate.blade.php
└── emails/
    ├── enrollment-confirmation.blade.php
    ├── booking-confirmation.blade.php
    └── certificate-ready.blade.php
```

### 6.7 Livewire Components
```php
// PascalCase, nombre descriptivo de lo que renderiza
App\Livewire\BookingCalendar          → resources/views/livewire/booking-calendar.blade.php
App\Livewire\CourseProgress           → resources/views/livewire/course-progress.blade.php
App\Livewire\PaymentForm              → resources/views/livewire/payment-form.blade.php
App\Livewire\VideoPlayer              → resources/views/livewire/video-player.blade.php
App\Livewire\QuizComponent            → resources/views/livewire/quiz-component.blade.php
App\Livewire\GiftCardRedemptionForm   → resources/views/livewire/gift-card-redemption-form.blade.php
```

---

## 7. Documentación del Progreso (Notion)

### 7.1 Estructura del tablero Notion
```
Logia Consulting — Proyecto Digital/
├── 📋 Backlog General
├── 🏃 Sprint Actual  ← actualizar cada lunes
├── ✅ Completado
├── 🗂️ Decisiones de Arquitectura  ← CRÍTICO: documentar aquí cada decisión técnica importante
├── 📦 Recursos del Cliente  ← materiales recibidos del cliente
├── 🐛 Bugs Conocidos
└── 📖 Wiki Técnica/
    ├── Setup local del entorno
    ├── Cómo hacer deploy a Railway
    ├── Cómo agregar un nuevo tipo de pago
    ├── Cómo crear un nuevo tipo de certificado
    ├── Variables de entorno: descripción de cada una
    └── Decisiones que NO se tomaron y por qué
```

### 7.2 Formato de tarea en Backlog
```
Título: [S5] Integrar OXXO Pay con Stripe México
Sprint: 5
Estado: En Progreso
Estimado: 3 días
Archivos relacionados: app/Services/StripeService.php, routes/web.php
Criterio de aceptación:
  - [ ] PaymentIntent creado con payment_method_types: ['oxxo']
  - [ ] Voucher con código de barras renderizado en la página de pago
  - [ ] Webhook de Stripe recibe payment_intent.succeeded y activa el enrollment
  - [ ] Email de confirmación enviado al estudiante
  - [ ] Test en Stripe test mode con tarjeta de prueba OXXO

Notas técnicas: (agregar aquí cualquier decisión o truco descubierto al implementar)
```

### 7.3 Registro de Decisiones de Arquitectura (ADR)
```
Cada vez que se tome una decisión técnica importante que no sea obvia,
documentarla en la sección "Decisiones de Arquitectura" con este formato:

# ADR-001: Usar Bunny.net MediaCage Enterprise para DRM

Fecha: 15 junio 2026
Estado: Aprobado
Decidido por: Oscar Repper

## Contexto
El cliente requiere que la grabación de pantalla resulte en pantalla negra.
Se evaluaron: Bunny.net MediaCage, Mux DRM, Cloudflare Stream DRM.

## Decisión
Bunny.net MediaCage Enterprise DRM.

## Motivo
Ya usamos Bunny.net para el streaming — mismo proveedor simplifica la
integración. El precio ($99/mes base) es el más bajo de los evaluados.
La documentación es clara y hay ejemplos con Laravel.

## Consecuencias
- Costo mensual adicional de $99-105 USD para el cliente
- Widevine L1 requiere CDM certificado en el dispositivo (Chrome ≥ v67)
- FairPlay requiere certificado Apple — proceso de aprobación de 3-5 días hábiles
```

---

## 8. Testing

### 8.1 Qué testear (y qué no)
```php
// SIEMPRE testear con Feature Tests (integración real):
- Flujo completo de inscripción + pago + matrícula generada
- Webhook de Stripe: payment_intent.succeeded → enrollment activo
- Desbloqueo progresivo: no acceder a lección sin completar la anterior
- Generación de matrículas con concurrencia (race conditions)
- Generación de certificados PDF con los 3 tipos
- Validación de matrícula: acceso denegado con matrícula inactiva

// SIEMPRE testear con Unit Tests:
- Generación de código de matrícula (formato correcto)
- Cálculo de porcentaje de progreso
- Validación de firma HMAC en signed URLs de Bunny.net
- Generación y validación de gift cards

// NO testear:
- Getters y setters simples
- Eloquent relationships (ya están probadas por el framework)
- Filament CRUD básico (confiar en el framework)
```

### 8.2 Nomenclatura de tests
```php
// Patrón: it_{descripcion_en_ingles_o_espanol}
// Archivo: {Recurso}Test.php en tests/Feature/ o tests/Unit/

class EnrollmentTest extends TestCase {
    public function it_generates_unique_matricula_code_on_enrollment_creation(): void
    public function it_activates_enrollment_after_stripe_payment_succeeds(): void
    public function it_blocks_access_when_matricula_is_expired(): void
    public function it_unlocks_next_lesson_after_completing_current_one(): void
}

// Usar Factories para datos de prueba, nunca hardcodear:
$course     = Course::factory()->published()->siigo()->create();
$user       = User::factory()->student()->create();
$enrollment = Enrollment::factory()->active()->for($course)->for($user)->create();
```

### 8.3 Factories
```php
// Siempre con states para los estados del Enum:
class CourseFactory extends Factory {
    public function published(): static {
        return $this->state(['status' => CourseStatus::Published]);
    }
    public function siigo(): static {
        return $this->state(['brand' => ProductBrand::Siigo]);
    }
    public function online(): static {
        return $this->state(['modality' => CourseModality::Online]);
    }
}
```

---

## 9. Seguridad — Checklist por Sprint

Antes de hacer merge de cualquier feature que toque pagos, contenido protegido o datos de usuarios:

```
☐ Ningún secret, API key o password hardcodeado en el código
☐ Todos los inputs validados con Form Request antes de usarse
☐ Webhooks externos verificados con signing_secret (Stripe, Cal.com, Teams)
☐ URLs de contenido son firmadas con expiración (nunca públicas permanentes)
☐ Middleware ValidateMatricula aplicado en todas las rutas de contenido protegido
☐ Rate limiting en rutas de auth y API pública (throttle middleware)
☐ CSRF activo en todos los formularios Livewire (viene por defecto, no desactivar)
☐ Spatie Activity Log registra accesos a contenido con IP y timestamp
☐ APP_DEBUG=false confirmado en staging (nunca revelar stack traces)
☐ No hay rutas o datos sensibles expuestos en el frontend (inspeccionar DevTools)
```

---

## 10. Estándares de Código — Resumen Rápido

| Elemento | Formato | Ejemplo |
|---------|---------|---------|
| Clases | PascalCase | `EnrollmentService` |
| Métodos / funciones | camelCase | `generateMatriculaCode()` |
| Variables | camelCase | `$enrollmentStatus` |
| Tablas DB | plural snake_case | `quiz_attempts` |
| Columnas DB | snake_case | `stripe_payment_intent_id` |
| Enums | PascalCase valor | `EnrollmentStatus::Active` |
| Rutas web | kebab-case | `/mis-cursos` |
| Named routes | punto.separadas | `campus.courses.show` |
| Ramas Git | kebab-case con tipo | `feature/s5-oxxo-pay` |
| Commits | conventional commits | `feat(enrollment): ...` |
| Archivos Blade | kebab-case | `enrollment-confirmation.blade.php` |
| Tests | snake_case descriptivo | `it_generates_matricula_on_enrollment()` |

---

*Manual de Buenas Prácticas — Logia Consulting — v1.0 — Marzo 2026*
*Mantener vivo: actualizar cuando se tome una decisión que contradiga o amplíe este manual.*
