# Nirmal Green — Project Instructions

## 1. Project Context
- This repository contains the Nirmal Green microgreens website.
- The Laravel application is located in backend/.
- The website requirements and roadmap should be maintained in the root plan.md.
- Inspect the existing project before making architectural decisions.
- Do not assume a framework or dependency version without checking the project files.

## 2. Plan-First Development
- Read plan.md before starting a new feature.
- If plan.md is missing, ask the user to provide or save it in the project root.
- Do not invent business requirements or implement unapproved features.
- Break approved work into small, verifiable tasks.
- Present an implementation plan before making substantial changes.

## 3. Skill Usage
Project skills are located in .commandcode/skills/.

- Laravel backend: activate laravel-best-practices.
- Automated testing: activate testing-best-practices.
- Tailwind CSS: activate tailwindcss-development.
- Understanding existing conventions: activate infer-conventions.
- Use only skills relevant to the current task.
- Read a skill's instructions before relying on its guidance.
- Do not claim a skill was applied unless its instructions were loaded.

## 4. Laravel Backend Rules
- Follow backend/AGENTS.md for Laravel-specific requirements.
- Inspect sibling files and existing patterns before creating or editing files.
- Check installed package versions before using version-specific APIs.
- Prefer Laravel conventions and Artisan generators for Laravel files.
- Search relevant framework documentation when an implementation depends on Laravel APIs.
- Do not add dependencies, create unnecessary abstractions, or introduce new architecture without justification and approval.
- Do not change backend business logic during an unrelated frontend task.

## 5. Multi-Agent Development
- The main agent owns planning, task assignment, integration, and final review.
- Delegate only tasks that can be completed independently.
- Assign clear responsibilities and explicit file ownership to each subagent.
- Never allow multiple agents to edit the same file concurrently.
- Define shared component interfaces before parallel frontend implementation.
- Pass only relevant file paths, requirements, and findings to subagents.
- Keep agent reports concise and include files changed, checks executed, results, and blockers.
- Start with a small number of agents and increase only when parallel work provides a clear benefit.
- Review all agent changes before accepting them into the final implementation.

## 6. Security and Data Integrity
- Never expose secrets, passwords, API keys, or environment variables.
- Do not overwrite .env files or production configuration without approval.
- Do not run destructive database, filesystem, or Git commands without approval.
- Never execute production migrations without explicit approval.
- Validate inputs and enforce authorization on protected operations.
- Preserve existing uncommitted user changes.

## 7. Frontend and Shared Components
- Inspect the current frontend framework and package.json before implementation.
- Reuse existing components and established styling conventions.
- Avoid introducing a second UI framework without approval.
- Check responsive behavior, accessibility, empty states, error states, and navigation.
- Do not invent product prices, health claims, or delivery promises.

## 8. Testing and Verification
- Inspect existing test conventions before writing tests.
- Write tests for changed business behavior.
- Run the narrowest relevant test suite first.
- Follow backend/AGENTS.md for Laravel testing and formatting commands.
- Run applicable frontend lint, tests, and production builds when frontend code changes.
- Review the Git diff before declaring a task complete.
- Report actual command results. Never claim an unexecuted test passed.

## 9. Completion Report
At the end of each task, report:
1. What was implemented.
2. Files created or modified.
3. Tests and checks actually executed.
4. Results, remaining issues, and blockers.
5. Any decision that requires user approval.

Do not proceed to unrelated implementation work without approval.
