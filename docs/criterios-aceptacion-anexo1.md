# CRITERIOS DE ACEPTACIÓN — ANEXO 1
## Renovación Digital Integral · Logia Consulting

**Documento de soporte al contrato** — define los criterios objetivos y verificables bajo los cuales cada entregable del proyecto se considera **aceptado** por el cliente.
**Versión:** 1.0 · **Fecha:** 29 de abril de 2026 · **Partes:** Oscar Eduardo Repper Horta (Desarrollador) / Logia Consulting (Cliente)

---

## 1. Reglas generales de aceptación

**1.1 Cómo se acepta un entregable.**
Un entregable se considera **aceptado** únicamente cuando el 100% de sus criterios marcados con prioridad `BLOQUEANTE` pasan la verificación documentada. Los criterios `MENORES` pueden quedar como observaciones a corregir dentro de los 30 días de garantía sin bloquear el cierre de fase.

**1.2 Plazos de revisión.**
Logia Consulting cuenta con **5 días hábiles** desde la presentación formal del entregable para revisar y emitir respuesta por escrito (aprobación, observaciones o rechazo). Transcurrido ese plazo sin respuesta, el entregable se considera **aprobado tácitamente** según la cláusula 8 del Plan de Trabajo.

**1.3 Formato de validación.**
Cada entregable se entrega acompañado de una **bitácora de pruebas** firmada por el desarrollador, donde cada criterio aparece con resultado `PASA / FALLA / N/A` y evidencia adjunta (capturas, URLs de prueba, logs, archivos exportados según corresponda). El cliente firma esa bitácora al aceptar.

**1.4 Manejo de no-conformidades.**
Si un criterio bloqueante falla, el desarrollador tiene **5 días hábiles** para corregir y volver a presentar. Si tras dos ciclos de corrección sigue sin pasar, las partes se reúnen para definir si: (a) el criterio se ajusta por imposibilidad técnica documentada, (b) se reemplaza por una alternativa equivalente, o (c) se escala al control de cambios.

**1.5 Subjetividad y diseño visual.**
Los criterios de "aspecto visual" se validan contra los **wireframes y prototipos aprobados en el Ciclo de Preparación**. Una vez aprobado el prototipo de cada sección, el resultado de implementación se valida contra ese prototipo, no contra una preferencia estética sobreviniente. Cambios estéticos posteriores a la aprobación del prototipo entran al control de cambios.

**1.6 Estructura de cada criterio.**
Cada criterio se enuncia con esta estructura:

| Campo | Significado |
|---|---|
| **ID** | Código único: F[fase]-[entregable]-[número] |
| **Criterio** | Enunciado verificable, en positivo, sin ambigüedad |
| **Método de verificación** | Acción concreta para probarlo |
| **Resultado esperado** | Lo que debe ocurrir para que pase |
| **Prioridad** | BLOQUEANTE (impide cierre) / MENOR (queda como observación) |
| **Responsable** | Quién valida (Desarrollador / Cliente / Ambos) |

---

## 2. Criterios transversales (aplican a todo el sistema)

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **TR-001** | El sitio responde sin error 4xx/5xx en la home, las 3 secciones de marca y todas las URLs públicas. | Crawler automatizado (Screaming Frog / similar) recorre el sitemap y reporta status. | 100% de URLs devuelven 200 o 301. Cero 404, 500. | BLOQUEANTE |
| **TR-002** | El sitio carga en menos de 3 segundos (Largest Contentful Paint) en conexión 4G simulada. | Google PageSpeed Insights / Lighthouse en home, 3 productos representativos y campus. | LCP ≤ 3.0 s en mobile, ≤ 2.0 s en desktop. CLS ≤ 0.1. | BLOQUEANTE |
| **TR-003** | El sitio es responsive sin scroll horizontal en breakpoints estándar. | Pruebas en Chrome DevTools a 375 px (iPhone SE), 768 px (tablet), 1024 px, 1440 px y 1920 px. | Cero scroll horizontal. Todo el contenido legible y operable. | BLOQUEANTE |
| **TR-004** | El sitio cumple WCAG 2.1 nivel AA en páginas públicas. | Auditoría con axe DevTools + revisión manual de focus, contraste y navegación por teclado. | Cero violaciones críticas. Ratio de contraste ≥ 4.5:1 en texto. Tab order lógico. | BLOQUEANTE |
| **TR-005** | El sitio pasa la auditoría SEO técnica de Lighthouse. | Lighthouse SEO en home y 5 páginas representativas. | Score ≥ 90/100. Meta titles, descriptions, h1 únicos, sitemap.xml válido, robots.txt presente. | BLOQUEANTE |
| **TR-006** | El sitio tiene HTTPS forzado y certificado SSL válido. | curl -I y validación SSL Labs. | Redirección HTTP→HTTPS 301. Certificado A o A+ en SSL Labs. HSTS activo. | BLOQUEANTE |
| **TR-007** | El sitio respeta la política mexicana de protección de datos (LFPDPPP). | Revisión de aviso de privacidad publicado, banner de cookies y formularios. | Aviso de privacidad accesible desde footer. Banner de cookies con opciones aceptar/rechazar. Formularios con casilla de consentimiento explícito. | BLOQUEANTE |
| **TR-008** | El navegador no muestra warnings de mixed content ni recursos bloqueados en consola. | DevTools → Console en home y 5 páginas. | Cero warnings/errors críticos en consola del navegador. | MENOR |
| **TR-009** | El código del proyecto está versionado en Git con historial limpio. | Inspección del repositorio Git al cierre de cada fase. | Commits descriptivos. Branch `main` estable. README con instrucciones de setup local. | BLOQUEANTE |
| **TR-010** | El sistema cuenta con respaldos automáticos diarios de base de datos. | Verificación de configuración de backups en Railway + prueba de restauración en staging. | Backup diario automatizado de los últimos 7 días disponibles. Prueba de restore exitosa documentada. | BLOQUEANTE |

