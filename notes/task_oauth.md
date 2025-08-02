# 🧠 Claude Code Prompt — Add OAuth Login to Custom AuthSystem

I already have a working custom PHP MVC framework with a single-file `AuthSystem.php` that handles:
- Email + password login
- Session + token-based auth

Now I want to extend this to support OAuth login (e.g., Google, Facebook), using the industry standard.

## 🔧 Instructions:
1. Modify or extend `AuthSystem.php` to support external OAuth login
2. Use OAuth2/OpenID Connect for Google login (as starting point)
3. Do not use Laravel or any frameworks — raw PHP or minimal libraries (Guzzle or CURL is fine)
4. Flow should be:
   - User clicks "Login with Google"
   - Redirect to Google consent screen
   - Handle callback, retrieve user info
   - If user doesn't exist in `users` table → create with random password
   - If user exists → log them in and start session
5. Store Google ID in `users.oauth_google_id` field (add if needed)

## 🧾 Additional Notes:
- Google is the main priority; other providers can follow the same pattern
- Implement token verification and user info fetching securely
- Protect against CSRF and replay attacks (state token)

## 🔐 users Table Adjustment (if needed)
* users - id, name, email, password, oauth_google_id, created_at, updated_at


