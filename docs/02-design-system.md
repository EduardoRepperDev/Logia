# Logia Consulting — Design System Multi-Marca

**Proyecto:** Plataforma web Logia Consulting
**Documento:** Design System v1.0 (Core UI)
**Versión:** 1.1 — 21 / Abril / 2026
**Estado:** BORRADOR — tokens Logia ya reconciliados con `MICLOGIA.pdf` (Pantone 1505 C / 424 C / Cool Gray 1 C / 285 C, Helvetica + Helvetica Neue)

> Este documento es el hermano del `01-sitemap-y-arquitectura.md`. Define los tokens de diseño, los componentes y las reglas de composición para las 5 marcas del sistema (Logia + 4 partners). Toda implementación en código debe leer desde aquí; nada de colores o fuentes hardcodeados en Blade.

---

## Tabla de contenido

1. Principios del sistema
2. Arquitectura de tokens (3 capas)
3. Tokens globales — neutrals, spacing, typography, motion, elevation, layout
4. Tokens por marca — Logia, Siigo Aspel, Soft Restaurant, Zoho One, Microsoft 365
5. Principios de composición y anatomía
6. Componente — Button
7. Componente — Input
8. Componente — Select
9. Componente — Badge
10. Componente — Chip (incluye Chip magnético)
11. Componente — Card (producto, curso, testimonial, genérico)
12. Componente — Tabs
13. Componente — Modal / Dialog
14. Componente — Navbar (desktop, mobile, sticky)
15. Componente — Mega-Menú (spec crítico del cliente)
16. Componente — Hero (con carrusel de marca)
17. Componente — Product 3D Card
18. Componente — Footer (siempre identidad Logia)
19. Accesibilidad — checklist WCAG 2.1 AA obligatorio
20. Convenciones de código Blade + Livewire + Alpine
21. Matriz marca × componente
22. Pendientes de reconciliar con `MICLOGIA.pdf`
23. Apéndice — referencia completa de tokens

---

## 1. Principios del sistema

**P1. Un componente, cinco vestimentas.** Cada componente tiene una API estable y se tematiza al 100% a través de CSS Variables. Nunca hay dos versiones del mismo componente "la de Aspel" y "la de Zoho" — sólo una implementación que cambia según `data-brand`.

**P2. Los tokens son la verdad.** Si un color, tamaño o espaciado no está en un token, está mal. Pull requests que introduzcan hex codes en Blade se rechazan.

**P3. Identidad Logia manda en zonas neutrales.** Header (logo), footer, checkout, dashboard de cliente, aviso legal: siempre contexto `logia`. Sólo las rutas de producto (`/aspel/*`, `/soft-restaurant/*`, `/zoho/*`, `/microsoft-365/*`) cambian a su contexto.

**P4. Accesibilidad no es opcional.** Todo componente cumple WCAG 2.1 AA antes de entrar al sistema. Ver §19.

**P5. Performance como feature.** Los componentes rinden con server-side Blade; Livewire se usa sólo cuando hay estado reactivo real. Alpine.js para micro-interacciones sin sobrepeso.

**P6. Mobile-first sin excepciones.** Cada componente se diseña primero a 360px y luego escala.

**P7. Documenta o no existe.** Este archivo vive con el código, se versiona, y se actualiza en el mismo PR que cambia un componente.

---

## 2. Arquitectura de tokens (3 capas)

```
┌─────────────────────────────────────────────────────────────┐
│ CAPA 1 — TOKENS GLOBALES                                    │
│ (iguales para todas las marcas)                             │
│                                                             │
│ --space-*, --radius-*, --shadow-*, --ease-*,                │
│ --duration-*, --z-*, --text-scale-*                         │
└──────────────────────┬──────────────────────────────────────┘
                       │ se combinan con
                       ▼
┌─────────────────────────────────────────────────────────────┐
│ CAPA 2 — TOKENS POR MARCA                                   │
│ (cambian según data-brand)                                  │
│                                                             │
│ --primary, --primary-fg, --accent, --bg, --text,            │
│ --text-muted, --surface, --border,                          │
│ --font-display, --font-body,                                │
│ --radius-card (override opcional),                          │
│ --shadow-card (override opcional)                           │
└──────────────────────┬──────────────────────────────────────┘
                       │ los componentes leen
                       ▼
┌─────────────────────────────────────────────────────────────┐
│ CAPA 3 — TOKENS DE COMPONENTE (alias semánticos)            │
│ (referencian capas 1 y 2)                                   │
│                                                             │
│ --btn-bg, --btn-fg, --btn-radius,                           │
│ --input-border, --card-padding, …                           │
└─────────────────────────────────────────────────────────────┘
```

**Regla de oro:** un componente nunca lee de capa 1 o 2 directamente. Siempre lee de su alias de capa 3. Esto permite rediseñar un componente sin tocar tokens de marca, y tematizar un componente sin tocar su código.

---

## 3. Tokens globales

### 3.1 Espaciado (escala 4px)
```css
:root {
  --space-0:  0;
  --space-1:  4px;
  --space-2:  8px;
  --space-3:  12px;
  --space-4:  16px;
  --space-5:  20px;
  --space-6:  24px;
  --space-8:  32px;
  --space-10: 40px;
  --space-12: 48px;
  --space-16: 64px;
  --space-20: 80px;
  --space-24: 96px;
  --space-32: 128px;
}
```
**Reglas:** `--space-1` sólo para densidad interna (iconos, chips). Paddings de componente: `--space-3` a `--space-6`. Gaps de sección: `--space-16` a `--space-24`.

### 3.2 Radius
```css
:root {
  --radius-none:  0;
  --radius-xs:    2px;
  --radius-sm:    4px;
  --radius-md:    8px;
  --radius-lg:    12px;
  --radius-xl:    16px;
  --radius-2xl:   24px;
  --radius-pill:  9999px;
}
```
Cada marca **puede** hacer override de `--radius-card` y `--radius-btn` si su identidad lo demanda (ej. Microsoft 365 usa `--radius-sm` para Fluent 2, Soft Restaurant usa `--radius-lg` para sensación más suave).

### 3.3 Sombras (escala elevation)
```css
:root {
  --shadow-none: none;
  --shadow-sm:   0 1px 2px rgba(15, 23, 42, 0.06);
  --shadow-md:   0 4px 10px rgba(15, 23, 42, 0.08);
  --shadow-lg:   0 10px 24px rgba(15, 23, 42, 0.10);
  --shadow-xl:   0 20px 48px rgba(15, 23, 42, 0.14);
  --shadow-focus: 0 0 0 3px rgba(59, 130, 246, 0.35);
}
```
Cada marca define `--shadow-card` que suele ser `--shadow-md` tintado con el `--primary` de la marca a 10-14% de opacidad.

### 3.4 Motion
```css
:root {
  --duration-instant: 80ms;
  --duration-fast:    150ms;
  --duration-base:    250ms;
  --duration-slow:    400ms;
  --duration-slower:  600ms;

  --ease-out:        cubic-bezier(0.2, 0.8, 0.2, 1);
  --ease-in-out:     cubic-bezier(0.4, 0, 0.2, 1);
  --ease-spring:     cubic-bezier(0.34, 1.56, 0.64, 1);
  --ease-linear:     linear;
}

@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}
```

### 3.5 Z-index
```css
:root {
  --z-base:        0;
  --z-dropdown:    100;
  --z-sticky:      200;
  --z-fixed:       300;
  --z-megamenu:    400;
  --z-modal-bg:    500;
  --z-modal:       510;
  --z-toast:       600;
  --z-tooltip:     700;
}
```

### 3.6 Breakpoints
```css
/* Mobile first */
/*  base:   0-479   (sm phones) */
/*  sm:     480+    (large phones) */
/*  md:     768+    (tablets portrait) */
/*  lg:     1024+   (tablets landscape / small laptops) */
/*  xl:     1280+   (laptops) */
/*  2xl:    1536+   (desktops) */
```

### 3.7 Tipografía — escala (tokens globales)
```css
:root {
  /* Escala modular — ratio 1.2 */
  --text-xs:   0.75rem;    /* 12px */
  --text-sm:   0.875rem;   /* 14px */
  --text-base: 1rem;       /* 16px */
  --text-md:   1.125rem;   /* 18px */
  --text-lg:   1.25rem;    /* 20px */
  --text-xl:   1.5rem;     /* 24px */
  --text-2xl:  1.875rem;   /* 30px */
  --text-3xl:  2.25rem;    /* 36px */
  --text-4xl:  3rem;       /* 48px */
  --text-5xl:  3.75rem;    /* 60px */
  --text-6xl:  4.5rem;     /* 72px */

  --leading-tight:   1.15;
  --leading-snug:    1.3;
  --leading-normal:  1.5;
  --leading-relaxed: 1.65;

  --tracking-tight:   -0.02em;
  --tracking-normal:  0;
  --tracking-wide:    0.04em;

  --weight-regular:  400;
  --weight-medium:   500;
  --weight-semibold: 600;
  --weight-bold:     700;
}
```

### 3.8 Layout
```css
:root {
  --container-max:    1280px;    /* xl content width */
  --container-narrow: 880px;     /* blog posts */
  --gutter-mobile:    16px;
  --gutter-desktop:   32px;
  --header-height:    72px;
  --header-height-compact: 56px;
}
```

---

## 4. Tokens por marca

> Cada marca se aplica con `<html data-brand="...">`. El middleware `ResolveBrandContext` lo inyecta (ver doc 01, §9.3).

### 4.1 Logia Consulting *(oficial — reconciliado con `MICLOGIA.pdf`)*

**Fuentes oficiales del manual:**
- Logotipo: "LOGIA" en gris con la "I" en naranja + "CONSULTING" en azul, envuelto por swoosh naranja con sombra gris.
- Tagline: *"Integrando Tecnología y Crecimiento Empresarial"*.
- Paleta Pantone: **1505 C** (naranja), **424 C** (gris), **Cool Gray 1 C** (gris claro), **285 C** (azul).
- Tipografía primaria: **Helvetica**. Secundaria: **Helvetica Neue**.

