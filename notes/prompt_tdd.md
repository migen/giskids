Memorize and follow this TDD convention for all future test-related tasks:

1. Create and use a `tests/` folder directly under the project root (same level as controllers, models, views, etc.).

2. Do not delete test files after they pass. All test files must be kept for future regression testing.

3. Follow a flat file structure. Do not create MVC-style subfolders inside `tests/`.

4. Use the following test file naming convention:
   `tests/{YYYYMMDD}_test_{system}_{module}_{feature}.php`

   Example:
   `tests/20250721_test_users_auth_flow.php`

5. Each test file must begin with a comment header block like this:
   ```php
   // TEST: cs_users - Auth Flow
   // SYSTEM: CoreSystem (cs)
   // MODULE: Users
   // FEATURE: login / auth / session
