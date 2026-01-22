<?php

class Controller {
    protected function view($path, $data = []) {
        extract($data);

        require BASE_PATH . '/app/views/layout/header.php';
        require BASE_PATH . "/app/views/$path.php";
        require BASE_PATH . '/app/views/layout/footer.php';
    }
}