```css
[data-brand="logia"] {
  /* Colores oficiales MICLOGIA.pdf */
  --primary:         #FF6B00;   /* Pantone 1505 C — naranja dominante */
  --primary-fg:      #FFFFFF;
  --primary-hover:   #E55F00;
  --primary-press:   #C45000;
  --primary-soft:    #FFE7D4;   /* fondo tintado para chips / badges suaves */

  --accent:          #0071CE;   /* Pantone 285 C — azul CONSULTING */
  --accent-fg:       #FFFFFF;
  --accent-hover:    #005FAE;
  --accent-press:    #004E8C;

  /* Grises oficiales de marca */
  --brand-gray:        #717271;   /* Pantone 424 C — "LOGIA" gris */
  --brand-gray-light:  #DBD9D6;   /* Pantone Cool Gray 1 C */
  --brand-gray-dark:   #4E4E4E;   /* derivado para texto body AA */

  /* Superficie */
  --bg:            #FAFAFA;
  --surface:       #FFFFFF;
  --surface-2:     #F3F2F0;   /* Cool Gray 1 aclarado */
  --border:        #DBD9D6;   /* gris claro oficial como borde default */
  --border-strong: #717271;

  /* Texto — body siempre AA sobre blanco */
  --text:          #2A2A2A;   /* casi negro tibio para body AAA */
  --text-muted:    #717271;   /* gris oficial, AA sobre blanco */
  --text-inverse:  #FFFFFF;

  /* Semánticos */
  --success:  #16A34A;
  --warning:  #F59E0B;
  --danger:   #DC2626;
  --info:     #0071CE;        /* reutilizamos el azul de marca */

  /* Tipografía OFICIAL */
  --font-display: "Helvetica Neue", "Helvetica", "Arial", system-ui, sans-serif;
  --font-body:    "Helvetica", "Helvetica Neue", "Arial", system-ui, sans-serif;

  /* Overrides de capa 1 */
  --radius-card:  12px;
  --radius-btn:   10px;
  --shadow-card:  0 8px 24px rgba(255, 107, 0, 0.10);
}
```

**Reglas de uso de la paleta Logia:**
- El naranja `#FF6B00` es el color protagonista: botones primarios, acentos, swoosh, "I" del logo, iconografía destacada, bordes de Product-3D-Card.
- El azul `#0071CE` es el *accent* de la marca: usado en links, estados `info`, botones secundarios de acción, y siempre que aparezca la palabra "CONSULTING" o derivados.
- Los dos grises (`#717271` y `#DBD9D6`) son estructurales: bordes, divisores, texto secundario, backgrounds sutiles. No usar otros grises.
- **Nunca** usar el naranja puro sobre blanco para texto body (3.06:1 falla AA). Para texto sobre naranja, usar blanco a `font-weight ≥ 600` y tamaño ≥ 16px, o invertir a naranja sobre texto oscuro.

### 4.2 Siigo Aspel *(paleta oficial del cliente)*

Tres códigos oficiales entregados por el cliente: `#009DFF` (azul brillante), `#3B4758` (gris azulado), `#AAB0B8` (gris claro). Tono corporativo-moderno, formal. **Nota WCAG crítica:** `#009DFF` sobre blanco ≈3.0:1 — se comporta como el naranja de Logia: no usar para body text, sólo para CTAs con texto ≥16px bold, iconos, acentos decorativos.

```css
[data-brand="aspel"] {
  --primary:       #009DFF;   /* azul brillante oficial Siigo Aspel */
  --primary-fg:    #FFFFFF;
  --primary-hover: #008BE0;
  --primary-press: #0075BD;
  --primary-soft:  #CCEBFF;

  --accent:        #3B4758;   /* gris azulado — contraste y dark surfaces */
  --accent-fg:     #FFFFFF;

  --bg:            #F5F8FC;
  --surface:       #FFFFFF;
  --surface-2:     #EEF2F7;
  --border:        #AAB0B8;   /* gris claro oficial */
  --border-strong: #3B4758;

  --text:          #1A2230;   /* derivado oscuro para AAA body */
  --text-muted:    #3B4758;   /* oficial */
  --text-inverse:  #FFFFFF;

  --success:  #16A34A;
  --warning:  #F59E0B;
  --danger:   #DC2626;
  --info:     #009DFF;

  --font-display: "Gotham", "Montserrat", "Inter", system-ui, sans-serif;
  --font-body:    "Roboto", "Inter", system-ui, sans-serif;

  --radius-card: 10px;
  --radius-btn:  8px;
  --shadow-card: 0 6px 20px rgba(0, 157, 255, 0.14);
}
```

### 4.3 Soft Restaurant *(paleta oficial del cliente)*

Cuatro códigos oficiales entregados por el cliente: `#E7803C` (naranja claro), `#E25724` (naranja cobre oscuro — primary), `#584569` (púrpura distintivo), `#3C3B44` (charcoal). El par cálido/frío (naranja + púrpura) es la firma visual de la marca. **Nota WCAG:** `#E25724` sobre blanco ≈4.2:1 — borderline AA body; en texto sobre primary usar siempre `font-weight ≥ 500`.

```css
[data-brand="softrestaurant"] {
  --primary:       #E25724;   /* naranja oscuro/cobre oficial — mejor legibilidad que el claro */
  --primary-fg:    #FFFFFF;
  --primary-hover: #C94918;
  --primary-press: #A63B11;
  --primary-soft:  #FBE2D2;

  --primary-alt:   #E7803C;   /* naranja claro oficial — acentos decorativos secundarios */

  --accent:        #584569;   /* púrpura distintivo de la marca */
  --accent-fg:     #FFFFFF;

  --bg:            #FFF7F1;   /* blanco cálido */
  --surface:       #FFFFFF;
  --surface-2:     #FDECDE;
  --border:        #E8C9B3;
  --border-strong: #584569;

  --text:          #3C3B44;   /* charcoal oficial */
  --text-muted:    #6B6773;
  --text-inverse:  #FFFFFF;

  --success:  #16A34A;
  --warning:  #F59E0B;
  --danger:   #DC2626;
  --info:     #584569;

  --font-display: "Manrope", "Inter", system-ui, sans-serif;
  --font-body:    "Inter", system-ui, sans-serif;

  --radius-card: 14px;
  --radius-btn:  12px;
  --shadow-card: 0 8px 26px rgba(226, 87, 36, 0.16);
}
```

### 4.4 Zoho One *(paleta oficial del cliente — los 4 chips del logo)*

Cuatro códigos oficiales, uno por cada chip del cuadrado del logo Zoho: `#E42527` (rojo — primary), `#226DB4` (azul — accent/info), `#089949` (verde — success), `#F9B21D` (amarillo — warning). La identidad Zoho se siente "sistema operativo denso" — radius bajos (4-6px), mucha densidad tipográfica, colores vivos en semánticos.

```css
[data-brand="zoho"] {
  --primary:       #E42527;   /* rojo oficial del logo */
  --primary-fg:    #FFFFFF;
  --primary-hover: #C51E20;
  --primary-press: #A3181A;
  --primary-soft:  #FADADB;

  --accent:        #226DB4;   /* azul oficial del logo */
  --accent-fg:     #FFFFFF;

  --bg:            #F8F8F6;
  --surface:       #FFFFFF;
  --surface-2:     #EFEEEA;
  --border:        #D8D4C7;
  --border-strong: #8A8675;

  --text:          #1B1B1B;
  --text-muted:    #5A5A5A;
  --text-inverse:  #FFFFFF;

  /* Semánticos derivados DIRECTO de los chips del logo */
  --success:  #089949;        /* verde oficial */
  --warning:  #F9B21D;        /* amarillo oficial */
  --danger:   #E42527;        /* rojo oficial (= primary) */
  --info:     #226DB4;        /* azul oficial */

  --font-display: "Puvi", "Lato", "Inter", system-ui, sans-serif;
  --font-body:    "Lato", "Inter", system-ui, sans-serif;

  --radius-card: 6px;
  --radius-btn:  4px;
  --shadow-card: 0 2px 10px rgba(228, 37, 39, 0.10);
}
```

### 4.5 Microsoft 365 *(paleta oficial del cliente — Fluent 2 + los 4 chips del cuadrado)*

Cinco códigos oficiales del cliente, los 4 chips del cuadrado Microsoft + un navy para texto: `#05A6F0` (azul Outlook — primary), `#F35325` (naranja PowerPoint — accent/danger), `#81BC06` (verde Excel — success), `#FFBA08` (amarillo Office — warning), `#081C28` (navy — text). **Nota WCAG:** `#05A6F0` sobre blanco ≈2.8:1 — no usar para body; siempre accent o botones grandes en bold. Por eso `--text = #081C28` (ratio ≈16.8:1, AAA).

```css
[data-brand="microsoft"] {
  --primary:       #05A6F0;   /* azul Outlook oficial */
  --primary-fg:    #FFFFFF;
  --primary-hover: #0490D2;
  --primary-press: #0378B0;
  --primary-soft:  #CDEEFC;

  --accent:        #F35325;   /* naranja PowerPoint oficial */
  --accent-fg:     #FFFFFF;

  --bg:            #FAFAFA;
  --surface:       #FFFFFF;
  --surface-2:     #F3F2F1;
  --border:        #E1DFDD;
  --border-strong: #8A8886;

  --text:          #081C28;   /* navy oficial — ratio AAA body */
  --text-muted:    #4A5766;
  --text-inverse:  #FFFFFF;

  /* Semánticos derivados DIRECTO del cuadrado Microsoft */
  --success:  #81BC06;        /* verde Excel oficial */
  --warning:  #FFBA08;        /* amarillo Office oficial */
  --danger:   #F35325;        /* naranja PowerPoint oficial (= accent) */
  --info:     #05A6F0;        /* azul Outlook oficial (= primary) */

  --font-display: "Segoe UI Variable", "Segoe UI", system-ui, sans-serif;
  --font-body:    "Segoe UI Variable", system-ui, sans-serif;

  --radius-card: 4px;
  --radius-btn:  4px;
  --shadow-card: 0 1.6px 3.6px rgba(8, 28, 40, 0.132), 0 0.3px 0.9px rgba(8, 28, 40, 0.108);
}
```

### 4.6 Tabla resumen — contraste WCAG AA (paletas oficiales del cliente)

