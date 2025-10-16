# Database Schema - Devonic Folkin Enter

## 1. Users Table
**Purpose**: Admin/user management untuk login ke admin panel

```
users
├── id (PK)
├── name
├── email (unique)
├── email_verified_at
├── password
├── remember_token
├── created_at
├── updated_at
```

---

## 2. Services Table
**Purpose**: Menyimpan layanan yang ditawarkan agency

```
services
├── id (PK)
├── name (string) - ex: "Social Media Management"
├── slug (string, unique) - ex: "social-media-management"
├── description (text) - deskripsi layanan
├── icon (string, nullable) - icon/image untuk service
├── is_active (boolean, default: true)
├── is_featured (boolean, default: false) - untuk tampil di landing (3 services)
├── order (integer, default: 0) - untuk sorting display
├── created_at
├── updated_at
```

**Sample Data:**
- Social Media Management
- Social Media Marketing
- Website Development
- Coaching Clinic
- Live Shopping
- Digital Marketing
- App Development

---

## 3. Packages Table
**Purpose**: Menyimpan paket pricing (Beasiswa S1, S2, S3)

```
packages
├── id (PK)
├── name (string) - ex: "Paket Uang Saku 1"
├── slug (string, unique)
├── icon (string, nullable) - icon/image untuk paket
├── category (enum) - 's1', 's2', 's3', 'donation'
├── price_min (integer) - harga minimum (dalam rupiah)
├── price_max (integer, nullable) - harga maksimum (untuk range)
├── description (text) - deskripsi paket
├── features (json) - array of features
│   └── ["12 Konten/Bulan", "Target 1 Penerima Manfaat"]
├── target_beneficiaries (integer, nullable) - jumlah mahasiswa yang dibantu
├── service_type (string, nullable) - jenis layanan yang didapat
├── is_active (boolean, default: true)
├── is_featured (boolean, default: false) - untuk highlight paket
├── order (integer, default: 0)
├── created_at
├── updated_at
```

**Categories:**
- s1: Paket Beasiswa S1 (Uang Saku)
- s2-s3: Paket Beasiswa S2 & S3 (Tabungan/Lanjutan)
- custom: Custom Project
- donation: Donasi Seikhlasnya

---

## 4. Portfolio Table
**Purpose**: Showcase project/portfolio agency

```
portfolios
├── id (PK)
├── title (string) - judul project
├── slug (string, unique)
├── client_name (string, nullable) - nama client
├── service_id (FK to services, nullable) - kategori layanan
├── description (text) - deskripsi project
├── challenge (text, nullable) - challenge yang dihadapi
├── solution (text, nullable) - solusi yang diberikan
├── result (text, nullable) - hasil/impact
├── project_url (string, nullable) - link ke project (jika ada)
├── thumbnail (string) - main image
├── completed_at (date, nullable) - tanggal selesai project
├── is_featured (boolean, default: false)
├── is_published (boolean, default: true)
├── order (integer, default: 0)
├── created_at
├── updated_at
```

---

## 5. Portfolio Images Table
**Purpose**: Multiple images untuk setiap portfolio (gallery)

```
portfolio_images
├── id (PK)
├── portfolio_id (FK to portfolios)
├── image_path (string)
├── caption (string, nullable)
├── order (integer, default: 0)
├── created_at
├── updated_at
```

**Relationship**:
- portfolios hasMany portfolio_images

---

## 6. Partners Table
**Purpose**: Logo mitra/donatur/client

```
partners
├── id (PK)
├── name (string) - ex: "Angelic", "MEART"
├── logo (string) - path to logo image
├── website_url (string, nullable)
├── type (enum) - 'client', 'partner', 'donor'
├── is_active (boolean, default: true)
├── order (integer, default: 0)
├── created_at
├── updated_at
```

**Types:**
- client: Client yang pernah pakai jasa
- partner: Partner bisnis
- donor: Donatur beasiswa

---

## 7. Testimonials Table
**Purpose**: Testimoni dari client/mahasiswa