---

## 3. FASE 1 — Sitio Web Corporativo

### 3.1 Sistema de identidades visuales por producto (Brand Chameleon)

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F1-IV-001** | Cada marca (Logia, Aspel, Soft-Restaurant, Zoho, Microsoft 365) renderiza con su paleta exacta definida en el manual de marca. | Inspección visual + DevTools → ver `data-brand` y CSS variables aplicadas. | Aspel #1B4DB7, Soft-Restaurant #E8500A, Zoho #C8202C aplicados en primary, accents y CTAs según tokens. | BLOQUEANTE |
| **F1-IV-002** | Al navegar de una sección a otra (Logia → Aspel → Soft → Zoho) el cambio de identidad ocurre sin parpadeo ni reflujo de layout. | Navegación manual entre secciones con DevTools Performance abierto. | Transición fluida, sin layout shift visible. CLS ≤ 0.1 en navegación. | BLOQUEANTE |
| **F1-IV-003** | El logo de Logia se mantiene fijo en navbar y footer en todas las marcas. | Inspección visual en cada landing de marca. | Logo de Logia siempre visible y clickable hacia /. La marca del partner aparece como contenido, no reemplaza al de Logia. | BLOQUEANTE |
| **F1-IV-004** | Los logos oficiales de los partners aparecen únicamente en zonas autorizadas por sus respectivos manuales de marca. | Comparación contra brand kits oficiales recibidos del cliente. | Logos en alta resolución, sin distorsión, con espaciado mínimo respetado, sobre fondos permitidos. | BLOQUEANTE |
| **F1-IV-005** | Las microanimaciones (hover, transiciones) duran ≤ 300 ms y respetan `prefers-reduced-motion`. | DevTools + simulación de reduced motion. | Animaciones fluidas. Con reduced motion activo, las animaciones se suprimen o se simplifican. | MENOR |

### 3.2 Catálogo de productos

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F1-CAT-001** | Cada producto Aspel listado en el Plan (SAE, COI, NOI, CAJA, FACTURE, BANCO, PROD, Siigo Nube, Siigo Fiscal, Aspel Nube) tiene su propia página individual con URL única. | Visita manual a las 10 URLs + verificación de sitemap.xml. | 10 URLs únicas, indexables, con contenido original (no plantilla genérica). | BLOQUEANTE |
| **F1-CAT-002** | Cada página de producto contiene: nombre, descripción ≥ 80 palabras, lista de características, planes/precios y CTA de compra/cotización. | Revisión manual de las 10 páginas Aspel + 1 Soft + 1 Zoho. | Los 5 elementos presentes en cada página. CTA visible sobre la línea de pliegue (above the fold). | BLOQUEANTE |
| **F1-CAT-003** | El comparador de productos permite seleccionar mínimo 2 productos del mismo partner y muestra sus diferencias en una tabla. | Uso manual del comparador en Aspel y en Zoho. | Comparativa funcional, tabla legible, máximo 4 productos comparables a la vez. | BLOQUEANTE |
| **F1-CAT-004** | Un usuario administrador puede editar el contenido de una página de producto desde Filament sin tocar código. | Cliente edita un texto de prueba en Filament y verifica el cambio en producción en ≤ 5 minutos. | El cambio aparece en la página pública sin intervención del desarrollador. | BLOQUEANTE |
| **F1-CAT-005** | El equipo de Logia puede subir/reemplazar imágenes de producto desde Filament con validación de formato y tamaño. | Cliente sube una imagen JPG/PNG ≤ 2 MB y verifica resultado. | Imagen optimizada automáticamente (WebP servido al cliente final). Imágenes > 5 MB son rechazadas con mensaje claro. | BLOQUEANTE |