| Marca | Primary / fg | Ratio | ¿AA body? | ¿AA large? | Uso recomendado |
|-------|--------------|-------|-----------|-----------|-----------------|
| Logia (primary) | `#FF6B00` / `#FFFFFF` | 3.1:1 | ❌ | ✅ | CTAs large-bold, iconos, swoosh |
| Logia (accent)  | `#0071CE` / `#FFFFFF` | 4.84:1 | ✅ | ✅ | Links, body highlights, botones secundarios |
| Logia (body)    | `#2A2A2A` / `#FFFFFF` | 14.7:1 | ✅ | ✅ | Texto de cuerpo |
| Aspel (primary) | `#009DFF` / `#FFFFFF` | ≈3.0:1 | ❌ | ✅ | CTAs large-bold, iconos de marca |
| Aspel (accent)  | `#3B4758` / `#FFFFFF` | ≈9.4:1 | ✅ | ✅ | Body secundario, bordes fuertes |
| Aspel (body)    | `#1A2230` / `#FFFFFF` | ≈14.5:1 | ✅ | ✅ | Texto de cuerpo |
| Soft (primary) | `#E25724` / `#FFFFFF` | ≈4.2:1 | ⚠ borderline | ✅ | CTAs, requiere `font-weight ≥ 500` siempre |
| Soft (accent)  | `#584569` / `#FFFFFF` | ≈8.2:1 | ✅ | ✅ | Links, body, texto sobre superficie cálida |
| Soft (body)    | `#3C3B44` / `#FFFFFF` | ≈11.8:1 | ✅ | ✅ | Texto de cuerpo |
| Zoho (primary) | `#E42527` / `#FFFFFF` | ≈5.3:1 | ✅ | ✅ | CTAs primarios, estados de error |
| Zoho (accent)  | `#226DB4` / `#FFFFFF` | ≈5.1:1 | ✅ | ✅ | Links, estado info |
| Zoho (success) | `#089949` / `#FFFFFF` | ≈4.6:1 | ✅ | ✅ | Estado success |
| Zoho (warning) | `#F9B21D` / `#1B1B1B` | ≈10.9:1 | ✅ | ✅ | Badges/alerts con texto oscuro |
| MS 365 (primary) | `#05A6F0` / `#FFFFFF` | ≈2.8:1 | ❌ | ⚠ borderline | CTAs large-bold únicamente |
| MS 365 (accent)  | `#F35325` / `#FFFFFF` | ≈3.4:1 | ❌ | ✅ | Large-bold, iconos |
| MS 365 (body)    | `#081C28` / `#FFFFFF` | ≈16.8:1 | ✅ (AAA) | ✅ | Texto de cuerpo |

> ⚠ **Tres marcas comparten el problema de "color vivo saturado" sobre blanco** — Logia (naranja), Aspel (azul brillante) y Microsoft 365 (azul Outlook). Todas fallan AA para body. Reglas operativas:
> 1. El texto sobre `--primary` de Logia / Aspel / Microsoft 365 debe ser **bold (≥600) y ≥16px**, o **≥18.66px regular** (equivalente a large). Siempre `font-weight: 600`+ en botones primarios de estas marcas.
> 2. Nunca poner párrafos ni cuerpos de tabla sobre estos primaries en puro (sólo encabezados, CTAs, números destacados).
> 3. Para contenido body, usar los accents: `#0071CE` Logia, `#3B4758` Aspel, `#081C28` Microsoft, `#584569` Soft.
> 4. Soft Restaurant `#E25724` pasa AA pero apenas: exigir `font-weight ≥ 500` en *cualquier* texto que caiga sobre primary.
> 5. Los primaries quedan reservados para: botones, acentos tipográficos, iconos, divisores decorativos, Product-3D-Card borders, y swoosh Logia.
> 6. **Zoho es la única marca cuyos 4 colores oficiales pasan AA body limpiamente**, lo que hace muy natural el mapeo semánticos→chips del logo.

---

## 5. Principios de composición y anatomía

### 5.1 Grid
- 12 columnas, gutter `--gutter-desktop` (32px) en desktop, `--gutter-mobile` (16px) en móvil.
- Contenedor principal `max-width: var(--container-max)` con `margin-inline: auto`.
- Secciones de página: `padding-block: clamp(48px, 8vw, 96px)` para que respiren.

### 5.2 Anatomía de componentes
Todos los componentes siguen el patrón Blade `@props` + slot:
```blade
@props([
  'variant' => 'primary',
  'size'    => 'md',
  'as'      => 'button',
])

<{{ $as }} {{ $attributes->class(['c-btn', "c-btn--{$variant}", "c-btn--{$size}"]) }}>
  {{ $slot }}
</{{ $as }}>
```

### 5.3 Naming BEM-like
- `c-` prefix para componentes (`c-btn`, `c-card`).
- `--` para variantes (`c-btn--primary`).
- `__` para elementos hijos (`c-card__header`).
- `is-` / `has-` para estados (`is-loading`, `has-error`).

### 5.4 Densidad
| Contexto | Densidad |
|---------|----------|
| Público (marketing) | Relaxed — `--space-6` / `--space-8` entre elementos |
| Dashboard cliente | Comfortable — `--space-4` |
| Admin Filament | Compact — tokens Filament nativos |
| Aula | Comfortable — `--space-4` / `--space-6` |

---

## 6. Componente — Button

### 6.1 Descripción
Acción principal o secundaria del sistema. Soporta 4 variantes, 3 tamaños, estados completos, íconos leading/trailing y loading.

### 6.2 Variantes
| Variante | Uso |
|----------|-----|
| `primary` | Acción dominante de la pantalla. Una por sección. |
| `secondary` | Acciones paralelas importantes. Usa `--accent` o borde `--primary`. |
| `ghost` | Acciones terciarias, links accionables dentro de cards. |
| `danger` | Acciones destructivas confirmadas (eliminar, cancelar suscripción). |

### 6.3 Tamaños
| Tamaño | Altura | Padding | Font |
|--------|--------|---------|------|
| `sm` | 32px | `0 12px` | `--text-sm` / 500 |
| `md` | 40px | `0 16px` | `--text-base` / 600 |
| `lg` | 48px | `0 20px` | `--text-md` / 600 |

### 6.4 Props (Blade)
| Prop | Tipo | Default | Descripción |
|------|------|---------|-------------|
| `variant` | `primary\|secondary\|ghost\|danger` | `primary` | Estilo visual |
| `size` | `sm\|md\|lg` | `md` | Tamaño |
| `as` | `button\|a` | `button` | Elemento HTML |
| `loading` | bool | `false` | Muestra spinner, deshabilita |
| `icon-left` | string | — | Nombre de ícono leading |
| `icon-right` | string | — | Nombre de ícono trailing |
| `full-width` | bool | `false` | Ocupa 100% del contenedor |

### 6.5 Estados
| Estado | Visual | Comportamiento |
|--------|--------|----------------|
| Default | `--primary` bg, fg bold blanco | — |
| Hover | `--primary-hover`, translateY(-1px) | `transition: --duration-fast --ease-out` |
| Active / Pressed | `--primary-press`, translateY(0) | sin shadow |
| Focus-visible | Anillo `--shadow-focus` + offset | Keyboard only |
| Disabled | Opacity 0.5, cursor not-allowed | `pointer-events: none` |
| Loading | Spinner centrado, label invisible | `aria-busy="true"` |

### 6.6 Tokens de componente (capa 3)
```css
.c-btn {
  --btn-bg:         var(--primary);
  --btn-fg:         var(--primary-fg);
  --btn-bg-hover:   var(--primary-hover);
  --btn-bg-press:   var(--primary-press);
  --btn-radius:     var(--radius-btn, var(--radius-md));
  --btn-font:       var(--font-display);
  --btn-weight:     var(--weight-semibold);
  --btn-focus-ring: var(--shadow-focus);
}
.c-btn--secondary { --btn-bg: transparent; --btn-fg: var(--primary); border: 1px solid var(--primary); }
.c-btn--ghost     { --btn-bg: transparent; --btn-fg: var(--text); }
.c-btn--danger    { --btn-bg: var(--danger); --btn-fg: #fff; }
```

### 6.7 Accesibilidad
- `<button>` siempre que haya acción en la misma página; `<a>` cuando hay navegación.
- Texto mínimo legible: tamaño `md` o superior para acciones críticas.
- `aria-busy="true"` + `aria-live="polite"` en loading.
- Hit area ≥ 44×44px en móvil (tamaño `md` cumple).
- Nunca color-only como único indicador de estado.

### 6.8 Do / Don't
| ✅ Do | ❌ Don't |
|------|---------|
| Una sola acción `primary` por sección | Tres botones primary en el hero |
| Verbo en primer lugar ("Comprar licencia") | "Click aquí" / "Más" |
| `ghost` para acciones repetitivas en cards | `ghost` como único CTA del hero |
| Loading state en acciones async | Desactivar sin feedback |

### 6.9 Código Blade
```blade
{{-- resources/views/components/btn.blade.php --}}
@props([
  'variant'   => 'primary',
  'size'      => 'md',
  'as'        => 'button',
  'loading'   => false,
  'iconLeft'  => null,
  'iconRight' => null,
  'fullWidth' => false,
])
<{{ $as }}
  {{ $attributes->class([
      'c-btn',
      "c-btn--{$variant}",
      "c-btn--{$size}",
      'c-btn--block' => $fullWidth,
      'is-loading'   => $loading,
  ]) }}
  @if($loading) aria-busy="true" @endif
  @if($as === 'button') type="{{ $attributes->get('type', 'button') }}" @endif
>
  @if($loading)
    <x-spinner class="c-btn__spinner" />
  @else
    @if($iconLeft)  <x-icon :name="$iconLeft"  class="c-btn__icon c-btn__icon--left" /> @endif
    <span class="c-btn__label">{{ $slot }}</span>
    @if($iconRight) <x-icon :name="$iconRight" class="c-btn__icon c-btn__icon--right" /> @endif
  @endif
</{{ $as }}>
```

---

## 7. Componente — Input

### 7.1 Descripción
Campo de texto de una línea. Soporta `type` HTML5 (text, email, password, tel, url, number, search). La versión multilínea es `Textarea` (extensión del mismo patrón, misma API).

