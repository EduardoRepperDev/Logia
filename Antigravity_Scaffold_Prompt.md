# PROMPT DE SCAFFOLDING — LOGIA CONSULTING
# Para ejecutar en Antigravity al inicio del Pre-Sprint

---

## ROL Y OBJETIVO

Eres un agente de desarrollo experto en Laravel 11. Tu misión es generar la estructura completa y funcional de un proyecto real de producción para Logia Consulting. No generes código de ejemplo ni placeholders — genera código real, listo para funcionar, siguiendo exactamente las convenciones especificadas. Al terminar, el proyecto debe levantar con `php artisan serve`, el panel Filament debe cargar en `/admin`, y los seeders deben crear los roles y el super-admin correctamente.

---

## STACK EXACTO

```
Backend:       Laravel 11 + PHP 8.3
Frontend:      Livewire 3 + Alpine.js + Tailwind CSS
Admin Panel:   Filament PHP v3
Base de datos: MySQL 8
Auth + RBAC:   Laravel Sanctum + Spatie/laravel-permission
Pagos:         Laravel Cashier (Stripe) — OXXO Pay + SPEI + tarjeta
Media:         Spatie/laravel-medialibrary + Google Cloud Storage
Auditoría:     Spatie/laravel-activitylog
Backups:       Spatie/laravel-backup
Email:         Resend.com (driver SMTP compatible)
PDF:           barryvdh/laravel-dompdf
CI/CD:         GitHub Actions + Railway (Dockerfile)
```

---

## PASO 1 — INSTALACIÓN DE PAQUETES

Ejecuta en orden:

```bash
composer create-project laravel/laravel logia-consulting "11.*"
cd logia-consulting

composer require \
  filament/filament:"^3.0" \
  livewire/livewire:"^3.0" \
  spatie/laravel-permission \
  spatie/laravel-medialibrary \
  spatie/laravel-activitylog \
  spatie/laravel-backup \
  laravel/cashier \
  laravel/sanctum \
  barryvdh/laravel-dompdf \
  league/flysystem-google-cloud-storage \
  google/cloud-storage

npm install -D tailwindcss @tailwindcss/forms @tailwindcss/typography autoprefixer postcss

php artisan filament:install --panels
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="medialibrary-migrations"
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="activitylog-migrations"
php artisan cashier:install
```

---

## PASO 2 — ESTRUCTURA DE DIRECTORIOS A CREAR

```
app/
├── Filament/
│   ├── Admin/
│   │   ├── Pages/
│   │   │   └── Dashboard.php
│   │   └── Resources/
│   │       ├── UserResource.php
│   │       ├── CourseResource.php
│   │       ├── EnrollmentResource.php
│   │       ├── GiftCardResource.php
│   │       └── LeadResource.php
│   └── Widgets/
│       ├── EnrollmentsChart.php
│       ├── RevenueChart.php
│       └── StatsOverview.php
├── Http/
│   ├── Controllers/
│   │   ├── BookingController.php      # Cal.com webhook + Teams
│   │   ├── PaymentController.php      # Stripe OXXO + SPEI + card
│   │   ├── ContentController.php      # DRM signed URLs
│   │   ├── CertificateController.php  # PDF generation
│   │   ├── MetaWebhookController.php  # Meta API n8n
│   │   └── TeamsWebhookController.php # M365 Copilot transcripts
│   └── Middleware/
│       ├── ValidateMatricula.php
│       └── CheckSubscriptionActive.php
├── Models/
│   ├── User.php
│   ├── Course.php
│   ├── Module.php
│   ├── Lesson.php
│   ├── Enrollment.php
│   ├── Matricula.php
│   ├── Progress.php
│   ├── QuizAttempt.php
│   ├── Certificate.php
│   ├── GiftCard.php
│   ├── GiftCardRedemption.php
│   ├── BookingSlot.php
│   ├── VirtualSession.php
│   ├── SessionTranscript.php
│   └── Lead.php
├── Services/
│   ├── TeamsService.php               # MS Graph API
│   ├── BunnyStreamService.php         # Video + DRM signed URLs
│   ├── GoogleCloudService.php         # GCS signed URLs
│   ├── StripeService.php              # OXXO + SPEI + card
│   ├── CertificateService.php         # 3 tipos de PDF
│   ├── GiftCardService.php
│   └── MetaAdsService.php             # n8n pipeline triggers
├── Enums/
│   ├── CourseModality.php             # online | virtual | presencial
│   ├── CourseStatus.php               # draft | published | archived
│   ├── EnrollmentStatus.php           # pending | active | completed | cancelled
│   ├── PaymentMethod.php              # card | oxxo | spei | gift_card
│   ├── CertificateType.php            # brand | stps | collegiate
│   ├── ProductBrand.php               # siigo | soft_restaurant | zoho_one
│   └── UserRole.php                   # super_admin | admin | coordinator | trainer_senior | trainer_junior | student | guest
└── Observers/
    ├── EnrollmentObserver.php         # genera matrícula al inscribirse
    └── ProgressObserver.php           # desbloqueo progresivo + certificado
```

