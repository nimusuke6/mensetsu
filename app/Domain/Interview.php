<?php

namespace App\Domain;

use Carbon\CarbonImmutable;

class Interview
{
    private string $interviewId;

    private string $screeningId;

    private CarbonImmutable $screeningDate;

    private int $interviewNumber;

    private ScreeningStepResult $screeningStepResult;

    private int $recruiterId;

    public function getInterviewId(): string
    {
        return $this->interviewId;
    }

    public function setInterviewId(string $interviewId): void
    {
        $this->interviewId = $interviewId;
    }

    public function getScreeningId(): string
    {
        return $this->screeningId;
    }

    public function setScreeningId(string $screeningId): void
    {
        $this->screeningId = $screeningId;
    }

    public function getScreeningDate(): CarbonImmutable
    {
        return $this->screeningDate;
    }

    public function setScreeningDate(CarbonImmutable $screeningDate): void
    {
        $this->screeningDate = $screeningDate;
    }

    public function getInterviewNumber(): int
    {
        return $this->interviewNumber;
    }

    public function setInterviewNumber(int $interviewNumber): void
    {
        $this->interviewNumber = $interviewNumber;
    }

    public function getScreeningStepResult(): ScreeningStepResult
    {
        return $this->screeningStepResult;
    }

    public function setScreeningStepResult(ScreeningStepResult $screeningStepResult): void
    {
        $this->screeningStepResult = $screeningStepResult;
    }

    public function getRecruiterId(): int
    {
        return $this->recruiterId;
    }

    public function setRecruiterId(int $recruiterId): void
    {
        $this->recruiterId = $recruiterId;
    }
}
