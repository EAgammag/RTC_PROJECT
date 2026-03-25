# Auth Interface — Design & Implementation Reference

**File:** `public/auth-prototype.html`
**Type:** Standalone HTML prototype (embedded CSS + JS)
**System:** CSU Aparri NROTC Information System v2.0

---

## Purpose

Single-file authentication prototype implementing a Login and Registration interface for the Naval Reserve Officers Training Corps Information System. Serves as a design reference and functional UI proof-of-concept before integration into the Laravel Blade view layer.

---

## Visual Design

### Color Palette

| Token      | Value       | Usage                              |
|------------|-------------|------------------------------------|
| `--navy`   | `#0a1628`   | Page background, card background   |
| `--navy2`  | `#0d1e38`   | Input backgrounds, select options  |
| `--gold`   | `#c9a84c`   | Borders, accents, badge, links     |
| `--gold2`  | `#e8c96a`   | Crest title text, active tab text  |
| `--error`  | `#e05252`   | Validation errors, error alerts    |
| `--success`| `#4ade80`   | Status dot, success alerts         |
| `--text`   | `#e0dccf`   | Primary body text                  |
| `--text-dim`| `#7a8fa8`  | Labels, placeholders, dim content  |

### Typography

| Font               | Usage                                      |
|--------------------|--------------------------------------------|
| **Bebas Neue**     | Card title, tab labels, submit buttons     |
| **Rajdhani**       | Body text, form input values               |
| **Share Tech Mono**| Field labels, security badge, error text   |

All fonts loaded from Google Fonts.

### Background

- **Grid lines:** CSS `repeating-linear-gradient` at `44px` intervals using gold at `3.5%` opacity, applied via `body::before`
- **Spotlight:** Radial gradient ellipse centered slightly above mid-page, gold tinted at `9%` opacity, applied via `body::after`

---

## Component Breakdown

### Card

`max-width: 460px`, centered with flexbox. Dark navy gradient background, 1px gold border at `18%` opacity. Entry animation: `fadeUp` — translate from `22px` below with `cubic-bezier(.22,.68,0,1.1)` easing. Four corner bracket accents using `::before` / `::after` on `.auth-card` and two additional `.corner-tr` / `.corner-bl` divs.

### Security Badge

Horizontal strip at the top of the card containing:
- **Pulsing green dot** — CSS `dot-pulse` animation on `opacity` and `scale`, 2s cycle
- **Scrolling ticker** — `translateX(60% → -100%)` over 18 seconds, repeating. Text reads: `ENCRYPTED CHANNEL ACTIVE · TLS 1.3 · AES-256-GCM · SECURE SESSION ESTABLISHED · NROTC SIS v2.0 · CSU–APARRI · ACCESS RESTRICTED`

### Anchor Crest

Three concentric ring divs with `ring-pulse` animation (scale + opacity, staggered delays of 0 / 0.25s / 0.5s) surround an inner face. SVG anchor inside the face includes:
- Chain ring (`circle`)
- Vertical shaft (`line`)
- Crossbar with knob caps (`line` + 2× `circle`)
- Two curved arms (`path`)
- Two flukes (`path`)

SVG rendered at `40×40px` with gold `drop-shadow` filter.

### Tabs

Two-button tab strip — **Sign In** and **Register** — with a `scaleX` animated 2px gold underline + glow on `.active::after`. `switchTab(tab)` manages active state on both buttons and panels simultaneously.

### Form Fields

All inputs share `.field-input` base styling: dark navy bg, gold border at 16% opacity, gold focus ring. Three variants:
- **With icon:** left-padded `2.35rem`, `.input-icon` absolute-positioned
- **No icon** (`.no-icon`): standard left padding `.8rem`
- **Select** (`.select-field`): custom SVG chevron via `background-image`, removes native appearance

`.field-error` spans are hidden by default (`display:none`) and shown by adding `.show`.

### Password Toggle

`.pw-toggle` button absolutely positioned right of any password input. Clicking calls `togglePw(inputId, btn)` which flips `input.type` between `password` / `text` and changes the button emoji between `👁` and `🙈`.

### Alerts

`.alert` elements hidden by default. `.show` class applies `display:flex`. Two subtypes:
- `.alert-success` — green left border, green text, green tinted background
- `.alert-error` — red left border, red text, red tinted background

---

## Forms

### Sign In

