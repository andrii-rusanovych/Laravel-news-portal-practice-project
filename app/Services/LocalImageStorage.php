<?php
namespace App\Services;

use App\Contracts\ImageStorage;
use App\Exceptions\ImageStorageDeleteException;
use App\Exceptions\ImageStorageStoreException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Str;
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
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        // Generate a unique filename using original filename, timestamp and a random string
        $filename = $originalFilename . '-' . time() . '-' . Str::random(8) . '.' . $extension;
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
