<?php
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/Movie.php';
require_once BASE_PATH . '/app/models/Comment.php';
require_once BASE_PATH . '/app/models/Rating.php';

class MovieController extends Controller {
    public function show($id) {
        $movie = Movie::find($id);
        $comments = Comment::getByUtwor($id);
        $avgRating = Rating::getAverageForUtwor($id);

        $this->view('movie/show', compact('movie', 'comments', 'avgRating'));
    }

}
