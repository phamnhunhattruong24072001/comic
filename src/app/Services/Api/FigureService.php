<?php

namespace App\Services\Api;

use App\Repositories\Contracts\FigureRepository;
use App\Services\BaseService;
class FigureService extends BaseService
{
    protected $figureRepository;
    public function __construct(FigureRepository $figureRepository)
    {
        parent::__construct($figureRepository);
        $this->figureRepository = $figureRepository;
    }
}
