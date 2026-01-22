<?php
require_once BASE_PATH . '/app/core/Database.php';

class Comment {

    public static function getByUtwor($utworId) {
        $db = Database::connect();
        $stmt = $db->prepare("
            SELECT * FROM komentarz
            WHERE utwor_id = ?
            ORDER BY data_dodania DESC
        ");
        $stmt->execute([$utworId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function add($utworId, $autor, $tresc) {
        if (strlen($tresc) < 3 || strlen($tresc) > 500) {
            return false;
        }

        $db = Database::connect();
        $stmt = $db->prepare("
            INSERT INTO komentarz (tresc, autor_podpis, data_dodania, utwor_id)
            VALUES (?, ?, datetime('now'), ?)
        ");
        return $stmt->execute([$tresc, $autor, $utworId]);
    }
}
