Here's the **precise prompt** you can give to Claude Code to generate a **best-practice CRUD controller + view module** (`DevnotesController.php`) for your custom PHP MVC app — this will serve as a **template or reference** for all future modules.

---

### ✅ Claude Code Prompt

> Please generate a clean, best-practice CRUD controller and view set for a reference module called `Devnotes`.
>
> Use the following specifications:
>
> #### 🧱 **Database schema**
>
> * `devnotes` (id, type\_id, title)
> * `devtypes` (id, name)
>
> #### 📁 **Controllers**
>
> * `controllers/DevnotesController.php`
> * Use PDO (from existing Database class)
> * Use a model-less direct approach (no Eloquent-style abstraction)
> * All logic inside controller
>
> #### 📁 **Views**
>
> * Views in `views/devnotes/`
> * Use `.php` files with embedded HTML and TailwindCSS only
> * No JavaScript, no frontend frameworks
>
> #### 📋 **Required Features**
>
> * List view (`table()` or `browse()` method):
>
>   * Paginated results (10 per page)
>   * Search on `title`
>   * Filter by `type_id` (dropdown filter)
>   * Table layout using Tailwind
>   * "Show" button in each row — triggers **Tailwind modal** (simulated via conditional render)
> * Create & Edit forms (same form layout)
> * Delete action (with confirmation page or link)
> * Show view (used in modal or full page)
>
> #### 🧠 Other Specs
>
> * Use `DevnotesController::table()` as main method for list view
> * Use named routes or link conventions like `/devnotes/edit/1`
> * Keep controller methods minimal and clean (max readability)
> * No JS, modals must be conditionally rendered in PHP view logic
> * Use Tailwind styling for buttons, forms, tables, and modal
>
> ✅ This should serve as a base reference implementation for future modules. Follow best practices for clean layout, controller separation, and minimalism. Avoid any boilerplate that is not essential.

---

Let me know if you want to version this as `DevcrudTemplateController.php` or with some helper abstractions included (e.g. reusable pagination or modal partials).
