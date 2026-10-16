# Antigravity Developer & Merge Rules

## 1. Comment Prompts on All Code Changes
- **CRITICAL MERGE REQUIREMENT**: Whenever you modify or add any code in response to a user request, you **MUST** add a comment referencing the user's prompt / intent directly above or around the modified code block.
- **Purpose**: Helps the user easily track changes, review diffs, and resolve merge conflicts.
- **Format**:
  - In Blade / HTML: `{{-- USER PROMPT: "<prompt or task summary>" --}}` or `<!-- USER PROMPT: "<prompt or task summary>" -->`
  - In CSS: `/* USER PROMPT: "<prompt or task summary>" */`
  - In JavaScript / PHP: `// USER PROMPT: "<prompt or task summary>"`
