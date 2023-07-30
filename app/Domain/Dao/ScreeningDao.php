<?php

namespace App\Domain\Dao;

use App\Domain\Screening;

class ScreeningDao
{
    public function findScreeningById(string $screeningId): Screening
    {
        return new Screening();
    }

    public function insert(Screening $screening): void
    {
        //
    }
}
