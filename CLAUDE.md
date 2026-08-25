# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Static portfolio website for Anoop Kumar Sharma — a Unity game developer specializing in 2D/3D, AR/VR, and AI/ML game experiences. No build toolchain; files are served directly as static HTML/CSS/JS.

## Pages

| File | Purpose |
|------|---------|
| `index.html` | Homepage — hero card, quick-links, featured games |
| `AboutFull.html` | Full about/credentials page (experience, education, skills) |
| `contact.html` | Contact form (Formspree) + social links |
| `showCase.html` | All projects gallery |
| `service.html` | Services offered |
| `skils.html` | Skills timeline with tabbed categories |
| `blog-ar-face-filter.html` | Blog post about AR face filter project |

Navigation is shared across all pages via identical header/footer HTML (not componentized).

## Key External Dependencies

- **Bootstrap 5** (local copy: `css/bootstrap.min.css`, `js/bootstrap.bundle.min.js`)
- **jQuery 3.6.4** (local: `js/jquery-3.6.4.js`)
- **AOS** — Animate On Scroll (`css/aos.css`, `js/aos.js`)
- **Iconoir** — icon font (`css/iconoir.css`)
- **Chatling AI** — external chatbot widget (loaded from `https://chatling.ai/js/embed.js`, ID `4322138461`)

## Architecture Notes

### Miko AI Chatbot (`index.html`, `js/main.js`, `css/miko.css`)
- Custom mascot "Miko" replaces Chatling's default floating button
- Three states: idle (animated float), hover (image swap), active (video + chat iframe)
- `main.js` lines 110–383: full IIFE managing iframe visibility, bounds enforcement, scroll-close, ESC-close
- `miko.css`: fixed-position wrapper + overlay bars (header, border frame, emoji mask, bottom bar)
- The Chatling iframe (`#chtl-chat-iframe`) is injected by the external script; JS forces its positioning with `!important` styles
- On mobile (≤768px), the chat opens as a full-width bottom sheet

### Contact Form (`contact.html`)
- Submits to `https://formspree.io/f/mqpzbvek` via jQuery AJAX
- Includes a honeypot field (`_gotcha`) for spam prevention
- Shows/hides `#wait`, `#success`, `#fail` alert elements

### Parallax & Animations
- `.bg-img` elements inside `.shadow-box` / `.featured-game-card` get scroll-driven `translateY` shifts in `main.js` (lines 32–56)
- AOS initialized with `once: false` so elements re-animate on scroll back up
- Preloader hides when `.about-me-box` enters viewport (IntersectionObserver) or on `window.load`

### Design System
- CSS variables in `:root`: `--primary_color: #5B78F6`, `--dark: #323232`
- `--bg: #0F0F0F` (body background)
- Glassmorphism cards use `backdrop-filter: blur() saturate()` with layered `shadow-box` classes
- Three glass tiers: hero card (16px blur), quick-cards (10px), featured games (8px)
- Accessibility: `prefers-reduced-motion`, `prefers-contrast: more`, `prefers-reduced-transparency` media queries all implemented

## Common Tasks

- **Add a new page**: Copy the header/footer block from `index.html`, add a `<section>` with the page's content, link from nav in all other pages
- **Update nav**: Edit the `<nav>` block in every HTML file (not centralized)
- **Change primary color**: Edit `--primary_color` in `css/style.css` `:root`
- **Update Miko chatbot ID**: Change `chatbotId` in `window.chtlConfig` in `index.html` and the `data-id` / `id` attributes on the script tag
- **Add featured game**: Copy a `.featured-game-card` block in `index.html` and adjust image/links
- **Deploy**: Push to the repo; the site appears to be hosted on Great Sites (external URL `https://anoopkrsh.great-site.net/` is linked but separate from this repo)

## Code Conventions

- All custom JS is wrapped in IIFEs to avoid global pollution
- jQuery is used for DOM queries and AJAX; vanilla JS for animations and event handling
- CSS follows BEM-ish naming: `.block-element--modifier` is not strictly used; class names describe component role (`.info-box`, `.shadow-box`, `.featured-game-card`)
- No CSS preprocessors; plain `.css` files
- Images are in `images/`; video assets in subfolders (`images/miko/`)
