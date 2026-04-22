// Testimonials — carrusel de 3 tarjetas con flechas prev/next
const TESTIMONIALS = [
  { name: "María Elena Rodríguez", role: "Contralora", company: "Grupo Textil Monarca",
    brand: "aspel", tag: "Aspel COI + NOI",
    quote: "Llevábamos Aspel desde hace 8 años pero sin soporte real. Con Logia migramos a la versión 9, capacitamos al equipo y el cierre mensual bajó de 6 a 2 días." },
  { name: "Carlos Mendoza", role: "Director General", company: "Mariscos La Chaparrita",
    brand: "softrestaurant", tag: "Soft Restaurant Pro",
    quote: "4 sucursales en GDL con el mismo POS, inventarios por receta y reportes consolidados. La implementación tomó 3 semanas, no 3 meses como nos habían dicho antes." },
  { name: "Ana Paula Villanueva", role: "COO", company: "Vertex Servicios Digitales",
    brand: "zoho", tag: "Zoho One",
    quote: "Pasamos de 7 SaaS distintos a Zoho One. Logia nos armó la automatización entre CRM, Books y Projects. Facturación: de 12 pasos manuales a 2." },
  { name: "Ricardo Hernández", role: "Gerente de IT", company: "Industrias Falcón",
    brand: "aspel", tag: "Aspel SAE + BANCO",
    quote: "El SLA Premium no es marketing. El servidor se cayó un viernes a las 7pm y a las 7:15 ya teníamos consultor resolviendo por AnyDesk." },
  { name: "Lucía Ordóñez", role: "Directora de RH", company: "Consultoría Itzae",
    brand: "campus", tag: "Campus Logia",
    quote: "Certificamos a 24 personas del área contable en 6 semanas con DC-3. El contenido está bien estructurado y el aula virtual funciona impecable." },
  { name: "Jorge Alemán", role: "Fundador", company: "Café Sibarita",
    brand: "softrestaurant", tag: "Soft Restaurant + Rappi",
    quote: "Integración con Rappi, UberEats y DiDi Food en un solo POS. Dejamos de perder comandas por captura duplicada. Se paga solo en 3 meses." },
];

const BRAND_ACCENTS = {
  logia: "var(--primary)",
  aspel: "#009DFF",
  softrestaurant: "#E25724",
  zoho: "#E42527",
  campus: "var(--accent)",
};

const Testimonials = () => {
  const [start, setStart] = React.useState(0);
  const [dir, setDir] = React.useState(1);
  const perPage = 3;
  const total = TESTIMONIALS.length;

  const visible = React.useMemo(() => {
    return [...Array(perPage)].map((_, i) => TESTIMONIALS[(start + i) % total]);
  }, [start, total]);

  const go = (d) => {
    setDir(d);
    setStart((s) => (s + d * perPage + total) % total);
  };

  return (
    <section className="testimonials">
      <div className="container">
        <div className="testimonials__head">
          <div>
            <span className="eyebrow">Testimonios de clientes</span>
            <h2 style={{ marginTop: 16 }}>Lo que dicen las <em>500+ empresas</em> que ya trabajan con Logia.</h2>
          </div>
          <div className="testimonials__nav" role="group" aria-label="Navegación de testimonios">
            <button className="testimonials__arrow" aria-label="Testimonios anteriores" onClick={() => go(-1)}>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M15 6 L9 12 L15 18" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/></svg>
            </button>
            <button className="testimonials__arrow" aria-label="Siguientes testimonios" onClick={() => go(1)}>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M9 6 L15 12 L9 18" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/></svg>
            </button>
          </div>
        </div>
        <div className="testimonials__grid" key={`${start}-${dir}`}>
          {visible.map((t, i) => (
            <article key={`${t.name}-${start}-${i}`} className="testimonial-card" style={{ animationDelay: `${i * 60}ms` }}>
              <div className="testimonial-card__head">
                <svg className="testimonial-card__quote" width="28" height="28" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                  <path d="M7 7 H11 V11 H9 C9 13 10 14 11 14.5 V16 C8 15.5 7 13.5 7 11 Z M14 7 H18 V11 H16 C16 13 17 14 18 14.5 V16 C15 15.5 14 13.5 14 11 Z" fill="currentColor"/>
                </svg>
                <span className="testimonial-card__tag" style={{ background: BRAND_ACCENTS[t.brand] }}>{t.tag}</span>
              </div>
              <p className="testimonial-card__quote-text">{t.quote}</p>
              <footer className="testimonial-card__foot">
                <div className="testimonial-card__avatar" style={{ background: BRAND_ACCENTS[t.brand] }}>
                  {t.name.split(" ").map(p => p[0]).slice(0, 2).join("")}
                </div>
                <div>
                  <div className="testimonial-card__name">{t.name}</div>
                  <div className="testimonial-card__role">{t.role} · {t.company}</div>
                </div>
              </footer>
            </article>
          ))}
        </div>
        <div className="testimonials__dots" aria-hidden="true">
          {[...Array(Math.ceil(total / perPage))].map((_, i) => {
            const active = Math.floor(start / perPage) === i;
            return <span key={i} className={`testimonials__dot ${active ? "is-active" : ""}`}/>;
          })}
        </div>
      </div>
    </section>
  );
};

Object.assign(window, { Testimonials, TESTIMONIALS });
