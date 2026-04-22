// HeroVisual — visual decorativo del hero con tilt + parallax 3D
// Cambia de contenido por slide (logia, aspel, soft, zoho, campus).
// Las tarjetas flotantes reaccionan al pointermove del contenedor.

const HERO_SLIDES_VISUAL = {
  logia: {
    accent: "var(--primary)",
    accent2: "var(--accent)",
    center: { tag: "LC", label: "Logia" },
    cards: [
      { kind: "kpi",    x: 24,  y: 40,  depth: 70, w: 168, h: 96,  title: "500+", sub: "Clientes activos" },
      { kind: "chip",   x: 380, y: 20,  depth: 90, w: 150, h: 52,  title: "Partner oficial", sub: "4 ecosistemas" },
      { kind: "badge",  x: 400, y: 280, depth: 110, w: 130, h: 130, title: "20+", sub: "años" },
      { kind: "list",   x: 30,  y: 300, depth: 60, w: 188, h: 110, rows: ["Consultoría","Implementación","Capacitación"] },
    ],
  },
  aspel: {
    accent: "#009DFF",
    accent2: "#3B4758",
    center: { tag: "SA", label: "Aspel" },
    cards: [
      { kind: "invoice", x: 30,  y: 40,  depth: 85, w: 200, h: 130, title: "CFDI 4.0", sub: "Timbrado en línea" },
      { kind: "chip",    x: 390, y: 28,  depth: 100, w: 140, h: 48, title: "COI · NOI · BANCO" },
      { kind: "kpi",     x: 400, y: 280, depth: 70, w: 140, h: 110, title: "$7,980", sub: "anual · 1 usuario" },
      { kind: "list",    x: 40,  y: 290, depth: 55, w: 200, h: 120, rows: ["Aspel COI","Aspel NOI","Aspel FACTURE"] },
    ],
  },
  softrestaurant: {
    accent: "#E25724",
    accent2: "#584569",
    center: { tag: "SR", label: "Soft" },
    cards: [
      { kind: "kpi",    x: 30,  y: 50,  depth: 80, w: 170, h: 100, title: "3 cajas", sub: "Hospitality POS" },
      { kind: "chip",   x: 390, y: 30,  depth: 105, w: 140, h: 50, title: "Delivery · Rappi" },
      { kind: "badge",  x: 400, y: 270, depth: 95, w: 140, h: 140, title: "POS", sub: "Restaurante" },
      { kind: "list",   x: 40,  y: 290, depth: 60, w: 200, h: 120, rows: ["Mesas & comandas","Inventarios","Recetas"] },
    ],
  },
  zoho: {
    accent: "#E42527",
    accent2: "#226DB4",
    center: { tag: "Z1", label: "Zoho" },
    cards: [
      { kind: "grid",   x: 25,  y: 40,  depth: 75, w: 200, h: 110, title: "45+ apps", sub: "Zoho One suite" },
      { kind: "chip",   x: 390, y: 30,  depth: 100, w: 140, h: 50, title: "CRM · Books · HR" },
      { kind: "kpi",    x: 400, y: 280, depth: 85, w: 140, h: 110, title: "$1,299", sub: "usuario/mes" },
      { kind: "list",   x: 40,  y: 290, depth: 55, w: 200, h: 120, rows: ["Zoho CRM Plus","Zoho Books MX","Zoho People"] },
    ],
  },
  campus: {
    accent: "var(--primary)",
    accent2: "var(--accent)",
    center: { tag: "▶", label: "Campus" },
    cards: [
      { kind: "cert",   x: 25,  y: 40,  depth: 85, w: 200, h: 120, title: "DC-3 STPS", sub: "Constancia oficial" },
      { kind: "chip",   x: 380, y: 28,  depth: 100, w: 150, h: 50, title: "Widevine + FairPlay" },
      { kind: "kpi",    x: 400, y: 280, depth: 95, w: 140, h: 110, title: "$990", sub: "por curso" },
      { kind: "list",   x: 40,  y: 290, depth: 55, w: 200, h: 120, rows: ["Rutas por rol","Aula virtual","Video protegido"] },
    ],
  },
};

