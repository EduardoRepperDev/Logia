// Composiciones geométricas decorativas (SVG) para usar de hero visual,
// backgrounds de product cards, etc. Heredan colores de los tokens por
// currentColor o vars CSS, así el chameleon funciona gratis.

const DecorHeroOrbit = () => (
  <svg viewBox="0 0 560 500" className="deco-geom" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <defs>
      <linearGradient id="orb-primary" x1="0" y1="0" x2="1" y2="1">
        <stop offset="0" stopColor="var(--primary)" stopOpacity="0.9"/>
        <stop offset="1" stopColor="var(--primary)" stopOpacity="0.55"/>
      </linearGradient>
      <linearGradient id="orb-accent" x1="0" y1="0" x2="1" y2="1">
        <stop offset="0" stopColor="var(--accent)" stopOpacity="0.2"/>
        <stop offset="1" stopColor="var(--accent)" stopOpacity="0"/>
      </linearGradient>
    </defs>
    {/* orbitas */}
    <ellipse cx="280" cy="250" rx="240" ry="140" fill="none" stroke="var(--border)" strokeWidth="1" strokeDasharray="2 6"/>
    <ellipse cx="280" cy="250" rx="190" ry="110" fill="none" stroke="var(--border)" strokeWidth="1"/>
    {/* disco principal */}
    <circle cx="280" cy="250" r="140" fill="url(#orb-primary)" opacity="0.12"/>
    <circle cx="280" cy="250" r="98" fill="var(--surface)" stroke="var(--border)" strokeWidth="1"/>
    <circle cx="280" cy="250" r="98" fill="url(#orb-accent)"/>
    {/* bloques flotando alrededor */}
    <g>
      <rect x="70" y="140" width="84" height="84" rx="16" fill="var(--surface)" stroke="var(--border)"/>
      <rect x="84" y="156" width="56" height="8" rx="4" fill="var(--primary)"/>
      <rect x="84" y="172" width="40" height="6" rx="3" fill="var(--border-strong)"/>
      <rect x="84" y="184" width="48" height="6" rx="3" fill="var(--border)"/>
      <rect x="84" y="196" width="32" height="6" rx="3" fill="var(--border)"/>
    </g>
    <g>
      <rect x="400" y="90" width="110" height="64" rx="12" fill="var(--primary)" opacity="0.92"/>
      <rect x="414" y="106" width="30" height="4" rx="2" fill="#fff" opacity="0.9"/>
      <rect x="414" y="116" width="60" height="4" rx="2" fill="#fff" opacity="0.55"/>
      <rect x="414" y="126" width="45" height="4" rx="2" fill="#fff" opacity="0.35"/>
      <circle cx="494" cy="110" r="4" fill="#fff"/>
    </g>
    <g>
      <rect x="420" y="310" width="100" height="100" rx="14" fill="var(--accent)" opacity="0.95"/>
      <path d="M436 360 L456 340 L478 364 L502 334" fill="none" stroke="#fff" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round"/>
      <circle cx="436" cy="360" r="3" fill="#fff"/>
      <circle cx="456" cy="340" r="3" fill="#fff"/>
      <circle cx="478" cy="364" r="3" fill="#fff"/>
      <circle cx="502" cy="334" r="3" fill="#fff"/>
    </g>
    <g>
      <rect x="80" y="320" width="130" height="74" rx="12" fill="var(--surface)" stroke="var(--border)"/>
      <circle cx="104" cy="344" r="12" fill="var(--primary-soft)"/>
      <rect x="124" y="338" width="76" height="5" rx="2.5" fill="var(--border-strong)"/>
      <rect x="124" y="348" width="46" height="5" rx="2.5" fill="var(--border)"/>
      <rect x="92" y="368" width="102" height="6" rx="3" fill="var(--border)"/>
      <rect x="92" y="378" width="64" height="6" rx="3" fill="var(--border)"/>
    </g>
    {/* center badge */}
    <g transform="translate(280 250)">
      <circle r="56" fill="#fff" stroke="var(--primary)" strokeWidth="2"/>
      <text x="0" y="6" textAnchor="middle" fontFamily="var(--font-display)" fontSize="18" fontWeight="700" fill="var(--primary)">LC</text>
    </g>
    {/* pequeños puntos */}
    <circle cx="180" cy="90" r="4" fill="var(--primary)"/>
    <circle cx="520" cy="220" r="3" fill="var(--accent)"/>
    <circle cx="60" cy="280" r="3" fill="var(--primary)"/>
    <circle cx="520" cy="450" r="4" fill="var(--primary)" opacity="0.5"/>
  </svg>
);

