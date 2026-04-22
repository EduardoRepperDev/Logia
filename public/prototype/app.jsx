// Main app: hash router + state (brand, variant, cardVariant, megaOpen).
// Las rutas son:
//   /                            -> Home Logia
//   /aspel | /soft-restaurant | /zoho | /microsoft-365  -> Partner landing
//   /aspel/contabilidad/aspel-coi -> PDP
// El toolbar cambia data-brand en vivo para que puedas ver el chameleon
// sin necesidad de navegar.

const BRAND_BY_ROUTE = {
  "/":                  "logia",
  "/aspel":             "aspel",
  "/soft-restaurant":   "softrestaurant",
  "/zoho":              "zoho",
  "/microsoft-365":     "microsoft",
};

const useHashRoute = () => {
  const [route, setRoute] = React.useState(() => window.location.hash.replace(/^#/, "") || "/");
  React.useEffect(() => {
    const h = () => setRoute(window.location.hash.replace(/^#/, "") || "/");
    window.addEventListener("hashchange", h);
    return () => window.removeEventListener("hashchange", h);
  }, []);
  const navigate = (r) => { window.location.hash = r; window.scrollTo({top: 0, behavior: "instant"}); };
  return [route, navigate];
};

const LS = {
  get: (k, d) => { try { const v = localStorage.getItem(k); return v ?? d; } catch { return d; } },
  set: (k, v) => { try { localStorage.setItem(k, v); } catch {} },
};

const App = () => {
  const [route, navigate] = useHashRoute();
  const [brand, setBrand] = React.useState(() => LS.get("logia.brand", "logia"));
  const [variant, setVariant] = React.useState(() => LS.get("logia.mega", "hybrid"));
  const [cardVariant, setCardVariant] = React.useState(() => LS.get("logia.card", "parallax"));
  const [megaOpen, setMegaOpen] = React.useState(false);

  // Auto-brand por ruta: si el usuario navega a /aspel, el body toma data-brand=aspel.
  // Pero el toolbar permite override manual — así el prototype sirve para ver el
  // chameleon aplicado a la misma home.
  const [manualBrand, setManualBrand] = React.useState(false);

  React.useEffect(() => {
    if (manualBrand) return;
    if (route.startsWith("/aspel")) setBrand("aspel");
    else if (route.startsWith("/soft-restaurant")) setBrand("softrestaurant");
    else if (route.startsWith("/zoho")) setBrand("zoho");
    else if (route.startsWith("/microsoft-365")) setBrand("microsoft");
    else setBrand("logia");
  }, [route, manualBrand]);

  React.useEffect(() => {
    document.documentElement.setAttribute("data-brand", brand);
    LS.set("logia.brand", brand);
  }, [brand]);
  React.useEffect(() => LS.set("logia.mega", variant), [variant]);
  React.useEffect(() => LS.set("logia.card", cardVariant), [cardVariant]);

  const setBrandManual = (b) => { setManualBrand(true); setBrand(b); };

  const renderPage = () => {
    if (route.startsWith("/aspel/contabilidad/")) {
      const slug = route.split("/").pop();
      return <PDP slug={slug} onNavigate={navigate}/>;
    }
    if (route === "/aspel")           return <PartnerLanding brand="aspel"          onNavigate={navigate} cardVariant={cardVariant}/>;
    if (route === "/soft-restaurant") return <PartnerLanding brand="softrestaurant" onNavigate={navigate} cardVariant={cardVariant}/>;
    if (route === "/zoho")            return <PartnerLanding brand="zoho"           onNavigate={navigate} cardVariant={cardVariant}/>;
    if (route === "/microsoft-365")   return <PartnerLanding brand="microsoft"      onNavigate={navigate} cardVariant={cardVariant}/>;
    return <HomeLogia onNavigate={navigate} cardVariant={cardVariant}/>;
  };

  return (
    <div data-screen-label={route === "/" ? "01 Home Logia" : route.startsWith("/aspel/contabilidad") ? "03 PDP Aspel COI" : `02 Landing ${brand}`}>
      <ProtoToolbar brand={brand} setBrand={setBrandManual} route={route} variant={variant} setVariant={setVariant} cardVariant={cardVariant} setCardVariant={setCardVariant}/>
      <Navbar onNavigate={navigate} megaOpen={megaOpen} setMegaOpen={setMegaOpen} currentRoute={route}/>
      {megaOpen && <MegaMenu variant={variant} onClose={() => setMegaOpen(false)} onNavigate={navigate}/>}
      {renderPage()}
      <Footer onNavigate={navigate}/>
    </div>
  );
};

ReactDOM.createRoot(document.getElementById("root")).render(<App/>);
