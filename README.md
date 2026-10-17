# NULL Pouches WooCommerce WordPress theme

## Version 0.2: Original homepage port

The homepage is now rendered from **the actual original HTML, CSS and JS** from [null-pouches](https://github.com/serneyy/null-pouches), rather than the first approximated layout. The source site repository remains unchanged.

- Source layouts: `landing/en.php`, `landing/sk.php`, `landing/cs.php`, `landing/de.php`, `landing/pl.php`, `landing/ro.php`.
- WordPress front page: `front-page.php` includes the selected original document.
- All original hero, styles, desktop/mobile animations, product lineup, ingredients, comparison, FAQ, modals, and privacy UI are preserved.
- The mobile and desktop landing styles depend on the **Tailwind CDN**, exactly as the source does.
- The mobile navigation now has a Shop link and the three figures (FOCUS, ENERGY, SLEEP) link to real WooCommerce product pages, resolving slugs `focus`, `energy`, `sleep`.
- The shop, product pages, cart and checkout use the **native WooCommerce plugin** and the matching dark `assets/store.css` theme.

### Installation

1. GitHub > Code > Download ZIP (the ZIP includes the repository folder with `style.css` at its root).
2. WordPress > Appearance > Themes > Add New > Upload Theme > select ZIP > Activate.
3. Plugins > Add New > install and activate **WooCommerce**.
4. Complete WooCommerce wizard and create shop/cart/checkout/account pages. Configure real payment and shipping methods.
5. Add and publish FOCUS, ENERGY and SLEEP products with matching slugs, descriptions, prices and images.
6. Settings > Permalinks > Save Changes to register `/sk/`, `/cs/`, `/de/`, `/pl/`, `/ro/`.
7. Test `/`, `/shop/`, product URLs, `/cart/`, `/checkout/`, and language homepages.

### Important staging limitations

- The original pre-launch **waitlist forms are preserved** for visual parity, but they POST to the existing Cloudflare Worker. It restricts CORS to `nullpouches.com` and therefore will **not function on WordPress Playground, localhost or other staging domains**. They must be configured or replaced before launch.
- The old landing SEO tags still point to `nullpouches.com`; do not publish the WordPress staging hostname publicly without checking canonical tags, robots, OG tags and SEO duplication.
- The landing preserves original consent, Meta/Clarity tracking, and Cloudflare Turnstile integration. Marketing scripts and consent integration should be reviewed and gated for staging to prevent accidental production analytics events.
- The original images still load from an external Shopify CDN and must remain available.
- The WooCommerce **storefront subpages** use a new dark template; full pixel-perfect parity on those pages cannot be compared with the static prelaunch site, because the source never had WooCommerce catalogue, product details or checkout.
- **Six landing translations are included**, but WooCommerce shop, checkout, product descriptions and transactional emails are not automatically localized. Use and configure a WooCommerce-compatible translation solution for a multilingual store.
- Production optimization: compile Tailwind utilities locally; do not rely on `cdn.tailwindcss.com` for a production store.
- PHP syntax, browser visual output, real payments, shipping, tax and checkout have **not yet been validated** on a WordPress staging instance. This is a testable development version, not a production-certified release.