### 3.3 Sistema de agendado inteligente (Cal.com + Microsoft Teams)

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F1-AG-001** | Un cliente puede agendar una asesoría desde el sitio en ≤ 90 segundos sin crear cuenta. | Prueba cronometrada con usuario nuevo. | El usuario completa el flujo (selección de tipo de cita → fecha → hora → datos → confirmación) en menos de 90 s. | BLOQUEANTE |
| **F1-AG-002** | Al confirmar la cita, el sistema genera automáticamente un evento en Microsoft Teams con enlace de reunión. | Agendar una cita de prueba y validar en Outlook/Teams del staff. | Evento aparece en el calendario asignado. Enlace de Teams válido y accesible al cliente y al consultor. | BLOQUEANTE |
| **F1-AG-003** | El cliente recibe correo de confirmación con la cita en ≤ 2 minutos tras agendar. | Agendar con un email real y revisar bandeja. | Correo recibido desde dominio @logiaconsulting.com (Resend). Incluye enlace de Teams y opción de cancelar. | BLOQUEANTE |
| **F1-AG-004** | El equipo de Logia puede configurar disponibilidad (días, horarios, tipos de cita) desde el panel sin programación. | Cliente cambia horario disponible y agenda una cita en el horario nuevo. | El cambio se refleja en el sitio público inmediatamente. | BLOQUEANTE |
| **F1-AG-005** | Si un slot ya está ocupado, el sistema lo deshabilita en tiempo real y muestra mensaje claro. | Agendar 2 citas simultáneas en navegadores distintos. | Solo una se confirma. La segunda muestra "este horario ya no está disponible". | BLOQUEANTE |
| **F1-AG-006** | Cancelar una cita libera el slot automáticamente y notifica a ambas partes. | Cancelar una cita de prueba. | Slot vuelve a estar disponible. Cliente y consultor reciben correo de cancelación. | BLOQUEANTE |

### 3.4 Sistema de pagos mexicanos (Stripe)

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F1-PG-001** | El sistema procesa correctamente pagos con tarjeta Visa/Mastercard/AMEX en moneda MXN. | Pago de prueba con tarjetas reales (test mode primero, luego live con monto pequeño). | Pago acreditado en Stripe Dashboard. El acceso/recibo se entrega en ≤ 1 minuto. | BLOQUEANTE |
| **F1-PG-002** | El sistema genera vouchers OXXO Pay con código de barras válido. | Generar voucher de prueba y validar en OXXO físico (o con la app de Stripe). | Voucher imprimible/visible, con vigencia de 3 días, monto correcto y código de barras escaneable. | BLOQUEANTE |
| **F1-PG-003** | El acceso al producto comprado se activa automáticamente al confirmarse el pago OXXO. | Pagar en OXXO real y verificar activación en ≤ 30 minutos hábiles. | El usuario ve su acceso activo en su panel. Recibe correo de confirmación. | BLOQUEANTE |
| **F1-PG-004** | El sistema procesa pagos SPEI con CLABE única por transacción. | Generar instrucción de pago SPEI y validar en Stripe Dashboard. | CLABE única generada. Al recibir el SPEI, el acceso se activa automáticamente. | BLOQUEANTE |
| **F1-PG-005** | Si un pago falla (tarjeta declinada, OXXO vencido), el cliente recibe mensaje claro y puede reintentar sin perder los datos. | Simulación con tarjeta de prueba declinada de Stripe. | Mensaje "no se pudo procesar tu pago, intenta de nuevo o usa otro método". El carrito se preserva. | BLOQUEANTE |
| **F1-PG-006** | Logia puede emitir reembolsos completos o parciales desde el panel de administración. | Reembolso de prueba de un pago de prueba. | Reembolso registrado. Cliente recibe correo de notificación. El acceso se revoca si aplica. | BLOQUEANTE |
| **F1-PG-007** | El sistema genera códigos de gift card desde el panel y permite canjearlos en checkout. | Generar 3 códigos, canjear 1, intentar canjear el mismo dos veces. | El primer canje funciona, el segundo intento del mismo código se rechaza con mensaje claro. | BLOQUEANTE |
| **F1-PG-008** | Todas las transacciones quedan registradas con: usuario, monto, método, fecha, status, ID Stripe y referencia interna. | Revisión de la tabla de transacciones en Filament. | Tabla completa, exportable a CSV/Excel para conciliación contable. | BLOQUEANTE |

