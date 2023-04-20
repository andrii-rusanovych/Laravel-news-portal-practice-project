<?php
namespace App\Helpers;

class DatabaseHelper {
    public const MYSQL_MEDIUMTEXT_LENGTH = 16777215;

    public static function maxCharactersCountForMysqlMediumText(): int
    {
        //including 3 bytes used to store the length information
        //4 bytes per character - utf8_mb4
        return (self::MYSQL_MEDIUMTEXT_LENGTH - 3) / 4;
    }
}
