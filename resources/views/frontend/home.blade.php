<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SITALAS - Kota Surabaya</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Fredoka One', cursive;
            background-color: #F0F8FF; /* Warna latar belakang lembut */
        }

        .navbar {
            background-color: #87CEEB !important; /* Biru langit */
            padding: 20px 0; /* Padding lebih rapi */
        }

        .navbar-brand img {
            height: 65px;
            width: 190px;
        }

        .navbar-nav .nav-link {
            font-size: 20px;
            color: #004080 !important; /* Warna font */
            padding: 10px 15px;
            transition: color 0.3s ease, transform 0.3s ease; /* Animasi perubahan warna dan efek transform */
        }

        /* Efek saat menu diklik */
        .navbar-nav .nav-link.clicked {
            color: white !important; /* Warna berubah saat diklik */
            /* Membesar saat klik */
        }

        .navbar-nav .nav-link:active {
            color: white !important; /* Warna berubah saat diklik */
        }

        /* Dropdown Menu Styling */
        .dropdown-menu {
            background-color: #ffffff; /* Warna latar dropdown */
            border-radius: 8px;
        }

        .dropdown-menu .dropdown-item {
            font-size: 18px;
            color: #004080 !important; /* Warna teks dropdown */
            transition: color 0.3s ease-in-out; /* Animasi perubahan warna */
        }

        .dropdown-menu .dropdown-item:active {
            color: white !important; /* Warna berubah saat diklik */
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #ADD8E6; /* Warna hover lembut */
        }

        /* Submenu Styling */
        .dropdown-menu .dropdown-submenu {
            position: relative;
        }

        .dropdown-menu .dropdown-submenu > .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
        }

        .dropdown-menu .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }

        .dropdown-menu .dropdown-submenu > a::after {
            content: "\25B6";
            float: right;
        }

        /* Dropdown Toggle Active Styling */
        .dropdown-toggle.clicked {
            color: white !important; /* Warna berubah saat diklik */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo SITALAS">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav" id="navbar-menu"></ul>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navbarMenu = document.getElementById("navbar-menu");
            const menuItems = [
                { name: "Home", link: "#" },
                { name: "Galeri", link: "#" },
                { name: "Forum Anak", link: "#", submenu: [
                    { name: "Pemantauan Usulan Anak", link: "#" },
                    { name: "Galeri Anak", link: "#" },
                    { name: "Forum Anak Kecamatan", link: "#", submenu: [
                        { name: "SK FAS Kecamatan", link: "#" },
                        { name: "Kegiatan Forum Anak Kecamatan", link: "#" }
                    ]},
                    { name: "Forum Anak Kelurahan", link: "#", submenu: [
                        { name: "SK FAS Kelurahan", link: "#" },
                        { name: "Kegiatan Forum Anak Kelurahan", link: "#" }
                    ]},
                    { name: "Kegiatan Forum Anak Surabaya", link: "#" }
                ]},
                { name: "Kecamatan & Kelurahan Layanan Anak", link: "#", submenu: [
                    { name: "Kegiatan", link: "#", submenu: [
                        { name: "Kegiatan Kecamatan", link: "#" },
                        { name: "Kegiatan Kelurahan", link: "#" }
                    ]},
                    { name: "KAS RPA", link: "#" }
                ]},
                { name: "CFCI", link: "#", submenu: [
                    { name: "SK", link: "#", submenu: [
                        { name: "SK Kecamatan", link: "#" },
                        { name: "SK Kelurahan", link: "#" }
                    ]},
                    { name: "Artikel Kegiatan", link: "#" },
                    { name: "Kegiatan", link: "#" },
                    { name: "Galeri CFCI", link: "#" }
                ]},
                { name: "PISA", link: "#", submenu: [
                    { name: "Dokumen", link: "#" },
                    { name: "Kegiatan", link: "#" }
                ]},
                { name: "Menu Anyar", link: "#", submenu: [
                    { name: "Pantau Suara Anak", link: "#" },
                    { name: "Karya Anak", link: "#" }
                ]},
                { name: "Login", link: "#" }
            ];

            function createMenu(items) {
                return items.map(item => {
                    if (item.submenu) {
                        return `
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="${item.link}" role="button" data-bs-toggle="dropdown" onclick="changeColorOnClick(event)">
                                    ${item.name}
                                </a>
                                <ul class="dropdown-menu">
                                    ${item.submenu.map(sub => sub.submenu ? `
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item" href="${sub.link}" onclick="changeColorOnClick(event)">${sub.name}</a>
                                            <ul class="dropdown-menu">
                                                ${sub.submenu.map(subSub => <li><a class="dropdown-item" href="${subSub.link}" onclick="changeColorOnClick(event)">${subSub.name}</a></li>).join("")}
                                            </ul>
                                        </li>
                                    ` : <li><a class="dropdown-item" href="${sub.link}" onclick="changeColorOnClick(event)">${sub.name}</a></li>).join("")}
                                </ul>
                            </li>`;
                    } else {
                        return <li class="nav-item"><a class="nav-link" href="${item.link}" onclick="changeColorOnClick(event)">${item.name}</a></li>;
                    }
                }).join("");
            }

            navbarMenu.innerHTML = createMenu(menuItems);

            // Fungsi untuk menangani klik dan mengubah warna font
            window.changeColorOnClick = function(event) {
                const links = document.querySelectorAll('.nav-link');
                links.forEach(link => link.classList.remove('clicked')); // Menghapus efek clicked dari semua item
                event.target.classList.add('clicked'); // Menambahkan efek clicked ke item yang diklik
            };
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>