### 3.5 Landing pages de conversión

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F1-LP-001** | Existen 3 landing pages independientes (una por producto: Aspel, Soft-Restaurant, Zoho), cada una con URL única indexable. | Visita a las 3 URLs. | 3 URLs activas con `noindex` opcional configurable, sin menú de navegación principal, con un solo CTA primario visible. | BLOQUEANTE |
| **F1-LP-002** | Cada landing tiene un único objetivo de conversión (formulario o agendado) sin distracciones. | Inspección visual y de UX. | Cero links salientes. Header simplificado o ausente. CTA repetido máximo 3 veces. | BLOQUEANTE |
| **F1-LP-003** | Cada landing carga en menos de 2.5 segundos (LCP) en mobile. | Lighthouse mobile en las 3 landings. | LCP ≤ 2.5 s. Score Performance ≥ 85. | BLOQUEANTE |
| **F1-LP-004** | Los formularios envían los datos a un destino verificable (panel + correo + opcionalmente CRM). | Llenar formulario en cada landing. | El lead aparece en panel admin de Logia ≤ 30 s. Correo de notificación al equipo de ventas. | BLOQUEANTE |
| **F1-LP-005** | Las landings tienen pixel de Meta y GA4 instalados y disparan eventos de conversión. | Meta Pixel Helper + GA4 DebugView. | Eventos `Lead` y `PageView` se disparan correctamente. | BLOQUEANTE |

### 3.6 Blog y posicionamiento SEO

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F1-SEO-001** | El equipo de Logia puede crear, editar, programar y publicar entradas de blog desde Filament sin código. | Cliente crea una entrada de prueba con imagen, formato, categoría y la programa para mañana. | Entrada visible en `/blog` en la fecha programada. SEO meta editable por entrada. | BLOQUEANTE |
| **F1-SEO-002** | Cada entrada de blog y cada página de producto tiene meta-title, meta-description y schema.org estructurado. | Inspección con Rich Results Test de Google. | Cero errores en Rich Results. Title ≤ 60 caracteres. Description ≤ 160 caracteres. Schema válido (`Article`, `Product`, `Organization`, `BreadcrumbList`). | BLOQUEANTE |
| **F1-SEO-003** | Existen redirecciones 301 desde las URLs antiguas del sitio anterior hacia las nuevas equivalentes. | Lista de URLs antiguas (la entrega Logia) probada con curl. | 100% de URLs antiguas devuelven 301 a una URL nueva relevante. Cero 404. | BLOQUEANTE |
| **F1-SEO-004** | Google Analytics 4 y Google Tag Manager están instalados y reportan tráfico real. | Verificación en GA4 Realtime durante una visita. | Sesión visible en tiempo real. Eventos `page_view`, `scroll`, `click` registrándose. | BLOQUEANTE |
| **F1-SEO-005** | El sitio tiene `sitemap.xml` accesible y enviado a Google Search Console. | Visita a `/sitemap.xml` y revisión de Search Console. | Sitemap válido, ≥ 95% de URLs indexadas dentro de los 30 días post-launch. | BLOQUEANTE |
| **F1-SEO-006** | Las imágenes del sitio tienen atributo `alt` descriptivo y se sirven en formato moderno (WebP/AVIF) con fallback. | DevTools Network + axe DevTools. | Cero imágenes sin alt en contenido. Imágenes en WebP/AVIF con fallback automático según browser. | MENOR |

### 3.7 Aprobación formal de Fase 1 (Ciclo 6 — 15 de junio de 2026)

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F1-CIERRE-001** | Todos los criterios `BLOQUEANTE` de las secciones 3.1 a 3.6 pasan en bitácora de pruebas firmada. | Recorrido conjunto cliente-desarrollador con la bitácora. | 100% de criterios BLOQUEANTE en estado PASA. | BLOQUEANTE |
| **F1-CIERRE-002** | El sitio está desplegado en producción (logiaconsulting.com) con DNS apuntando correctamente. | dig + visita pública. | DNS resolviendo. SSL válido. Sitio respondiendo bajo el dominio definitivo. | BLOQUEANTE |
| **F1-CIERRE-003** | El cliente confirma haber accedido al panel Filament y haber editado contenido sin asistencia. | Sesión de validación grabada. | Cliente edita 1 producto, 1 entrada de blog y crea 1 horario sin ayuda. | BLOQUEANTE |

