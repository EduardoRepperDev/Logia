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

    /* ── HeroCarousel: auto-advance + brand theming per slide ── */
    Alpine.data('heroCarousel', (count, meta) => ({
        slide: 0,
        count,
        meta,
        next() { this.slide = (this.slide + 1) % this.count; },
        init() { setInterval(() => this.next(), 7000); },
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
