
## ✅ Final Auth System Design Summary (Your Stack)

### 🔐 Authentication

* Login via: `email` field
* Password: hashed with **bcrypt**
* Auth method: **session-based**, with optional **token-based** (API support)
* No `users.account` field needed

### 👤 Users Table (MVP Schema)

```sql
users (
  id INT PK,
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  api_token VARCHAR(255) NULL,
  last_login_at DATETIME NULL,
  created_at DATETIME,
  updated_at DATETIME
)
```

---

### 🔐 Security

* ✅ CSRF protection (for form-based POSTs)
* 🚫 No login throttling or 2FA (for now, future optional)
* ✅ Login logs: minimal, optionally to `logs` table

---

### 📦 Roles & Permissions

* ❌ No roles or permissions for now (Spatie roles only in Laravel admin, not here)

---

### 🛠️ Structure & Portability

* ✅ One single file: `Auth.php` or `AuthSystem.php`

  * Handles login, logout, verify password, set session/token
  * Optional: static methods for helpers (e.g., `Auth::check()`, `Auth::user()`)

---

### 🌐 Multi-app Usage

* Each project has its own `users` table (no shared DB)
* Reuse by copying the `Auth.php` file and pointing to local users table

---