---

## 4. FASE 2 — Plataforma E-Learning (Campus Virtual)

### 4.1 Sistema de matrículas diferenciadas

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F2-MAT-001** | Cada inscripción a un curso genera una matrícula única en formato `LOG-[PRODUCTO]-[AÑO]-[SECUENCIAL]`. | Inscribir 3 estudiantes a 3 cursos distintos y revisar matrículas. | Formato exacto. Cero duplicados. Secuencia incremental. | BLOQUEANTE |
| **F2-MAT-002** | La matrícula se valida en cada acceso a contenido protegido (real-time check contra suscripción activa). | Suspender una matrícula y verificar que el acceso se bloquea en ≤ 60 s. | Acceso bloqueado con mensaje "tu suscripción no está activa". Cliente puede reactivar pagando. | BLOQUEANTE |
| **F2-MAT-003** | La matrícula aparece embebida en el certificado emitido. | Generar certificado de prueba. | PDF muestra número de matrícula visible y consultable. | BLOQUEANTE |

### 4.2 Modalidades de formación

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F2-MOD-001** | **Presencial:** El estudiante puede ver el calendario de fechas/sedes, inscribirse a una específica y descargar materiales. | Recorrido completo de inscripción presencial. | Calendario funcional. Inscripción registrada. Materiales descargables (si la modalidad lo permite). | BLOQUEANTE |
| **F2-MOD-002** | **Online:** El estudiante avanza módulo por módulo. El siguiente módulo solo se desbloquea al completar el anterior (video ≥ 85% + evaluación ≥ 70%). | Reproducir video parcialmente (50%) e intentar avanzar. Luego completar y reintentar. | Avance bloqueado al 50%. Desbloqueo correcto al cumplir las dos condiciones. | BLOQUEANTE |
| **F2-MOD-003** | **Online:** El sistema registra el progreso exacto del estudiante (% completado, módulos aprobados, tiempo total). | Revisión del perfil del estudiante en Filament tras avanzar. | Métrica visible y exportable. Coincide con el avance real visto en navegador. | BLOQUEANTE |
| **F2-MOD-004** | **Virtual:** El estudiante agenda sesión y el sistema crea automáticamente reunión Teams con instructor. | Agendar sesión virtual de prueba. | Reunión Teams creada. Estudiante e instructor reciben enlace por correo. | BLOQUEANTE |
| **F2-MOD-005** | **Virtual:** Tras la sesión, la transcripción y resumen Copilot quedan registrados en el perfil del estudiante. | Sesión Teams de prueba con transcripción habilitada. | Transcripción y resumen disponibles en el panel del estudiante en ≤ 24 h. | BLOQUEANTE |

### 4.3 Roles del sistema

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F2-ROL-001** | Existen los 6 roles definidos (Administrador, Coordinador, Capacitador Senior, Capacitador Junior, Estudiante, Invitado) con permisos diferenciados. | Login con un usuario de cada rol y verificación de permisos. | Cada rol ve únicamente las secciones a las que tiene acceso. Intentos de acceso no autorizado devuelven 403. | BLOQUEANTE |
| **F2-ROL-002** | El Capacitador Junior NO puede descargar materiales completos ni editar cursos. | Login como Junior e intentar acciones restringidas. | Botones de descarga/edición ocultos o deshabilitados. Acciones por URL directa devuelven 403. | BLOQUEANTE |
| **F2-ROL-003** | Cambios de rol en Filament toman efecto en la siguiente sesión del usuario afectado (≤ 5 minutos). | Cambiar rol y pedir al usuario que recargue. | Permisos actualizados. | MENOR |

### 4.4 Certificados y reconocimientos

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F2-CERT-001** | Al alcanzar 100% del curso, el sistema genera automáticamente el certificado PDF y lo envía por correo. | Completar curso de prueba. | PDF descargable en panel + correo recibido en ≤ 5 minutos. | BLOQUEANTE |
| **F2-CERT-002** | Existen 3 plantillas: Tipo 1 (Marca), Tipo 2 (DC-3 STPS NOM-030-STPS-2009), Tipo 3 (Colegio profesional). El sistema asigna la correcta según el curso. | Inspeccionar 3 certificados generados, uno por tipo. | Cada PDF cumple el formato esperado. DC-3 sigue exactamente el formato oficial entregado por Logia. | BLOQUEANTE |
| **F2-CERT-003** | Cada certificado incluye: nombre completo, matrícula, curso, fecha, firma electrónica/QR de validación. | Inspección manual + escaneo del QR. | El QR redirige a una URL pública que confirma autenticidad del certificado. | BLOQUEANTE |
| **F2-CERT-004** | Logia puede personalizar plantillas (logos, textos legales) desde Filament sin tocar código. | Cliente cambia el logo de la plantilla Tipo 1 y emite un certificado de prueba. | Cambio reflejado en el siguiente certificado emitido. | BLOQUEANTE |

