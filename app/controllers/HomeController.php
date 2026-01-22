<?php
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/Movie.php';

class HomeController extends Controller {
    public function index() {
        $movies = Movie::getPopular();
        $this->view('home/index', compact('movies'));
    }
}
