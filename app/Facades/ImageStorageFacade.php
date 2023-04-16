<?php

namespace App\Facades;

use App\Contracts\ImageStorage;
use Illuminate\Support\Facades\Facade;

class ImageStorageFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return ImageStorage::class;
    }
}
