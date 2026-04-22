# Logia Consulting — Project Brief (1-pager)

> Leer este archivo ANTES de cualquier otro. Es el norte de todo.

## Qué es el proyecto

Plataforma web **multi-marca** para **Logia Consulting** (Méx., 20+ años, 500+ clientes, oficinas WTC CDMX / Coapa / Polanco). Logia es partner oficial reseller + trainer de 4 marcas: **Siigo Aspel, Soft Restaurant, Zoho One, Microsoft 365**. El sitio combina:

- **E-commerce** — venta de licencias (tarjeta + OXXO + SPEI).
- **E-learning** — cursos certificados con DRM (Widevine + FairPlay) vía Bunny Stream, PDFs protegidos (PDF.js), 3 plantillas de certificado.
- **Blog + Soporte + Informativos** — áreas regulares.
- **Dashboard cliente + Aula + Admin Filament** — privadas.

## La regla de oro: Brand Chameleon

Cuando el usuario entra a la zona de un partner (`/aspel/*`, `/soft-restaurant/*`, `/zoho/*`, `/microsoft-365/*`), la UI completa debe **replicar la identidad oficial de esa marca** (colores, tipografía, radios, sombras, densidad). El usuario debe sentir que está en una extensión oficial de esa marca.

Se implementa con un único componente por elemento (un `<Button>`, no cuatro) que cambia al 100% por CSS Variables, controladas por `<html data-brand="…">` inyectado por middleware.

## Principios del sistema (P1 - P7)

1. **Un componente, cinco vestimentas.** Misma API, cambia sólo por `data-brand`.
2. **Los tokens son la verdad.** Cero hex codes en Blade — siempre `var(--…)`.
3. **Identidad Logia manda en zonas neutrales.** Header (logo), footer, checkout, dashboard, legal → siempre `data-brand="logia"`. Sólo rutas de producto cambian.
4. **Accesibilidad no es opcional.** WCAG 2.1 AA obligatorio antes de merge.
5. **Performance como feature.** Blade SSR + Livewire sólo si hay estado reactivo real.
6. **Mobile-first sin excepciones.** Diseño a 360px primero, escala arriba.
7. **Documenta o no existe.** Componente sin doc = componente que no puede merge.

## Identidad Logia (oficial MICLOGIA.pdf)

| Rol | Color | Pantone | Uso |
|-----|-------|---------|-----|
| Protagonista | `#FF6B00` | 1505 C | CTAs primarios, swoosh del logo, "I" acentuada, decoración |
| Accent | `#0071CE` | 285 C | Links, "CONSULTING", estado `info`, botones secundarios |
| Gris oficial | `#717271` | 424 C | Texto secundario, bordes, "LOGIA" del logo |
| Gris claro | `#DBD9D6` | Cool Gray 1 C | Fondos sutiles, bordes default |

**Tipografía:** Helvetica (primaria) + Helvetica Neue (secundaria). Fallback `Arial, system-ui, sans-serif`.

**Tagline oficial:** *"Integrando Tecnología y Crecimiento Empresarial"*.

**Restricción WCAG crítica:** `#FF6B00` sobre blanco tiene ratio 3.1:1 — **falla AA para body**. Texto sobre naranja sólo si `font-weight ≥ 600` y `font-size ≥ 16px`, o tamaño large (≥18.66px). Para body copy, usar `#2A2A2A` o el azul `#0071CE`.

## Partners — one-liner de identidad cada uno (paletas oficiales del cliente)

- **Siigo Aspel** — azul brillante `#009DFF` + gris azulado `#3B4758` + neutro `#AAB0B8`. Tono corporativo-moderno, formal. Nota WCAG: `#009DFF` sobre blanco ≈3.0:1 — **no usar como color de body**, sólo accent/CTAs de 16px+ bold.
- **Soft Restaurant** — naranja cobre `#E25724` + naranja cálido `#E7803C` + púrpura `#584569` + charcoal `#3C3B44`. Tono cálido, hospitality, contraste cálido/frío distintivo.
- **Zoho One** — rojo vibrante `#E42527` + azul `#226DB4` + verde `#089949` + ámbar `#F9B21D` (colores sacados del logo). Tono utilitario, denso (radius 4-6px). Semánticos: success = verde Zoho, warning = amarillo Zoho, info = azul Zoho, danger = rojo Zoho.
- **Microsoft 365** — azul `#05A6F0` + naranja Office `#F35325` + verde `#81BC06` + amarillo `#FFBA08` + navy `#081C28`. Fluent 2, radius 4px, sombras bajas. Los 4 colores brillantes citan Word/Excel/PowerPoint/Outlook; `#081C28` es el texto.

## Observaciones críticas del cliente (no negociables)

1. **Logo Logia prominente** en el header (ampliado, no mini).
2. **Mega-menú visual y didáctico** en "Productos" — ver `docs/02-design-system.md` §15.
3. **Banner de hero editable** desde admin (CMS).
4. **Product 3D Card** — efecto tilt en hover, delicioso, respeta `prefers-reduced-motion`.
5. **Chips magnéticos** en áreas de servicio y chips de partners.
6. **Hero carrusel** en home con autoplay pausable + dots + flechas.

## Stack

Laravel 11 + PHP 8.3 + Filament v3 + Livewire 3 + Alpine + Tailwind + MySQL 8 + Stripe MX + Bunny Stream + Cloudflare Pro + Railway CI/CD.

## Arquitectura de tokens (3 capas)

```
Globales (space, radius, shadow, motion, type scale) → comunes a todas las marcas
[data-brand="xxx"] (primary, accent, bg, font-display…)  → cambian por marca
Alias de componente (--btn-bg, --card-padding…)          → lee de las capas 1 y 2
```

Un componente **nunca** lee directo de capa 1 o 2 — siempre desde su alias de capa 3.

## Sitios de referencia

- Aspel: `https://www.aspel.com.mx/` / `https://www.siigo.com/mx/aspel/`
- Soft Restaurant: `https://www.softrestaurant.com/`
- Zoho One: `https://www.zoho.com/one/`
- Microsoft 365: `https://www.microsoft.com/es-mx/microsoft-365`

## Qué NO hacer

- Inventar componentes por marca — sólo un set, múltiples temas.
- Hardcodear colores/fuentes en Blade.
- Crear navegación por marca — Navbar y Footer **siempre** Logia.
- Cambiar la identidad del dashboard cliente, checkout o legales.
- Usar el naranja `#FF6B00` como color de body text sobre blanco.
- Omitir `prefers-reduced-motion` en efectos (chip magnético, 3D card, carrusel).

---

Para el "qué" construir → `docs/01-sitemap-y-arquitectura.md`.
Para el "cómo se ve" → `docs/02-design-system.md`.
Para los tokens prácticos → `brand-pack/tokens.css` + `brand-pack/tokens.json`.
Para ver los componentes renderizados → `brand-pack/brand-preview.html`.
