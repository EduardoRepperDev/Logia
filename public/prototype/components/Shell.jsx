// Shell: toolbar (proto controls), navbar Logia, footer Logia.
// Navbar y footer son SIEMPRE data-brand="logia" (principio P3).

const LOGO_SRC = "/images/Original_Logo_Logia_Consulting.png";

const BRANDS = [
  { id: "logia",          label: "Logia",           hex: "#FF6B00", tag: "LC" },
  { id: "aspel",          label: "Siigo Aspel",     hex: "#009DFF", tag: "SA" },
  { id: "softrestaurant", label: "Soft Restaurant", hex: "#E25724", tag: "SR" },
  { id: "zoho",           label: "Zoho One",        hex: "#E42527", tag: "Z1" },
  { id: "microsoft",      label: "Microsoft 365",   hex: "#05A6F0", tag: "M365" },
];

const ProtoToolbar = ({ brand, setBrand, route, variant, setVariant, cardVariant, setCardVariant }) => (
  <div className="proto-toolbar" role="toolbar" aria-label="Controles del prototipo">
    <span className="proto-toolbar__label">Logia · Prototype</span>
    <span className="proto-toolbar__sep"/>
    <span className="proto-toolbar__label" style={{color: "#6A6A6A"}}>data-brand</span>
    <div className="proto-brand-switch">
      {BRANDS.map(b => (
        <button key={b.id} aria-pressed={brand === b.id} onClick={() => setBrand(b.id)}>{b.label}</button>
      ))}
    </div>
    <span className="proto-toolbar__sep"/>
    <span className="proto-toolbar__label" style={{color: "#6A6A6A"}}>mega</span>
    <div className="proto-brand-switch">
      {["hybrid","columns","cards"].map(v => (
        <button key={v} aria-pressed={variant === v} onClick={() => setVariant(v)}>{v}</button>
      ))}
    </div>
    <span className="proto-toolbar__sep"/>
    <span className="proto-toolbar__label" style={{color: "#6A6A6A"}}>3D-card</span>
    <div className="proto-brand-switch">
      {["tilt","parallax","specular"].map(v => (
        <button key={v} aria-pressed={cardVariant === v} onClick={() => setCardVariant(v)}>{v}</button>
      ))}
    </div>
    <span className="proto-toolbar__spacer"/>
    <span className="proto-toolbar__route">route <b>{route}</b></span>
  </div>
);

const Navbar = ({ onNavigate, megaOpen, setMegaOpen, currentRoute }) => {
  return (
    <header data-brand="logia" className="c-navbar">
      <div className="c-navbar__inner">
        <button className="c-navbar__brand" onClick={() => { setMegaOpen(false); onNavigate("/"); }} aria-label="Ir al inicio de Logia Consulting">
          <img src={LOGO_SRC} alt="Logia Consulting"/>
        </button>
        <nav className="c-navbar__menu" aria-label="Principal">
          <button
            className="c-navbar__menu-item"
            aria-expanded={megaOpen}
            onClick={() => setMegaOpen(!megaOpen)}
          >
            Productos
            <svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2 4 L6 8 L10 4" fill="none" stroke="currentColor" strokeWidth="1.8" strokeLinecap="round" strokeLinejoin="round"/></svg>
          </button>
          <button className="c-navbar__menu-item" onClick={() => setMegaOpen(false)}>Servicios</button>
          <button className="c-navbar__menu-item" onClick={() => setMegaOpen(false)}>Campus</button>
          <button className="c-navbar__menu-item" onClick={() => setMegaOpen(false)}>Soporte</button>
          <button className="c-navbar__menu-item" onClick={() => setMegaOpen(false)}>Blog</button>
          <button className="c-navbar__menu-item" onClick={() => setMegaOpen(false)}>Nosotros</button>
        </nav>
        <div className="c-navbar__actions">
          <button className="c-navbar__search" aria-label="Buscar en el sitio">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="11" cy="11" r="7" stroke="currentColor" strokeWidth="2"/><path d="m21 21-4.3-4.3" stroke="currentColor" strokeWidth="2" strokeLinecap="round"/></svg>
            Buscar cursos, productos…
            <kbd>⌘K</kbd>
          </button>
          <button className="c-btn c-btn--ghost c-btn--sm">Ingresar</button>
          <button className="c-btn c-btn--sm" style={{minWidth: 0}}>Mi cuenta</button>
        </div>
      </div>
    </header>
  );
};

const Footer = ({ onNavigate }) => (
  <footer data-brand="logia" className="c-footer">
    <div className="container">
      <div className="c-footer__grid">
        <div className="c-footer__brand">
          <img src={LOGO_SRC} alt="Logia Consulting"/>
          <p>Integrando tecnología y crecimiento empresarial. Partner oficial de Siigo Aspel, Soft Restaurant, Zoho One y Microsoft 365 en México.</p>
          <div className="c-footer__offices" style={{marginTop: 18}}>
            <span><b>WTC CDMX</b> · Piso 14</span>
            <span><b>Coapa</b> · Av. Canal 1402</span>
            <span><b>Polanco</b> · Masaryk 214</span>
          </div>
        </div>
        <div>
          <h5>Productos</h5>
          <ul>
            <li><a href="#/aspel" onClick={e => { e.preventDefault(); onNavigate("/aspel"); }}>Siigo Aspel</a></li>
            <li><a href="#/soft-restaurant" onClick={e => { e.preventDefault(); onNavigate("/soft-restaurant"); }}>Soft Restaurant</a></li>
            <li><a href="#/zoho" onClick={e => { e.preventDefault(); onNavigate("/zoho"); }}>Zoho One</a></li>
            <li><a href="#/microsoft-365" onClick={e => { e.preventDefault(); onNavigate("/microsoft-365"); }}>Microsoft 365</a></li>
          </ul>
        </div>
        <div>
          <h5>Campus</h5>
          <ul>
            <li><a href="#">Cursos certificados</a></li>
            <li><a href="#">Aula virtual</a></li>
            <li><a href="#">Certificados DC-3</a></li>
            <li><a href="#">Planes empresa</a></li>
          </ul>
        </div>
        <div>
          <h5>Soporte</h5>
          <ul>
            <li><a href="#">En sitio · CDMX</a></li>
            <li><a href="#">Remoto 24/7</a></li>
            <li><a href="#">Mesa de ayuda</a></li>
            <li><a href="#">SLA empresariales</a></li>
          </ul>
        </div>
        <div>
          <h5>Logia</h5>
          <ul>
            <li><a href="#">Nosotros</a></li>
            <li><a href="#">Casos de éxito</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Contacto</a></li>
          </ul>
        </div>
      </div>
      <div className="c-footer__bottom">
        <span>© 2026 Logia Consulting · RFC LOG920410XX1 · Todos los derechos reservados</span>
        <span>Lorem consulting · Aviso de privacidad · Términos</span>
      </div>
    </div>
  </footer>
);

Object.assign(window, { ProtoToolbar, Navbar, Footer, BRANDS, LOGO_SRC });