### 7.2 Anatomía
```
┌──────────── Label (opcional) ────────────┐
│ Email *                                   │
├───────────────────────────────────────────┤
│  ┌─────────────────────────────────────┐  │
│  │ [icon] placeholder o valor          │  │   ← input
│  └─────────────────────────────────────┘  │
├───────────────────────────────────────────┤
│ Helper / Error text (opcional)            │
└───────────────────────────────────────────┘
```

### 7.3 Props
| Prop | Tipo | Default | Descripción |
|------|------|---------|-------------|
| `label` | string | — | Etiqueta visual; si falta, `aria-label` requerido |
| `name` | string | **req** | Atributo HTML |
| `type` | string | `text` | `text\|email\|password\|tel\|url\|number\|search` |
| `error` | string | — | Mensaje de error. Activa `is-error` |
| `helper` | string | — | Texto auxiliar |
| `icon-left` | string | — | Ícono leading |
| `required` | bool | `false` | Marca asterisco y `aria-required` |
| `size` | `sm\|md\|lg` | `md` | Altura |

### 7.4 Estados
| Estado | Visual |
|--------|--------|
| Default | Border `--border`, bg `--surface` |
| Hover | Border `--border-strong` |
| Focus | Border `--primary` + `--shadow-focus` |
| Filled | Igual a default, label en posición flotada si aplica |
| Error | Border `--danger`, helper en `--danger` |
| Disabled | bg `--surface-2`, opacity 0.7 |
| Read-only | Sin border, bg transparente |

### 7.5 Tokens
```css
.c-input {
  --input-bg:        var(--surface);
  --input-border:    var(--border);
  --input-fg:        var(--text);
  --input-placeholder: var(--text-muted);
  --input-radius:    var(--radius-md);
  --input-focus:     var(--primary);
  --input-danger:    var(--danger);
  --input-padding-x: var(--space-4);
  --input-height-md: 44px;
}
.c-input.is-error { --input-border: var(--input-danger); }
```

### 7.6 Accesibilidad
- `<label for>` siempre ligado al `<input id>`.
- `aria-describedby` apunta al `helper` y al `error` concatenados.
- `aria-invalid="true"` cuando `error` presente.
- Error se anuncia con `role="alert"` sólo cuando aparece por primera vez (Livewire lo renderiza dinámicamente).
- Placeholder **nunca** reemplaza label.

### 7.7 Código Blade + Livewire
```blade
@props([
  'name', 'label' => null, 'type' => 'text',
  'error' => null, 'helper' => null,
  'iconLeft' => null, 'required' => false, 'size' => 'md',
])
@php $id = $attributes->get('id', "in-{$name}"); @endphp

<div @class(['c-field', "c-field--{$size}", 'is-error' => $error])>
  @if($label)
    <label for="{{ $id }}" class="c-field__label">
      {{ $label }} @if($required)<span class="c-field__req" aria-hidden="true">*</span>@endif
    </label>
  @endif

  <div class="c-input">
    @if($iconLeft) <x-icon :name="$iconLeft" class="c-input__icon" /> @endif
    <input
      id="{{ $id }}"
      type="{{ $type }}"
      name="{{ $name }}"
      @required($required)
      aria-invalid="{{ $error ? 'true' : 'false' }}"
      aria-describedby="{{ $id }}-hint"
      {{ $attributes->class(['c-input__el']) }}
    />
  </div>

  @if($error || $helper)
    <p id="{{ $id }}-hint" @class(['c-field__hint', 'c-field__hint--error' => $error])
       @if($error) role="alert" @endif>
      {{ $error ?? $helper }}
    </p>
  @endif
</div>
```

---

## 8. Componente — Select

### 8.1 Descripción
Lista desplegable de opciones. Por defecto usa `<select>` nativo (accesibilidad y performance), con estilos custom en el *chrome*. Para búsqueda o multi-select usa la variante `Combobox` construida con Alpine + `<ul role="listbox">`.

### 8.2 Variantes
| Variante | Base | Cuándo |
|----------|------|--------|
| `native` | `<select>` | ≤ 10 opciones, estáticas |
| `combobox` | Alpine + listbox | Búsqueda, > 10 opciones, multi-select |
| `searchable` | Livewire `wire:model.live` | Remote search (productos, cursos) |

### 8.3 Props comunes
| Prop | Tipo | Descripción |
|------|------|-------------|
| `name` | string | HTML name |
| `label` | string | Etiqueta |
| `options` | array `[value => label]` | Opciones |
| `placeholder` | string | Texto inicial |
| `error` | string | Mensaje error |
| `multiple` | bool | Permite múltiple |
| `searchable` | bool | Activa filtro |

### 8.4 Estados del combobox
| Estado | Visual | ARIA |
|--------|--------|------|
| Closed | Trigger con chevron ↓ | `aria-expanded="false"` |
| Open | Lista overlay + chevron ↑ | `aria-expanded="true"` |
| Focused option | Highlight `--primary-soft` | `aria-activedescendant` |
| Selected | Check ✓ + fg `--primary` | `aria-selected="true"` |
| No results | "Sin resultados" en muted | `role="status"` |

### 8.5 Accesibilidad del combobox (WAI-ARIA)
- Trigger: `role="combobox"`, `aria-haspopup="listbox"`, `aria-controls="list-id"`.
- Listbox: `role="listbox"`, options con `role="option"`.
- Teclado: `↓/↑` mueve highlight, `Enter` selecciona, `Esc` cierra, `Home/End` primero/último, tipeo filtra.
- Focus returns al trigger al cerrar.

### 8.6 Código Alpine (combobox)
```blade
@props(['name','label','options','placeholder'=>'Selecciona…','searchable'=>true])

<div x-data="combobox({ options: @js($options) })" class="c-combobox">
  <label class="c-field__label">{{ $label }}</label>

  <button type="button" class="c-combobox__trigger"
          @click="toggle()"
          :aria-expanded="open.toString()"
          aria-haspopup="listbox"
          :aria-controls="$id('listbox')">
    <span x-text="selectedLabel || '{{ $placeholder }}'"></span>
    <x-icon name="chevron-down" class="c-combobox__chev" />
  </button>

  <ul x-show="open" x-transition.origin.top
      :id="$id('listbox')" role="listbox"
      @keydown.escape.prevent="close()"
      @keydown.arrow-down.prevent="focusNext()"
      @keydown.arrow-up.prevent="focusPrev()"
      @keydown.enter.prevent="selectFocused()"
      class="c-combobox__list">
    @if($searchable)
      <li class="c-combobox__search">
        <input x-model="q" type="search" placeholder="Buscar…" aria-label="Buscar opciones">
      </li>
    @endif
    <template x-for="(opt, idx) in filtered" :key="opt.value">
      <li role="option"
          :aria-selected="opt.value === selected"
          :class="{ 'is-focused': idx === focusIdx }"
          @click="select(opt)"
          x-text="opt.label"></li>
    </template>
  </ul>

  <input type="hidden" name="{{ $name }}" x-model="selected">
</div>
```

---

## 9. Componente — Badge

### 9.1 Descripción
Micro-etiqueta no accionable. Identifica estado, categoría, tag. Nunca es clickable — para eso se usa Chip.

### 9.2 Variantes
| Variante | Uso | Color base |
|----------|-----|-----------|
| `neutral` | Categoría genérica | `--surface-2` / `--text` |
| `brand` | Color de marca actual | `--primary-soft` / `--primary` |
| `success` | "Disponible", "Pagado" | verde |
| `warning` | "Pendiente" | ámbar |
| `danger` | "Vencido", "Fallido" | rojo |
| `info` | "Nuevo" | azul |
| `outline` | Variante discreta | sólo borde |

### 9.3 Tamaños
| Tamaño | Altura | Font |
|--------|--------|------|
| `xs` | 18px | `--text-xs` / 500 |
| `sm` | 22px | `--text-xs` / 600 |
| `md` | 26px | `--text-sm` / 600 |

### 9.4 Do / Don't
| ✅ Do | ❌ Don't |
|------|---------|
| Una palabra o dos máximo | Frases largas |
| `uppercase` en `xs` | `uppercase` con acentos problemáticos |
| Badge estado + ícono semántico | Badge sin significado ("Info", "Aviso") |

### 9.5 Código
```blade
@props(['variant' => 'neutral', 'size' => 'sm', 'icon' => null])

<span {{ $attributes->class(['c-badge', "c-badge--{$variant}", "c-badge--{$size}"]) }}>
  @if($icon)<x-icon :name="$icon" class="c-badge__icon" />@endif
  {{ $slot }}
</span>
```

---

## 10. Componente — Chip (incluye Chip magnético)

### 10.1 Descripción
Elemento accionable pequeño. Se usa para filtros, categorías seleccionables, tags removibles. Variante estrella del cliente: **Chip magnético** — ver §10.6.

### 10.2 Variantes
| Variante | Uso |
|----------|-----|
| `filter` | Activable en listados `/tienda`, `/aula/cursos` |
| `removable` | Tag con "×" (ej. filtros activos) |
| `choice` | Grupo radio-like (un solo seleccionado) |
| `magnetic` | Efecto magnético (hero, secciones de producto) |

### 10.3 Estados
| Estado | Visual |
|--------|--------|
| Default | Border `--border`, bg transparente |
| Hover | bg `--primary-soft`, border `--primary` |
| Selected | bg `--primary`, fg `--primary-fg` |
| Focus-visible | anillo `--shadow-focus` |
| Disabled | opacity 0.5 |

### 10.4 Accesibilidad
- Filtro: `<button role="switch" aria-checked>` o `<input type="checkbox" class="sr-only">` + label.
- Choice group: contenedor `role="radiogroup"` con `aria-labelledby`.
- Removable: "×" accesible como `<button aria-label="Eliminar filtro Aspel">`.

### 10.5 Código Livewire (filtros de tienda)
```blade
@props(['filters', 'activeFilters'])

<div class="c-chiplist" role="group" aria-label="Filtros de producto">
  @foreach($filters as $key => $label)
    <button
      type="button"
      role="switch"
      aria-checked="{{ in_array($key, $activeFilters) ? 'true' : 'false' }}"
      wire:click="toggleFilter('{{ $key }}')"
      @class(['c-chip', 'c-chip--filter', 'is-active' => in_array($key, $activeFilters)])
    >
      {{ $label }}
    </button>
  @endforeach
</div>
```

