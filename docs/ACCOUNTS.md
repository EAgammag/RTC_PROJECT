# Accounts

## Overview

The system uses a three-tier Role-Based Access Control (RBAC) model with email + password authentication. Accounts are secured with brute-force lockout, 30-minute session timeout, and NIST SP 800-63B–compliant password policy (minimum 12 characters, mixed case, digit, special character).

---

## Roles

| Role | Constant | Description |
|------|----------|-------------|
| **Admin** | `User::ROLE_ADMIN` | Full system control — manage users, view stats, unlock/deactivate accounts |
| **Officer** | `User::ROLE_OFFICER` | Read-only access to active cadet roster |
| **Cadet** | `User::ROLE_CADET` | View own profile and announcements only |

---

## User Schema

| Column | Type | Default | Description |
|--------|------|---------|-------------|
| `id` | BigInt (PK) | — | Primary key |
| `name` | String(255) | — | Full name |
| `student_id` | String(50), unique, nullable | — | Student or service number |
| `email` | String(255), unique | — | Login email (stored lowercase) |
| `email_verified_at` | Timestamp, nullable | `null` | Set when email is verified |
| `password` | String(255) | — | Bcrypt hash (auto-cast) |
| `role` | Enum: admin, officer, cadet | `cadet` | Determines access tier |
| `is_active` | Boolean | `true` | Soft-disable without deletion |
| `login_attempts` | UnsignedSmallInt | `0` | Failed login counter |
| `locked_until` | Timestamp, nullable | `null` | Lockout expiration |
| `last_login_at` | Timestamp, nullable | `null` | Last successful login |
| `remember_token` | String(100), nullable | — | "Remember me" token |
| `created_at` | Timestamp | — | Account creation |
| `updated_at` | Timestamp | — | Last modification |

---

## Authentication Flow

```
POST /login
  │
  ├─ Validate email + password
  ├─ Look up user by email
  ├─ Reject if not found or inactive (generic error — prevents enumeration)
  ├─ Reject if locked (locked_until in future)
  ├─ Hash::check() password (constant-time)
  │
  ├─ On failure:
  │   ├─ Increment login_attempts
  │   ├─ If attempts ≥ 5 → lock account for 15 minutes
  │   └─ Flash remaining attempts count
  │
  └─ On success:
      ├─ Reset login_attempts to 0, clear locked_until
      ├─ Set last_login_at
      ├─ Auth::login() with optional "remember me"
      ├─ Regenerate session (prevents fixation)
      └─ Redirect to role dashboard
```

---

## Routes

### Guest (unauthenticated)

| Method | URI | Action |
|--------|-----|--------|
| GET | `/login` | Show login form |
| POST | `/login` | Process login |
| GET | `/forgot-password` | Show reset link form |
| POST | `/forgot-password` | Send reset link email |
| GET | `/reset-password/{token}` | Show reset form |
| POST | `/reset-password` | Process password reset |

### Authenticated

| Method | URI | Middleware | Action |
|--------|-----|-----------|--------|
| POST | `/logout` | `auth` | Log out |
| GET | `/dashboard` | `auth, verified` | Redirect to role dashboard |

### Admin (`auth, verified, session.timeout, role:admin`)

| Method | URI | Action |
|--------|-----|--------|
| GET | `/admin/dashboard` | Dashboard with stats + recent accounts table |
| GET | `/admin/users/create` | Create account form |
| POST | `/admin/users` | Store new account |
| POST | `/admin/users/{user}/unlock` | Unlock locked account |
| POST | `/admin/users/{user}/toggle` | Toggle active/inactive |

### Officer (`auth, verified, session.timeout, role:officer`)

| Method | URI | Action |
|--------|-----|--------|
| GET | `/officer/dashboard` | Dashboard with read-only cadet roster |

### Cadet (`auth, verified, session.timeout, role:cadet`)

| Method | URI | Action |
|--------|-----|--------|
| GET | `/cadet/dashboard` | Personal dashboard |
| GET | `/cadet/profile` | Profile page |

### Profile (all authenticated, `auth, session.timeout`)

| Method | URI | Action |
|--------|-----|--------|
| GET | `/profile` | Edit profile form |
| PATCH | `/profile` | Update name/email |
| DELETE | `/profile` | Delete own account (requires password confirmation) |

