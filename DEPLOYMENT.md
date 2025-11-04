# Dokumentasi Deployment devonic.agency

## Overview
Website devonic.agency adalah aplikasi Laravel 12 dengan Filament Admin Panel yang di-deploy di VPS Ubuntu dengan Cloudflare sebagai CDN dan SSL provider.

---

## Server Specifications (Current - VPS)

**VPS Details:**
- OS: Ubuntu 24.04 LTS (Linux 6.8.0-85-generic)
- IP Address: 148.230.98.4
- Domain: devonic.agency
- Location: /var/www/devonic

**Stack:**
- PHP 8.3.6 + PHP-FPM
- MySQL 8.0
- Nginx
- Node.js 20.x + NPM
- Composer 2.8.12
- Laravel 12.34.0

---

## Table of Contents
1. [Installation Steps (VPS)](#installation-steps-vps)
2. [Nginx Configuration](#nginx-configuration)
3. [Cloudflare Setup](#cloudflare-setup)
4. [Migration to Shared/Dedicated Hosting](#migration-to-shareddedicated-hosting)
5. [Troubleshooting](#troubleshooting)
6. [Maintenance](#maintenance)

---

## Installation Steps (VPS)

### 1. Clone Repository
```bash
cd /var/www
git clone https://github.com/Lisvindanu/devonic
cd devonic
```

### 2. Install PHP & Extensions
```bash
apt update
apt install -y php8.3 php8.3-fpm php8.3-cli php8.3-common \
  php8.3-mysql php8.3-zip php8.3-gd php8.3-mbstring \
  php8.3-curl php8.3-xml php8.3-bcmath php8.3-sqlite3 php8.3-intl
```

### 3. Install Composer
```bash
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
```

### 4. Install Dependencies
```bash
cd /var/www/devonic
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader
npm install
npm run build
```

### 5. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

**Edit `.env` file:**
```env
APP_NAME=Devonic
APP_ENV=production
APP_KEY=base64:EE7wrI88ieS64egGTEJzwIjQMDiZ0df8oWCgoavGTl0=
APP_DEBUG=false
APP_URL=https://devonic.agency

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=devonic_db
DB_USERNAME=root
DB_PASSWORD=password

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=.devonic.agency
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

TRUSTED_PROXIES=*
```

### 6. Setup Database
```bash
mysql -u root -ppassword -e "CREATE DATABASE devonic_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan migrate --force
php artisan db:seed --force
```

### 7. Create Admin User
```bash
php artisan make:filament-user --name="Admin" --email="admin@devonic.agency" --password="password"
```

### 8. Set Permissions
```bash
chown -R www-data:www-data storage bootstrap/cache public
chmod -R 775 storage bootstrap/cache
php artisan storage:link
```

### 9. Optimize Laravel
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Nginx Configuration

**File:** `/etc/nginx/sites-available/devonic.agency`

```nginx
# HTTP - redirect to HTTPS
server {
    listen 80;
    server_name devonic.agency www.devonic.agency;
    return 301 https://$server_name$request_uri;
}

# HTTPS
server {
    listen 443 ssl http2;
    server_name devonic.agency www.devonic.agency;
    root /var/www/devonic/public;

    # Cloudflare Origin Certificate
    ssl_certificate /etc/ssl/cloudflare/devonic.agency.pem;
    ssl_certificate_key /etc/ssl/cloudflare/devonic.agency.key;

    # SSL Configuration
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;
    ssl_prefer_server_ciphers on;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

**Enable site:**
```bash
ln -s /etc/nginx/sites-available/devonic.agency /etc/nginx/sites-enabled/
nginx -t
systemctl reload nginx
```

**Enable auto-start:**
```bash
systemctl enable nginx php8.3-fpm mysql
```

---

## Cloudflare Setup

### 1. DNS Configuration
**Cloudflare Dashboard → DNS → Records:**

| Type | Name | Content | Proxy Status | TTL |
|------|------|---------|--------------|-----|
| A | @ | 148.230.98.4 | Proxied | Auto |
| A | www | 148.230.98.4 | Proxied | Auto |

**Nameservers:**
- sureena.ns.cloudflare.com
- tom.ns.cloudflare.com

### 2. SSL/TLS Configuration
**Cloudflare Dashboard → SSL/TLS:**
- Encryption Mode: **Full**

**Create Origin Certificate:**
1. Go to SSL/TLS → Origin Server
2. Click "Create Certificate"
3. Select RSA 2048, 15 years validity
4. Hostnames: `devonic.agency` and `*.devonic.agency`
5. Save certificates:
   - Origin Certificate → `/etc/ssl/cloudflare/devonic.agency.pem`
   - Private Key → `/etc/ssl/cloudflare/devonic.agency.key`

```bash
mkdir -p /etc/ssl/cloudflare
# Paste certificate content to /etc/ssl/cloudflare/devonic.agency.pem
# Paste private key to /etc/ssl/cloudflare/devonic.agency.key
chmod 600 /etc/ssl/cloudflare/devonic.agency.key
chmod 644 /etc/ssl/cloudflare/devonic.agency.pem
```

---

## Migration to Shared/Dedicated Hosting

### Prerequisites
- cPanel/Plesk hosting with SSH access
- PHP 8.1+ support
- MySQL 8.0+ database
- Composer installed or available
- Minimum 512MB RAM

### Step 1: Backup Data from VPS

#### 1.1 Export Database
```bash
# On VPS
cd /var/www/devonic
mysqldump -u root -ppassword devonic_db > devonic_db_backup.sql
```

#### 1.2 Backup Uploaded Files
```bash
# Backup storage folder (images, uploads)
cd /var/www/devonic
tar -czf devonic_storage.tar.gz storage/app/public
```

#### 1.3 Download Backups to Local
```bash
# From your local machine
scp root@148.230.98.4:/var/www/devonic/devonic_db_backup.sql .
scp root@148.230.98.4:/var/www/devonic/devonic_storage.tar.gz .
```

### Step 2: Setup on New Hosting

#### 2.1 Upload Files via cPanel/FTP
1. Login to cPanel File Manager
2. Navigate to `public_html` or your domain folder
3. Upload project files (via Git or ZIP upload)

**Option A: Using Git (Recommended)**
```bash
# SSH to new hosting
cd ~/public_html/devonic.agency
git clone https://github.com/Lisvindanu/devonic .
```

**Option B: Upload ZIP**
1. Download repo as ZIP from GitHub
2. Upload to cPanel File Manager
3. Extract ZIP file

#### 2.2 Install Dependencies
```bash
# SSH to hosting
cd ~/public_html/devonic.agency

# Install composer dependencies
composer install --no-dev --optimize-autoloader

# If composer not available, upload vendor folder from VPS
# Or ask hosting to install composer
```

#### 2.3 Build Assets
```bash
# If Node.js available on hosting
npm install
npm run build

# If not, upload pre-built assets from VPS:
# - public/build/
# - public/js/filament/
# - public/css/filament/
```

#### 2.4 Setup Database
1. Create MySQL database via cPanel → MySQL Databases
   - Database name: `cpanel_devonic_db`
   - Username: `cpanel_devonic_user`
   - Password: `[strong_password]`
   - Grant ALL privileges

2. Import database:
```bash
# Via SSH
mysql -u cpanel_devonic_user -p cpanel_devonic_db < devonic_db_backup.sql

# Or via cPanel phpMyAdmin:
# - Select database
# - Click Import
# - Upload devonic_db_backup.sql
```

#### 2.5 Configure Environment File
```bash
cd ~/public_html/devonic.agency
cp .env.example .env
nano .env
```

**Update `.env` for shared hosting:**
```env
APP_NAME=Devonic
APP_ENV=production
APP_KEY=base64:EE7wrI88ieS64egGTEJzwIjQMDiZ0df8oWCgoavGTl0=
APP_DEBUG=false
APP_URL=https://devonic.agency

# Update database credentials
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpanel_devonic_db
DB_USERNAME=cpanel_devonic_user
DB_PASSWORD=[your_database_password]

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=.devonic.agency
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

# Remove trusted proxies if not using Cloudflare
# Or keep if using Cloudflare
TRUSTED_PROXIES=*
```

#### 2.6 Restore Uploaded Files
```bash
# Upload devonic_storage.tar.gz to server
cd ~/public_html/devonic.agency
tar -xzf devonic_storage.tar.gz
```

#### 2.7 Set Permissions
```bash
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage/logs storage/framework

# Create symlink
php artisan storage:link
```

#### 2.8 Optimize Application
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 3: Update DNS

#### 3.1 Get New Hosting IP
```bash
# Find your new hosting IP
ping your-hosting-domain.com
```

#### 3.2 Update Cloudflare DNS
Go to Cloudflare Dashboard → DNS:
- Change A record `@` from `148.230.98.4` to new hosting IP
- Change A record `www` from `148.230.98.4` to new hosting IP
- Keep Proxy Status: **Proxied** (orange cloud)

#### 3.3 Wait for DNS Propagation
- Usually takes 5-30 minutes
- Check with: `nslookup devonic.agency 8.8.8.8`

### Step 4: Setup .htaccess (Shared Hosting)

**File:** `public_html/devonic.agency/public/.htaccess`

Most Laravel apps work with default `.htaccess`, but ensure it exists:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### Step 5: Configure Domain Root (cPanel)

1. Go to cPanel → Domains or Addon Domains
2. Set Document Root to: `public_html/devonic.agency/public`
3. Make sure domain points to `/public` folder, NOT root

### Step 6: SSL Certificate (Shared Hosting)

**Option A: Using Cloudflare (Current Setup)**
- Keep Cloudflare DNS Proxy enabled
- SSL/TLS mode: **Full**
- No changes needed on hosting

**Option B: Using cPanel AutoSSL/Let's Encrypt**
1. cPanel → SSL/TLS Status
2. Enable AutoSSL for devonic.agency
3. Change Cloudflare SSL mode to **Full (Strict)**

### Step 7: Testing

#### 7.1 Test Website
```bash
curl -I https://devonic.agency
```

Expected: `HTTP/2 200`

#### 7.2 Test Admin Panel
Visit: https://devonic.agency/admin/login
- Email: `admin@devonic.agency`
- Password: `password`

#### 7.3 Test Database Connection
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

#### 7.4 Check Logs
```bash
tail -f storage/logs/laravel.log
```

### Step 8: Cleanup Old VPS (Optional)

After confirming everything works on new hosting:

```bash
# On old VPS - backup one more time
mysqldump -u root -ppassword devonic_db > final_backup.sql
tar -czf devonic_final_backup.tar.gz /var/www/devonic

# Download backups
# Then you can decommission the VPS
```

---

## Common Issues & Solutions (Shared Hosting)

### Issue 1: "500 Internal Server Error"
**Solution:**
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check PHP version
php -v  # Must be 8.1+

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Fix permissions
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage/logs
```

### Issue 2: "Composer not found"
**Solution:**
```bash
# Option 1: Ask hosting provider to install composer
# Option 2: Use composer locally and upload vendor folder
# On your local machine:
composer install --no-dev
# Upload entire vendor/ folder via FTP
```

### Issue 3: "npm not available"
**Solution:**
```bash
# Build assets locally
npm install
npm run build

# Upload these folders to hosting:
# - public/build/
# - public/js/filament/
# - public/css/filament/
```

### Issue 4: "Database connection refused"
**Solution:**
```bash
# Check .env database credentials
# Shared hosting usually uses:
DB_HOST=localhost  # NOT 127.0.0.1
DB_DATABASE=cpanel_username_dbname
DB_USERNAME=cpanel_username_dbuser

# Test connection via PHP
php artisan tinker
>>> DB::connection()->getPdo();
```

### Issue 5: "Files not uploading"
**Solution:**
```bash
# Check PHP upload limits in cPanel → PHP Settings
upload_max_filesize = 64M
post_max_size = 64M

# Check storage permissions
chmod -R 777 storage/app/public
php artisan storage:link
```

### Issue 6: "Admin panel shows 403"
**Solution:**
```bash
# Check User.php canAccessPanel() method
# Make sure admin user exists
php artisan tinker
>>> App\Models\User::where('email', 'admin@devonic.agency')->first();
```

---

## Shared Hosting Limitations

**Be aware of:**
1. **PHP Execution Time**: Usually 30-60 seconds
2. **Memory Limit**: Often 128-256MB
3. **No SSH Access**: Some shared hosting lacks SSH
4. **No Root Access**: Can't install system packages
5. **Cron Jobs**: Limited to cPanel cron interface
6. **Queue Workers**: May not be supported

**Workarounds:**
- Use `sync` queue driver instead of `database`
- Optimize database queries
- Use CDN (Cloudflare) for assets
- Implement aggressive caching

---

## Performance Optimization (Shared Hosting)

### 1. Enable OPcache
```ini
; In cPanel PHP Settings or php.ini
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0
```

### 2. Laravel Optimizations
```bash
# Production optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Set production environment
APP_ENV=production
APP_DEBUG=false
```

### 3. Database Optimization
```bash
# Add indexes to frequently queried columns
# Optimize queries with eager loading
# Use query caching
```

### 4. Use Cloudflare Features
- Browser Cache TTL: 4 hours
- Auto Minify: CSS, JS, HTML
- Brotli compression
- Page Rules for caching

---

## Git Configuration

**Setup safe directory:**
```bash
git config --global --add safe.directory /path/to/devonic
```

**After git operations, restore permissions:**
```bash
chown -R www-data:www-data storage bootstrap/cache public  # VPS
# or
chmod -R 755 storage bootstrap/cache  # Shared hosting
```

---

## Deployment Workflow

### VPS Deployment
```bash
cd /var/www/devonic
git pull origin main
composer install --no-dev --optimize-autoloader
npm install && npm run build
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
chown -R www-data:www-data storage bootstrap/cache public
```

### Shared Hosting Deployment
```bash
cd ~/public_html/devonic.agency
git pull origin main
composer install --no-dev --optimize-autoloader
# Build assets locally and upload if npm not available
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 755 storage bootstrap/cache
```

---

## Admin Panel Access

**URL:** https://devonic.agency/admin/login

**Credentials:**
- Email: `admin@devonic.agency`
- Password: `password`

**Authorization:**
Only users with email `admin@devonic.agency` can access the admin panel (configured in `app/Models/User.php`).

---

## Troubleshooting

### Clear All Caches
```bash
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

### Check Logs
```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Nginx error logs (VPS only)
tail -f /var/log/nginx/error.log

# PHP-FPM logs (VPS only)
tail -f /var/log/php8.3-fpm.log
```

### Permission Issues
```bash
# VPS
chown -R www-data:www-data /var/www/devonic
chmod -R 755 /var/www/devonic
chmod -R 775 /var/www/devonic/storage /var/www/devonic/bootstrap/cache

# Shared Hosting
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage/logs storage/framework
```

### Database Connection Test
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

### Rebuild Assets
```bash
npm install
npm run build
php artisan view:clear
```

---

## Database Backup

### Manual Backup
```bash
# VPS
mysqldump -u root -ppassword devonic_db > devonic_backup_$(date +%Y%m%d).sql

# Shared Hosting (via SSH)
mysqldump -u cpanel_user -p cpanel_devonic_db > devonic_backup_$(date +%Y%m%d).sql

# Or use cPanel phpMyAdmin → Export
```

### Restore Backup
```bash
# VPS
mysql -u root -ppassword devonic_db < devonic_backup_YYYYMMDD.sql

# Shared Hosting
mysql -u cpanel_user -p cpanel_devonic_db < devonic_backup_YYYYMMDD.sql
```

### Automated Backup (cPanel)
1. cPanel → Backup Wizard
2. Schedule automatic backups
3. Download to local storage regularly

---

## Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] Strong database password
- [ ] `.env` file not accessible (outside public folder)
- [ ] Regular security updates
- [ ] SSL/HTTPS enabled
- [ ] Admin password changed from default
- [ ] File permissions set correctly
- [ ] Database backups automated
- [ ] Cloudflare security features enabled
- [ ] Access logs monitored

---

## Important Files & Locations

### VPS Setup
- **Application Root:** `/var/www/devonic`
- **Nginx Config:** `/etc/nginx/sites-available/devonic.agency`
- **SSL Certificates:** `/etc/ssl/cloudflare/`
- **PHP-FPM Config:** `/etc/php/8.3/fpm/`
- **Laravel Logs:** `/var/www/devonic/storage/logs/`
- **Environment:** `/var/www/devonic/.env`

### Shared Hosting Setup
- **Application Root:** `~/public_html/devonic.agency`
- **Document Root:** `~/public_html/devonic.agency/public`
- **Laravel Logs:** `~/public_html/devonic.agency/storage/logs/`
- **Environment:** `~/public_html/devonic.agency/.env`
- **Apache Config:** `.htaccess` in public folder

---

## Database Schema

**Main Tables:**
- `users` - User accounts
- `packages` - Service packages
- `services` - Service list
- `portfolios` - Portfolio items
- `portfolio_images` - Portfolio gallery
- `partners` - Partner logos
- `testimonials` - Client testimonials
- `about_contents` - About page content
- `team_members` - Team member profiles
- `contact_inquiries` - Contact form submissions
- `payment_confirmations` - Payment proof uploads
- `settings` - Site settings (key-value pairs)

---

## Useful Commands

```bash
# Restart services (VPS)
systemctl restart nginx php8.3-fpm mysql

# View service logs (VPS)
journalctl -u nginx -f
journalctl -u php8.3-fpm -f

# Check PHP version
php -v

# Check Laravel version
php artisan --version

# Create new admin user
php artisan make:filament-user

# Run seeders
php artisan db:seed --force

# Fresh migration (CAUTION: Deletes all data!)
php artisan migrate:fresh --force --seed

# Check disk usage (Shared hosting)
du -sh *

# Check database size
php artisan tinker
>>> DB::select('SELECT table_schema AS "Database", ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS "Size (MB)" FROM information_schema.TABLES GROUP BY table_schema');
```

---

## Monitoring

**Check website status:**
```bash
curl -I https://devonic.agency
```

**Expected response:**
```
HTTP/2 200
server: cloudflare
```

**Monitor uptime:**
- Use services like UptimeRobot, Pingdom, or StatusCake
- Set up alerts for downtime

---

## Support & Maintenance

**Regular Maintenance Tasks:**
1. **Daily**: Monitor error logs
2. **Weekly**: Check disk space and database size
3. **Monthly**: Backup database and files
4. **Monthly**: Update composer dependencies
5. **Quarterly**: Update PHP/Laravel version
6. **Quarterly**: Review and optimize database queries
7. **As needed**: Clear caches after updates

**Performance Monitoring:**
- Use Laravel Telescope (dev only) or Laravel Pulse
- Monitor response times via Cloudflare Analytics
- Check MySQL slow query log

**Contact:**
- Admin Email: admin@devonic.agency
- GitHub: https://github.com/Lisvindanu/devonic

---

## Changelog

### 2025-10-16 - Initial Deployment
- Deployed Laravel 12 application on VPS
- Configured Cloudflare SSL/TLS with Origin Certificate
- Setup MySQL database with initial schema
- Created admin user (admin@devonic.agency)
- Seeded initial data (packages, services, partners, testimonials, settings)
- Fixed package pricing display bug in frontend
- Configured Nginx with HTTPS redirect
- Enabled auto-start for critical services

---

**Last Updated:** 2025-10-16
**Version:** 1.0.0
**Environment:** Production (VPS) | Ready for Shared Hosting Migration
