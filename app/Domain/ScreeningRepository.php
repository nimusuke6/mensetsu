<?php

namespace App\Domain;

interface ScreeningRepository
{
    public function findScreeningById(string $screeningId): Screening;

    public function insert(Screening $screening): void;

    public function update(Screening $screening): void;
}
