# Architecture

- Project stack: Laravel (PHP 8.3+) + MySQL 8 backend; existing frontend is PHP includes/sections, Bootstrap 5.3.8, SCSS/Dart Sass, Gulp 5, vanilla JS. Confidence: 0.9
- Repo lives at /var/www/html/nirma-green (frontend, package.json name "nirmal-greens-frontend"); Laravel app created in a `backend/` subdirectory of the same repo. Confidence: 0.9
- Prefers API-first architecture: separate Laravel JSON API, frontend untouched and served separately, `/api/v1` versioning. Confidence: 0.85
- Production topology: single VPS + Nginx proxying `/api/` to `backend/public` for same-origin; CORS only for local dev, driven by `CORS_ALLOWED_ORIGINS` (empty = same-origin only). Confidence: 0.8
- Phase-gated delivery with hard dependencies: scaffold → data foundation → auth → checkout → payments (Razorpay) → subscriptions → webhooks → frontend integration → hardening. Confidence: 0.8
- Authentication deferred to a dedicated accounts phase; early phases are public/stateless (SESSION_DRIVER=array, no Sanctum yet). Confidence: 0.75
- Money stored as integer paise (INR, Razorpay-native); never floats. Confidence: 0.7
- Idempotency by design: unique provider event IDs (webhook_events), Idempotency-Key header on checkout, unique order numbers. Confidence: 0.7
- Homepage content (3 plans ₹1,499/₹2,499/₹3,499, 6 microgreens, 5 recipes) is the approved source of truth and must be reproduced exactly in future seeders. Confidence: 0.85
- API-only backend: strips skeleton frontend cruft (vite config, package.json, welcome view, js/css assets) from the Laravel app. Confidence: 0.7
 Practical DDD layering with strict dependency direction: Domain (final readonly entities, repository contracts, shared enums — zero Laravel/HTTP/payment-SDK dependencies) ← Application (thin query classes) ← Infrastructure (Eloquent models + repository implementations; all DB queries live here) → Presentation (versioned controllers, API resources); migrations/factories/seeders form the database layer. Confidence: 0.9
- Explicitly anti-over-engineering: no microservices, no generic base repository, no repository for every model, no unnecessary packages; contexts share only genuine common functionality. Confidence: 0.9
- Repository contracts bound to Eloquent implementations in a dedicated DomainServiceProvider (registered in bootstrap/providers.php); controllers depend only on application query classes, never on Eloquent directly. Confidence: 0.9
- Consistent JSON API envelope: success `{status: "ok", data}`, errors `{status: "error", message}` with correct HTTP codes (404 for missing/inactive slugs); API resources explicitly whitelist mapped fields instead of exposing arbitrary columns; slug routes constrained `[a-z0-9-]+`; listings ordered by sort_order then a stable secondary field. Confidence: 0.9
- Laravel 13 conventions: `#[Fillable]` attribute + `casts()` method (no `$fillable` property); `#[UseFactory(Factory::class)]` required for models outside `App\Models` (default factory-name resolution maps the full model namespace into `Database\Factories\...`); JsonResource must explicitly map camelCase entity properties to snake_case JSON keys. Confidence: 0.85
- Uses `declare(strict_types=1)` in Domain and Application layer PHP classes; Infrastructure layers (Eloquent models, providers) do not use it, matching the existing `app/Models/User.php` convention. Confidence: 0.75
- Infrastructure implementations of Domain repository interfaces use the `Eloquent` prefix (e.g., `EloquentVarietyRepository` implements `VarietyRepository`); Domain interfaces drop the prefix to avoid coupling to the persistence mechanism. Confidence: 0.9
- Repository implementations centralize Eloquent-to-domain-entity mapping in a private `toDomain()` method with explicit field-by-field mapping (no mass assignment of model attributes into the domain entity constructor). Confidence: 0.9
- Nullable JSON/array columns are coalesced to `[]` when null (`$model->content ?? []`) so the domain entity receives an empty array rather than null, matching constructor defaults like `array $content = []`. Confidence: 0.75
- Application-layer handlers use `__invoke()` as the single entry point for a use case. Confidence: 0.8
