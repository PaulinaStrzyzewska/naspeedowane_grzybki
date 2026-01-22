<?php
require_once BASE_PATH . '/app/core/Database.php';

class Movie {

    public static function find($id) {
        $db = Database::connect();

        $stmt = $db->prepare("SELECT * FROM utwor WHERE id = ?");
        $stmt->execute([$id]);
        $movie = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$movie) return null;

        // Aktorzy
        $movie['aktorzy'] = $db->query("
            SELECT a.imie_nazwisko FROM aktor a
            JOIN utwor_aktor ua ON ua.aktor_id = a.id
            WHERE ua.utwor_id = '$id'
        ")->fetchAll(PDO::FETCH_COLUMN);

        // Reżyserzy
        $movie['rezyserzy'] = $db->query("
            SELECT r.imie_nazwisko FROM rezyser r
            JOIN utwor_rezyser ur ON ur.rezyser_id = r.id
            WHERE ur.utwor_id = '$id'
        ")->fetchAll(PDO::FETCH_COLUMN);

        // Platformy
        $movie['platformy'] = $db->query("
            SELECT p.nazwa_serwisu, p.url FROM platforma_streamingowa p
            JOIN utwor_platforma up ON up.platforma_id = p.id
            WHERE up.utwor_id = '$id'
        ")->fetchAll(PDO::FETCH_ASSOC);

        $movie['test'] = $db->query("
            SELECT * FROM ocena
        ")->fetchAll(PDO::FETCH_ASSOC);

        return $movie;
    }

    public static function getPopular($limit = 10) {
        $db = Database::connect();

        $stmt = $db->prepare("
        SELECT u.*
        FROM utwor u
        LEFT JOIN ocena o ON o.utwor_id = u.id
        GROUP BY u.id
        ORDER BY AVG(o.wartosc) DESC
        LIMIT ?
    ");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
