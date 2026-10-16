# Taste

- Prefers plan-first work: read-only audit, written plan with exact file list, then STOP and wait for explicit approval before modifying anything. Confidence: 0.95
- Existing/approved work must be preserved; changes should be additive and zero-risk to frozen code. Confidence: 0.9
- Secrets, `.env`, and APP_KEY are never committed; `.env` is never opened, printed, or overwritten (environment overrides are passed as CLI variables instead); `.env.example` carries variable names + safe placeholders only. Confidence: 0.9
- Wants architecture work reported as a structured multi-section document ending in a phased implementation plan. Confidence: 0.8
- Adopts a senior-architect stance: decisive recommendations with rationale, not neutral option lists. Confidence: 0.7
