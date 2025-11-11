# Ecommerce Backend (Laravel 12)

Backend for an e-commerce application built with Laravel 12 and Sanctum. This README covers setup, development, APIs, and production deployment.

## Features
- API token authentication with Sanctum.
- Product management with image upload to the public disk.
- Shopping cart via `user_product` pivot (with quantity).
- Orders with `product_order` pivot (quantity, price).
- About, Our Team, and Contact modules.
- Request validation using FormRequest classes.

## Tech Stack
- PHP 8.2+
- Laravel 12.x
- MySQL or SQLite
- Vite + TailwindCSS 4

## Requirements
- PHP 8.2+, Composer
- Node.js 18+, npm
- Database server (MySQL recommended for production)

## Local Setup (Development)
1) Copy environment file (if missing): `cp .env.example .env`
2) Install dependencies:
   - Backend: `composer install`
   - Frontend: `npm install`
3) Generate app key: `php artisan key:generate`
4) Configure database in `.env`, then run: `php artisan migrate`
5) Link storage for images: `php artisan storage:link`
6) Run the app:
   - Laravel server: `php artisan serve`
   - Vite dev server: `npm run dev`
   - Or combined dev script: `composer run dev`

Note: `.env.example` defaults to SQLite; use MySQL in production.

## Environment Variables (Essentials)
- APP_ENV, APP_DEBUG, APP_URL
- DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
- SESSION_DRIVER=database, QUEUE_CONNECTION=database, CACHE_STORE=database
- SANCTUM_STATEFUL_DOMAINS, SESSION_DOMAIN (if using SPA cookie flow)

## API Overview (Quick)
- Auth: `POST /api/register`, `POST /api/login`, `POST /api/logout` (Sanctum)
- Products: `GET /api/products`; Admin: `POST/PUT/DELETE /api/products`
- Cart (auth): `GET /api/cart`, `POST /api/cart/{productId}`, `PUT /api/cart/{productId}/quantity`, `DELETE /api/cart/{productId}`
- Orders (Admin): `GET/POST/PUT/DELETE /api/orders`
- About/OurTeam/Contact: see `routes/api.php`

Note: Admin routes are protected with `auth:sanctum` and `isAdmin` middleware.

## Production Deployment (Checklist)
- Configure `.env`:
  - `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://your-domain`
  - Database credentials and CORS as needed
- Optimize commands:
  - `composer install --no-dev --optimize-autoloader`
  - `php artisan migrate --force`
  - `php artisan storage:link`
  - `php artisan config:cache && php artisan route:cache && php artisan view:cache`
- Run queues as a service: `php artisan queue:work --daemon`
- Enforce HTTPS and security headers at the web server (Nginx/Apache).

## Security Notes
- Add rate limiting to sensitive routes (e.g., `/api/login`).
- Protect web admin routes with `auth` and preferably `isAdmin`.
- Do not commit real secrets; keep `.env` local and `.env.example` as a template.

## Troubleshooting
- Images not showing: ensure `php artisan storage:link` and use `storage/...` paths.
- 401/403 on admin routes: verify Sanctum token and user `role=admin`.
- Sessions/queue/cache issues: ensure tables exist and queue worker is running.

---

Below is the default Laravel README for reference.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
