<?php

namespace App\Domain\Dao;

use App\Domain\Interview;
use Illuminate\Support\Collection;

class InterviewDao
{
    /**
     * @return Collection<Interview>
     */
    public function findByScreeningId(string $screeningId): Collection
    {
        return Collection::empty();
    }

    public function insert(Interview $interview): void
    {
        //
    }
}