---

## PASO 3 — MIGRACIONES (ejecutar en este orden)

### 3.1 Modificar tabla users
```php
// Añadir a la migración de users o crear una nueva:
$table->string('phone')->nullable();
$table->string('avatar_url')->nullable();
$table->enum('preferred_product', ['siigo', 'soft_restaurant', 'zoho_one'])->nullable();
$table->string('stripe_id')->nullable()->index();
$table->string('pm_type')->nullable();
$table->string('pm_last_four', 4)->nullable();
$table->timestamp('trial_ends_at')->nullable();
```

### 3.2 Migración: courses
```php
Schema::create('courses', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->enum('modality', ['online', 'virtual', 'presencial']);
    $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
    $table->enum('brand', ['siigo', 'soft_restaurant', 'zoho_one']);
    $table->enum('certificate_type', ['brand', 'stps', 'collegiate'])->default('brand');
    $table->decimal('price', 10, 2)->default(0);
    $table->boolean('is_subscription')->default(false);
    $table->integer('min_completion_percentage')->default(85); // para video
    $table->integer('min_quiz_score')->default(70);           // para quiz
    $table->integer('max_capacity')->nullable();               // modalidad virtual/presencial
    $table->string('location')->nullable();                    // para presencial
    $table->string('city')->nullable();
    $table->timestamp('starts_at')->nullable();
    $table->timestamp('ends_at')->nullable();
    $table->foreignId('instructor_id')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamps();
    $table->softDeletes();
});
```

### 3.3 Migración: modules
```php
Schema::create('modules', function (Blueprint $table) {
    $table->id();
    $table->foreignId('course_id')->constrained()->cascadeOnDelete();
    $table->string('title');
    $table->text('description')->nullable();
    $table->integer('order')->default(0);
    $table->boolean('is_free_preview')->default(false);
    $table->timestamps();
});
```

### 3.4 Migración: lessons
```php
Schema::create('lessons', function (Blueprint $table) {
    $table->id();
    $table->foreignId('module_id')->constrained()->cascadeOnDelete();
    $table->string('title');
    $table->enum('type', ['video', 'pdf', 'text', 'quiz']);
    $table->string('bunny_video_id')->nullable();      // ID en Bunny.net Stream
    $table->string('gcs_file_path')->nullable();       // ruta en Google Cloud Storage
    $table->longText('content')->nullable();           // para tipo text
    $table->integer('duration_seconds')->nullable();   // duración del video
    $table->integer('order')->default(0);
    $table->boolean('is_required')->default(true);     // para desbloqueo progresivo
    $table->timestamps();
});
```

### 3.5 Migración: matriculas
```php
Schema::create('matriculas', function (Blueprint $table) {
    $table->id();
    $table->string('code')->unique(); // formato: LOG-SIIGO-2026-00001
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('course_id')->constrained()->cascadeOnDelete();
    $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
    $table->timestamp('issued_at');
    $table->timestamp('expires_at')->nullable();
    $table->timestamps();
});
```

### 3.6 Migración: enrollments
```php
Schema::create('enrollments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('course_id')->constrained()->cascadeOnDelete();
    $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])->default('pending');
    $table->enum('payment_method', ['card', 'oxxo', 'spei', 'gift_card', 'free'])->nullable();
    $table->string('stripe_payment_intent_id')->nullable();
    $table->string('stripe_subscription_id')->nullable();
    $table->decimal('amount_paid', 10, 2)->default(0);
    $table->string('currency', 3)->default('MXN');
    $table->timestamp('paid_at')->nullable();
    $table->timestamp('expires_at')->nullable();
    $table->timestamps();
    $table->softDeletes();
    $table->unique(['user_id', 'course_id']);
});
```

