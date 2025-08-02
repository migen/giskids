# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Project**: giskids Website  
**Type**: Simple PHP website with custom routing  
**Stack**: PHP 8+, TailwindCSS, MySQL  
**Local Environment**: Laravel Herd/Valet (http://giskids.test)

## Development Commands

### CSS Build Commands
```bash
# Development - watch for changes
npm run dev

# Production build - minified CSS
npm run build
```

### Database Setup
```bash
# Run all migrations and seeders
php docs/setup/database-setup.php

# Validate migrations
php docs/setup/validate-migrations.php
```

## Architecture Overview

### Simple MVC Structure
```
public/index.php          # Entry point - loads Router
library/
├── Router.php           # Simple routing for website pages
├── Request.php          # URL parsing
├── AuthSystem.php       # Auth stub (placeholder)
└── helpers.php          # Helper functions

views/
├── layouts/
│   └── app.php         # Main layout template
└── website/            # Static page views
    ├── home.php
    ├── about.php
    ├── products.php
    ├── features.php
    ├── contact.php
    ├── privacy.php
    └── terms.php
```

### Routing System
- Simple route mapping in `Router::$routes`
- Maps URL paths to view files in `views/website/`
- Layout wraps content pages automatically
- 404 handling for missing routes

### Key Implementation Details

1. **Request Flow**:
   - `public/index.php` → `Router::route()` → View file
   - Layout (`app.php`) wraps all content pages
   - Headers must be set before any output to avoid warnings

2. **URL Structure**:
   - Home: `/` or `/home`
   - Static pages: `/about`, `/products`, `/features`, etc.
   - All routes defined in `Router::$routes` array

3. **CSS/Assets**:
   - TailwindCSS source: `src/input.css`
   - Compiled output: `public/css/output.css`
   - Build with npm commands above

## Common Tasks

### Adding a New Page
1. Create view file in `views/website/pagename.php`
2. Add route in `Router::$routes` array
3. Add navigation link in `views/layouts/app.php`

### Modifying Styles
1. Edit Tailwind classes in PHP files
2. Run `npm run dev` to rebuild CSS
3. For production: `npm run build`

## Important Notes

- This is a simplified version after removing many features
- No complex auth system - just a stub for compatibility
- No controllers - direct routing to views
- Database features have been removed from routing
- Focus is on simple static website pages