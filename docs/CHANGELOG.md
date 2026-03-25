# RTC_PROJECT — Changelog

All notable changes, updates, and additions to this project are documented here.
Format follows [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

---

## [Unreleased]

---

## [0.2.0] — 2026-03-25

### Added

#### Authentication & Security
- Custom `AuthController` replacing the default Breeze session controller, implementing OWASP-aligned login/logout logic
- Brute-force protection: account lockout after 5 consecutive failed login attempts (locked for 15 minutes); configurable via `User::MAX_LOGIN_ATTEMPTS` and `User::LOCKOUT_MINUTES` constants
- Anti-user-enumeration: login errors return a generic message regardless of whether the e-mail exists or the account is inactive
- Session fixation prevention: `session()->regenerate()` called on every successful login
- `SessionTimeout` middleware: automatically logs out idle authenticated sessions after 30 minutes of inactivity; session timer refreshed on every request
- `EnsureRole` RBAC middleware: enforces role-based access control, redirects unauthenticated users to login, force-logs out deactivated accounts, and aborts with 403 for unauthorized roles
- Middleware aliases registered in `bootstrap/app.php`: `role` → `EnsureRole`, `session.timeout` → `SessionTimeout`

#### User Model Enhancements
- NROTC-specific database migration (`2026_03_24_000001_add_nrotc_fields_to_users_table`) adding: `student_id` (unique, max 50), `role` (enum: admin/officer/cadet), `is_active` (boolean), `login_attempts` (smallint), `locked_until` (timestamp), `last_login_at` (timestamp)
- Role helper methods on `User`: `isAdmin()`, `isOfficer()`, `isCadet()`, `isLocked()`
- `dashboardRoute()` helper on `User` returning the correct role-specific dashboard URL
- Attribute casting: `is_active` → boolean, `locked_until` / `last_login_at` → datetime, `password` → hashed

#### Role-Based Dashboards & Routes
- Smart `/dashboard` redirect route: authenticated users are redirected to their role-specific dashboard automatically
- **Admin route group** (`/admin`, middleware: `auth`, `verified`, `session.timeout`, `role:admin`):
  - `GET /admin/dashboard` — unit statistics and recent accounts
  - `GET /admin/users/create` — new account creation form
  - `POST /admin/users` — store a new user account
  - `POST /admin/users/{user}/unlock` — unlock a locked account and reset failed-attempt counter
  - `POST /admin/users/{user}/toggle` — toggle active/inactive account state
- **Officer route group** (`/officer`, middleware: `auth`, `verified`, `session.timeout`, `role:officer`):
  - `GET /officer/dashboard` — read-only cadet roster with active cadet stats
- **Cadet route group** (`/cadet`, middleware: `auth`, `verified`, `session.timeout`, `role:cadet`):
  - `GET /cadet/dashboard` — personal profile and account details view
- **Profile routes** (all authenticated roles): edit, update, and delete account accessible at `/profile`

#### Controllers
- `Admin\DashboardController`: unit stats aggregation (total/officers/cadets/active/locked counts), recent accounts list (last 10), create-user form, store user, unlock account, toggle active status
- `Officer\DashboardController`: active cadet roster ordered by name, read-only access enforcement
- `Cadet\DashboardController`: personal cadet data scoped to `Auth::user()` — no cross-cadet data exposure
- `ProfileController`: profile edit, update (with email re-verification trigger on e-mail change), and account self-deletion with password confirmation

#### Form Request Validation
- `StoreUserRequest`: name, student_id (unique), email (unique), role (enum), password (min 12 chars, must contain uppercase, lowercase, digit, and special character via regex), with custom error messages
- `ProfileUpdateRequest`: standard profile update validation

#### UI & Views
- Dark-themed application layout (`layouts/app.blade.php`) with fixed sidebar, top bar, CCrJE ROTC branding, and CSU — Aparri institution label
- Guest layout (`layouts/guest.blade.php`) for unauthenticated pages
- Navigation partial (`layouts/navigation.blade.php`)
- **Admin views**: `admin/dashboard.blade.php` (stat cards, recent accounts table with unlock/toggle actions), `admin/create-user.blade.php` (account creation form)
- **Officer view**: `officer/dashboard.blade.php` (cadet roster table, read-only badge, total/active stats)
- **Cadet view**: `cadet/dashboard.blade.php` (profile card, account details, status/role badges; attendance and profile sections stubs marked "coming soon")
- **Auth views**: login, register, forgot-password, reset-password, verify-email, confirm-password
- **Profile view**: `profile/edit.blade.php` with update-info and delete-account partials
- **Blade components** (13): `application-logo`, `auth-session-status`, `danger-button`, `dropdown`, `dropdown-link`, `input-error`, `input-label`, `modal`, `nav-link`, `primary-button`, `responsive-nav-link`, `secondary-button`, `text-input`
- `AppLayout` and `GuestLayout` view component classes

#### Laravel AI / Agent Infrastructure
- `laravel/ai` package integrated; AI config at `config/ai.php`
- `agent_conversations` and `agent_conversation_messages` tables created via `AiMigration` (`2026_03_24_085351`)
- Artisan stubs added for scaffolding AI agents: `agent.stub`, `structured-agent.stub`, `agent-middleware.stub`, `tool.stub`
- Duplicate migration no-op guard (`2026_03_24_085426`) to prevent double-creation

#### Permissions Package
- `spatie/laravel-permission` installed; permission tables migration (`2026_03_24_090135`) creates: `permissions`, `roles`, `model_has_permissions`, `model_has_roles`, `role_has_permissions` tables
- `config/permission.php` configuration file added
- `RiakServiceProvider` stub registered in application providers

#### Full Auth Stack (Laravel Breeze-based)
- Full password reset flow: forgot-password, password-reset-link email, token-based reset
- Email verification: verification prompt, signed verification link, resend notification
- Password confirmation gate and in-session password update
- All auth controllers in `App\Http\Controllers\Auth\`

---

## [0.1.0] — 2026-03-24

### Added
- Initialized Laravel 13.1.1 project scaffold using `composer create-project laravel/laravel`
- Installed Laravel Installer v5.24.9 globally via Composer
- Installed NPM dependencies (86 packages) including Vite for frontend asset bundling
- Default Laravel directory structure: `app/`, `bootstrap/`, `config/`, `database/`, `public/`, `resources/`, `routes/`, `storage/`, `tests/`
- Default Laravel migrations: `users`, `cache`, `jobs` tables
- `vite.config.js` for asset bundling
- `.env` and `.env.example` environment configuration files

### Environment
- PHP 8.5.3
- Composer 2.9.3
- Node.js v22.22.0 / NPM 11.11.1
- Laravel Framework 13.1.1

---

<!-- Template for future entries:

## [X.Y.Z] — YYYY-MM-DD

### Added
- 

### Changed
- 

### Fixed
- 

### Removed
- 

-->