### 3.7 Migración: progress
```php
Schema::create('progress', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
    $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
    $table->boolean('is_completed')->default(false);
    $table->integer('video_watched_seconds')->default(0);
    $table->integer('video_total_seconds')->default(0);
    $table->decimal('completion_percentage', 5, 2)->default(0);
    $table->timestamp('completed_at')->nullable();
    $table->timestamps();
    $table->unique(['user_id', 'lesson_id']);
});
```

### 3.8 Migración: quiz_attempts
```php
Schema::create('quiz_attempts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('lesson_id')->constrained()->cascadeOnDelete();
    $table->json('answers');
    $table->integer('score');                      // 0-100
    $table->boolean('passed')->default(false);
    $table->integer('attempt_number')->default(1);
    $table->timestamps();
});
```

### 3.9 Migración: certificates
```php
Schema::create('certificates', function (Blueprint $table) {
    $table->id();
    $table->string('uuid')->unique();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('course_id')->constrained()->cascadeOnDelete();
    $table->foreignId('enrollment_id')->constrained()->cascadeOnDelete();
    $table->enum('type', ['brand', 'stps', 'collegiate']);
    $table->string('pdf_path')->nullable();             // ruta en GCS
    $table->string('verification_url')->nullable();     // URL pública de verificación
    $table->string('collegiate_name')->nullable();      // para tipo collegiate
    $table->string('collegiate_logo_path')->nullable();
    $table->json('metadata')->nullable();               // datos adicionales DC-3
    $table->timestamp('issued_at');
    $table->timestamps();
});
```

### 3.10 Migración: gift_cards
```php
Schema::create('gift_cards', function (Blueprint $table) {
    $table->id();
    $table->string('code')->unique();               // UUID generado
    $table->decimal('amount', 10, 2);
    $table->string('currency', 3)->default('MXN');
    $table->boolean('is_used')->default(false);
    $table->foreignId('used_by')->nullable()->constrained('users')->nullOnDelete();
    $table->timestamp('used_at')->nullable();
    $table->timestamp('expires_at')->nullable();
    $table->string('batch_reference')->nullable();  // para generación masiva
    $table->timestamps();
});
```

### 3.11 Migración: booking_slots
```php
Schema::create('booking_slots', function (Blueprint $table) {
    $table->id();
    $table->foreignId('instructor_id')->nullable()->constrained('users')->nullOnDelete();
    $table->enum('type', ['asesoria', 'soporte', 'demo', 'capacitacion', 'virtual_class']);
    $table->enum('brand', ['siigo', 'soft_restaurant', 'zoho_one', 'general']);
    $table->timestamp('starts_at');
    $table->timestamp('ends_at');
    $table->boolean('is_available')->default(true);
    $table->foreignId('booked_by')->nullable()->constrained('users')->nullOnDelete();
    $table->string('client_name')->nullable();
    $table->string('client_email')->nullable();
    $table->string('client_phone')->nullable();
    $table->string('teams_meeting_id')->nullable();
    $table->string('teams_join_url')->nullable();
    $table->timestamps();
});
```

### 3.12 Migración: session_transcripts
```php
Schema::create('session_transcripts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('booking_slot_id')->constrained()->cascadeOnDelete();
    $table->foreignId('course_id')->nullable()->constrained()->nullOnDelete();
    $table->text('summary')->nullable();            // resumen de M365 Copilot
    $table->longText('transcript')->nullable();     // transcripción completa
    $table->string('recording_url')->nullable();    // URL de la grabación en Teams
    $table->integer('duration_minutes')->nullable();
    $table->json('attendees')->nullable();
    $table->timestamps();
});
```

### 3.13 Migración: leads
```php
Schema::create('leads', function (Blueprint $table) {
    $table->id();
    $table->string('name')->nullable();
    $table->string('email')->nullable();
    $table->string('phone')->nullable();
    $table->enum('product', ['siigo', 'soft_restaurant', 'zoho_one']);
    $table->enum('audience_type', ['contador', 'cfo_pyme', 'restaurantero', 'gerente_fb', 'director_ti', 'gerente_ops']);
    $table->string('meta_ad_id')->nullable();
    $table->string('meta_campaign_id')->nullable();
    $table->string('landing_page')->nullable();
    $table->enum('status', ['new', 'contacted', 'qualified', 'enrolled', 'lost'])->default('new');
    $table->text('notes')->nullable();
    $table->timestamp('meta_created_at')->nullable();
    $table->timestamps();
});
```

