# BGM Pro Sports

E-commerce / sports store platform built on **[Botble CMS](https://botble.io)** (Laravel 12, PHP 8.3+).

> This repository contains **application source code only** — no vendor dependencies,
> no uploaded media, no environment secrets. See [`DEPLOYMENT.md`](DEPLOYMENT.md) for setup.

## Requirements

| Dependency | Version |
|---|---|
| PHP | `^8.3` or `^8.4` |
| Extensions | `curl`, `gd`, `json`, `pdo`, `zip`, `mbstring`, `openssl` |
| Composer | 2.x |
| Database | MySQL 8+ / MariaDB / SQLite |
| Node.js (optional, for asset build) | 18+ |

## Quick start (local development)

```bash
git clone https://github.com/vishnupriyangamer003-rgb/bgmprosports.git
cd bgmprosports

# 1. PHP dependencies (creates main/vendor)
composer install --working-dir=main

# 2. Environment
copy main\.env.example main\.env        # Windows
cp main/.env.example main/.env          # Linux / macOS

# 3. Generate a FRESH application key (never reuse keys)
php main/artisan key:generate

# 4. Configure DB credentials in main/.env, then:
php main/artisan migrate --seed

# 5. Storage link (public path is the repo root)
php main/artisan storage:link

# 6. Optimise
php main/artisan optimize
```

Local site root: `http://localhost/vichu/bgm`

## Project layout

```
bgmprosports/
├── index.php            # Front controller (public path = repo root)
├── .htaccess            # Rewrites everything into public/
├── main/                # Laravel application
│   ├── app/             # Controllers, Models, Middleware
│   ├── config/          # Application configuration
│   ├── database/        # Migrations & seeders
│   ├── platform/        # Botble core + plugins (business logic)
│   ├── resources/       # Views, lang, compiled assets
│   ├── routes/          # Route definitions
│   ├── storage/         # Runtime only (cache/logs) — NOT in Git
│   ├── vendor/          # Composer deps — NOT in Git
│   └── .env             # Your secrets — NOT in Git
├── vendor/core/         # Published public assets (admin CSS/JS) — IN Git
├── themes/              # Storefront themes — IN Git
├── docs/                # API documentation (OpenAPI) — IN Git
└── storage/             # Uploaded media — NOT in Git (back up separately!)
```

## Version control workflow

```
develop → git commit → git push origin main → hosting git pull → deploy
```

See [`DEPLOYMENT.md`](DEPLOYMENT.md) for the full workflow, rollback strategy
and the media/database backup procedure.

## Security

- `.env`, `.env.*` (except `.env.example`) are git-ignored — **never commit secrets**
- `.env.example` contains placeholders only
- Uploaded media lives in `storage/` and is **not** stored in Git
- Report security issues privately to the repository owner
