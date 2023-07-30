<?php

namespace App\Domain;

use Carbon\CarbonImmutable;
use Illuminate\Support\Str;

class Interview
{
    private string $interviewId;

    private CarbonImmutable $interviewDate;

    private int $interviewNumber;

    private ScreeningStepResult $screeningStepResult;

    public function __construct(CarbonImmutable $interviewDate, int $interviewNumber)
    {
        $this->interviewDate = $interviewDate;
        $this->interviewNumber = $interviewNumber;
        $this->interviewId = Str::uuid();
        $this->screeningStepResult = ScreeningStepResult::NotEvaluated;
    }

    public function getInterviewId(): string
    {
        return $this->interviewId;
    }

    public function getInterviewDate(): CarbonImmutable
    {
        return $this->interviewDate;
    }

    public function getInterviewNumber(): int
    {
        return $this->interviewNumber;
    }

    public function getScreeningStepResult(): ScreeningStepResult
    {
        return $this->screeningStepResult;
    }
}
