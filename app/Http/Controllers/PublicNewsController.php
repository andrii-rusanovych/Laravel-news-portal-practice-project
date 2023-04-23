<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Tags;
use DOMDocument;
use DOMXPath;
use Illuminate\Contracts\View\View;

class PublicNewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_active', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('public.news.index', compact('news'));
    }

    /**
     * @param News $news
     * @return View|never
     */
    public function show(News $news){

        //do not show article if it is not active
        if (!$news->is_active) {
            return abort(404);
        }

        $previous = News::where('is_active', '=', true)
            ->where('created_at', '<', $news->created_at)
            ->orderBy('created_at', 'desc')
            ->first();

        $next = News::where('is_active', '=', true)
            ->where('created_at', '>', $news->created_at)
            ->orderBy('created_at', 'asc')
            ->first();

        $tagsContainedInBody = Tags::query()->where('tags.news_id', '!=', $news->id)
            ->whereRaw('Exists (select news.id from news where news.id = tags.news_id and news.is_active = true)')
            ->whereRaw(
            "EXISTS (
                SELECT 1
                FROM news
                WHERE news.id = ?
                AND news.body RLIKE CONCAT('\\\\b', tags.tag, '\\\\b')
                AND news.body NOT REGEXP CONCAT('<a[^>]*>[\s\S]*\b', tags.tag, '\b[\s\S]*<\/a>')
            )",
            [$news->id]
        )->get();

        $wrappedBody = $this->wrapTagsWithLinks($news->body, $tagsContainedInBody);

        return view('public.news.show')->with([
            'newsItem' => $news,
            'previousNewsItem' => $previous,
            'nextNewsItem' => $next,
            'wrappedBody' => $wrappedBody
        ]);
    }

    /**
     * Wrap tags with links in the provided HTML body.
     *
     * @param string $body The HTML body containing the text to be processed.
     * @param array $tags An array of tags, each tag should be an object with properties: tag and news_id.
     * @return string The processed HTML body with tags wrapped in links.
     */
    private function wrapTagsWithLinks($body, $tags)
    {
        // Create a new DOMDocument and load the HTML body with proper encoding
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $body);

        // Create a new DOMXPath object to query the DOM
        $xpath = new DOMXPath($dom);

        // Query all text nodes that are not descendants of an <a> element
        $textNodes = $xpath->query("//text()[not(ancestor::a)]");

        // Loop through each text node
        foreach ($textNodes as $textNode) {
            // Store the original text node value
            $newText = $textNode->nodeValue;

            // Loop through each tag
            foreach ($tags as $tag) {
                // Escape the tag for use in a regular expression
                $escapedTag = preg_quote($tag->tag, '/');
                // Create a regular expression pattern to match the whole word of the tag
                $pattern = "/\\b(" . $escapedTag . ")\\b/u";
                // Create a replacement string with the link to the news item
                $replacement = '<a href="' . route('public.news.show', ['news' => $tag->news_id]) . '">$1</a>';
                // Replace the tag in the text node value with the link
                $newText = preg_replace($pattern, $replacement, $newText);
            }

            // If the text node value has changed
            if ($newText !== $textNode->nodeValue) {
                // Create a new document fragment and append the new text node value
                $fragment = $dom->createDocumentFragment();
                $fragment->appendXML('<![CDATA[' . $newText . ']]>');

                // Replace the original text node with the new document fragment
                if ($textNode->parentNode !== null) {
                    $textNode->parentNode->replaceChild($fragment, $textNode);
                }
            }
        }

        // Return the processed HTML body
        return $dom->saveHTML();
    }
}