const DecorProduct = ({ variant = 0 }) => {
  const variants = [
    // 0: grid + chart bar
    <svg key="0" viewBox="0 0 300 170" className="deco-geom" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <defs>
        <pattern id={`grid-${variant}`} width="20" height="20" patternUnits="userSpaceOnUse">
          <path d="M 20 0 L 0 0 0 20" fill="none" stroke="var(--border)" strokeWidth="0.5"/>
        </pattern>
      </defs>
      <rect width="300" height="170" fill="var(--primary-soft)"/>
      <rect width="300" height="170" fill={`url(#grid-${variant})`} opacity="0.5"/>
      <g transform="translate(30 30)">
        <rect x="0" y="80" width="20" height="30" rx="3" fill="var(--primary)" opacity="0.3"/>
        <rect x="28" y="60" width="20" height="50" rx="3" fill="var(--primary)" opacity="0.5"/>
        <rect x="56" y="30" width="20" height="80" rx="3" fill="var(--primary)" opacity="0.7"/>
        <rect x="84" y="50" width="20" height="60" rx="3" fill="var(--primary)" opacity="0.85"/>
        <rect x="112" y="15" width="20" height="95" rx="3" fill="var(--primary)"/>
        <rect x="140" y="40" width="20" height="70" rx="3" fill="var(--accent)" opacity="0.7"/>
        <path d="M 10 90 Q 50 50 100 60 T 180 20" fill="none" stroke="var(--accent)" strokeWidth="2.5" strokeLinecap="round"/>
      </g>
      <rect x="218" y="22" width="56" height="14" rx="7" fill="#fff" stroke="var(--border)"/>
      <circle cx="226" cy="29" r="3" fill="var(--primary)"/>
      <rect x="234" y="27" width="32" height="4" rx="2" fill="var(--border-strong)"/>
    </svg>,
    // 1: rings + sparks
    <svg key="1" viewBox="0 0 300 170" className="deco-geom" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <rect width="300" height="170" fill="var(--surface-2)"/>
      <circle cx="150" cy="85" r="60" fill="none" stroke="var(--primary)" strokeWidth="2" strokeDasharray="4 6"/>
      <circle cx="150" cy="85" r="40" fill="none" stroke="var(--accent)" strokeWidth="1.5"/>
      <circle cx="150" cy="85" r="22" fill="var(--primary)"/>
      <circle cx="150" cy="85" r="8" fill="#fff"/>
      <circle cx="90" cy="50" r="3" fill="var(--accent)"/>
      <circle cx="210" cy="50" r="4" fill="var(--primary)"/>
      <circle cx="220" cy="130" r="3" fill="var(--primary)"/>
      <circle cx="80" cy="130" r="4" fill="var(--accent)"/>
      <path d="M 40 140 L 60 140 M 50 130 L 50 150" stroke="var(--primary)" strokeWidth="2" strokeLinecap="round"/>
      <path d="M 260 30 L 278 30 M 269 21 L 269 39" stroke="var(--accent)" strokeWidth="2" strokeLinecap="round"/>
    </svg>,
    // 2: stacked sheets
    <svg key="2" viewBox="0 0 300 170" className="deco-geom" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <rect width="300" height="170" fill="var(--primary-soft)"/>
      <g transform="translate(70 36)">
        <rect x="6" y="6" width="160" height="100" rx="10" fill="var(--accent)" opacity="0.25" transform="rotate(-3 86 56)"/>
        <rect x="0" y="0" width="160" height="100" rx="10" fill="#fff" stroke="var(--border)"/>
        <rect x="14" y="14" width="80" height="7" rx="3" fill="var(--primary)"/>
        <rect x="14" y="26" width="130" height="5" rx="2.5" fill="var(--border-strong)"/>
        <rect x="14" y="36" width="100" height="5" rx="2.5" fill="var(--border-strong)" opacity="0.6"/>
        <rect x="14" y="54" width="50" height="30" rx="6" fill="var(--primary)" opacity="0.15"/>
        <rect x="72" y="54" width="50" height="30" rx="6" fill="var(--accent)" opacity="0.2"/>
        <circle cx="40" cy="68" r="8" fill="var(--primary)"/>
        <circle cx="100" cy="68" r="8" fill="var(--accent)"/>
      </g>
    </svg>
  ];
  return variants[variant % variants.length];
};

