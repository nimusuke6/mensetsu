<?php

namespace App\Domain;

enum ScreeningStepResult
{
    case NotEvaluated;
    case Pass;
    case Fail;
}