### 4.5 Protección de contenido (Escenario seleccionado: P o B)

> El cliente debe haber seleccionado el escenario antes del 15 de junio (Plan §8). Los criterios aplican según selección.

#### Escenario P — DRM Empresarial (si seleccionado)

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F2-DRM-P-001** | Intentar grabar un video del curso con OBS en Chrome resulta en pantalla negra. | Prueba en Chrome + OBS. | Video se reproduce normal en pantalla, pero la grabación captura solo negro o vacío. | BLOQUEANTE |
| **F2-DRM-P-002** | Intentar grabar con la grabadora nativa de macOS desde Safari resulta en pantalla negra. | Prueba en Safari + QuickTime/screencapture. | Misma protección activa en FairPlay. | BLOQUEANTE |
| **F2-DRM-P-003** | El video muestra marca de agua dinámica con nombre y matrícula del estudiante. | Inspección visual durante reproducción. | Marca de agua visible, no removible vía DOM, se mueve sutilmente. | BLOQUEANTE |

#### Escenario B — Protección por software (si seleccionado)

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F2-DRM-B-001** | El video muestra marca de agua dinámica con nombre y matrícula del estudiante en todo momento. | Inspección visual durante 5 minutos de reproducción. | Marca de agua presente, móvil cada 30 s aprox, no removible vía DevTools/DOM. | BLOQUEANTE |
| **F2-DRM-B-002** | Las URLs de video expiran a los 120 minutos y no se pueden compartir. | Copiar la URL del video, abrir en otro navegador 2 horas después. | URL devuelve 403 o página de expiración. | BLOQUEANTE |
| **F2-DRM-B-003** | Un usuario logueado en dos dispositivos simultáneamente cierra automáticamente la primera sesión. | Login en Chrome y luego en Firefox con el mismo usuario. | Chrome muestra "tu sesión se cerró en otro dispositivo". | BLOQUEANTE |

#### Comunes a ambos escenarios

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F2-DRM-C-001** | Los manuales PDF se sirven en visor integrado sin botón de descarga ni impresión. | Acceso a un manual de prueba. | Cero opción visible de descarga/impresión. Click derecho deshabilitado en el visor. Atajo Ctrl+P bloqueado o renderiza vacío. | BLOQUEANTE |
| **F2-DRM-C-002** | Los manuales se entregan fragmentados en secciones de 10–15 páginas. | Inspección de un manual cargado. | Cero archivo único de >15 páginas accesible al estudiante. | BLOQUEANTE |
| **F2-DRM-C-003** | Cada acceso a contenido queda en log de auditoría con: usuario, matrícula, IP, fecha, hora, contenido accedido. | Revisión de logs en Filament tras 3 accesos de prueba. | 3 entradas registradas con los 6 campos. Exportable a CSV. | BLOQUEANTE |
| **F2-DRM-C-004** | Si la suscripción del estudiante se suspende, su acceso se bloquea en ≤ 60 segundos. | Suspender suscripción y refrescar la página de un módulo. | Página de bloqueo "tu suscripción no está activa" en ≤ 60 s. | BLOQUEANTE |

### 4.6 Panel de administración con métricas

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F2-PA-001** | El dashboard muestra 4 indicadores en tiempo real: inscripciones por período, ingresos por método de pago, progreso promedio por curso, sesiones virtuales realizadas. | Visita al dashboard tras inscribir 3 usuarios y un pago. | Los 4 indicadores se actualizan ≤ 60 s después del evento. | BLOQUEANTE |
| **F2-PA-002** | El admin puede crear/editar/eliminar cursos, módulos y lecciones desde Filament sin tocar código. | Cliente crea un curso de prueba con 3 módulos y 5 lecciones. | El curso aparece publicado y disponible para inscripción inmediatamente. | BLOQUEANTE |
| **F2-PA-003** | Reportes exportables a Excel/CSV: avance por estudiante, ingresos por curso, asistencia presencial. | Generar los 3 reportes con datos de prueba. | Archivos .xlsx descargables. Datos correctos contra la BD. | BLOQUEANTE |
| **F2-PA-004** | El admin puede definir precios, descuentos y disponibilidad de cursos. | Crear cupón 20%, aplicar en checkout de prueba. | Descuento se calcula correctamente. Cupón se desactiva tras N usos configurados. | BLOQUEANTE |

