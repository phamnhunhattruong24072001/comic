<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ComicRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface ComicRepository extends RepositoryInterface
{
    public function deleteMultiple(array $ids);

    public function forceDeleteMultiple(array $ids);

    public function restoreMultiple(array $ids);
}
