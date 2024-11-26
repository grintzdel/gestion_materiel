<?php

namespace App\Helpers;

use DateTime;

class Date
{
    public static function validateAndFormatDate(string $date): ?string
    {
        $cleaned_date = htmlspecialchars(trim($date));

        // Valide la date et la convertit au format YYYY-MM-DD
        $d = DateTime::createFromFormat('Y-m-d', $cleaned_date);
        if ($d && $d->format('Y-m-d') === $cleaned_date) {
            return $d->format('Y-m-d');
        }

        return null;
    }
}