### 4.7 Aprobación formal de Fase 2 (Ciclo 12 — 3 de septiembre de 2026)

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F2-CIERRE-001** | Todos los criterios `BLOQUEANTE` de las secciones 4.1 a 4.6 (correspondientes al escenario seleccionado) pasan. | Recorrido conjunto con bitácora. | 100% PASA. | BLOQUEANTE |
| **F2-CIERRE-002** | El campus está accesible en `campus.logiaconsulting.com` con SSO unificado al sitio principal. | Login en sitio principal + navegar a campus. | No se pide credenciales nuevamente. Sesión compartida válida. | BLOQUEANTE |
| **F2-CIERRE-003** | Pruebas de carga: 50 usuarios simultáneos viendo video sin degradación. | Test con k6 / Locust en staging. | Tiempo de respuesta ≤ 1 s en p95. Cero errores 5xx. | MENOR |

---

## 5. FASE 3 — Marketing Digital con IA

### 5.1 Segmentación por producto

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F3-SEG-001** | Existen 3 pipelines independientes en n8n, uno por producto, configurados con la audiencia correcta de Meta. | Inspección en n8n + Meta Ads Manager. | 3 audiencias guardadas con criterios documentados. Pipelines activos. | BLOQUEANTE |
| **F3-SEG-002** | Cada pipeline puede pausarse/reanudarse desde el panel de Logia sin tocar n8n. | Pausar pipeline desde Filament. | Pipeline pausa publicaciones en ≤ 5 minutos. Estado visible en dashboard. | BLOQUEANTE |

### 5.2 Pipeline de conversión

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F3-PIPE-001** | El sistema genera copy de anuncio personalizado por audiencia con IA, basado en información real del producto. | Revisión de 3 ejecuciones de pipeline. | Cada copy menciona producto correcto, beneficios, no contiene información falsa. | BLOQUEANTE |
| **F3-PIPE-002** | El anuncio publicado redirige al lead a la landing page específica del producto. | Click en anuncio de prueba. | URL destino corresponde al producto (Aspel/Soft/Zoho). UTM tags presentes. | BLOQUEANTE |
| **F3-PIPE-003** | El lead capturado en la landing aparece en el panel de Logia con producto de interés, fuente y timestamp. | Submit de prueba desde landing tras click en anuncio. | Lead visible en Filament en ≤ 30 segundos. Datos completos. | BLOQUEANTE |
| **F3-PIPE-004** | El sistema puede generar mínimo 10 leads por producto durante el QA del Ciclo 15. | Pipeline operando 7 días con presupuesto mínimo definido. | ≥ 10 leads por producto registrados con datos válidos. | BLOQUEANTE |

### 5.3 Dashboard de métricas

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F3-DASH-001** | El dashboard muestra: leads por producto, leads por fecha, tasa de conversión, costo estimado por lead. | Revisión del dashboard tras 7 días de operación. | Las 4 métricas presentes y consistentes con Meta Ads Manager (±5%). | BLOQUEANTE |
| **F3-DASH-002** | Existe documentación operativa que permite a Logia operar los flujos sin intervención del desarrollador. | Cliente revisa documentación y opera 1 ciclo. | Cliente lanza, pausa y modifica una campaña con la documentación entregada. | BLOQUEANTE |

### 5.4 Aprobación formal de Fase 3 (Ciclo 15 — 7 de octubre de 2026)

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **F3-CIERRE-001** | Todos los criterios `BLOQUEANTE` de las secciones 5.1 a 5.3 pasan. | Recorrido conjunto con bitácora. | 100% PASA. | BLOQUEANTE |
| **F3-CIERRE-002** | Cuenta de Meta Business Manager con propiedad de Logia y accesos de administrador correctos. | Verificación en Meta. | Logia es propietaria. Accesos delegados al desarrollador como editor (revocable). | BLOQUEANTE |

---

## 6. ENTREGA FINAL (15 de octubre – 1 de noviembre de 2026)

