# Logia Consulting — Brand Pack v1.2

Paquete de handoff para **Claude Design**, Figma, o cualquier diseñador/developer que se sume al proyecto.

## Contenido

| Archivo | Qué es | Consumidores |
|---------|--------|-------------|
| `brief.md` | Contexto ejecutivo en 1 página. Leer PRIMERO. | Humanos, Claude Design, LLMs |
| `tokens.css` | Tokens en CSS Custom Properties. Copy-paste a `resources/css/tokens/`. | Laravel / Tailwind / HTML |
| `tokens.json` | Mismos tokens en formato **W3C Design Tokens Community Group**. | Figma Tokens Studio, Style Dictionary, Claude Design |
| `brand-preview.html` | HTML estático auto-contenido con los 13 componentes renderizados en las 5 marcas. | Humanos (revisión visual), Claude Design (referencia) |
| `../docs/01-sitemap-y-arquitectura.md` | Sitemap + arquitectura. | Claude Design, devs |
| `../docs/02-design-system.md` | Design System completo. | Claude Design, devs |
| `../public/images/` | Logos Logia oficiales (10 variantes PNG). | UI, Claude Design |

## Cómo usar con Claude Design

1. Crear un nuevo proyecto en Claude Design (claude.ai → Design).
2. Subir: `brief.md`, `tokens.json`, `brand-preview.html`, `../docs/02-design-system.md`, `../docs/01-sitemap-y-arquitectura.md`, y los 10 PNG de `../public/images/`.
3. Primer prompt sugerido (copiar literal):

```
Lee brief.md como norte del proyecto. Luego lee tokens.json y el design-system.md — ese es tu sistema; jamás hardcodees hex codes, siempre usa los tokens con data-brand.

Genera el prototipo clickable de tres pantallas:

1. Home (`/`) en contexto data-brand="logia".
   - Navbar sticky con logo Logia (usa Original_Logo_Logia_Consulting.png).
   - Mega-menú activable sobre "Productos" con las 4 marcas partner en columnas.
   - Hero carrusel de 3 slides (ver 02-design-system §16.3).
   - Sección "Áreas de servicio" con chips magnéticos.
   - Sección "Productos destacados" con 3 Product-3D-Cards (un Aspel, un Soft, un Zoho).
   - Footer SIEMPRE Logia.

2. Landing de marca Aspel (`/aspel`) con data-brand="aspel".
   - Idéntico skeleton pero todos los colores, bg, border-radius y shadows cambian al theme Aspel.
   - Navbar y footer siguen siendo Logia (principio P3).

3. PDP de un producto Aspel (`/aspel/contabilidad/aspel-coi`) con data-brand="aspel".
   - Breadcrumb, galería, 3D-card del producto, tabs de "Descripción / Características / Requerimientos / Soporte", CTA "Comprar licencia".

Reglas:
- Respeta WCAG AA.
- Respeta prefers-reduced-motion en chips magnéticos y 3D-cards.
- El logo Logia siempre en versión color sobre fondos claros.
- No inventes copy legal; usa placeholders "Lorem consulting…".
```

4. Iterar con voz o comentarios inline; exportar a HTML o Claude Code cuando estén aprobadas.

## Cómo usar sin Claude Design

- **Figma:** importar `tokens.json` con [Tokens Studio](https://tokens.studio/).
- **Laravel/Tailwind:** copiar `tokens.css` a `resources/css/tokens/globals.css` y los bloques `[data-brand]` a `resources/css/brands/*.css`. Ver convenciones de código en `docs/02-design-system.md` §20.
- **Humano diseñando en CorelDRAW / Illustrator:** paleta oficial está en §4.1 del design system (Pantone 1505 C / 424 C / Cool Gray 1 C / 285 C).

## Versionado

- **v1.2 — 21-Abril-2026.** Microsoft 365 reconciliado con la paleta oficial del cliente: `#05A6F0` (Outlook) + `#F35325` (PowerPoint) + `#81BC06` (Excel) + `#FFBA08` (Office) + `#081C28` (navy). Semánticos mapeados a los chips del cuadrado Microsoft.
- **v1.1 — 21-Abril-2026.** Aspel / Soft Restaurant / Zoho One reconciliados con paletas oficiales del cliente. Aspel: `#009DFF` / `#3B4758` / `#AAB0B8`. Soft: `#E25724` + `#E7803C` + `#584569` + `#3C3B44`. Zoho: 4 chips del logo (`#E42527` / `#226DB4` / `#089949` / `#F9B21D`) mapeados directo a semánticos.
- **v1.0 — 21-Abril-2026.** Paleta Logia reconciliada con MICLOGIA.pdf. 13 componentes documentados. 5 marcas (Logia + Aspel + Soft Restaurant + Zoho One + Microsoft 365).

Cualquier cambio de tokens implica bump de versión mayor y PR que actualice `tokens.css`, `tokens.json`, `docs/02-design-system.md` §A.2 y este README en el mismo commit.
