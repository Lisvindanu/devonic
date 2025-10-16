# Devonic - Digital Agency Website

Website company profile untuk Devonic Digital Agency yang fokus pada layanan digital untuk kebutuhan akademis dan penelitian.

## Tech Stack

- **Laravel 12** - PHP Framework
- **Filament 3.3** - Admin Panel
- **Tailwind CSS v3** - Styling
- **MySQL** - Database
- **Vite** - Asset Bundler

## Features

- ✅ Multi-page website (Home, Services, Packages, Portfolio, About, Contact)
- ✅ Minimalist Black & White Design
- ✅ Admin Panel dengan Filament (Bahasa Indonesia)
- ✅ Service Management dengan detail pages
- ✅ Package Management
- ✅ Portfolio Management
- ✅ Partner/Client Management
- ✅ Testimonial Management
- ✅ Contact Form
- ✅ Payment Confirmation Form
- ✅ Fully Responsive Design

## Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL >= 8.0
- Git

## Installation

### 1. Clone Repository

```bash
git clone <repository-url> devonic
cd devonic
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy file `.env.example` ke `.env`:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=devonic
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Create Database

Buat database MySQL:

```bash
mysql -u root -p
```

```sql
CREATE DATABASE devonic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 6. Run Migrations

Jalankan migrasi untuk membuat tabel database:

```bash
php artisan migrate
```

### 7. Run Seeders

Isi database dengan data sample:

```bash
php artisan db:seed
```

Atau jalankan seeder spesifik:

```bash
php artisan db:seed --class=ServiceSeeder
php artisan db:seed --class=PackageSeeder
php artisan db:seed --class=PartnerSeeder
php artisan db:seed --class=TestimonialSeeder
php artisan db:seed --class=SettingSeeder
```

### 8. Create Storage Link

Buat symbolic link untuk storage:

```bash
php artisan storage:link
```

### 9. Create Admin User

Buat akun admin untuk Filament:

```bash
php artisan tinker
```

Kemudian jalankan:

```php
App\Models\User::create([
    'name' => 'Admin Devonic',
    'email' => 'admin@devonic.com',
    'password' => bcrypt('password'),
]);
exit
```

### 10. Build Assets

Build assets untuk production:

```bash
npm run build
```

### 11. Run Development Server

#### Option A: Untuk Development (dengan hot reload)

Terminal 1 - Laravel Server:
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Terminal 2 - Vite Dev Server:
```bash
npm run dev
```

#### Option B: Untuk Testing/Production

Hanya jalankan Laravel server (assets sudah di-build):
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

### 12. Access Application

- **Website**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin
  - Email: `admin@devonic.com`
  - Password: `password`

## Development

### Build Assets for Production

```bash
npm run build
```

### Watch Assets (Development)

```bash
npm run dev
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Run Tests

```bash
php artisan test
```

## Project Structure

```
devonic/
├── app/
│   ├── Filament/           # Filament Admin Resources
│   ├── Http/
│   │   └── Controllers/    # Web Controllers
│   ├── Models/             # Eloquent Models
│   └── Services/           # Business Logic
├── database/
│   ├── migrations/         # Database Migrations
│   └── seeders/            # Database Seeders
├── resources/
│   ├── css/                # Tailwind CSS
│   ├── js/                 # JavaScript
│   └── views/              # Blade Templates
├── routes/
│   └── web.php             # Web Routes
└── public/
    ├── assets/             # Static Assets (logos, images)
    └── storage/            # Uploaded Files
```

## Admin Panel Features

### Navigation Menu:
- **Dashboard** - Overview statistik
- **Layanan** - Service management dengan detail
- **Paket** - Package management dengan features
- **Portfolio** - Project showcase management
- **Klien** - Partner/client logo management
- **Testimoni** - Customer testimonials
- **Tentang Kami** - About content & team members
- **Kontak** - Contact inquiries dari form
- **Konfirmasi Pembayaran** - Payment confirmations
- **Pengaturan** - Site settings (company info, contact, social media)

## Database Schema

### Main Tables:
- `users` - Admin users
- `services` - Services/layanan
- `packages` - Package offerings
- `portfolios` - Project portfolio
- `partners` - Client/partner logos
- `testimonials` - Customer testimonials
- `about_contents` - About page content
- `team_members` - Team members
- `contact_inquiries` - Contact form submissions
- `payment_confirmations` - Payment proof submissions
- `settings` - Site configuration

## Troubleshooting

### Assets tidak muncul di mobile

Jika CSS tidak muncul saat akses dari mobile/device lain:

1. Stop Vite dev server
2. Build production assets: `npm run build`
3. Jalankan Laravel server dengan: `php artisan serve --host=0.0.0.0 --port=8000`
4. Akses dari mobile menggunakan IP laptop (bukan localhost)

### Permission Issues

Jika ada error permission untuk storage:

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Database Connection Error

Pastikan MySQL service running:

```bash
# macOS
brew services start mysql

# Linux
sudo systemctl start mysql

# Windows
# Start MySQL dari XAMPP/WAMP
```

## License

This project is proprietary software developed for Devonic Digital Agency.

## Support

Untuk support dan pertanyaan, hubungi:
- Email: admin@devonic.com
- WhatsApp: [Contact Number]
