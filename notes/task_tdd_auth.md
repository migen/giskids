
---

### ✅ Your Updated Auth Behavior Clarified

| URL Path     | Behavior for `is_admin = 1`                                     |
| ------------ | --------------------------------------------------------------- |
| `/login`     | ✅ Redirect to `admin_site_url` from `.env`                      |
| `/dashboard` | ✅ Allow access (admin can use regular dashboard)                |
| `/admin`     | ✅ Redirect to `admin_site_url` from `.env`                      |
| Other paths  | ✅ Admin can navigate app like a regular user (if authenticated) |

---

### ✅ Params Clarification

Your controller method signature expects:

```php
public function summary($params = [])
{
    $year = $params[0]; // e.g., '2023'
}
```

So `/finance/summary/2023` resolves to:

* `FinanceController::summary(['2023'])`

Not: `summary('2023')`

✅ Understood and incorporated into the updated prompt.

---

### 📦 Final Claude Code Prompt – TDD + Auth + Routing + Subdomain Redirects

```
# 🧪 Claude Code Prompt – Auth-Aware Routing with TDD (Custom PHP MVC)

You're working on my custom PHP MVC app for giskids (not Laravel). Here's the architecture and routing behavior.

## 📁 Architecture
- `public/index.php` loads `Kickstart.php`
- `Kickstart` loads: `env`, `session`, `database`, `Request.php`, `Router.php`
- URL format: `/controller/method/param1/param2/...`
- Methods receive `$params` array — NOT individual args
  - e.g., `/finance/summary/2023` → `FinanceController::summary(['2023'])`

## 🔐 Auth Model
- Shared `users` table (across frontend and admin apps)
- Fields:
  - `is_admin` (BOOLEAN)
  - `admin_roles` (JSON array of module names)
- Auth behavior:
  - Unauthenticated users can only access:
    - `WebsiteController::*` (e.g. `/about`, `/products`)
    - `AuthController::*` (e.g. `/login`, `/register`)
  - Authenticated users:
    - Can access any valid controller/method
  - Admin users (`is_admin = 1`) can:
    - Access regular `/dashboard` page
    - Be redirected **only** when trying to access:
      - `/login`
      - `/admin`
    - Redirect goes to:
      - `.env('ADMIN_SITE_URL')` → `admin.giskids.com` (prod) or `giskids-admin.test` (local)

## 🧭 Routing Order
1. If first segment is in `$websiteRoutes` → `WebsiteController::{method}`
2. Else if in `$authRoutes` → `AuthController::{method}`
3. Else → parse as dynamic `Controller::method($params)`
4. If controller or method not found → return 404

## 🧪 TDD Flow
Use Test-Driven Development:
- Write failing tests for these routes first
- Implement code to make each test pass
- Iterate cleanly

## ✅ Test Cases

| URL Path             | Expected Outcome                          |
|----------------------|-------------------------------------------|
| `/about`             | WebsiteController::about()                |
| `/products`          | WebsiteController::products()             |
| `/login` (admin)     | ❌ Redirect to admin site (from .env)     |
| `/login` (user)      | AuthController::login()                   |
| `/dashboard` (any)   | DashboardController::index()              |
| `/admin`             | ❌ Redirect to admin site (from .env)     |
| `/notes/app/123`     | NotesController::app(['123'])             |
| `/finance/summary/2023` | FinanceController::summary(['2023'])   |
| `/notfound/test`     | 404 Not Found                             |

## 🛠️ Requirements
- Use `.env('ADMIN_SITE_URL')` to resolve admin subdomain
- Apply redirect logic only for admins accessing `/login` or `/admin`
- Auth check must restrict non-authenticated users from accessing anything except Website/Auth routes
- No frameworks. No Laravel. Native PHP only.

Start by writing tests that verify route resolution, access control, and redirect behavior. Then implement the routing logic to pass those tests.
```

---

### 🧠 Memory to Save (`claude.md` or Session Notes)

```
# giskids PHP MVC App – Auth + Routing Behavior Summary

- Uses Kickstart.php bootstrapping from public/index.php
- Shared users table with fields: id, email, password, is_admin, admin_roles
- URL format: /controller/method/param1/param2...
- Controller methods receive $params as array
- is_admin users can use frontend but are redirected to ADMIN_SITE_URL if accessing /login or /admin
- frontend routes are ordered: websiteRoutes → authRoutes → dynamic fallback → 404
- TDD is used: test > fail > implement > pass
```




## 🧾 Users Table Fields

* users - id, name, email, password, api_token, is_admin, admin_roles, oauth_provider, oauth_id, last_login_at, created_at, updated_at

### Field Details:
- `email` → used for login
- `password` → bcrypt-hashed (nullable if using OAuth)
- `api_token` → for token-based auth (mobile/API)
- `is_admin` → BOOLEAN, `1` = admin user (has access to admin app)
- `admin_roles` → JSON array of allowed systems

### Sample admin_roles values:
```json
["notes", "finance", "sales"]
