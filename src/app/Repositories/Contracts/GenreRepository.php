<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface GenreRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface GenreRepository extends RepositoryInterface
{
    public function deleteMultiple(array $ids);

    public function forceDeleteMultiple(array $ids);

    public function restoreMultiple(array $ids);
}