### 10.6 Chip magnético (observación del cliente)

**Intención:** al acercar el cursor al chip, éste se "imanta" ligeramente hacia el puntero generando una microinteracción de hover delicioso. Hasta 8px de desplazamiento. Se usa en:
- Chips de "áreas de servicio" en el hero de `/`.
- Chips de partners debajo del hero (Aspel, Soft, Zoho, MS).
- Tags de cursos destacados en `/aula`.

**Reglas:**
- Sólo en desktop hover. En touch → no se activa.
- Se desactiva si `prefers-reduced-motion: reduce`.
- No combinar con estado `selected` activo (sería confuso).
- Máximo radio de influencia: 40px.

**Código Alpine:**
```blade
@props(['href' => '#', 'label'])

<a href="{{ $href }}"
   class="c-chip c-chip--magnetic"
   x-data="magnetic({ strength: 0.25, radius: 40 })"
   @mousemove.throttle.16ms="track($event)"
   @mouseleave="reset()"
   :style="`transform: translate(${x}px, ${y}px);`"
>
  {{ $label }}
</a>

{{-- resources/js/alpine/magnetic.js --}}
<script>
Alpine.data('magnetic', ({ strength = 0.25, radius = 40 } = {}) => ({
  x: 0, y: 0,
  reduced: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
  track(e) {
    if (this.reduced) return;
    const r = e.currentTarget.getBoundingClientRect();
    const cx = r.left + r.width / 2;
    const cy = r.top  + r.height / 2;
    const dx = e.clientX - cx;
    const dy = e.clientY - cy;
    const dist = Math.hypot(dx, dy);
    if (dist > radius * 2) return this.reset();
    this.x = dx * strength;
    this.y = dy * strength;
  },
  reset() { this.x = 0; this.y = 0; }
}));
</script>
```

CSS acompañante:
```css
.c-chip--magnetic {
  transition: transform var(--duration-fast) var(--ease-spring),
              background var(--duration-fast) var(--ease-out);
  will-change: transform;
}
@media (prefers-reduced-motion: reduce) {
  .c-chip--magnetic { transition: none !important; transform: none !important; }
}
```

---

## 11. Componente — Card

### 11.1 Variantes
| Variante | Uso | Anatomía |
|----------|-----|----------|
| `product` | Tienda de licencias | media → category chip → title → price → CTA |
| `course`  | Aula — curso | thumbnail → nivel → título → duración → instructor → CTA |
| `testimonial` | Landing | quote → avatar → nombre / puesto → empresa |
| `generic` | Blog, utilidades | header → body → footer opcional |

### 11.2 Props comunes
| Prop | Tipo | Default |
|------|------|---------|
| `variant` | enum | `generic` |
| `as` | `article\|a\|div` | `article` |
| `interactive` | bool | `false` (activa hover elevation) |
| `flat` | bool | `false` (sin shadow) |

### 11.3 Tokens
```css
.c-card {
  --card-bg:       var(--surface);
  --card-border:   var(--border);
  --card-radius:   var(--radius-card, var(--radius-lg));
  --card-shadow:   var(--shadow-card, var(--shadow-sm));
  --card-padding:  var(--space-6);
  --card-gap:      var(--space-3);
}
.c-card.is-interactive:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-lg);
  transition: var(--duration-fast) var(--ease-out);
}
```

### 11.4 Card — Product (anatomía)
```
┌─────────────────────────────┐
│ [Badge promo ┄┄┄]           │
│                             │
│    [   media 4:3   ]        │
│                             │
│  marca-chip   nivel-chip    │
│  Título del producto        │
│  ★★★★☆ 4.8 (125)           │
│  $ 3,499 MXN  /año          │
│  ─────────────────────      │
│  [ Comprar ]  [ Ver más ]   │
└─────────────────────────────┘
```

### 11.5 Card — Course
```
┌─────────────────────────────┐
│ [  thumb / video preview  ] │
│ nivel · duración · modal.   │
│ Título del curso            │
│ Instructor — avatar + nombre│
│ ★★★★★ 4.9                  │
│ [ Inscribirme ]             │
└─────────────────────────────┘
```

### 11.6 Accesibilidad
- Cards clickables usan `<a>` envolvente con `<article>` dentro, o botón "Ver más" como focusable único.
- Evitar "cards-as-links" con múltiples targets: usar patrón *card block link* (un solo link primario, resto de CTAs con `stopPropagation` en JS).
- Títulos en heading apropiado para el contexto (`h3` en grids, `h2` en detalle).

---

## 12. Componente — Tabs

### 12.1 Descripción
Agrupa contenido relacionado bajo pestañas. Implementado con ARIA tabs manual en Alpine (no headlessui, no dep externa).

### 12.2 Variantes
| Variante | Uso |
|----------|-----|
| `line`    | Underline en tab activa (default) |
| `pills`   | Píldoras con bg `--primary-soft` en activa |
| `segment` | Segmented control (ideal dashboard cliente) |

### 12.3 Accesibilidad (WAI-ARIA)
- Contenedor `role="tablist"`.
- Tabs `role="tab"`, `aria-selected`, `aria-controls`, `tabindex="-1"` cuando no es la activa, `tabindex="0"` cuando lo es.
- Paneles `role="tabpanel"`, `aria-labelledby`, `tabindex="0"`.
- Teclado: `←/→` navega, `Home/End` primera/última, `Enter/Space` activa (si manual activation).
- **Activación automática** en tabs horizontales con contenido cargado; **manual** si es remote fetch.

### 12.4 Código Alpine
```blade
@props(['tabs', 'default' => 0, 'variant' => 'line'])

<div x-data="{ active: {{ $default }} }" @class(['c-tabs', "c-tabs--{$variant}"])>
  <div role="tablist" class="c-tabs__list">
    @foreach($tabs as $idx => $tab)
      <button type="button"
        :id="`tab-${{{ $idx }}}`"
        role="tab"
        :aria-selected="active === {{ $idx }}"
        :tabindex="active === {{ $idx }} ? 0 : -1"
        :aria-controls="`panel-${{{ $idx }}}`"
        @click="active = {{ $idx }}"
        @keydown.arrow-right.prevent="active = (active + 1) % {{ count($tabs) }}"
        @keydown.arrow-left.prevent="active = (active - 1 + {{ count($tabs) }}) % {{ count($tabs) }}"
        @class(['c-tabs__trigger'])
        ::class="{ 'is-active': active === {{ $idx }} }"
      >{{ $tab['label'] }}</button>
    @endforeach
  </div>

  @foreach($tabs as $idx => $tab)
    <section
      :id="`panel-${{{ $idx }}}`"
      role="tabpanel"
      :aria-labelledby="`tab-${{{ $idx }}}`"
      x-show="active === {{ $idx }}"
      tabindex="0"
      class="c-tabs__panel"
    >{!! $tab['content'] !!}</section>
  @endforeach
</div>
```

---

## 13. Componente — Modal / Dialog

### 13.1 Descripción
Capa modal bloqueante. Usada para confirmaciones, forms contextuales, vista rápida de producto, login/registro del checkout. Implementación sobre `<dialog>` nativo con fallback Alpine.

### 13.2 Variantes
| Variante | Ancho máx. | Uso |
|----------|-----------|-----|
| `sm` | 420px | Confirmaciones |
| `md` | 640px | Forms cortos |
| `lg` | 880px | Vista rápida de producto, detalle |
| `fullscreen-mobile` | — | En mobile ocupa 100vh |

### 13.3 Anatomía
```
┌──────────── header ────────────┐
│ Título            [✕ close]    │
├────────────────────────────────┤
│  body (scroll si excede)       │
├────────────────────────────────┤
│ [ acción secundaria ] [primary]│
└────────────────────────────────┘
```

### 13.4 Accesibilidad
- `<dialog open>` preferido — FOCUS trap automático, Esc cierra, backdrop por `::backdrop`.
- Si fallback: implementar focus trap en Alpine, `aria-modal="true"`, `role="dialog"`, `aria-labelledby` apuntando al título.
- Al abrir: mover focus al primer elemento accionable; al cerrar: restaurar focus al trigger.
- Bloquear scroll del body con `overflow:hidden` y compensar scrollbar para evitar layout shift.
- Esc y click en backdrop cierran a menos que sea modal *destructive-confirm*.

### 13.5 Código
```blade
@props(['id', 'title', 'size' => 'md'])

<dialog id="{{ $id }}" @class(['c-modal', "c-modal--{$size}"])
        x-data="modal()" x-on:close="$dispatch('modal-closed', { id: '{{ $id }}' })">
  <header class="c-modal__header">
    <h2 id="{{ $id }}-title" class="c-modal__title">{{ $title }}</h2>
    <button type="button" class="c-modal__close"
            @click="$el.closest('dialog').close()"
            aria-label="Cerrar modal">
      <x-icon name="x" />
    </button>
  </header>
  <div class="c-modal__body">{{ $slot }}</div>
  @isset($footer)<footer class="c-modal__footer">{{ $footer }}</footer>@endisset
</dialog>
```

Para abrir desde cualquier parte: `document.getElementById('id').showModal()`.

---

## 14. Componente — Navbar

### 14.1 Descripción
Barra superior global. Fija (sticky). Siempre en contexto **Logia** salvo que la ruta sea de producto, en cuyo caso el *switch visual* se aplica vía `data-brand` pero manteniendo la identidad Logia en el logo y footer (ver doc 01, §3).

### 14.2 Variantes
| Variante | Contexto | Altura |
|----------|----------|--------|
| `public` | Home, marketing, landings partner | 72px |
| `dashboard` | Cliente logueado | 64px |
| `aula` | Dentro de un curso/lección | 56px (compacta) |
| `admin` | Filament maneja su propia nav | — |

### 14.3 Anatomía (desktop public)
```
┌──────────────────────────────────────────────────────────────────┐
│ [LOGO Logia] [Nosotros][Productos ▾][Aula][Soporte][Blog] [🔍 🛒 👤 ↙] │
└──────────────────────────────────────────────────────────────────┘
                        ▲
             Mega-menú al hacer hover/click
```

