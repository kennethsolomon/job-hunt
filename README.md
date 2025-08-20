# Job Hunt CRM 📝💼

> Track your job applications, schedule follow-ups, and learn what works — built with **Laravel 12**, **Vue 3 (Inertia.js)**, and **FilamentPHP 4**.

---

## 🚀 Overview

**Job Hunt CRM** is a simple SaaS-style web app that helps job seekers manage their applications like a sales pipeline:

- Log companies, job descriptions, statuses, salaries, and interview details.
- Track KPIs: how many applied today, replies, interviews, success rate.
- Never miss a follow-up — tasks auto-generate when it’s time to nudge.
- Visualize your hunt with a dashboard & calendar.
- Export/import applications with CSV.

Designed as a personal CRM for your job search.  
MVP focuses on **clarity + speed**, with Pro features (calendar grid, follow-up engine, subscription billing) built on top.

---

## 🛠️ Tech Stack

- **Backend:** [Laravel 12](https://laravel.com)
- **Frontend (Landing):** Vue 3 + Inertia.js + TailwindCSS
- **Admin Panel (CRM):** [FilamentPHP 4](https://filamentphp.com)
- **Database:** MySQL (or Postgres, SQLite for local dev)
- **Auth:** Laravel Breeze (Inertia stack)
- **Billing (Pro):** Stripe (via Laravel Cashier)

---

## 📦 Features (MVP)

### Core
- Applications CRUD (company, role, description, status, salary, tags).
- Companies & contacts.
- Activities timeline (notes, status changes, calls/emails).
- Interviews & tasks (due/completed).
- Tags for quick categorization.
- CSV import/export.

### Dashboard
- Daily KPIs: Applied, Replied, Interviews.
- Funnel by status.
- Applied per day (14-day chart).
- Success rate analytics.

### Productivity
- Auto follow-up task creation (via scheduler).
- Calendar list (tasks + interviews upcoming 30 days).
- Pro upgrade: Calendar grid (drag & drop, FullCalendar).