---

## PASO 4 — ROLES Y PERMISOS (DatabaseSeeder)

```php
// database/seeders/RolePermissionSeeder.php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

$roles = [
    'super-admin',
    'admin',
    'coordinator',
    'trainer-senior',
    'trainer-junior',
    'student',
    'guest',
];

$permissions = [
    // Cursos
    'courses.view', 'courses.create', 'courses.edit', 'courses.delete',
    // Módulos y lecciones
    'modules.manage', 'lessons.manage',
    // Usuarios
    'users.view', 'users.create', 'users.edit', 'users.delete',
    // Inscripciones
    'enrollments.view', 'enrollments.manage',
    // Matrículas
    'matriculas.view',
    // Reportes
    'reports.view', 'reports.export',
    // Pagos
    'payments.view', 'payments.refund',
    // Gift cards
    'gift_cards.create', 'gift_cards.view',
    // Certificados
    'certificates.generate', 'certificates.view',
    // Agendado
    'bookings.view', 'bookings.manage',
    // Leads
    'leads.view', 'leads.manage',
    // Config
    'settings.manage',
    // Contenido propio (trainer)
    'own_courses.manage',
    'own_groups.view',
    'materials.download',
];

// Crear todos
foreach ($permissions as $perm) {
    Permission::firstOrCreate(['name' => $perm]);
}
foreach ($roles as $role) {
    Role::firstOrCreate(['name' => $role]);
}

// Asignar permisos por rol
Role::findByName('super-admin')->givePermissionTo(Permission::all());

Role::findByName('admin')->givePermissionTo([
    'courses.view','courses.create','courses.edit',
    'modules.manage','lessons.manage',
    'users.view','users.create','users.edit',
    'enrollments.view','enrollments.manage',
    'matriculas.view','reports.view','reports.export',
    'payments.view','payments.refund',
    'gift_cards.create','gift_cards.view',
    'certificates.generate','certificates.view',
    'bookings.view','bookings.manage',
    'leads.view','leads.manage',
    'settings.manage',
]);

Role::findByName('coordinator')->givePermissionTo([
    'courses.view','users.view',
    'enrollments.view','enrollments.manage',
    'matriculas.view','reports.view',
    'certificates.view','bookings.view','bookings.manage',
]);

Role::findByName('trainer-senior')->givePermissionTo([
    'own_courses.manage','own_groups.view',
    'materials.download','certificates.view',
]);

Role::findByName('trainer-junior')->givePermissionTo([
    'own_groups.view','certificates.view',
]);

Role::findByName('student')->givePermissionTo([
    'matriculas.view','certificates.view',
]);

// Super admin seeder
$superAdmin = \App\Models\User::firstOrCreate(
    ['email' => 'admin@logiaconsulting.com'],
    [
        'name'     => 'Super Admin',
        'password' => bcrypt('LogiaAdmin2026!'), // ← CAMBIAR ANTES DE PRODUCCIÓN
        'email_verified_at' => now(),
    ]
);
$superAdmin->assignRole('super-admin');
```

---

## PASO 5 — MODELOS CLAVE

### User.php
```php
use HasRoles, HasApiTokens, HasFactory, Notifiable, Billable;
// Billable = Laravel Cashier
// HasRoles = Spatie Permission
// HasApiTokens = Sanctum

// Relaciones:
public function enrollments(): HasMany
public function matriculas(): HasMany
public function progress(): HasMany
public function certificates(): HasMany
public function bookingsAsStudent(): HasMany  // booking_slots.booked_by
public function bookingsAsInstructor(): HasMany  // booking_slots.instructor_id
public function ownCourses(): HasMany  // courses.instructor_id
```

