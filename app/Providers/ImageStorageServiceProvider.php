<?php

namespace App\Providers;

use App\Contracts\ImageStorage;
use App\Services\LocalImageStorage;
use Illuminate\Support\ServiceProvider;

class ImageStorageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, function () {
            return new LocalImageStorage();
        });
    }

    public function boot(): void
    {
    }
}
