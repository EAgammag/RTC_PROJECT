# System Objectives — CCJE NROTC Secure Portal
**CSU–Aparri Reserve Officers' Training Corps**

This document outlines the specific objectives and goals that guide the design, development, and deployment of the NROTC Secure Login and Role-Based Access System.

---

## Specific Objectives

### 1. Secure Authentication System
Design and implement a secure authentication system for all NROTC users, enforcing strict identity verification before granting any access to the portal.

**Implementation targets:**
- Credential validation against stored, hashed passwords (bcrypt)
- Account lockout after 5 consecutive failed login attempts (15-minute cooldown)
- Session fixation prevention via ID regeneration on login
- Automatic session expiration after 30 minutes of inactivity
- Generic error messages to prevent user enumeration

---

### 2. Role-Based Access Control (RBAC)
Implement a three-tier role-based access control system for Administrators, Officers, and Cadets, ensuring each user can only access the features and data assigned to their role.

**Roles defined:**
| Role | Scope |
|---|---|
| Administrator | Full system control — user management, unit data, audit oversight |
| Officer | Operational access — cadet roster, attendance, records, communications |
| Cadet | Read-only — personal profile, attendance history, announcements |

---

### 3. Data Protection & Encrypted Password Storage
Ensure all sensitive data is protected through validated login credentials and industry-standard encrypted password storage.

**Implementation targets:**
- Passwords hashed using bcrypt (via Laravel's `Hash` facade)
- Password policy: minimum 12 characters, mixed case, digits, and special characters
- HTTPS-enforced sessions; credentials never stored in plaintext
- Sensitive fields (e.g., `student_id`, `email`) validated for uniqueness on creation

---

### 4. User Management for Administrators
Develop user management features allowing administrators to register, update, and deactivate user accounts across the system.

**Implementation targets:**
- Account creation form with strict `StoreUserRequest` validation
- Role assignment (admin / officer / cadet) at account creation
- Account activation/deactivation toggle (instant session eviction on deactivation)
- Account unlock capability after brute-force lockout
- Unit-wide statistics dashboard: total users, by-role counts, locked accounts

---

### 5. Controlled Officer Access
Provide officers with controlled access to operational and record-management modules based on their assigned roles, without exposing administrative functionality.

**Implementation targets:**
- Officer dashboard with full active cadet roster (read-access)
- Ability to issue merit and demerit evaluations
- Access to attendance and formation records
- Publish unit-wide communications and orders
- All officer routes protected by `EnsureRole:officer` middleware

---

### 6. Cadet Read-Only Access
Restrict cadets to limited, read-only access to authorized personal information only — no cross-cadet data exposure.

**Implementation targets:**
- Cadet dashboard scoped strictly to `Auth::user()` — no roster-wide queries
- View: personal profile, enrollment data, attendance history, merit/demerit standing
- Read access to unit-wide announcements
- All write/admin routes blocked via `EnsureRole:cadet` middleware returning HTTP 403

---

### 7. Audit Logs & Accountability
Integrate audit logging to track user activities and ensure full accountability within the system.

**Implementation targets:**
- Log all authentication events: successful logins, failed attempts, lockouts, logouts
- Log account state changes: creation, activation/deactivation, role changes, unlocks
- Log session timeout events
- Deactivated accounts evicted and logged immediately on next request
- All sessions subject to monitoring (disclosed to users in system policy)

> **Status:** Audit log infrastructure is planned for the next release cycle.

---

### 8. Testing — Usability, Functionality & Security
Test the system thoroughly for usability, functionality, and security before deployment.

**Testing targets:**
- Feature tests covering all authentication flows (login, lockout, logout, session timeout)
- Role-based access tests: each role is blocked from unauthorized routes (403 responses)
- Form validation edge cases: duplicate emails, weak passwords, invalid roles
- Anti-enumeration test: error messages must not reveal whether an account exists
- Profile update and account deletion tests
- PHPUnit test suite (`php artisan test`) must pass with zero failures before any release

---

### 9. Full System Deployment
Deploy a fully functional Secure Login and Role-Based Access System for CSU–Aparri NROTC, production-ready and accessible to verified personnel only.

**Deployment targets:**
- All migrations run cleanly on production database
- `.env` production configuration with hardened settings (`APP_DEBUG=false`, `APP_ENV=production`)
- Assets compiled via `npm run build` (Vite production build)
- Self-registration disabled; accounts issued exclusively by administrators
- All pages served over HTTPS

---

### 10. User Feedback & Future Enhancement
Gather user feedback from administrators, officers, and cadets after deployment for future enhancements, maintenance, and improved system performance.

**Planned feedback mechanisms:**
- Post-deployment usability survey for each role (admin, officer, cadet)
- Issue tracking for bugs and feature requests
- Periodic maintenance reviews for security patches and dependency updates
- Roadmap items under consideration: audit log viewer, attendance management module, merit/demerit tracking, unit communications inbox, mobile-responsive improvements

---

## Implementation Status

| # | Objective | Status |
|---|---|---|
| 1 | Secure Authentication System | ✅ Complete |
| 2 | Role-Based Access Control | ✅ Complete |
| 3 | Data Protection & Encrypted Passwords | ✅ Complete |
| 4 | Administrator User Management | ✅ Complete |
| 5 | Controlled Officer Access | ✅ Complete |
| 6 | Cadet Read-Only Access | ✅ Complete |
| 7 | Audit Logs & Accountability | 🔄 Planned |
| 8 | Testing | 🔄 In Progress |
| 9 | Full System Deployment | 🔄 In Progress |
| 10 | User Feedback & Enhancement | ⏳ Post-Deployment |

---

*Last updated: 2026-03-25*