### Course.php
```php
use SoftDeletes, HasMedia;
// HasMedia = Spatie MediaLibrary (thumbnail, cover, materials)

// Relaciones:
public function modules(): HasMany + orderBy('order')
public function enrollments(): HasMany
public function instructor(): BelongsTo (User)

// Media collections:
public function registerMediaCollections(): void {
    $this->addMediaCollection('thumbnail')->singleFile();
    $this->addMediaCollection('cover')->singleFile();
}

// Scopes:
public function scopePublished($q): void
public function scopeByBrand($q, string $brand): void
public function scopeByModality($q, string $modality): void
```

### Enrollment.php
```php
// Relaciones:
public function user(): BelongsTo
public function course(): BelongsTo
public function matricula(): HasOne
public function progress(): HasMany
public function certificate(): HasOne

// Accessor:
public function getOverallProgressAttribute(): float
// calcula % promedio de lecciones completadas
```

### Matricula.php
```php
// Auto-genera el código en el Observer:
// formato: LOG-{BRAND}-{YEAR}-{SEQUENCE_PADDED_5}
// ejemplo: LOG-SIIGO-2026-00001, LOG-SOFT-2026-00003, LOG-ZOHO-2026-00012
```

---

## PASO 6 — SERVICIOS CRÍTICOS (esqueleto funcional)

### TeamsService.php
```php
class TeamsService {
    private string $tenantId;
    private string $clientId;
    private string $clientSecret;
    private string $organizerId; // user ID del organizador en M365

    public function getAccessToken(): string
    // Llama a: POST https://login.microsoftonline.com/{tenant}/oauth2/v2.0/token

    public function createMeeting(array $data): array
    // POST https://graph.microsoft.com/v1.0/users/{organizerId}/onlineMeetings
    // Retorna: ['join_url' => ..., 'meeting_id' => ...]

    public function getMeetingTranscript(string $meetingId): ?array
    // GET https://graph.microsoft.com/v1.0/users/{organizerId}/onlineMeetings/{meetingId}/transcripts
    // Retorna: ['summary' => ..., 'transcript' => ...]
}
```

### BunnyStreamService.php
```php
class BunnyStreamService {
    public function getSignedUrl(string $videoId, string $matriculaCode): string
    // Genera URL firmada con expiración de 2 horas
    // Parámetro token = HMAC-SHA256(videoId + matricula + expires, API_KEY)

    public function uploadVideo(string $filePath, string $title): string
    // POST a Bunny.net Stream API
    // Retorna: videoId

    public function getVideoDetails(string $videoId): array
    // GET /library/{libraryId}/videos/{videoId}
}
```

### CertificateService.php
```php
class CertificateService {
    public function generate(Enrollment $enrollment): Certificate
    // 1. Determina el tipo según $enrollment->course->certificate_type
    // 2. Carga el blade template correspondiente
    // 3. Genera PDF con DomPDF
    // 4. Sube a GCS
    // 5. Crea registro Certificate con UUID y verification_url
    // 6. Retorna el Certificate

    private function generateBrand(Enrollment $e): string  // blade: certificates.brand
    private function generateStps(Enrollment $e): string   // blade: certificates.stps
    private function generateCollegiate(Enrollment $e): string // blade: certificates.collegiate
}
```

### StripeService.php
```php
class StripeService {
    public function createPaymentIntent(Course $course, User $user, string $method): array
    // $method = 'card' | 'oxxo' | 'customer_balance' (SPEI)
    // OXXO: payment_method_types: ['oxxo'], expires en 3 días
    // SPEI: payment_method_types: ['customer_balance']

    public function handleWebhook(Request $request): void
    // Verifica signing_secret antes de procesar
    // payment_intent.succeeded → activa enrollment
    // payment_intent.payment_failed → cancela pending enrollment
}
```

---

## PASO 7 — OBSERVERS

### EnrollmentObserver.php
```php
public function created(Enrollment $enrollment): void
{
    // Genera matrícula automáticamente
    $brand = strtoupper(substr($enrollment->course->brand, 0, 4));
    $year  = now()->year;
    $seq   = Matricula::whereYear('created_at', $year)->count() + 1;
    $code  = sprintf('LOG-%s-%d-%05d', $brand, $year, $seq);

    Matricula::create([
        'code'          => $code,
        'user_id'       => $enrollment->user_id,
        'course_id'     => $enrollment->course_id,
        'enrollment_id' => $enrollment->id,
        'issued_at'     => now(),
    ]);

    // Log de auditoría
    activity('enrollment')
        ->performedOn($enrollment)
        ->causedBy($enrollment->user)
        ->log('Matrícula generada: ' . $code);
}
```

