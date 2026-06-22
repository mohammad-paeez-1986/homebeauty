# Home Beauty — Project Conventions

## Overview

Persian-language (RTL) Laravel 12 app for booking hairdressers/barbers for home visits in Tehran. SMS-based user auth, Google 2FA for admin. Fully Livewire v4 SFC — no traditional controllers.

---

## Tech Stack

| Layer | Choice |
|-------|--------|
| Framework | Laravel 12 |
| Frontend | Livewire v4 (Single File Components) |
| CSS | Tailwind CSS v4 (`@import "tailwindcss"` with `@theme` block) |
| JS | Alpine.js (modals, popovers), Axios |
| Build | Vite 7 + `@tailwindcss/vite` plugin |
| Database | SQLite (dev) / MySQL, PostgreSQL (prod) |
| Font | Vazir (Persian) + Instrument Sans (Latin fallback) |
| Date | `morilog/jalali` (Jalali/Persian calendar) |
| Auth 2FA | `pragmarx/google2fa-laravel` (admin only) |
| RTL | `direction: rtl` globally, `text-align: right` |

---

## Architecture

- **Zero traditional controllers** — all page logic lives in Livewire Single File Components (`.blade.php` with inline anonymous PHP class)
- **"Volt-style" SFC** — PHP class + Blade template in the same file
- **Service classes** in `app/services/` (lowercase `s`) for shared domain logic (e.g. `AuthService`, `Sms` trait)
- **Traits** in `app/Traits/` for reusable Livewire behavior (e.g. `Sms` trait for code verification)

---

## File Naming Conventions

| Type | Convention | Example |
|------|-----------|---------|
| Livewire SFC | `⚡kebab-case-name.blade.php` | `⚡login-register.blade.php`, `⚡add-request.blade.php` |
| Layouts | `layouts/name.blade.php` | `layouts/app.blade.php` |
| Pages | `pages/{area}/⚡name.blade.php` | `pages/user/⚡my-requests.blade.php` |
| Components | `components/name.blade.php` | `components/footer.blade.php`, `components/modal.blade.php` |
| Models | `app/Models/PascalCase.php` | `Order.php`, `SmsCode.php` |
| Services | `app/services/PascalCase.php` | `AuthService.php` |
| Traits | `app/Traits/PascalCase.php` | `Sms.php` |
| Middleware | `app/Http/Middleware/PascalCase.php` | `AdminMiddleware.php` |

Livewire SFC filenames always start with `⚡` (the lightning bolt character). This distinguishes them from regular Blade components.

---

## Livewire Component Patterns

### Route Registration
```php
// routes/web.php
Route::livewire('/path', 'namespaced::key')->name('route.name');
```

### Component Key Convention
- User pages: `pages::user.{kebab-name}`
- Admin pages: `pages::admin.{kebab-name}`
- Shared components: `{kebab-name}` (flat namespace)

### Anonymous SFC Structure
```blade
<?php
use Livewire\Component;

new class extends Component {
    public $property;
    public function method() {}
};
?>
<div>
    {{-- Template --}}
</div>
```

### Common Patterns Used
- `#[Modelable]` on props for two-way binding with parent (e.g. `mobile-field`, `verify-code`)
- `wire:model` for form inputs
- `wire:click` for actions
- `wire:submit` for form submission
- `wire:loading.attr="disabled"` for loading states
- `wire:loading.remove` / `wire:loading.delay` for button text swap
- `$listeners` / `dispatch('event-name')` for cross-component communication
- Alpine.js `@click` / `x-data` for client-side interactions (modals, popovers)
- `livewire:pages::user.add-request` syntax for including Livewire in Blade

---

## Route Conventions

```php
// Public landing
Route::view('/', 'index');

// User auth (SMS-based, auto-handled by Livewire)
Route::middleware('auth')->group(function () { ... });

// Admin routes (separate guard)
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () { ... });
```

### Named Routes
- `my-requests`, `request-registered`, `auth-error`
- `admin.login`, `admin.index`, `admin.orders`, `admin.services`, `admin.users`, `admin.logout`

### Guards
- `web` — User model (SMS auth)
- `admin` — Admin model (mobile + Google 2FA)

---

## Authentication Flow

### User Login (SMS-based)
1. User enters mobile → `SmsCode::generate($mobile)` creates 4-digit code with 5-min expiry
2. Code displayed via alert (dev mode — no real SMS gateway yet)
3. User enters code → `SmsCode::checkCode()` validates
4. `AuthService::checkUser()` finds or creates user
5. `Auth::login()` authenticated

### Admin Login (2FA)
1. Admin enters mobile → checks `Admin` model exists + `is_active`
2. Verifies Google 2FA code via `pragmarx/google2fa-laravel`
3. Logs in with `auth('admin')->login()`

