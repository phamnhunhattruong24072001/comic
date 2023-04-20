<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\CategoryService;
use App\Services\Api\CountryService;
use App\Services\Api\ComicService;
use App\Services\Api\ChapterService;
use App\Services\Api\GenreService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageController extends Controller
{
    protected $comicService;
    protected $chapterService;
    protected $genreService;
    protected $countryService;
    protected $categoryService;

    public function __construct(
        ComicService    $comicService,
        ChapterService  $chapterService,
        GenreService    $genreService,
        CategoryService $categoryService,
        CountryService  $countryService
    )
    {
        $this->comicService = $comicService;
        $this->chapterService = $chapterService;
        $this->genreService = $genreService;
        $this->categoryService = $categoryService;
        $this->countryService = $countryService;
    }

    public function HomePageApi()
    {
        $this->data['comic_new'] = $this->comicService->getAllComicNewApi(['*'], 9, true);
        $this->data['comic_coming_soon'] = $this->comicService->getAllComicComingSoonApi(['*'], 9, true);
        $this->data['comic_highlight'] = $this->comicService->getAllComicHighlightApi(['*'], 5, true);
        $this->data['comic_top_view'] = $this->comicService->getAllComicTopViewApi(['*'], 3, true);
        return $this->sendResult(Response::HTTP_OK, 'Home', $this->data);
    }

    public function RightContentApi()
    {
        $this->data['comic_highlight'] = $this->comicService->getAllComicHighlightApi(['*'], 5, true);
        $this->data['comic_top_view'] = $this->comicService->getAllComicTopViewApi(['*'], 3, true);
        return $this->sendResult(Response::HTTP_OK, 'Right Content', $this->data);
    }

    public function DetailPageApi($slug)
    {
        $this->data['comic'] = $this->comicService->findComicBySlugApi($slug);
        $this->data['comic']->increment('view');
        return $this->sendResult(Response::HTTP_OK, trans('comic.detail_title'), $this->data);
    }

    public function ViewChapterPageApi($slugComic, $slugChapter)
    {
        $this->data['comic'] = $this->comicService->findComicBySlugApi($slugComic);
        $chapters = $this->data['comic']->chapters;
        foreach ($chapters as $key => $value) {
            if ($value->slug == $slugChapter) {
                $this->data['preChapter'] = $chapters[$key];
                $this->data['nextChapter'] = $chapters[$key];
                if (isset($chapters[$key + 1])) {
                    $this->data['preChapter'] = $chapters[$key + 1];
                }
                if (isset($chapters[$key - 1])) {
                    $this->data['nextChapter'] = $chapters[$key - 1];
                }
            }
        }
        $this->data['chapter'] = $this->chapterService->findBySlugChapterAndComic($slugComic, $slugChapter);
        return $this->sendResult(Response::HTTP_OK, 'Show Chapter', $this->data);
    }

    public function GenrePageApi($slug = null)
    {
        $params = [
            'limit' => 15,
            'page' => 1,
            'slugArr' => [],
            'countries' => [],
            'categories' => [],
            'softField' => 'created_at',
            'softType' => 'DESC',
        ];
        $this->data['comics'] = $this->comicService->getFilterComicPaginateApi($slug, $params);
        if ($slug) {
            $this->data['genre'] = $this->genreService->findModelByField('slug', $slug, ['name']);
        }
        $this->data['genres'] = $this->genreService->getGenreHasComicApi(['id', 'name', 'slug']);
        $this->data['countries'] = $this->countryService->getCountryHasComic(['id', 'name', 'slug']);
        $this->data['categories'] = $this->categoryService->getCategoryHasComicApi(['id', 'name', 'slug']);
        return $this->sendResult(Response::HTTP_OK, 'Genre Page', $this->data);
    }

    public function FilterComicApi(Request $request)
    {
        $data = $request->all();
        $params = [
            'limit' => 15,
            'page' => $data['pageNum'],
            'slugArr' => $data['slugArr'],
            'countries' => $data['countries'],
            'categories' => $data['categories'],
            'softField' => $data['softField'],
            'softType' => $data['softType'],
        ];
        $this->data['comics'] = $this->comicService->getFilterComicPaginateApi('', $params);
        return $this->sendResult(Response::HTTP_OK, 'Genre Filter Page', $this->data);
    }
}