### 14.4 Reglas
- Logo Logia a la izquierda, ampliado (cliente pidió logo más prominente — doc 01 §21 obs. 5).
- Máximo 6 ítems de primer nivel. Todo lo demás → mega-menú.
- Sticky con `backdrop-filter: blur(8px)` + `background: rgba(255,255,255,.88)` cuando se hace scroll (`.is-scrolled`).
- Icono `🛒 carrito` con contador badge `--primary`.
- Avatar usuario → menú dropdown con "Mi aula / Mis compras / Cerrar sesión".

### 14.5 Mobile
- Hamburguesa → drawer lateral full-height.
- CTA prominente "Iniciar sesión" si anónimo, avatar si logueado.
- Buscador colapsa a ícono; al tap, fullscreen search overlay.

### 14.6 Accesibilidad
- Logo envuelve `<a href="/">` con `aria-label="Logia Consulting — inicio"`.
- `<nav aria-label="Principal">` para la nav primaria.
- Skip-to-content: `<a class="sr-only-focusable" href="#main">Saltar al contenido</a>` primer elemento.
- Dropdowns con `aria-haspopup`, `aria-expanded`.
- Focus-visible siempre visible en tab navigation.

### 14.7 Código esqueleto
```blade
{{-- resources/views/layouts/partials/navbar.blade.php --}}
<header class="c-navbar" x-data="{ scrolled: false, drawerOpen: false }"
        @scroll.window="scrolled = window.scrollY > 12"
        :class="{ 'is-scrolled': scrolled }">
  <a href="#main" class="c-navbar__skip sr-only-focusable">Saltar al contenido</a>

  <div class="c-navbar__inner c-container">
    <a href="/" class="c-navbar__logo" aria-label="Logia Consulting — inicio">
      <x-brand.logia-logo />
    </a>

    <nav class="c-navbar__menu" aria-label="Principal">
      <x-navbar.item href="/nosotros">Nosotros</x-navbar.item>
      <x-navbar.mega-trigger>Productos</x-navbar.mega-trigger>
      <x-navbar.item href="/aula">Aula</x-navbar.item>
      <x-navbar.item href="/soporte">Soporte</x-navbar.item>
      <x-navbar.item href="/blog">Blog</x-navbar.item>
    </nav>

    <div class="c-navbar__actions">
      <x-navbar.search-button />
      <x-navbar.cart-button :count="$cartCount" />
      <x-navbar.user-menu :user="auth()->user()" />
    </div>

    <button class="c-navbar__hamburger" @click="drawerOpen = true"
            aria-label="Abrir menú" aria-controls="drawer-nav">
      <x-icon name="menu" />
    </button>
  </div>

  <x-navbar.mobile-drawer x-show="drawerOpen" />
</header>
```

---

## 15. Componente — Mega-Menú  *(spec crítico del cliente)*

### 15.1 Intención
El cliente pidió explícitamente un mega-menú en "Productos" que sea **didáctico, visual y accesible** — no un dropdown plano. Al hover/click sobre "Productos" se despliega un panel full-width que presenta las 4 marcas partner con su identidad, vertical y acciones destacadas. Este componente es el principal discovery de la plataforma.

### 15.2 Anatomía
```
┌────────────────── PANEL FULL-WIDTH (máx. --container-max) ──────────────────┐
│                                                                              │
│  ┌─ Col: Aspel ──┐  ┌─ Col: Soft ───┐  ┌─ Col: Zoho ──┐  ┌─ Col: MS 365 ──┐ │
│  │ logo partner  │  │ logo partner  │  │ logo partner │  │ logo partner   │ │
│  │ tagline       │  │ tagline       │  │ tagline      │  │ tagline        │ │
│  │ ─────────     │  │ ─────────     │  │ ─────────    │  │ ─────────      │ │
│  │ • Licencias   │  │ • Licencias   │  │ • Zoho One   │  │ • Microsoft 365│ │
│  │ • Cursos      │  │ • Cursos      │  │ • Módulos    │  │ • Power Plat.  │ │
│  │ • Soporte     │  │ • Soporte     │  │ • Cursos     │  │ • Cursos       │ │
│  │ • Comparativa │  │ • Hardware    │  │ • Soporte    │  │ • Copilot      │ │
│  │               │  │               │  │              │  │                │ │
│  │ [Ver tienda >]│  │ [Ver tienda >]│  │ [Ver tienda >│  │ [Ver tienda >] │ │
│  └───────────────┘  └───────────────┘  └──────────────┘  └────────────────┘ │
│                                                                              │
│  ┌─────────────────── Destacado de la semana ───────────────────────────┐   │
│  │ Imagen   │ "Aspel SAE 9.0 — 30% dto hasta 30 Abr"   [ Ver oferta ] │   │
│  └──────────────────────────────────────────────────────────────────────┘   │
└──────────────────────────────────────────────────────────────────────────────┘
```

### 15.3 Comportamiento
- **Trigger desktop:** hover con delay de 150ms (anti-flicker) **o** click (persistente).
- **Trigger mobile:** abrir → push-view lateral dentro del drawer (no mega-menú; es un acordeón de 4 marcas).
- **Cerrar:** `Esc`, click fuera, blur del último elemento focusable.
- **Focus trap** mientras está abierto.
- **Precarga:** las rutas de primer nivel de cada marca se `<link rel="prefetch">` al abrir el menú.
- Cada columna hereda el color de marca en su logo/tagline/CTA — el resto (fondo, tipografía de menú) mantiene contexto Logia.

### 15.4 Accesibilidad crítica
- Trigger: `aria-haspopup="true"`, `aria-expanded`, `aria-controls="megamenu-products"`.
- Panel: `role="menu"` o `role="region" aria-label="Productos"` (recomendado — los roles de menú son restrictivos con el teclado).
- Cada columna es un `<section aria-labelledby="col-aspel">`.
- Navegación con `Tab` natural; no robar teclas `↑↓` para emular keyboard menu (patrón que rompe expectativas del usuario).

### 15.5 Código esqueleto
```blade
{{-- resources/views/components/navbar/mega-menu.blade.php --}}
<div x-data="megaMenu()"
     x-show="open"
     x-transition.origin.top
     @mouseleave="scheduleClose()"
     @keydown.escape.window="close()"
     @click.outside="close()"
     id="megamenu-products"
     role="region"
     aria-label="Productos">

  <div class="c-mega c-container">
    <div class="c-mega__grid">
      @foreach($brands as $brand)
        <section class="c-mega__col" data-brand="{{ $brand->slug }}"
                 aria-labelledby="col-{{ $brand->slug }}">
          <div class="c-mega__head">
            <x-brand.logo :brand="$brand->slug" class="c-mega__logo" />
            <p class="c-mega__tagline">{{ $brand->tagline }}</p>
          </div>
          <ul class="c-mega__links">
            @foreach($brand->menuItems as $item)
              <li><a href="{{ $item->url }}" class="c-mega__link">{{ $item->label }}</a></li>
            @endforeach
          </ul>
          <a href="{{ $brand->storeUrl }}" class="c-btn c-btn--secondary c-btn--sm c-mega__cta">
            Ver tienda
          </a>
        </section>
      @endforeach
    </div>

    @if($featured)
      <aside class="c-mega__feature" aria-label="Destacado de la semana">
        <img src="{{ $featured->image }}" alt="" class="c-mega__feature-img">
        <div>
          <p class="c-mega__feature-kicker">Destacado</p>
          <p class="c-mega__feature-title">{{ $featured->title }}</p>
          <a href="{{ $featured->url }}" class="c-btn c-btn--primary c-btn--sm">Ver oferta</a>
        </div>
      </aside>
    @endif
  </div>
</div>
```

---

## 16. Componente — Hero

### 16.1 Descripción
Primer bloque de la página. En home y en landings de marca. Siempre incluye: título, subtítulo, CTA primario, CTA secundario opcional, y — en home — carrusel de slides con autoplay suspendible.

### 16.2 Variantes
| Variante | Altura | Uso |
|----------|--------|-----|
| `home-carousel` | 72vh (min 520px) | `/` Logia |
| `brand-landing` | 60vh (min 440px) | `/aspel`, `/soft`, `/zoho`, `/microsoft-365` |
| `section-intro` | auto (~320px) | Secciones internas (Blog, Aula) |

### 16.3 Home — carrusel
- 3–5 slides configurables desde Filament (banner editable — doc 01 §21 obs. 2).
- Autoplay cada 6s, pausa en hover, pausa si `prefers-reduced-motion`.
- Transición: crossfade 400ms `--ease-in-out`.
- Controles: flechas ←/→ visibles en desktop, dots siempre, swipe en touch.
- Cada slide: imagen BG + gradiente a texto + H1 + subtítulo + CTA primario (+ secundario opcional).

### 16.4 Accesibilidad
- Contenedor `role="region" aria-roledescription="carousel" aria-label="Destacados"`.
- Slides en `aria-live="polite"` para anuncios (sólo cuando autoplay está pausado por usuario).
- Botón Play/Pause obligatorio (WCAG 2.2 — Pause/Stop/Hide).
- Cada slide tiene `role="group" aria-roledescription="slide" aria-label="Slide 2 de 4"`.
- Dots: `<button aria-label="Ir al slide 3" aria-current="true|false">`.

### 16.5 Tokens
```css
.c-hero {
  --hero-bg:        var(--surface);
  --hero-fg:        var(--text);
  --hero-kicker:    var(--primary);
  --hero-title-size: clamp(var(--text-3xl), 5vw, var(--text-5xl));
  --hero-padding:   clamp(var(--space-12), 10vw, var(--space-24));
  --hero-overlay:   linear-gradient(180deg, rgba(0,0,0,.1), rgba(0,0,0,.55));
}
```

---

## 17. Componente — Product 3D Card

### 17.1 Intención (observación cliente, doc 01 §21 obs. 4)
La card de producto destacada en `/` y en hubs de marca tiene un efecto 3D tilt: al mover el cursor sobre la card, ésta rota ligeramente en perspectiva y el artwork de producto flota un par de píxeles por encima con sombra proyectada. Inspiración: packaging de Apple, iPad hover effect. **Nunca invasivo** — rotación máx. 8°, perspective 900px.

