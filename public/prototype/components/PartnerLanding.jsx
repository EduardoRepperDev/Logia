// Partner landing: se renderiza bajo data-brand={partner}.
// Mismo skeleton, los tokens hacen todo el trabajo (chameleon).

const PARTNER_CONTENT = {
  aspel: {
    name: "Siigo Aspel",
    tagline: "La contabilidad de las PyMEs mexicanas — con el respaldo consultivo de Logia.",
    hero: "Implementamos, migramos y capacitamos en todo el ecosistema Siigo Aspel. Tu contabilidad, nómina, banca y facturación bajo un solo proveedor certificado.",
    tag: "SA",
    familia: ["Aspel COI","Aspel NOI","Aspel BANCO","Aspel FACTURE","Aspel ADM","Aspel PROD","Aspel CAJA","Aspel SAE"],
    productos: [
      { slug: "aspel-coi", name: "Aspel COI 10.0", desc: "Contabilidad integral, CFDI 4.0 y contabilidad electrónica SAT.", price: "$7,980", priceMeta: "anual · 1 usuario", badge: "Best-seller", decor: 0 },
      { slug: "aspel-noi", name: "Aspel NOI 11.0", desc: "Nómina con timbrado CFDI 4.0 y prestaciones de ley.",         price: "$9,450", priceMeta: "anual · 50 empleados", badge: "PyME", decor: 1 },
      { slug: "aspel-banco", name: "Aspel BANCO 5.0", desc: "Control bancario, conciliación y flujos multi-cuenta.",      price: "$6,500", priceMeta: "anual · 1 usuario", badge: "Nuevo", decor: 2 },
    ],
  },
  softrestaurant: {
    name: "Soft Restaurant",
    tagline: "El POS favorito de la gastronomía mexicana, configurado por expertos Logia.",
    hero: "Cajas, comandas, inventarios, recetas y delivery integrados. Lo parametrizamos a tu menú, capacitamos a tus meseros y damos soporte en sitio cuando abres.",
    tag: "SR",
    familia: ["POS Pro","POS Lite","Inventarios","Recetas","Delivery","Reservaciones"],
    productos: [
      { slug: "soft-pro", name: "Soft Restaurant Pro", desc: "3 cajas, inventario y recetas. El estándar de la industria.", price: "$18,500", priceMeta: "anual · 3 cajas", badge: "Flagship", decor: 0 },
      { slug: "soft-lite", name: "Soft Restaurant Lite", desc: "Para cafeterías y foodtrucks con 1 caja.", price: "$8,900", priceMeta: "anual · 1 caja", badge: "Starter", decor: 1 },
      { slug: "soft-delivery", name: "Soft Delivery", desc: "Integra Rappi, UberEats y DiDi Food a tu POS.", price: "$3,400", priceMeta: "anual", badge: "Add-on", decor: 2 },
    ],
  },
  zoho: {
    name: "Zoho One",
    tagline: "45+ apps de negocio, un solo login — configuradas por tu partner mexicano.",
    hero: "CRM, finanzas, RH, marketing y operaciones en una suite integrada. Logia te ayuda a elegir qué apps prender, en qué orden y cómo conectarlas a tu facturación CFDI.",
    tag: "Z1",
    familia: ["CRM","Books","Desk","People","Campaigns","Analytics","Creator","Projects"],
    productos: [
      { slug: "zoho-one", name: "Zoho One", desc: "La suite completa: 45+ apps integradas, un solo usuario.", price: "$1,299", priceMeta: "usuario/mes", badge: "Todo en 1", decor: 0 },
      { slug: "zoho-crm", name: "Zoho CRM Plus", desc: "CRM + marketing + soporte + analytics.", price: "$2,399", priceMeta: "usuario/mes", badge: "Más cotizado", decor: 1 },
      { slug: "zoho-books", name: "Zoho Books MX", desc: "Contabilidad en la nube con CFDI 4.0 y bancos MX.", price: "$399", priceMeta: "usuario/mes", badge: "CFDI", decor: 2 },
    ],
  },
  microsoft: {
    name: "Microsoft 365",
    tagline: "Productividad, colaboración y seguridad — configurada por Solutions Partner.",
    hero: "Correo corporativo, Teams, Office y seguridad Defender desplegados por un Solutions Partner autorizado. Migraciones sin downtime y soporte bilingüe.",
    tag: "M365",
    familia: ["Business Basic","Business Standard","Business Premium","Enterprise E3","Enterprise E5"],
    productos: [
      { slug: "m365-basic", name: "Business Basic", desc: "Correo, Teams, OneDrive 1TB. Sin apps de escritorio.", price: "$120", priceMeta: "usuario/mes", badge: "Inicio", decor: 0 },
      { slug: "m365-std", name: "Business Standard", desc: "Incluye Word, Excel, PowerPoint, Outlook de escritorio.", price: "$320", priceMeta: "usuario/mes", badge: "PyME", decor: 1 },
      { slug: "m365-prem", name: "Business Premium", desc: "Standard + Intune MDM + Defender for Business + Azure AD.", price: "$450", priceMeta: "usuario/mes", badge: "Seguridad", decor: 2 },
    ],
  },
};

