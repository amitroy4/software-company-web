# Software Company Website

A modern Laravel platform for a software company website, combining marketing pages, content management, AI-assisted visitor support, and admin operations in one system.

## Contents

- Overview
- Highlights
- Technology Stack
- System Modules
- Quick Start
- Environment Configuration
- AI Assistant Configuration
- Production Deployment
- Security Best Practices
- Common Commands
- Project Structure
- License

## Overview

This repository powers a complete business website with:

- dynamic public-facing pages (services, products, blogs, gallery, careers)
- an AI website assistant for user queries and guided contact capture
- a centralized admin panel for content and operational workflows
- message triage tools with unread/read visibility and notifications

## Highlights

- Dynamic hero/content sections managed from admin
- Chat-assisted contact flow (name, email, subject, description, confirmation)
- Professional admin dashboard with live KPIs
- Contact message workflow with status transitions and detail view
- Topbar notification integration for unread messages
- Search and navigation optimized for common business content

## Technology Stack

- Backend: Laravel (PHP)
- Frontend: Blade, Bootstrap, jQuery, Owl Carousel
- Build: Vite, Node.js, NPM
- Database: MySQL / MariaDB
- AI Integration: OpenAI API

## System Modules

### Public Website

- Home page with slider, service cards, applications, clients, testimonials, and blogs
- Service list/details
- Product showcase and gallery
- Blog and career pages
- Contact and global search

### AI Assistant

- Handles general user queries
- Converts URLs in responses to clickable links
- Supports guided contact submission from chat

### Admin Panel

- Dashboard metrics and activity snapshots
- Content management for services, blogs, products, sliders, careers, team, settings
- Contact message management across all, unread, and read states
- Notification dropdown linked to message details

## Quick Start

1. Clone repository

```bash
git clone https://github.com/<your-username>/software-company-web.git
cd software-company-web
```

2. Install dependencies

```bash
composer install
npm install
```

3. Prepare environment

```bash
cp .env.example .env
php artisan key:generate
```

PowerShell equivalent:

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

4. Configure database values in `.env`

- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

5. Run migrations

```bash
php artisan migrate
```

6. Build assets and run app

```bash
npm run dev
php artisan serve
```

## Environment Configuration

Minimum required application settings:

```env
APP_NAME="Software Company Website"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

Database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## AI Assistant Configuration

Set the following in `.env`:

```env
OPENAI_API_KEY=your_openai_api_key
OPENAI_MODEL=gpt-4o
```

The values are consumed via Laravel service configuration in `config/services.php`.

## Production Deployment

Recommended sequence:

1. Install dependencies with optimized autoload

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
```

2. Run migrations

```bash
php artisan migrate --force
```

3. Optimize framework caches

```bash
php artisan optimize
```

4. Ensure web server points to `public/` and storage is writable

## Security Best Practices

- Never commit `.env` or real credentials.
- Rotate keys immediately if exposed.
- Keep `APP_DEBUG=false` in production.
- Restrict admin access and use strong passwords.
- Use HTTPS in production.

## Common Commands

```bash
# clear framework caches
php artisan optimize:clear

# run local server
php artisan serve

# run tests
php artisan test
```

## Project Structure

```text
app/
  Http/Controllers/
  Models/
config/
database/
public/
resources/
  views/
routes/
storage/
```

## License

This project is private/proprietary unless explicitly published with an open-source license.

