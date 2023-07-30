<?php

namespace App\ApplicationService;

use App\Domain\Dao\InterviewDao;
use App\Domain\Dao\ScreeningDao;
use App\Domain\Interview;
use App\Domain\Screening;
use App\Domain\ScreeningStatus;
use Carbon\CarbonImmutable;
use Illuminate\Support\Str;

readonly class ScreeningApplicationService
{
    public function __construct(
        private ScreeningDao $screeningDao,
        private InterviewDao $interviewDao,
    ) {
    }

    /**
     * @throws ApplicationException
     */
    public function startFromPreInterview(string $applicantEmailAddress): void
    {
        if ($this->isEmpty($applicantEmailAddress) || $this->isInvalidFormatEmailAddress($applicantEmailAddress)) {
            throw new ApplicationException('メールアドレスが正しくありません');
        }

        $screening = new Screening();
        $screening->setScreeningId(Str::uuid());
        $screening->setStatus(ScreeningStatus::NotApplied);
        $screening->setApplyDate(null);
        $screening->setApplicantEmailAddress($applicantEmailAddress);

        $this->screeningDao->insert($screening);
    }

    public function apply(string $applicantEmailAddress): void
    {
        if ($this->isEmpty($applicantEmailAddress) || $this->isInvalidFormatEmailAddress($applicantEmailAddress)) {
            throw new ApplicationException('メールアドレスが正しくありません');
        }

        $screening = new Screening();
        $screening->setScreeningId(Str::uuid());
        $screening->setStatus(ScreeningStatus::Interview);
        $screening->setApplyDate(CarbonImmutable::now());
        $screening->setApplicantEmailAddress($applicantEmailAddress);

        $this->screeningDao->insert($screening);
    }

    /**
     * @throws ApplicationException
     */
    public function addNextInterview(string $screeningId, CarbonImmutable $interviewDate): void
    {
        $screening = $this->screeningDao->findScreeningById($screeningId);

        if ($screening->getStatus() !== ScreeningStatus::Interview) {
            throw new ApplicationException('不正な操作です');
        }

        $interviews = $this->interviewDao->findByScreeningId($screeningId);
        $interview = new Interview();
        $interview->setInterviewId(Str::uuid());
        $interview->setScreeningId($screeningId);
        $interview->setInterviewNumber($interviews->count() + 1);
        $interview->setScreeningDate($interviewDate);

        $this->interviewDao->insert($interview);
    }

    private function isEmpty(string $value): bool
    {
        return $value === '';
    }

    private function isInvalidFormatEmailAddress(string $email): bool
    {
        /** @var string $emailRegex */
        $emailRegex = config('mensetsu.email_regex');

        return ! Str::of($email)->isMatch($emailRegex);
    }
}
