# JER General Contractor — PHP Website

This is the framework-free version of the premium JER roofing website.

## Files

- `index.php` — premium roofing homepage, SEO structured data, FAQ content, and PHP contact-form handling.
- `roof-replacement/index.php` — focused roof replacement service page with its own metadata, canonical URL, structured data, educational content, FAQs, and qualified consultation form.
- `roof-repair/index.php` — El Paso roof repair service page with repair-intent content, structured data, FAQs, and a concern-specific assessment form.
- `styles.css` — the approved navy/granite visual baseline plus responsive legibility overrides.
- `assets/` — optimized JER logo files.
- `assets/projects/` — optimized WebP copies of the supplied El Paso roofing photographs used throughout all three pages.
- `robots.txt` and `sitemap.xml` — search-engine discovery files.

## Install

1. Upload the contents of this folder to any web host that supports PHP 8.0 or newer.
2. Point the domain document root at this folder.
3. Confirm that PHP `mail()` is enabled by the host, or replace the mail block near the top of `index.php` with the host's SMTP/form service.

No Node.js, npm, Composer, database, JavaScript, or build step is required.

## Before launch

- Confirm the recipient email near the top of `index.php`.
- Confirm the canonical domain in `index.php`, `robots.txt`, and `sitemap.xml`.
- Add the verified phone number, address, service areas, licensing details, and real customer reviews.
The current build no longer uses stock roofing photographs. The supplied project images are optimized for web delivery and are referenced with descriptive filenames and accessible image descriptions.

## Roof replacement page URL

Keep the replacement page in its current folder so normal PHP hosting serves it at:

`https://jer-elite.com/roof-replacement/`

The homepage, replacement page, and repair page now target El Paso, Texas. Keep that location only if JER serves customers there. Do not add unverified addresses, licenses, warranties, manufacturer credentials, project results, or review ratings for SEO.
