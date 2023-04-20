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
        $news = News::paginate(8);
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
        $newsItem = new News();
        $newsItem->title = $request->get('title');
        $newsItem->body = $request->get('body');
        $newsItem->is_active = $request->get('is_active');

        $newsItem->image_file_path = ImageStorage::store($request->file('image'));

        $newsItem->save();

        return Redirect::route('news.edit', ['news'=> $newsItem->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return HttpResponse
     */
    public function show(int $id)
    {
        //
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
        $newsItem->is_active = filled($request->get('is_active'));

        if($request->file('image')) {
            $newsItem->image_file_path = ImageStorage::store($request->file('image'));
        }

        $submittedTags = array_map('trim', explode(',', $request->get('tags')));
        $submittedTags = array_filter($submittedTags, function($tag) {
            return !empty($tag);
        });

        // Fetch existing tags associated with the news item
        $existingTags = $newsItem->tags->pluck('tag')->toArray();

        // Identify tags to add and remove
        $tagsToAdd = array_diff($submittedTags, $existingTags);
        $tagsToRemove = array_diff($existingTags, $submittedTags);

        // Delete the tags that were removed
        Tags::query()->where('news_id', $id)->whereIn('tag', $tagsToRemove)->delete();

        // Create and attach new tags
        foreach ($tagsToAdd as $tag) {
            $newTag = new Tags(['tag' => $tag]);
            $newsItem->tags()->save($newTag);
        }

        $newsItem->update();

        return Redirect::route('news.edit', ['news'=> $newsItem->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return HttpResponse
     */
    public function destroy($id)
    {
        //
    }
}