---

## Styling Conventions

### Tailwind v4
- CSS-first config via `@import "tailwindcss"` in `resources/css/app.css`
- Custom values defined in `@theme` block:
  - `--font-sans` — Vazir + fallback
  - `--color-amber-*` — Brand palette (base `#67371A` at 700)

### Utility Classes
- No `@apply` in CSS (Tailwind classes used directly in markup)
- `rounded-xs`, `rounded-sm` for corners (no large radius — flat design)
- `border border-gray-200` for card separation (no shadows — flat design)
- `bg-white` for cards, sections
- Responsive stacking: `grid-cols-1 sm:grid-cols-2 md:grid-cols-4`

### Color Palette (Custom Amber)
| Scale | Hex | Usage |
|-------|-----|-------|
| 50 | `#FCF4EE` | Icon backgrounds, highlight areas |
| 100 | `#F7E6D6` | Badge backgrounds, hover states |
| 200 | `#EFCEB6` | Borders, subtle accents |
| 500 | `#B8734A` | Accent text, secondary elements |
| 700 | `#67371A` | Primary brand — buttons, active states |
| 800 | `#542C14` | Dark hover, pressed states |
| 900 | `#402011` | Hero overlay, footer |

### Layout
- Public: `max-w-2xl mx-auto` centered content
- Hero: Full-width via `@yield('hero')` before `<main>` in layout
- Admin: Sidebar + content area
- `background: #f2f6fc` page background

### RTL
```css
html, body {
    direction: rtl;
    text-align: right;
}
```
Use `.ltr` / `.dir-ltr` utility classes for elements needing LTR (phone numbers, prices).

---

## Blade Component Patterns

### Layout Structure
```blade
{{-- layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="fa">
<head>@vite, @livewireStyles</head>
<body>
    <livewire:header />
    @yield('hero')
    <main class="max-w-2xl mx-auto ...">
        @yield('content')
        {{ $slot ?? '' }}
    </main>
    <x-footer />
    <x-toast />
    @livewireScripts
</body>
</html>
```

### Reusable Blade Components
- `<x-modal />` — Alpine.js modal with Livewire entangle
- `<x-popover />` — Tooltip popover
- `<x-toast />` — Notification toast (listens for `toast` event)
- `<x-footer />` — Site footer

### Section Convention
```blade
@extends('layouts.app')
@section('hero') ... @endsection   {{-- full-width hero (outside main) --}}
@section('content') ... @endsection {{-- constrained content --}}
```

---

## Database Conventions

### Naming
- Table names: `snake_case` plural (e.g. `sms_codes`, `admins`, `orders`)
- PK: `id` (bigint auto-increment)
- FK: `{singular_table}_id` (e.g. `user_id`)
- Timestamps: `created_at`, `updated_at` (except `SmsCode` which omits `updated_at`)
- Soft deletes: `deleted_at` (used by `Service` model)

### Models
- Fillable/guarded explicitly defined (no mass-assignment leaks)
- Casts for type safety (`boolean`, `integer`, `datetime`, `hashed`)
- Model events in `booted()` for auto-defaults (e.g. `Service` auto-sets `position`)
- Accessors/mutators for encryption (e.g. `Admin::google2fa_secret`)

---

## Key Packages Usage

| Package | How We Use It |
|---------|--------------|
| `livewire/livewire` | SFC components, `#[Modelable]`, `dispatch()`, `WithPagination`, `wire:model` |
| `morilog/jalali` | `jdate()`, `Jalalian::now()`, `->format('%A')` for Persian weekday names |
| `pragmarx/google2fa-laravel` | Admin 2FA: `Google2FA::verifyKey()` in admin login |
| `noerd/modal` | Alert/notification modals |

---

## JS / Alpine.js Patterns

### Modal Pattern
```blade
<div x-data="{ showModal: false }">
    <button @click="showModal = true">Open</button>
    <div x-show="showModal">
        <!-- modal content -->
        <button @click="showModal = false">Close</button>
    </div>
</div>
```

### Toast Notifications
```js
// Dispatch from Livewire
$this->dispatch('toast', message: '...');

// Component listens via Livewire event
```

---

## Code Quality Notes

- No `@apply` in CSS files — inline Tailwind classes in Blade
- No `@lang()` or translation files — hardcoded Persian strings throughout
- No TypeScript — plain JS (Alpine + Axios)
- No PHPUnit tests written yet (test stubs exist)
- No CI/CD configured
- No static analysis (PHPStan, Larastan) configured
- `Sms` trait is shared by two components via `use Sms`
- `AuthService` handles both login and registration in one flow
- SMS codes displayed via JS `alert()` in development — no gateway integrated
