

### ✅ Your Final Adjustments

* ❌ `is_recurring` → **removed** for now (can simulate via `fi_budgets` or future recurrence logic)
* ❌ `currency` → **removed** (assume single-currency context like PHP)
* ❓ `status` handling → stick with **ENUM** instead of separate `fi_statuses` table (to avoid bloat across multiple systems like `gi_notes`, `hr_requests`, etc.)

---

### 📁 File & Folder Plan (`docs/systems/finance`)

We’ll generate the following:

```
📁 docs/systems/finance
├── prd.md              # Product requirements document
├── tasks.md            # Task breakdown for MVP coding
├── schema.md           # Finance system schema only
```

Also update:

```
📁 docs/
├── schema.md           # Add summary of fi_ tables to global schema
```

---

### 🧠 Claude Code Prompt

```
# 🧾 Claude Code Prompt – MVP Finance System (giskids ERP)

You are my AI code assistant. Follow the instructions below to design, document, and scaffold the MVP of my custom PHP-based personal finance system. This is part of my broader giskids ERP project.

## 🔧 Tech Context
- Plain PHP MVC (not Laravel)
- Uses custom `index.php` bootstrap + `Kickstart.php` for autoload
- Table prefix: `fi_`
- No use of external packages, no ORM

## 🗂️ Folder Structure
Generate or update the following files:

1. `docs/systems/finance/prd.md` – Overview of the finance system, goals, and MVP scope
2. `docs/systems/finance/tasks.md` – Technical implementation plan (tables, CRUD pages, API, UI)
3. `docs/systems/finance/schema.md` – Detailed schema of `fi_` tables (with field types, constraints)
4. Update `docs/schema.md` – Add summarized entry of `fi_` tables

## 📦 Tables (MVP schema)

```

* fi\_transactions - id, user\_id, date, type, category\_id, account\_id, project\_id, description, amount, created\_at
* fi\_accounts - id, user\_id, name, type, balance, is\_active
* fi\_categories - id, user\_id, name, type, parent\_id
* fi\_projects - id, user\_id, name, description, status
* fi\_budgets - id, user\_id, category\_id, amount\_limit, period, start\_date, end\_date

```

## ✅ Constraints
- Use ENUM for fields like `type`, `status`, `period`
- No foreign keys required for MVP (handle at code level)
- `user_id` exists in core `users` table
- Designed to work standalone, but integrated into my ERP

## 📌 Notes
- Skip `currency`, `is_recurring`, `fi_entities`, and `tags`
- Do not use many-to-many tables
- Use simple PHP + PDO + HTML (no frontend framework)
- Goal is to vibe code this in one day

Start with docs and schema, and wait for review before writing code.
