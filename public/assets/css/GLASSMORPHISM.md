# Glassmorphism CSS Utility Classes

Dokumentasi penggunaan class utility glassmorphism untuk efek kaca modern pada website.

## 📋 Daftar Isi

- [Pengenalan](#pengenalan)
- [Class Dasar](#class-dasar)
- [Class Khusus](#class-khusus)
- [Padding Utilities](#padding-utilities)
- [Contoh Penggunaan](#contoh-penggunaan)
- [Kombinasi Class](#kombinasi-class)
- [Responsive](#responsive)
- [Tips & Best Practices](#tips--best-practices)

---

## 🎨 Pengenalan

Glassmorphism adalah efek visual modern yang memberikan tampilan seperti kaca dengan:
- **Backdrop blur** - Efek blur pada background
- **Semi-transparent background** - Background transparan
- **Subtle borders** - Border halus
- **Soft shadows** - Shadow yang lembut

File CSS ini menyediakan class utility yang mudah digunakan dan dapat dipanggil di elemen HTML manapun.

---

## 🎯 Class Dasar

### `.glass`
Efek glass standar dengan transparansi sedang.

```html
<div class="glass">
    Konten Anda di sini
</div>
```

**Properties:**
- Backdrop blur: 10px
- Background: rgba(255, 255, 255, 0.7)
- Border radius: 20px
- Shadow: Medium

---

### `.glass-strong`
Efek glass yang lebih kuat dengan transparansi lebih rendah (lebih opaque).

```html
<div class="glass-strong">
    Konten dengan efek lebih kuat
</div>
```

**Properties:**
- Backdrop blur: 20px
- Background: rgba(255, 255, 255, 0.85)
- Border radius: 24px
- Shadow: Strong

**Kapan digunakan:**
- Header/Navbar
- Modal/Dialog
- Important cards
- Footer sections

---

### `.glass-light`
Efek glass yang lebih ringan dengan transparansi lebih tinggi.

```html
<div class="glass-light">
    Konten dengan efek lebih ringan
</div>
```

**Properties:**
- Backdrop blur: 5px
- Background: rgba(255, 255, 255, 0.5)
- Border radius: 16px
- Shadow: Light

**Kapan digunakan:**
- Background overlays
- Subtle containers
- Light decorations

---

## 🎴 Class Khusus

### `.glass-card`
Khusus untuk card dengan efek hover yang lebih menarik.

```html
<div class="glass-card">
    <h3>Judul Card</h3>
    <p>Deskripsi card dengan efek glass</p>
</div>
```

**Fitur:**
- Hover effect dengan transform
- Padding: 25px
- Smooth animation

**Kapan digunakan:**
- Product cards
- Service cards
- Blog cards
- Team member cards

---

### `.glass-btn`
Khusus untuk button dengan efek glass.

```html
<a href="#" class="glass-btn">Click Me</a>
<button class="glass-btn">Submit</button>
```

**Fitur:**
- Padding: 12px 24px
- Border radius: 12px
- Hover effect dengan transform

**Kapan digunakan:**
- Primary buttons
- CTA buttons
- Navigation buttons

---

### `.glass-input`
Khusus untuk input form dengan efek glass.

```html
<input type="text" class="glass-input" placeholder="Masukkan nama">
<textarea class="glass-input" placeholder="Pesan"></textarea>
<select class="glass-input">
    <option>Pilih opsi</option>
</select>
```

**Fitur:**
- Padding: 12px 16px
- Border radius: 12px
- Focus state dengan glass effect

**Kapan digunakan:**
- Contact forms
- Search inputs
- Login forms
- Any form inputs

---

## 📦 Padding Utilities

Class padding dapat dikombinasikan dengan class glass lainnya.

### `.glass-p`
Padding standar (20px)

```html
<div class="glass glass-p">
    Konten dengan padding standar
</div>
```

### `.glass-p-lg`
Padding besar (30px 40px)

```html
<div class="glass glass-p-lg">
    Konten dengan padding besar
</div>
```

### `.glass-p-sm`
Padding kecil (15px)

```html
<div class="glass glass-p-sm">
    Konten dengan padding kecil
</div>
```

---

## 💡 Contoh Penggunaan

### 1. Header/Navbar
```html
<header class="glass-strong">
    <nav>
        <!-- Navigation items -->
    </nav>
</header>
```

### 2. Product Card
```html
<div class="glass-card">
    <img src="product.jpg" alt="Product">
    <h3>Product Name</h3>
    <p>Product Description</p>
    <a href="#" class="glass-btn">Buy Now</a>
</div>
```

### 3. Contact Form
```html
<form class="glass glass-p-lg">
    <input type="text" class="glass-input" placeholder="Nama">
    <input type="email" class="glass-input" placeholder="Email">
    <textarea class="glass-input" placeholder="Pesan"></textarea>
    <button type="submit" class="glass-btn">Kirim</button>
</form>
```

### 4. Modal/Dialog
```html
<div class="glass-strong glass-p-lg">
    <h2>Modal Title</h2>
    <p>Modal content</p>
    <button class="glass-btn">Close</button>
</div>
```

### 5. Testimonial Card
```html
<div class="glass-card glass-p">
    <p>"Testimonial text here"</p>
    <h4>Customer Name</h4>
</div>
```

### 6. Breadcrumb
```html
<div class="glass glass-p">
    <nav>
        <a href="/">Home</a> / 
        <a href="/products">Products</a>
    </nav>
</div>
```

### 7. Footer Widget
```html
<div class="glass-light glass-p">
    <h3>Footer Title</h3>
    <ul>
        <li>Link 1</li>
        <li>Link 2</li>
    </ul>
</div>
```

---

## 🔗 Kombinasi Class

Anda dapat mengombinasikan beberapa class untuk hasil yang lebih baik:

```html
<!-- Card dengan padding besar -->
<div class="glass-card glass-p-lg">
    Content
</div>

<!-- Strong glass dengan padding kecil -->
<div class="glass-strong glass-p-sm">
    Content
</div>

<!-- Light glass dengan padding standar -->
<div class="glass-light glass-p">
    Content
</div>
```

**Contoh Kombinasi Populer:**

```html
<!-- Hero Section -->
<section class="glass-strong glass-p-lg">
    <h1>Welcome</h1>
    <p>Description</p>
    <a href="#" class="glass-btn">Get Started</a>
</section>

<!-- Service Card -->
<div class="glass-card glass-p">
    <div class="icon">...</div>
    <h3>Service Title</h3>
    <p>Service description</p>
    <a href="#" class="glass-btn">Learn More</a>
</div>

<!-- Contact Form Container -->
<div class="glass glass-p-lg">
    <h2>Contact Us</h2>
    <form>
        <input type="text" class="glass-input" placeholder="Name">
        <input type="email" class="glass-input" placeholder="Email">
        <textarea class="glass-input" placeholder="Message"></textarea>
        <button type="submit" class="glass-btn">Send</button>
    </form>
</div>
```

---

## 📱 Responsive

Semua class sudah responsive dan akan menyesuaikan secara otomatis:

- **Desktop (>991px)**: Border radius 20-24px
- **Tablet (768px-991px)**: Border radius 15px
- **Mobile (<575px)**: Border radius 12px

Padding juga akan menyesuaikan pada layar kecil.

---

## ✨ Tips & Best Practices

### 1. **Pilih Class yang Tepat**
- Gunakan `.glass-strong` untuk elemen penting (header, modal)
- Gunakan `.glass` untuk elemen umum (cards, containers)
- Gunakan `.glass-light` untuk elemen dekoratif

### 2. **Kombinasi dengan Background**
Glassmorphism bekerja paling baik dengan background yang memiliki warna atau gambar:
```html
<section style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="glass glass-p-lg">
        Content dengan glass effect
    </div>
</section>
```

### 3. **Hindari Overuse**
Jangan gunakan glass effect pada semua elemen. Gunakan secara selektif untuk:
- Cards
- Buttons
- Forms
- Modals
- Navigation

### 4. **Kontras Teks**
Pastikan teks tetap terbaca dengan baik:
```html
<!-- Baik -->
<div class="glass glass-p">
    <h2 style="color: #333;">Judul Gelap</h2>
</div>

<!-- Atau -->
<div class="glass-strong glass-p">
    <h2 style="color: #000;">Judul Sangat Gelap</h2>
</div>
```

### 5. **Performance**
- Glassmorphism menggunakan `backdrop-filter` yang bisa mempengaruhi performance
- Gunakan dengan bijak, terutama pada mobile devices
- Test di berbagai browser untuk kompatibilitas

### 6. **Browser Support**
- Modern browsers: Full support
- Safari: Requires `-webkit-backdrop-filter` (sudah included)
- Older browsers: Fallback ke background solid

---

## 🎨 Customization

Jika ingin menyesuaikan efek, edit file `glassmorphism.css`:

```css
/* Ubah blur intensity */
.glass {
    backdrop-filter: blur(15px); /* Ubah dari 10px */
}

/* Ubah transparansi */
.glass {
    background: rgba(255, 255, 255, 0.8); /* Ubah dari 0.7 */
}

/* Ubah border radius */
.glass {
    border-radius: 25px; /* Ubah dari 20px */
}
```

---

## 📝 Quick Reference

| Class | Use Case | Blur | Opacity |
|-------|----------|------|---------|
| `.glass` | General containers | 10px | 0.7 |
| `.glass-strong` | Headers, Modals | 20px | 0.85 |
| `.glass-light` | Overlays, Decorations | 5px | 0.5 |
| `.glass-card` | Cards with hover | 10px | 0.7 |
| `.glass-btn` | Buttons | 10px | 0.2 |
| `.glass-input` | Form inputs | 5px | 0.6 |

---

## 🚀 Contoh Lengkap

```html
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/glassmorphism.css">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; padding: 50px;">
    
    <!-- Header -->
    <header class="glass-strong glass-p" style="margin-bottom: 30px;">
        <nav>
            <a href="#">Home</a> | 
            <a href="#">About</a> | 
            <a href="#">Contact</a>
        </nav>
    </header>

    <!-- Product Cards -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px;">
        <div class="glass-card">
            <h3>Product 1</h3>
            <p>Description</p>
            <a href="#" class="glass-btn">Buy Now</a>
        </div>
        <div class="glass-card">
            <h3>Product 2</h3>
            <p>Description</p>
            <a href="#" class="glass-btn">Buy Now</a>
        </div>
        <div class="glass-card">
            <h3>Product 3</h3>
            <p>Description</p>
            <a href="#" class="glass-btn">Buy Now</a>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="glass glass-p-lg" style="max-width: 500px; margin: 0 auto;">
        <h2>Contact Us</h2>
        <form>
            <input type="text" class="glass-input" placeholder="Name" style="width: 100%; margin-bottom: 15px;">
            <input type="email" class="glass-input" placeholder="Email" style="width: 100%; margin-bottom: 15px;">
            <textarea class="glass-input" placeholder="Message" style="width: 100%; margin-bottom: 15px; min-height: 100px;"></textarea>
            <button type="submit" class="glass-btn">Send Message</button>
        </form>
    </div>

</body>
</html>
```

---

## 📞 Support

Jika ada pertanyaan atau butuh bantuan, silakan hubungi tim development.

**Happy Coding! 🎉**

