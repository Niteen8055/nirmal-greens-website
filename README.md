# Nirmal Greens Website

A modern, responsive website for **Nirmal Greens**, a Bengaluru-based microgreens brand focused on fresh, responsibly grown microgreens, convenient delivery, subscriptions, and customer education.

## Project Overview

This project is a fresh frontend implementation built independently from the previous template-based website. The homepage follows the approved Nirmal Greens visual direction and is structured into reusable PHP sections with Bootstrap and SCSS.

### Current Homepage Sections

1. Header
2. Hero
3. Benefits
4. How It Works
5. Microgreens
6. Subscriptions
7. Recipes
8. Final CTA
9. Footer
10. Global preloader
11. Native browser scrollbar styling + floating scroll-progress control

## Technology Stack

- PHP
- HTML5
- Bootstrap 5.3.8
- SCSS / Dart Sass
- Gulp 5
- Vanilla JavaScript
- BrowserSync
- npm

## Project Structure

```text
nirmal-greens-frontend/
├── index.php
├── package.json
├── gulpfile.js
├── .gitignore
├── README.md
│
├── includes/
│   ├── head.php
│   ├── header.php
│   ├── footer.php
│   ├── preloader.php
│   └── scripts.php
│
├── sections/
│   ├── hero.php
│   ├── benefits.php
│   ├── how-it-works.php
│   ├── microgreens.php
│   ├── subscriptions.php
│   ├── recipes.php
│   ├── cta.php
│   └── footer.php
│
├── src/
│   ├── scss/
│   │   ├── abstracts/
│   │   ├── base/
│   │   ├── components/
│   │   ├── layout/
│   │   ├── components/homepage/
│   │   └── app.scss
│   │
│   └── js/
│       └── app.js
│
├── img/
│   ├── nirmal-greens-logo.png
│   └── home/
│       ├── hero/
│       ├── benefits/
│       ├── how-it-works/
│       ├── microgreens/
│       ├── subscriptions/
│       ├── recipes/
│       ├── cta/
│       └── footer/
│
└── dist/
    ├── css/
    ├── js/
    └── vendor/bootstrap/
```

## Brand Direction

### Primary Colors

```text
Primary Green:   #297536
Secondary Green: #253300
Cream:           #F5F4E8
White:           #FFFFFF
```

### Typography

The design uses a serif/display treatment for major headings and a clean sans-serif treatment for body copy and interface elements.

The homepage typography uses a responsive scale designed to remain readable across desktop, tablet, and mobile layouts.

## Development Setup

### Requirements

Install the following before working on the project:

- PHP 8.3+
- Node.js
- npm
- Git

### Install dependencies

```bash
npm install
```

### Build assets

```bash
npm run build
```

The Gulp build compiles SCSS, minifies JavaScript/CSS as configured, and prepares Bootstrap vendor assets.

### Development server

Use the development command configured in `package.json` / `gulpfile.js` for BrowserSync.

## Git Workflow

The repository uses the following branch strategy:

```text
main
  ↓
Production

 develop
  ↓
Development / Staging

feature/*
  ↓
Individual feature work
```

Recommended workflow:

```bash
git checkout develop
git pull origin develop
git checkout -b feature/feature-name
```

After completing the feature:

```bash
git add .
git commit -m "Add feature description"
git push -u origin feature/feature-name
```

Feature branches should be merged into `develop` first. Production changes should be promoted from `develop` into `main` through review.

## Important Git / Security Rules

Do not commit secrets or production credentials.

The following must remain outside Git where applicable:

```text
.env
production API keys
Razorpay secret keys
SMTP passwords
server credentials
other sensitive credentials
```

## Frontend Guidelines

- Use Bootstrap for structural layout and responsive grid behavior.
- Use component-level SCSS for brand styling and section-specific presentation.
- Keep each homepage section in its own PHP + SCSS files.
- Reuse the official Nirmal Greens logo and approved visual assets.
- Do not replace approved artwork with generated or stock imagery unless explicitly approved.
- Avoid unnecessary gradients, glassmorphism, excessive shadows, and decorative effects.
- Keep animations subtle and respect `prefers-reduced-motion`.
- Do not edit generated files in `dist/` manually.

## Current UX Enhancements

### Global Preloader

A lightweight page-level preloader uses the official logo, cream background, and a thin progress indicator. It follows the browser loading lifecycle and includes a fail-safe and reduced-motion support.

### Scroll Progress

The site keeps the real/native browser scrollbar and adds a small floating circular progress indicator showing scroll percentage. Clicking the indicator smoothly returns the page to the top.

## Homepage Asset Policy

Approved homepage artwork is stored under:

```text
img/home/
```

Do not rename, replace, or regenerate approved assets without approval.

## Future Roadmap

The homepage is the completed foundation. Planned future work includes:

1. Microgreens Shop / Products page
2. Product Detail page
3. Subscription domain and subscription UI
4. Cart
5. Checkout
6. Customer authentication and account area
7. Order and subscription management
8. Laravel/API integration
9. Razorpay payment integration and recurring billing
10. Webhook handling
11. Final end-to-end production QA

Future work should be implemented incrementally and should not destabilize the approved homepage.

## Payment Architecture Direction

The planned e-commerce flow is:

```text
Customer
   ↓
Product / Subscription
   ↓
Cart / Checkout
   ↓
Razorpay
   ↓
Payment / Recurring Mandate
   ↓
Webhook
   ↓
Laravel
   ↓
Order / Subscription Status
```

Payment processing fees are charged by the payment provider and are separate from website hosting costs.

## Hosting Direction

The initial production target is a single Linux VPS running the application stack, with HTTPS, DNS/CDN, backups, and monitoring.

A typical production setup will be:

```text
Domain
   ↓
Cloudflare
   ↓
Nginx
   ↓
PHP / Laravel
   ↓
MySQL
   ↓
Queue / Scheduler
```

The infrastructure should scale only when traffic and business requirements justify additional services.

## Production Checklist

Before production launch, verify:

- [ ] Domain DNS configured
- [ ] HTTPS enabled
- [ ] Production environment configured
- [ ] `APP_DEBUG=false` for Laravel production
- [ ] Database configured
- [ ] Queue worker configured
- [ ] Scheduler/cron configured
- [ ] Backups configured
- [ ] Payment gateway configured
- [ ] Webhooks verified
- [ ] Transactional email configured
- [ ] SEO metadata checked
- [ ] Responsive QA completed
- [ ] Accessibility QA completed
- [ ] No console errors
- [ ] No horizontal overflow
- [ ] No broken assets
- [ ] Production backup/restore tested

## Ownership / Repository

GitHub repository:

```text
git@github.com:Niteen8055/nirmal-greens-website.git
```

For local development, the repository is configured to use the personal GitHub SSH host when required.

## License

This project is proprietary client work for Nirmal Greens. Do not redistribute the source, brand assets, or client-provided artwork without authorization.
