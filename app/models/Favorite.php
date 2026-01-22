<?php

class Favorite {

    public static function getAll() {
        return $_SESSION['favorites'] ?? [];
    }

    public static function toggle($utworId) {
        $_SESSION['favorites'] ??= [];

        if (in_array($utworId, $_SESSION['favorites'])) {
            $_SESSION['favorites'] = array_diff(
                $_SESSION['favorites'],
                [$utworId]
            );
        } else {
            $_SESSION['favorites'][] = $utworId;
        }
    }
}