### 17.2 Estructura
```
┌────────────────── c-prod3d ──────────────────┐
│ perspective-wrapper                           │
│  └─ tilt-layer (rotateX/rotateY)              │
│      ├─ card-frame (gradiente marca sutil)    │
│      ├─ product-image (float 8px en hover)    │
│      └─ gloss-overlay (highlight siguiendo    │
│          cursor — opacidad 0.25 máx)          │
└───────────────────────────────────────────────┘
         │ info debajo (título, precio, CTA)
```

### 17.3 Parámetros
| Param | Default | Rango |
|-------|---------|-------|
| `maxRotate` | 8° | 0–15° |
| `perspective` | 900px | 600–1200 |
| `floatDistance` | 8px | 0–16 |
| `glossOpacity` | 0.25 | 0–0.45 |
| `damping` | 0.15 | 0.05–0.3 |

### 17.4 Accesibilidad y fallback
- Si `prefers-reduced-motion: reduce` → desactiva tilt y gloss, deja sólo `transform: translateZ(0)` estable.
- Touch: sin efecto (solo `:active` lift).
- Focus keyboard: efecto sustituto — borde `--primary` 2px + elevación fija.
- El contenido textual nunca depende del tilt.

### 17.5 Código Alpine (esqueleto)
```blade
@props(['product'])

<article class="c-prod3d"
  x-data="tiltCard({ maxRotate: 8, perspective: 900, floatDistance: 8, glossOpacity: 0.25 })"
  @mousemove.throttle.16ms="track($event)"
  @mouseleave="reset()"
  @focusin="focusPose()"
  @focusout="reset()"
>
  <div class="c-prod3d__perspective">
    <div class="c-prod3d__tilt"
         :style="`transform: rotateX(${rx}deg) rotateY(${ry}deg)`">
      <div class="c-prod3d__frame" data-brand="{{ $product->brand }}"></div>
      <img class="c-prod3d__art" src="{{ $product->image }}" alt=""
           :style="`transform: translateZ(${lift}px)`">
      <span class="c-prod3d__gloss" :style="`--gx:${gx}%;--gy:${gy}%;opacity:${gloss}`"></span>
    </div>
  </div>

  <div class="c-prod3d__meta">
    <x-badge variant="brand">{{ $product->brandLabel }}</x-badge>
    <h3 class="c-prod3d__title">{{ $product->title }}</h3>
    <p class="c-prod3d__price">{{ $product->priceFormatted }}</p>
    <x-btn :href="$product->url" variant="primary" size="md">Ver detalle</x-btn>
  </div>
</article>
```

```js
// resources/js/alpine/tilt-card.js
Alpine.data('tiltCard', (cfg) => ({
  rx: 0, ry: 0, gx: 50, gy: 50, lift: 0, gloss: 0,
  reduced: matchMedia('(prefers-reduced-motion: reduce)').matches,
  track(e) {
    if (this.reduced) return;
    const r = e.currentTarget.getBoundingClientRect();
    const nx = (e.clientX - r.left) / r.width;
    const ny = (e.clientY - r.top) / r.height;
    this.ry = (nx - 0.5) *  cfg.maxRotate * 2;
    this.rx = (0.5 - ny) *  cfg.maxRotate * 2;
    this.gx = nx * 100; this.gy = ny * 100;
    this.lift = cfg.floatDistance;
    this.gloss = cfg.glossOpacity;
  },
  reset() { this.rx = 0; this.ry = 0; this.lift = 0; this.gloss = 0; },
  focusPose() { if (!this.reduced) { this.rx = -2; this.ry = 2; this.lift = cfg.floatDistance/2; } },
}));
```

CSS:
```css
.c-prod3d__perspective { perspective: 900px; }
.c-prod3d__tilt        { transition: transform var(--duration-base) var(--ease-out); transform-style: preserve-3d; }
.c-prod3d__art         { transition: transform var(--duration-base) var(--ease-out); }
.c-prod3d__gloss       { position: absolute; inset: 0; pointer-events: none;
                         background: radial-gradient(circle at var(--gx) var(--gy), white, transparent 55%); }

@media (prefers-reduced-motion: reduce) {
  .c-prod3d__tilt, .c-prod3d__art { transition: none !important; transform: none !important; }
  .c-prod3d__gloss { display: none; }
}
```

---

## 18. Componente — Footer

### 18.1 Regla fundacional
**El footer es SIEMPRE identidad Logia.** Ninguna ruta cambia el footer a la identidad de un partner (principio P3). Esto ancla al usuario en que la plataforma es Logia Consulting — los partners son catálogo, no la marca anfitriona.

### 18.2 Anatomía (desktop)
```
┌──────────────────────────────────────────────────────────────────────┐
│                                                                      │
│  [LOGO Logia grande]    Nosotros      Productos      Aula    Blog    │
│  Integrando Tec…        · Historia    · Aspel        · Cursos        │
│                         · Oficinas    · Soft Rest.   · Certificados  │
│                         · Partners    · Zoho         · Planes        │
│                                       · Microsoft                    │
│                                                                      │
│  Soporte               Contacto          Boletín                     │
│  · Abrir ticket        WTC CDMX          [ Email… ] [ Suscribir ]    │
│  · FAQ                 Coapa             (Kit de bienvenida gratis)  │
│  · Estatus             Polanco                                       │
│                        (55) xxxx xxxx                                │
│                        contacto@logia.com                            │
│                                                                      │
│ ──────────────────────────────────────────────────────────────────── │
│  © 2026 Logia Consulting SA de CV     Aviso • Términos • Cookies    │
│  [IG] [FB] [LI] [YT]                                                 │
└──────────────────────────────────────────────────────────────────────┘
```

### 18.3 Reglas
- Fondo: `--bg` de Logia (`#FAFAFA`) o alternativa `--surface-2` para diferenciarse.
- Logo: versión horizontal oficial de MICLOGIA.pdf, alto 56px.
- Columnas: `grid-template-columns: 2fr repeat(4, 1fr)` en desktop; 1 columna en móvil.
- Suscripción: input + botón, action a ruta Laravel, honeypot anti-bot, confirmación inline.
- Redes sociales: íconos monocromos `--brand-gray`, hover a `--primary`.
- Sello de confianza: "Partner autorizado de Aspel, Soft Restaurant, Zoho y Microsoft" (chips pequeños, monocromos).

### 18.4 Accesibilidad
- `<footer role="contentinfo">`.
- Cada sección con `<h2>` o `<h3>` semántico, con `sr-only` si el diseño no muestra título.
- Links de social media con `aria-label` explícito (ícono no es texto).
- Contacto: tel con `<a href="tel:...">`, email con `<a href="mailto:...">`.

---

## 19. Accesibilidad — checklist WCAG 2.1 AA

### 19.1 Checklist por PR
Antes de mergear un componente, marcar todo:

- [ ] Contraste de texto ≥ 4.5:1 (body) o ≥ 3:1 (large ≥18pt / 14pt bold).
- [ ] Contraste de UI (borders, iconos accionables) ≥ 3:1.
- [ ] Focus-visible claramente perceptible (ring ≥2px o equivalente).
- [ ] Todo el componente operable con teclado (Tab, Shift+Tab, Enter, Espacio, flechas donde aplique).
- [ ] Roles ARIA y atributos correctos (revisar contra WAI-ARIA Authoring Practices).
- [ ] Imágenes decorativas con `alt=""`; informativas con texto alternativo útil.
- [ ] Formularios: `<label for>` siempre, `aria-describedby` para helper/error, `aria-invalid` en error.
- [ ] Motion: respeta `prefers-reduced-motion`.
- [ ] Zoom 200%: no hay pérdida de contenido, scroll horizontal evitado.
- [ ] Test con lector de pantalla (VoiceOver macOS + NVDA Windows en al menos un PR por sprint).

### 19.2 Tokens de foco
```css
:focus-visible {
  outline: 3px solid color-mix(in srgb, var(--primary) 60%, white);
  outline-offset: 2px;
  border-radius: inherit;
}
```
Nunca desactivar `outline` sin reemplazo visible.

### 19.3 Prueba automatizada
- `@axe-core/playwright` corriendo en CI sobre las rutas clave (`/`, `/aspel`, `/aula`, checkout, login).
- Falla el build si encuentra issues `serious` o `critical`.

---

## 20. Convenciones de código — Blade + Livewire + Alpine

### 20.1 Estructura de carpetas
```
resources/
├── views/
│   ├── components/          ← design system (c-*)
│   │   ├── btn.blade.php
│   │   ├── card/
│   │   │   ├── product.blade.php
│   │   │   └── course.blade.php
│   │   ├── navbar/
│   │   ├── hero/
│   │   └── prod3d.blade.php
│   ├── layouts/
│   │   ├── public.blade.php
│   │   ├── dashboard.blade.php
│   │   └── aula.blade.php
│   └── pages/               ← rutas
├── css/
│   ├── tokens/              ← capa 1
│   │   └── globals.css
│   ├── brands/              ← capa 2
│   │   ├── logia.css
│   │   ├── aspel.css
│   │   └── …
│   ├── components/          ← capa 3
│   │   ├── btn.css
│   │   ├── card.css
│   │   └── …
│   └── app.css              ← imports
└── js/
    ├── alpine/
    │   ├── magnetic.js
    │   ├── tilt-card.js
    │   └── mega-menu.js
    └── app.js
```

### 20.2 Reglas
- **Cero hex codes en Blade.** Siempre `var(--…)`.
- **Una feature = un commit.** El componente viene con su CSS, su doc en este archivo y sus tests.
- **Livewire sólo cuando hay estado reactivo real.** Lista de productos estática → Blade. Carrito que actualiza total en vivo → Livewire.
- **Alpine sólo para micro-interacciones:** toggles, tilt, magnetic, focus traps. No para estado de negocio.
- **Nombres:** componentes Blade en kebab-case (`x-btn`), clases CSS con prefijo `c-`, Alpine `data` en camelCase.
- **Sin `@inject` en componentes** — recibir por props.

### 20.3 Patrón Livewire recomendado
```php
// app/Livewire/ProductCatalog.php
class ProductCatalog extends Component
{
    #[Url(as: 'marca')]
    public ?string $brand = null;

    #[Url(as: 'q')]
    public string $search = '';

    public function render()
    {
        return view('livewire.product-catalog', [
            'products' => Product::query()
                ->when($this->brand, fn($q) => $q->whereRelation('brand','slug',$this->brand))
                ->when($this->search, fn($q) => $q->where('title','like',"%{$this->search}%"))
                ->paginate(12),
        ]);
    }
}
```

