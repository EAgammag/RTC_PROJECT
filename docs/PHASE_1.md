# Phase 1 — NROTC Secure Portal

## Overview

Phase 1 establishes the foundational security layer of the NROTC Secure Portal: a hardened authentication system, role-based access control, and role-specific dashboards. No content features (announcements, documents, AI) are included in this phase.

---

## Scope

| Area | Included |
|------|----------|
| Authentication (login, logout, password reset) | Yes |
| Brute-force lockout & session timeout | Yes |
| Role-Based Access Control (Admin / Officer / Cadet) | Yes |
| Admin user management (create, unlock, toggle) | Yes |
| Officer cadet roster (read-only) | Yes |
| Cadet personal dashboard & profile view | Yes |
| Profile management (edit, password change, delete) | Yes |
| Announcements / bulletin board | No — Phase 2 |
| Document / file management | No — Phase 2 |
| AI / agent integration | No — Phase 3 |

---

## Implemented Features

### 1. Authentication

- Email + password login with optional "remember me"
- Forgot password and reset password via email link
- Email verification flow
- Session regeneration on login (prevents session fixation)
- Generic error messages on failure (prevents user enumeration)

**Key files:**
- `app/Http/Controllers/Auth/AuthController.php`
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
- `app/Http/Controllers/Auth/NewPasswordController.php`
- `app/Http/Controllers/Auth/PasswordResetLinkController.php`
- `resources/views/auth/login.blade.php`
- `resources/views/auth/forgot-password.blade.php`
- `resources/views/auth/reset-password.blade.php`
- `routes/auth.php`

---

### 2. Security Hardening

| Concern | Implementation |
|---------|----------------|
| Brute-force protection | 5 failed login attempts → 15-minute account lockout (`login_attempts` / `locked_until`) |
| Inactivity timeout | 30-minute session timeout via `SessionTimeout` middleware |
| Password policy | NIST SP 800-63B: min 12 chars, uppercase + lowercase + digit + special character |
| Password storage | Bcrypt via `'password' => 'hashed'` model cast |
| Session fixation | `session()->regenerate()` on every successful login |
| User enumeration | Generic error: "credentials incorrect or account inactive" |
| CSRF | Laravel CSRF token enforced on all POST / PATCH / DELETE routes |
| Force-logout | Deactivated users are logged out on their next request by `EnsureRole` |

**Key files:**
- `app/Http/Middleware/EnsureRole.php`
- `app/Http/Middleware/SessionTimeout.php`
- `app/Http/Requests/Auth/LoginRequest.php`

---

### 3. Role-Based Access Control (RBAC)

Three-tier access model:

| Role | Access |
|------|--------|
| **Admin** | Full system control — manage users, view stats, unlock/deactivate accounts |
| **Officer** | Read-only cadet roster |
| **Cadet** | Own profile and dashboard only |

- `EnsureRole` middleware guards all role-scoped routes
- Automatic redirect to the correct dashboard on login via `User::dashboardRoute()`
- Deactivated users with active sessions are force-logged out immediately

**Key files:**
- `app/Http/Middleware/EnsureRole.php`
- `app/Models/User.php`
- `routes/web.php`

---

### 4. Admin Panel

**Route prefix:** `/admin` | **Middleware:** `auth, verified, session.timeout, role:admin`

| Feature | Route |
|---------|-------|
| Dashboard with stats + recent accounts | `GET /admin/dashboard` |
| Create user form | `GET /admin/users/create` |
| Store new user | `POST /admin/users` |
| Unlock locked account | `POST /admin/users/{user}/unlock` |
| Toggle active / inactive | `POST /admin/users/{user}/toggle` |

**Dashboard stats:**
- Total users
- Total officers
- Total cadets
- Active users
- Currently locked accounts

**Create user fields:** first name, middle name (optional), last name, student ID, email, role, password (+ confirmation)

**Key files:**
- `app/Http/Controllers/Admin/DashboardController.php`
- `app/Http/Requests/Admin/StoreUserRequest.php`
- `resources/views/admin/dashboard.blade.php`
- `resources/views/admin/create-user.blade.php`

---

### 5. Officer Dashboard

**Route prefix:** `/officer` | **Middleware:** `auth, verified, session.timeout, role:officer`

| Feature | Route |
|---------|-------|
| Cadet roster with stats | `GET /officer/dashboard` |

**Dashboard stats:**
- Total cadets
- Active cadets
- Inactive cadets
- Locked cadets

Officers can view the full cadet roster (name, student ID, status) but cannot modify any records.

**Key files:**
- `app/Http/Controllers/Officer/DashboardController.php`
- `resources/views/officer/dashboard.blade.php`

---

### 6. Cadet Dashboard & Profile

**Route prefix:** `/cadet` | **Middleware:** `auth, verified, session.timeout, role:cadet`

| Feature | Route |
|---------|-------|
| Personal dashboard | `GET /cadet/dashboard` |
| Profile view | `GET /cadet/profile` |

Cadets see only their own data. No cross-cadet data is exposed.

**Key files:**
- `app/Http/Controllers/Cadet/DashboardController.php`
- `resources/views/cadet/dashboard.blade.php`
- `resources/views/cadet/profile.blade.php`

---

### 7. Profile Management

**Middleware:** `auth, session.timeout` (all authenticated roles)

| Feature | Route |
|---------|-------|
| Edit name / email | `GET /profile` + `PATCH /profile` |
| Change password | Via profile edit form |
| Delete own account | `DELETE /profile` (requires password confirmation) |

**Key files:**
- `app/Http/Controllers/ProfileController.php`
- `resources/views/profile/partials/update-profile-information-form.blade.php`
- `resources/views/profile/partials/update-password-form.blade.php`
- `resources/views/profile/partials/delete-user-form.blade.php`

---

### 8. Database

**User schema additions (NROTC fields):**

| Column | Type | Description |
|--------|------|-------------|
| `student_id` | String(50), unique, nullable | Student or service number |
| `role` | Enum: admin, officer, cadet | Determines access tier |
| `is_active` | Boolean, default `true` | Soft-disable without deletion |
| `login_attempts` | UnsignedSmallInt, default `0` | Failed login counter |
| `locked_until` | Timestamp, nullable | Lockout expiration |
| `last_login_at` | Timestamp, nullable | Last successful login |

**Seeded default accounts:**

| Role | Email | Student ID |
|------|-------|------------|
| Admin | `admin@nrotc.csu.edu.ph` | `ADMIN-001` |
| Officer | `officer@nrotc.csu.edu.ph` | `OFC-001` |
| Cadet | `cadet@nrotc.csu.edu.ph` | `2024-00001` |

> **Change all default credentials immediately after first deployment.**

**Key files:**
- `database/migrations/0001_01_01_000000_create_users_table.php`
- `database/migrations/2026_03_24_000001_add_nrotc_fields_to_users_table.php`
- `database/migrations/2026_03_24_090135_create_permission_tables.php`
- `database/seeders/DatabaseSeeder.php`
- `database/factories/UserFactory.php`

---

## Known Issues / Notes

- Two duplicate `agent_conversations` table migrations exist (`2026_03_24_085351` and `2026_03_24_085426`). One must be removed before running fresh migrations.
- The admin dashboard shows only the last 10 users — no full user list or pagination yet.
- No officer view for individual cadet detail (no `/officer/cadets/{id}` route).
- The cadet profile page (`cadet/profile.blade.php`) is present but not yet committed.

---

## What's Next — Phase 2

- Announcements / bulletin board (admin post, cadet/officer read)
- Full admin user list with search and pagination
- Officer individual cadet detail view
- Document / file management (upload, download, categorize)
