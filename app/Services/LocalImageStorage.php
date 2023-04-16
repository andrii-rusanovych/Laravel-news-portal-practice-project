<?php
namespace App\Services;

use App\Contracts\ImageStorage;
use App\Exceptions\ImageStorageDeleteException;
use App\Exceptions\ImageStorageStoreException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Str;
use Ramsey\Uuid\Uuid;
class LocalImageStorage implements ImageStorage
{

    /**
     * Store image (resource) in local file system
     *
     * @param UploadedFile $file - Image to be stored
     * @return string
     * @throws ImageStorageStoreException
     */
    public function store(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();

        // Generate a UUID v4
        $uuid = Uuid::uuid4();

        // Convert the UUID to a string and remove hyphens
        $uuidString = str_replace('-', '', $uuid->toString());

        // Generate the filename with the UUID
        $filename = $uuidString . '.' . $extension;

        $path = 'images/' . $filename;


        $stored = Storage::disk('public')->put($path, file_get_contents($file));
        if (!$stored) {
            throw new ImageStorageStoreException("Failed attempt to store an image ". $file->getFilename());
        }
        return $path;
    }

    /**
     * Return url of image
     *
     * @param string $path - Image path in local file system
     * @return string - URL of the image
     */
    public function getUrl(string $path): string
    {
        return asset('storage/images/' . $path);
    }

    public function delete(string $path): void
    {
        $deleted = Storage::disk('local')->delete($path);
        if (!$deleted) {
            throw new ImageStorageDeleteException("Failed attempt delete image ". $path);
        }
    }
}
