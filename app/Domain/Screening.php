<?php

namespace App\Domain;

use Carbon\CarbonImmutable;

class Screening
{
    private string $screeningId;

    private ?CarbonImmutable $applyDate;

    private ScreeningStatus $status;

    private string $applicantEmailAddress;

    public function getScreeningId(): string
    {
        return $this->screeningId;
    }

    public function setScreeningId(string $screeningId): void
    {
        $this->screeningId = $screeningId;
    }

    public function getApplyDate(): ?CarbonImmutable
    {
        return $this->applyDate;
    }

    public function setApplyDate(?CarbonImmutable $applyDate): void
    {
        $this->applyDate = $applyDate;
    }

    public function getStatus(): ScreeningStatus
    {
        return $this->status;
    }

    public function setStatus(ScreeningStatus $status): void
    {
        $this->status = $status;
    }

    public function getApplicantEmailAddress(): string
    {
        return $this->applicantEmailAddress;
    }

    public function setApplicantEmailAddress(string $applicantEmailAddress): void
    {
        $this->applicantEmailAddress = $applicantEmailAddress;
    }
}
