# Pages & Structure - Devonic Folkin Enter
## Tema: Minimalis, Simple, Bermakna (Hitam-Putih)
## Inspired by: humanmade.co.jp - Sectional breaks, generous white space, subtle interactions

---

## APPROACH BARU

**Landing Page**: Fokus ke **point of sell** (Hero, Value Prop, CTA)
**Separate Pages**: Detail content (About, Portfolio, Services, Pricing)
**Navigation**: Clear flow antar halaman

---

## HALAMAN UTAMA

### 1. Landing Page (/)
**Konsep**: Focused landing dengan clear value proposition & strong CTAs
**Bukan long scroll** - Hanya essentials untuk convert visitor

#### Section 1: Hero (Full Viewport)
**Style**: Centered, bold typography, generous white space
```
┌─────────────────────────────────────┐
│                                     │
│                                     │
│       Devonic Folkin Enter         │
│  Untuk Pendidikan dan Kesejahteraan│
│                                     │
│   Setiap kerja sama adalah         │
│   investasi untuk pendidikan       │
│   Indonesia                        │
│                                     │
│  [Lihat Layanan]  [Konsultasi]     │
│                                     │
│                                     │
└─────────────────────────────────────┘
```

**Elemen:**
- Bold headline
- Short value proposition (1 kalimat)
- 2 CTA buttons
- Minimal, lots of white space
- Subtle parallax background (optional)

---

#### Section 2: Value Proposition (Half Viewport)
**Style**: Split screen - Image/Visual + Text

```
┌─────────────────────────────────────┐
│                                     │
│  [IMAGE]          Agency profesional│
│                   dengan misi sosial│
│                                     │
│                   Dana langsung untuk│
│                   mahasiswa         │
│                                     │
│                   [Tentang Kami →]  │
│                                     │
└─────────────────────────────────────┘
```

**Elemen:**
- Key benefit points (2-3 bullets)
- Link ke About page
- Strong visual (foto mahasiswa atau team)

---

#### Section 3: Featured Services (Half Viewport)
**Style**: Grid 3 kolom, minimal

```
┌─────────────────────────────────────┐
│        Layanan Kami                │
│                                     │
│  [Icon]    [Icon]    [Icon]        │
│  Social    Website   Digital       │
│  Media     Dev       Marketing     │
│                                     │
│         [Lihat Semua →]            │
│                                     │
└─────────────────────────────────────┘
```

**Elemen:**
- 3 featured services
- Icon + title only
- Link ke Services page

---

#### Section 4: Stats Impact (Quarter Viewport)
**Style**: Horizontal, inline

```
┌─────────────────────────────────────┐
│                                     │
│  50+ Projects  •  20+ Mahasiswa  •  10Jt+ Dana│
│                                     │
└─────────────────────────────────────┘
```

**Elemen:**
- Inline stats dengan separator
- Counter animation
- Minimal, clean

---

#### Section 5: Featured Portfolio (Half Viewport)
**Style**: Grid 2x2 atau slider

```
┌─────────────────────────────────────┐
│                                     │
│   ┌──────┐  ┌──────┐               │
│   │ Img  │  │ Img  │               │
│   └──────┘  └──────┘               │
│   ┌──────┐  ┌──────┐               │
│   │ Img  │  │ Img  │               │
│   └──────┘  └──────┘               │
│                                     │
│        [Lihat Portfolio →]         │
│                                     │
└─────────────────────────────────────┘
```

**Elemen:**
- 4 featured projects
- Hover: client name reveal
- Link ke Portfolio page

---

#### Section 6: Call to Action (Half Viewport)
**Style**: Centered, strong CTA

```
┌─────────────────────────────────────┐
│                                     │
│     Siap Berkontribusi?            │
│                                     │
│  Pilih paket yang sesuai dengan    │
│  kemampuan Anda                    │
│                                     │
│       [Lihat Paket & Harga]        │
│                                     │
└─────────────────────────────────────┘
```

**Elemen:**
- Headline persuasif
- Short text
- Big CTA button → Pricing page

---

#### Section 7: Footer
**Style**: Minimal footer dengan navigation

```
┌─────────────────────────────────────┐
│                                     │
│  Devonic Folkin Enter              │
│                                     │
│  About | Services | Portfolio | Pricing│
│                                     │
│  Contact: +62 822-xxx              │
│                                     │
│  © 2025 Devonic                    │
│                                     │
└─────────────────────────────────────┘
```

**Elemen:**
- Logo/brand name
- Navigation links
- Contact info
- Copyright

**TOTAL LANDING PAGE: 7 SECTIONS** (bukan 11, lebih focused!)

---

## HALAMAN TAMBAHAN

### 2. About Page (/about)
**Detail lengkap tentang Devonic**

