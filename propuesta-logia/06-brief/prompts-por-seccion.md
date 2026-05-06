# Prompts listos para pegar en la IA — sección por sección

Úsalos en orden. No pidas la home completa de un solo prompt — se cicla.

---

## 1. HERO (3 variantes)

### Variante A — Dark editorial
```
Diseña un hero section premium B2B con fondo #0A0A0B. Headline editorial gigante
"Veinticinco años transformando empresas" en serif display, tracking -0.04em,
clamp(3.5rem, 7vw, 6.5rem), color #EDEDED. Subheadline 18px en gris #999.
Video cinematográfico loop como fondo (oficina mexicana al atardecer, plano lento).
Overlay gradiente sutil para legibilidad. Layout asimétrico: texto a la izquierda
60%, espacio respirado a la derecha 40%. CTA primario naranja #FF6B00 redondeado
con micro-animación magnética. CTA secundario fantasma con borde fino. Navbar
sticky transparente con logo Logia + 6 links + botón Agendar. Ultra-detailed,
magazine quality. NO gradientes morado-rosa. NO iconos 3D. NO stock photos.
```

### Variante B — Cream warm
```
Hero section premium con fondo crema #F5F1EA. Headline grotesque pesada
"Veinticinco años. Cero pretextos." Tipografía display tipo GT Sectra o Söhne
Breit, tamaño clamp(4rem, 8vw, 7rem), tracking -0.05em, color #1A1A1A.
Foto editorial a la derecha ocupando bleed edge derecho hasta el viewport:
manos sobre teclado, luz natural dura, color grading Kodak Portra 400.
Layout 50/50 con asimetría en alturas. CTA primario sólido negro con flecha.
Texto cómodo 20px line-height 1.6. Navbar minimalista. NO blanco puro.
NO centrado. Aesthetic: New York Times + Linear app.
```

### Variante C — Brand vibrant chameleon
```
Hero B2B multimarca con fondo neutro warm #1A1614. Headline gigante
"Una plataforma. Cuatro mundos." Cada palabra de "Cuatro mundos" pintada
en color de cada marca: Aspel azul #009DFF, Soft Restaurant cobre #E25724,
Zoho rojo #E42527, Microsoft azul #05A6F0. Display serif moderna,
clamp(3.5rem, 7vw, 6rem). A la derecha: 4 cards verticales apiladas con
asimetría, cada una con el logo oficial de una marca y su paleta completa
de fondo. Hover: card se eleva + scale 1.03 + el resto del hero adopta su
color de marca. Cinematic, premium, editorial. NO gradientes random.
```

---

## 2. STATS STRIP

```
Sección horizontal full-bleed después del hero. 4 stats con números
gigantes a 128px en font display: "25+", "4,600", "2,000", "97.3%".
Label pequeña 14px uppercase tracking +0.2em debajo de cada número:
"AÑOS", "USUARIOS CAPACITADOS", "CLIENTES ACTIVOS", "SATISFACCIÓN".
Separadores verticales finos #2A2A2A entre stats. Animación count-up
al entrar al viewport con cubic-bezier(0.16, 1, 0.3, 1). Padding vertical
generoso 120px. Sin íconos. Sin decoración.
```

---

## 3. PRODUCTOS DESTACADOS

```
Sección grid asimétrico 12 columnas. Card grande izquierda 8 columnas
mostrando producto destacado (Aspel SAE) con mockup real del software,
nombre tipografía display 56px, precio grande, badge "Best seller",
CTA "Ver detalles". Lado derecho 4 columnas con 3 cards verticales
apiladas más pequeñas (Zoho One, Microsoft 365, Soft Restaurant Pro)
cada una mostrando logo oficial + nombre + precio + flecha. Hover en
cualquier card: scale 1.02, elevation, color de fondo adopta paleta
de la marca con cubic-bezier(0.34, 1.56, 0.64, 1). Padding 120px.
Encabezado de sección a la izquierda: "Productos destacados" 80px
+ párrafo corto 18px alineado abajo a la derecha asimétrico.
```

---

## 4. TESTIMONIALES EN ÓRBITA CIRCULAR