### ProgressObserver.php
```php
public function updated(Progress $progress): void
{
    if ($progress->is_completed && $progress->wasChanged('is_completed')) {
        $enrollment = $progress->enrollment;

        // Calcular progreso total
        $totalLessons     = $enrollment->course->modules->flatMap->lessons->count();
        $completedLessons = Progress::where('enrollment_id', $enrollment->id)
                                    ->where('is_completed', true)->count();

        $percentage = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;

        if ($percentage >= 100) {
            $enrollment->update(['status' => 'completed']);
            // Generar certificado
            app(CertificateService::class)->generate($enrollment);
        }
    }
}
```

---

## PASO 8 — RUTAS CLAVE (routes/web.php y routes/api.php)

```php
// web.php — campus e-learning
Route::prefix('campus')->name('campus.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [CampusController::class, 'dashboard'])->name('dashboard');
    Route::get('/courses/{course}', [CampusController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/lesson/{lesson}', [CampusController::class, 'lesson'])
         ->middleware(['validate.matricula', 'check.subscription'])->name('lesson');
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'store'])->name('enroll');
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates');
    Route::get('/certificates/{uuid}/download', [CertificateController::class, 'download'])->name('certificates.download');
});

// Contenido protegido (URLs firmadas)
Route::get('/content/video/{videoId}/signed-url', [ContentController::class, 'videoSignedUrl'])
     ->middleware(['auth', 'validate.matricula'])->name('content.video.signed');
Route::get('/content/pdf/{lessonId}/view', [ContentController::class, 'pdfViewer'])
     ->middleware(['auth', 'validate.matricula'])->name('content.pdf.view');

// Agendado
Route::post('/webhooks/calcom', [BookingController::class, 'handleCalcom']); // sin auth, verificar secret
Route::post('/webhooks/teams', [TeamsWebhookController::class, 'handle']);   // sin auth, verificar token

// Pagos
Route::post('/webhooks/stripe', [PaymentController::class, 'webhook']); // sin auth, verificar signing_secret
Route::get('/checkout/{course}', [PaymentController::class, 'checkout'])->middleware('auth')->name('checkout');
Route::get('/checkout/success/{enrollment}', [PaymentController::class, 'success'])->middleware('auth');

// Verificación de certificados (pública)
Route::get('/verify/{uuid}', [CertificateController::class, 'verify'])->name('certificates.verify');

// API (para n8n + Meta)
Route::prefix('api/v1')->middleware('auth:sanctum')->group(function () {
    Route::post('/leads', [MetaWebhookController::class, 'storeLead']);
    Route::get('/metrics/leads', [MetaWebhookController::class, 'metrics']);
    Route::get('/metrics/enrollments', [EnrollmentController::class, 'metrics']);
});
```

---

## PASO 9 — MIDDLEWARE PERSONALIZADOS

### ValidateMatricula.php
```php
public function handle(Request $request, Closure $next): Response
{
    $user       = $request->user();
    $lesson     = $request->route('lesson');
    $course     = $lesson ? $lesson->module->course : $request->route('course');

    $enrollment = Enrollment::where('user_id', $user->id)
                             ->where('course_id', $course->id)
                             ->where('status', 'active')
                             ->first();

    if (!$enrollment) {
        abort(403, 'Sin acceso: matrícula no encontrada o suscripción vencida.');
    }

    // Verificar desbloqueo progresivo si hay lección específica
    if ($lesson && $lesson->is_required) {
        $previousLesson = $lesson->module->lessons()
                                         ->where('order', '<', $lesson->order)
                                         ->orderByDesc('order')
                                         ->first();
        if ($previousLesson) {
            $prevProgress = Progress::where('user_id', $user->id)
                                     ->where('lesson_id', $previousLesson->id)
                                     ->first();
            if (!$prevProgress || !$prevProgress->is_completed) {
                abort(403, 'Completa la lección anterior para continuar.');
            }
        }
    }

    // Log de auditoría
    activity('content_access')
        ->causedBy($user)
        ->withProperties(['course_id' => $course->id, 'lesson_id' => $lesson?->id, 'ip' => $request->ip()])
        ->log('Acceso a contenido');

    return $next($request);
}
```

---