**Sections:**
1. **Hero**: Tentang Devonic
2. **Latar Belakang Lengkap**: Story lengkap
3. **Prinsip Inti**: Detail 5 prinsip
4. **Program DVC**: Leadership, Entrepreneurship, Beasiswa
5. **Tim**: 10 Tim Inti + 50 Freelancer
6. **CTA**: Join/Konsultasi

---

### 3. Portfolio Page (/portfolio)
**Showcase semua project**

**Sections:**
1. **Hero**: Portfolio Kami
2. **Filter**: By service type (All, SMM, Web Dev, dll)
3. **Grid Portfolio**: All projects
4. **Pagination**

---

### 4. Portfolio Detail (/portfolio/{slug})
**Detail project**

**Sections:**
1. **Hero Image**: Project thumbnail
2. **Project Info**: Client, service type, date
3. **Challenge**: Masalah yang dihadapi
4. **Solution**: Solusi yang diberikan
5. **Result**: Impact/hasil
6. **Gallery**: Multiple images
7. **CTA**: Project Lainnya / Konsultasi

---

### 5. Services Page (/services)
**Detail semua layanan**

**Sections:**
1. **Hero**: Layanan Kami
2. **Service List**: Detail setiap layanan
3. **Process**: Cara kerja
4. **CTA**: Konsultasi

---

### 6A. Pricing Overview Page (/pricing)
**Konsep**: Tampilkan kategori paket, overview pricing, guide user ke detail

**Sections:**
1. **Hero**: Paket Kontribusi Anda
   - Headline: "Berkontribusi Sesuai Kemampuan"
   - Subtitle: "Setiap paket membantu mahasiswa melanjutkan pendidikan"

2. **Category Grid** (4 cards)
   ```
   ┌─────────────────────────────────────┐
   │  ┌──────────┐  ┌──────────┐        │
   │  │ [Icon]   │  │ [Icon]   │        │
   │  │          │  │          │        │
   │  │ Beasiswa │  │ Beasiswa │        │
   │  │ S1       │  │ S2 & S3  │        │
   │  │          │  │          │        │
   │  │ Mulai    │  │ Mulai    │        │
   │  │ Rp1.5Jt  │  │ Rp4.5Jt  │        │
   │  │          │  │          │        │
   │  │[Detail→] │  │[Detail→] │        │
   │  └──────────┘  └──────────┘        │
   │                                     │
   │  ┌──────────┐  ┌──────────┐        │
   │  │ Custom   │  │ Donasi   │        │
   │  │ Project  │  │ Bebas    │        │
   │  └──────────┘  └──────────┘        │
   └─────────────────────────────────────┘
   ```

   **Elemen:**
   - 4 kategori: S1, S2/S3, Custom Project, Donasi
   - Starting price
   - Short description (1-2 kalimat)
   - CTA ke detail page

3. **Value Section**
   - "Ke mana dana Anda dialokasikan?"
   - Infographic/visual alokasi dana
   - Transparency statement

4. **Stats Impact**
   - Berapa mahasiswa sudah terbantu
   - Total dana tersalur
   - Success stories (short)

5. **CTA Footer**
   - "Butuh konsultasi? Hubungi kami"
   - Contact buttons

---

### 6B. Pricing Detail Page (/pricing/{category})
**Konsep**: Detail semua paket dalam kategori, comparison, clear CTA

**URL Examples:**
- `/pricing/s1` - Paket Beasiswa S1
- `/pricing/s2-s3` - Paket Beasiswa S2 & S3
- `/pricing/custom` - Custom Project
- `/pricing/donation` - Donasi

**Sections:**
1. **Hero**:
   - Breadcrumb: Pricing > S1
   - Title: "Paket Beasiswa S1"
   - Subtitle: "Membantu mahasiswa dengan uang saku bulanan"

2. **Package Comparison Table** (Desktop) / Cards (Mobile)
   ```
   ┌─────────────────────────────────────────────────┐
   │        Paket 1    Paket 2    Paket 3    Paket 4│
   │                                                 │
   │ Harga  Rp1.5Jt   Rp3Jt      Rp4Jt      Rp5Jt  │
   │ Konten 12        20          20         30     │
   │ Campaign -       -           2          4      │
   │ Mahasiswa 1      2           3          4      │
   │                                                 │
   │ [Pilih] [Pilih]  [Pilih]    [Pilih]           │
   └─────────────────────────────────────────────────┘
   ```

3. **Features Detail**
   - Apa saja yang didapat client
   - Deliverables
   - Timeline
   - Support

4. **Beneficiaries Impact**
   - Visual: "Dengan paket ini, Anda membantu X mahasiswa"
   - Profile mahasiswa (anonim/generalized)

