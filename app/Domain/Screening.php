<?php

namespace App\Domain;

use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Screening
{
    private string $screeningId;

    private ?CarbonImmutable $applyDate;

    private ScreeningStatus $status;

    private string $applicantEmailAddress;

    /** @var Collection<int, Interview> */
    private Collection $interviews;

    private function __construct()
    {
    }

    /**
     * @throws ApplicationException
     */
    public static function startFromPreInterview(string $applicantEmailAddress): self
    {
        if (self::isEmpty($applicantEmailAddress) || self::isInvalidFormatEmailAddress($applicantEmailAddress)) {
            throw new ApplicationException('メールアドレスが正しくありません');
        }

        $screening = new Screening();
        $screening->screeningId = Str::uuid();
        $screening->interviews = Collection::empty();
        $screening->applicantEmailAddress = $applicantEmailAddress;

        // ① 初期ステータスは「未応募」
        $screening->status = ScreeningStatus::NotApplied;
        // ② 応募日はブランク
        $screening->applyDate = null;

        return $screening;
    }

    /**
     * @throws ApplicationException
     */
    public static function apply(string $applicantEmailAddress): self
    {
        if (self::isEmpty($applicantEmailAddress) || self::isInvalidFormatEmailAddress($applicantEmailAddress)) {
            throw new ApplicationException('メールアドレスが正しくありません');
        }

        $screening = new Screening();
        $screening->screeningId = Str::uuid();
        $screening->interviews = Collection::empty();
        $screening->applicantEmailAddress = $applicantEmailAddress;

        // ③ 初期ステータスは「選考中」
        $screening->status = ScreeningStatus::Interview;
        // ④ 応募日は登録日
        $screening->applyDate = CarbonImmutable::now();

        return $screening;
    }

    /**
     * @throws ApplicationException
     */
    public function addNextInterview(CarbonImmutable $interviewDate): void
    {
        // ① 選考ステータスが「選考中」以外のときには設定できない
        if ($this->status !== ScreeningStatus::Interview) {
            throw new ApplicationException('不正な操作です');
        }

        // ② 面接次数は1からインクリメントされる
        $nextInterviewNumber = $this->interviews->count() + 1;
        $nextInterview = new Interview($interviewDate, $nextInterviewNumber);

        $this->interviews->push($nextInterview);
    }

    public function getScreeningId(): string
    {
        return $this->screeningId;
    }

    public function getApplyDate(): ?CarbonImmutable
    {
        return $this->applyDate;
    }

    public function getStatus(): ScreeningStatus
    {
        return $this->status;
    }

    public function getApplicantEmailAddress(): string
    {
        return $this->applicantEmailAddress;
    }

    /**
     * @return Collection<int, Interview>
     */
    public function getInterviews(): Collection
    {
        return $this->interviews;
    }

    private static function isEmpty(string $value): bool
    {
        return $value === '';
    }

    private static function isInvalidFormatEmailAddress(string $email): bool
    {
        /** @var string $emailRegex */
        $emailRegex = config('mensetsu.email_regex');

        return ! Str::of($email)->isMatch($emailRegex);
    }
}