## PASO 10 — CONFIGURACIÓN FILAMENT (AdminPanelProvider.php)

```php
->id('admin')
->path('admin')
->login()
->colors(['primary' => Color::Blue])
->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
->widgets([
    Widgets\AccountWidget::class,
    Filament\Widgets\StatsOverview::class,
    App\Filament\Widgets\EnrollmentsChart::class,
    App\Filament\Widgets\RevenueChart::class,
])
->middleware(['auth', 'verified'])
->authMiddleware([Authenticate::class])
->authGuard('web')
->navigationGroups([
    NavigationGroup::make('Académico')->icon('heroicon-o-academic-cap'),
    NavigationGroup::make('Ventas')->icon('heroicon-o-currency-dollar'),
    NavigationGroup::make('Marketing')->icon('heroicon-o-megaphone'),
    NavigationGroup::make('Configuración')->icon('heroicon-o-cog-6-tooth'),
])
```

---

## PASO 11 — VARIABLES DE ENTORNO (.env.example)

```env
APP_NAME="Logia Consulting"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://logiaconsulting.com

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=logia_consulting
DB_USERNAME=
DB_PASSWORD=

# Stripe
STRIPE_KEY=pk_live_...
STRIPE_SECRET=sk_live_...
STRIPE_WEBHOOK_SECRET=whsec_...

# Microsoft Graph API (Teams + M365 Copilot)
AZURE_TENANT_ID=
AZURE_CLIENT_ID=
AZURE_CLIENT_SECRET=
TEAMS_ORGANIZER_USER_ID=
CALCOM_WEBHOOK_SECRET=

# Bunny.net Stream
BUNNY_STREAM_LIBRARY_ID=
BUNNY_STREAM_API_KEY=
BUNNY_STREAM_CDN_HOSTNAME=  # ej: vz-xxxxx.b-cdn.net
BUNNY_STREAM_DRM_ENABLED=true  # false = Escenario B

# Google Cloud Storage
GCS_PROJECT_ID=
GCS_BUCKET=
GCS_KEY_FILE_PATH=storage/app/gcs-credentials.json

# Resend (email)
RESEND_API_KEY=
MAIL_FROM_ADDRESS=noreply@logiaconsulting.com
MAIL_FROM_NAME="Logia Consulting"

# Meta Business API (para n8n — consumido vía HTTP desde n8n, no desde Laravel directamente)
META_APP_ID=
META_APP_SECRET=
META_ACCESS_TOKEN=

# Cal.com
CALCOM_API_KEY=
CALCOM_WEBHOOK_SECRET=

# Cloudflare
CLOUDFLARE_ZONE_ID=
CLOUDFLARE_API_TOKEN=

# Filament
FILAMENT_ADMIN_EMAIL=admin@logiaconsulting.com

# Backups (spatie/laravel-backup)
BACKUP_DISK=gcs
BACKUP_NOTIFICATION_EMAIL=sistemas@logiaconsulting.com
```

---

## PASO 12 — COMANDOS FINALES DE VERIFICACIÓN

```bash
php artisan migrate:fresh --seed
php artisan filament:make-user  # o usar el seeder
php artisan storage:link
php artisan config:clear
php artisan route:list --path=campus
php artisan route:list --path=api
php artisan serve

# Verificar:
# - http://localhost:8000/admin → debe cargar Filament con el super-admin
# - http://localhost:8000/campus → debe redirigir a login
# - php artisan role:list → debe mostrar los 7 roles
# - php artisan permission:list → debe mostrar todos los permisos
```

---

## NOTAS PARA ANTIGRAVITY

1. **No generes código de ejemplo** — todo debe ser funcional.
2. **Sigue las convenciones**: Services para lógica, Form Requests para validación, Observers para efectos secundarios, Enums para estados.
3. **Nunca hardcodees secrets** — todo va en `.env` y se accede con `config()`.
4. **Cada migración debe tener su método `down()`** correctamente implementado.
5. **Los Observers deben registrarse** en `AppServiceProvider::boot()`.
6. **El scaffolding es el punto de partida** — los Livewire components y las vistas de Blade se construirán sprint a sprint. Lo que generas aquí es la base arquitectónica.
7. **Prioridad**: que compile, migre y seedee sin errores. La funcionalidad detallada se agrega sprint a sprint.
