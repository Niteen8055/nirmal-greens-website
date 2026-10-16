# Workflow

- Starts ambiguous or high-impact tasks in plan mode; no file modifications until the plan is approved. Confidence: 0.95
- Repository audits are strictly read-only: no installs, migrations, commits, pushes, `.env` access, or external API calls unless explicitly permitted. Confidence: 0.9
- Verifies ground truth in the repo; never assumes planned functionality already exists. Confidence: 0.9
- Checks whether user-provided paths actually exist and clearly reports corrections (e.g. real repo located via package.json name). Confidence: 0.8
- Before authoring a new file (e.g. a migration), inspects an existing equivalent in the repo to follow the project's conventions (anonymous class, Schema::create, id(), timestamps()) rather than inventing a new style. Confidence: 0.75
- After implementation, runs a full verification suite (composer validate, route:list, tests, live endpoint + CORS checks, php -l lint of all project files, git diff --check, frontend npm run build regression) and reports results before stopping. Confidence: 0.85
- Scaffolds new files via Artisan generators in non-interactive mode (e.g. `make:migration --quiet`) rather than hand-writing boilerplate, then edits the generated stub to add project-specific columns/methods. Confidence: 0.82
- Runs Laravel Pint on newly created/modified files and confirms it passes (0 issues) as part of post-implementation verification; reports the result distinctly. Confidence: 0.85
- Stops background dev servers and confirms ports are released when verification ends. Confidence: 0.7
y fields that should be overwritten so approved values (e.g. prices) survive re-runs; DatabaseSeeder only registers project seeders (skeleton Test User removed as non-idempotent). Confidence: 0.9
- Test conventions: RefreshDatabase + factories with named states (e.g. `inactive()`); tests assert exact JSON paths/counts and the full response key set to catch unintended field exposure; unit tests assert container bindings resolve to the expected implementations. Confidence: 0.85
- Application layer handler unit tests use test doubles (mocks/stubs) for repository dependencies to isolate handler logic, testing the handler's orchestration independently of persistence. Confidence: 0.8
- When pdo_sqlite is unavailable and there is no sudo: initialize a throwaway mysqld in /tmp on an isolated port/socket, temporarily point phpunit.xml at it for the test run, restore phpunit.xml, then shut down and delete the temp data. Confidence: 0.8
- In review/verification checkpoints on completed work, wants `git status --short` and `git diff` to surface EVERY change including `.commandcode/taste/` system bookkeeping, for full transparency about what was modified. Confidence: 0.8
- Post-implementation review checkpoints are strictly read-only: verify each explicit criterion, report actual findings, and STOP — do not self-apply fixes; let the user review findings, approve, and direct any changes. Confidence: 0.7
- Never runs migrations or tests against the development database; before creating persistence tests, confirms the available isolated test database configuration and stops to report a blocker if a safe isolated database is not available. Confidence: 0.9
- If a genuine defect is discovered while writing tests or inspecting code, reports it and stops for user review rather than fixing it autonomously. Confidence: 0.85
- Persistence/infrastructure layer tests are Feature tests using an isolated database (e.g., SQLite in-memory when available), while Application and Domain layers are Unit tests with mocked dependencies. Confidence: 0.8
- Mockery is the preferred mocking library; avoid PHPUnit mocks when Mockery can double a class. Confidence: 0.8
- Uses `assertSame()` over `assertEquals()` for strict type and value comparison in tests. Confidence: 0.8
- Unit tests are self-contained without shared setup state between test methods. Confidence: 0.75
- When `MockeryPHPUnitIntegration` is unavailable, calls `Mockery::close()` in `tearDown()` to verify expectations and prevent memory leaks. Confidence: 0.8
- Feature/integration test directory paths mirror the corresponding source directory structure (e.g., `tests/Feature/Catalog/Infrastructure/` for `src/Catalog/Infrastructure/`). Confidence: 0.75
- Repository feature tests verify the round-trip from database → model → domain entity by reading back through the repository after writes, not only asserting raw database columns. Confidence: 0.7
