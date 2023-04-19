<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsItemRequest;
use App\Models\News;
//use Illuminate\Contracts\Foundation\Application;
//use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
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
     * @param  HttpRequest  $request
     * @param int $id
     * @return HttpResponse
     */
    public function update(HttpRequest $request, int $id)
    {
        //
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