5. **FAQ Section**
   - Pertanyaan umum spesifik kategori
   - "Bagaimana proses pembayaran?"
   - "Apakah ada kontrak?"
   - dll

6. **CTA Section**
   - "Siap memilih paket?"
   - Button: "Lanjut ke Konfirmasi Pembayaran"
   - Or: "Konsultasi Dulu"

7. **Related Packages**
   - "Lihat paket lain"
   - Link ke kategori lain

---

### 7. Payment Confirmation Page (/payment/confirm)
**Form konfirmasi pembayaran**

**Sections:**
1. **Hero**: Konfirmasi Pembayaran
2. **Rekening Info**: Bank details, copy button
3. **Form**:
   - Nama
   - Email
   - Phone
   - Paket yang dipilih
   - Nominal transfer
   - Tanggal transfer
   - Bank pengirim
   - Nama rekening pengirim
   - Upload bukti transfer
   - Pesan (optional)
4. **Submit**: WhatsApp notification ke admin
5. **Thank You Message**

---

### 8. Contact Page (/contact) - Optional
**Bisa digabung di footer atau terpisah**

**Sections:**
1. **Hero**: Hubungi Kami
2. **Contact Info**: WA, Email, Alamat (jika ada)
3. **Contact Form**
4. **Map**: Google Maps (jika ada lokasi)

---

## HALAMAN ADMIN

### 9. Admin Dashboard (/admin)
**Laravel Filament**

**Menu:**
- Dashboard (stats overview)
- Portfolio Management
- Services Management
- Packages Management
- Partners Management
- Testimonials Management
- Contact Inquiries
- Payment Confirmations
- Settings
- About Contents
- Users

---

## NAVIGASI

### Header Navigation (Desktop)
```
[LOGO] Home | About | Services | Portfolio | Pricing | [Konsultasi]
```

### Header Navigation (Mobile)
```
[LOGO]                                    [☰ Menu]
```

**Burger Menu:**
- Home
- About
- Services
- Portfolio
- Pricing
- Contact
- [CTA: Konsultasi]

---

## DESIGN PRINCIPLES

### Minimalist & Simple
- **White space**: Banyak ruang kosong
- **Typography**: Bold headlines, readable body
- **Colors**: Hitam-Putih dengan gray accents
- **Icons**: Simple line icons
- **Images**: High quality, grayscale filter

### Bermakna
- **Storytelling**: Setiap section cerita mahasiswa & impact
- **Numbers**: Tunjukkan data konkret (berapa mahasiswa terbantu)
- **Testimonials**: Real stories
- **Transparency**: Jelas kemana dana dialokasikan

### User Experience
- **Clear CTA**: Di setiap section ada action yang jelas
- **Easy Navigation**: Sticky header, smooth scroll
- **Mobile First**: Responsive di semua device
- **Fast Loading**: Optimized images & code
- **Accessibility**: Contrast ratio, readable fonts

---

## VISUAL REFERENCES

**Style Inspiration:**
- Apple.com (minimal, bold typography)
- Stripe.com (clean, professional)
- Linear.app (modern, monochrome)

**Typography:**
- Headlines: Bold, besar, impactful
- Body: Regular, readable, spaced
- Accent: Italic untuk quotes

**Layout:**
- Grid system: 12 columns
- Spacing: 8px base unit (8, 16, 24, 32, 48, 64)
- Max width: 1280px container

**Animations:**
- Subtle fade-in on scroll
- Smooth transitions
- No flashy effects

---

## TOTAL PAGES

**Public:**
1. Landing Page (/) ✓
2. About Page (/about) ✓
3. Services Page (/services) ✓
4. Portfolio Page (/portfolio) ✓
5. Portfolio Detail (/portfolio/{slug}) ✓
6. Pricing Overview (/pricing) ✓
7. Pricing Detail (/pricing/{category}) ✓ - s1, s2-s3, custom, donation
8. Payment Confirmation (/payment/confirm) ✓
9. Contact Page (/contact) - Optional Phase 2

**Admin:**
9. Admin Panel (/admin) - Laravel Filament ✓

---

## PRIORITY IMPLEMENTATION

**Phase 1 - MVP:**
1. ✅ Landing Page (7 sections - focused)
2. ✅ About Page (full detail - latar belakang, prinsip, program)
3. ✅ Services Page (detail layanan)
4. ✅ Portfolio Page (grid dengan filter)
5. ✅ Portfolio Detail Page (case study)
6. ✅ Pricing Overview Page (4 kategori)
7. ✅ Pricing Detail Page (per kategori dengan comparison)
8. ✅ Payment Confirmation Page
9. ✅ Admin Panel (Filament)

**Phase 2:**
9. Contact Page (dedicated)
10. Blog section
11. Advanced features