---

## 21. Matriz marca × componente

> ✅ = usado / soportado. 🔶 = usado con override específico. ➖ = no aplica.

| Componente        | Logia | Aspel | Soft | Zoho | MS 365 |
|-------------------|:-----:|:-----:|:----:|:----:|:------:|
| Button            |  ✅   |  ✅   |  🔶¹ |  🔶² |  🔶³   |
| Input / Form      |  ✅   |  ✅   |  ✅  |  ✅  |  ✅    |
| Select / Combobox |  ✅   |  ✅   |  ✅  |  ✅  |  ✅    |
| Badge             |  ✅   |  ✅   |  ✅  |  ✅  |  ✅    |
| Chip              |  ✅   |  ✅   |  ✅  |  ✅  |  ✅    |
| Chip magnético    |  ✅   |  ✅   |  ✅  |  ✅  |  ➖⁴   |
| Card (product)    |  ✅   |  ✅   |  ✅  |  ✅  |  ✅    |
| Card (course)     |  ✅   |  ✅   |  ✅  |  ✅  |  ✅    |
| Card testimonial  |  ✅   |  ➖   |  ➖  |  ➖  |  ➖    |
| Tabs              |  ✅   |  ✅   |  ✅  |  ✅  |  ✅    |
| Modal             |  ✅   |  ✅   |  ✅  |  ✅  |  ✅    |
| Navbar            |  ✅   |  ➖⁵ |  ➖⁵ |  ➖⁵ |  ➖⁵  |
| Mega-menú         |  ✅   |  ➖   |  ➖  |  ➖  |  ➖    |
| Hero (carousel)   |  ✅   |  ➖   |  ➖  |  ➖  |  ➖    |
| Hero (landing)    |  ➖   |  ✅   |  ✅  |  ✅  |  ✅    |
| Product 3D Card   |  ✅   |  ✅   |  ✅  |  ✅  |  🔶⁶   |
| Footer            |  ✅   |  ➖⁵ |  ➖⁵ |  ➖⁵ |  ➖⁵  |

¹ Soft: texto bold obligatorio sobre naranja.
² Zoho: `--radius-btn: 4px` más recto por identidad Puvi/Lato.
³ MS 365: Fluent 2 — `border-radius: 4px`, shadow más sutil, hover sin translateY.
⁴ MS 365 desactiva chip magnético — Fluent huye de movimiento decorativo.
⁵ Navbar y Footer siempre en contexto Logia (principio P3).
⁶ MS 365 usa tilt pero con `maxRotate: 4°` (más contenido) y sin gloss.

---

## 22. Pendientes de reconciliar

### 22.1 Resueltos en esta versión
- ✅ Paleta Logia oficial extraída de `MICLOGIA.pdf` (Pantone 1505 C / 424 C / Cool Gray 1 C / 285 C).
- ✅ Tipografía Logia confirmada: Helvetica + Helvetica Neue.
- ✅ Swoosh naranja y regla de uso naranja-sobre-blanco documentada.

### 22.2 Abiertos
- ⏳ Versionar el logo Logia oficial como SVG optimizado en `resources/svg/brand/logia-{horizontal,vertical,mark}.svg`. El PDF contiene las 4 variantes (color, gris, B&W, mono azul, mono naranja) — exportar todas.
- ⏳ Revisar si Helvetica debe servirse self-host (legal / rendering) o si se acepta fallback a Arial / system-ui según cliente.
- ⏳ Confirmar con partners (Aspel, Soft, Zoho, MS) autorización escrita para usar sus logotipos y paletas en el sitio. Adjuntar a carpeta legal.
- ⏳ Refinar tokens de Zoho One revisando material oficial (actualmente basado en observación de sitio público).
- ⏳ Capturar 3 screenshots reales de cada marca en producción (del sitio oficial) para regresión visual una vez hecha la implementación.
- ⏳ Definir si el *banner editable* de home requiere también CMS de slides para landings de marca (probable — dejar arquitectura lista).

---

## 23. Apéndice — referencia completa de tokens

### A.1 Tokens globales (copy-paste a `resources/css/tokens/globals.css`)

```css
:root {
  /* Spacing */
  --space-0:0; --space-1:4px; --space-2:8px; --space-3:12px; --space-4:16px;
  --space-5:20px; --space-6:24px; --space-8:32px; --space-10:40px; --space-12:48px;
  --space-16:64px; --space-20:80px; --space-24:96px; --space-32:128px;

  /* Radius */
  --radius-none:0; --radius-xs:2px; --radius-sm:4px; --radius-md:8px;
  --radius-lg:12px; --radius-xl:16px; --radius-2xl:24px; --radius-pill:9999px;

  /* Shadows */
  --shadow-none:none;
  --shadow-sm: 0 1px 2px rgba(15,23,42,.06);
  --shadow-md: 0 4px 10px rgba(15,23,42,.08);
  --shadow-lg: 0 10px 24px rgba(15,23,42,.10);
  --shadow-xl: 0 20px 48px rgba(15,23,42,.14);
  --shadow-focus: 0 0 0 3px rgba(59,130,246,.35);

  /* Motion */
  --duration-instant:80ms; --duration-fast:150ms; --duration-base:250ms;
  --duration-slow:400ms;   --duration-slower:600ms;
  --ease-out: cubic-bezier(0.2,0.8,0.2,1);
  --ease-in-out: cubic-bezier(0.4,0,0.2,1);
  --ease-spring: cubic-bezier(0.34,1.56,0.64,1);
  --ease-linear: linear;

  /* z-index */
  --z-base:0; --z-dropdown:100; --z-sticky:200; --z-fixed:300;
  --z-megamenu:400; --z-modal-bg:500; --z-modal:510; --z-toast:600; --z-tooltip:700;

  /* Type scale */
  --text-xs:.75rem; --text-sm:.875rem; --text-base:1rem; --text-md:1.125rem;
  --text-lg:1.25rem; --text-xl:1.5rem; --text-2xl:1.875rem; --text-3xl:2.25rem;
  --text-4xl:3rem; --text-5xl:3.75rem; --text-6xl:4.5rem;

  --leading-tight:1.15; --leading-snug:1.3; --leading-normal:1.5; --leading-relaxed:1.65;
  --tracking-tight:-0.02em; --tracking-normal:0; --tracking-wide:0.04em;
  --weight-regular:400; --weight-medium:500; --weight-semibold:600; --weight-bold:700;

  /* Layout */
  --container-max:1280px; --container-narrow:880px;
  --gutter-mobile:16px;   --gutter-desktop:32px;
  --header-height:72px;   --header-height-compact:56px;
}

@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
    scroll-behavior: auto !important;
  }
}
```

### A.2 Tokens de marca — reference card (paletas oficiales del cliente)

| Token | Logia | Aspel | Soft Rest. | Zoho One | MS 365 |
|-------|-------|-------|-----------|----------|--------|
| `--primary` | `#FF6B00` | `#009DFF` | `#E25724` | `#E42527` | `#05A6F0` |
| `--primary-fg` | `#FFFFFF` | `#FFFFFF` | `#FFFFFF` | `#FFFFFF` | `#FFFFFF` |
| `--primary-alt` | — | — | `#E7803C` | — | — |
| `--accent` | `#0071CE` | `#3B4758` | `#584569` | `#226DB4` | `#F35325` |
| `--bg` | `#FAFAFA` | `#F5F8FC` | `#FFF7F1` | `#F8F8F6` | `#FAFAFA` |
| `--surface` | `#FFFFFF` | `#FFFFFF` | `#FFFFFF` | `#FFFFFF` | `#FFFFFF` |
| `--border` | `#DBD9D6` | `#AAB0B8` | `#E8C9B3` | `#D8D4C7` | `#E1DFDD` |
| `--text` | `#2A2A2A` | `#1A2230` | `#3C3B44` | `#1B1B1B` | `#081C28` |
| `--text-muted` | `#717271` | `#3B4758` | `#6B6773` | `#5A5A5A` | `#4A5766` |
| `--success` | `#16A34A` | `#16A34A` | `#16A34A` | `#089949` | `#81BC06` |
| `--warning` | `#F59E0B` | `#F59E0B` | `#F59E0B` | `#F9B21D` | `#FFBA08` |
| `--danger` | `#DC2626` | `#DC2626` | `#DC2626` | `#E42527` | `#F35325` |
| `--info` | `#0071CE` | `#009DFF` | `#584569` | `#226DB4` | `#05A6F0` |
| `--font-display` | Helvetica Neue | Gotham / Montserrat | Manrope | Puvi / Lato | Segoe UI Variable |
| `--font-body` | Helvetica | Roboto | Inter | Lato | Segoe UI Variable |
| `--radius-btn` | 10px | 8px | 12px | 4px | 4px |
| `--radius-card` | 12px | 10px | 14px | 6px | 4px |

**Origen de códigos oficiales (entregados por el cliente el 21-abr-2026):**
- Aspel: `#009DFF`, `#3B4758`, `#AAB0B8`.
- Soft Restaurant: `#E7803C`, `#E25724`, `#584569`, `#3C3B44`.
- Zoho One (chips del logo): `#E42527`, `#089949`, `#226DB4`, `#F9B21D`.
- Microsoft 365 (cuadrado + navy): `#F35325`, `#81BC06`, `#05A6F0`, `#FFBA08`, `#081C28`.
- Logia: `MICLOGIA.pdf` → Pantone 1505 C / 285 C / 424 C / Cool Gray 1 C.

### A.3 Snippet de aplicación en layout raíz
```blade
{{-- resources/views/layouts/public.blade.php --}}
<!DOCTYPE html>
<html lang="es-MX" data-brand="{{ brand_context() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') — Logia Consulting</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="c-body">
  @include('layouts.partials.navbar')
  <main id="main" class="c-main">
    {{ $slot }}
  </main>
  @include('layouts.partials.footer')
</body>
</html>
```

El helper `brand_context()` lee del middleware `ResolveBrandContext` (doc 01 §9.3).

---

**Fin del documento.** Este design system se versiona con el código y se actualiza en el mismo PR que cada componente. Cualquier divergencia entre lo implementado y este doc se considera bug.