const PartnerLanding = ({ brand, onNavigate, cardVariant }) => {
  const c = PARTNER_CONTENT[brand];
  if (!c) return null;
  const partnerColor = ({aspel: "#009DFF", softrestaurant: "#E25724", zoho: "#E42527", microsoft: "#05A6F0"})[brand];

  return (
    <main data-brand={brand}>
      <section className="breadcrumb">
        <div className="container">
          <ol>
            <li><a href="#" onClick={e => { e.preventDefault(); onNavigate("/"); }}>Inicio</a></li>
            <li><a href="#" onClick={e => { e.preventDefault(); onNavigate("/"); }}>Productos</a></li>
            <li>{c.name}</li>
          </ol>
        </div>
      </section>

      <section className="partner-hero">
        <div className="container">
          <div className="partner-hero__inner">
            <div className="partner-hero__copy">
              <span className="partner-hero__partner-badge">
                <span style={{width: 8, height: 8, borderRadius: "50%", background: "var(--primary)"}}/>
                Partner oficial Logia · {c.name}
              </span>
              <div className="partner-hero__logo">
                <span className="partner-hero__logo-mark">{c.tag}</span>
                {c.name}
              </div>
              <h1 style={{textWrap: "balance"}}>{c.tagline}</h1>
              <p className="lede">{c.hero}</p>
              <div className="hero__ctas" style={{marginTop: 12}}>
                <button className="c-btn c-btn--lg">Ver productos</button>
                <button className="c-btn c-btn--ghost c-btn--lg">Hablar con especialista</button>
              </div>
              <div style={{marginTop: 32, display: "flex", flexWrap: "wrap", gap: 8}}>
                {c.familia.map(f => (
                  <span key={f} style={{padding: "6px 12px", borderRadius: 9999, background: "rgba(255,255,255,0.55)", border: "1px solid var(--border)", fontSize: 12, fontWeight: 600, color: "var(--text)"}}>{f}</span>
                ))}
              </div>
            </div>
            <div aria-hidden="true">
              <DecorPartnerHero seed={brand.length}/>
            </div>
          </div>
        </div>
      </section>

      <section className="featured" style={{background: "var(--bg)"}}>
        <div className="container">
          <div className="featured__head">
            <div>
              <span className="eyebrow">Productos {c.name}</span>
              <h2 style={{marginTop: 16}}>Licenciamiento, implementación y soporte — todo por Logia.</h2>
            </div>
          </div>
          <div className="featured__grid">
            {c.productos.map(p => (
              <Product3DCard key={p.slug} brand={brand} variant={cardVariant}
                product={{ ...p, brandTag: c.tag, brandColor: partnerColor }}
                onOpen={() => brand === "aspel" ? onNavigate(`/aspel/contabilidad/${p.slug}`) : onNavigate(`/${brand}`)}/>
            ))}
          </div>
        </div>
      </section>

      <section className="support">
        <div className="container">
          <div className="support__grid">
            <div>
              <span className="eyebrow">Por qué con Logia</span>
              <h2 style={{marginTop: 16, marginBottom: 16}}>Tres razones para no comprar licencias sueltas.</h2>
              <div className="support__cards">
                <article className="support-card">
                  <span className="support-card__tag">1 · Certificados</span>
                  <h4>Partner oficial {c.name}</h4>
                  <p>Tu licencia pasa por un canal autorizado — factura CFDI inmediata y acceso a updates oficiales.</p>
                </article>
                <article className="support-card">
                  <span className="support-card__tag">2 · Soporte</span>
                  <h4>Mesa de ayuda en México</h4>
                  <p>Consultores Logia que conocen tu setup. Sin tickets que se pierden en soporte del fabricante.</p>
                </article>
                <article className="support-card">
                  <span className="support-card__tag">3 · Campus</span>
                  <h4>Capacitación para tu equipo</h4>
                  <p>Cursos certificados DC-3 para que tus colaboradores dominen la herramienta desde el día uno.</p>
                </article>
                <article className="support-card">
                  <span className="support-card__tag">4 · Pagos</span>
                  <h4>Tarjeta, SPEI u OXXO</h4>
                  <p>Factura a tu RFC al instante. También renovamos tus licencias antes de que venzan.</p>
                </article>
              </div>
            </div>
            <aside className="support__visual" style={{background: "var(--accent)"}}>
              <span className="eyebrow" style={{color: "#fff"}}>Caso de éxito</span>
              <h2 style={{marginTop: 16, color: "#fff"}}>"Logia implementó {c.name} en 21 días."</h2>
              <p style={{color: "rgba(255,255,255,0.85)"}}>Lorem consulting: migramos 120 usuarios desde la versión anterior sin interrumpir operación. Capacitamos al equipo contable en dos sesiones.</p>
              <div className="support__visual-sla">
                <div><b style={{color: "#fff"}}>21</b><span>Días de implementación</span></div>
                <div><b style={{color: "#fff"}}>120</b><span>Usuarios migrados</span></div>
                <div><b style={{color: "#fff"}}>0</b><span>Horas de downtime</span></div>
              </div>
            </aside>
          </div>
        </div>
      </section>
    </main>
  );
};

Object.assign(window, { PartnerLanding, PARTNER_CONTENT });
