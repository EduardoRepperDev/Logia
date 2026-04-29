/* marketing.js — Alpine.js components para el sitio corporativo */
import Alpine from 'alpinejs';
window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {

    /* ── Shell: brand switcher + dark mode + mega menu ── */
    Alpine.data('shell', () => ({
        brand: 'logia',
        dark: false,
        megaOpen: false,
        mobileOpen: false,
        reduced: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
        init() {
            this.$watch('brand', val => document.documentElement.setAttribute('data-brand', val));
            this.$watch('dark', val => document.documentElement.setAttribute('data-theme', val ? 'dark' : 'light'));
        },
        setBrand(b) { this.brand = b; this.megaOpen = false; this.mobileOpen = false; },
    }));

    /* ── HeroVisual: tilt 3D + parallax por tarjeta ── */
    Alpine.data('heroVisual', () => ({
        reduced: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
        onMove(e) {
            if (this.reduced) return;
            const r = this.$el.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width;
            const y = (e.clientY - r.top) / r.height;
            const rx = (0.5 - y) * 10;
            const ry = (x - 0.5) * 12;
            if (this.$refs.stage) {
                this.$refs.stage.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg)`;
            }
            this.$el.querySelectorAll('[data-depth]').forEach(card => {
                const depth = parseInt(card.dataset.depth);
                const px = (x - 0.5) * (depth / 4);
                const py = (y - 0.5) * (depth / 5);
                card.style.transform = `translateZ(${depth}px) translate(${px}px, ${py}px)`;
            });
        },
        onLeave() {
            if (this.$refs.stage) this.$refs.stage.style.transform = '';
            this.$el.querySelectorAll('[data-depth]').forEach(card => {
                const depth = parseInt(card.dataset.depth);
                card.style.transform = `translateZ(${depth}px)`;
            });
        },
    }));

    /* ── TestimonialCarousel: auto-advance pages of testimonials ── */
    Alpine.data('testimonialCarousel', (count) => ({
        page: 0,
        count,
        next() { this.page = (this.page + 1) % this.count; },
        prev() { this.page = (this.page - 1 + this.count) % this.count; },
        init() { setInterval(() => this.next(), 5500); },
    }));

    /* ── HeroCarousel: auto-advance + brand theming + orbit tilt ── */
    Alpine.data('heroCarousel', (count, slides) => ({
        slide: 0,
        count,
        slides,
        reduced: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
        _timer: null,
        next() { this.slide = (this.slide + 1) % this.count; },
        goTo(n) {
            this.slide = n;
            clearInterval(this._timer);
            this._timer = setInterval(() => this.next(), 6000);
        },
        init() {
            this._timer = setInterval(() => this.next(), 6000);
            this.$watch('slide', () => {
                const img = this.$refs.centerLogo;
                if (!img) return;
                img.style.opacity = '0';
                setTimeout(() => { img.style.opacity = '1'; }, 220);
            });
        },
        onMove(e) {
            if (this.reduced) return;
            const wrap = this.$refs.visualWrap;
            if (!wrap) return;
            const r = wrap.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width;
            const y = (e.clientY - r.top) / r.height;
            if (this.$refs.stage) {
                this.$refs.stage.style.transform =
                    `rotateX(${(0.5 - y) * 10}deg) rotateY(${(x - 0.5) * 12}deg)`;
            }
            wrap.querySelectorAll('[data-depth]').forEach(card => {
                const d = parseInt(card.dataset.depth);
                card.style.transform = `translateZ(${d}px) translate(${(x - 0.5) * (d / 4)}px,${(y - 0.5) * (d / 5)}px)`;
            });
        },
        onLeave() {
            if (this.$refs.stage) this.$refs.stage.style.transform = '';
            const wrap = this.$refs.visualWrap;
            if (wrap) {
                wrap.querySelectorAll('[data-depth]').forEach(card => {
                    card.style.transform = `translateZ(${parseInt(card.dataset.depth)}px)`;
                });
            }
        },
    }));

    /* ── CartPage: reactive cart with period/users/complements ── */
    Alpine.data('cartPage', (product, partner, complements, logiaSrv, listPrice, discountPct) => ({
        period: 'anual',
        users: 1,
        poliza: '',
        code: '',
        codeApplied: false,
        addedSrv: [],
        addedSrvData: [],
        addedProd: [],
        addedProdData: [],
        product,
        partner,
        complements,
        logiaSrv,
        listPrice,
        discountPct,

        periods: [
            { id: 'mensual', label: 'Mensual',  discount: 0,    mult: 'monthly' },
            { id: 'anual',   label: 'Anual',    discount: discountPct / 100, mult: 'annual' },
            { id: 'tres',    label: '3 años',   discount: 0.08, mult: 'three'  },
        ],

        get periodObj() { return this.periods.find(p => p.id === this.period); },

        get periodLabel() {
            if (this.period === 'mensual') return 'mensual';
            if (this.period === 'anual')   return 'anual';
            return '3 años';
        },

        get periodSuffix() {
            if (this.period === 'mensual') return '/mes';
            if (this.period === 'anual')   return '/año';
            return '/3 años';
        },

        get baseMonthly() {
            if (!this.product) return 0;
            const annual = this._parsePrice(this.product.price);
            const monthly = this._parsePrice(this.product.precio_mensual);
            if (this.period === 'mensual') {
                return this.listPrice ? this.listPrice : (monthly > 0 ? monthly / (1 - this.discountPct / 100) : annual / 12);
            }
            return monthly > 0 ? monthly : annual / 12;
        },

        get mainTotal() {
            if (!this.product) return 0;
            const m = this.baseMonthly * this.users;
            if (this.period === 'mensual') return m;
            if (this.period === 'anual')   return m * 12;
            return m * 12 * 2.7;
        },

        get displayTotal() {
            if (this.period === 'mensual') return this.mainTotal;
            if (this.period === 'anual')   return this.mainTotal / 12;
            return this.mainTotal / 36;
        },

        get srvTotal()  { return this.addedSrvData.reduce((a, s) => a + s.price, 0); },
        get prodTotal() { return this.addedProdData.reduce((a, p) => a + p.price, 0); },
        get subtotal()  { return this.mainTotal + this.srvTotal + this.prodTotal; },
        get codeDiscount() { return this.codeApplied ? this.subtotal * 0.05 : 0; },
        get tax()       { return (this.subtotal - this.codeDiscount) * 0.16; },
        get total()     { return this.subtotal - this.codeDiscount + this.tax; },

        toggleSrv(slug, price) {
            if (this.addedSrv.includes(slug)) {
                this.addedSrv     = this.addedSrv.filter(s => s !== slug);
                this.addedSrvData = this.addedSrvData.filter(s => s.slug !== slug);
            } else {
                this.addedSrv.push(slug);
                const srv = this.logiaSrv.find(s => s.slug === slug);
                if (srv) this.addedSrvData.push({ slug, name: srv.name, price });
            }
        },

        toggleProd(slug, price) {
            if (this.addedProd.includes(slug)) {
                this.addedProd     = this.addedProd.filter(s => s !== slug);
                this.addedProdData = this.addedProdData.filter(p => p.slug !== slug);
            } else {
                this.addedProd.push(slug);
                const prod = this.complements.find(p => p.slug === slug);
                if (prod) this.addedProdData.push({ slug, name: prod.name, price });
            }
        },

        applyCode() { this.codeApplied = this.code.trim().length >= 4; },

        fmt(n) {
            return '$' + (n || 0).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },

        _parsePrice(str) {
            return parseFloat(String(str || '0').replace(/[$,\s]/g, '')) || 0;
        },
    }));

    /* ── CheckoutPage: billing + payment multi-step ── */
    Alpine.data('checkoutPage', () => ({
        step: 'billing',
        payMethod: 'card',
        processing: false,
        rfc: '',
        razonSocial: '',
        cp: '',
        regimen: '',
        cfdiUso: 'G03',
        email: '',
        telefono: '',
        cardNum: '',
        cardName: '',
        cardExp: '',
        cardCvv: '',

        formatCard() {
            this.cardNum = this.cardNum.replace(/\D/g, '').substring(0, 16)
                .replace(/(.{4})/g, '$1 ').trim();
        },
        formatExp() {
            const v = this.cardExp.replace(/\D/g, '').substring(0, 4);
            this.cardExp = v.length > 2 ? v.substring(0, 2) + ' / ' + v.substring(2) : v;
        },

        submitPayment() {
            this.processing = true;
            setTimeout(() => {
                window.location.href = '/checkout/confirmacion';
            }, 1800);
        },
    }));

    /* ── Product3DCard: tilt + parallax chip/badge ── */
    Alpine.data('product3dCard', () => ({
        reduced: window.matchMedia('(prefers-reduced-motion: reduce)').matches,
        onMove(e) {
            if (this.reduced) return;
            const r = this.$el.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width;
            const y = (e.clientY - r.top) / r.height;
            const rx = (0.5 - y) * 12;
            const ry = (x - 0.5) * 14;
            if (this.$refs.inner) this.$refs.inner.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg)`;
            if (this.$refs.icon)  this.$refs.icon.style.transform  = `translateZ(60px) translate(${(x-0.5)*20}px,${(y-0.5)*14}px)`;
            if (this.$refs.badge) this.$refs.badge.style.transform = `translateZ(80px) translate(${(x-0.5)*-18}px,${(y-0.5)*-10}px)`;
        },
        onLeave() {
            if (this.$refs.inner) this.$refs.inner.style.transform = '';
            if (this.$refs.icon)  this.$refs.icon.style.transform  = 'translateZ(60px)';
            if (this.$refs.badge) this.$refs.badge.style.transform = 'translateZ(80px)';
        },
    }));

});

Alpine.start();
