<?php
namespace App\Contracts;

use App\Exceptions\ImageStorageDeleteException;
use App\Exceptions\ImageStorageStoreException;
use Illuminate\Http\UploadedFile;

interface ImageStorage
{
    /**
     * Store image (resource)
     *
     * @param UploadedFile $file - Image to be stored
     * @return string
     * @throws ImageStorageStoreException
     */
    public function store(UploadedFile $file): string;

    /**
     * Return url of image
     *
     * @param string $path - Image path depending on implementation
     * @return string - URL of the image
     */
    public function getUrl(string $path): string;

    /**
     * Delete image by $path
     *
     * @param string $path - Path of the image to be deleted
     * @return void
     * @throws ImageStorageDeleteException
     */
    public function delete(string $path): void;

}
