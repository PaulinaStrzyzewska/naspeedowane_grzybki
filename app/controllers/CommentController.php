<?php
require_once BASE_PATH . '/app/models/Comment.php';

class CommentController {

    public function add() {
        // jeśli wysyłasz FormData, dane są w $_POST
        $utworId = $_POST['utwor_id'] ?? null;
        $autor = $_POST['autor'] ?? '';
        $tresc = $_POST['tresc'] ?? '';

        $success = Comment::add($utworId, $autor, $tresc);

        // Sprawdzenie czy AJAX
        $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

        if($isAjax){
            echo json_encode(['success' => $success]);
            exit;
        }

        exit;
    }
}
