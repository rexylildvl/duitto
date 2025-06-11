<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bantuan - Duitto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        body {
            background-color: #2D3250;
            color: white;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 100vh;
            overflow-y: auto; /* Allows content to scroll */
        }

        .sidebar {
            background-color: #424769;
            height: 100vh;
            width: 70px;
            position: fixed;
            transition: width 0.3s ease;
            overflow-x: hidden;
            z-index: 1000;
            /* Added flex properties for centering content vertically within sidebar */
            display: flex;
            flex-direction: column;
            align-items: center; /* Center items horizontally */
            padding-top: 1rem; /* Padding at the top */
        }

        .sidebar:hover {
            width: 220px;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 0;
            margin-bottom: 1rem; /* Spacing below the logo */
        }

        .sidebar:hover .logo-text {
            display: inline;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(to right, #fdb88d, white);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: none;
            margin-left: 10px;
            white-space: nowrap;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            font-weight: bold;
            white-space: nowrap;
            transition: background-color 0.3s;
            width: 100%; /* Ensure links take full width for hover effect */
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #2D3250;
        }

        .sidebar i {
            margin-right: 16px;
            font-size: 18px;
        }

        .nav-text {
            display: none;
        }

        .sidebar:hover .nav-text {
            display: inline;
        }

        .main-content {
            margin-left: 70px;
            transition: margin-left 0.3s ease;
            padding: 2rem;
            flex: 1;
            width: calc(100% - 70px);
        }

        .bg-soft-peach {
            background-color: #F0C28D !important;
        }

        .sidebar:hover ~ .wrapper .main-content {
            margin-left: 220px;
            width: calc(100% - 220px);
        }

        .card {
            background-color: #3e446a;
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            padding: 1.5rem; /* Consistent padding */
        }

        .btn-peach {
            background-color: #fdb88d;
            color: #2D3250;
            font-weight: bold;
            border-radius: 1rem;
            border: none;
        }

        .btn-peach:hover {
            background-color: #fab07f;
        }

        .money-title {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .searchbar {
            background-color: #eee;
            border-radius: 20px;
            padding: 5px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
            width: 400px;
            max-width: 100%;
        }

        .searchbar input {
            border: none;
            background: transparent;
            width: 100%;
            outline: none;
            color: #333; /* Ensure text is visible */
        }

        .footer {
            background-color: #e3e1dc;
            color: #333;
            padding: 3rem 1rem 2rem;
            text-align: center;
            width: 100%;
            margin-top: auto;
            font-family: 'Segoe UI', sans-serif;
        }

        .footer .d-flex.justify-content-center.align-items-center.mb-3 .bg-white {
        background-color: #2D3250 !important; /* Changed from white to match the website's purple background */
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .footer .d-flex.justify-content-center.align-items-center.mb-3 .bg-white .fw-bold {
        font-size: 1.25rem;
        background: linear-gradient(to right, #fdb88d, white);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        color: white; /* Added as fallback */
        }

        .footer .d-flex.justify-content-center.align-items-center.mb-3 .bg-white img {
            width: 30px; /* Adjust size as per image */
            height: 30px;
            margin-right: 0.5rem; /* Space between logo and text */
        }



        .footer .sponsor,
        .footer .social-icons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            gap: 1rem; /* Spacing between items */
        }

        .footer .sponsor img,
        .footer .social-icons i {
            margin: 0; /* Reset margin from general rule, use gap instead */
        }

        .footer .social-icons i {
            font-size: 1.5rem;
            transition: color 0.3s;
            cursor: pointer;
        }

        .footer .social-icons i:hover {
            color: #2D3250;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            width: 100%;
        }

        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            right: 0;
            z-index: 1001;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .profile-dropdown-content a {
            color: #333;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
        }

        .profile-dropdown-content a,
    .profile-dropdown-content button.dropdown-item {
        color: #333;
        padding: 10px 16px;
        text-decoration: none;
        display: block;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        font-size: 1rem;
        cursor: pointer;
        box-sizing: border-box;
    }
    .profile-dropdown-content form {
        margin: 0;
    }

        .profile-dropdown:hover .profile-dropdown-content {
            display: block;
        }

        .profile-dropdown-content a:hover,
.profile-dropdown-content button.dropdown-item:hover {
    color: #F3AB9D; 
    background-color: transparent;
    text-decoration: underline; 
}

        /* Styles specific to Bantuan page content */
        .page-heading-bantuan {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .page-heading-bantuan h1 {
            font-size: 2.5rem;
            font-weight: bold;
            line-height: 1.3;
            color: white;
        }

        .page-heading-bantuan .highlight {
            color: white;
        }

        .contact-section {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        @media (min-width: 992px) { /* Equivalent to lg:grid-cols-2 */
            .contact-section {
                grid-template-columns: 1fr 1fr;
            }
        }

        .contact-card-bantuan {
            background-color: #f5f5f5; /* bg-gray-100 equivalent */
            color: #333; /* text-black equivalent */
            padding: 1.5rem;
            border-radius: 1.5rem; /* card border-radius */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* subtle shadow */
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .contact-card-bantuan h2 {
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .contact-card-bantuan h2 i {
            margin-right: 0.5rem;
            font-size: 1.5rem;
        }

        .contact-card-bantuan p {
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .contact-card-bantuan .font-bold {
            font-weight: bold;
        }

        .contact-card-bantuan .info-row {
            display: flex;
            align-items: center;
            margin-top: 0.25rem;
        }

        .contact-card-bantuan .info-row i {
            margin-right: 0.25rem;
        }

        .contact-card-bantuan .social-links {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding-top: 0.5rem;
        }

        .contact-card-bantuan .social-links i {
            font-size: 1.25rem;
            transition: color 0.3s;
            cursor: pointer;
        }

        .contact-card-bantuan .social-links i:hover {
            color: #2D3250;
        }

        .contact-form-bantuan {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .contact-form-bantuan input,
        .contact-form-bantuan textarea {
            width: 100%;
            border: none;
            border-bottom: 1px solid #ccc;
            background: transparent;
            outline: none;
            padding: 0.25rem 0.5rem;
            color: #333;
        }

        .contact-form-bantuan textarea {
            border: 1px solid #ccc;
            padding: 0.5rem;
            border-radius: 0.25rem;
            resize: vertical;
        }

        .contact-form-bantuan input:focus,
        .contact-form-bantuan textarea:focus {
            border-color: #2D3250;
        }

        .map-section {
            margin-bottom: 2.5rem;
        }

        .map-section iframe {
            width: 100%;
            height: 24rem;
            border-radius: 0.5rem;
            border: 2px solid white;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        /* General Styling */
.manual-section, .faq-section {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    padding: 2rem 2rem 2rem 2rem;
    margin-bottom: 2rem;
    box-sizing: border-box;
    color: #2d3748;
}

.highlight-yellow {
    color: #FFC107;
}

h2 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: #2d3748;
}

h2 span {
    display: inline-block;
}

/* Manual List Styling */
.manual-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.manual-list li {
    margin-bottom: 1rem;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 1rem;
}

.manual-list li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

/* Details/Spoiler Styling */
details {
    cursor: pointer;
    transition: all 0.3s ease;
}

details[open] {
    background-color: #f8fafc;
    border-radius: 8px;
    padding: 0.5rem;
}

summary {
    font-weight: 600;
    font-size: 1.1rem;
    color: #4a5568;
    padding: 0.5rem 0;
    outline: none;
    position: relative;
}

summary:hover {
    color: #2d3748;
}

summary::-webkit-details-marker {
    display: none;
}

summary:after {
    content: "+";
    position: absolute;
    right: 0;
    font-weight: bold;
    font-size: 1.2rem;
    color: #718096;
    transition: transform 0.3s ease;
}

details[open] summary:after {
    content: "-";
    transform: rotate(0deg);
}

details p {
    margin-top: 0.8rem;
    color: #4a5568;
    line-height: 1.6;
    padding: 0 0.5rem;
    font-size: 0.95rem;
}

details strong {
    color: #2d3748;
    font-weight: 600;
}

/* Responsive Design */
@media (min-width: 768px) {
    .help-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .manual-section, .faq-section {
        margin-bottom: 0;
    }
}

/* Animation */
details[open] {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

        
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('rubber-duck.png') }}" alt="Logo" style="width: 40px;">
            <span class="logo-text">Duitto</span>
        </div>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i><span class="nav-text">Beranda</span>
        </a>
        <a href="{{ route('tagihan.index') }}" class="{{ request()->routeIs('tagihan.index') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i><span class="nav-text">Tagihan</span>
        </a>
        <a href="{{ route('pengeluaran.index') }}" class="{{ request()->routeIs('pengeluaran.index') ? 'active' : '' }}">
            <i class="bi bi-cash-stack"></i><span class="nav-text">Pengeluaran</span>
        </a>
        <a href="{{ route('pemasukan.index') }}" class="{{ request()->routeIs('pemasukan.index') ? 'active' : '' }}">
            <i class="bi bi-wallet2"></i><span class="nav-text">Pemasukkan</span>
        </a>
        <a href="{{ route('tabungan.index') }}" class="{{ request()->routeIs('tabungan.index') ? 'active' : '' }}">
            <i class="bi bi-piggy-bank"></i><span class="nav-text">Tabungan</span>
        </a>
        <br><br><br><br><br><br><br><br><br><br><br><br>
        <a href="{{ route('bantuan.index') }}" class="{{ request()->routeIs('bantuan.index') ? 'active' : '' }}">
            <i class="bi bi-question-circle"></i>
            <span class="nav-text">Bantuan</span>
        </a>
    </div>

    <!-- Wrapper Content -->
    <div class="wrapper">
        <div class="main-content container-fluid">
            <div class="top-bar">
                <div class="searchbar">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search Here" style="width: 100%;">
                </div>
                @include('layouts.profile-dropdown')
            </div>

            <!-- <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <div class="bg-white text-dark px-4 py-3 rounded-4 d-inline-flex align-items-center shadow-sm">
                        <img src="{{ asset('rubber-duck.png') }}" alt="Logo" width="40" class="me-3">
                        <div>
                            <div class="fw-bold fs-5 mb-1">Hello, {{ Auth::user()->username }}!</div>
                            <div class="text-muted small">Ready to make smart money moves today? You’re one step closer to financial freedom 🚀</div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="page-heading-bantuan">
                <h1>
                    We Are Always Ready <br>
                    to Help <span class="highlight">You and</span> <br>
                    <span class="highlight">Answer Your</span> Question
                </h1>
            </div>

            <section class="contact-section">
                <div class="contact-card-bantuan">
                    <h2>
                        <i class="bi bi-telephone-fill"></i> Hubungi Kami
                    </h2>
                    <div>
                        <p class="font-bold">Alamat <i class="bi bi-geo-alt-fill text-sm"></i></p>
                        <p>
                            Jl. Raya Mayjen Sungkono No.KM 5, Dusun 2, Blater, Kec. Kalimanah, Kabupaten Purbalingga, Jawa Tengah 53371
                        </p>
                    </div>
                    <div>
                        <p class="font-bold">Call Center <i class="bi bi-lock-fill text-sm"></i></p>
                        <p class="info-row"><i class="bi bi-telephone-fill"></i> 085-591-309-511</p>
                        <p class="info-row"><i class="bi bi-envelope-fill"></i> support@duitto.app</p>
                    </div>
                    <div class="social-links">
                        <span class="font-bold">Temukan Kami</span>
                        <i class="bi bi-facebook"></i>
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-tiktok"></i>
                        <i class="bi bi-youtube"></i>
                    </div>
                </div>

                <div class="contact-card-bantuan">
                    <h2>Get In Touch</h2>
                    <p>Let us know if you need any help or some message to improve this app</p>
                    <form class="contact-form-bantuan">
                        <input type="text" placeholder="Name" />
                        <input type="email" placeholder="Email" />
                        <input type="text" placeholder="Subject" />
                        <textarea rows="4" placeholder="Message"></textarea>
                        <button type="submit" class="btn btn-peach">Send Message</button>
                    </form>
                </div>
            </section>

            <section class="map-section">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.4026880942555!2d109.3090714!3d-7.4206584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6559312b6f4a01%3A0x7d9f7a7d4a4a4a!2sJl.%20Raya%20Mayjen%20Sungkono%20No.KM%205%2C%20Dusun%202%2C%20Blater%2C%20Kec.%20Kalimanah%2C%20Kabupaten%20Purbalingga%2C%20Jawa%20Tengah%2053371!5e0!3m2!1sen!2sid!4v1678912345678!5m2!1sen!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>

        <div class="help-container">
            <section class="manual-section">
                <h2><span>Manual</span> <span class="highlight-yellow">Pengguna</span></h2>
                    <div class="manual-content">
                        <ul class="manual-list">
                        <li>
                            <details>
                            <summary> Navigasi Umum</summary>
                            <p>
                                Navigasi utama aplikasi terletak di bagian atas atau samping layar dan terdiri dari beberapa menu utama seperti: <strong>Beranda</strong>, <strong>Transaksi</strong>, <strong>Target</strong>, <strong>Statistik</strong>, dan <strong>Profil</strong>. Gunakan menu tersebut untuk berpindah antar halaman dengan cepat dan efisien.
                            </p>
                            </details>
                        </li>
                        <li>
                            <details>
                            <summary> Cara Masuk dan Daftar</summary>
                            <p>
                                Untuk mulai menggunakan aplikasi, klik tombol <strong>Masuk</strong> di pojok kanan atas. Jika belum memiliki akun, klik <strong>Daftar</strong> dan isi formulir pendaftaran dengan nama, email aktif, dan kata sandi. Setelah berhasil, Anda akan langsung diarahkan ke beranda aplikasi.
                            </p>
                            </details>
                        </li>
                        <li>
                            <details>
                            <summary> Menambahkan Transaksi</summary>
                            <p>
                                Untuk mencatat pemasukan atau pengeluaran, buka menu <strong>Transaksi</strong>, lalu klik <strong>Tambah Transaksi</strong>. Pilih jenis transaksi (pemasukan/pengeluaran), kategori, nominal, tanggal, dan deskripsi. Setelah itu klik <strong>Simpan</strong>. Data akan otomatis tercatat dan memengaruhi saldo Anda.
                            </p>
                            </details>
                        </li>
                        
                        <li>
                            <details>
                            <summary> Melihat Statistik</summary>
                            <p>
                                Di menu <strong>Statistik</strong>, Anda bisa melihat grafik pemasukan dan pengeluaran per bulan, serta distribusi pengeluaran per kategori. Statistik ini membantu Anda memahami pola keuangan dan membuat keputusan yang lebih baik.
                            </p>
                            </details>
                        </li>
                        <li>
                        <details>
                        <summary> Mengelola Kategori</summary>
                        <p>
                            Untuk menyesuaikan jenis kategori transaksi sesuai kebutuhan, masuk ke menu <strong>Pengaturan</strong> > <strong>Manajemen Kategori</strong>. Anda dapat menambahkan kategori baru, mengubah nama kategori, atau menghapus kategori yang tidak lagi digunakan.
                        </p>
                        </details>
                        </li>
                        <li>
                            <details>
                            <summary> Target Tabungan</summary>
                            <p>
                                Anda bisa membuat target tabungan dengan masuk ke menu <strong>Target</strong>. Klik <strong>Buat Target</strong>, isi nama target, jumlah nominal, dan tanggal target. Setiap kali Anda menabung, aplikasi akan menghitung dan menampilkan progress pencapaian Anda.
                            </p>
                            </details>
                        </li>
                        </ul>
                    </div>
                </section>

            <section class="faq-section">
                <h2><span>Frequently</span> <span class="highlight-yellow">Ask Question</span></h2>
                <div class="faq-content">
                    <ul class="manual-list">
                        <li>
                            <details>
                            <summary> Tidak Bisa Login?</summary>
                            <p>
                                Jika Anda tidak dapat masuk, pastikan email dan kata sandi yang dimasukkan sudah benar. Jika lupa kata sandi, klik <strong>Lupa Password</strong> untuk mengatur ulang melalui email. Pastikan koneksi internet stabil dan aplikasi telah diperbarui ke versi terbaru.
                            </p>
                            </details>
                        </li>
                        <li>
                            <details>
                            <summary> Saldo Tidak Berubah?</summary>
                            <p>
                                Jika saldo tidak berubah setelah menambahkan transaksi, periksa apakah Anda telah menekan tombol <strong>Simpan</strong>. Coba juga muat ulang halaman. Jika masalah tetap muncul, hubungi tim dukungan melalui menu <strong>Bantuan</strong>.
                            </p>
                            </details>
                        </li>
                        <li>
                            <details>
                            <summary> Angka muncul sebagai "?"</summary>
                            <p>
                                Jika angka muncul sebagai tanda tanya (?), hal ini biasanya disebabkan oleh masalah pengaturan regional atau encoding di perangkat. Pastikan perangkat menggunakan <strong>format angka Indonesia</strong> dan aplikasi tidak mengalami kerusakan file. Jika tetap bermasalah, coba gunakan perangkat lain.
                            </p>
                            </details>
                        </li>
                        <li>
                        <details>
                                <summary> Bagaimana Jika Saya Ganti HP?</summary>
                                    <p>Anda tetap bisa login dengan akun yang sama di perangkat baru. Semua data tersimpan di cloud, jadi data Anda tidak akan hilang selama Anda menggunakan akun yang sama.</p>
                            </details>
                        </li>                 
                        <li>
                            <details>
                            <summary> Saldo Tidak Berubah Setelah Tambah Transaksi?</summary>
                            <p>
                                Saldo akan berubah secara otomatis setelah transaksi berhasil ditambahkan. Jika saldo tidak berubah, coba segarkan (refresh) halaman. Pastikan juga transaksi sudah tersimpan dengan meninjaunya di riwayat transaksi.
                            </p>
                            </details>
                        </li>
                        <li>
                            <details>
                                <summary>Bagaimana Cara Menghapus Transaksi?</summary>
                                <p>
                                    Buka halaman "Riwayat Transaksi", lalu klik ikon tempat sampah di sebelah transaksi yang ingin Anda hapus. Anda akan diminta konfirmasi sebelum transaksi benar-benar dihapus.
                                </p>
                            </details>
                        </li>
                        <li>
                            <details>
                                <summary> Apakah Data Saya Aman?</summary>
                                    <p>
                                        Ya. Kami menggunakan enkripsi pada semua data pengguna dan tidak membagikan informasi Anda ke pihak ketiga. Pastikan Anda tidak membagikan kata sandi ke siapa pun untuk menjaga keamanan akun.
                                    </p>
                            </details>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
     @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>