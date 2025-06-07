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

        /* Adjustments for the footer logo and text for consistency */
        .footer .d-flex.justify-content-center.align-items-center.mb-3 .bg-white {
            background-color: white !important; /* Ensure white background */
            padding: 0.5rem 1rem; /* Adjust padding as per image */
            border-radius: 2rem; /* Rounded pill shape */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow */
        }

        .footer .d-flex.justify-content-center.align-items-center.mb-3 .bg-white img {
            width: 30px; /* Adjust size as per image */
            height: 30px;
            margin-right: 0.5rem; /* Space between logo and text */
        }

        .footer .d-flex.justify-content-center.align-items-center.mb-3 .bg-white .fw-bold {
            font-size: 1.25rem; /* text-xl equivalent */
            background: linear-gradient(to right, #fdb88d, white);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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

        .profile-dropdown:hover .profile-dropdown-content {
            display: block;
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

        .manual-section h2,
        .faq-section h2 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: white;
        }

        .manual-section .highlight-yellow,
        .faq-section .highlight-yellow {
            color: #fdb88d;
        }

        .manual-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .manual-content {
                grid-template-columns: 1fr 1fr;
            }
        }

        .manual-list li {
            display: flex;
            align-items: center;
            font-size: 1.125rem;
            margin-bottom: 1rem;
            color: white;
        }

        .manual-list li i {
            margin-right: 0.5rem;
            font-size: 1.25rem;
        }

        .faq-section {
            margin-bottom: 4rem;
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
                <div class="profile-dropdown">
                    <i class="bi bi-person-circle fs-4"></i>
                    <div class="profile-dropdown-content">
                        <a href="#">Profil</a>
                        <a href="#">Pengaturan</a>
                        <a href="{{ route('logout') }}">Keluar</a>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <div class="bg-white text-dark px-4 py-3 rounded-4 d-inline-flex align-items-center shadow-sm">
                        <img src="{{ asset('rubber-duck.png') }}" alt="Logo" width="40" class="me-3">
                        <div>
                            <div class="fw-bold fs-5 mb-1">Hello, {{ Auth::user()->username }}!</div>
                            <div class="text-muted small">Ready to make smart money moves today? You’re one step closer to financial freedom 🚀</div>
                        </div>
                    </div>
                </div>
            </div>

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

            <section class="manual-section">
                <h2><span>Manual</span> <span class="highlight-yellow">Pengguna</span></h2>
                <div class="manual-content">
                    <ul class="manual-list">
                        <li><i class="bi bi-chevron-down"></i> Navigasi Umum</li>
                        <li><i class="bi bi-chevron-down"></i> Cara Masuk dan Daftar</li>
                        <li><i class="bi bi-chevron-down"></i> Menambahkan Transaksi</li>
                        <li><i class="bi bi-chevron-down"></i> Target Tabungan</li>
                        <li><i class="bi bi-chevron-down"></i> Cara Masuk dan Daftar</li>
                        <li><i class="bi bi-chevron-down"></i> Cara Masuk dan Daftar</li>
                    </ul>
                    <ul class="manual-list">
                        <li><i class="bi bi-chevron-down"></i> Tidak Bisa Login?</li>
                        <li><i class="bi bi-chevron-down"></i> Saldo Tidak Berubah?</li>
                        <li><i class="bi bi-chevron-down"></i> Angka muncul sebagai ?</li>
                    </ul>
                </div>
            </section>

            <section class="faq-section">
                <h2><span>Frequently</span> <span class="highlight-yellow">Ask Question</span></h2>
                </section>
            </div>

        <div class="footer">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <div class="bg-white text-dark px-3 py-2 rounded-pill d-inline-flex align-items-center shadow-sm">
                    <img src="{{ asset('rubber-duck.png') }}" alt="Logo" width="30" class="me-2">
                    <span class="fw-bold" style="font-size: 1.25rem;">Duitto</span>
                </div>
            </div>

            <div class="fw-bold text-uppercase small">Sponsored By</div>
            <div class="sponsor my-3 d-flex justify-content-center flex-wrap gap-3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" height="30" alt="Mastercard">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d6/Visa_2021.svg/1920px-Visa_2021.svg.png" height="30" alt="Visa">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" height="30" alt="PayPal">
                <img src="https://upload.wikimedia.org/wikipedia/commons/3/39/BI_Logo.png" height="30" alt="Bank Indonesia">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/213px-Bank_Mandiri_logo_2016.svg.png" height="30" alt="Bank Mandiri">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/960px-Bank_Central_Asia.svg.png" height="30" alt="BCA">
                <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/200px-BNI_logo.svg.png?20240305030303" height="30" alt="BNI">
            </div>

            <div class="fw-bold text-uppercase small">Contact Us</div>
            <div class="social-icons mt-2 d-flex justify-content-center">
                <i class="bi bi-facebook"></i>
                <i class="bi bi-twitter-x"></i>
                <i class="bi bi-instagram"></i>
                <i class="bi bi-tiktok"></i>
                <i class="bi bi-youtube"></i>
            </div>
        
            <div class="mt-4 small">&copy;Copyright 2025 all rights reserved.</div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>