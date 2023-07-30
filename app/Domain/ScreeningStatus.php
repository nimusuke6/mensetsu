<?php

namespace App\Domain;

enum ScreeningStatus
{
    case NotApplied;
    case Interview;
    case Rejected;
    case Passed;
}
