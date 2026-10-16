# Communication

- Architecture audits follow a fixed structure: what exists, DB/model layer, migration feasibility, architecture decision + rationale, folder structure, schema & relationships, API routes, security/idempotency, phases & dependencies, risks/assumptions. Confidence: 0.8
- Plans must end with a Phase 1 implementation plan listing the exact files that would change, then stop for approval. Confidence: 0.85
- Assumptions and open business questions (currency, GST, e-mandate compliance, serviceability, guest checkout) are surfaced explicitly rather than silently decided. Confidence: 0.75
- When reviewing an existing change, traces it against explicit project requirements (root/backend AGENTS.md, plan.md, existing tests) and reports whether the change is justified by an explicit project requirement or was an additional design decision — surfacing the attribution verdict transparently rather than silently accepting or reverting, then stopping for approval. Confidence: 0.7
- Post-implementation reports follow 11 numbered sections: domain structure/rationale, files created/modified, schema + indexes, models/entities/contracts/implementations, query classes, endpoints with example JSON, seed-data verification, tests run + results, environment prerequisites, decisions needing approval — clearly distinguishing completed vs unverified work. Confidence: 0.9
- Missing environment prerequisites (e.g. pdo_sqlite, real DB credentials) are reported explicitly with the exact command/config needed, never silently skipped. Confidence: 0.85
