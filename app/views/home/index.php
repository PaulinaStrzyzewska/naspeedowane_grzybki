<!-- views/home/index.php -->

<!-- === SEKCJA LANDING === -->
<section id="landing" class="section-landing">
    <h1 class="hero-title">Lorem ipsum dolor sit amet.</h1>
    <p class="hero-desc">Lorem ipsum dolor sit amet consectetur adipiscing elit. Consectetur adipiscing elit quisque faucibus ex sapien vitae.</p>
    <button class="btn-primary" onclick="showSection('home')">Odkryj</button>
</section>

<!-- === SEKCJA HOME === -->
<section id="home" class="section-home">
    <div class="category-row">
        <h2 class="category-title">Popularne:</h2>
        <div class="movies-slider">
            <button class="scroll-arrow left" onclick="scrollMovies(this.parentElement, -600)">&#10094;</button>
            <div class="movies-grid">
                <?php foreach ($movies as $movie) : ?>
                    <div class="movie-card popular-movie-<?= $movie['id'] ?>" onclick="window.location.href='/movie/show/<?= $movie['id'] ?>'">
                        <div
                                class="fav-badge <?php
                                    if(isset($_SESSION['favorites']) && in_array($movie['id'], $_SESSION['favorites'])){
                                        echo "active";
                                    }
                                ?>"
                                onclick="toggleFav(event, this); toggleSessionFavorite(<?= $movie['id'] ?>)">&#9825;
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="scroll-arrow right" onclick="scrollMovies(this.parentElement, 600)">&#10095;</button>
        </div>
    </div>

    <div class="category-row">
        <h2 class="category-title">Najlepsze:</h2>
        <div class="movies-slider">
            <button class="scroll-arrow left" onclick="scrollMovies(this.parentElement, -600)">&#10094;</button>
            <div class="movies-grid">
                <?php shuffle($movies); ?>
                <?php foreach ($movies as $movie) : ?>
                    <div class="movie-card popular-movie-<?= $movie['id'] ?>" onclick="window.location.href='/movie/show/<?= $movie['id'] ?>'">
                        <div
                                class="fav-badge <?php
                                    if(isset($_SESSION['favorites']) && in_array($movie['id'], $_SESSION['favorites'])){
                                        echo "active";
                                    }
                                ?>"
                                onclick="toggleFav(event, this); toggleSessionFavorite(<?= $movie['id'] ?>)">&#9825;
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="scroll-arrow right" onclick="scrollMovies(this.parentElement, 600)">&#10095;</button>
        </div>
    </div>

    <?php if (!empty($_SESSION['favorites'])): ?>
    <div class="category-row">
        <h2 class="category-title">Ulubione:</h2>
        <div class="movies-slider">
            <button class="scroll-arrow left" onclick="scrollMovies(this.parentElement, -600)">&#10094;</button>
            <div class="movies-grid">
                <?php foreach ($_SESSION['favorites'] as $favId) : ?>
                    <div class="movie-card popular-movie-<?= $favId ?>" onclick="window.location.href='/movie/show/<?= $favId ?>'">
                        <div class="fav-badge active" onclick="toggleFav(event, this); toggleSessionFavorite(this)" movieId="<?= $favId ?>">&#9825;</div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="scroll-arrow right" onclick="scrollMovies(this.parentElement, 600)">&#10095;</button>
        </div>
    </div>
    <?php endif; ?>

</section>
