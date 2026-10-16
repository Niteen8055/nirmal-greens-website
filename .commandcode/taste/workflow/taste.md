# Workflow

- Starts ambiguous or high-impact tasks in plan mode; no file modifications until the plan is approved. Confidence: 0.95
- Repository audits are strictly read-only: no installs, migrations, commits, pushes, `.env` access, or external API calls unless explicitly permitted. Confidence: 0.9
- Verifies ground truth in the repo; never assumes planned functionality already exists. Confidence: 0.9
- Checks whether user-provided paths actually exist and clearly reports corrections (e.g. real repo located via package.json name). Confidence: 0.8
- After implementation, runs a full verification suite (composer validate, route:list, tests, live endpoint + CORS checks, php -l lint of all project files, git diff --check, frontend npm run build regression) and reports results before stopping. Confidence: 0.85
- Stops background dev servers and confirms ports are released when verification ends. Confidence: 0.7
y fields that should be overwritten so approved values (e.g. prices) survive re-runs; DatabaseSeeder only registers project seeders (skeleton Test User removed as non-idempotent). Confidence: 0.9
- Test conventions: RefreshDatabase + factories with named states (e.g. `inactive()`); tests assert exact JSON paths/counts and the full response key set to catch unintended field exposure; unit tests assert container bindings resolve to the expected implementations. Confidence: 0.85
- When pdo_sqlite is unavailable and there is no sudo: initialize a throwaway mysqld in /tmp on an isolated port/socket, temporarily point phpunit.xml at it for the test run, restore phpunit.xml, then shut down and delete the temp data. Confidence: 0.8
