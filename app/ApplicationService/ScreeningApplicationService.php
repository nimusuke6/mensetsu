<?php

namespace App\ApplicationService;

use App\Domain\ApplicationException;
use App\Domain\Screening;
use App\Domain\ScreeningRepository;
use Carbon\CarbonImmutable;

readonly class ScreeningApplicationService
{
    public function __construct(
        private ScreeningRepository $screeningRepository,
    ) {
    }

    /**
     * @throws ApplicationException
     */
    public function startFromPreInterview(string $applicantEmailAddress): void
    {
        $screening = Screening::startFromPreInterview($applicantEmailAddress);
        $this->screeningRepository->insert($screening);
    }

    /**
     * @throws ApplicationException
     */
    public function apply(string $applicantEmailAddress): void
    {
        $screening = Screening::apply($applicantEmailAddress);
        $this->screeningRepository->insert($screening);
    }

    /**
     * @throws ApplicationException
     */
    public function addNextInterview(string $screeningId, CarbonImmutable $interviewDate): void
    {
        $screening = $this->screeningRepository->findScreeningById($screeningId);
        $screening->addNextInterview($interviewDate);
        $this->screeningRepository->update($screening);
    }
}
