# Deploy to Plesk

## 1. Создать MySQL базу в Plesk

В Plesk → **Databases** → **Add Database**:

- **Database name:** `kb_backend` (любое)
- **User:** новый пользователь
- **Password:** сгенерировать сложный

Запомнить эти данные — понадобятся в `.env`.

## 2. Залить код в document root

Через FTP/SFTP/Git залить **содержимое** `kb-backend/` (не папку — её содержимое) в:

```
/var/www/vhosts/h-141839.kz/zh-photpgraphy.asia/
```

Так что в результате на сервере:

```
/var/www/vhosts/.../zh-photpgraphy.asia/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/      ← это новый document root
├── resources/
├── routes/
├── storage/
├── vendor/      ← если нет SSH, залейте локально: composer install --no-dev --optimize-autoloader
└── .env         ← создать вручную (см. шаг 3)
```

**В Plesk → Hosting Settings:**
- Document Root: `zh-photpgraphy.asia/public` (вместо просто `public`)

## 3. Создать .env на сервере

Скопировать `.env.example` → `.env` и заполнить:

```ini
APP_NAME="Backend Knowledge Base"
APP_ENV=production
APP_KEY=                    # сгенерируется на шаге 4
APP_DEBUG=false
APP_URL=https://zh-photgraphy.asia

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=p-XXXXXX_kb_backend    # из шага 1
DB_USERNAME=p-XXXXXX_kb_backend    # из шага 1
DB_PASSWORD=<пароль>               # из шага 1

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=local
LOG_CHANNEL=stack
LOG_LEVEL=warning
```

## 4. Генерация APP_KEY и кеширование

Если есть SSH:

```bash
cd /var/www/vhosts/.../zh-photpgraphy.asia
php artisan key:generate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Если SSH нет — сгенерировать ключ локально:

```bash
php -r "echo 'base64:'.base64_encode(random_bytes(32)).PHP_EOL;"
```

И вставить в `APP_KEY=` в `.env` на сервере.

## 5. Импорт MySQL дампа

Открыть в Plesk → **Databases** → выбрать БД → **phpMyAdmin** → **Import** → загрузить файл [`docs/kb_export.sql`](kb_export.sql).

Дамп содержит:
- 12 таблиц Laravel (users, sessions, cache, jobs, modules, topics, study_sessions, etc.)
- 14 публичных KB-модулей в `modules`
- Без приватных разделов (SSO, MegaRega, Career — не в дампе)

## 6. Права доступа к storage/

```bash
chmod -R 775 storage bootstrap/cache
chown -R psacln:psacln storage bootstrap/cache
```

(Если SSH нет — выставить в Plesk File Manager: storage/ должна быть writable web-сервером.)

## 7. Проверка

Открыть `https://zh-photgraphy.asia` — должна загрузиться главная KB-хаба с 14 модулями.

## Откат

Если что-то пошло не так:
- Локальный бэкап старого `nokk.717` лежит в проекте (вне git) в `../zh-backup/`:
  - `full-public-backup/` (20 МБ, включая uploads/works/cutouts)
  - `api-laravel-backup/` (3.5 МБ, без vendor/)
  - `public_.htaccess`, `public_index.html`, `api_laravel.env` (критичные конфиги)
- Чтобы восстановить — залить обратно через FTP.

## Что НЕ деплоить (private, в .gitignore)

- `resources/views/kb/KB_7_SSO.blade.php`
- `resources/views/kb/KB_8_MegaRega.blade.php`
- `resources/views/kb/KB_15_Career_Paths.blade.php`
- `database/seeders/KbPagesSeederPrivate.php`
- `.env` локальная (с APP_KEY локалки и `DB_CONNECTION=sqlite`)
- `database/database.sqlite`
