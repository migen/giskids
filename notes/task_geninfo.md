Here’s your ready-to-paste **Claude Code prompt** to kickstart coding and documentation for your `gi_` (giskids Information / General Information) system:

---

```
# 🧠 Claude Code Prompt – GenInfo System (giskids Information)

You're my assistant developer and documentation aide. Follow this structured prompt to create the GenInfo module (gi_) under my giskids ERP project.

## 🗂️ File Structure
- Create new system directory: `docs/systems/geninfo`
- Create new PRD: `docs/systems/geninfo/README.md`
- Create new tasks file: `docs/systems/geninfo/tasks.md`

## ✅ System Overview
This is a lightweight but powerful "giskids Information" system to store notes, todos, events, and other unstructured or semi-structured data for my personal or team use. It allows item sharing by user or group, with basic tagging.

## 🧱 Tables to Generate (Prefix: gi_)
```

* gi_types - id, name (1:`note`, 2:`event`, 3:`todo`) - NET acronym, 
* gi_notes - id, is_active (true), is_recurring (false), user_id, type_id, title, content, data_json, priority, due_date, created_at, updated_at
* gi_shares - id, note_id, share_user_id, share_group_id, can_edit
* gi_groups - id, name, description
* gi_tags - id, name
* gi_note_tags - id, note_id, tag_id

```

## ✍️ Tasks
1. [ ] Setup migration files (non Laravel format) for the tables above
2. [ ] Update main `docs/schema.md` to include this schema
3. [ ] Scaffold admin UI (optional)
4. [ ] Seeders with 3 fake users, 5 notes, 2 groups, shared notes, and tags, seed gi_types
5. [ ] Add filters and full-text search on `gi_notes.title` and `content`

## 🧠 Notes
- Use `gi_` as table prefix
- `users` table is global (not prefixed)




