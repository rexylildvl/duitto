<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Duitto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
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
            overflow-y: auto;
        }
        .sidebar {
            background-color: #424769;
            height: 100vh;
            width: 70px;
            position: fixed;
            transition: width 0.3s ease;
            overflow-x: hidden;
            z-index: 1000;
        }
        .sidebar:hover {
            width: 220px;
        }
        .sidebar .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 0;
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
        .sidebar:hover ~ .wrapper .main-content {
            margin-left: 220px;
            width: calc(100% - 220px);
        }
        .card {
            background-color: #3e446a;
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .btn-peach {
            background-color: #fdb88d;
            color: #2D3250;
            font-weight: bold;
            border-radius: 1rem;
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
        .footer .logo-text {
            font-weight: bold;
            font-size: 1.5rem;
            background: linear-gradient(to right, #fdb88d, #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-left: 0.5rem;
        }
        .footer .sponsor img,
        .footer .social-icons i {
            margin: 0 0.5rem;
        }
        .footer .social-icons i {
            font-size: 1.5rem;
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
    </style>
</head>
<body>
@include('layouts.sidebar')
<div class="wrapper">
    @include('layouts.topbar')
    <div class="main-content container-fluid">
        @yield('content')
    </div>
    @include('layouts.footer')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
