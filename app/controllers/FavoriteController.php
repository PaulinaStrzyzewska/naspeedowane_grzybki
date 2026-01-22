<?php
require_once BASE_PATH . '/app/models/Favorite.php';

class FavoriteController {

    public function toggle() {
        $utworId = $_POST['utwor_id'];
        Favorite::toggle($utworId);

        echo json_encode([
            'status' => 'ok',
            'favorites' => Favorite::getAll()
        ]);
    }
}
