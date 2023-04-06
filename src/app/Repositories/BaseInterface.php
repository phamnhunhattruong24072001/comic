<?php

namespace App\Repositories;

interface BaseInterface
{
    public function deleteMultiple(array $ids);

    public function forceDeleteMultiple(array $ids);

    public function restoreMultiple(array $ids);
}
