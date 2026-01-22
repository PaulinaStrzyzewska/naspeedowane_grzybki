<?php
require_once BASE_PATH . '/app/models/Rating.php';

class RatingController {

    public function add() {
        $utworId = $_POST['utwor_id'];
        $wartosc = $_POST['wartosc'];

        Rating::add($utworId, $wartosc);

        header("Location: /movie/show/$utworId");
        exit;
    }
}
