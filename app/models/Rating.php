<?php
require_once BASE_PATH . '/app/core/Database.php';

class Rating {

    public static function getAverageForUtwor($utworId) {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT ROUND(AVG(wartosc), 2) as avg_rating
            FROM ocena
            WHERE utwor_id = ?
        ");
        $stmt->execute([$utworId]);
        return $stmt->fetchColumn() ?? 0;
    }

    public static function add($utworId, $wartosc) {
        if ($wartosc < 1 || $wartosc > 5) {
            return false;
        }

        $db = Database::connect();
        $stmt = $db->prepare("
            INSERT INTO ocena (wartosc, utwor_id)
            VALUES (?, ?)
        ");
        return $stmt->execute([$wartosc, $utworId]);
    }

    public static function getForUtwor($utworId) {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT * FROM ocena WHERE utwor_id = ?
        ");
        $stmt->execute([$utworId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
