<?php
namespace App\Traits;

use Ramsey\Uuid\Uuid;

trait UuidFileNameGenerator
{
    /**
     * Generates filename using UUID v4
     * (with removed hyphens)
     *
     * @param string $fileExtension file extension, without dot, like 'jpg'
     * @return string filename
     */
    private function generateUUIDFileName(string $fileExtension): string
    {
        // Generate a UUID v4
        $uuid = Uuid::uuid4();

        // Convert the UUID to a string and remove hyphens
        $uuidString = str_replace('-', '', $uuid->toString());

        // Generate the filename with the UUID
        return $uuidString . '.' . $fileExtension;
    }
}