| Field        | Element  | Placeholder        | Validation           |
|--------------|----------|--------------------|----------------------|
| Cadet ID     | `text`   | `CDT-2024-001`     | Required, non-empty  |
| Password     | `password` | `Enter password` | Required, non-empty  |
| Remember me  | `checkbox` | —                | Optional             |

**Extras row:** "Keep me signed in" checkbox (left) + "FORGOT PASSWORD?" link (right).

**Submit button:** "ACCESS SYSTEM" — gold gradient, loads 1.8s spinner then shows `#login-ok` success alert.

**Forgot password:** `handleForgot(e)` prevents default, re-uses the `#login-ok` slot to show an email-sent confirmation message.

### Register

| Field          | Element    | Placeholder                  | Validation                        |
|----------------|------------|------------------------------|-----------------------------------|
| Full Name      | `text`     | `Last, First M.`             | Required, non-empty               |
| Cadet ID       | `text`     | `CDT-2024-001`               | Required, non-empty               |
| Email          | `email`    | `cadet@csuaparri.edu.ph`     | Required, regex `/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/` |
| Role           | `select`   | `— Select Role —`            | Required, must not be empty string|
| Password       | `password` | `Min 12 chars`               | Required, `length >= 12`          |
| Confirm PW     | `password` | `Repeat password`            | Must match Password field exactly |
| Acknowledge    | `checkbox` | —                            | Must be checked                   |

Name + Cadet ID share a `.row-2` grid. Password + Confirm share a second `.row-2` grid.

**Submit button:** "SUBMIT REQUEST" — 1.8s spinner then shows `#register-ok` success alert and `form.reset()` clears all fields.

---

## JavaScript Functions

All functions are IIFE-scoped (`(function(){ 'use strict'; ... }())`). The following are exposed on `window` for inline `onclick` handlers:

| Function                         | Description                                                                           |
|----------------------------------|---------------------------------------------------------------------------------------|
| `switchTab(tab)`                 | Activates correct `.tab-btn` and `.form-panel`, calls `clearAll()`                    |
| `togglePw(inputId, btn)`         | Flips input type between `password`/`text`, updates button emoji                      |
| `handleForgot(e)`                | Prevents default, shows email-sent message in the login success alert slot             |
| `handleLogin(e)`                 | Validates Cadet ID + Password; on success starts 1.8s loading → success alert         |
| `handleRegister(e)`              | Validates all register fields; on success starts 1.8s loading → success alert + reset |

### Internal helpers

| Function                                    | Description                                              |
|---------------------------------------------|----------------------------------------------------------|
| `markError(inputId, errId, msg?)`           | Adds `.is-error` to input, shows error span              |
| `clearError(inputId, errId)`                | Removes `.is-error`, hides error span                    |
| `clearAll()`                                | Clears all alerts, field errors, and error states        |
| `showAlert(id, cls, msg?)`                  | Sets alert class and optionally message, adds `.show`    |
| `setLoading(btnId, spinnerId, lblId, …)`    | Toggles button disabled + loading class + label text     |
| `emailValid(v)`                             | Returns `true` if value matches email regex              |

---

## Accessibility

- All inputs have `aria-required="true"` and `aria-describedby` pointing to their error span
- Error spans use `role="alert"` for screen reader announcements
- Submit alerts use `role="status"` (success) and `role="alert"` (error)
- Tabs use `role="tablist"`, `role="tab"`, `aria-selected`, and `aria-controls`
- Password toggle buttons have `aria-label`
- Decorative icons use `aria-hidden="true"`

---

## Usage

Open directly in a browser (no server required):

```
public/auth-prototype.html
```

Or via the Laravel dev server:

```
http://127.0.0.1:8000/auth-prototype.html
```

This file has no Laravel dependencies. All fonts require an internet connection (Google Fonts CDN). The form submissions are client-side only — no server requests are made.

---

## Integration Notes

When implementing this design within Laravel Blade:

1. Extract CSS into `resources/css/auth.css` or the existing `app.css`
2. Replace form `onsubmit` handlers with Livewire actions or standard form `action="/login"` POST requests
3. Add CSRF tokens (`@csrf`) to both forms
4. Replace `handleLogin` / `handleRegister` with Laravel Auth and Form Request validation
5. Use `@error` / `$errors->first()` directives for server-side field error rendering
6. Register routes in `routes/auth.php`

---

*Last updated: 2026-03-25*