const DecorPartnerHero = ({ seed = 0 }) => (
  <svg viewBox="0 0 480 420" className="deco-geom" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <defs>
      <linearGradient id={`ph-${seed}`} x1="0" y1="0" x2="1" y2="1">
        <stop offset="0" stopColor="var(--primary)" stopOpacity="0.95"/>
        <stop offset="1" stopColor="var(--accent)" stopOpacity="0.65"/>
      </linearGradient>
    </defs>
    <rect x="40" y="40" width="400" height="320" rx="24" fill="#fff" stroke="var(--border)"/>
    <rect x="70" y="70" width="340" height="58" rx="12" fill={`url(#ph-${seed})`}/>
    <rect x="86" y="88" width="120" height="8" rx="4" fill="#fff"/>
    <rect x="86" y="104" width="200" height="6" rx="3" fill="#fff" opacity="0.7"/>
    <g transform="translate(70 148)">
      <rect width="156" height="80" rx="10" fill="var(--surface-2)"/>
      <rect x="16" y="16" width="50" height="5" rx="2.5" fill="var(--border-strong)"/>
      <rect x="16" y="28" width="80" height="4" rx="2" fill="var(--border-strong)" opacity="0.6"/>
      <rect x="16" y="48" width="30" height="18" rx="4" fill="var(--primary)"/>
      <rect x="52" y="48" width="50" height="18" rx="4" fill="var(--accent)" opacity="0.4"/>
    </g>
    <g transform="translate(238 148)">
      <rect width="172" height="80" rx="10" fill="var(--primary)" opacity="0.08"/>
      <circle cx="32" cy="40" r="18" fill="var(--primary)"/>
      <rect x="60" y="20" width="90" height="6" rx="3" fill="var(--border-strong)"/>
      <rect x="60" y="32" width="70" height="5" rx="2.5" fill="var(--border-strong)" opacity="0.6"/>
      <rect x="60" y="48" width="100" height="14" rx="7" fill="var(--accent)" opacity="0.9"/>
    </g>
    <g transform="translate(70 248)">
      <rect width="340" height="88" rx="10" fill="var(--surface-2)"/>
      <rect x="16" y="16" width="60" height="6" rx="3" fill="var(--border-strong)"/>
      <rect x="16" y="30" width="306" height="4" rx="2" fill="var(--border)"/>
      <rect x="16" y="42" width="240" height="4" rx="2" fill="var(--border)"/>
      <rect x="16" y="56" width="120" height="18" rx="9" fill="var(--primary)"/>
      <rect x="142" y="56" width="80" height="18" rx="9" fill="#fff" stroke="var(--border)"/>
    </g>
    <circle cx="440" cy="80" r="36" fill="var(--primary)" opacity="0.18"/>
    <circle cx="40" cy="340" r="28" fill="var(--accent)" opacity="0.18"/>
  </svg>
);

const DecorPDP = ({ variant = 0 }) => (
  <svg viewBox="0 0 600 440" className="deco-geom" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    {variant === 0 && (
      <>
        <rect width="600" height="440" fill="var(--surface)"/>
        <rect x="60" y="50" width="480" height="340" rx="14" fill="#fff" stroke="var(--border)"/>
        <rect x="60" y="50" width="480" height="36" rx="14" fill="var(--primary)"/>
        <circle cx="80" cy="68" r="5" fill="#fff"/>
        <circle cx="96" cy="68" r="5" fill="#fff" opacity="0.6"/>
        <circle cx="112" cy="68" r="5" fill="#fff" opacity="0.35"/>
        <rect x="80" y="108" width="160" height="10" rx="5" fill="var(--border-strong)"/>
        <rect x="80" y="126" width="220" height="6" rx="3" fill="var(--border)"/>
        <g transform="translate(80 160)">
          <rect width="440" height="180" rx="10" fill="var(--surface-2)"/>
          <rect x="16" y="16" width="200" height="24" rx="4" fill="var(--primary)"/>
          <rect x="16" y="52" width="408" height="6" rx="3" fill="var(--border-strong)" opacity="0.5"/>
          <rect x="16" y="64" width="360" height="6" rx="3" fill="var(--border-strong)" opacity="0.5"/>
          <rect x="16" y="76" width="300" height="6" rx="3" fill="var(--border-strong)" opacity="0.3"/>
          <g transform="translate(16 100)">
            <rect width="90" height="60" rx="8" fill="#fff" stroke="var(--border)"/>
            <rect x="8" y="10" width="40" height="5" rx="2" fill="var(--primary)"/>
            <rect x="8" y="22" width="64" height="8" rx="3" fill="var(--border-strong)"/>
            <rect x="8" y="40" width="50" height="5" rx="2" fill="var(--border)"/>
          </g>
          <g transform="translate(116 100)">
            <rect width="90" height="60" rx="8" fill="#fff" stroke="var(--border)"/>
            <rect x="8" y="10" width="40" height="5" rx="2" fill="var(--accent)"/>
            <rect x="8" y="22" width="64" height="8" rx="3" fill="var(--border-strong)"/>
            <rect x="8" y="40" width="50" height="5" rx="2" fill="var(--border)"/>
          </g>
          <g transform="translate(216 100)">
            <rect width="208" height="60" rx="8" fill="var(--primary)" opacity="0.1"/>
            <path d="M 8 40 L 40 28 L 72 34 L 104 16 L 136 22 L 168 10 L 200 18" fill="none" stroke="var(--primary)" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round"/>
          </g>
        </g>
      </>
    )}
    {variant === 1 && (
      <>
        <rect width="600" height="440" fill="var(--surface-2)"/>
        <g transform="translate(80 70)">
          <rect width="440" height="300" rx="14" fill="#fff" stroke="var(--border)"/>
          <rect x="0" y="0" width="140" height="300" rx="14" fill="var(--primary)" opacity="0.08"/>
          <circle cx="36" cy="40" r="14" fill="var(--primary)"/>
          <rect x="20" y="74" width="100" height="6" rx="3" fill="var(--border-strong)"/>
          <rect x="20" y="90" width="70" height="5" rx="2.5" fill="var(--border)"/>
          <rect x="20" y="120" width="100" height="20" rx="6" fill="var(--primary)" opacity="0.2"/>
          <rect x="20" y="148" width="100" height="20" rx="6" fill="var(--border)" opacity="0.7"/>
          <rect x="20" y="176" width="100" height="20" rx="6" fill="var(--border)" opacity="0.7"/>
          <rect x="160" y="30" width="140" height="8" rx="4" fill="var(--border-strong)"/>
          <rect x="160" y="48" width="80" height="5" rx="2.5" fill="var(--border)"/>
          <g transform="translate(160 74)">
            <rect width="260" height="60" rx="8" fill="var(--primary-soft)"/>
            <rect x="14" y="16" width="80" height="6" rx="3" fill="var(--primary)"/>
            <rect x="14" y="30" width="140" height="4" rx="2" fill="var(--primary)" opacity="0.5"/>
            <rect x="180" y="20" width="64" height="20" rx="10" fill="var(--primary)"/>
          </g>
          <g transform="translate(160 148)">
            <rect width="260" height="60" rx="8" fill="var(--surface-2)"/>
            <rect x="14" y="16" width="80" height="6" rx="3" fill="var(--accent)"/>
            <rect x="14" y="30" width="120" height="4" rx="2" fill="var(--border-strong)"/>
          </g>
          <g transform="translate(160 222)">
            <rect width="260" height="60" rx="8" fill="var(--surface-2)"/>
            <rect x="14" y="16" width="80" height="6" rx="3" fill="var(--accent)"/>
            <rect x="14" y="30" width="120" height="4" rx="2" fill="var(--border-strong)"/>
          </g>
        </g>
      </>
    )}
  </svg>
);

