<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plusflix</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/script.js" defer></script>
</head>
<body>

<nav class="navbar">
    <div class="logo-container" onclick="showSection('landing')">
        <div class="logo-icon"></div>
        <div class="logo-text">PLUSFLIX</div>
    </div>

    <div class="hamburger" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <ul class="nav-menu" id="navMenu">
        <li class="nav-link" onclick="showSection('home'); toggleMenu()">Filmy</li>
        <li class="nav-link">Seriale</li>
        <li class="nav-link">Gatunki</li>
        <li class="nav-link">Rok produkcji</li>
    </ul>

    <div class="search-bar">
        <input type="text"
               class="search-input"
               placeholder="Wpisz tytuł, aktora, reżysera...">
    </div>
</nav>