```
testimonials
├── id (PK)
├── name (string) - nama pemberi testimoni
├── role (string, nullable) - ex: "CEO at Angelic", "Mahasiswa S1"
├── avatar (string, nullable) - foto orang
├── content (text) - isi testimoni
├── rating (integer, nullable) - 1-5 stars
├── company (string, nullable) - nama perusahaan
├── type (enum) - 'client', 'student'
├── is_featured (boolean, default: false)
├── is_published (boolean, default: true)
├── order (integer, default: 0)
├── created_at
├── updated_at
```

**Types:**
- client: Testimoni dari client
- student: Testimoni dari mahasiswa yang terbantu

---

## 8. Contact Inquiries Table
**Purpose**: Menyimpan form contact dari website

```
contact_inquiries
├── id (PK)
├── name (string)
├── email (string)
├── phone (string, nullable)
├── company (string, nullable)
├── service_id (FK to services, nullable) - layanan yang diminati
├── package_id (FK to packages, nullable) - paket yang diminati
├── message (text)
├── status (enum) - 'new', 'in_progress', 'completed', 'spam'
├── notes (text, nullable) - catatan admin
├── is_read (boolean, default: false)
├── created_at
├── updated_at
```

**Status:**
- new: Baru masuk
- in_progress: Sedang difollow up
- completed: Sudah selesai
- spam: Spam

---

## 9. Payment Confirmations Table
**Purpose**: Menyimpan konfirmasi pembayaran/donasi manual

```
payment_confirmations
├── id (PK)
├── name (string) - nama pengirim
├── email (string)
├── phone (string, nullable)
├── package_id (FK to packages, nullable) - paket yang dipilih
├── amount (integer) - nominal transfer (rupiah)
├── transfer_date (date) - tanggal transfer
├── transfer_time (time, nullable) - waktu transfer
├── bank_account (string, nullable) - rekening tujuan
├── sender_bank (string, nullable) - bank pengirim
├── sender_account_name (string, nullable) - nama rekening pengirim
├── proof_image (string) - bukti transfer (upload)
├── message (text, nullable) - pesan dari donatur
├── status (enum) - 'pending', 'verified', 'rejected'
├── verified_by (FK to users, nullable) - admin yang verifikasi
├── verified_at (datetime, nullable)
├── admin_notes (text, nullable) - catatan admin
├── created_at
├── updated_at
```

**Status:**
- pending: Menunggu verifikasi
- verified: Sudah diverifikasi admin
- rejected: Ditolak (mungkin bukti tidak valid)

---

## 10. Settings Table
**Purpose**: Menyimpan konfigurasi website (nomor rekening, kontak, dll)

```
settings
├── id (PK)
├── key (string, unique) - ex: "bank_account_number"
├── value (text) - nilai setting
├── type (enum) - 'text', 'textarea', 'number', 'boolean', 'json'
├── group (string) - ex: "payment", "contact", "general"
├── label (string) - label untuk admin
├── description (text, nullable) - deskripsi setting
├── created_at
├── updated_at
```

**Sample Settings:**
```json
{
  "bank_name": "Bank BCA",
  "bank_account_number": "1234567890",
  "bank_account_name": "Devonic Folkin Enter",
  "whatsapp_number": "+6282219313600",
  "whatsapp_number_2": "+6289693203080",
  "email_contact": "contact@devonic.id",
  "instagram_url": "https://instagram.com/devonic",
  "facebook_url": "",
  "linkedin_url": "",
  "site_title": "Devonic Folkin Enter",
  "site_description": "Agency untuk Pendidikan dan Kesejahteraan",
  "total_students_helped": 0,
  "total_funds_distributed": 0,
  "total_projects_completed": 0
}
```

---

## 11. About Contents Table
**Purpose**: Menyimpan konten About/Prinsip/Program (untuk editable content) - WAJIB

