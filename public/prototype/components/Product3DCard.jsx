// Product3DCard con 3 variantes: tilt | parallax | specular.
// Usa pointermove sobre el container y lee CSS vars para colores de marca.

const Product3DCard = ({ brand = "aspel", variant = "parallax", product, onOpen }) => {
  const ref = React.useRef(null);
  const innerRef = React.useRef(null);
  const iconRef = React.useRef(null);
  const badgeRef = React.useRef(null);
  const specularRef = React.useRef(null);
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
    const x = (e.clientX - r.left) / r.width;  // 0..1
    const y = (e.clientY - r.top) / r.height;  // 0..1
    const rx = (0.5 - y) * 12; // tilt X
    const ry = (x - 0.5) * 14; // tilt Y
    if (innerRef.current) {
      innerRef.current.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg)`;
    }
    if (variant === "parallax") {
      if (iconRef.current)  iconRef.current.style.transform  = `translateZ(60px) translate(${(x-0.5)*20}px, ${(y-0.5)*14}px)`;
      if (badgeRef.current) badgeRef.current.style.transform = `translateZ(80px) translate(${(x-0.5)*-18}px, ${(y-0.5)*-10}px)`;
    }
    if (variant === "specular" && specularRef.current) {
      specularRef.current.style.background = `radial-gradient(circle at ${x*100}% ${y*100}%, rgba(255,255,255,0.45), transparent 45%)`;
      specularRef.current.style.opacity = "1";
    }
  };
  const onLeave = () => {
    if (innerRef.current)  innerRef.current.style.transform = "";
    if (iconRef.current)   iconRef.current.style.transform  = "translateZ(60px)";
    if (badgeRef.current)  badgeRef.current.style.transform = "translateZ(80px)";
    if (specularRef.current) specularRef.current.style.opacity = "0";
  };

  return (
    <article className="product3d" data-brand={brand} ref={ref} onPointerMove={onMove} onPointerLeave={onLeave}>
      <div className="product3d__inner" ref={innerRef}>
        <header className="product3d__header">
          <span className="product3d__brand-chip" style={{background: product.brandColor}}>{product.brandTag}</span>
          <div className="product3d__price">
            <div className="product3d__price-now">{product.price}</div>
            <div className="product3d__price-meta">{product.priceMeta}</div>
          </div>
        </header>
        <div className="product3d__visual">
          <DecorProduct variant={product.decor}/>
          {variant === "specular" && (
            <div ref={specularRef} style={{position: "absolute", inset: 0, opacity: 0, transition: "opacity 180ms ease", pointerEvents: "none", mixBlendMode: "screen"}}/>
          )}
          <div ref={badgeRef} className="product3d__badge">{product.badge}</div>
          <div ref={iconRef} className="product3d__icon" style={{position: "absolute", left: 18, bottom: 14}}>
            <div style={{width: 48, height: 48, borderRadius: 12, background: "#fff", boxShadow: "0 10px 24px rgba(15,23,42,0.18)", display: "grid", placeItems: "center", border: "1px solid var(--border)"}}>
              <span style={{fontFamily: "var(--font-display)", fontWeight: 700, color: product.brandColor, fontSize: 14, letterSpacing: "-0.02em"}}>{product.brandTag}</span>
            </div>
          </div>
        </div>
        <div>
          <div className="product3d__title">{product.name}</div>
          <div className="product3d__meta">{product.desc}</div>
        </div>
        <button className="product3d__cta" onClick={onOpen} style={{background: "none", border: "none", cursor: "pointer", padding: 0, fontFamily: "inherit"}}>
          Ver detalle
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
          </svg>
        </button>
      </div>
    </article>
  );
};

Object.assign(window, { Product3DCard });