---

## Admin Account Management

Admins can create accounts, unlock locked accounts, and toggle accounts active/inactive from the admin dashboard.

### Creating an Account

**Endpoint:** `POST /admin/users`
**Validation (StoreUserRequest):**

| Field | Rules |
|-------|-------|
| `name` | Required, string, max 255 |
| `student_id` | Required, string, max 50, unique |
| `email` | Required, email, max 255, unique |
| `password` | Required, min 12, confirmed, must include uppercase + lowercase + digit + special character |
| `role` | Required, one of: admin, officer, cadet |

### Unlocking an Account

**Endpoint:** `POST /admin/users/{user}/unlock`
Resets `login_attempts` to 0 and clears `locked_until`.

### Toggling Active/Inactive

**Endpoint:** `POST /admin/users/{user}/toggle`
Flips `is_active`. Deactivated users with active sessions are force-logged out on their next request by the `EnsureRole` middleware.

---

## Security

| Concern | Implementation |
|---------|----------------|
| **Brute Force** | 5 failed attempts → 15-minute lockout (`login_attempts` / `locked_until`) |
| **Password Storage** | Bcrypt via `'password' => 'hashed'` model cast |
| **Session Fixation** | `session()->regenerate()` on login |
| **Session Timeout** | 30-minute inactivity auto-logout (`SessionTimeout` middleware) |
| **User Enumeration** | Generic error: "credentials incorrect or account inactive" |
| **Access Control** | `EnsureRole` middleware checks `auth`, `is_active`, and role |
| **CSRF** | Laravel CSRF token on all POST/PATCH/DELETE routes |
| **Deactivation** | Immediate force-logout even with valid session |

---

## Middleware

| Middleware | Alias | Purpose |
|-----------|-------|---------|
| `EnsureRole` | `role:{roles}` | Verifies user is authenticated, active, and has an allowed role. Returns 403 otherwise. |
| `SessionTimeout` | `session.timeout` | Logs out users idle for more than 30 minutes. |

---

## Model Helpers

```php
$user->isAdmin(): bool       // role === 'admin'
$user->isOfficer(): bool     // role === 'officer'
$user->isCadet(): bool       // role === 'cadet'
$user->isLocked(): bool      // locked_until is in the future
$user->dashboardRoute(): string  // Returns role-specific dashboard URL
```

---

## Factory & Seeder

### Factory (`UserFactory`)

Default state creates a verified cadet with password `password` and a random student ID (`####-#####`).

**States:** `unverified()` — sets `email_verified_at` to null.

### Seeder (`DatabaseSeeder`)

Three default accounts seeded via `User::firstOrCreate()`:

| Role | Email | Student ID | Password |
|------|-------|------------|----------|
| Admin | `admin@nrotc.csu.edu.ph` | `ADMIN-001` | `Admin@NROTC2026!` |
| Officer | `officer@nrotc.csu.edu.ph` | `OFC-001` | `Officer@NROTC2026!` |
| Cadet | `cadet@nrotc.csu.edu.ph` | `2024-00001` | `Cadet@NROTC2026!` |

> **⚠️ Change these credentials immediately after first deployment.**

---

## Key Files

| File | Purpose |
|------|---------|
| `app/Models/User.php` | User model with role logic and security constants |
| `app/Http/Controllers/Auth/AuthController.php` | Login/logout with lockout logic |
| `app/Http/Controllers/Admin/DashboardController.php` | Admin dashboard, user CRUD, unlock/toggle |
| `app/Http/Controllers/Officer/DashboardController.php` | Officer dashboard with cadet roster |
| `app/Http/Controllers/Cadet/DashboardController.php` | Cadet dashboard and profile |
| `app/Http/Controllers/ProfileController.php` | Profile edit/update/delete (all roles) |
| `app/Http/Requests/Admin/StoreUserRequest.php` | Validation for admin user creation |
| `app/Http/Middleware/EnsureRole.php` | RBAC middleware |
| `app/Http/Middleware/SessionTimeout.php` | 30-minute inactivity timeout |
| `routes/auth.php` | Authentication routes |
| `routes/web.php` | Role-scoped dashboard routes |
| `config/permission.php` | Spatie Permission package config |