const DecorCampus = () => (
  <svg viewBox="0 0 600 380" className="deco-geom" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
    <defs>
      <linearGradient id="campus-bg" x1="0" y1="0" x2="1" y2="1">
        <stop offset="0" stopColor="#1E293B"/>
        <stop offset="1" stopColor="#0F172A"/>
      </linearGradient>
    </defs>
    <rect width="600" height="380" fill="url(#campus-bg)"/>
    {/* grid futurista */}
    <g opacity="0.15">
      {[...Array(12)].map((_, i) => (
        <line key={`v${i}`} x1={i*50} y1="0" x2={i*50} y2="380" stroke="#fff" strokeWidth="0.5"/>
      ))}
      {[...Array(8)].map((_, i) => (
        <line key={`h${i}`} x1="0" y1={i*50} x2="600" y2={i*50} stroke="#fff" strokeWidth="0.5"/>
      ))}
    </g>
    {/* play button */}
    <circle cx="300" cy="190" r="64" fill="rgba(255,255,255,0.10)" stroke="rgba(255,255,255,0.3)" strokeWidth="1"/>
    <circle cx="300" cy="190" r="48" fill="var(--primary)"/>
    <path d="M 288 170 L 288 210 L 320 190 Z" fill="#fff"/>
    {/* progress bar abajo */}
    <g transform="translate(60 320)">
      <rect width="480" height="4" rx="2" fill="rgba(255,255,255,0.15)"/>
      <rect width="140" height="4" rx="2" fill="var(--primary)"/>
      <circle cx="140" cy="2" r="6" fill="#fff"/>
    </g>
    {/* chip módulo */}
    <g transform="translate(40 40)">
      <rect width="180" height="36" rx="8" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.12)"/>
      <circle cx="18" cy="18" r="5" fill="var(--primary)"/>
      <text x="30" y="22" fontFamily="var(--font-display)" fontSize="11" fill="#fff" fontWeight="600">MÓDULO 3 · En curso</text>
    </g>
    {/* bottom right metadata */}
    <g transform="translate(440 40)">
      <rect width="120" height="36" rx="8" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.12)"/>
      <text x="14" y="22" fontFamily="var(--font-display)" fontSize="11" fill="#fff" fontWeight="600">12:34 / 28:00</text>
    </g>
  </svg>
);

Object.assign(window, { DecorHeroOrbit, DecorProduct, DecorPartnerHero, DecorPDP, DecorCampus });
