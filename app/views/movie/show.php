<!-- views/movie/show.php -->

<section id="details" class="section-details">
    <div class="details-container">

        <div class="mobile-fav-section">
            Dodaj do ulubionych ❤️
        </div>

        <div class="details-poster-hero" style="/*background-image: url('link-do-plakatu.jpg');*/">
            <div class="details-poster-overlay">
                <h1 class="movie-title-hero"><?= htmlspecialchars($movie['tytul']) ?></h1>
                <div class="movie-rating-hero">Średnia ocen - <?= $avgRating ?> / 5.00</div>
            </div>
        </div>

        <div class="mobile-user-rating">
            Twoja ocena<br>
            <span class="stars">☆☆☆☆☆</span>
        </div>

        <div class="details-content">
            <h1 class="movie-title"><?= htmlspecialchars($movie['tytul']) ?></h1>
            <div class="movie-rating">Średnia ocen - <?= $avgRating ?> / 5.00</div>
            <hr>

            <p class="details-desc">
            <div>Pobierane z bazy danych - opis to span z klasą "movie-description" (poki co nie ma w bazie)</div>
            <b>Opis:</b><span class="movie-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</span>
            </p>
            <hr>
            <div class="details-meta">
                <b>Dostępny w:</b><br>
                <ul class="list-movie-platforms">
                    <?php foreach ($movie['platformy'] as $p): ?>
                        <li><span class="movie-platforms-name"><?= $p['nazwa_serwisu'] ?></span><span class="movie-platform-details" style="font-style: italic">brak detali</span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <hr>
            <div class="details-meta">
                <b>Szczegóły:</b><br>

                Reżyser:
                <?php
                $total = count($movie['rezyserzy']);
                $counter = 0;
                foreach ($movie['rezyserzy'] as $r):
                    $counter++;
                    ?>
                    <span class="movie-director"><?= $r; ?></span><?php if ($counter < $total) echo ", "; ?>
                <?php endforeach; ?>
                <br>
                Aktorzy:
                <?php
                $total = count($movie['aktorzy']);
                $counter = 0;
                foreach ($movie['aktorzy'] as $a):
                    $counter++;
                    ?>
                    <span class="movie-actors"><?= $a; ?></span><?php if ($counter < $total) echo ", "; ?>
                <?php endforeach; ?>
                <br>
                Gatunek: <span class="movie-genre"><?= $movie['gatunek']; ?></span><br>
                Rok produkcji: <span class="movie-year"><?= $movie['rok_produkcji']; ?></span>
            </div>
            <hr>
            <div class="comments-section">
                <h3 class="category-title" style="font-size: 1.5rem;">Komentarze:</h3>

                <?php foreach ($comments as $comment): ?>
                    <div class="comment-box">
                        <div class="avatar"></div>
                        <div>
                            <strong><?= htmlspecialchars($comment['autor_podpis']) ?></strong><br>
                            <?= nl2br(htmlspecialchars($comment['tresc'])) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <form class="comment-form">
                    <label class="comment-file-input">
                        <span class="file-text" style="font-size: 0.8rem; margin-top: 5px;">Zdjęcie profilowe</span><br>
                        <span style="font-weight: 700; background: #232867; padding: 5px 10px; border-radius: 4px;">Wybierz plik</span>
                        <span class="file-text" style="font-size: 0.8rem; margin-top: 5px;">Nie wybrano pliku</span>
                        <input type="file" accept="image/*" style="display: none;" onchange="this.parentElement.querySelector('.file-text').textContent = this.files[0] ? this.files[0].name : 'Nie wybrano pliku'">
                    </label>
                    <textarea class="comment-nickname" placeholder="Twoja nazwa"></textarea>
                    <textarea class="comment-input" placeholder="Dodaj komentarz..."></textarea>
                    <button id="form-submit" type="submit" class="btn-primary-comment" style="margin-top: 0.5rem;">Dodaj komentarz</button>
                </form>
                <script>
                    const form = document.querySelector('.comment-form');
                    const formId = <?= $movie['id']; ?>;
                    const formName = document.querySelector('.comment-nickname');
                    const formComment = document.querySelector('.comment-input');

                    // const button = document.getElementById('form-submit');

                    form.addEventListener('submit', (e) => {
                        e.preventDefault();

                        const formData = new FormData();

                        formData.append('utwor_id', formId);
                        formData.append('autor', formName.value);
                        formData.append('tresc', formComment.value);

                        const fileInput = document.querySelector('.comment-file-input input');
                        if(fileInput.files.length > 0){
                            formData.append('image', fileInput.files[0]);
                        }

                        fetch('/comment/add', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                            .then(res => res.json()) // teraz PHP zwraca JSON
                            .then(data => console.log(data))
                            .catch(err => console.error(err));

                        location.reload();
                    });
                </script>
            </div>
        </div>

        <div class="details-sidebar">
            <div onclick="toggleSessionFavorite(<?= $movie['id'] ?>)" style="margin: 1rem 0; text-align: center; font-weight: 700; font-size: 1.2rem; cursor: pointer">
                <?php
                    if(isset($_SESSION['favorites']) && in_array($movie['id'], $_SESSION['favorites'])){
                        echo "Usuń z ulubionych 💔";
                    }
                    else{
                        echo "Dodaj do ulubionych ❤️";
                    }
                ?>
            </div>
            <div class="poster-placeholder">PLAKAT</div>
            <div style="margin-top: 1rem; text-align: center;">
                Twoja ocena<br>☆☆☆☆☆
            </div>
        </div>
    </div>
</section>