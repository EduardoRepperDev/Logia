// PDP Aspel COI: breadcrumb, galería, 3D card, tabs, CTA.

const PDP_ASPEL_COI = {
  name: "Aspel COI 10.0",
  crumbs: [["Inicio","/"],["Siigo Aspel","/aspel"],["Contabilidad","/aspel"],["Aspel COI 10.0",null]],
  sku: "COI-10-1U-ANUAL",
  price: "$7,980",
  priceMeta: "MXN · anual · incluye IVA",
  summary: "Sistema de contabilidad integral para PyMEs mexicanas. Cumple con el SAT (CFDI 4.0, contabilidad electrónica, catálogos) y se actualiza automáticamente cada cambio fiscal.",
  badges: ["Partner oficial","CFDI 4.0","STPS DC-3"],
};

const PDP = ({ slug, onNavigate }) => {
  const p = PDP_ASPEL_COI;
  const [users, setUsers] = React.useState("1");
  const [period, setPeriod] = React.useState("anual");
  const [thumb, setThumb] = React.useState(0);
  const [tab, setTab] = React.useState("descripcion");

  return (
    <main data-brand="aspel">
      <section className="breadcrumb">
        <div className="container">
          <ol>
            {p.crumbs.map(([label, route], i) => (
              <li key={i}>{route ? <a href="#" onClick={e => { e.preventDefault(); onNavigate(route); }}>{label}</a> : label}</li>
            ))}
          </ol>
        </div>
      </section>

      <section className="pdp">
        <div className="container">
          <div className="pdp__top">
            <div className="pdp__gallery">
              <div className="pdp__gallery-main">
                <DecorPDP variant={thumb % 2}/>
              </div>
              <div className="pdp__gallery-thumbs">
                {[0,1,0,1].map((v, i) => (
                  <button key={i} className="pdp__gallery-thumb" aria-current={thumb === i} onClick={() => setThumb(i)} aria-label={`Vista ${i+1}`}>
                    <DecorPDP variant={v}/>
                  </button>
                ))}
              </div>
            </div>

            <div className="pdp__info">
              <div style={{display: "flex", gap: 8, flexWrap: "wrap", marginBottom: 16}}>
                {p.badges.map(b => (
                  <span key={b} style={{padding: "4px 10px", borderRadius: 9999, background: "var(--primary-soft)", color: "var(--primary)", fontSize: 11, fontWeight: 700, letterSpacing: "0.05em", textTransform: "uppercase"}}>{b}</span>
                ))}
              </div>
              <span className="eyebrow" style={{color: "var(--accent)"}}>Aspel Contabilidad · SKU {p.sku}</span>
              <h1 style={{marginTop: 12}}>{p.name}</h1>
              <div className="pdp__price">
                <span className="pdp__price-main">{p.price}</span>
                <span className="pdp__price-meta">{p.priceMeta}</span>
              </div>
              <p className="pdp__summary">{p.summary}</p>

              <div className="pdp__options">
                <h5>Usuarios concurrentes</h5>
                <div className="pdp__option-row">
                  {["1","3","5","10+"].map(u => (
                    <button key={u} aria-pressed={users === u} onClick={() => setUsers(u)}>{u === "10+" ? "10+ (cotizar)" : `${u} usuario${u === "1" ? "" : "s"}`}</button>
                  ))}
                </div>
                <h5 style={{marginTop: 16}}>Vigencia</h5>
                <div className="pdp__option-row">
                  {[["anual","Anual · $7,980"],["tres","3 años · $21,500"]].map(([k, l]) => (
                    <button key={k} aria-pressed={period === k} onClick={() => setPeriod(k)}>{l}</button>
                  ))}
                </div>
              </div>

              <div className="pdp__cta-row">
                <button className="c-btn c-btn--lg">Comprar licencia</button>
                <button className="c-btn c-btn--ghost c-btn--lg">+ Implementación Logia</button>
              </div>

              <ul className="pdp__trust" role="list">
                <li><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 12l2 2 4-4" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/><circle cx="12" cy="12" r="9" stroke="currentColor" strokeWidth="2"/></svg>Entrega de licencia inmediata por correo</li>
                <li><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><rect x="3" y="6" width="18" height="13" rx="2" stroke="currentColor" strokeWidth="2"/><path d="M3 10h18" stroke="currentColor" strokeWidth="2"/></svg>Tarjeta, SPEI u OXXO · Factura CFDI</li>
                <li><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 2l3 5 5 .7-3.6 3.6.9 5.2L12 14l-5.3 2.5.9-5.2L4 7.7 9 7z" stroke="currentColor" strokeWidth="2" strokeLinejoin="round"/></svg>Garantía 30 días</li>
                <li><svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 3a8 8 0 0 0-8 8v5a2 2 0 0 0 2 2h2v-7H5v-.001A7 7 0 0 1 19 11V11h-3v7h2a2 2 0 0 0 2-2v-5a8 8 0 0 0-8-8z" stroke="currentColor" strokeWidth="1.8"/></svg>Soporte Logia incluido 90 días</li>
              </ul>
            </div>
          </div>

          <div className="pdp__tabs" role="tablist">
            {[["descripcion","Descripción"],["caracteristicas","Características"],["requerimientos","Requerimientos"],["soporte","Soporte"]].map(([k, l]) => (
              <button key={k} aria-pressed={tab === k} onClick={() => setTab(k)}>{l}</button>
            ))}
          </div>

          <div className="pdp__tab-body">
            {tab === "descripcion" && (
              <>
                <div>
                  <h3>Qué resuelve Aspel COI</h3>
                  <p>Contabilidad integral para empresas mexicanas que necesitan timbrar CFDI 4.0, enviar contabilidad electrónica al SAT y generar estados financieros auditables.</p>
                  <p>Logia incluye dos sesiones de capacitación remota y la parametrización inicial de catálogo de cuentas, periodos y plantillas de póliza.</p>
                </div>
                <div>
                  <h3>Qué incluye tu licencia</h3>
                  <ul>
                    <li>Instalación asistida por consultor Logia</li>
                    <li>Migración de catálogo desde tu sistema anterior</li>
                    <li>Parametrización de pólizas modelo</li>
                    <li>2 sesiones de capacitación (4 h total)</li>
                    <li>Acceso a Campus Logia por 90 días</li>
                    <li>Soporte remoto los primeros 90 días</li>
                  </ul>
                </div>
              </>
            )}
            {tab === "caracteristicas" && (
              <>
                <div>
                  <h3>Fiscal</h3>
                  <ul>
                    <li>CFDI 4.0 emisión y recepción</li>
                    <li>Complemento de pagos 2.0</li>
                    <li>Contabilidad electrónica XML</li>
                    <li>DIOT con validación SAT</li>
                  </ul>
                </div>
                <div>
                  <h3>Operativo</h3>
                  <ul>
                    <li>Multi-empresa y multi-ejercicio</li>
                    <li>Pólizas modelo y recurrentes</li>
                    <li>Conciliación bancaria</li>
                    <li>Reportes XML y PDF a medida</li>
                  </ul>
                </div>
              </>
            )}
            {tab === "requerimientos" && (
              <>
                <div>
                  <h3>Mínimos</h3>
                  <ul>
                    <li>Windows 10 (22H2) o superior · 64-bit</li>
                    <li>Procesador i5 · 8 GB RAM · 4 GB libres en disco</li>
                    <li>Conexión a internet para timbrado CFDI</li>
                  </ul>
                </div>
                <div>
                  <h3>Recomendados</h3>
                  <ul>
                    <li>Windows 11 Pro · 16 GB RAM</li>
                    <li>SSD para base de datos</li>
                    <li>SQL Server Express (incluido) o Standard</li>
                  </ul>
                </div>
              </>
            )}
            {tab === "soporte" && (
              <>
                <div>
                  <h3>Soporte Logia</h3>
                  <p>Mesa de ayuda en español, por chat / teléfono / ticket. Acceso remoto seguro vía AnyDesk o TeamViewer con sesión auditada.</p>
                  <ul>
                    <li>Lun-Vie 9:00-19:00 (Premium 24/7)</li>
                    <li>Respuesta &lt;15 min plan Premium</li>
                    <li>Reporte mensual de SLA</li>
                  </ul>
                </div>
                <div>
                  <h3>Soporte Siigo Aspel</h3>
                  <p>Acceso al portal del fabricante y a las actualizaciones oficiales. Los tickets técnicos complejos los escalamos nosotros.</p>
                  <ul>
                    <li>Base de conocimiento Aspel</li>
                    <li>Updates y hotfixes incluidos</li>
                    <li>Comunidad oficial Siigo</li>
                  </ul>
                </div>
              </>
            )}
          </div>
        </div>
      </section>
    </main>
  );
};

Object.assign(window, { PDP });
