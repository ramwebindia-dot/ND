# Movora website

Packers & movers and logistics website. Plain PHP (8.0+), no database, no build step.

## Before it goes live

Open `config.php` and replace the placeholders:

- `phone`, `email`, `address`, `hours`, `whatsapp`
- `url` (your domain) and `mail_to` / `mail_from`
- `cities`, `commitments`, `services`, `faq`: these are sensible defaults, so edit them to match what Movora actually offers
- `established` and `gst` are hidden until you fill them in

Everything on the site reads from this file, so there is nothing else to search and replace.

## Photos

Drop real photos into `assets/img/` and they appear automatically; nothing needs editing:

| File | Where it shows |
| --- | --- |
| `hero.jpg` | Home page hero, behind a flat navy layer |
| `packing.jpg` | Home page, packing section |
| `team.jpg` | About page |

`.jpg`, `.jpeg`, `.webp` and `.png` all work. Without a file, that block simply collapses. Use free-licence photos (Pexels, Unsplash) or your own, around 1600px wide, with no watermark and no other company's logo visible.

## Logo

`assets/img/logo.png` is the header logo, cropped from the full logo. `favicon.png`, `apple-touch-icon.png` and `og-image.png` (the link preview image) are made from the same artwork. To use a different logo, replace those files or change `logo` in `config.php`.

## Fonts and privacy

Fonts are self-hosted (`assets/fonts/`, SIL Open Font License), so no request goes to Google. The site sets no cookies and has no analytics. `privacy.php` says exactly that, so **update it if you add analytics, ads or a chat widget**. It is a plain-language draft; have it checked against how Movora really handles customer data.

## Hosting

Upload the contents of this folder to the web root of any Apache host with PHP. `.htaccess` provides the clean URLs (`/services`), blocks `includes/`, `storage/` and `config.php`, and sets caching and security headers. If the site lives in a subfolder, set `base_path` in `config.php`.

On Nginx, the same rules need to be added to the server config.

## Enquiries

The form emails `mail_to` and also writes every enquiry to `storage/enquiries.log`, so nothing is lost if the host's mail is misconfigured. That file contains customers' phone numbers; it is blocked from the web and is not committed to git.

Spam protection is a hidden field, a minimum fill time, a same-origin check and a limit of 5 enquiries per IP per hour. If spam gets through, add a CAPTCHA in `includes/enquiry-form.php`.

## Preview locally

```
cd website
php -S localhost:8000 dev-router.php
```
