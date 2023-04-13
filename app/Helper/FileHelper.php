<?php

namespace App\Helper;

class FileHelper
{
    /**
     * getStorePathThumbnail
     *
     * @param  int $userId
     * @param  string $type
     * @return void
     */
    public static function getStorePathThumbnail(int $userId, string $type, int $typeId)
    {
        return "users/$userId/$type/$typeId/thumbnail";
    }
}