```
Sección altura 100vh con 6 cards circulares (180px diámetro) dispuestas
en órbita alrededor de un punto central. Card central 360px más grande
muestra: foto circular, nombre 32px, cargo 16px gris, quote 24px serif
italic máximo 25 palabras, logo de empresa pequeño abajo. Las 6 cards
periféricas solo muestran foto circular. Click o flecha izq/der rota la
órbita 60 grados con cubic-bezier(0.34, 1.56, 0.64, 1) duración 600ms,
la card que llega al centro se expande al tamaño grande con cross-fade.
Drag horizontal con mouse también rota. Soporte teclado ← →. Respeta
prefers-reduced-motion (transición simple sin órbita). Fondo crema
warm o dark según dirección elegida. Fotos REALES, no avatares.
```

---

## 5. BANNER SEPARADOR

```
Full-bleed altura 80vh. Video cinematográfico loop de fondo:
plano lento de equipo Logia trabajando en oficina CDMX o capacitación
DC-3 en aula. Overlay #00000060 para legibilidad. Headline centrado
asimétrico hacia abajo-izquierda 96px display "No vendemos software.
Vendemos certeza." Single CTA outline blanco "Conoce nuestra historia".
Parallax sutil al scroll: el video se mueve más lento que el contenido.
```

---

## 6. MEMBRESÍAS DE SOPORTE

```
Sección con encabezado "El soporte que tu operación necesita" 80px.
3 pricing cards lado a lado. La del medio destacada: elevación mayor,
borde naranja #FF6B00 fino, badge "Más popular" arriba. Cada card:
nombre del plan 32px, precio gigante 64px display, "/mes" pequeño,
toggle mensual/anual arriba de la sección con descuento visible,
lista de 5-7 features con checkmarks finos, CTA al fondo.
Layout 33/33/33 con la del medio scale 1.05. Hover: elevación sutil.
Padding vertical 160px.
```

---

## 7. SECCIÓN BRAND CHAMELEON (4 marcas)

```
Sección full-bleed con 4 paneles horizontales 25% cada uno. Cada panel
muestra logo oficial de marca + tagline + CTA. Hover en panel: ese panel
se expande a 40% empujando los otros, fondo adopta paleta completa
de la marca, tipografía cambia a la de marca, aparece preview de
producto destacado con mockup real. Transición cubic-bezier(0.34, 1.56,
0.64, 1) duración 500ms. Demuestra el "Brand Chameleon" en acción.
Encima de los 4 paneles, headline editorial "Cuatro marcas. Una experiencia."
```

---

## 8. CINTA INFINITA DE LOGOS

```
Cinta horizontal full-bleed con 10 logos de clientes top en escala de grises
opacity 0.5. Animación CSS scroll lineal infinita 40s, loop sin cortes
(duplicar logos). Pause on hover. Logo individual en hover: opacity 1 +
color original. Padding vertical 80px. Fondo contrastante con la sección
anterior. Encima en pequeño uppercase tracking +0.3em: "ELLOS YA CONFÍAN
EN LOGIA".
```

---

## 9. ACADEMIA

```
Sección 2 columnas 50/50. Izquierda: headline display 72px "Capacitación
con certificación oficial DC-3", párrafo corto 18px, badge oficial DC-3,
3 stats inline (1,700 cursos / 4,600 alumnos / 8 instructores), CTA
"Explora la academia". Derecha: stack 3D de 3 course cards levemente
rotadas (-3°, 0°, +3°), cada una con thumbnail real del curso + título
+ duración + precio. Hover: separación de las 3 cards, cada una rota
a 0°. Fondo dark contrastante. Padding 160px.
```

---

## 10. FOOTER

```
Footer dark #0A0A0B con identidad Logia (naranja #FF6B00 en acentos).
Sección superior: logo Logia grande + tagline + 3 oficinas con dirección
y mapa pin (WTC, Coapa, Polanco). 5 columnas debajo: Productos, Campus,
Soporte, Logia, Legal. Cada columna con 5-6 links. Sección inferior:
copyright, redes sociales, certificaciones partner (Aspel, Zoho, Microsoft,
Soft Restaurant) en pequeño. Tipografía cómoda 14px. Hover en links:
underline con offset.
```

---

## NOTAS DE ITERACIÓN

- Si la IA mete gradientes morado-rosa: pídelo de nuevo con "NO purple gradients, editorial flat colors only".
- Si mete iconos 3D: "use simple line icons or no icons at all".
- Si mete stock photos genéricas: "use the photos I uploaded, do not invent new people".
- Si centra todo: "asymmetric layouts only, never center-aligned compositions".
