<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Repositories\Contracts\FigureRepository;

class FigureService extends BaseService
{
    protected $figureRepository;
    public function __construct(FigureRepository $figureRepository)
    {
        parent::__construct($figureRepository);
        $this->figureRepository = $figureRepository;
    }

    public function getListFigureByIdComic($param, $id)
    {
        $result = $this->figureRepository->scopeQuery(function ($query) use ($id) {
            $query->where('comic_id', $id);
            return $query;
        });
        $result->orderBy('created_at', 'DESC');
        return $result->paginate($param['limit'], ['*']);
    }
}
