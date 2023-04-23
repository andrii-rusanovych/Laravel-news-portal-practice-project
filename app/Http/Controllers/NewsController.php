<?php

namespace App\Http\Controllers;

use ImageStorage;
use App\Http\Requests\StoreNewsItemRequest;
use App\Http\Requests\UpdateNewsItemRequest;
use App\Models\News;
use App\Models\Tags;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(8);
        return view('news.index')->with(['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreNewsItemRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreNewsItemRequest $request)
    {
        $newsItem = new News([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'is_active' => $request->filled('is_active')
        ]);

        $newsItem->image_file_path = ImageStorage::store($request->file('image'));

        $newsItem->save();

        $submittedTags = $this->getSubmittedTags($request->get('tags'));

        $this->createAndAttachTags($newsItem, $submittedTags);

        return Redirect::route('admin.news.edit', ['news'=> $newsItem->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id)
    {
        $newsItem = News::findOrFail($id);
        return view('news.edit', compact('newsItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateNewsItemRequest  $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateNewsItemRequest $request, int $id)
    {
        $newsItem = News::findOrFail($id);
        $newsItem->title = $request->get('title');
        $newsItem->body = $request->get('body');
        $newsItem->is_active = $request->filled('is_active');

        if($request->file('image')) {
            $newsItem->image_file_path = ImageStorage::store($request->file('image'));
        }

        $submittedTags = $this->getSubmittedTags($request->get('tags'));

        $this->updateNewsItemTags($newsItem, $submittedTags);

        $newsItem->update();

        return Redirect::route('admin.news.edit', ['news'=> $newsItem->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  News $news
     * @return RedirectResponse
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index');
    }

    private function getSubmittedTags(?string $tagsString): array
    {
        // Return an empty array if tagsString is null or empty
        if (is_null($tagsString) || trim($tagsString) === '') {
            return [];
        }

        $submittedTags = array_map('trim', explode(',', $tagsString));
        return array_filter($submittedTags, function($tag) {
            return !empty($tag);
        });
    }

    private function createAndAttachTags(News $newsItem, array $tags): void
    {
        foreach ($tags as $tag) {
            $newTag = new Tags(['tag' => $tag]);
            $newsItem->tags()->save($newTag);
        }
    }

    private function updateNewsItemTags(News $newsItem, array $submittedTags): void
    {
        $existingTags = $newsItem->tags()->pluck('tag')->toArray();

        $tagsToAdd = array_diff($submittedTags, $existingTags);
        $tagsToRemove = array_diff($existingTags, $submittedTags);

        Tags::query()->where('news_id', $newsItem->id)->whereIn('tag', $tagsToRemove)->delete();

        $this->createAndAttachTags($newsItem, $tagsToAdd);
    }
}
