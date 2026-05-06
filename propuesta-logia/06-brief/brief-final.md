# Brief final para IA — Pegar tal cual en Framer / v0 / Lovable

PROYECTO: Rediseño homepage Logia Consulting (B2B, México)

CONTEXTO:
Consultora con 25+ años. Vende licencias y capacitación de 4 marcas:
Siigo Aspel, Soft Restaurant, Zoho One, Microsoft 365.
Además vende membresías de soporte (su negocio principal).
Stats: 2,000+ clientes, 4,600+ usuarios capacitados, 1,700+ cursos, 97.3% satisfacción.
3 oficinas en CDMX (WTC, Coapa, Polanco).

PROBLEMA:
Versión actual "se ve de IA" según cliente. Plana, angosta, texto saturado, efectos básicos.
Necesito justo lo contrario: editorial premium tipo Linear, Stripe, Vercel, Arc Browser.

REFERENCIAS QUE SÍ:
- Linear.app (tipografía editorial, dark mode pulido)
- Stripe.com (gradientes con propósito, jerarquía clara)
- Vercel.com (denso pero respirado)
- Arc.net (movimiento con personalidad)
- Apple.com/business (escala y dignidad)
- Notion.so (warm minimalism)

REGLAS NO NEGOCIABLES (NO HACER):
- NO gradientes morado→rosa→azul
- NO iconos 3D flotantes
- NO stock photos genéricas de gente sonriendo
- NO fondo blanco puro #FFFFFF
- NO todo centrado al medio
- NO headlines de más de 10 palabras
- NO cards todas del mismo tamaño
- NO avatares con iniciales en lugar de fotos
- NO efectos hover triviales (solo cambiar color)

REGLAS SÍ:
- Fondo crema #F5F1EA o negro #0A0A0B (elegir UNA dirección)
- Tipografía editorial: headlines clamp(3.5rem, 7vw, 6.5rem), tracking -0.04em
- Combinar 2 familias: display (serif moderna o grotesque pesada) + sans neutra
- Layouts asimétricos 60/40 o 70/30
- Video loop cinematográfico en hero
- Bleed edges (imágenes que tocan el borde del viewport)
- Acentos de color con restricción (naranja Logia solo en CTAs clave)
- Animaciones snappy: cubic-bezier(0.34, 1.56, 0.64, 1)
- Padding vertical entre secciones: 120-160px
- Container 1440px o full-bleed con padding lateral

ESTRUCTURA DEL HOME (orden estricto pedido por cliente):
1. HERO con video cinematográfico loop + headline editorial gigante + 1 CTA primario + 1 secundario
2. STATS STRIP: 25 años / 4,600 usuarios / 2,000 clientes / 97.3% (números a 96-128px)
3. PRODUCTOS DESTACADOS: grid asimétrico (1 grande + 3 chicos), no carrusel
4. TESTIMONIALES EN ÓRBITA CIRCULAR: 6 cards con foto+nombre+cargo+quote, rotación clicky-snappy con flechas/mouse/teclado
5. BANNER SEPARADOR: full-bleed 70-80vh, video o foto de impacto + 1 frase + 1 CTA
6. MEMBRESÍAS DE SOPORTE: 3 planes lado a lado, el del medio destacado con elevación + acento de color
7. SECCIÓN BRAND CHAMELEON: 4 marcas (Aspel, Soft Restaurant, Zoho, Microsoft 365) que cambian colores al hover/scroll
8. CINTA INFINITA DE LOGOS: top 10 clientes en escala de grises, color en hover, scroll horizontal infinito
9. ACADEMIA: e-learning con 3 cursos destacados + DC-3 badge
10. FOOTER: identidad Logia (naranja), 3 oficinas, links, legal

PALETAS DE MARCA:
- Logia: naranja #FF6B00, gris #717271, azul #0071CE
- Aspel: azul #009DFF, gris-azul #3B4758
- Soft Restaurant: cobre #E25724, púrpura #584569, carbón #3C3B44
- Zoho: usar las 4 juntas — rojo #E42527, azul #226DB4, verde #089949, amarillo #F9B21D
- Microsoft 365: azul #05A6F0, naranja #F35325, verde #81BC06, amarillo #FFBA08, navy #081C28

ASSETS QUE SUBO:
- Logos oficiales 4 marcas (carpeta 01-marcas)
- Iconos de productos Zoho (pedido explícito del cliente)
- 6 fotos reales de testimoniales (carpeta 03-clientes)
- 10 logos de clientes (carpeta 03-clientes/logos-top-10)
- 3-5 videos cinematográficos para hero (carpeta 07-videos-hero)
- Screenshots reales de software (carpeta 01-marcas/*/screenshots-software)
- Fotos de oficinas Logia (carpeta 02-empresa)
- Banco de fotos humanas: ejecutivos en traje, equipos trabajando, reuniones,
  capacitaciones, atención al cliente, lifestyle corporativo (carpeta 08-personas).
  El cliente pidió que el sitio sea "más soft" y proyecte profesionalismo humano,
  no solo software/fichas técnicas. Usar estas fotos en hero, banners separadores,
  membresías de soporte y sección Academia.

ENTREGABLE ESPERADO:
Sitio navegable con efectos REALES y hover funcional en URL temporal.
El cliente debe poder navegar como si fuera la versión final.
Responsive desktop + tablet + mobile (mobile-first 360px).

EMPEZAR POR:
Hero + Stats Strip. Generar 3 VARIANTES OPUESTAS para que elija dirección
antes de seguir con el resto de secciones.

Variante A: Dark editorial tech (fondo #0A0A0B + serif display)
Variante B: Cream warm minimalism (fondo #F5F1EA + grotesque pesada)
Variante C: Brand vibrant chameleon (fondo neutro + las 5 marcas con sus paletas completas)