const HeroVisual = ({ slideKey = "logia" }) => {
  const data = HERO_SLIDES_VISUAL[slideKey] || HERO_SLIDES_VISUAL.logia;
  const ref = React.useRef(null);
  const stageRef = React.useRef(null);
  const cardsRef = React.useRef([]);
  const [reduced, setReduced] = React.useState(false);

  React.useEffect(() => {
    const m = window.matchMedia("(prefers-reduced-motion: reduce)");
    setReduced(m.matches);
    const h = () => setReduced(m.matches);
    m.addEventListener("change", h);
    return () => m.removeEventListener("change", h);
  }, []);

  const onMove = (e) => {
    if (reduced || !ref.current || !stageRef.current) return;
    const r = ref.current.getBoundingClientRect();
    const x = (e.clientX - r.left) / r.width;  // 0..1
    const y = (e.clientY - r.top) / r.height;  // 0..1
    const rx = (0.5 - y) * 10;
    const ry = (x - 0.5) * 12;
    stageRef.current.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg)`;
    // parallax por tarjeta según su depth
    cardsRef.current.forEach((el, i) => {
      if (!el) return;
      const depth = data.cards[i]?.depth || 40;
      const px = (x - 0.5) * (depth / 4);
      const py = (y - 0.5) * (depth / 5);
      el.style.transform = `translateZ(${depth}px) translate(${px}px, ${py}px)`;
    });
  };
  const onLeave = () => {
    if (stageRef.current) stageRef.current.style.transform = "";
    cardsRef.current.forEach((el, i) => {
      if (!el) return;
      const depth = data.cards[i]?.depth || 40;
      el.style.transform = `translateZ(${depth}px)`;
    });
  };

  return (
    <div ref={ref} onPointerMove={onMove} onPointerLeave={onLeave}
      style={{ perspective: "1400px", width: "100%", height: "100%", minHeight: 460, position: "relative" }}>
      <div ref={stageRef} style={{
        position: "relative", width: "100%", height: 460,
        transformStyle: "preserve-3d",
        transition: "transform 160ms cubic-bezier(0.2,0.8,0.2,1)",
      }}>
        {/* fondo con órbitas */}
        <svg viewBox="0 0 560 460" style={{ position: "absolute", inset: 0, width: "100%", height: "100%" }} aria-hidden="true">
          <ellipse cx="280" cy="230" rx="240" ry="140" fill="none" stroke="var(--border)" strokeWidth="1" strokeDasharray="2 6"/>
          <ellipse cx="280" cy="230" rx="190" ry="110" fill="none" stroke="var(--border)" strokeWidth="1"/>
          <circle cx="280" cy="230" r="140" fill={data.accent} opacity="0.08"/>
        </svg>

        {/* centro: disco/badge */}
        <div style={{
          position: "absolute", left: "50%", top: "50%",
          width: 150, height: 150, marginLeft: -75, marginTop: -75,
          borderRadius: "50%", background: "var(--surface)",
          border: `2px solid ${data.accent}`,
          display: "grid", placeItems: "center",
          boxShadow: "0 20px 50px rgba(15,23,42,0.12)",
          transform: "translateZ(40px)",
          transition: "transform 160ms cubic-bezier(0.2,0.8,0.2,1)",
          fontFamily: "var(--font-display)",
        }}>
          <div style={{textAlign: "center"}}>
            <div style={{ fontSize: 26, fontWeight: 700, color: data.accent, letterSpacing: "-0.02em" }}>{data.center.tag}</div>
            <div style={{ fontSize: 11, color: "var(--text-muted)", letterSpacing: "0.14em", textTransform: "uppercase", marginTop: 4, fontWeight: 600 }}>{data.center.label}</div>
          </div>
        </div>

        {/* Tarjetas flotantes */}
        {data.cards.map((c, i) => (
          <HeroFloatCard key={`${slideKey}-${i}`} card={c} accent={data.accent} accent2={data.accent2}
            ref={(el) => { cardsRef.current[i] = el; }}/>
        ))}
      </div>
    </div>
  );
};

const HeroFloatCard = React.forwardRef(({ card, accent, accent2 }, ref) => {
  const base = {
    position: "absolute",
    left: card.x, top: card.y, width: card.w, height: card.h,
    transform: `translateZ(${card.depth}px)`,
    transition: "transform 160ms cubic-bezier(0.2,0.8,0.2,1)",
    borderRadius: 14,
    background: "var(--surface)",
    border: "1px solid var(--border)",
    boxShadow: `0 ${10 + card.depth/4}px ${24 + card.depth/2}px rgba(15,23,42,${0.08 + card.depth/1200})`,
    padding: 14,
    fontFamily: "var(--font-body)",
  };

  if (card.kind === "kpi") {
    return (
      <div ref={ref} style={base}>
        <div style={{ fontFamily: "var(--font-display)", fontSize: 28, fontWeight: 700, color: "#2A2A2A", letterSpacing: "-0.02em" }}>{card.title}</div>
        <div style={{ fontSize: 12, color: "var(--text-muted)", marginTop: 4 }}>{card.sub}</div>
        <div style={{ marginTop: 12, height: 6, borderRadius: 4, background: "var(--surface-2)", overflow: "hidden" }}>
          <div style={{ width: "68%", height: "100%", background: accent }}/>
        </div>
      </div>
    );
  }
  if (card.kind === "chip") {
    return (
      <div ref={ref} style={{ ...base, display: "flex", alignItems: "center", gap: 10, padding: "0 16px", background: accent, color: "#fff", border: "none" }}>
        <span style={{ width: 8, height: 8, borderRadius: "50%", background: "#fff" }}/>
        <div>
          <div style={{ fontSize: 13, fontWeight: 700, lineHeight: 1.1 }}>{card.title}</div>
          {card.sub && <div style={{ fontSize: 11, opacity: 0.85, marginTop: 2 }}>{card.sub}</div>}
        </div>
      </div>
    );
  }
  if (card.kind === "badge") {
    return (
      <div ref={ref} style={{ ...base, display: "grid", placeItems: "center", borderRadius: "50%", background: accent, color: "#fff", border: "none" }}>
        <div style={{ textAlign: "center", fontFamily: "var(--font-display)" }}>
          <div style={{ fontSize: 32, fontWeight: 700, letterSpacing: "-0.02em" }}>{card.title}</div>
          <div style={{ fontSize: 11, opacity: 0.9, letterSpacing: "0.1em", textTransform: "uppercase", marginTop: 2 }}>{card.sub}</div>
        </div>
      </div>
    );
  }
  if (card.kind === "list") {
    return (
      <div ref={ref} style={base}>
        <div style={{ fontSize: 10, fontWeight: 700, color: "var(--text-muted)", letterSpacing: "0.12em", textTransform: "uppercase", marginBottom: 8 }}>Incluye</div>
        {card.rows.map((r, i) => (
          <div key={i} style={{ display: "flex", alignItems: "center", gap: 8, padding: "4px 0", fontSize: 12, color: "#2A2A2A" }}>
            <span style={{ width: 5, height: 5, borderRadius: "50%", background: accent }}/> {r}
          </div>
        ))}
      </div>
    );
  }
  if (card.kind === "invoice") {
    return (
      <div ref={ref} style={base}>
        <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", marginBottom: 10 }}>
          <div style={{ fontFamily: "var(--font-display)", fontWeight: 700, fontSize: 13, color: accent }}>{card.title}</div>
          <div style={{ fontFamily: "monospace", fontSize: 10, color: "var(--text-muted)" }}>A · 00423</div>
        </div>
        <div style={{ height: 5, background: "var(--surface-2)", borderRadius: 3, marginBottom: 6 }}/>
        <div style={{ height: 5, background: "var(--surface-2)", borderRadius: 3, marginBottom: 6, width: "70%" }}/>
        <div style={{ height: 5, background: "var(--surface-2)", borderRadius: 3, marginBottom: 12, width: "85%" }}/>
        <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", paddingTop: 8, borderTop: "1px dashed var(--border)" }}>
          <div style={{ fontSize: 10, color: "var(--text-muted)" }}>{card.sub}</div>
          <div style={{ fontFamily: "var(--font-display)", fontWeight: 700, color: "#2A2A2A" }}>$12,480</div>
        </div>
      </div>
    );
  }
  if (card.kind === "grid") {
    return (
      <div ref={ref} style={base}>
        <div style={{ fontFamily: "var(--font-display)", fontSize: 18, fontWeight: 700, color: "#2A2A2A" }}>{card.title}</div>
        <div style={{ fontSize: 11, color: "var(--text-muted)", marginBottom: 10 }}>{card.sub}</div>
        <div style={{ display: "grid", gridTemplateColumns: "repeat(5, 1fr)", gap: 5 }}>
          {[...Array(15)].map((_, i) => (
            <div key={i} style={{ aspectRatio: "1 / 1", borderRadius: 4, background: i%3===0 ? accent : i%3===1 ? accent2 : "var(--surface-2)", opacity: i%3===2 ? 1 : 0.85 }}/>
          ))}
        </div>
      </div>
    );
  }
  if (card.kind === "cert") {
    return (
      <div ref={ref} style={base}>
        <div style={{ display: "flex", alignItems: "center", gap: 10, marginBottom: 10 }}>
          <div style={{ width: 36, height: 36, borderRadius: 8, background: accent, display: "grid", placeItems: "center", color: "#fff" }}>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 2 L14 8 L20 8 L15 12 L17 19 L12 15 L7 19 L9 12 L4 8 L10 8 Z" fill="currentColor"/></svg>
          </div>
          <div>
            <div style={{ fontFamily: "var(--font-display)", fontWeight: 700, fontSize: 15, color: "#2A2A2A" }}>{card.title}</div>
            <div style={{ fontSize: 11, color: "var(--text-muted)" }}>{card.sub}</div>
          </div>
        </div>
        <div style={{ height: 5, background: "var(--surface-2)", borderRadius: 3, marginBottom: 6 }}/>
        <div style={{ height: 5, background: "var(--surface-2)", borderRadius: 3, marginBottom: 6, width: "80%" }}/>
        <div style={{ display: "inline-block", marginTop: 8, padding: "3px 8px", borderRadius: 9999, background: accent, color: "#fff", fontSize: 10, fontWeight: 700, letterSpacing: "0.08em" }}>CERTIFICADO</div>
      </div>
    );
  }
  return <div ref={ref} style={base}/>;
});

Object.assign(window, { HeroVisual, HERO_SLIDES_VISUAL });
