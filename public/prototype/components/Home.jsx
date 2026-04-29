// Home (data-brand=logia): hero corporativo sobrio, áreas servicio,
// campus e-learning, productos destacados, soporte, certificaciones.

const SERVICES = [
  { icon: "consulting", title: "Consultoría de negocio", body: "Diagnosticamos procesos y recomendamos la stack correcta — Aspel, Zoho o Microsoft — para tu etapa.", meta: "20+ años · 500+ empresas" },
  { icon: "impl",       title: "Implementación",        body: "Migraciones, parametrización y puesta en marcha con consultores certificados por cada fabricante.", meta: "Metodología Logia 6 fases" },
  { icon: "training",   title: "Capacitación DC-3",     body: "Cursos avalados con constancia STPS. Presencial en WTC, Coapa, Polanco o 100% remoto.", meta: "Campus Logia online" },
  { icon: "support",    title: "Soporte en sitio y remoto", body: "Mesa de ayuda, monitoreo y SLA empresarial. Respuesta en <15 min para clientes Premium.", meta: "CDMX + 24/7 remoto" },
];

const SERVICE_ICONS = {
  consulting: <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h10M4 17h16" stroke="currentColor" strokeWidth="2" strokeLinecap="round"/><circle cx="19" cy="12" r="2" fill="currentColor"/></svg>,
  impl:       <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><rect x="4" y="4" width="6" height="6" rx="1.5" stroke="currentColor" strokeWidth="2"/><rect x="14" y="14" width="6" height="6" rx="1.5" stroke="currentColor" strokeWidth="2"/><path d="M10 7h4v7" stroke="currentColor" strokeWidth="2" strokeLinecap="round"/></svg>,
  training:   <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M3 8l9-4 9 4-9 4-9-4z" stroke="currentColor" strokeWidth="2" strokeLinejoin="round"/><path d="M7 11v4c0 1 2 2 5 2s5-1 5-2v-4" stroke="currentColor" strokeWidth="2"/></svg>,
  support:    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M12 3a8 8 0 0 0-8 8v5a2 2 0 0 0 2 2h2v-7H5v-.001A7 7 0 0 1 19 11V11h-3v7h2a2 2 0 0 0 2-2v-5a8 8 0 0 0-8-8z" stroke="currentColor" strokeWidth="1.8"/></svg>,
};

const FEATURED_BY_TAB = {
  todos: [
    { slug: "aspel-coi",   brandTag: "SA",   brandColor: "#009DFF", name: "Aspel COI 10.0",         desc: "Contabilidad integral con CFDI 4.0 y complementos SAT.", price: "$7,980", priceMeta: "anual · 1 usuario", badge: "Best-seller", decor: 0, route: "/aspel/contabilidad/aspel-coi" },
    { slug: "soft-pro",    brandTag: "SR",   brandColor: "#E25724", name: "Soft Restaurant Pro",    desc: "POS para restaurante con 3 cajas, inventarios y recetas.", price: "$18,500", priceMeta: "anual · 3 cajas", badge: "Hospitality", decor: 1, route: "/soft-restaurant" },
    { slug: "zoho-crm",    brandTag: "Z1",   brandColor: "#E42527", name: "Zoho CRM Plus",          desc: "CRM + automatización + marketing + helpdesk en un solo plan.", price: "$2,399", priceMeta: "usuario/mes", badge: "Más cotizado", decor: 2, route: "/zoho" },
  ],
  pyme: [
    { slug: "m365-std",    brandTag: "M365", brandColor: "#05A6F0", name: "M365 Business Standard", desc: "Apps de escritorio, Teams, correo corporativo y OneDrive 1TB.", price: "$320", priceMeta: "usuario/mes", badge: "PyME", decor: 0, route: "/microsoft-365" },
    { slug: "aspel-noi",   brandTag: "SA",   brandColor: "#009DFF", name: "Aspel NOI 11.0",         desc: "Nómina con CFDI 4.0 y prestaciones de ley automatizadas.", price: "$9,450", priceMeta: "anual · 50 empleados", badge: "PyME", decor: 1, route: "/aspel" },
    { slug: "zoho-books",  brandTag: "Z1",   brandColor: "#E42527", name: "Zoho Books",             desc: "Contabilidad en la nube con facturación CFDI y bancos mexicanos.", price: "$399", priceMeta: "usuario/mes", badge: "Nube", decor: 2, route: "/zoho" },
  ],
  enterprise: [
    { slug: "m365-prem",   brandTag: "M365", brandColor: "#05A6F0", name: "M365 Business Premium", desc: "Intune MDM + Defender + Azure AD Premium para empresas grandes.", price: "$450", priceMeta: "usuario/mes", badge: "Seguridad", decor: 0, route: "/microsoft-365" },
    { slug: "aspel-suite", brandTag: "SA",   brandColor: "#009DFF", name: "Aspel Suite Empresa",    desc: "COI + NOI + BANCO + FACTURE con licencias multi-usuario.", price: "$48,900", priceMeta: "anual · 10 usuarios", badge: "Suite", decor: 1, route: "/aspel" },
    { slug: "zoho-one",    brandTag: "Z1",   brandColor: "#E42527", name: "Zoho One",               desc: "Suite completa de 45+ aplicaciones empresariales integradas.", price: "$1,299", priceMeta: "usuario/mes", badge: "Todo en 1", decor: 2, route: "/zoho" },
  ],
};