```
about_contents
├── id (PK)
├── section (enum) - 'about', 'principles', 'programs'
├── title (string)
├── subtitle (string, nullable)
├── content (text)
├── icon (string, nullable) - untuk prinsip inti
├── image (string, nullable)
├── order (integer, default: 0)
├── is_active (boolean, default: true)
├── created_at
├── updated_at
```

**Sections:**
- about: Section "Latar Belakang Agency DVC"
- principles: Section "Prinsip Inti" (Agent of Change, dll) - 5 items
- programs: Section "Program DVC" (Leadership, Entrepreneurship, dll)

---

## 12. Team Members Table
**Purpose**: Menyimpan data orang-orang di balik Devonic (Tim Kreatif)

```
team_members
├── id (PK)
├── name (string) - nama anggota
├── role (string) - ex: "Creative Director", "Social Media Specialist"
├── type (enum) - 'core', 'freelancer'
├── photo (string, nullable) - foto anggota
├── bio (text, nullable) - bio singkat
├── email (string, nullable)
├── phone (string, nullable)
├── linkedin_url (string, nullable)
├── instagram_url (string, nullable)
├── portfolio_url (string, nullable)
├── is_active (boolean, default: true)
├── is_featured (boolean, default: false) - untuk tampil di halaman utama
├── order (integer, default: 0)
├── created_at
├── updated_at
```

**Types:**
- core: Tim Kreatif Inti (10 orang)
- freelancer: Tim Kreatif Freelancer (50 orang)

**Note**:
- Viko Hanafi & Bismantoro Saputra bisa masuk sebagai featured team members
- is_featured untuk showcase di About page

---

## Relationships Summary

```
services
└── hasMany portfolios
└── hasMany contact_inquiries

packages
└── hasMany contact_inquiries
└── hasMany payment_confirmations

portfolios
└── belongsTo services
└── hasMany portfolio_images

portfolio_images
└── belongsTo portfolios

contact_inquiries
└── belongsTo services
└── belongsTo packages

payment_confirmations
└── belongsTo packages
└── belongsTo users (verified_by)

users
└── hasMany payment_confirmations (verified)
```

---

## Indexes & Performance

**Indexes yang dibutuhkan:**
```sql
-- Services
INDEX idx_services_slug (slug)
INDEX idx_services_active (is_active)

-- Packages
INDEX idx_packages_slug (slug)
INDEX idx_packages_category (category)
INDEX idx_packages_active (is_active)

-- Portfolios
INDEX idx_portfolios_slug (slug)
INDEX idx_portfolios_service (service_id)
INDEX idx_portfolios_published (is_published)
INDEX idx_portfolios_featured (is_featured)

-- Partners
INDEX idx_partners_type (type)
INDEX idx_partners_active (is_active)

-- Testimonials
INDEX idx_testimonials_type (type)
INDEX idx_testimonials_published (is_published)

-- Contact Inquiries
INDEX idx_contact_status (status)
INDEX idx_contact_read (is_read)
INDEX idx_contact_created (created_at)

-- Payment Confirmations
INDEX idx_payment_status (status)
INDEX idx_payment_created (created_at)

-- Settings
INDEX idx_settings_key (key)
INDEX idx_settings_group (group)

-- Team Members
INDEX idx_team_type (type)
INDEX idx_team_active (is_active)
INDEX idx_team_featured (is_featured)
```

---

## Total Tables: 12

1. users ✓
2. services ✓
3. packages ✓
4. portfolios ✓
5. portfolio_images ✓
6. partners ✓
7. testimonials ✓
8. contact_inquiries ✓
9. payment_confirmations ✓
10. settings ✓
11. about_contents ✓ (WAJIB)
12. team_members ✓ (BARU)

---

## Notes

- Semua harga dalam **integer (rupiah)** - jangan pakai float
- Upload files pakai **Laravel Media Library** atau simpan path di string
- Timestamps (created_at, updated_at) otomatis by Laravel
- Soft deletes bisa ditambah kalau perlu (deleted_at)
- Semua order field untuk custom sorting di admin
- Boolean fields untuk toggle active/inactive
- Slug fields untuk SEO-friendly URLs
