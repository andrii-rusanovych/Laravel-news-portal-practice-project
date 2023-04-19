<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Tags;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Traits\UuidFileNameGenerator;

class NewsSeeder extends Seeder
{
    use UuidFileNameGenerator;
    private const NUMBER_OF_NEWS = 20;

    private const BASE_IMAGE_PATH_NAME = 'news_image_for_seeder';
    private const BASE_IMAGE_PATH_EXTENSION = 'jpg';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < self::NUMBER_OF_NEWS; $i++) {
            $newsItem = News::factory()->make();

            $newsItem->image_file_path = $this->getNewCopiedImagePath();

            $newsItem->save();
        }

        $tags = Tags::factory()->count(100)->make();

        foreach ($tags as $tag) {
            $randomNewsItem = News::query()->inRandomOrder()->first();
            $randomNewsItem->body = $randomNewsItem->body. ' '.$tag->tag;

            $randomNewsItem->tags()->save($tag);
        }
    }

    /**
     * Reverse the database seeds.
     * Delete all attached images to news
     *
     * @return void
     */
    public function down()
    {
        // Delete news images from the public disk
        $news = News::all();
        foreach ($news as $item) {
            $imagePath = $item->image_file_path;
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Delete all news and tags
        DB::table('tags')->delete();
        DB::table('news')->delete();
    }

    /**
     * Copies example image from local disk and store it in 'public' disc under /images/
     * Returns new copied image file path in 'public' disc
     *
     * @return string
     */
    private function getNewCopiedImagePath(): string
    {
        $baseImagePath = './'.self::BASE_IMAGE_PATH_NAME.'.'.self::BASE_IMAGE_PATH_EXTENSION;

        // Copy the base image, rename it, and save it to the public disk
        $newImageName = $this->generateUUIDFileName(self::BASE_IMAGE_PATH_EXTENSION);
        Storage::copy($baseImagePath, 'public/images/'.$newImageName);

        return 'images/' . $newImageName;
    }
}
