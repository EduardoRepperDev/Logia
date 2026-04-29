// Mega-menu con 3 variantes (hybrid, columns, cards).
// Brand info compartido para los 4 partners + productos destacados.

const PARTNERS = [
  { id: "aspel",          name: "Siigo Aspel",     desc: "Contabilidad, nómina, facturación PyME", hex: "#009DFF", tag: "SA", logo: "/images/brands/siigo.png",
    categories: ["Contabilidad (COI)","Nómina (NOI)","Banca (BANCO)","Facturación (FACTURE)"],
    products: [
      { slug: "aspel-coi",     name: "Aspel COI",     meta: "Contabilidad integral · Licencia anual" },
      { slug: "aspel-noi",     name: "Aspel NOI",     meta: "Nómina + CFDI 4.0" },
      { slug: "aspel-facture", name: "Aspel FACTURE", meta: "Facturación electrónica" },
    ]},
  { id: "softrestaurant", name: "Soft Restaurant", desc: "POS para restaurantes, bares y cafeterías", hex: "#E25724", tag: "SR", logo: "/images/brands/softrestauran.png",
    categories: ["Punto de venta","Inventarios","Delivery","Reservaciones"],
    products: [
      { slug: "soft-pro",      name: "Soft Restaurant Pro", meta: "POS completo · 3 cajas" },
      { slug: "soft-delivery", name: "Soft Delivery",        meta: "Integración Rappi / UberEats" },
      { slug: "soft-stock",    name: "Soft Inventarios",     meta: "Recetas y mermas" },
    ]},
  { id: "zoho",           name: "Zoho One",         desc: "Suite de 45+ apps de negocio",              hex: "#E42527", tag: "Z1", logo: "/images/brands/zoho-logo-web.svg",
    categories: ["CRM","Finanzas","RH","Marketing"],
    products: [
      { slug: "zoho-crm",    name: "Zoho CRM Plus",    meta: "CRM + automatización" },
      { slug: "zoho-books",  name: "Zoho Books",       meta: "Contabilidad con CFDI" },
      { slug: "zoho-people", name: "Zoho People",      meta: "Recursos humanos" },
    ]},
  { id: "microsoft",      name: "Microsoft 365",    desc: "Productividad, Teams y seguridad",          hex: "#05A6F0", tag: "M365", logo: "/images/brands/microsoft%20365%20compact%20logo.png",
    categories: ["Business Basic","Business Standard","Business Premium","Enterprise E3"],
    products: [
      { slug: "m365-basic",   name: "M365 Business Basic",    meta: "Correo, Teams, OneDrive" },
      { slug: "m365-std",     name: "M365 Business Standard", meta: "+ Apps de escritorio" },
      { slug: "m365-premium", name: "M365 Business Premium",  meta: "+ Intune + Defender" },
    ]},
];

const MegaMenu = ({ variant, onClose, onNavigate }) => {
  const [active, setActive] = React.useState("aspel");
  const current = PARTNERS.find(p => p.id === active) || PARTNERS[0];

  if (variant === "columns") {
    return (
      <>
        <div className="mega-backdrop" onClick={onClose}/>
        <div className="mega mega--columns" role="menu" onMouseLeave={onClose}>
          {PARTNERS.map(p => (
            <div key={p.id} className="mega__col">
              <h5 style={{borderBottomColor: p.hex}}>
                <span className="mega__col-chip" style={{background: "#fff", border: "1px solid var(--border)"}}>
                  <img src={p.logo} alt={p.name}
                       style={{maxWidth: "80%", maxHeight: "80%", objectFit: "contain"}}
                       onError={e => { const s=e.target.parentElement; s.style.background=p.hex; s.textContent=p.tag; }}/>
                </span>
                {p.name}
              </h5>
              {p.categories.map(c => <a key={c} href="#" onClick={e => { e.preventDefault(); onNavigate(`/${p.id}`); onClose(); }}>{c}</a>)}
              <a href="#" style={{marginTop: 8, color: p.hex, fontWeight: 600}} onClick={e => { e.preventDefault(); onNavigate(`/${p.id}`); onClose(); }}>Ver landing →</a>
            </div>
          ))}
        </div>
      </>
    );
  }

  if (variant === "cards") {
    return (
      <>
        <div className="mega-backdrop" onClick={onClose}/>
        <div className="mega mega--cards" role="menu" onMouseLeave={onClose}>
          {PARTNERS.map(p => (
            <button key={p.id} className="mega__card" onClick={() => { onNavigate(`/${p.id}`); onClose(); }}
              style={{background: `linear-gradient(160deg, ${p.hex}10, transparent)`, borderColor: `${p.hex}40`}}>
              <span className="mega__brand-chip" style={{background: "#fff", border: "1px solid var(--border)", width: 44, height: 44}}>
                <img src={p.logo} alt={p.name}
                     style={{maxWidth: "75%", maxHeight: "75%", objectFit: "contain"}}
                     onError={e => { const s=e.target.parentElement; s.style.background=p.hex; s.textContent=p.tag; }}/>
              </span>
              <h5>{p.name}</h5>
              <p>{p.desc}</p>
              <ul>
                {p.categories.slice(0,3).map(c => <li key={c}>{c}</li>)}
              </ul>
            </button>
          ))}
        </div>
      </>
    );
  }

  // hybrid (default) — panel sobrio: marcas a la izquierda, productos listados a la derecha
  return (
    <>
      <div className="mega-backdrop" onClick={onClose}/>
      <div className="mega mega--hybrid mega--flat" role="menu" onMouseLeave={onClose}>
        <div className="mega__brands mega__brands--flat">
          <h5>Marcas</h5>
          {PARTNERS.map(p => (
            <button key={p.id} className="mega__brand-row" aria-current={active === p.id}
              onMouseEnter={() => setActive(p.id)}
              onFocus={() => setActive(p.id)}
              onClick={() => { onNavigate(`/${p.id}`); onClose(); }}>
              <span className="mega__brand-dot" style={{background: p.hex}} aria-hidden="true"/>
              <span className="mega__brand-row-name">{p.name}</span>
              <span className="mega__brand-row-arrow" aria-hidden="true">→</span>
            </button>
          ))}
        </div>
        <div className="mega__content mega__content--flat">
          <div className="mega__content-head mega__content-head--flat">
            <div>
              <div className="mega__content-eyebrow">Productos</div>
              <h4 className="mega__content-title">{current.name}</h4>
            </div>
            <a href="#" className="mega__content-link" onClick={e => { e.preventDefault(); onNavigate(`/${current.id}`); onClose(); }}>
              Ver landing completa →
            </a>
          </div>
          <ul className="mega__product-list">
            {current.products.map(pr => (
              <li key={pr.slug}>
                <button className="mega__product-row" onClick={() => {
                  const route = current.id === "aspel" ? `/aspel/contabilidad/${pr.slug}` : `/${current.id}`;
                  onNavigate(route); onClose();
                }}>
                  <span className="mega__product-row-name">{pr.name}</span>
                  <span className="mega__product-row-meta">{pr.meta}</span>
                </button>
              </li>
            ))}
            {current.categories.slice(0, 4).map(c => (
              <li key={c}>
                <button className="mega__product-row mega__product-row--cat" onClick={() => { onNavigate(`/${current.id}`); onClose(); }}>
                  <span className="mega__product-row-name">{c}</span>
                </button>
              </li>
            ))}
          </ul>
        </div>
      </div>
    </>
  );
};

Object.assign(window, { MegaMenu, PARTNERS });