const HomeLogia = ({ onNavigate, cardVariant }) => {
  const [slide, setSlide] = React.useState(0);
  const [tab, setTab] = React.useState("todos");
  const slides = [
    { key: "logia",
      eyebrow: "Partner oficial · Siigo Aspel · Soft Restaurant · Zoho · Microsoft",
      titleA: "Integramos ", titleEm: "tecnología", titleB: " y crecimiento para tu negocio.",
      lede: "Somos consultores certificados en cuatro ecosistemas. Tú nos cuentas qué mueves; nosotros elegimos, implementamos y capacitamos a tu equipo.",
      ctaA: { label: "Ver productos", route: "/aspel" },
      ctaB: { label: "Agendar diagnóstico gratis" },
      dotLabel: "Logia Consulting" },
    { key: "aspel",
      eyebrow: "Partner Siigo Aspel · Gold desde 2012",
      titleA: "Siigo Aspel ", titleEm: "COI, NOI, BANCO", titleB: " — timbra y cierra tu mes.",
      lede: "Licencias originales, timbres SAT, implementación y soporte en español. La suite fiscal y administrativa líder en México.",
      ctaA: { label: "Ver productos Aspel", route: "/aspel" },
      ctaB: { label: "Comparar licencias" },
      dotLabel: "Siigo Aspel" },
    { key: "softrestaurant",
      eyebrow: "Distribuidor autorizado · Soft Restaurant",
      titleA: "POS para ", titleEm: "restaurantes", titleB: " que operan en serio.",
      lede: "Comandas, inventarios por receta, control de mesas y delivery Rappi/UberEats en un solo POS. De 1 a 200 sucursales.",
      ctaA: { label: "Conocer Soft Restaurant", route: "/soft-restaurant" },
      ctaB: { label: "Agendar demo" },
      dotLabel: "Soft Restaurant" },
    { key: "zoho",
      eyebrow: "Authorized Partner · Zoho One",
      titleA: "Zoho One: ", titleEm: "45+ apps", titleB: " trabajando como una sola.",
      lede: "CRM, Books, People, Projects, Desk — toda tu operación bajo un login, un dashboard y una factura.",
      ctaA: { label: "Explorar Zoho", route: "/zoho" },
      ctaB: { label: "Probar 30 días" },
      dotLabel: "Zoho One" },
    { key: "campus",
      eyebrow: "Campus Logia · Cursos certificados DC-3",
      titleA: "Tu equipo, ", titleEm: "certificado", titleB: "  sin salir de la oficina.",
      lede: "Aula virtual con DRM, constancia STPS DC-3 y rutas por rol: contador, administrador, gerente de restaurante o IT manager. Desde $990 por curso.",
      ctaA: { label: "Explorar Campus" },
      ctaB: { label: "Ver catálogo de cursos" },
      dotLabel: "Campus Logia" },
  ];
  const current = slides[slide];

  // Auto-advance cada 7s, pausa si hay reduced-motion
  React.useEffect(() => {
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
    const t = setInterval(() => setSlide(s => (s + 1) % slides.length), 7000);
    return () => clearInterval(t);
  }, [slides.length]);

  return (
    <main data-brand="logia">
      {/* HERO */}
      <section className="hero">
        <div className="container">
          <div className="hero__inner">
            <div className="hero__copy">
              <span className="eyebrow">{current.eyebrow}</span>
              <h1 className="hero__title">
                {current.titleA}<em>{current.titleEm}</em>{current.titleB}
              </h1>
              <p className="hero__lede">{current.lede}</p>
              <div className="hero__ctas">
                <button className="c-btn c-btn--lg" onClick={() => current.ctaA.route && onNavigate(current.ctaA.route)}>{current.ctaA.label}</button>
                <button className="c-btn c-btn--ghost c-btn--lg">{current.ctaB.label}</button>
              </div>
              <div className="hero__slide-nav" role="tablist" aria-label="Slides del hero">
                {slides.map((s, i) => (
                  <button key={s.key} className="hero__slide-dot" aria-current={slide === i} onClick={() => setSlide(i)} aria-label={s.dotLabel}>
                    <span className="hero__slide-dot__label">{s.dotLabel}</span>
                  </button>
                ))}
              </div>
              <div className="hero__stats">
                <div>
                  <div className="hero__stat-num">20<small>+</small></div>
                  <div className="hero__stat-label">Años acompañando PyMEs y corporativos</div>
                </div>
                <div>
                  <div className="hero__stat-num">500<small>+</small></div>
                  <div className="hero__stat-label">Clientes activos en México</div>
                </div>
                <div>
                  <div className="hero__stat-num">4</div>
                  <div className="hero__stat-label">Partnerships oficiales con fabricantes</div>
                </div>
              </div>
            </div>
            <div className="hero__visual" aria-hidden="true">
              <HeroVisual slideKey={current.key}/>
            </div>
          </div>
        </div>
      </section>

      {/* ÁREAS DE SERVICIO */}
      <section className="services">
        <div className="container">
          <div className="services__head">
            <div>
              <span className="eyebrow">Áreas de servicio</span>
              <h2 style={{marginTop: 16}}>Un solo equipo para toda tu operación digital.</h2>
            </div>
            <div>
              <p className="lede">Desde el primer diagnóstico hasta el soporte post-implementación, cubrimos las cuatro fases del ciclo de adopción tecnológica.</p>
              <div className="chips" aria-label="Etiquetas de servicio">
                <MagneticChip>Fiscal</MagneticChip>
                <MagneticChip>Nómina</MagneticChip>
                <MagneticChip>CRM</MagneticChip>
                <MagneticChip>Hospitality</MagneticChip>
                <MagneticChip>Productividad</MagneticChip>
                <MagneticChip>Ciberseguridad</MagneticChip>
              </div>
            </div>
          </div>
          <div className="services__grid">
            {SERVICES.map(s => (
              <article key={s.title} className="service-card">
                <div className="service-card__icon">{SERVICE_ICONS[s.icon]}</div>
                <h3 className="service-card__title">{s.title}</h3>
                <p className="service-card__body">{s.body}</p>
                <div className="service-card__meta">{s.meta} →</div>
              </article>
            ))}
          </div>
        </div>
      </section>

      {/* CAMPUS */}
      <section className="campus">
        <div className="container">
          <div className="campus__grid">
            <div>
              <span className="eyebrow" style={{color: "var(--accent)"}}>Campus Logia · E-learning</span>
              <h2 style={{marginTop: 16}} className="campus__title">
                Tu equipo, <em>certificado</em> en semanas — no en meses.
              </h2>
              <p className="lede" style={{marginTop: 16}}>
                Aula virtual con video protegido, PDFs con DRM y tres plantillas de certificado. Rutas de aprendizaje por rol: contador, administrador, gerente de restaurante o IT manager.
              </p>
              <ul className="campus__bullets">
                <li>
                  <span className="campus__bullet-num">1</span>
                  <div>
                    <strong>Contenido protegido</strong>
                    <p>Widevine + FairPlay en video; PDF.js cifrado en documentos. Nada se descarga.</p>
                  </div>
                </li>
                <li>
                  <span className="campus__bullet-num">2</span>
                  <div>
                    <strong>Constancia DC-3 STPS</strong>
                    <p>Cursos avalados con constancia oficial. Tres plantillas de certificado descargable.</p>
                  </div>
                </li>
                <li>
                  <span className="campus__bullet-num">3</span>
                  <div>
                    <strong>Rutas por rol</strong>
                    <p>Desde $990 por curso. Planes empresa con licencias para todo tu equipo.</p>
                  </div>
                </li>
              </ul>
              <div style={{marginTop: 28}}>
                <button className="c-btn c-btn--accent c-btn--lg">Explorar Campus</button>
              </div>
            </div>
            <div className="campus__player" aria-label="Vista previa del campus">
              <DecorCampus/>
              <div className="campus__player-cert">
                <div className="campus__player-cert__badge">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M12 2 L14 7 L19 7 L15 11 L17 17 L12 14 L7 17 L9 11 L5 7 L10 7 Z" fill="currentColor"/></svg>
                </div>
                <div>
                  <div className="campus__player-cert__label">Constancia</div>
                  <div className="campus__player-cert__value">DC-3 STPS incluida</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* PRODUCTOS DESTACADOS */}
      <section className="featured">
        <div className="container">
          <div className="featured__head">
            <div>
              <span className="eyebrow">Productos destacados</span>
              <h2 style={{marginTop: 16}}>Una licencia, una factura, un soporte.</h2>
            </div>
            <div className="featured__tabs" role="tablist" aria-label="Filtro por segmento">
              {[["todos","Todos"],["pyme","PyME"],["enterprise","Enterprise"]].map(([k,l]) => (
                <button key={k} aria-pressed={tab === k} onClick={() => setTab(k)}>{l}</button>
              ))}
            </div>
          </div>
          <div className="featured__grid">
            {FEATURED_BY_TAB[tab].map(p => (
              <Product3DCard key={p.slug} brand="logia" variant={cardVariant} product={p}
                onOpen={() => onNavigate(p.route)}/>
            ))}
          </div>
        </div>
      </section>

      {/* SOPORTE */}
      <section className="support">
        <div className="container">
          <div className="support__grid">
            <div>
              <span className="eyebrow">Soporte técnico</span>
              <h2 style={{marginTop: 16, marginBottom: 16}}>Cuando algo se cae, no queremos que esperes.</h2>
              <p className="lede" style={{marginBottom: 28}}>
                Equipo certificado en México, mesa de ayuda en español y SLA contractual. No tercerizamos soporte — todo lo resuelve un consultor Logia.
              </p>
              <div className="support__cards">
                <article className="support-card">
                  <span className="support-card__tag">En sitio</span>
                  <h4>Visita técnica CDMX</h4>
                  <p>Nuestro equipo se presenta en tu oficina. Cobertura en CDMX, GDL y MTY.</p>
                  <ul>
                    <li>Diagnóstico y refacción</li>
                    <li>Migraciones y updates</li>
                    <li>Capacitación 1 a 1</li>
                  </ul>
                </article>
                <article className="support-card">
                  <span className="support-card__tag">Remoto 24/7</span>
                  <h4>Mesa de ayuda 24/7</h4>
                  <p>Chat, teléfono y ticket. Acceso remoto seguro vía AnyDesk o TeamViewer con sesión auditada.</p>
                  <ul>
                    <li>&lt; 15 min de respuesta Premium</li>
                    <li>Historial por empresa</li>
                    <li>Reporte mensual SLA</li>
                  </ul>
                </article>
              </div>
            </div>
            <aside className="support__visual">
              <span className="eyebrow" style={{color: "var(--primary)"}}>Plan Enterprise</span>
              <h2 style={{marginTop: 16}}>Soporte dedicado con consultor asignado.</h2>
              <p>Un consultor Logia conoce tu setup, tus procesos y tu equipo. Lo reservas por mes y se vuelve tu extensión de IT.</p>
              <button className="c-btn c-btn--lg">Cotizar plan</button>
              <div className="support__visual-sla">
                <div><b>15m</b><span>Respuesta Premium</span></div>
                <div><b>99.5%</b><span>SLA mensual</span></div>
                <div><b>24/7</b><span>Mesa de ayuda</span></div>
              </div>
            </aside>
          </div>
        </div>
      </section>

      {/* TESTIMONIALES */}
      <Testimonials/>

      {/* CERTIFICACIONES */}
      <section className="certs">
        <div className="container">
          <div style={{textAlign: "center", marginBottom: 32}}>
            <span className="eyebrow">Partners oficiales autorizados</span>
            <h2 style={{marginTop: 16}}>4 marcas líderes bajo un solo proveedor certificado.</h2>
          </div>
          <div className="certs__row" style={{gridTemplateColumns: "repeat(4, 1fr)"}}>
            {[
              {name: "Siigo Aspel",     logo: "/images/brands/siigo.png",                              tag: "Partner autorizado"},
              {name: "Soft Restaurant", logo: "/images/brands/softrestauran.png",                      tag: "Partner autorizado"},
              {name: "Zoho",            logo: "/images/brands/zoho-logo-web.svg",                      tag: "Partner autorizado"},
              {name: "Microsoft 365",   logo: "/images/brands/microsoft%20365%20compact%20logo.png",   tag: "Solutions Partner"},
            ].map(b => (
              <div key={b.name} className="cert-badge" style={{padding: 24, background: "#fff", border: "1px solid var(--border)", alignItems: "center"}}>
                <img src={b.logo} alt={b.name}
                     style={{height: 48, width: "auto", maxWidth: "100%", objectFit: "contain", marginBottom: 12}}
                     onError={e => { e.target.style.display="none"; }}/>
                <strong>{b.name}</strong>
                <span>{b.tag}</span>
              </div>
            ))}
          </div>
        </div>
      </section>
    </main>
  );
};

// Chip magnético: sigue ligeramente al cursor si no hay reduced-motion
const MagneticChip = ({ children }) => {
  const ref = React.useRef(null);
  const [reduced, setReduced] = React.useState(false);
  React.useEffect(() => {
    const m = window.matchMedia("(prefers-reduced-motion: reduce)");
    setReduced(m.matches);
    const h = () => setReduced(m.matches);
    m.addEventListener("change", h);
    return () => m.removeEventListener("change", h);
  }, []);
  const onMove = (e) => {
    if (reduced || !ref.current) return;
    const r = ref.current.getBoundingClientRect();
    const x = (e.clientX - r.left - r.width / 2) * 0.18;
    const y = (e.clientY - r.top - r.height / 2) * 0.22;
    ref.current.style.transform = `translate(${x}px, ${y}px)`;
  };
  const onLeave = () => { if (ref.current) ref.current.style.transform = ""; };
  return (
    <button ref={ref} className="chip" onPointerMove={onMove} onPointerLeave={onLeave}>
      <span className="chip__dot"/>{children}
    </button>
  );
};

Object.assign(window, { HomeLogia, MagneticChip });
