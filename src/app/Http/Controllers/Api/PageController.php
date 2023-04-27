<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\CategoryService;
use App\Services\Api\CountryService;
use App\Services\Api\ComicService;
use App\Services\Api\ChapterService;
use App\Services\Api\GenreService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

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
        try {
            $comic = $this->comicService->findComicBySlugApi($slug);
            if (!$comic) {
                return $this->sendError(Response::HTTP_NOT_FOUND, 'Not Found');
            }
            $commentTotal = $comic->comments->count();
            $comic->increment('view');
            $data = [
                'comic' => $comic,
                'commentTotal' => $commentTotal
            ];
            return $this->sendResult(Response::HTTP_OK, trans('comic.detail_title'), $data);
        } catch (Exception $e) {
            logger($e->getMessage());
            return $this->sendError(Response::HTTP_INTERNAL_SERVER_ERROR, 'error');
        }
    }


    public function ViewChapterPageApi($slugComic, $slugChapter)
    {
        $this->data['comic'] = $this->comicService->findComicBySlugApi($slugComic);
        if ($this->data['comic'] && $this->data['comic']->status == 2) {
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
        } else {
            return $this->sendError(Response::HTTP_BAD_REQUEST, 'Not Request');
        }
    }

    public function GenrePageApi($slug = null)
    {
        $params = [
            'limit' => 15,
            'page' => 1,
            'genres' => [],
            'countries' => [],
            'categories' => [],
            'softField' => 'latest_chapter_time',
            'softType' => 'DESC',
        ];
        $this->data['comics'] = $this->comicService->getFilterComicPaginateApi($slug, $params);
        if ($slug) {
            $this->data['genre'] = $this->genreService->findModelByField('slug', $slug, ['name']);
        }
        $this->data['genres'] = $this->genreService->getGenreHasComicApi(['id', 'name', 'slug']);
        return $this->sendResult(Response::HTTP_OK, 'Genre Page', $this->data);
    }

    public function CountryPageApi($slug = null)
    {
        $params = [
            'limit' => 15,
            'page' => 1,
            'genres' => [],
            'countries' => [],
            'categories' => [],
            'softField' => 'latest_chapter_time',
            'softType' => 'DESC',
        ];
        $this->data['comics'] = $this->comicService->getFilterComicPaginateApi($slug, $params);
        if ($slug) {
            $this->data['country'] = $this->countryService->findModelByField('slug', $slug, ['name']);
        }
        $this->data['countries'] = $this->countryService->getCountryHasComic(['id', 'name', 'slug', 'avatar']);
        return $this->sendResult(Response::HTTP_OK, 'Country Page', $this->data);
    }

    public function GetAllComicApi()
    {
        $params = [
            'limit' => 15,
            'page' => 1,
            'genres' => [],
            'countries' => [],
            'categories' => [],
            'softField' => 'latest_chapter_time',
            'softType' => 'DESC',
        ];
        $this->data['comics'] = $this->comicService->getFilterComicPaginateApi('', $params);
        $this->data['countries'] = $this->countryService->getCountryHasComic(['id', 'name', 'slug', 'avatar']);
        $this->data['categories'] = $this->categoryService->getCategoryHasComicApi(['id', 'name', 'slug']);
        $this->data['genres'] = $this->genreService->getGenreHasComicApi(['id', 'name', 'slug']);
        return $this->sendResult(Response::HTTP_OK, 'All Comic Page', $this->data);
    }

    public function CategoryPageApi($slug = null)
    {
        $params = [
            'limit' => 15,
            'page' => 1,
            'genres' => [],
            'countries' => [],
            'categories' => [],
            'softField' => 'latest_chapter_time',
            'softType' => 'DESC',
        ];
        $this->data['comics'] = $this->comicService->getFilterComicPaginateApi($slug, $params);
        if ($slug) {
            $this->data['category'] = $this->categoryService->findModelByField('slug', $slug, ['name']);
        }
        $this->data['categories'] = $this->categoryService->getCategoryHasComicApi(['id', 'name', 'slug']);
        return $this->sendResult(Response::HTTP_OK, 'Category Page', $this->data);
    }

    public function FilterComicApi(Request $request)
    {
        $data = $request->all();
        $params = [
            'limit' => 15,
            'page' => $data['pageNum'],
            'genres' => $data['genres'],
            'countries' => $data['countries'],
            'categories' => $data['categories'],
            'softField' => $data['softField'],
            'softType' => $data['softType'],
        ];
        $this->data['comics'] = $this->comicService->getFilterComicPaginateApi('', $params);
        return $this->sendResult(Response::HTTP_OK, 'Genre Filter Page', $this->data);
    }
}
