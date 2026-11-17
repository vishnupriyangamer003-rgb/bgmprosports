# Backup & Restore — BGM Pro Sports

**GitHub is NOT a backup for media or data.** This repo stores code only.
Uploaded files, videos and database contents must be backed up separately.

> ⚠️ Backups contain user data and credentials. Store them **outside** the
> repository and **encrypt** them if they leave your server.

---

## What must be backed up

| Data | Location (this project) | In Git? |
|---|---|---|
| Uploaded images / videos / docs | `storage/` **(repo root)** | ❌ No |
| Laravel runtime uploads | `main/storage/app/` | ❌ No |
| Database (products, orders, users) | MySQL / `main/database/database.sqlite` | ❌ No |
| Environment secrets | `main/.env` | ❌ No Never |
| Application code | repo root | ✅ Yes |
| Theme assets | `themes/` | ✅ Yes |

> Note: the **public path is the repository root** (see `index.php`), so uploaded
> media resolves to `D:\xampp\htdocs\vichu\bgm\storage` (or `/var/www/.../storage`).

---

## 1. What to back up — checklist

- [ ] `storage/` — all product images, banners, payments, videos
- [ ] `main/storage/app/` — Laravel public disk
- [ ] Full database dump (MySQL or SQLite)
- [ ] `main/.env` — store in a password manager, **never** in Git
- [ ] `main/database/database.sqlite` if SQLite is used (currently empty, 0 B)

---

## 2. Backup commands — Windows (XAMPP)

Save as `backup.bat` **outside** the repository (e.g. `C:\backups\bgm\backup.bat`).

```bat
@echo off
set PROJECT=D:\xampp\htdocs\vichu\bgm
set DEST=D:\backups\bgm
set STAMP=%DATE:~10,4%-%DATE:~4,2%-%DATE:~7,2%_%TIME:~0,2%-%TIME:~3,2%
set STAMP=%STAMP: =0%

mkdir "%DEST%" 2>nul

echo [1/3] Backing up media...
powershell -Command "Compress-Archive -Force -Path '%PROJECT%\storage' -DestinationPath '%DEST%\media_%STAMP%.zip'"

echo [2/3] Backing up database...
"C:\xampp\mysql\bin\mysqldump.exe" -u root --single-transaction --routines --triggers bgmprosports > "%DEST%\db_%STAMP%.sql"

echo [3/3] Backing up environment (keep private!)...
copy /Y "%PROJECT%\main\.env" "%DEST%\env_%STAMP%.env" >nul

echo Done: %DEST%
```

Run:

```cmd
C:\backups\bgm\backup.bat
```

### Windows — restore

```powershell
# Media
Expand-Archive -Force -Path D:\backups\bgm\media_YYYY-MM-DD.zip -DestinationPath D:\xampp\htdocs\vichu\bgm

# Database
C:\xampp\mysql\bin\mysql.exe -u root bgmprosports < D:\backups\bgm\db_YYYY-MM-DD.sql

# Environment (inspect before copying!)
copy /Y D:\backups\bgm\env_YYYY-MM-DD.env D:\xampp\htdocs\vichu\bgm\main\.env
```

---

## 3. Backup commands — Linux (bash)

Save as `backup.sh` **outside** the repository (e.g. `/usr/local/bin/bgm-backup.sh`).

```bash
#!/usr/bin/env bash
set -euo pipefail

PROJECT="/var/www/bgmprosports"
DEST="/var/backups/bgm"
STAMP="$(date +%Y-%m-%d_%H-%M-%S)"
DB_USER="bgmprosports"
DB_NAME="bgmprosports"

mkdir -p "$DEST"

echo "[1/3] Backing up media..."
tar -czf "$DEST/media_${STAMP}.tar.gz" -C "$PROJECT" storage

echo "[2/3] Backing up database..."
mysqldump -u "$DB_USER" -p --single-transaction --routines --triggers \
  "$DB_NAME" > "$DEST/db_${STAMP}.sql"
gzip -f "$DEST/db_${STAMP}.sql"

echo "[3/3] Backing up environment..."
cp "$PROJECT/main/.env" "$DEST/env_${STAMP}.env"
chmod 600 "$DEST/env_${STAMP}.env"

# Retention: keep last 14 days
find "$DEST" -type f -mtime +14 -delete

echo "Done: $DEST"
chmod 700 "$DEST"
```

```bash
sudo chmod +x /usr/local/bin/bgm-backup.sh
sudo /usr/local/bin/bgm-backup.sh
```

Schedule daily at 02:00:

```bash
sudo crontab -e
# 0 2 * * * /usr/local/bin/bgm-backup.sh >> /var/log/bgm-backup.log 2>&1
```

### Linux — restore

```bash
# Media
tar -xzf /var/backups/bgm/media_YYYY-MM-DD.tar.gz -C /var/www/bgmprosports

# Database
gunzip -c /var/backups/bgm/db_YYYY-MM-DD.sql.gz | mysql -u bgmprosports -p bgmprosports

# Environment
sudo cp /var/backups/bgm/env_YYYY-MM-DD.env /var/www/bgmprosports/main/.env
sudo chown www-data:www-data /var/www/bgmprosports/main/.env
sudo chmod 640 /var/www/bgmprosports/main/.env
```

---

## 4. SQLite (if used)

```bash
# Backup
sqlite3 main/database/database.sqlite ".backup '/var/backups/bgm/db_$(date +%F).sqlite'"

# Restore (site must be in maintenance mode)
php main/artisan down
cp /var/backups/bgm/db_YYYY-MM-DD.sqlite main/database/database.sqlite
chown www-data:www-data main/database/database.sqlite
php main/artisan up
```

---

## 5. Recommended backup targets

| Target | Media | DB | Secrets | Cost |
|---|---|---|---|---|
| External HDD / NAS (local) | ✅ | ✅ | ✅ | One-off |
| Object storage — Backblaze B2 / Wasabi | ✅ | ✅ | ✅ | Cheap, offsite |
| AWS S3 + Glacier | ✅ | ✅ | ✅ | Cheap, long-term |
| Encrypted cloud drive | ✅ | ✅ | ✅ | Varies |
| **GitHub (this repo)** | ❌ | ❌ | ❌ | — code only |

**3-2-1 rule:** 3 copies, 2 different media, 1 offsite.

---

## 6. Restore drill (test quarterly)

1. Spin up a clean machine / fresh clone
2. `composer install --working-dir=main --no-dev --optimize-autoloader`
3. Restore `.env` → `php main/artisan key:generate` **only if key is lost**
4. Restore database dump
5. Restore `storage/` media
6. `php main/artisan storage:link && php main/artisan optimize`
7. Verify: homepage, product images, admin login, checkout

> A backup that has never been restored is not a backup.

---

## 7. Security notes

- **Never** commit `storage/` backups, `.sql` dumps, or `.env` to Git — all are git-ignored here.
- Restrict backup directory permissions: `chmod 700`.
- Encrypt offsite copies: `tar -czf - ... | gpg --symmetric --cipher-algo AES256`.
- Rotate the production database password periodically — it currently exists in
  plaintext in `main/.env.production.bak`; **move that file out of the project**
  and change the password.