| ID | Criterio | Verificación | Resultado esperado | Prioridad |
|---|---|---|---|---|
| **EF-001** | Todo el sistema (sitio + campus + automatización) está desplegado en producción y operando sin errores 24/7 durante 7 días continuos. | Monitoreo UptimeRobot. | Uptime ≥ 99.5% durante la ventana de validación. | BLOQUEANTE |
| **EF-002** | Logia recibe credenciales de TODAS las cuentas de servicios (Railway, Cloudflare, Bunny.net, Stripe, Google Cloud, Resend, n8n, Meta) con propiedad total. | Entrega de gestor de credenciales (1Password / similar) y rotación de contraseñas. | Cliente accede a las 8 cuentas como propietario. Desarrollador queda como editor o se desvincula a elección del cliente. | BLOQUEANTE |
| **EF-003** | Logia recibe el código fuente completo en repositorio Git con derechos de propiedad transferidos. | Repositorio en cuenta de Logia. README con instrucciones de setup local + deploy. | Cliente clona y arranca el proyecto en su entorno con la documentación. | BLOQUEANTE |
| **EF-004** | Logia recibe documentación operativa: panel admin (sitio + campus), gestión de marketing, gestión de pagos, gestión de cursos, troubleshooting básico. | Entrega de manual PDF + videos de capacitación grabados. | Documentación cubre los 5 ámbitos. Mínimo 5 videos de 5–10 min cada uno. | BLOQUEANTE |
| **EF-005** | Capacitación remota o presencial al equipo de Logia (mínimo 2 sesiones de 2 horas) con preguntas y respuestas. | Sesiones realizadas y grabadas. | Asistencia mínima del equipo administrador y al menos 1 capacitador. Grabación entregada al cliente. | BLOQUEANTE |
| **EF-006** | Garantía de 30 días post-entrega activa con SLA de respuesta a errores funcionales. | Acuerdo SLA escrito en el contrato. | Errores críticos: respuesta ≤ 4 h hábiles. Errores menores: respuesta ≤ 24 h hábiles. Resolución según gravedad. | BLOQUEANTE |
| **EF-007** | El cliente firma acta de conformidad al cumplirse los criterios EF-001 a EF-006. | Firma del Acta de Aceptación Final. | Acta firmada por ambas partes. Última factura emitida. Pago final ejecutado. | BLOQUEANTE |

---

## 7. Tabla resumen — qué se valida en cada hito de pago

| Hito | Fecha | Criterios bloqueantes a pasar | Acta a firmar |
|---|---|---|---|
| **Aprobación Fase 1** | 15 jun 2026 | Sección 3 + Transversales (TR-001 a TR-010) | Acta de Aceptación Fase 1 |
| **Aprobación Fase 2** | 3 sep 2026 | Sección 4 (escenario P o B según elección) | Acta de Aceptación Fase 2 |
| **Aprobación Fase 3** | 7 oct 2026 | Sección 5 | Acta de Aceptación Fase 3 |
| **Entrega Final** | 1 nov 2026 | Sección 6 (EF-001 a EF-007) | Acta de Aceptación Final |

---

## 8. Plantilla de bitácora de pruebas (a anexar a cada entrega)

| ID criterio | Descripción | Método ejecutado | Resultado | Evidencia | Fecha | Firma desarrollador | Firma cliente |
|---|---|---|---|---|---|---|---|
| F1-IV-001 | Identidades visuales correctas | Inspección DevTools + comparación contra tokens.css | PASA | Captura de pantalla #001 | 15/06/2026 | _____ | _____ |
| F1-IV-002 | Transición de marca sin reflujo | Performance trace en Chrome | PASA | trace_001.json | 15/06/2026 | _____ | _____ |
| ... | ... | ... | ... | ... | ... | ... | ... |

---

## 9. Cláusula de subjetividad y control de cambios

**9.1 Lo que NO es base de rechazo:**
- "No me gusta el azul" cuando el azul corresponde al manual de marca.
- "Quiero que el botón sea más grande" cuando el botón cumple el prototipo aprobado.
- "Falta una sección" cuando esa sección no está en el Plan de Trabajo o en este Anexo 1.
- Cambios de criterio del cliente posteriores a la aprobación del prototipo en el Ciclo de Preparación.

**9.2 Lo que SÍ es base de rechazo:**
- Un criterio bloqueante con resultado FALLA en la bitácora.
- Una funcionalidad listada en este documento que no existe o no opera.
- Un defecto reproducible que impide al usuario completar un flujo definido.

**9.3 Cualquier solicitud que no caiga en 9.2 entra al control de cambios** descrito en la cláusula 10 del Plan de Trabajo y requiere cotización antes de su implementación.

---

## 10. Firmas

**Desarrollador**
Oscar Eduardo Repper Horta
oscarrepper@gmail.com · 720 232 2010
Firma y fecha: ______________________________

**Logia Consulting**
Representante: ___________________________
Cargo: ___________________________________
Firma y fecha: ______________________________

---

*Anexo 1 · Criterios de Aceptación · Versión 1.0 · 29 de abril de 2026 · Documento de uso exclusivo para las partes firmantes*
